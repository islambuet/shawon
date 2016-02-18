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
    <input type="hidden" id="id" name="id" value="<?php echo $user['id']; ?>" />
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
                                Credentials</a>
                        </h4>
                    </div>
                    <div id="collapse1" class="panel-collapse collapse in">
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_EMPLOYEE_ID');?><span style="color:#FF0000">*</span></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <?php
                                if($user['id']==0)
                                {
                                   ?>
                                    <input type="text" name="user[employee_id]" id="employee_id" class="form-control" value="<?php echo $user['employee_id'];?>"/>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <label class="control-label"><?php echo $user['employee_id'];?></label>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_USERNAME');?><span style="color:#FF0000">*</span></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <?php
                                if($user['id']==0)
                                {
                                    ?>
                                    <input type="text" name="user[user_name]" id="user_name" class="form-control" value="<?php echo $user['user_name'];?>"/>
                                <?php
                                }
                                else
                                {
                                    ?>
                                    <label class="control-labe"><?php echo $user['user_name'];?></label>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="external" data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                Employee Type, Designation and Office</a>
                        </h4>
                    </div>
                    <div id="collapse2" class="panel-collapse collapse">

                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_OFFICE_NAME');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <select id="office_id" name="user_info[office_id]" class="form-control">
                                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                    <?php
                                    foreach($offices as $office)
                                    {?>
                                        <option value="<?php echo $office['value']?>" <?php if($office['value']==$user_info['office_id']){ echo "selected";}?>><?php echo $office['text'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_DESIGNATION_NAME');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <select id="designation" name="user_info[designation]" class="form-control">
                                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                    <?php
                                    foreach($designations as $designation)
                                    {?>
                                        <option value="<?php echo $designation['value']?>" <?php if($designation['value']==$user_info['designation']){ echo "selected";}?>><?php echo $designation['text'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_USER_TYPE');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <select id="user_type_id" name="user_info[user_type_id]" class="form-control">
                                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                    <?php
                                    foreach($user_types as $user_type)
                                    {?>
                                        <option value="<?php echo $user_type['value']?>" <?php if($user_type['value']==$user_info['user_type_id']){ echo "selected";}?>><?php echo $user_type['text'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_USER_GROUP');?><span style="color:#FF0000">*</span></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <select id="user_group" name="user_info[user_group]" class="form-control">
                                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                    <?php
                                    foreach($user_groups as $user_group)
                                    {?>
                                        <option value="<?php echo $user_group['value']?>" <?php if($user_group['value']==$user_info['user_group']){ echo "selected";}?>><?php echo $user_group['text'];?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="external" data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                Employee Personal Information</a>
                        </h4>
                    </div>
                    <div id="collapse3" class="panel-collapse collapse">
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_NAME');?><span style="color:#FF0000">*</span></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <input type="text" name="user_info[name]" id="name" class="form-control" value="<?php echo $user_info['name'];?>"/>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_FATHER_NAME');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <input type="text" name="user_info[father_name]" id="father_name" class="form-control" value="<?php echo $user_info['father_name'];?>"/>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_MOTHER_NAME');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <input type="text" name="user_info[mother_name]" id="mother_name" class="form-control" value="<?php echo $user_info['mother_name'];?>"/>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_DATE_BIRTH');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <input type="text" name="user_info[date_birth]" id="date_birth" class="form-control dob" value="<?php echo System_helper::display_date($user_info['date_birth']);?>"/>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_GENDER');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <div class="radio-inline">
                                    <label><input type="radio" value="Male" <?php if($user_info['gender']=='Male'){echo 'checked';} ?> name="user_info[gender]">Male</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" value="Female" <?php if($user_info['gender']=='Female'){echo 'checked';} ?> name="user_info[gender]">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_MARITAL_STATUS');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <div class="radio-inline">
                                    <label><input type="radio" value="Married" <?php if($user_info['status_marital']=='Married'){echo 'checked';} ?> name="user_info[status_marital]">Married</label>
                                </div>
                                <div class="radio-inline">
                                    <label><input type="radio" value="Un-Married" <?php if($user_info['status_marital']=='Un-Married'){echo 'checked';} ?> name="user_info[status_marital]">Un-Married</label>
                                </div>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_SPOUSE_NAME');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <input type="text" name="user_info[spouse_name]" id="spouse_name" class="form-control" value="<?php echo $user_info['spouse_name'];?>"/>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_NID');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <input type="text" name="user_info[nid]" id="nid" class="form-control" value="<?php echo $user_info['nid'];?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="external" data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                Address</a>
                        </h4>
                    </div>
                    <div id="collapse4" class="panel-collapse collapse">
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_ADDRESS_PRESENT');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <textarea class="form-control" name="user_info[address_present]"><?php echo $user_info['address_present'];?></textarea>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_ADDRESS_PERMANENT');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <textarea class="form-control" name="user_info[address_permanent]"><?php echo $user_info['address_permanent'];?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="external" data-toggle="collapse" data-parent="#accordion" href="#collapse5">
                                Join and Salary Info</a>
                        </h4>
                    </div>
                    <div id="collapse5" class="panel-collapse collapse">
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_DATE_JOIN');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <input type="text" name="user_info[date_join]" id="date_join" class="form-control dob" value="<?php echo System_helper::display_date($user_info['date_join']);?>"/>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_SALARY_BASIC');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <input type="text" name="user_info[salary_basic]" id="salary_basic" class="form-control" value="<?php echo $user_info['salary_basic'];?>"/>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_SALARY_OTHER');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <input type="text" name="user_info[salary_other]" id="salary_other" class="form-control" value="<?php echo $user_info['salary_other'];?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="external" data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                                Contact Info</a>
                        </h4>
                    </div>
                    <div id="collapse6" class="panel-collapse collapse">
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $this->lang->line('LABEL_BLOOD_GROUP');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <select id="blood_group" name="user_info[blood_group]" class="form-control">
                                    <option value=""><?php echo $this->lang->line('SELECT');?></option>
                                    <option value="A+" <?php if($user_info['blood_group']=='A+'){ echo "selected";}?>>A+</option>
                                    <option value="A-" <?php if($user_info['blood_group']=='A-'){ echo "selected";}?>>A-</option>
                                    <option value="AB+" <?php if($user_info['blood_group']=='AB+'){ echo "selected";}?>>AB+</option>
                                    <option value="AB-" <?php if($user_info['blood_group']=='AB-'){ echo "selected";}?>>AB-</option>
                                    <option value="B+" <?php if($user_info['blood_group']=='B+'){ echo "selected";}?>>B+</option>
                                    <option value="B-" <?php if($user_info['blood_group']=='B-'){ echo "selected";}?>>B-</option>
                                    <option value="O+" <?php if($user_info['blood_group']=='O+'){ echo "selected";}?>>O+</option>
                                    <option value="O-" <?php if($user_info['blood_group']=='O-'){ echo "selected";}?>>O-</option>
                                </select>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_MOBILE_NO');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <input type="text" name="user_info[mobile_no]" id="mobile_no" class="form-control" value="<?php echo $user_info['mobile_no'];?>"/>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_TEL_NO');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <input type="text" name="user_info[tel_no]" id="tel_no" class="form-control" value="<?php echo $user_info['tel_no'];?>"/>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_CONTACT_PERSON');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <input type="text" name="user_info[contact_person]" id="contact_person" class="form-control" value="<?php echo $user_info['contact_person'];?>"/>
                            </div>
                        </div>
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_CONTACT_NO');?></label>
                            </div>
                            <div class="col-sm-4 col-xs-8">
                                <input type="text" name="user_info[contact_no]" id="contact_no" class="form-control" value="<?php echo $user_info['contact_no'];?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a class="external" data-toggle="collapse" data-parent="#accordion" href="#collapse7">
                                Profile Picture</a>
                        </h4>
                    </div>
                    <div id="collapse7" class="panel-collapse collapse">
                        <div class="row show-grid">
                            <div class="col-xs-4">
                                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_PROFILE_PICTURE');?></label>
                            </div>
                            <div class="col-xs-4">
                                <input type="file" class="browse_button" data-preview-container="#image_profile" name="image_profile">
                                <input type="hidden" name="user_info[picture_profile]" value="<?php echo $user_info['picture_profile']; ?>">
                            </div>
                            <div class="col-xs-4" id="image_profile">
                                <img style="max-width: 250px;" src="<?php echo $user_info['picture_profile']; ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div style="" class="row show-grid">
            <div class="col-xs-4">
                <label class="control-label pull-right"><?php echo $CI->lang->line('LABEL_ORDER');?><span style="color:#FF0000">*</span></label>
            </div>
            <div class="col-sm-4 col-xs-8">
                <input type="text" name="user_info[ordering]" id="ordering" class="form-control" value="<?php echo $user_info['ordering'] ?>" >
            </div>
        </div>

    </div>

    <div class="clearfix"></div>
</form>
<script type="text/javascript">

    jQuery(document).ready(function()
    {
        turn_off_triggers();
        $(".datepicker").datepicker({dateFormat : display_date_format});
        $(".dob").datepicker({dateFormat : display_date_format,changeMonth: true,changeYear: true,yearRange: "-50:+0"});
        $(":file").filestyle({input: false,buttonText: "<?php echo $CI->lang->line('UPLOAD');?>", buttonName: "btn-danger"});

    });
</script>
