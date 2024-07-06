<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/plugins/dropify/dropify.min.css">
<link href="<?php echo base_url();?>assets/admin/assets/css/users/account-setting.css" rel="stylesheet" type="text/css">
<div id="content" class="main-content">
    <div class="layout-px-spacing">                
        <div class="account-settings-container layout-top-spacing">
            <div class="account-content">
                <div class="scrollspy-example" data-spy="scroll" data-target="#account-settings-scroll" data-offset="-100">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form id="profile-form" class="section general-info floating-form" autocomplete="off">
                                <div class="info">
                                    <h6 class="">Profile Information</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div class="col-xl-2 col-lg-12 col-md-4">
                                                    <div class="upload pr-md-4" style="max-width:140px;position: relative;">
                                                        <?php if(@$editrow->profile_image){?>
                                                            <a href="javascript:void(0);" onclick="callback_remove_upload_image('profile_image','image_removed')" id="profile_image_remove_btn" class="btn btn-xs btn-danger" style="position: absolute;top: 0;right: 24px;z-index: 100;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
                                                        <?php }?>
                                                        <input type="file" id="profile_image" class="dropify" <?php if(@$editrow->profile_image){?>data-default-file="<?php echo base_url('assets/uploads/customers/'.@$editrow->profile_image);?>"<?php }?> name="profile_image" accept=".jpg,.jpeg,.png">
                                                        <span class="text-danger profile_image_msg form_msg"></span>
                                                        <input type="hidden" name="profile_image_old" value="<?php echo @$editrow->profile_image;?>">
                                                        <input type="hidden" name="image_removed" id="image_removed">
                                                    </div>
                                                </div>
                                                <div class="col-xl-10 col-lg-12 col-md-8 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo @$editrow->fullname;?>">
                                                                    <label for="fullname" class="form-label">Full Name *</label>
                                                                    <span class="text-danger fullname_msg form_msg"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo @$editrow->username;?>">
                                                                    <label for="username" class="form-label">Username *</label>
                                                                    <span class="text-danger username_msg form_msg"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="email" name="email" value="<?php echo @$editrow->email;?>">
                                                            <label for="email" class="form-label">Email *</label>
                                                            <span class="text-danger email_msg form_msg"></span>
                                                        </div>
                                                        <div class="hr-line-dashed"></div>
                                                        <div class="field-wrapper">
                                                            <button class="btn btn-primary primary-btn profile_btn " type="submit">
                                                                <div class="spinner-grow text-white mr-2 align-self-center loader-xs">Please Wait...</div>
                                                            Update Profile</button>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="admin_id" value="<?php echo @$this->session->userdata('tailwebs_admin_id');?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                            <form id="password-form" class="section general-info floating-form" autocomplete="off">
                                <div class="info">
                                    <h6 class="">Change Password</h6>
                                    <div class="row">
                                        <div class="col-lg-11 mx-auto">
                                            <div class="row">
                                                <div class="col-12 mt-md-0 mt-4">
                                                    <div class="form">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="password" class="form-control" id="current-password" name="current-password">
                                                                    <label for="current-password" class="form-label">Current Password *</label>
                                                                    <span class="text-danger current-password_msg form_msg"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="password" class="form-control" id="new-password" name="new-password" minlength="6">
                                                                    <label for="new-password" class="form-label">New Password *</label>
                                                                    <span class="text-danger new-password_msg form_msg"></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="confirm-password" name="confirm-password" minlength="6">
                                                                    <label for="confirm-password" class="form-label">Confirm Password *</label>
                                                                    <span class="text-danger confirm-password_msg form_msg"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="hr-line-dashed"></div>
                                                </div>
                                                <div class="col-xl-12">        
                                                    <div class="field-wrapper">
                                                        <button class="btn btn-primary primary-btn password_btn " type="submit">
                                                            <div class="spinner-grow text-white mr-2 align-self-center loader-xs">Please Wait...</div>
                                                        Update Password</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>assets/admin/plugins/dropify/dropify.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/blockui/jquery.blockUI.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/assets/js/users/account-settings.js"></script>
<script type="text/javascript">
    $("#profile-form").submit(function(e){
        $(".profile_btn").addClass('processing');
        $(".form_msg").html('');
        e.stopPropagation();
        e.preventDefault();
        var form = $(this)[0];
        var formdata = new FormData(form);
        $.ajax({
            method:"post",
            url:"<?php echo base_url('ad-profile-form');?>",
            data:formdata,
            cache: false,
            contentType: false,
            processData: false,
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
                        $(".profile_btn").removeClass('processing');
                    }else if(split_data.type == 'redirect'){
                        var link = split_data.link;
                        window.location.href = "<?php echo base_url();?>"+link;
                        $(".profile_btn").removeClass('processing');
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        $(".profile_btn").removeClass('processing');
                    }
                }else{
                    Snackbar.show({
                        text: 'Something went wrong!',
                        pos: 'bottom-center'
                    });
                    $(".profile_btn").removeClass('processing');
                }
            },
            error:function(error){
                Snackbar.show({
                    text: error.status+': '+error.statusText,
                    pos: 'bottom-center'
                });
                $(".profile_btn").removeClass('processing');
            }
        })
    })
    $("#password-form").submit(function(e){
        $(".password_btn").addClass('processing');
        $(".form_msg").html('');
        e.stopPropagation();
        e.preventDefault();
        var formdata = $(this).serialize();
        $.ajax({
            method:"post",
            url:"<?php echo base_url('ad-password-form');?>",
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
                        $(".password_btn").removeClass('processing');
                    }else if(split_data.type == 'redirect'){
                        var link = split_data.link;
                        window.location.href = "<?php echo base_url();?>"+link;
                        $(".password_btn").removeClass('processing');
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        $(".password_btn").removeClass('processing');
                    }
                }else{
                    Snackbar.show({
                        text: 'Something went wrong!',
                        pos: 'bottom-center'
                    });
                    $(".password_btn").removeClass('processing');
                }
            },
            error:function(error){
                Snackbar.show({
                    text: error.status+': '+error.statusText,
                    pos: 'bottom-center'
                });
                $(".password_btn").removeClass('processing');
            }
        })
    })
    function callback_remove_upload_image(imageid,removeid) {
        var drDestroy = $('#'+imageid).dropify({
            defaultFile: '',
        });
        drDestroy = drDestroy.data('dropify');
        drDestroy.settings.defaultFile = '';
        drDestroy.destroy();
        drDestroy.init();
        $("#"+removeid).val(1);
        $("#"+imageid+"_remove_btn").addClass('d-none');
    }
</script>