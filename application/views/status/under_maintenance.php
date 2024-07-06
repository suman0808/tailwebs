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
    <title><?php if(@$meta_title){echo @$meta_title; }else{?>Server Under Maintenance<?php }?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url().'assets/uploads/meta_info/'.@$this->session->userdata('traceqlabs_favicon');?>">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/admin/assets/css/plugins.css" rel="stylesheet" type="text/css"> 
    <link href="<?php echo base_url();?>assets/admin/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>assets/admin/assets/js/loader.js"></script>
    <link href="<?php echo base_url();?>assets/admin/plugins/loaders/custom-loader.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/assets/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/assets/css/pages/error/style-maintanence.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/admin/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>assets/admin/assets/js/libs/jquery-3.1.1.min.js"></script>
    <style type="text/css">
        :root{
            --pri-color : <?php echo @$this->session->userdata('traceqlabs_pri_color');?>;
            --pri-bg-color : <?php echo @convert_rgb(@$this->session->userdata('traceqlabs_pri_color'))?>;
            --sec-color : <?php echo @$this->session->userdata('traceqlabs_sec_color');?>;
            --sec-bg-color : <?php echo @convert_rgb(@$this->session->userdata('traceqlabs_sec_color'))?>;
        }
    </style>
</head>
<body class="maintanence text-center">
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
    <div class="container-fluid maintanence-content">
        <div class="">
            <div class="maintanence-hero-img">
                <img alt="..." src="<?php echo base_url().'assets/uploads/meta_info/'.@$this->session->userdata('traceqlabs_logo');?>" style="width: 250px;height: auto;">
            </div>
            <h1 class="error-title">Under Maintenance</h1>
            <p class="error-text">Thank you for visiting us.</p>
            <p class="text">We are currently working on making some improvements <br> to give you better user experience.</p>
            <p class="text">Please visit us again shortly.</p>
            <!-- <a href="<?php echo base_url();?>" class="btn btn-info mt-5">Home</a>
            <a href="javascript:void(0)" onclick="callback_goback()" class="btn btn-info mt-5">Go Back</a> -->
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/admin/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/plugins/notification/snackbar/snackbar.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/assets/js/components/notification/custom-snackbar.js"></script>
    <script type="text/javascript">   
        function callback_goback() {
            window.history.back();
        }
        function callback_server_status() {
            var page_status = 1;
            $.ajax({
                method:"post",
                url:"<?php echo base_url('get-server-status'); ?>",
                data:{status:page_status},
                success:function(datas){
                    var split_data = $.parseJSON(datas);
                    if(typeof split_data !== undefined && split_data !='' && split_data !=null) {
                        if(split_data.type == 'redirect'){
                            var link = split_data.link;
                            window.location.href = "<?php echo base_url();?>"+link;
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
        },1000)
    </script>
</body>
</html>