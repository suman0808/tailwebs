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
    <title><?php if(@$meta_title){echo @$meta_title; }else{?>Error 404<?php }?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url().'assets/uploads/meta_info/'.@$this->session->userdata('traceqlabs_favicon');?>">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/admin/assets/css/plugins.css" rel="stylesheet" type="text/css"> 
    <link href="<?php echo base_url();?>assets/admin/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>assets/admin/assets/js/loader.js"></script>
    <link href="<?php echo base_url();?>assets/admin/plugins/loaders/custom-loader.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/assets/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/assets/css/pages/error/style-400.css" rel="stylesheet" type="text/css">
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
<body class="error404 text-center">
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-5 text-center">
                <img alt="..." src="<?php echo base_url().'assets/uploads/meta_info/'.@$this->session->userdata('traceqlabs_logo');?>" style="max-width: 250px;">
            </div>
        </div>
    </div>
    <div class="container-fluid error-content">
        <div class="">
            <h1 class="error-number">404</h1>
            <p class="mini-text">Ooops!</p>
            <p class="error-text mb-4 mt-1">The page you requested was not found!</p>
            <a href="javascript:void(0)" onclick="callback_goback()" class="btn btn-primary mt-5">Go Back</a>
        </div>
    </div>
    <script src="<?php echo base_url();?>assets/admin/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript">   
        function callback_goback() {
          window.history.back();
      }
  </script>
</body>
</html>