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
    <title>Request Demo</title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url().'assets/uploads/meta_info/'.@$this->session->userdata('traceqlabs_favicon');?>">
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
            --pri-color : <?php echo @$this->session->userdata('traceqlabs_pri_color');?>;
            --pri-bg-color : <?php echo @convert_rgb(@$this->session->userdata('traceqlabs_pri_color'))?>;
            --sec-color : <?php echo @$this->session->userdata('traceqlabs_sec_color');?>;
            --sec-bg-color : <?php echo @convert_rgb(@$this->session->userdata('traceqlabs_sec_color'))?>;
        }
        .l-image{
            background-color: rgba(var(--sec-bg-color),0.3) !important;
        }
        .swal-text, .swal-footer{
            text-align: center;
        }
        .swal-overlay--show-modal{
            z-index: 9999999
        }
        .swal-icon img{
            width: 80px;
            display: initial;
        }
        .swal-button--cancel{
            display: none;
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
                    <div class="form-content" id="register_div">
                        <h1 class="">Request <span class="brand-name primary-text">Demo</span></h1>
                        <form class="text-left mt-4" action="" id="request_form" method="post" autocomplete="off">
                            <div class="form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="username-field" class="field-wrapper input">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-git-pull-request"><circle cx="18" cy="18" r="3"></circle><circle cx="6" cy="6" r="3"></circle><path d="M13 6h3a2 2 0 0 1 2 2v7"></path><line x1="6" y1="9" x2="6" y2="21"></line></svg>
                                            <input id="username" name="username" type="text" class="form-control" placeholder="Username *" maxlength="30">
                                            <b class="d-inline-block text-dark">.traceqlabs.com</b>
                                            <span class="text-danger username_msg form_msg"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="company_name-field" class="field-wrapper input">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg>
                                            <input id="company_name" name="company_name" type="text" class="form-control" placeholder="Company Name *">
                                            <span class="text-danger company_name_msg form_msg"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="fullname-field" class="field-wrapper input">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                            <input id="fullname" name="fullname" type="text" class="form-control" placeholder="Fullname *">
                                            <span class="text-danger fullname_msg form_msg"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="email-field" class="field-wrapper input">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                            <input id="email" name="email" type="email" class="form-control" placeholder="Email *">
                                            <span class="text-danger email_msg form_msg"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="mobile-field" class="field-wrapper input">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                            <input id="mobile" name="mobile" type="text" class="form-control" placeholder="Mobile *" maxlength="50">
                                            <span class="text-danger mobile_msg form_msg"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button class="btn btn-primary primary-btn submit_btn " type="submit">
                                            <div class="spinner-grow text-white mr-2 align-self-center loader-xs">Please Wait...</div>
                                        Get A Demo</button>
                                    </div>
                                </div>
                                <span class="text-danger main_msg form_msg"></span>
                            </div>
                        </form>                        
                        <p class="terms-conditions">© <?php echo @$this->session->userdata('traceqlabs_copyright_year');?> All Rights Reserved. <a href="<?php echo base_url('');?>"><?php echo @$this->session->userdata('traceqlabs_website_name');?></a>.</p>
                    </div>
                    <div class="form-content d-none" id="verify_div">
                        <h1 class="">Verify OTP</h1>
                        <p class="signup-link">Enter your verication code!</p>
                        <form class="text-left" action="" id="verify_form" method="post" autocomplete="off">
                            <div class="form">
                                <div id="otp-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg>
                                    <div class="d-flex justify-content-between">
                                        <input class="otp_input" id="otp_1" name="otp_1" tabindex="1" type="number" style="-webkit-appearance: none;-moz-appearance: textfield;" min="0" max="9">
                                        <input class="otp_input" id="otp_2" name="otp_2" tabindex="2" type="number" style="-webkit-appearance: none;-moz-appearance: textfield;" min="0" max="9">
                                        <input class="otp_input" id="otp_3" name="otp_3" tabindex="3" type="number" style="-webkit-appearance: none;-moz-appearance: textfield;" min="0" max="9">
                                        <input class="otp_input" id="otp_4" name="otp_4" tabindex="4" type="number" style="-webkit-appearance: none;-moz-appearance: textfield;" min="0" max="9">
                                        <input class="otp_input" id="otp_5" name="otp_5" tabindex="5" type="number" style="-webkit-appearance: none;-moz-appearance: textfield;" min="0" max="9">
                                        <input class="otp_input" id="otp_6" name="otp_6" tabindex="6" type="number" style="-webkit-appearance: none;-moz-appearance: textfield;" min="0" max="9">
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
                                <input type="hidden" name="register_status" value="1">
                            </div>
                        </form>                        
                        <p class="terms-conditions">© <?php echo @$this->session->userdata('traceqlabs_copyright_year');?> All Rights Reserved. <a href="<?php echo base_url('');?>"><?php echo @$this->session->userdata('traceqlabs_website_name');?></a>.</p>
                    </div>
                    <div class="form-content text-center d-none" id="success_div">
                        <h1 class="mb-4"><img src="<?php echo base_url().'assets/uploads/meta_info/'.@$this->session->userdata('traceqlabs_logo');?>" alt="..." style="max-width: 250px;"></h1>
                        <h3>Thank you for showing interest with our application.</h3>
                        <h4 id="request_msg"></h4>
                        <div class="mt-4">
                            <a href="<?php echo base_url();?>" class="btn btn-primary primary-btn">Go Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-image">
            <a class="l-image" href="<?php echo base_url();?>" style="background-image: url(<?php echo base_url().'assets/uploads/meta_info/'.@$this->session->userdata('traceqlabs_logo');?>);background-size: 250px auto">
            </a>
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/admin/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/assets/js/authentication/form-1.js"></script>
    <script src="<?php echo base_url();?>assets/admin/plugins/notification/snackbar/snackbar.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/assets/js/components/notification/custom-snackbar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script type="text/javascript">
        $("#username").focus();
        $("#request_form").submit(function(e){
            $(".submit_btn").addClass('processing');
            $(".form_msg").html('');
            e.stopPropagation();
            e.preventDefault();
            var formdata = $(this).serialize();
            $.ajax({
                method:"post",
                url:"<?php echo base_url('demo-request-form');?>",
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
                            $(".submit_btn").removeClass('processing');
                        }else if(split_data.type == 'redirect'){
                            var link = split_data.link;
                            window.location.href = "<?php echo base_url();?>"+link;
                            $(".submit_btn").removeClass('processing');
                        }else if(split_data.type == 'success'){
                            Snackbar.show({
                                text: 'Verification code sent successfully',
                                pos: 'bottom-center'
                            });
                            $("#register_div,#verify_div").toggleClass('d-none');
                            $(".otp").addClass('disabled');
                            $(".otp_input").val('');
                            $("#otp_1").focus();
                            timerOn = true;
                            timer(120);
                            $(".submit_btn").removeClass('processing');
                        }else{
                            Snackbar.show({
                                text: 'Something went wrong!',
                                pos: 'bottom-center'
                            });
                            $(".submit_btn").removeClass('processing');
                        }
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        $(".submit_btn").removeClass('processing');
                    }
                },
                error:function(error){
                    Snackbar.show({
                        text: error.status+': '+error.statusText,
                        pos: 'bottom-center'
                    });
                    $(".submit_btn").removeClass('processing');
                }
            })
        })
