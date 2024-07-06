<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/plugins/tagsinput/bootstrap-tagsinput.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/plugins/cropper/cropper.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/plugins/summernote/summernote.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/assets/css/components/tabs-accordian/custom-tabs.css">
<link href="<?php echo base_url();?>assets/admin/assets/css/components/custom-modal.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/admin/plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/admin/assets/css/forms/theme-checkbox-radio.css">
<!-- <link href="<?php echo base_url();?>assets/admin/plugins\flatpickr\custom-flatpickr.css" rel="stylesheet" type="text/css"> -->
<div id="content" class="main-content">
    <div class="layout-px-spacing mt-4">                
        <div class="widget-content widget-content-area py-0">
            <div class="widget-content widget-content-area animated-underline-content pt-0">
                <ul class="nav nav-tabs nav-justified mb-3" id="animateLine" role="tablist">
                    <?php if(@$this->session->userdata('tailwebs_admin_type') <= 1){?>
                        <li class="nav-item">
                            <a class="nav-link" id="general_setting" aria-controls="animated-underline-home" aria-selected="false" href="javascript:void(0);" onclick="callback_website_form_page('general_setting');">General Settings</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="meta_info" aria-controls="animated-underline-home" aria-selected="false" href="javascript:void(0);" onclick="callback_website_form_page('meta_info');">Meta Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="plugin_script" aria-controls="animated-underline-home" aria-selected="false" href="javascript:void(0);" onclick="callback_website_form_page('plugin_script');">Plugin Script</a>
                        </li>
                    <?php }?>
                </ul>

                <div class="tab-content" id="animateLineContent-4">
                    <div class="tab-pane fade show active" id="form_page_div" role="tabpanel" aria-labelledby="animated-underline-home-tab">     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>assets/admin/plugins/tagsinput/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/cropper/cropper.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/summernote/summernote.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/flatpickr/flatpickr.js"></script>
<script type="text/javascript">
    function callback_website_form_page(form_page,edit_id){
        if(form_page != 'email_account_form'){
            $("#animateLine li a").removeClass('active').attr('aria-selected',false);
            $("#"+form_page).addClass('active').attr('aria-selected',true);
            $("#form_page_div").html('<div class="d-block text-center"> <div class="spinner-grow text-info align-self-center loader-lg">Loading...</div></div>');
        }
        $.ajax({
            method:'post',
            url:"<?php echo base_url('ad-website-form-page');?>",
            data:{form_page:form_page,edit_id:edit_id},
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
                        $("#form_page_div").html('<h4 class="text-center">Something went wrong!</h4>');
                    }else if(split_data.type == 'redirect'){
                        var link = split_data.link;
                        window.location.href = "<?php echo base_url();?>"+link;
                    }else if(split_data.type == 'success'){
                        $("#form_page_div").html(split_data.formpage);
                    }else if(split_data.type == 'no-access'){
                        Snackbar.show({
                            text: 'Access denied!',
                            pos: 'bottom-center'
                        });
                        $("#form_page_div").html('<h4 class="text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg> Access denied!</h4>');
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        $("#form_page_div").html('<h4 class="text-center">Something went wrong!</h4>');
                    }
                }else{
                    Snackbar.show({
                        text: 'Something went wrong!',
                        pos: 'bottom-center'
                    });
                    $("#form_page_div").html('<h4 class="text-center">Something went wrong!</h4>');
                }
            },
            error:function(error){
                Snackbar.show({
                    text: error.status+': '+error.statusText,
                    pos: 'bottom-center'
                });
                $("#form_page_div").html('<h4 class="text-center">Something went wrong!</h4>');
            }

        })
    }
    callback_website_form_page('general_setting');
</script>