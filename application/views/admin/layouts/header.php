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
    <title><?php if(@$meta_title){echo @$meta_title; }else{?>Admin Dashboard<?php }?></title>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url().'assets/uploads/meta_info/'.@$this->session->userdata('tailwebs_favicon');?>">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/admin/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>assets/admin/assets/css/plugins.css" rel="stylesheet" type="text/css"> 
    <link href="<?php echo base_url();?>assets/admin/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url();?>assets/admin/assets/js/loader.js"></script>
    <link href="<?php echo base_url();?>assets/admin/plugins/loaders/custom-loader.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/assets/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/plugins/notification/snackbar/snackbar.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url();?>assets/admin/assets/css/apps/todolist.css" rel="stylesheet" type="text/css">
    <script src="<?php echo base_url();?>assets/admin/assets/js/libs/jquery-3.1.1.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <style type="text/css">
        :root{
            --pri-color : <?php echo @$this->session->userdata('tailwebs_pri_color');?>;
            --pri-bg-color : <?php echo @convert_rgb(@$this->session->userdata('tailwebs_pri_color'))?>;
            --sec-color : <?php echo @$this->session->userdata('tailwebs_sec_color');?>;
            --sec-bg-color : <?php echo @convert_rgb(@$this->session->userdata('tailwebs_sec_color'))?>;
        }
        .select2-container{
            margin-bottom: 0 !important;
        }
    </style>
</head>
<body class="alt-menu sidebar-noneoverflow">
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