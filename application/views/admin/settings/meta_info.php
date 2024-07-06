<form id="meta-info-form" class="section general-info floating-form" autocomplete="off">
    <div class="info">
        <div class="row">
            <div class="col-12 mt-md-0 mt-4">
                <div class="form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id="website_name" name="website_name" value="<?php echo @$editrow->website_name;?>" maxlength="255">
                                <label for="website_name" class="form-label">Website Name *</label>
                                <span class="text-danger website_name_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id="meta_title" name="meta_title" value="<?php echo @$editrow->meta_title;?>" maxlength="70">
                                <label for="meta_title" class="form-label">Meta Title *</label>
                                <span class="text-danger meta_title_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id="copyright_year" name="copyright_year" value="<?php echo @$editrow->copyright_year;?>" maxlength="255">
                                <label for="copyright_year" class="form-label">Copyright Year</label>
                                <span class="text-info">Leave empty as the current year</span>
                                <span class="text-danger copyright_year_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" id="meta_description" name="meta_description" maxlength="160"><?php echo @$editrow->meta_description;?></textarea>
                                <label for="meta_description" class="form-label">Meta Description *</label>
                                <span class="text-danger meta_description_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="text" class="form-control tagsinput" id="meta_keywords" name="meta_keywords" value="<?php echo @$editrow->meta_keywords;?>">
                                <label for="meta_keywords" class="form-label">Meta Keywords </label>
                                <span class="text-danger meta_keywords_msg form_msg"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label for="logo">Header Logo *</label>                 
                                <div class="image-crop_logo image_visible_logo <?php if(!@$editrow->logo){echo 'd-none'; }?>" style="max-width: 300px;">
                                    <img src="<?php echo base_url('assets/uploads/meta_info/'.@$editrow->logo); ?>" class="logo_display">
                                </div>
                                <div class="my-2">
                                    <label title="Upload image" for="logo" class="btn btn-primary primary-btn m-0 btn-xs">
                                        <input type="file" accept=".jpg,.jpeg,.png" name="logo" id="logo" class="d-none">
                                        Upload Image
                                    </label>
                                    <button type="button" title="Remove image" onclick="remove_image('logo')" class="btn btn-secondary image_visible_logo btn-xs <?php if(!@$editrow->logo){echo 'd-none'; }?>">Remove Image</button>
                                </div>
                                <p class="text-danger logo_msg form_msg"></p> 
                                <span class="text-info">Maximum 500KB file only allowed to upload.</span>
                            </div> 
                            <input type="hidden" name="image_removed_logo" id="image_removed_logo">
                            <input type="hidden" name="logo_old" value="<?php echo @$editrow->logo; ?>">
                            <input type="hidden" name="file_xaxis_logo" id="file_xaxis_logo">
                            <input type="hidden" name="file_yaxis_logo" id="file_yaxis_logo">
                            <input type="hidden" name="file_height_logo" id="file_height_logo">
                            <input type="hidden" name="file_width_logo" id="file_width_logo">
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label for="footer_logo">Footer Logo </label>                 
                                <div class="image-crop_footer_logo image_visible_footer_logo <?php if(!@$editrow->footer_logo){echo 'd-none'; }?>" style="max-width: 300px;">
                                    <img src="<?php echo base_url('assets/uploads/meta_info/'.@$editrow->footer_logo); ?>" class="footer_logo_display">
                                </div>
                                <div class="my-2">
                                    <label title="Upload image" for="footer_logo" class="btn btn-primary primary-btn m-0 btn-xs">
                                        <input type="file" accept=".jpg,.jpeg,.png" name="footer_logo" id="footer_logo" class="d-none">
                                        Upload Image
                                    </label>
                                    <button type="button" title="Remove image" onclick="remove_image('footer_logo')" class="btn btn-secondary image_visible_footer_logo btn-xs <?php if(!@$editrow->footer_logo){echo 'd-none'; }?>">Remove Image</button>
                                </div>
                                <p class="text-danger footer_logo_msg form_msg"></p> 
                                <span class="text-info">Maximum 500KB file only allowed to upload.</span>
                            </div> 
                            <input type="hidden" name="image_removed_footer_logo" id="image_removed_footer_logo">
                            <input type="hidden" name="footer_logo_old" value="<?php echo @$editrow->footer_logo; ?>">
                            <input type="hidden" name="file_xaxis_footer_logo" id="file_xaxis_footer_logo">
                            <input type="hidden" name="file_yaxis_footer_logo" id="file_yaxis_footer_logo">
                            <input type="hidden" name="file_height_footer_logo" id="file_height_footer_logo">
                            <input type="hidden" name="file_width_footer_logo" id="file_width_footer_logo">
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mb-4">
                                <label for="favicon">Favicon *</label>                 
                                <div class="image-crop_favicon image_visible_favicon <?php if(!@$editrow->favicon){echo 'd-none'; }?>" style="max-width: 100px;">
                                    <img src="<?php echo base_url('assets/uploads/meta_info/'.@$editrow->favicon); ?>" class="favicon_display">
                                </div>
                                <div class="my-2">
                                    <label title="Upload image" for="favicon" class="btn btn-primary primary-btn m-0 btn-xs">
                                        <input type="file" accept=".jpg,.jpeg,.png" name="favicon" id="favicon" class="d-none">
                                        Upload Image
                                    </label>
                                    <button type="button" title="Remove image" onclick="remove_image('favicon')" class="btn btn-secondary image_visible_favicon btn-xs <?php if(!@$editrow->favicon){echo 'd-none'; }?>">Remove Image</button>
                                </div>
                                <p class="text-danger favicon_msg form_msg"></p> 
                                <span class="text-info">Maximum 500KB file only allowed to upload.</span>
                            </div> 
                            <input type="hidden" name="image_removed_favicon" id="image_removed_favicon">
                            <input type="hidden" name="favicon_old" value="<?php echo @$editrow->favicon; ?>">
                            <input type="hidden" name="file_xaxis_favicon" id="file_xaxis_favicon">
                            <input type="hidden" name="file_yaxis_favicon" id="file_yaxis_favicon">
                            <input type="hidden" name="file_height_favicon" id="file_height_favicon">
                            <input type="hidden" name="file_width_favicon" id="file_width_favicon">
                        </div>
                        <input type="hidden" name="mi_id" value="<?php echo @$editrow->mi_id; ?>">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="hr-line-dashed"></div>
            </div>
            <div class="col-xl-12">        
                <div class="field-wrapper">
                    <button class="btn btn-primary primary-btn meta-info_btn " type="submit">
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
    function remove_image(image_id){
        $(".image_visible_"+image_id).addClass('d-none');
        $("#image_removed_"+image_id).val(1);
    }
    function cropper(image_id){
        var $image = $(".image-crop_"+image_id+" > img");
        if(image_id == 'favicon'){
            var aspectRatio = 1;
        }else{
            var aspectRatio = 0;
        }
        $image.cropper({
            aspectRatio: aspectRatio,
            movable:true,
            done: function(data){
                $('#file_xaxis_'+image_id).val(Math.round(data.x));
                $('#file_yaxis_'+image_id).val(Math.round(data.y));
                $('#file_height_'+image_id).val(Math.round(data.height));
                $('#file_width_'+image_id).val(Math.round(data.width));
            }
        });
        var $inputImage = $("#"+image_id);
        if (window.FileReader){
            $inputImage.change(function() {
                var fileReader = new FileReader(),
                files = this.files,
                file;
                if (!files.length) {
                    return;
                }
                file = files[0];
                if (/^image\/\w+$/.test(file.type)) {
                    if(file.type == 'image/jpeg' || file.type == 'image/png' || file.type == 'image/jpg'){
                        fileReader.readAsDataURL(file);
                        fileReader.onload = function () {
                            $image.cropper("reset", true).cropper("replace", this.result);
                            $(".image-crop_"+image_id).removeClass('d-none');
                        };
                    }else{
                        $('.'+image_id+'_msg').html('Please upload only JPG, JPEG or PNG file.');
                    }
                } else {
                    $('.'+image_id+'_msg').html('Please choose an image file.');
                }
            });
        }
    }
    cropper('logo');
    cropper('favicon');
    cropper('footer_logo');
    $("#meta-info-form").submit(function(e){
        $(".meta-info_btn").addClass('processing');
        $(".form_msg").html('');
        e.stopPropagation();
        e.preventDefault();
        var form = $(this)[0];
        var formdata = new FormData(form);
        $.ajax({
            method:"post",
            url:"<?php echo base_url('ad-meta-info-form');?>",
            data:formdata,
            cache: false,
            contentType: false,
            processData: false,
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
                        $(".meta-info_btn").removeClass('processing');
                    }else if(split_data.type == 'redirect'){
                        var link = split_data.link;
                        window.location.href = "<?php echo base_url();?>"+link;
                    }else if(split_data.type == 'success'){
                        Snackbar.show({
                            text: 'Meta information updated successfully',
                            pos: 'bottom-center'
                        });
                        callback_website_form_page('meta_info');
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        $(".meta-info_btn").removeClass('processing');
                    }
                }else{
                    Snackbar.show({
                        text: 'Something went wrong!',
                        pos: 'bottom-center'
                    });
                    $(".meta-info_btn").removeClass('processing');
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
    /*$('#meta_description').summernote({
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
    }*/
</script>