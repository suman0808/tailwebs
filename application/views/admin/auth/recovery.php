<?php 
function convert_rgb($hex){
    list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
    return "$r, $g, $b";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Password Recovery</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url().'assets/uploads/meta_info/'.@$this->session->userdata('tailwebs_favicon');?>">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/admin/assets/css/plugins.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/admin/assets/css/authentication/form-1.css" rel="stylesheet" type="text/css">   
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/assets/css/forms/switches.css">
    <link href="<?php echo base_url();?>assets/admin/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>assets/admin/assets/js/loader.js"></script>
    <link href="<?php echo base_url();?>assets/admin/plugins/loaders/custom-loader.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/assets/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        :root{
            --pri-color : <?php echo @$this->session->userdata('tailwebs_pri_color');?>;
            --pri-bg-color : <?php echo @convert_rgb(@$this->session->userdata('tailwebs_pri_color'))?>;
            --sec-color : <?php echo @$this->session->userdata('tailwebs_sec_color');?>;
            --sec-bg-color : <?php echo @convert_rgb(@$this->session->userdata('tailwebs_sec_color'))?>;
        }
        .l-image{
            background-color: rgba(var(--sec-bg-color),0.3) !important;
        }
    </style>
</head>
<body class="form">
    <div id="load_screen" class="primary-bg-light">
        <div class="d-table w-100">
            <div class="d-table-cell" style="vertical-align: middle;height: 100vh;">
                <div class="loader mx-auto" style="height:58px;">
                    <div class="loader-content">
                        <div class="spinner-grow align-self-center primary-bg"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-container">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content" id="recovery_div">
                        <h1 class="">Password Recovery</h1>
                        <p class="signup-link">Enter your email and verification code will sent to you!</p>
                        <form class="text-left" action="" id="recovery_form" method="post" autocomplete="off">
                            <div class="form">
                                <div id="email-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                    <input id="email" name="email" type="email" class="form-control" placeholder="Email">
                                    <span class="text-danger email_msg form_msg"></span>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button class="btn btn-primary primary-btn recovery_btn " type="submit">
                                            <div class="spinner-grow text-white mr-2 align-self-center loader-xs">Please Wait...</div>
                                        Submit</button>
                                    </div>
                                </div>
                                <span class="text-danger main_msg form_msg"></span>
                            </div>
                        </form>                        
                        <p class="terms-conditions">© <?php echo @$this->session->userdata('tailwebs_copyright_year');?> All Rights Reserved. <a href="<?php echo base_url('ad-auth');?>"><?php echo @$this->session->userdata('tailwebs_website_name');?></a>.</p>
                    </div>  
                    <div class="form-content d-none" id="verify_div">
                        <h1 class="">Verify OTP</h1>
                        <p class="signup-link">Enter your verication code and reset your password!</p>
                        <form class="text-left" action="" id="verify_form" method="post" autocomplete="off">
                            <div class="form">
                                <div id="otp-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg>
                                    <div class="d-sm-flex justify-content-between">
                                        <input class="otp_input" id="otp_1" name="otp_1" tabindex="1" type="text" pattern="[0-9]+" maxlength="1" minlength="1">
                                        <input class="otp_input" id="otp_2" name="otp_2" tabindex="2" type="text" pattern="[0-9]+" maxlength="1" minlength="1">
                                        <input class="otp_input" id="otp_3" name="otp_3" tabindex="3" type="text" pattern="[0-9]+" maxlength="1" minlength="1">
                                        <input class="otp_input" id="otp_4" name="otp_4" tabindex="4" type="text" pattern="[0-9]+" maxlength="1" minlength="1">
                                        <input class="otp_input" id="otp_5" name="otp_5" tabindex="5" type="text" pattern="[0-9]+" maxlength="1" minlength="1">
                                        <input class="otp_input" id="otp_6" name="otp_6" tabindex="6" type="text" pattern="[0-9]+" maxlength="1" minlength="1">
                                    </div>
                                    <span class="text-danger otp_msg form_msg"></span>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button class="btn btn-primary primary-btn verify_btn " type="submit">
                                            <div class="spinner-grow text-white mr-2 align-self-center loader-xs">Please Wait...</div>
                                        Verify</button>
                                    </div>
                                </div>
                                <div class="d-sm-flex justify-content-center mt-4">
                                    <div class="field-wrapper">
                                        <a href="javascript:void(0);" class="forgot-pass-link otp">Resent <span></span></a>
                                    </div>
                                </div>
                                <span class="text-danger main_msg form_msg"></span>
                            </div>
                        </form>                        
                        <p class="terms-conditions">© <?php echo @$this->session->userdata('tailwebs_copyright_year');?> All Rights Reserved. <a href="<?php echo base_url('ad-auth');?>"><?php echo @$this->session->userdata('tailwebs_website_name');?></a>.</p>
                    </div>
                    <div class="form-content d-none" id="reset_password_div">
                        <h1 class="">Reset Password</h1>
                        <p class="signup-link">Enter your new password to access your account!</p>
                        <form class="text-left" action="" id="reset_password_form" method="post" autocomplete="off">
                            <div class="form">
                                <div id="new-password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="new-password" type="password" class="form-control" placeholder="Password" minlength="6">
                                    <span class="text-danger new-password_msg form_msg"></span>
                                </div>
                                <div id="confirm-password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    <input id="confirm-password" name="confirm-password" class="form-control" type="text" placeholder="Confirm Password" minlength="6">
                                    <span class="text-danger confirm-password_msg form_msg"></span>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button class="btn btn-primary primary-btn reset_password_btn " type="submit">
                                            <div class="spinner-grow text-white mr-2 align-self-center loader-xs">Please Wait...</div>
                                        Reset</button>
                                    </div>
                                </div>
                                <span class="text-danger main_msg form_msg"></span>
                            </div>
                        </form>                        
                        <p class="terms-conditions">© <?php echo @$this->session->userdata('tailwebs_copyright_year');?> All Rights Reserved. <a href="<?php echo base_url('ad-auth');?>"><?php echo @$this->session->userdata('tailwebs_website_name');?></a>.</p>
                    </div>                       
                </div>
            </div>
        </div>
        <div class="form-image">
            <a class="l-image" href="<?php echo base_url();?>" style="background-image: url(<?php echo base_url().'assets/uploads/meta_info/'.@$this->session->userdata('tailwebs_logo');?>);background-size: 250px auto">
            </a>
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/admin/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/assets/js/authentication/form-1.js"></script>
    <script src="<?php echo base_url();?>assets/admin/plugins/notification/snackbar/snackbar.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/assets/js/components/notification/custom-snackbar.js"></script>
    <script type="text/javascript">
        $("#recovery_form").submit(function(e){
            $(".recovery_btn").addClass('processing');
            $(".form_msg").html('');
            e.stopPropagation();
            e.preventDefault();
            var formdata = $(this).serialize();
            $.ajax({
                method:"post",
                url:"<?php echo base_url('ad-auth-recovery-form');?>",
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
                            $(".recovery_btn").removeClass('processing');
                        }else if(split_data.type == 'success'){
                            Snackbar.show({
                                text: 'Verification code sent successfully',
                                pos: 'bottom-center'
                            });
                            $("#recovery_div,#verify_div").toggleClass('d-none');
                            $(".otp_input").val('');
                            $("#otp_1").focus();
                            $(".recovery_btn").removeClass('processing');
                        }else if(split_data.type == 'redirect'){
                            var link = split_data.link;
                            window.location.href = "<?php echo base_url();?>"+link;
                            $(".recovery_btn").removeClass('processing');
                        }else{
                            Snackbar.show({
                                text: 'Something went wrong!',
                                pos: 'bottom-center'
                            });
                            $(".recovery_btn").removeClass('processing');
                        }
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        $(".recovery_btn").removeClass('processing');
                    }
                },
                error:function(error){
                    Snackbar.show({
                        text: error.status+': '+error.statusText,
                        pos: 'bottom-center'
                    });
                    $(".recovery_btn").removeClass('processing');
                }
            })
        })

        $("#verify_form").submit(function(e){
            $(".verify_btn").addClass('processing');
            $(".form_msg").html('');
            e.stopPropagation();
            e.preventDefault();
            var formdata = $(this).serialize();
            $.ajax({
                method:"post",
                url:"<?php echo base_url('ad-auth-verify-form');?>",
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
                            $(".verify_btn").removeClass('processing');
                        }else if(split_data.type == 'success'){
                            Snackbar.show({
                                text: split_data.msg,
                                pos: 'bottom-center'
                            });
                            $("#verify_div,#reset_password_div").toggleClass('d-none');
                            $(".verify_btn").removeClass('processing');
                        }else if(split_data.type == 'redirect'){
                            var link = split_data.link;
                            window.location.href = "<?php echo base_url();?>"+link;
                            $(".verify_btn").removeClass('processing');
                        }else{
                            Snackbar.show({
                                text: 'Something went wrong!',
                                pos: 'bottom-center'
                            });
                            $(".verify_btn").removeClass('processing');
                        }
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        $(".verify_btn").removeClass('processing');
                    }
                },
                error:function(error){
                    Snackbar.show({
                        text: error.status+': '+error.statusText,
                        pos: 'bottom-center'
                    });
                    $(".verify_btn").removeClass('processing');
                }
            })
        })
        $("#reset_password_form").submit(function(e){
            $(".reset_password_btn").addClass('processing');
            $(".form_msg").html('');
            e.stopPropagation();
            e.preventDefault();
            var formdata = $(this).serialize();
            $.ajax({
                method:"post",
                url:"<?php echo base_url('ad-auth-reset-password-form');?>",
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
                            $(".reset_password_btn").removeClass('processing');
                        }else if(split_data.type == 'redirect'){
                            var link = split_data.link;
                            window.location.href = "<?php echo base_url();?>"+link;
                            $(".reset_password_btn").removeClass('processing');
                        }else{
                            Snackbar.show({
                                text: 'Something went wrong!',
                                pos: 'bottom-center'
                            });
                            $(".reset_password_btn").removeClass('processing');
                        }
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        $(".reset_password_btn").removeClass('processing');
                    }
                },
                error:function(error){
                    Snackbar.show({
                        text: error.status+': '+error.statusText,
                        pos: 'bottom-center'
                    });
                    $(".reset_password_btn").removeClass('processing');
                }
            })
        })
        $(".otp_input").on('keypress',function(event){
            $(this).val('');
            var tabindex = $(this).attr('tabindex');
            setTimeout(function(){
                tabindex++;
                $("#otp_"+tabindex).focus();
            },1)
        })
        $(".otp_input").on('focus',function(event){
            var tabindex = $(this).attr('tabindex');
            tabindex--;
            setTimeout(function(){
                if($("#otp_"+tabindex).val() == '' && tabindex >= 1){
                    $("#otp_"+tabindex).focus();
                } 
            },1)
        })
        $(".otp_input").on('keydown',function(event){
            var tabindex = $(this).attr('tabindex');
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == 8){
                $(this).val('');
                setTimeout(function(){
                    tabindex--;
                    if(tabindex >= 1){
                        $("#otp_"+tabindex).focus();
                    }
                },1)
            }
        })
        $(".otp_input").on('keyup',function(event){
            var otp_input = $(this).val();
            var tabindex = $(this).attr('tabindex');
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == 13){
                if(otp_input != ''){
                    $('#verify_form').submit();
                }
            }else if(keycode == 38 || keycode == 40){
                $("#otp_"+tabindex).val('');
            }else if(keycode == 37){
                tabindex--;
                if(tabindex >= 1){
                    $("#otp_"+tabindex).focus();
                }
            }else if(keycode == 39){
                tabindex++;
                if(tabindex >= 1){
                    $("#otp_"+tabindex).focus();
                }
            }else if(keycode == 8){
                if(otp_input == ''){
                    tabindex--;
                    if(tabindex >= 1){
                        $("#otp_"+tabindex).focus();
                    }
                }
            }else{
                if(otp_input == ' '){
                    otp_input = '';
                    $(this).val('');
                }
                if(otp_input != ''){
                    if(tabindex == 6){
                        $('#verify_form').submit();
                    }
                }
            }
        })
        let timerOn = false;
        $(".otp").click(function(){
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('ad-auth-send'); ?>',
                data:{},
                success: function(datas){
                    if(datas == 'success'){
                        Snackbar.show({
                            text: 'Verification code has been re-sent successfully',
                            pos: 'bottom-center'
                        });
                        $(".otp").addClass('disabled');
                        $(".otp_input").val('');
                        $("#otp_1").focus();
                        timerOn = true;
                        timer(120);
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        timerOn = false;
                        $(".otp").removeClass('disabled').find('span').empty();
                    }
                },
                error:function(error){
                    Snackbar.show({
                        text: error.status+': '+error.statusText,
                        pos: 'bottom-center'
                    });
                    timerOn = false;
                    $(".otp").removeClass('disabled').find('span').empty();
                }
            })
        })
        function timer(remaining) {
            var m = Math.floor(remaining / 60);
            var s = remaining % 60;
            m = m < 10 ? '0' + m : m;
            s = s < 10 ? '0' + s : s;
            $(".otp span").html('('+m + ':' + s+')');
            remaining -= 1;
            if(remaining >= 0 && timerOn) {
                setTimeout(function() {
                    timer(remaining);
                }, 1000);
                return;
            }else{
                $(".otp").removeClass('disabled').find('span').empty();
            }
            if(!timerOn) {
                return;
            }
        }
    </script>
</body>
</html>