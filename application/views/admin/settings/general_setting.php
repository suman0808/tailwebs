<form id="general-setting-form" class="section general-info floating-form" autocomplete="off">
    <div class="info">
        <div class="row">
            <div class="col-12 mt-md-0 mt-4">
                <div class="form">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 <?php if(@$this->session->userdata('tailwebs_admin_type') > 1){echo 'd-none';}?>">
                            <div class="form-group">
                                <input type="color" class="form-control" id="pri_color" name="pri_color" value="<?php echo @$editrow->pri_color?:'#4361ee';?>">
                                <label for="pri_color" class="form-label">Primary Color *</label>
                                <span class="text-danger pri_color_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 <?php if(@$this->session->userdata('tailwebs_admin_type') > 1){echo 'd-none';}?>">
                            <div class="form-group">
                                <input type="color" class="form-control" id="sec_color" name="sec_color" value="<?php echo @$editrow->sec_color?:'#304aca';?>">
                                <label for="sec_color" class="form-label">Secondary Color *</label>
                                <span class="text-danger sec_color_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 <?php if(@$this->session->userdata('tailwebs_admin_type') != 1){echo 'd-none';}?>">
                            <div class="form-group">
                                <select class="form-control" name="website_status" id="website_status" onchange="callback_website_status();">
                                    <option value="0" <?php if(!@set_value('website_status',@$editrow->website_status)){echo 'selected';}?>>Live</option>
                                    <option value="1" <?php if(@set_value('website_status',@$editrow->website_status) == 1){echo 'selected';}?>>Under Maintenance</option>
                                    <option value="2" <?php if(@set_value('website_status',@$editrow->website_status) == 2){echo 'selected';}?>>Coming Soon</option>
                                </select>
                                <label for="website_status" class="form-label">Website Status *</label>
                                <span class="text-danger website_status_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 launch_datetime_div <?php if(@$this->session->userdata('tailwebs_admin_type') != 1){echo 'd-none';}?>">
                            <div class="form-group">
                                <input type="text" class="form-control" id="launch_datetime" name="launch_datetime" value="<?php echo @$editrow->launch_datetime;?>">
                                <label for="launch_datetime" class="form-label">Launch Date & Time *</label>
                                <span class="text-danger launch_datetime_msg form_msg"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="gs_id" value="<?php echo @$editrow->gs_id; ?>">
            <div class="col-12">
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-xl-12">        
                <div class="field-wrapper">
                    <button class="btn btn-primary primary-btn general-setting_btn " type="submit">
                        <div class="spinner-grow text-white mr-2 align-self-center loader-xs">Please Wait...</div>
                    Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    var f2 = flatpickr(document.getElementById('launch_datetime'), {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
    });
    function callback_website_status() {
        $(".launch_datetime_div").addClass('d-none');
        if($("#website_status").val() == 2){
            <?php if(@$this->session->userdata('tailwebs_admin_type')){?>
                $(".launch_datetime_div").removeClass('d-none');
            <?php }?>
        }
    }
    callback_website_status();
    $("#general-setting-form").submit(function(e){
        $(".general-setting_btn").addClass('processing');
        $(".form_msg").html('');
        e.stopPropagation();
        e.preventDefault();
        var formdata = $(this).serialize();
        $.ajax({
            method:"post",
            url:"<?php echo base_url('ad-general-setting-form');?>",
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
                        $(".general-setting_btn").removeClass('processing');
                    }else if(split_data.type == 'redirect'){
                        var link = split_data.link;
                        window.location.href = "<?php echo base_url();?>"+link;
                    }else if(split_data.type == 'success'){
                        Snackbar.show({
                            text: 'Settings updated successfully',
                            pos: 'bottom-center'
                        });
                        callback_website_form_page('general_setting');
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        $(".general-setting_btn").removeClass('processing');
                    }
                }else{
                    Snackbar.show({
                        text: 'Something went wrong!',
                        pos: 'bottom-center'
                    });
                    $(".general-setting_btn").removeClass('processing');
                }
            },
            error:function(error){
                Snackbar.show({
                    text: error.status+': '+error.statusText,
                    pos: 'bottom-center'
                });
                $(".general-setting_btn").removeClass('processing');
            }
        })
    })
</script>