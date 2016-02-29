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
                    <?php echo $patient['age'].'yr'.($patient['age']>0?'s':'').'/'.$patient['sex']; ?>
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
                <div style="padding-bottom: 20px;">
                    <?php echo $comment_top; ?>
                </div>
                <?php
                if(sizeof($medicines)>0)
                {
                    ?>
                    <table width="100%">
                        <?php
                        foreach($medicines as $index=>$medicine)
                        {
                            $num_dots=intval((50-strlen($medicine['name']))/4);
                            $space='';
                            for($i=0;$i<$num_dots;$i++)
                            {
                                $space.='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;...';
                            }
                            $days='';
                            if($medicine['days']>1)
                            {
                                $days=$medicine['days'].'&nbsp;days';
                            }
                            elseif($medicine['days']==1)
                            {
                                $days=$medicine['days'].'&nbsp;day';
                            }
                            ?>
                            <tr>
                                <td style="text-align: right;width: 20px;"><?php echo ($index+1).'.' ?></td>
                                <td><span class="medicine_name" data-index="<?php echo $index; ?>" style="text-decoration: underline;"><b><?php echo $medicine['name']; ?></b></span><span id="space_<?php echo $index; ?>" style="float: right;text-align: right;">&nbsp;</span></td>
                                <td style="text-align: right;width: 75px;"><?php echo $days; ?></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><span style="float: left;width: 350px;padding-left: 30px;padding-right: 10px;"><?php echo $medicine['description']; ?></span><span style="width: 85px;float: right;"><?php echo $medicine['when']; ?></span></td>
                                <td>&nbsp;</td>
                            </tr>

                            <?php
                        }
                        ?>
                    </table>
                    <?php
                }

                ?>
                <div style="padding-top: 30px;">
                    <?php echo $comment_bottom; ?>
                </div>
            </div>
        </div>


    <div class="clearfix"></div>

<script type="text/javascript">

    jQuery(document).ready(function()
    {
        turn_off_triggers();
        $( ".medicine_name" ).each(function( index )
        {
            var width=530-95-$(this).width();
            var id=$(this).attr('data-index');
            $("#space_"+id).width(width);
            var dot='';
            for(var i=0;i<((width/4)-2);i++)
            {
                if(i%8>2)
                {
                    dot='&nbsp;'+dot;
                }
                else
                {
                    dot='.'+dot;
                }
            }
            $("#space_"+id).html(dot);
            console.log(width);
        });

    });
</script>
