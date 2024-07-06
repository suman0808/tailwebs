<form id="plugin-script-form" class="section general-info" autocomplete="off">
    <div class="info">
        <div class="row">
            <div class="col-12 mt-md-0 mt-4">
                <div class="form">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="header_script">Header Script</label>
                                <textarea class="form-control" id="header_script" name="header_script"><?php echo @$editrow->header_script;?></textarea>
                                <span class="text-danger header_script_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="footer_script">Footer Script</label>
                                <textarea class="form-control" id="footer_script" name="footer_script"><?php echo @$editrow->footer_script;?></textarea>
                                <span class="text-danger footer_script_msg form_msg"></span>
                            </div>
                        </div>
                        <input type="hidden" name="ps_id" value="<?php echo @$editrow->ps_id; ?>">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-xl-12">        
                <div class="field-wrapper">
                    <button class="btn btn-primary primary-btn plugin-script_btn " type="submit">
                        <div class="spinner-grow text-white mr-2 align-self-center loader-xs">Please Wait...</div>
                    Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $("#plugin-script-form").submit(function(e){
        $(".plugin-script_btn").addClass('processing');
        $(".form_msg").html('');
        e.stopPropagation();
        e.preventDefault();
        var formdata = $(this).serialize();
        $.ajax({
            method:"post",
            url:"<?php echo base_url('ad-plugin-script-form');?>",
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
                        $(".plugin-script_btn").removeClass('processing');
                    }else if(split_data.type == 'redirect'){
                        var link = split_data.link;
                        window.location.href = "<?php echo base_url();?>"+link;
                    }else if(split_data.type == 'success'){
                        Snackbar.show({
                            text: 'Plugin script information updated successfully',
                            pos: 'bottom-center'
                        });
                        callback_website_form_page('plugin_script');
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        $(".plugin-script_btn").removeClass('processing');
                    }
                }else{
                    Snackbar.show({
                        text: 'Something went wrong!',
                        pos: 'bottom-center'
                    });
                    $(".plugin-script_btn").removeClass('processing');
                }
            },
            error:function(error){
                Snackbar.show({
                    text: error.status+': '+error.statusText,
                    pos: 'bottom-center'
                });
                $(".meta-info_btn").removeClass('processing');
            }
        })
    })
</script>