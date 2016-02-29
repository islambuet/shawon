<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $CI = & get_instance();
    $action_data=array();
    $action_data["action_back"]=base_url($CI->controller_url);
    $action_data["action_edit_link"]=base_url($CI->controller_url."/index/edit/".$patient['id']);
    $CI->load->view("action_buttons",$action_data);
?>

        <div style="margin-left: -40px;width:830px;height:1108px;background-image:url(<?php echo base_url().'images/back.jpg';?>);font-size:15px;position: relative">
            <div style="position: absolute;top: 221px;">
                <div style="width: 395px;padding-left: 150px;float: left">
                    <?php echo $patient['name']; ?>
                </div>
                <div style="width: 205px;padding-left: 70px;float: left">
                    <?php echo $patient['age'].'/'.$patient['sex']; ?>
                </div>
                <div style="width: 180px;padding-left: 45px;float: left">
                    <?php echo System_helper::display_date($patient['date_prescription']); ?>
                </div>
            </div>
            <div style="position: absolute;top: 300px;width: 230px;height: 160px;padding-left: 30px;overflow:hidden;">
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
            <div style="position: absolute;top: 480px;width: 230px;height: 220px;padding-left: 30px;overflow:hidden;">
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
            <div style="position: absolute;top: 715px;width: 230px;height: 135px;padding-left: 30px;overflow:hidden;">
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
            <div style="position: absolute;top: 860px;width: 230px;height: 125px;padding-left: 30px;overflow:hidden;">
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
            <div style="position: absolute;top: 300px;left: 250px;width: 530px;height: 570px;overflow:hidden;">
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
