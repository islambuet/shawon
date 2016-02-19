<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
$CI = & get_instance();
$action_data=array();
$action_data["action_back"]=base_url($CI->controller_url);
$action_data["action_save"]='#save_form';
$action_data["action_save_new"]='#save_form';
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

        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="external" data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                            Patient's Info</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                    <div class="row show-grid">
                        <div class="col-xs-4">
                            <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_NAME');?><span style="color:#FF0000">*</span></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <input type="text" name="patient[name]" id="name" class="form-control" value="<?php echo $patient['name'];?>"/>
                        </div>
                    </div>
                    <div class="row show-grid">
                        <div class="col-xs-4">
                            <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_AGE');?><span style="color:#FF0000">*</span></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <input type="text" name="patient[age]" id="age" class="form-control" value="<?php echo $patient['age'];?>"/>
                        </div>
                    </div>
                    <div class="row show-grid">
                        <div class="col-xs-4">
                            <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_SEX');?></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <select id="sex" name="patient[sex]" class="form-control">
                                <option value="Male" <?php if($patient['sex']=='Male'){ echo "selected";}?>>Male</option>
                                <option value="Female" <?php if($patient['sex']=='Female'){ echo "selected";}?>>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="row show-grid">
                        <div class="col-xs-4">
                            <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_DATE');?></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <input type="text" name="patient[date_prescription]" id="date_prescription" class="form-control datepicker" value="<?php echo System_helper::display_date($patient['date_prescription']);?>"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="external" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                            C/C</a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div  id="container_cc">
                        <?php
                        foreach($ccs as $cc)
                        {
                            ?>
                            <div style="" class="row show-grid">
                                <div class="col-xs-9">
                                    <input type="text" name="ccs[]" class="form-control content_cc" value="<?php echo $cc; ?>"/>
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
                            <button type="button" id="add_cc" class="btn btn-warning">ADD</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="external" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                            O/E</a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                    <div  id="container_oe">
                        <?php
                        foreach($oes as $oe)
                        {
                            ?>
                            <div style="" class="row show-grid">
                                <div class="col-xs-9">
                                    <input type="text" name="oes[]" class="form-control content_oe" value="<?php echo $oe; ?>"/>
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
                            <button type="button" id="add_oe" class="btn btn-warning">ADD</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="external" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                            Inv</a>
                    </h4>
                </div>
                <div id="collapse4" class="panel-collapse collapse">
                    <div  id="container_inv">
                        <?php
                        foreach($invs as $inv)
                        {
                            ?>
                            <div style="" class="row show-grid">
                                <div class="col-xs-9">
                                    <input type="text" name="invs[]" class="form-control content_inv" value="<?php echo $inv; ?>"/>
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
                            <button type="button" id="add_inv" class="btn btn-warning">ADD</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="external" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                            Dx</a>
                    </h4>
                </div>
                <div id="collapse5" class="panel-collapse collapse">
                    <div  id="container_dx">
                        <?php
                        foreach($dxs as $dx)
                        {
                            ?>
                            <div style="" class="row show-grid">
                                <div class="col-xs-9">
                                    <input type="text" name="dxs[]" class="form-control content_dx" value="<?php echo $dx; ?>"/>
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
                            <button type="button" id="add_dx" class="btn btn-warning">ADD</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="external" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                            Comments</a>
                    </h4>
                </div>
                <div id="collapse6" class="panel-collapse collapse">
                    <div class="row show-grid">
                        <div class="col-xs-4">
                            <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_COMMENT_TOP');?></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <textarea name="comment_top" class="form-control"><?php echo $comment_top; ?></textarea>
                        </div>
                    </div>
                    <div class="row show-grid">
                        <div class="col-xs-4">
                            <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_COMMENT_BOTTOM');?></label>
                        </div>
                        <div class="col-sm-4 col-xs-8">
                            <textarea name="comment_bottom" class="form-control"><?php echo $comment_bottom; ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a class="external" data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                            Medicines</a>
                    </h4>
                </div>
                <div id="collapse7" class="panel-collapse collapse">
                    <div id="container_medicine">

                    </div>
                    <div class="row show-grid">
                        <div class="col-xs-12">
                            <button type="button" id="add_medicine" class="btn btn-warning">ADD</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="clearfix"></div>
</form>
<div id="add_content_cc" style="display: none;">
    <div style="" class="row show-grid">
        <div class="col-xs-9">
            <input type="text" name="ccs[]" class="form-control content_cc" value=""/>
        </div>
        <div class="col-xs-3">
            <button type="button" class="btn btn-danger delete_cc">DELETE</button>
        </div>
    </div>
</div>
<div id="add_content_oe" style="display: none;">
    <div style="" class="row show-grid">
        <div class="col-xs-9">
            <input type="text" name="oes[]" class="form-control content_oe" value=""/>
        </div>
        <div class="col-xs-3">
            <button type="button" class="btn btn-danger delete_oe">DELETE</button>
        </div>
    </div>
</div>
<div id="add_content_inv" style="display: none;">
    <div style="" class="row show-grid">
        <div class="col-xs-9">
            <input type="text" name="invs[]" class="form-control content_inv" value=""/>
        </div>
        <div class="col-xs-3">
            <button type="button" class="btn btn-danger delete_inv">DELETE</button>
        </div>
    </div>
</div>
<div id="add_content_dx" style="display: none;">
    <div style="" class="row show-grid">
        <div class="col-xs-9">
            <input type="text" name="dxs[]" class="form-control content_dx" value=""/>
        </div>
        <div class="col-xs-3">
            <button type="button" class="btn btn-danger delete_dx">DELETE</button>
        </div>
    </div>
</div>
<div id="add_content_medicine" style="display: none;">
    <div class="row show-grid">
        <div class="col-xs-4">
            <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_NAME');?><span style="color:#FF0000">*</span></label>
        </div>
        <div class="col-sm-4 col-xs-8">
            <input type="text" name="patient[name]" id="name" class="form-control" value="<?php echo $patient['name'];?>"/>
        </div>
    </div>
    <div class="row show-grid">
        <div class="col-xs-4">
            <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_NAME');?><span style="color:#FF0000">*</span></label>
        </div>
        <div class="col-sm-4 col-xs-8">
            <input type="text" name="patient[name]" id="name" class="form-control" value="<?php echo $patient['name'];?>"/>
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

        $(document).on("click", "#add_medicine", function(event)
        {
            var html=$('#add_content_medicine').html();
            $("#container_medicine").append(html);
        });
        $(document).on("click", ".delete_medicine", function(event)
        {
            //$(this).closest('.show-grid').remove();
        });

    });
</script>
