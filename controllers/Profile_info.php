<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile_info extends Root_Controller
{
    private  $message;
    public $permissions;
    public $controller_url;
    public function __construct()
    {
        parent::__construct();
        $this->message="";
        $this->permissions=User_helper::get_permission('Profile_info');
        $this->controller_url='profile_info';

    }

    public function index($action="details",$id=0)
    {
        //may be include edit options if required
        if($action=="details")
        {
            $this->system_details();
        }
        else
        {
            $this->system_details();
        }
    }

    private function system_details()
    {
        $user=User_helper::get_user();
        if(isset($this->permissions['view'])&&($this->permissions['view']==1))
        {

            $user_id=$user->user_id;

            $data['user']=Query_helper::get_info($this->config->item('table_setup_user'),array('id','employee_id','user_name','date_created'),array('id ='.$user_id),1);
            $data['user_info']=Query_helper::get_info($this->config->item('table_setup_user_info'),'*',array('user_id ='.$user_id,'revision =1'),1);
            $data['title']=$data['user_info']['name'];

            $data['offices']=Query_helper::get_info($this->config->item('table_setup_offices'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"'));
            $data['designations']=Query_helper::get_info($this->config->item('table_setup_designation'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"'));
            $data['user_types']=Query_helper::get_info($this->config->item('table_setup_user_type'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"'));
            $data['user_groups']=Query_helper::get_info($this->config->item('table_system_user_group'),array('id value','name text'),array('status ="'.$this->config->item('system_status_active').'"','id !=1'));

            $ajax['status']=true;
            $ajax['system_content'][]=array("id"=>"#system_content","html"=>$this->load->view("profile_info/details",$data,true));
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

}
