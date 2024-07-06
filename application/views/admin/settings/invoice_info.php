<form id="invoice-info-form" class="section general-info" autocomplete="off">
    <div class="info">
        <div class="row">
            <div class="col-12 mt-md-0 mt-4">
                <div class="form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="company_name">Company Name *</label>
                                <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo @$editrow->company_name;?>" maxlength="255">
                                <span class="text-danger company_name_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gstin">GSTIN</label>
                                <input type="text" class="form-control text_uppercase" id="gstin" name="gstin" value="<?php echo @$editrow->gstin;?>" maxlength="15">
                                <span class="text-danger gstin_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pan">PAN</label>
                                <input type="text" class="form-control text_uppercase" id="pan" name="pan" value="<?php echo @$editrow->pan;?>" maxlength="10">
                                <span class="text-danger pan_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address *</label>
                                <textarea class="form-control" id="address" name="address"><?php echo @$editrow->address;?></textarea>
                                <span class="text-danger address_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="contact_number">Contact Numbers *</label>
                                <input type="text" class="form-control tagsinput" id="contact_number" name="contact_number" value="<?php echo @$editrow->contact_number;?>">
                                <span class="text-danger contact_number_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="support_mails">Support Emails </label>
                                <input type="text" class="form-control tagsinput" id="support_mails" name="support_mails" value="<?php echo @$editrow->support_mails;?>">
                                <span class="text-danger support_mails_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="inv_tc">Invoice Terms & Conditions</label>
                                <textarea class="form-control" id="inv_tc" name="inv_tc" maxlength="160"><?php echo @$editrow->inv_tc;?></textarea>
                                <span class="text-danger inv_tc_msg form_msg"></span>
                            </div>
                        </div>
                        <input type="hidden" name="inv_id" value="<?php echo @$editrow->inv_id; ?>">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-xl-12">        
                <div class="field-wrapper">
                    <button class="btn btn-primary primary-btn invoice-info_btn " type="submit">
                        <div class="spinner-grow text-white mr-2 align-self-center loader-xs">Please Wait...</div>
                    Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $('.tagsinput').tagsinput({
        tagClass: 'badge badge-primary mb-1'
    });
    $(".text_uppercase").keyup(function(){
        var val = $(this).val();
        $(this).val(val.toUpperCase());
    })
    $('#inv_tc').summernote({
        height:200,
        callbacks : {
            onImageUpload: function(image) {
                uploadImage(image[0],$(this).attr('id'));
            }
        }
    });
    function uploadImage(image,id) {
        var data = new FormData();
        data.append("editor_image",image);
        $.ajax ({
            method: "POST",
            url: "<?php echo base_url('ad-editor-image');?>",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function(datas) {
                $('#'+id).summernote('insertImage', datas);
            }
        });
    }
    $("#invoice-info-form").submit(function(e){
        $(".invoice-info_btn").addClass('processing');
        $(".form_msg").html('');
        e.stopPropagation();
        e.preventDefault();
        var formdata = $(this).serialize();
        $.ajax({
            method:"post",
            url:"<?php echo base_url('ad-invoice-info-form');?>",
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
                        $(".invoice-info_btn").removeClass('processing');
                    }else if(split_data.type == 'redirect'){
                        var link = split_data.link;
                        window.location.href = "<?php echo base_url();?>"+link;
                    }else if(split_data.type == 'success'){
                        Snackbar.show({
                            text: 'Invoice information updated successfully',
                            pos: 'bottom-center'
                        });
                        callback_website_form_page('invoice_info');
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        $(".invoice-info_btn").removeClass('processing');
                    }
                }else{
                    Snackbar.show({
                        text: 'Something went wrong!',
                        pos: 'bottom-center'
                    });
                    $(".invoice-info_btn").removeClass('processing');
                }
            }
        })
    })
</script>