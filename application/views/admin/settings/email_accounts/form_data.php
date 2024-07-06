<form id="email_account_form" class="section general-info floating-form" autocomplete="off">
    <div class="info">
        <a href="javascript:void(0)" onclick="callback_website_form_page('email_accounts')" class="mb-3 d-block sticky-top bg-white py-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        </a>
        <div class="row">
            <div class="col-12 mt-md-0 mt-4">
                <div class="form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="email_type" id="email_type">
                                    <option value="default" <?php if(@set_value('email_type',@$editrow->email_type) == 'default'){echo 'selected';}?>>Default</option>
                                    <option value="otp" <?php if(@set_value('email_type',@$editrow->email_type) == 'otp'){echo 'selected';}?>>OTP</option>
                                    <option value="order status" <?php if(@set_value('email_type',@$editrow->email_type) == 'order status'){echo 'selected';}?>>Order Status</option>
                                    <option value="email communication" <?php if(@set_value('email_type',@$editrow->email_type) == 'email communication'){echo 'selected';}?>>Email Communication</option>
                                    <option value="notification" <?php if(@set_value('email_type',@$editrow->email_type) == 'notification'){echo 'selected';}?>>Notification</option>
                                </select>
                                <label for="email_type" class="form-label">Email Type *</label>
                                <span class="text-danger email_type_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo @$editrow->email;?>" maxlength="255">
                                <label for="email" class="form-label">Email *</label>
                                <span class="text-danger email_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo @$editrow->username;?>" maxlength="255">
                                <label for="username" class="form-label">Username *</label>
                                <span class="text-danger username_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select class="form-control" name="smtp_status" id="smtp_status" onchange="callback_smtp_status();">
                                    <option value="0" <?php if(!@set_value('smtp_status',@$editrow->smtp_status)){echo 'selected';}?>>Disable</option>
                                    <option value="1" <?php if(@set_value('smtp_status',@$editrow->smtp_status)){echo 'selected';}?>>Enable</option>
                                </select>
                                <label for="smtp_status" class="form-label">SMTP Status *</label>
                                <span class="text-danger smtp_status_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4 smtp_input_div">
                            <div class="form-group">
                                <input type="text" class="form-control" id="smtp_host" name="smtp_host" value="<?php echo @$editrow->smtp_host;?>" maxlength="255">
                                <label for="smtp_host" class="form-label">SMTP Host *</label>
                                <span class="text-danger smtp_host_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4 smtp_input_div">
                            <div class="form-group">
                                <input type="email" class="form-control" id="smtp_user" name="smtp_user" value="<?php echo @$editrow->smtp_user;?>" maxlength="255">
                                <label for="smtp_user" class="form-label">SMTP User *</label>
                                <span class="text-danger smtp_user_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4 smtp_input_div">
                            <div class="form-group">
                                <input type="text" class="form-control" id="smtp_pass" name="smtp_pass" value="<?php echo @$editrow->smtp_pass;?>" maxlength="255">
                                <label for="smtp_pass" class="form-label">SMTP Password *</label>
                                <span class="text-danger smtp_pass_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4 smtp_input_div">
                            <div class="form-group">
                                <select class="form-control" name="smtp_port" id="smtp_port">
                                    <option value="25" <?php if(@set_value('smtp_port',@$editrow->smtp_port) == '25'){echo 'selected';}?>>25</option>
                                    <option value="2525" <?php if(@set_value('smtp_port',@$editrow->smtp_port) == '2525'){echo 'selected';}?>>2525</option>
                                    <option value="465" <?php if(@set_value('smtp_port',@$editrow->smtp_port) == '465'){echo 'selected';}?>>465</option>
                                    <option value="587" <?php if(@set_value('smtp_port',@$editrow->smtp_port) == '587'){echo 'selected';}?>>587</option>
                                </select>
                                <label for="smtp_port" class="form-label">SMTP Port *</label>
                                <span class="text-danger smtp_port_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4 smtp_input_div">
                            <div class="form-group">
                                <select class="form-control" name="smtp_crypto" id="smtp_crypto">
                                    <option value="auto" <?php if(@set_value('smtp_crypto',@$editrow->smtp_crypto) == 'auto'){echo 'selected';}?>>Auto</option>
                                    <option value="none" <?php if(@set_value('smtp_crypto',@$editrow->smtp_crypto) == 'none'){echo 'selected';}?>>None</option>
                                    <option value="ssl" <?php if(@set_value('smtp_crypto',@$editrow->smtp_crypto) == 'ssl'){echo 'selected';}?>>SSL</option>
                                    <option value="starttls" <?php if(@set_value('smtp_crypto',@$editrow->smtp_crypto) == 'starttls'){echo 'selected';}?>>STARTTLS</option>
                                </select>
                                <label for="smtp_crypto" class="form-label">SMTP Security *</label>
                                <span class="text-danger smtp_crypto_msg form_msg"></span>
                            </div>
                        </div>
                        <input type="hidden" name="ea_id" value="<?php echo @$editrow->ea_id; ?>">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-xl-12">        
                <div class="field-wrapper">
                    <button class="btn btn-primary primary-btn email-account_btn " type="submit">
                        <div class="spinner-grow text-white mr-2 align-self-center loader-xs">Please Wait...</div>
                    Submit</button>
                    <button class="btn btn-dark dark-btn email-account_btn " type="button" onclick="callback_website_form_page('email_accounts');">
                        <div class="spinner-grow text-white mr-2 align-self-center loader-xs">Please Wait...</div>
                    Cancel</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    function callback_smtp_status() {
        if($("#smtp_status").val() == 0){
            $(".smtp_input_div").addClass('d-none');
        }else{
            $(".smtp_input_div").removeClass('d-none');
        }
    }
    callback_smtp_status();
    $("#email_account_form").submit(function(e){
        $(".email-account_btn").addClass('processing');
        $("#load_screen").removeClass('d-none');
        $(".form_msg").html('');
        e.stopPropagation();
        e.preventDefault();
        var formdata = $(this).serialize();
        $.ajax({
            method:"post",
            url:"<?php echo base_url('ad-email-account-form');?>",
            data:formdata,
            success:function(datas){
                var split_data = $.parseJSON(datas);
                if(typeof split_data !== undefined && split_data !='' && split_data !=null) {
                    if(split_data.type == 'error'){
                        var field_error_array = split_data.field_error;
                        if(split_data.msg != undefined && split_data.msg !='' && split_data.msg != null){
                            Snackbar.show({
                                text: split_data.msg,
                                pos: 'bottom-center'
                            });
                        }else if(typeof field_error_array !== undefined && field_error_array !='' && field_error_array !=null){
                            if(field_error_array.length > 0){
                                for(var i = 0; i < field_error_array.length; i++) {
                                    var field_array = field_error_array[i].split('||');
                                    $("."+field_array[0]).html(field_array[1]);
                                }
                            }else{
                                Snackbar.show({
                                    text: 'Something went wrong!',
                                    pos: 'bottom-center'
                                });
                            }
                        }else{
                            Snackbar.show({
                                text: 'Something went wrong!',
                                pos: 'bottom-center'
                            });
                        }
                        $(".email-account_btn").removeClass('processing');
                        $("#load_screen").addClass('d-none');
                    }else if(split_data.type == 'redirect'){
                        var link = split_data.link;
                        window.location.href = "<?php echo base_url();?>"+link;
                    }else if(split_data.type == 'added'){
                        Snackbar.show({
                            text: 'Account added successfully',
                            pos: 'bottom-center'
                        });
                        callback_website_form_page('email_accounts');
                        $("#load_screen").addClass('d-none');
                    }else if(split_data.type == 'updated'){
                        Snackbar.show({
                            text: 'Account updated successfully',
                            pos: 'bottom-center'
                        });
                        callback_website_form_page('email_accounts');
                        $("#load_screen").addClass('d-none');
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        $(".email-account_btn").removeClass('processing');
                        $("#load_screen").addClass('d-none');
                    }
                }else{
                    Snackbar.show({
                        text: 'Something went wrong!',
                        pos: 'bottom-center'
                    });
                    $(".email-account_btn").removeClass('processing');
                    $("#load_screen").addClass('d-none');
                }
            },
            error:function(error){
                Snackbar.show({
                    text: error.status+': '+error.statusText,
                    pos: 'bottom-center'
                });
                $(".email-account_btn").removeClass('processing');
                $("#load_screen").addClass('d-none');
            }
        })
    })
</script>