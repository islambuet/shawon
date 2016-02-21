<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $CI = & get_instance();
    $action_data=array();
    $action_data["action_back"]=base_url($CI->controller_url);
    $action_data["action_edit_link"]=base_url($CI->controller_url."/index/edit/".$patient['id']);
    $CI->load->view("action_buttons",$action_data);
?>

        <div style="margin-left: -40px">
            sdaf alasdfhak
        </div>


    <div class="clearfix"></div>

<script type="text/javascript">

    jQuery(document).ready(function()
    {
        turn_off_triggers();

    });
</script>
