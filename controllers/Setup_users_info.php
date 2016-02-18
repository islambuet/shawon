<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Setup_users_info extends Root_Controller
{
    private  $message;
    public $permissions;
    public $controller_url;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->permissions=User_helper::get_permission('Setup_users_info');
        $this->controller_url='setup_users_info';

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
            $data['title']="List of Users";
            $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#system_content","html"=>$this->load->view("setup_users_info/list",$data,true));
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

            $data['title']="Create New User";

            $data["user"] = Array(
                'id' => 0,
                'employee_id' => '',
                'user_name' => ''
            );
            $data["user_info"] = Array(
                'name' => '',
                'office_id' => '',
                'designation' => '',
                'user_type_id' => '',
                'user_group' => '',
                'father_name' => '',
                'mother_name' => '',
                'date_birth' => '',
                'gender' => '',
                'status_marital' => '',
                'spouse_name' => '',
                'nid' => '',
                'address_present' => '',
                'address_permanent' => '',
                'date_join' => '',
                'salary_basic' => '',
                'salary_other' => '',
                'blood_group' => '',
                'mobile_no' => '',
                'tel_no' => '',
                'contact_person' => '',
                'contact_no' => '',
                'picture_profile' => base_url().'images/no_image.jpg',
                'ordering' => 99
            );
            $data['offices']=Query_helper::get_info($this->config->item('table_setup_offices'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"'));
            $data['designations']=Query_helper::get_info($this->config->item('table_setup_designation'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"'));
            $data['user_types']=Query_helper::get_info($this->config->item('table_setup_user_type'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"'));
            $data['user_groups']=Query_helper::get_info($this->config->item('table_system_user_group'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"','id !=1'));
            $ajax['system_page_url']=site_url($this->controller_url."/index/add");

            $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#system_content","html"=>$this->load->view("setup_users_info/add_edit",$data,true));
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
                $user_id=$this->input->post('id');
            }
            else
            {
                $user_id=$id;
            }

            $data['user']=Query_helper::get_info($this->config->item('table_setup_user'),array('id','employee_id','user_name'),array('id ='.$user_id),1);
            $data['user_info']=Query_helper::get_info($this->config->item('table_setup_user_info'),'*',array('user_id ='.$user_id,'revision =1'),1);
            $data['title']="Edit User (".$data['user_info']['name'].')';

            $data['offices']=Query_helper::get_info($this->config->item('table_setup_offices'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"'));
            $data['designations']=Query_helper::get_info($this->config->item('table_setup_designation'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"'));
            $data['user_types']=Query_helper::get_info($this->config->item('table_setup_user_type'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"'));
            $data['user_groups']=Query_helper::get_info($this->config->item('table_system_user_group'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"','id !=1'));

            $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#system_content","html"=>$this->load->view("setup_users_info/add_edit",$data,true));
            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=site_url($this->controller_url.'/index/edit/'.$user_id);
            $this->jsonReturn($ajax);
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
                $user_id=$this->input->post('id');
            }
            else
            {
                $user_id=$id;
            }

            $data['user']=Query_helper::get_info($this->config->item('table_setup_user'),array('id','employee_id','user_name','date_created'),array('id ='.$user_id),1);
            $data['user_info']=Query_helper::get_info($this->config->item('table_setup_user_info'),'*',array('user_id ='.$user_id,'revision =1'),1);
            $data['title']="Details of User (".$data['user_info']['name'].')';

            $data['offices']=Query_helper::get_info($this->config->item('table_setup_offices'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"'));
            $data['designations']=Query_helper::get_info($this->config->item('table_setup_designation'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"'));
            $data['user_types']=Query_helper::get_info($this->config->item('table_setup_user_type'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"'));
            $data['user_groups']=Query_helper::get_info($this->config->item('table_system_user_group'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"','id !=1'));

            $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#system_content","html"=>$this->load->view("setup_users_info/details",$data,true));
            if($this->message)
            {
                $ajax['system_message']=$this->message;
            }
            $ajax['system_page_url']=site_url($this->controller_url.'/index/details/'.$user_id);
            $this->jsonReturn($ajax);
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
            $time=time();

            $this->db->trans_start();  //DB Transaction Handle START
            if($id==0)
            {
                $data_user=$this->input->post('user');
                $data_user['password']=md5($data_user['user_name']);
                $data_user['status']=$this->config->item('system_status_active');
                $data_user['user_created'] = $user->user_id;
                $data_user['date_created'] = $time;
                $user_id=Query_helper::add($this->config->item('table_setup_user'),$data_user);
                if($user_id===false)
                {
                    $this->db->trans_complete();
                    $ajax['status']=false;
                    $ajax['system_message']=$this->lang->line("MSG_SAVED_FAIL");
                    $this->jsonReturn($ajax);
                    die();
                }
                else
                {
                    $id=$user_id;
                    $dir=(FCPATH)."images/profiles/".$id;
                    if(!is_dir($dir))
                    {
                        mkdir($dir, 0777);
                    }
                }
            }
            $this->db->where('user_id',$id);
            $this->db->set('revision', 'revision+1', FALSE);
            $this->db->update($this->config->item('table_setup_user_info'));
            $data_user_info=$this->input->post('user_info');
            $data_user_info['user_id']=$id;
            $data_user_info['date_birth']=System_helper::get_time($data_user_info['date_birth']);
            $data_user_info['date_join']=System_helper::get_time($data_user_info['date_join']);
            $data_user_info['user_created'] = $user->user_id;
            $data_user_info['date_created'] = $time;
            $data_user_info['revision'] = 1;
            $uploaded_image = System_helper::upload_file("images/profiles/".$id);
            if(array_key_exists('image_profile',$uploaded_image))
            {
                $data_user_info['picture_profile']=base_url()."images/profiles/".$id.'/'.$uploaded_image['image_profile']['info']['file_name'];
            }
            Query_helper::add($this->config->item('table_setup_user_info'),$data_user_info);
            $this->db->trans_complete();   //DB Transaction Handle END
            if ($this->db->trans_status() === TRUE)
            {
                $save_and_new=$this->input->post('system_save_new_status');
                $this->message=$this->lang->line("MSG_SAVED_SUCCESS");
                if($save_and_new==1)
                {
                    $this->system_add();
                }
                else
                {
                    $this->system_list();
                }
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
        $id = $this->input->post("id");
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_info[name]',$this->lang->line('LABEL_NAME'),'required');
        if($id==0)
        {
            $this->form_validation->set_rules('user[user_name]',$this->lang->line('LABEL_USERNAME'),'required');
            $user_user=$this->input->post("user");
            $exists=Query_helper::get_info($this->config->item('table_setup_user'),array('user_name'),array('user_name ="'.$user_user['user_name'].'"'),1);
            if($exists)
            {
                $this->message="User Name already Exists";
                return false;
            }

        }

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

        $this->db->from($this->config->item('table_setup_user').' user');
        $this->db->select('user.id,user.employee_id,user.user_name,user.status');
        $this->db->select('user_info.name,user_info.ordering');
        $this->db->select('ug.name group_name');
        $this->db->join($this->config->item('table_setup_user_info').' user_info','user.id = user_info.user_id','INNER');
        $this->db->join($this->config->item('table_system_user_group').' ug','ug.id = user_info.user_group','LEFT');
        $this->db->where('user_info.revision',1);
        $this->db->order_by('user_info.ordering','ASC');
        if($user->user_group!=1)
        {
            $this->db->where('user_info.user_group !=',1);
        }

        $items=$this->db->get()->result_array();


        //$items=Query_helper::get_info($this->config->item('table_setup_user'),array('id','name','status','ordering'),array('status !="'.$this->config->item('system_status_delete').'"'));
        $this->jsonReturn($items);

    }

}
