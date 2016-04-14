<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patients extends Root_Controller
{
    private  $message;
    public $permissions;
    public $controller_url;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->permissions=User_helper::get_permission('Patients');
        $this->controller_url='patients';
    }

    public function index($action="list",$id=0)
    {
        if($action=="list")
        {
            $this->system_list($id);
        }
        elseif($action=="add")
        {
            $this->system_add();
        }
        elseif($action=="edit")
        {
            $this->system_edit($id);
        }
        elseif($action=="details")
        {
            $this->system_details($id);
        }
        elseif($action=="save")
        {
            $this->system_save();
        }
        else
        {
            $this->system_list($id);
        }
    }

    private function system_list()
    {
        if(isset($this->permissions['view'])&&($this->permissions['view']==1))
        {
            $data['title']="List of Patients";
            $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#system_content","html"=>$this->load->view("patients/list",$data,true));
            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=site_url($this->controller_url);
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }

    }

    private function system_add()
    {
        if(isset($this->permissions['add'])&&($this->permissions['add']==1))
        {

            $data['title']="New Patient";
            $data["patient"] = Array(
                'id' => 0,
                'name' => '',
                'age' => '',
                'sex' => '',
                'chamber_id'=>0,
                'age_text'=>'yr',
                'date_prescription' => time()

            );
            $data['ccs']=array();
            $data['oes']=array();
            $data['invs']=array();
            $data['dxs']=array();
            $data['comment_tops']=array();
            $data['comment_bottoms']=array();
            $data['medicines']=array();
            $data['chambers']=Query_helper::get_info($this->config->item('table_chambers'),array('id value','name text'),array('status !="'.$this->config->item('system_status_delete').'"'));
            $ajax['system_page_url']=site_url($this->controller_url."/index/add");

            $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#system_content","html"=>$this->load->view("patients/add_edit",$data,true));
            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $this->jsonReturn($ajax);
        }
        else
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }
    private function system_edit($id)
    {
        if(isset($this->permissions['edit'])&&($this->permissions['edit']==1))
        {
            if(($this->input->post('id')))
            {
                $patient_id=$this->input->post('id');
            }
            else
            {
                $patient_id=$id;
            }
            $user = User_helper::get_user();
            $data['chambers']=Query_helper::get_info($this->config->item('table_chambers'),array('id value','name text'),array('status !="'.$this->config->item('system_status_delete').'"'));

            $data['patient']=Query_helper::get_info($this->config->item('table_patients'),'*',array('id ='.$patient_id,'user_created ='.$user->user_id),1);
            if($data['patient'])
            {
                $data['title']="Edit Patient (".$data['patient']['name'].')';
                $data['ccs']=array();
                $data['oes']=array();
                $data['invs']=array();
                $data['dxs']=array();
                $data['comment_tops']=array();
                $data['comment_bottoms']=array();
                $data['medicines']=array();

                $details=Query_helper::get_info($this->config->item('table_patient_prescription'),'*',array('patient_id ='.$patient_id,'revision =1'));
                foreach($details as $detail)
                {
                    if($detail['type']==$this->config->item('system_cc'))
                    {
                        $data['ccs'][]=$detail['value'];
                    }
                    else if($detail['type']==$this->config->item('system_oe'))
                    {
                        $data['oes'][]=$detail['value'];
                    }
                    else if($detail['type']==$this->config->item('system_inv'))
                    {
                        $data['invs'][]=$detail['value'];
                    }
                    else if($detail['type']==$this->config->item('system_dx'))
                    {
                        $data['dxs'][]=$detail['value'];
                    }
                    else if($detail['type']==$this->config->item('system_comment_top'))
                    {
                        $data['comment_tops'][]=$detail['value'];
                    }
                    else if($detail['type']==$this->config->item('system_comment_bottom'))
                    {
                        $data['comment_bottoms'][]=$detail['value'];
                    }
                    else if($detail['type']==$this->config->item('system_medicine'))
                    {
                        $data['medicines'][]=json_decode($detail['value'],true);
                    }
                }

                $ajax['status']=true;
                $ajax['system_content'][]=array("id"=>"#system_content","html"=>$this->load->view("patients/add_edit",$data,true));
                if($this->message)
                {
                    $ajax['system_message']=$this->message;
                }
                $ajax['system_page_url']=site_url($this->controller_url.'/index/edit/'.$patient_id);
                $this->jsonReturn($ajax);
            }
            else
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
                $this->jsonReturn($ajax);
            }

        }
        else
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }
    private function system_details($id)
    {
        if(isset($this->permissions['view'])&&($this->permissions['view']==1))
        {
            if(($this->input->post('id')))
            {
                $patient_id=$this->input->post('id');
            }
            else
            {
                $patient_id=$id;
            }
            $user = User_helper::get_user();

            $data['patient']=Query_helper::get_info($this->config->item('table_patients'),'*',array('id ='.$patient_id,'user_created ='.$user->user_id),1);
            if($data['patient'])
            {
                $data['chamber']=Query_helper::get_info($this->config->item('table_chambers'),'*',array('id ='.$data['patient']['chamber_id']),1);
                $data['title']="Details of Patient (".$data['patient']['name'].')';

                $data['ccs']=array();
                $data['oes']=array();
                $data['invs']=array();
                $data['dxs']=array();
                $data['comment_top']='';
                $data['comment_bottom']='';
                $data['medicines']=array();

                $details=Query_helper::get_info($this->config->item('table_patient_prescription'),'*',array('patient_id ='.$patient_id,'revision =1'));
                foreach($details as $detail)
                {
                    if($detail['type']==$this->config->item('system_cc'))
                    {
                        $data['ccs'][]=$detail['value'];
                    }
                    else if($detail['type']==$this->config->item('system_oe'))
                    {
                        $data['oes'][]=$detail['value'];
                    }
                    else if($detail['type']==$this->config->item('system_inv'))
                    {
                        $data['invs'][]=$detail['value'];
                    }
                    else if($detail['type']==$this->config->item('system_dx'))
                    {
                        $data['dxs'][]=$detail['value'];
                    }
                    else if($detail['type']==$this->config->item('system_comment_top'))
                    {
                        $data['comment_top']=$detail['value'];
                    }
                    else if($detail['type']==$this->config->item('system_comment_bottom'))
                    {
                        $data['comment_bottom']=$detail['value'];
                    }
                    else if($detail['type']==$this->config->item('system_medicine'))
                    {
                        $data['medicines'][]=json_decode($detail['value'],true);
                    }
                }

                $ajax['status']=true;
                $ajax['system_content'][]=array("id"=>"#system_content","html"=>$this->load->view("patients/details",$data,true));
                if($this->message)
                {
                    $ajax['system_message']=$this->message;
                }
                $ajax['system_page_url']=site_url($this->controller_url.'/index/details/'.$patient_id);
                $this->jsonReturn($ajax);
            }
            else
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
                $this->jsonReturn($ajax);
            }

        }
        else
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
        }
    }

    private function system_save()
    {
//        echo '<PRE>';
//        print_r($this->input->post());
//        echo '</PRE>';
//        die();
        $id = $this->input->post("id");
        $user = User_helper::get_user();
        if($id>0)
        {
            if(!(isset($this->permissions['edit'])&&($this->permissions['edit']==1)))
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
                $this->jsonReturn($ajax);
                die();
            }
        }
        else
        {
            if(!(isset($this->permissions['add'])&&($this->permissions['add']==1)))
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
                $this->jsonReturn($ajax);
                die();

            }
        }
        if(!$this->check_validation())
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->message;
            $this->jsonReturn($ajax);
        }
        else
        {
            $patient=$this->input->post('patient');
            $patient['date_prescription']=System_helper::get_time($patient['date_prescription']);

            $this->db->trans_start();  //DB Transaction Handle START
            $time=time();
            if($id>0)
            {
                $data=$patient;
                $data['user_updated'] = $user->user_id;
                $data['date_updated'] = $time;

                Query_helper::update($this->config->item('table_patients'),$data,array("id = ".$id));

            }
            else
            {
                $data=$patient;
                $data['user_created'] = $user->user_id;
                $data['date_created'] = $time;
                $patient_id=Query_helper::add($this->config->item('table_patients'),$data);
                if($patient_id===false)
                {
                    $this->db->trans_complete();
                    $ajax['status']=false;
                    $ajax['system_message']=$this->lang->line("MSG_SAVED_FAIL");
                    $this->jsonReturn($ajax);
                    die();
                }
                else
                {
                    $id=$patient_id;
                }
            }
            $this->db->where('patient_id',$id);
            $this->db->set('revision', 'revision+1', FALSE);
            $this->db->update($this->config->item('table_patient_prescription'));

            $ccs=$this->input->post('ccs');

            if(is_array($ccs))
            {
                foreach($ccs as $cc)
                {
                    $data=array();
                    $data['patient_id']=$id;
                    $data['type']=$this->config->item('system_cc');
                    $data['value']=$cc;
                    $data['revision']=1;
                    $data['user_created'] = $user->user_id;
                    $data['date_created'] = $time;
                    Query_helper::add($this->config->item('table_patient_prescription'),$data);
                }
            }
            $oes=$this->input->post('oes');

            if(is_array($oes))
            {
                foreach($oes as $oe)
                {
                    $data=array();
                    $data['patient_id']=$id;
                    $data['type']=$this->config->item('system_oe');
                    $data['value']=$oe;
                    $data['revision']=1;
                    $data['user_created'] = $user->user_id;
                    $data['date_created'] = $time;
                    Query_helper::add($this->config->item('table_patient_prescription'),$data);
                }
            }
            $invs=$this->input->post('invs');

            if(is_array($invs))
            {
                foreach($invs as $inv)
                {
                    $data=array();
                    $data['patient_id']=$id;
                    $data['type']=$this->config->item('system_inv');
                    $data['value']=$inv;
                    $data['revision']=1;
                    $data['user_created'] = $user->user_id;
                    $data['date_created'] = $time;
                    Query_helper::add($this->config->item('table_patient_prescription'),$data);
                }
            }
            $dxs=$this->input->post('dxs');
            if(is_array($dxs))
            {
                foreach($dxs as $dx)
                {
                    $data=array();
                    $data['patient_id']=$id;
                    $data['type']=$this->config->item('system_dx');
                    $data['value']=$dx;
                    $data['revision']=1;
                    $data['user_created'] = $user->user_id;
                    $data['date_created'] = $time;
                    Query_helper::add($this->config->item('table_patient_prescription'),$data);
                }
            }
            $comment_tops=$this->input->post('comment_tops');
            if(is_array($comment_tops))
            {
                foreach($comment_tops as $comment)
                {
                    $data=array();
                    $data['patient_id']=$id;
                    $data['type']=$this->config->item('system_comment_top');
                    $data['value']=$comment;
                    $data['revision']=1;
                    $data['user_created'] = $user->user_id;
                    $data['date_created'] = $time;
                    Query_helper::add($this->config->item('table_patient_prescription'),$data);
                }
            }

            $comment_bottoms=$this->input->post('comment_bottoms');
            if(is_array($comment_bottoms))
            {
                foreach($comment_bottoms as $comment)
                {
                    $data=array();
                    $data['patient_id']=$id;
                    $data['type']=$this->config->item('system_comment_bottom');
                    $data['value']=$comment;
                    $data['revision']=1;
                    $data['user_created'] = $user->user_id;
                    $data['date_created'] = $time;
                    Query_helper::add($this->config->item('table_patient_prescription'),$data);
                }
            }


            $medicines=$this->input->post('medicines');
            if(is_array($medicines))
            {
                foreach($medicines as $medicine)
                {
                    $data=array();
                    $data['patient_id']=$id;
                    $data['type']=$this->config->item('system_medicine');
                    $data['value']=json_encode($medicine);
                    $data['revision']=1;
                    $data['user_created'] = $user->user_id;
                    $data['date_created'] = $time;
                    Query_helper::add($this->config->item('table_patient_prescription'),$data);
                }
            }

            $this->db->trans_complete();   //DB Transaction Handle END
            if ($this->db->trans_status() === TRUE)
            {
                $this->message=$this->lang->line("MSG_SAVED_SUCCESS");
                $this->system_details($id);

            }
            else
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("MSG_SAVED_FAIL");
                $this->jsonReturn($ajax);
            }
        }
    }
    private function check_validation()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('patient[name]',$this->lang->line('LABEL_NAME'),'required');
        $this->form_validation->set_rules('patient[chamber_id]',"Chamber Name",'required');

        //check if created user has this patient id if id>0

        if($this->form_validation->run() == FALSE)
        {
            $this->message=validation_errors();
            return false;
        }
        return true;
    }
    public function get_items()
    {
        $user = User_helper::get_user();
        if($user->user_group==1)
        {
            $items=Query_helper::get_info($this->config->item('table_patients'),array('id','name','age','sex','date_prescription'),array('status !="'.$this->config->item('system_status_delete').'"'));
        }
        else
        {
            $items=Query_helper::get_info($this->config->item('table_patients'),array('id','name','age','sex','date_prescription'),array('status !="'.$this->config->item('system_status_delete').'"','user_created ='.$user->user_id));
        }
        foreach($items as &$item)
        {
            $item['date_prescription']=System_helper::display_date($item['date_prescription']);
        }

        $this->jsonReturn($items);

    }

}
