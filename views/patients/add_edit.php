<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI = & get_instance();
$action_data=array();
$action_data["action_back"]=base_url($CI->controller_url);
$action_data["action_save"]='#save_form';
$action_data["action_clear"]='#save_form';
$CI->load->view("action_buttons",$action_data);
?>
<form class="form_valid" id="save_form" action="<?php echo site_url($CI->controller_url.'/index/save');?>" method="post">
    <input type="hidden" id="id" name="id" value="<?php echo $patient['id']; ?>" />
    <input type="hidden" id="system_save_new_status" name="system_save_new_status" value="0" />
    <div class="row widget">
        <div class="widget-header">
            <div class="title">
                <?php echo $title; ?>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="row show-grid">
            <div class="col-xs-4">
                <div class="row show-grid">
                    <div class="col-xs-2">
                        <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_NAME');?><span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-xs-10">
                        <input type="text" name="patient[name]" id="name" class="form-control" value="<?php echo $patient['name'];?>"/>
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="row show-grid">
                    <div class="col-xs-2">
                        <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_AGE');?><span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-xs-4">
                        <input type="text" name="patient[age]" id="age" class="form-control" value="<?php echo $patient['age'];?>"/>
                    </div>
                    <div class="col-xs-6">
                        <select id="age_text" name="patient[age_text]" class="form-control">
                            <option value="yr" <?php if($patient['age_text']=='yr'){ echo "selected";}?>>Year(s)</option>
                            <option value="month" <?php if($patient['age_text']=='month'){ echo "selected";}?>>Month(s)</option>
                            <option value="day" <?php if($patient['age_text']=='day'){ echo "selected";}?>>Day(s)</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-2">
                <div class="row show-grid">
                    <div class="col-xs-4">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_SEX');?></label>
                    </div>
                    <div class="col-xs-8">
                        <select id="sex" name="patient[sex]" class="form-control">
                            <option value="Male" <?php if($patient['sex']=='Male'){ echo "selected";}?>>Male</option>
                            <option value="Female" <?php if($patient['sex']=='Female'){ echo "selected";}?>>Female</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-3">
                <div class="row show-grid">
                    <div class="col-xs-2">
                        <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_DATE');?></label>
                    </div>
                    <div class="col-xs-10">
                        <input type="text" name="patient[date_prescription]" id="date_prescription" class="form-control datepicker" value="<?php echo System_helper::display_date($patient['date_prescription']);?>"/>
                    </div>
                </div>
            </div>
        </div>
        <div class="row show-grid">
            <div class="col-xs-4">
                <div class="panel-group" id="accordion_left">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a class="accordion-toggle external" data-toggle="collapse"  data-target="#collapse_cc" href="#">C/C</a></h4>
                        </div>
                        <div id="collapse_cc" class="panel-collapse collapse in">
                            <div  id="container_cc">
                                <?php
                                foreach($ccs as $cc)
                                {
                                    ?>
                                    <div style="" class="row show-grid">
                                        <div class="col-xs-9">
                                            <textarea name="ccs[]" class="form-control content_cc"><?php echo $cc; ?></textarea>
                                        </div>
                                        <div class="col-xs-3">
                                            <button type="button" class="btn btn-danger delete_cc">DELETE</button>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="row show-grid">
                                <div class="col-xs-12">
                                    <button type="button" id="add_cc" class="btn btn-warning">ADD C/C</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a class="accordion-toggle external" data-toggle="collapse"  data-target="#collapse_oe" href="#">O/E</a></h4>
                        </div>
                        <div id="collapse_oe" class="panel-collapse collapse in">
                            <div  id="container_oe">
                                <?php
                                foreach($oes as $oe)
                                {
                                    ?>
                                    <div style="" class="row show-grid">
                                        <div class="col-xs-9">
                                            <textarea name="oes[]" class="form-control content_oe"><?php echo $oe; ?></textarea>
                                        </div>
                                        <div class="col-xs-3">
                                            <button type="button" class="btn btn-danger delete_oe">DELETE</button>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="row show-grid">
                                <div class="col-xs-12">
                                    <button type="button" id="add_oe" class="btn btn-warning">ADD O/E</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a class="accordion-toggle external" data-toggle="collapse"  data-target="#collapse_inv" href="#">Inv</a></h4>
                        </div>
                        <div id="collapse_inv" class="panel-collapse collapse in">
                            <div  id="container_inv">
                                <?php
                                foreach($invs as $inv)
                                {
                                    ?>
                                    <div style="" class="row show-grid">
                                        <div class="col-xs-9">
                                            <textarea name="invs[]" class="form-control content_inv"><?php echo $inv; ?></textarea>
                                        </div>
                                        <div class="col-xs-3">
                                            <button type="button" class="btn btn-danger delete_inv">DELETE</button>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="row show-grid">
                                <div class="col-xs-12">
                                    <button type="button" id="add_inv" class="btn btn-warning">ADD Inv</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a class="accordion-toggle external" data-toggle="collapse"  data-target="#collapse_dx" href="#">Dx</a></h4>
                        </div>
                        <div id="collapse_dx" class="panel-collapse collapse in">
                            <div  id="container_dx">
                                <?php
                                foreach($dxs as $dx)
                                {
                                    ?>
                                    <div style="" class="row show-grid">
                                        <div class="col-xs-9">
                                            <textarea name="dxs[]" class="form-control content_dx"><?php echo $dx; ?></textarea>
                                        </div>
                                        <div class="col-xs-3">
                                            <button type="button" class="btn btn-danger delete_dx">DELETE</button>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="row show-grid">
                                <div class="col-xs-12">
                                    <button type="button" id="add_dx" class="btn btn-warning">ADD Dx</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-8">
                <div class="panel-group" id="accordion_right">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a class="accordion-toggle external" data-toggle="collapse"  data-target="#collapse_comment_top" href="#">Comment Top</a></h4>
                        </div>
                        <div id="collapse_comment_top" class="panel-collapse collapse in">
                            <div  id="container_comment_top">
                                <?php
                                foreach($comment_tops as $comment)
                                {
                                    ?>
                                    <div style="" class="row show-grid">
                                        <div class="col-xs-9">
                                            <textarea name="comment_tops[]" class="form-control content_comment_top"><?php echo $comment; ?></textarea>
                                        </div>
                                        <div class="col-xs-3">
                                            <button type="button" class="btn btn-danger delete_comment_top">DELETE</button>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="row show-grid">
                                <div class="col-xs-12">
                                    <button type="button" id="add_comment_top" class="btn btn-warning">ADD Top Comment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a class="accordion-toggle external" data-toggle="collapse"  data-target="#collapse_medicien" href="#">Medicines</a></h4>
                        </div>
                        <div id="collapse_medicien" class="panel-collapse collapse in">
                            <div id="container_medicine">
                                <?php
                                foreach($medicines as $i=>$medicine)
                                {
                                    ?>
                                    <div class="row widget medicine_details">
                                        <div class="widget-header">
                                            <div class="title">
                                                <?php echo $CI->lang->line('LABEL_MEDICINE_INFO'); ?>
                                            </div>

                                            <button type="button" class="btn btn-danger pull-right delete_medicine"><?php echo $CI->lang->line('DELETE'); ?></button>

                                            <div class="clearfix"></div>

                                        </div>
                                        <div class="row show-grid">
                                            <div class="col-xs-4">
                                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_MEDICINE_NAME'); ?><span style="color:#FF0000">*</span></label>
                                            </div>
                                            <div class="col-xs-8">
                                                <input type="text" id="medicine_name" name="medicines[<?php echo $i+1; ?>][name]" class="form-control" value="<?php echo $medicine['name'];?>">
                                            </div>
                                        </div>
                                        <div class="row show-grid">
                                            <div class="col-xs-4">
                                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_MEDICINE_DAYS'); ?><span style="color:#FF0000">*</span></label>
                                            </div>
                                            <div class="col-xs-4">
                                                <select name="medicines[<?php echo $i+1; ?>][days]" class="form-control">
                                                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                                    <option value=Continue <?php if($medicine['days']=='Continue'){ echo "selected";}?>>Continue</option>
                                                    <?php
                                                    for($d=1;$d<30;$d++)
                                                    {?>
                                                        <option value="<?php echo $d;?>" <?php if($d==$medicine['days']){ echo "selected";}?>><?php echo $d;?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-xs-4">
                                                <select name="medicines[<?php echo $i+1; ?>][day_text]" class="form-control">
                                                    <option value="Day" <?php if($medicine['day_text']=="Day"){ echo "selected";}?>>Day(s)</option>
                                                    <option value="Month" <?php if($medicine['day_text']=="Month"){ echo "selected";}?>>Month(s)</option>
                                                    <option value="Week" <?php if($medicine['day_text']=="Week"){ echo "selected";}?>>Week(s)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row show-grid">
                                            <div class="col-xs-4">
                                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_MEDICINE_DESCRIPTION'); ?><span style="color:#FF0000">*</span></label>
                                            </div>
                                            <div class="col-xs-8">
                                                <textarea id="medicine_description"  name="medicines[<?php echo $i+1; ?>][description]" class="form-control"><?php echo $medicine['description'];?></textarea>
                                            </div>
                                        </div>
                                        <div class="row show-grid">
                                            <div class="col-xs-4">
                                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_MEDICINE_WHEN'); ?><span style="color:#FF0000">*</span></label>
                                            </div>
                                            <div class="col-xs-8">
                                                <select id="medicine_when"  name="medicines[<?php echo $i+1; ?>][when]"  class="form-control">
                                                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                                    <option value="After Meal" <?php if($medicine['when']=='After Meal'){ echo "selected";}?>>After Meal</option>
                                                    <option value="Before Meal" <?php if($medicine['when']=='Before Meal'){ echo "selected";}?>>Before Meal</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="row show-grid">
                                <div class="col-xs-12">
                                    <button type="button" id="add_medicine" class="btn btn-warning">ADD Medicine</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a class="accordion-toggle external" data-toggle="collapse"  data-target="#collapse_comment_bottom" href="#">Comment Bottom</a></h4>
                        </div>
                        <div id="collapse_comment_bottom" class="panel-collapse collapse in">
                            <div  id="container_comment_bottom">
                                <?php
                                foreach($comment_bottoms as $comment)
                                {
                                    ?>
                                    <div style="" class="row show-grid">
                                        <div class="col-xs-9">
                                            <textarea name="comment_bottoms[]" class="form-control content_comment_bottom"><?php echo $comment; ?></textarea>
                                        </div>
                                        <div class="col-xs-3">
                                            <button type="button" class="btn btn-danger delete_comment_bottom">DELETE</button>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="row show-grid">
                                <div class="col-xs-12">
                                    <button type="button" id="add_comment_bottom" class="btn btn-warning">ADD Bottom Comment</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row show-grid">
            <div class="col-xs-4">
                <div class="row show-grid">
                    <div class="col-xs-4">
                        <label class="control-label pull-right">Select Chamber<span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-xs-8">
                        <select id="chamber_id" name="patient[chamber_id]" class="form-control">
                            <?php
                            foreach($chambers as $chamber)
                            {
                                ?>
                                <option value="<?php echo $chamber['value'];?>" <?php if($chamber['value']==$patient['chamber_id']){echo 'selected';} ?>><?php echo $chamber['text']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-4">
                <div class="row show-grid">
                    <div class="col-xs-4">
                        <label class="control-label pull-right">Select Time<span style="color:#FF0000">*</span></label>
                    </div>
                    <div class="col-xs-8">
                        <select id="chamber_id" name="patient[time_id]" class="form-control">
                            <?php
                            foreach($times as $time)
                            {
                                ?>
                                <option value="<?php echo $time['value'];?>" <?php if($time['value']==$patient['time_id']){echo 'selected';} ?>><?php echo $time['text']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-4">
            </div>
        </div>


    </div>

    <div class="clearfix"></div>
</form>
<div id="add_content_cc" style="display: none;">
    <div style="" class="row show-grid">
        <div class="col-xs-9">
            <textarea name="ccs[]" class="form-control content_cc"></textarea>
        </div>
        <div class="col-xs-3">
            <button type="button" class="btn btn-danger delete_cc">DELETE</button>
        </div>
    </div>
</div>
<div id="add_content_oe" style="display: none;">
    <div style="" class="row show-grid">
        <div class="col-xs-9">
            <textarea name="oes[]" class="form-control content_oe"></textarea>
        </div>
        <div class="col-xs-3">
            <button type="button" class="btn btn-danger delete_oe">DELETE</button>
        </div>
    </div>
</div>
<div id="add_content_inv" style="display: none;">
    <div style="" class="row show-grid">
        <div class="col-xs-9">
            <textarea name="invs[]" class="form-control content_inv"></textarea>
        </div>
        <div class="col-xs-3">
            <button type="button" class="btn btn-danger delete_inv">DELETE</button>
        </div>
    </div>
</div>
<div id="add_content_dx" style="display: none;">
    <div style="" class="row show-grid">
        <div class="col-xs-9">
            <textarea name="dxs[]" class="form-control content_dx"></textarea>
        </div>
        <div class="col-xs-3">
            <button type="button" class="btn btn-danger delete_dx">DELETE</button>
        </div>
    </div>
</div>
<div id="add_content_comment_top" style="display: none;">
    <div style="" class="row show-grid">
        <div class="col-xs-9">
            <textarea name="comment_tops[]" class="form-control content_comment_top"></textarea>
        </div>
        <div class="col-xs-3">
            <button type="button" class="btn btn-danger delete_comment_top">DELETE</button>
        </div>
    </div>
</div>
<div id="add_content_comment_bottom" style="display: none;">
    <div style="" class="row show-grid">
        <div class="col-xs-9">
            <textarea name="comment_bottoms[]" class="form-control content_comment_bottom"></textarea>
        </div>
        <div class="col-xs-3">
            <button type="button" class="btn btn-danger delete_comment_bottom">DELETE</button>
        </div>
    </div>
</div>
<div id="add_content_medicine" style="display: none;" data-current-id="<?php echo sizeof($medicines); ?>">
    <div class="row widget medicine_details">
        <div class="widget-header">
            <div class="title">
                <?php echo $CI->lang->line('LABEL_MEDICINE_INFO'); ?>
            </div>

            <button type="button" class="btn btn-danger pull-right delete_medicine"><?php echo $CI->lang->line('DELETE'); ?></button>

            <div class="clearfix"></div>

        </div>
        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_MEDICINE_NAME'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-xs-8">
                <input type="text" id="medicine_name" class="form-control" value="">
            </div>
        </div>
        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_MEDICINE_DAYS'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-xs-4">
                <select id="medicine_days" class="form-control">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                    <option value=Continue>Continue</option>
                    <?php
                    for($i=1;$i<30;$i++)
                    {?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-xs-4">
                <select id="medicine_day_text" class="form-control">
                    <option value="Day">Day(s)</option>
                    <option value="Month">Month(s)</option>
                    <option value="Week">Week(s)</option>
                </select>
            </div>
        </div>
        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_MEDICINE_DESCRIPTION'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-xs-8">
                <textarea id="medicine_description" class="form-control"></textarea>
            </div>
        </div>
        <div class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_MEDICINE_WHEN'); ?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-xs-8">
                <select id="medicine_when"  class="form-control">
                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                    <option value="After Meal" >After Meal</option>
                    <option value="Before Meal" >Before Meal</option>
                </select>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">

    jQuery(document).ready(function()
    {
        turn_off_triggers();
        $(".datepicker").datepicker({dateFormat : display_date_format});
        $(document).on("click", "#add_cc", function(event)
        {
            var html=$('#add_content_cc').html();
            $("#container_cc").append(html);
        });
        $(document).on("click", ".delete_cc", function(event)
        {
            $(this).closest('.show-grid').remove();
        });
        $(document).on("click", "#add_oe", function(event)
        {
            var html=$('#add_content_oe').html();
            $("#container_oe").append(html);
        });
        $(document).on("click", ".delete_oe", function(event)
        {
            $(this).closest('.show-grid').remove();
        });
        $(document).on("click", "#add_inv", function(event)
        {
            var html=$('#add_content_inv').html();
            $("#container_inv").append(html);
        });
        $(document).on("click", ".delete_inv", function(event)
        {
            $(this).closest('.show-grid').remove();
        });
        $(document).on("click", "#add_dx", function(event)
        {
            var html=$('#add_content_dx').html();
            $("#container_dx").append(html);
        });
        $(document).on("click", ".delete_dx", function(event)
        {
            $(this).closest('.show-grid').remove();
        });
        $(document).on("click", "#add_comment_top", function(event)
        {
            var html=$('#add_content_comment_top').html();
            $("#container_comment_top").append(html);
        });
        $(document).on("click", ".delete_comment_top", function(event)
        {
            $(this).closest('.show-grid').remove();
        });
        $(document).on("click", "#add_comment_bottom", function(event)
        {
            var html=$('#add_content_comment_bottom').html();
            $("#container_comment_bottom").append(html);
        });
        $(document).on("click", ".delete_comment_bottom", function(event)
        {
            $(this).closest('.show-grid').remove();
        });

        $(document).on("click", "#add_medicine", function(event)
        {
            var current_id=parseInt($('#add_content_medicine').attr('data-current-id'));
            current_id=current_id+1;
            console.log(current_id);
            $('#add_content_medicine').attr('data-current-id',current_id);
            $('#add_content_medicine #medicine_name').attr('name','medicines['+current_id+'][name]');
            $('#add_content_medicine #medicine_days').attr('name','medicines['+current_id+'][days]');
            $('#add_content_medicine #medicine_day_text').attr('name','medicines['+current_id+'][day_text]');
            $('#add_content_medicine #medicine_description').attr('name','medicines['+current_id+'][description]');
            $('#add_content_medicine #medicine_when').attr('name','medicines['+current_id+'][when]');
            var html=$('#add_content_medicine').html();
            $("#container_medicine").append(html);
        });
        $(document).on("click", ".delete_medicine", function(event)
        {
            console.log('clicked');
            $(this).closest('.medicine_details').remove();
        });

    });
</script>
