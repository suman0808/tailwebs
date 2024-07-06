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
    <title><?php if(@$meta_title){echo @$meta_title; }else{?>Coming Soon<?php }?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url().'assets/uploads/meta_info/'.@$this->session->userdata('traceqlabs_favicon');?>">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/admin/assets/css/plugins.css" rel="stylesheet" type="text/css"> 
    <link href="<?php echo base_url();?>assets/admin/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>assets/admin/assets/js/loader.js"></script>
    <link href="<?php echo base_url();?>assets/admin/plugins/loaders/custom-loader.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/assets/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/assets/css/pages/coming-soon/style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/admin/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>assets/admin/assets/js/libs/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <style type="text/css">
        :root{
            --pri-color : <?php echo @$this->session->userdata('traceqlabs_pri_color');?>;
            --pri-bg-color : <?php echo @convert_rgb(@$this->session->userdata('traceqlabs_pri_color'))?>;
            --sec-color : <?php echo @$this->session->userdata('traceqlabs_sec_color');?>;
            --sec-bg-color : <?php echo @convert_rgb(@$this->session->userdata('traceqlabs_sec_color'))?>;
        }
        .l-image{
            background-color: rgba(var(--pri-bg-color),0.2) !important;
        }
    </style>
</head>
<body class="coming-soon">
    <div id="load_screen" class="primary-bg-light" style="background:rgba(0, 0, 0, 0.5);">
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
    <div class="coming-soon-container">
        <div class="coming-soon-cont">
            <div class="coming-soon-wrap">
                <div class="coming-soon-container">
                    <div class="coming-soon-content">
                        <h4 class="">Coming Soon</h4>
                        <p class="">We will be here in a shortwhile.....</p>

                        <div id="timer">
                            <div class="days"><span class="count">--</span> <span class="text">Days</span></div>
                            <div class="hours"><span class="count">--</span> <span class="text">Hours</span></div>
                            <div class="min"><span class="count">--</span> <span class="text">Mins</span></div>
                            <div class="sec"><span class="count">--</span> <span class="text">Secs</span></div>
                        </div>

                        <!-- <h3>Subscribe to get notified!</h3>

                        <form class="text-left" id="subscribe_form" autocomplete="off">
                            <div class="coming-soon">
                                <div class="">
                                    <div id="email-field" class="field-wrapper input">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                        <input id="email" name="email" class="form-control" type="text" value="" placeholder="Email">
                                        <button type="submit" class="btn btn-primary subscribe_btn" value="">Subscribe</button>
                                    </div>  
                                    <span class="text-danger email_msg form_msg"></span>
                                    <span class="text-danger main_msg form_msg"></span>                            
                                </div>

                            </div>
                        </form> -->
                        <?php if(@$social_media_info){?>
                            <ul class="social list-inline">
                                <?php if(@$social_media_info->facebook){?>
                                    <li class="list-inline-item">
                                        <a href="<?php echo @$social_media_info->facebook;?>" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                                        </a>
                                    </li>
                                <?php }?>  
                                <?php if(@$social_media_info->twitter){?>
                                    <li class="list-inline-item">
                                        <a href="<?php echo @$social_media_info->twitter;?>" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                                        </a>
                                    </li>
                                <?php }?>  
                                <?php if(@$social_media_info->instagram){?>
                                    <li class="list-inline-item">
                                        <a href="<?php echo @$social_media_info->instagram;?>" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                                        </a>
                                    </li>
                                <?php }?>  
                                <?php if(@$social_media_info->linked_in){?>
                                    <li class="list-inline-item">
                                        <a href="<?php echo @$social_media_info->linked_in;?>" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                                        </a>
                                    </li>
                                <?php }?> 
                                <?php if(@$social_media_info->google_plus){?>
                                    <li class="list-inline-item">
                                        <a href="<?php echo @$social_media_info->google_plus;?>" target="_blank">
                                            <i class="fa-brands fa-google-plus-g" style="color: var(--pri-color);font-size: 16px;"></i>
                                        </a>
                                    </li>
                                <?php }?> 
                                <?php if(@$social_media_info->youtube){?>
                                    <li class="list-inline-item">
                                        <a href="<?php echo @$social_media_info->youtube;?>" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-youtube"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33A2.78 2.78 0 0 0 3.4 19c1.72.46 8.6.46 8.6.46s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.25 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>
                                        </a>
                                    </li>
                                <?php }?> 
                                <?php if(@$social_media_info->pinterest){?>
                                    <li class="list-inline-item">
                                        <a href="<?php echo @$social_media_info->pinterest;?>" target="_blank">
                                            <i class="fa-brands fa-pinterest-p" style="color: var(--pri-color);font-size: 16px;"></i>
                                        </a>
                                    </li>
                                <?php }?>
                            </ul> 
                        <?php }?>          
                        <p class="terms-conditions">© <?php echo @$this->session->userdata('traceqlabs_copyright_year');?> All Rights Reserved. <a href="<?php echo base_url();?>"><?php echo @$this->session->userdata('traceqlabs_website_name');?></a>.</p>
                    </div>                    
                </div>
            </div>
        </div>
        <div class="coming-soon-image">
            <div class="l-image" style="background-image: url(<?php echo base_url().'assets/uploads/meta_info/'.@$this->session->userdata('traceqlabs_logo');?>);background-size: 250px auto">
                <div class="img-content">
                    <img src="<?php echo base_url();?>assets/admin/assets/img/mindset.svg" alt="...">
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="launch_datetime" value="<?php echo date('M d, Y H:i:s',strtotime(@$launch_datetime));?>">
    <script src="<?php echo base_url();?>assets/admin/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/plugins/notification/snackbar/snackbar.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/assets/js/components/notification/custom-snackbar.js"></script>
    <script type="text/javascript">   
        function callback_goback() {
            window.history.back();
        }
        var datetime = $("#launch_datetime").val();
        var countdownfunction = null;
        var page_redirect = '';
        function callback_start_countdown(){
            var distance = 0;
            var getYear = new Date().getFullYear()+1;
            var countDownDate = new Date(datetime).getTime();
            countdownfunction = setInterval(function() {
                var now = new Date().getTime();
                distance = countDownDate - now;
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementById("timer").innerHTML = '<div class="days"><span class="count">' + days + '</span> <span class="text">Days</span></div>' +
                '<div class="hours"><span class="count">'+ hours +'</span> <span class="text">Hours</span></div>' +
                '<div class="min"><span class="count">'+ minutes +'</span> <span class="text">Mins</span></div>' +
                '<div class="sec"><span class="count">'+ seconds +'</span> <span class="text">Secs</span></div>';
                if (distance < 0) {
                    clearInterval(countdownfunction);
                }
            },1000);
        }
        function callback_server_status() {
            var page_status = 2;
            $.ajax({
                method:"post",
                url:"<?php echo base_url('get-server-status'); ?>",
                data:{status:page_status,datetime:datetime},
                success:function(datas){
                    var split_data = $.parseJSON(datas);
                    if(typeof split_data !== undefined && split_data !='' && split_data !=null) {
                        if(split_data.type == 'redirect'){
                            var link = split_data.link;
                            window.location.href = "<?php echo base_url();?>"+link;
                        }else if(split_data.type == 'launch_datetime'){
                            $("#launch_datetime").val(split_data.datetime);
                            datetime = split_data.datetime;
                            clearInterval(countdownfunction);
                            callback_start_countdown();
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
        callback_start_countdown();
        setInterval(function(){
            callback_server_status();
        },1000)
        $("#subscribe_form").submit(function(e){
            $("#load_screen").removeClass('d-none');
            $(".subscribe_btn").addClass('processing');
            $(".form_msg").html('');
            e.stopPropagation();
            e.preventDefault();
            var formdata = $(this).serialize();
            $.ajax({
                method:"post",
                url:"<?php echo base_url('subscribe-form');?>",
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
                            $(".subscribe_btn").removeClass('processing');
                            $("#load_screen").addClass('d-none');
                        }else if(split_data.type == 'redirect'){
                            var link = split_data.link;
                            window.location.href = "<?php echo base_url();?>"+link;
                        }else if(split_data.type == 'success'){
                            Snackbar.show({
                                text: 'Thank you for subscribe with us!',
                                pos: 'bottom-center'
                            });
                            $("#subscribe_form")[0].reset();
                            $(".subscribe_btn").removeClass('processing');
                            $("#load_screen").addClass('d-none');
                        }else{
                            Snackbar.show({
                                text: 'Something went wrong!',
                                pos: 'bottom-center'
                            });
                            $(".subscribe_btn").removeClass('processing');
                            $("#load_screen").addClass('d-none');
                        }
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        $(".subscribe_btn").removeClass('processing');
                        $("#load_screen").addClass('d-none');
                    }
                }
            })
        })
    </script>
</body>
</html>