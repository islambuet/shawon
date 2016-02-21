<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $CI = & get_instance();
    $action_data=array();
    $action_data["action_back"]=base_url($CI->controller_url);
    $action_data["action_edit_link"]=base_url($CI->controller_url."/index/edit/".$patient['id']);
    $CI->load->view("action_buttons",$action_data);
?>

        <div style="margin-left: -40px;width:1211px;height:1650px;background-image:url(<?php echo base_url().'images/back.jpg';?>);font-size:20px;position: relative">
            <div style="position: absolute;top: 343px;">
                <div style="width: 570px;padding-left: 200px;float: left">
                    <?php echo $patient['name']; ?>
                </div>
                <div style="width: 300px;padding-left: 95px;float: left">
                    <?php echo $patient['sex']; ?>
                </div>
                <div style="width: 300px;padding-left: 55px;float: left">
                    <?php echo System_helper::display_date($patient['date_prescription']); ?>
                </div>
            </div>
            <div style="position: absolute;top: 450px;width: 320px;height: 250px;padding-left: 55px;overflow:hidden;font-size: 18px">
                <ol>
                <?php
                foreach($ccs as $cc)
                {
                    ?>
                    <li><?php echo $cc; ?></li>
                    <?php
                }
                ?>
                </ol>
            </div>
            <div style="position: absolute;top: 715px;width: 320px;height: 250px;padding-left: 55px;overflow:hidden;font-size: 18px">
                <ol>
                    <?php
                    foreach($oes as $oe)
                    {
                        ?>
                        <li><?php echo $oe; ?></li>
                    <?php
                    }
                    ?>
                </ol>
            </div>
            <div style="position: absolute;top: 1065px;width: 320px;height: 250px;padding-left: 55px;overflow:hidden;font-size: 18px">
                <ol>
                    <?php
                    foreach($invs as $inv)
                    {
                        ?>
                        <li><?php echo $inv; ?></li>
                    <?php
                    }
                    ?>
                </ol>
            </div>
            <div style="position: absolute;top: 1285px;width: 320px;height: 250px;padding-left: 55px;overflow:hidden;font-size: 18px">
                <ol>
                    <?php
                    foreach($dxs as $dx)
                    {
                        ?>
                        <li><?php echo $dx; ?></li>
                    <?php
                    }
                    ?>
                </ol>
            </div>
            <div style="position: absolute;top: 455px;left: 345px;width: 800px;height: 800px;overflow:hidden;font-size: 18px">
                <div>
                    <?php echo $comment_top; ?>
                </div>
            </div>
        </div>


    <div class="clearfix"></div>

<script type="text/javascript">

    jQuery(document).ready(function()
    {
        turn_off_triggers();

    });
</script>
