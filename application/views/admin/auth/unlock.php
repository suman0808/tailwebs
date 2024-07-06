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
    <title>Unlock</title>
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
                    <div class="form-content">
                        <div class="d-flex user-meta">
                            <img src="<?php echo base_url('assets/uploads/customers/'.@$this->session->userdata('tailwebs_admin_image'));?>" class="usr-profile" alt="avatar">
                            <div class="">
                                <p class=""><?php echo @$this->session->userdata('tailwebs_admin_name')?></p>
                            </div>
                        </div>
                        <form class="text-left" action="" id="unlock_form" method="post" autocomplete="off">
                            <div class="form">
                                <div id="password-field" class="field-wrapper input mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="password" name="password" class="form-control" type="password" value="" placeholder="Password">
                                    <span class="text-danger password_msg form_msg"></span>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper toggle-pass">
                                        <p class="d-inline-block">Show Password</p>
                                        <label class="switch s-primary">
                                            <input type="checkbox" id="toggle-password" class="d-none">
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                    <div class="field-wrapper">
                                        <button class="btn btn-primary primary-btn submit_btn " type="submit">
                                            <div class="spinner-grow text-white mr-2 align-self-center loader-xs">Please Wait...</div>
                                        Unlock</button>
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
        $("#unlock_form").submit(function(e){
            $(".submit_btn").addClass('processing');
            $(".form_msg").html('');
            e.stopPropagation();
            e.preventDefault();
            var formdata = $(this).serialize();
            $.ajax({
                method:"post",
                url:"<?php echo base_url('ad-auth-unlock-form');?>",
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
    </script>
</body>
</html>