<?php if(@$this->session->flashdata('msg')?:@$this->session->flashdata('errormsg')){?>
    Snackbar.show({
        text: '<?php echo $this->session->flashdata('msg')?:$this->session->flashdata('errormsg');?>',
        pos: 'bottom-center'
    });
<?php }?>
$("#verify_form").submit(function(e){
    $(".verify_btn").addClass('processing');
    $(".form_msg").html('');
    e.stopPropagation();
    e.preventDefault();
    var formdata = $(this).serialize();
    $.ajax({
        method:"post",
        url:"<?php echo base_url('demo-verify-form');?>",
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
                }else if(split_data.type == 'redirect'){
                    var link = split_data.link;
                    window.location.href = "<?php echo base_url();?>"+link;
                    $(".verify_btn").removeClass('processing');
                }else if(split_data.type == 'success'){
                    $("#verify_div").addClass('d-none');
                    $("#request_msg").html(split_data.msg);
                    $("#success_div").removeClass('d-none');
                    /*swal({
                        title: "",
                        text: split_data.msg,
                        icon: "success",
                        buttons:['','Go Back'],
                        showCancelButton: false,
                        closeOnConfirm: true,
                        closeOnCancel: false,
                        closeOnClickOutside: false,
                        closeOnEsc: false
                    }).then(function(isConfirm) {
                        window.location.href = "<?php echo base_url();?>";
                    })*/
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
        }
    })
})
$(".otp_input").on('keyup',function(event){
    var otp_input = $(this).val();
    var tabindex = $(this).attr('tabindex');
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == 13){
        if(otp_input != ''){
            $('#verify_form').submit();
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
            tabindex++;
            if(tabindex == 7){
                $('#verify_form').submit();
            }else{
                $("#otp_"+tabindex).focus();
            }
        }
    }
}).focus(function(){
    $(this).select();
})
let timerOn = false;
$(".otp").click(function(){
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url('demo-send'); ?>',
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
function callback_server_status() {
    var page_status = 0;
    $.ajax({
        method:"post",
        url:"<?php echo base_url('get-server-status'); ?>",
        data:{status:page_status},
        success:function(datas){
            var split_data = $.parseJSON(datas);
            if(typeof split_data !== undefined && split_data !='' && split_data !=null) {
                if(split_data.type == 'redirect'){
                    var link = split_data.link;
                    if(link !=''){
                        window.location.href = "<?php echo base_url();?>"+link;
                    }
                }
            }else{
                Snackbar.show({
                    text: 'Something went wrong!',
                    pos: 'bottom-center'
                });
            }
        }
    })
}
callback_server_status();
setInterval(function(){
    callback_server_status();
},5000)
</script>
</body>
</html>