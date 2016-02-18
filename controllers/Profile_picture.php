<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_picture extends Root_Controller
{
    private  $message;
    public $permissions;
    public $controller_url;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->permissions=User_helper::get_permission('Profile_picture');
        $this->controller_url='profile_picture';

    }

    public function index($action="edit",$id=0)
    {
        if($action=="edit")
        {
            $this->system_edit();
        }
        elseif($action=="save")
        {
            $this->system_save();
        }
        else
        {
            $this->system_edit();
        }
    }

    private function system_edit()
    {
        if(isset($this->permissions['edit'])&&($this->permissions['edit']==1))
        {
            $user=User_helper::get_user();
            $user_id=$user->user_id;

            $data['user_info']=Query_helper::get_info($this->config->item('table_setup_user_info'),array('picture_profile'),array('user_id ='.$user_id,'revision =1'),1);
            $data['title']='Change Profile Picture';

            $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#system_content","html"=>$this->load->view("profile_picture/add_edit",$data,true));
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

    private function system_save()
    {

        $user = User_helper::get_user();
        if(!(isset($this->permissions['edit'])&&($this->permissions['edit']==1)))
        {
            $ajax['status']=false;
            $ajax['system_message']=$this->lang->line("YOU_DONT_HAVE_ACCESS");
            $this->jsonReturn($ajax);
            die();
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
            $user_id=$user->user_id;

            $uploaded_image = System_helper::upload_file("images/profiles/".$user_id);
            if(array_key_exists('image_profile',$uploaded_image))
            {
                $data_user_info=Query_helper::get_info($this->config->item('table_setup_user_info'),array('*'),array('user_id ='.$user_id,'revision =1'),1);
                unset($data_user_info['id']);
                $data_user_info['user_created'] = $user->user_id;
                $data_user_info['date_created'] = $time;
                $data_user_info['revision'] = 1;
                $data_user_info['picture_profile']=base_url()."images/profiles/".$user_id.'/'.$uploaded_image['image_profile']['info']['file_name'];

                $this->db->trans_start();  //DB Transaction Handle START
                $this->db->where('user_id',$user_id);
                $this->db->set('revision', 'revision+1', FALSE);
                $this->db->update($this->config->item('table_setup_user_info'));


                Query_helper::add($this->config->item('table_setup_user_info'),$data_user_info);
                $this->db->trans_complete();   //DB Transaction Handle END
                if ($this->db->trans_status() === TRUE)
                {

                    $this->message=$this->lang->line("MSG_SAVED_SUCCESS");
                    $this->system_edit();
                }
                else
                {
                    $ajax['status']=false;
                    $ajax['system_message']=$this->lang->line("MSG_SAVED_FAIL");
                    $this->jsonReturn($ajax);
                }
            }
            else
            {
                $ajax['status']=false;
                $ajax['system_message']=$this->lang->line("MSG_NO_FILE_UPLOADED");
                $this->jsonReturn($ajax);
            }
        }
    }
    private function check_validation()
    {
        return true;
    }

}
