<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    $CI = & get_instance();
    $action_data=array();
    $action_data["action_back"]=base_url($CI->controller_url);
    $action_data["action_edit_link"]=base_url($CI->controller_url."/index/edit/".$patient['id']);
    $action_data["action_print_page"]='print';
    $CI->load->view("action_buttons",$action_data);
?>

        <div style="margin-left: -40px;width:830px;height:1108px;background-image:url(<?php echo base_url().'images/back.jpg';?>);font-size:15px;position: relative">
            <div style="position: absolute;top: 145px;left: 655px;width: 160px;font-size: 12px;">
                <?php echo $patient['id']; ?>
            </div>
            <div style="position: absolute;top: 170px;">
                <div style="width: 415px;padding-left: 95px;float: left">
                    <?php echo $patient['name']; ?>
                </div>
                <div style="width: 220px;padding-left: 70px;float: left">
                    <?php echo $patient['age'].$patient['age_text'].($patient['age']>0?'s':'').'/'.$patient['sex']; ?>
                </div>
                <div style="width: 180px;padding-left: 45px;float: left">
                    <?php echo System_helper::display_date($patient['date_prescription']); ?>
                </div>
            </div>
            <div style="position: absolute;top: 245px;width: 250px;height: 200px;padding-left: 30px;overflow:hidden;">
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
            <div style="position: absolute;top: 465px;width: 250px;height: 230px;padding-left: 30px;overflow:hidden;">
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
            <div style="position: absolute;top: 715px;width: 250px;height: 135px;padding-left: 30px;overflow:hidden;">
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
            <div style="position: absolute;top: 880px;width: 250px;height: 145px;padding-left: 30px;overflow:hidden;">
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
            <div style="position: absolute;top: 260px;left: 260px;width: 550px;height: 765px;overflow:hidden;">
                <div style="padding-bottom: 20px;">
                    <ul style="list-style: none;font-style: italic;font-size: 20px;line-height: 25px;padding-left: 2px;">
                        <?php
                        foreach($comment_tops as $comment)
                        {
                            ?>
                            <li><?php echo $comment; ?></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div style="min-height: 500px;">
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
                </div>
                <div style="padding-bottom: 30px;">
                    <ol style="font-style: italic;">
                        <?php
                        foreach($comment_bottoms as $comment)
                        {
                            ?>
                            <li><?php echo $comment; ?></li>
                        <?php
                        }
                        ?>
                    </ol>
                </div>
            </div>
            <div style="position: absolute;top: 1030px;left: 100px;width: 230px;height: 20px;overflow:hidden;">
                <?php echo $chamber['line1']; ?>
            </div>
            <div style="position: absolute;top: 1052px;left: 50px;width: 300px;height: 20px;overflow:hidden;">
                <?php echo $chamber['line2']; ?>
            </div>
            <div style="position: absolute;top: 1070px;left: 50px;width: 300;height: 20px;overflow:hidden;">
                <?php echo $chamber['line3']; ?>
            </div>

            <div style="position: absolute;top: 1030px;left: 445px;width: 85px;height: 20px;overflow:hidden;">
                <?php echo $time['line1']; ?>
            </div>
            <div style="position: absolute;top: 1052px;left: 360px;width: 170px;height: 20px;overflow:hidden;">
                <?php echo $time['line2']; ?>
            </div>
            <div style="position: absolute;top: 1070px;left: 360px;width: 170px;height: 20px;overflow:hidden;">
                <?php echo $time['line3']; ?>
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
        });

    });
</script>
