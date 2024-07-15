<div class="modal-header p-3">
    <h5 class="modal-title" id="exampleModalLabel"><?php if(@$editrow->student_id){echo 'Edit';}else{echo 'Add';}?> Student</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
</div>
<div class="modal-body p-3">
    <form id="student-form" class="section general-info floating-form" autocomplete="off">
        <div class="form">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo @$editrow->name;?>" maxlength="255">
                        <label for="name" class="form-label">Full Name *</label>
                        <span class="text-danger name_msg form_msg"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" id="subject" name="subject" value="<?php echo @$editrow->subject;?>" maxlength="255">
                        <label for="email" class="form-label">Subject *</label>
                        <span class="text-danger subject_msg form_msg"></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <input type="text" class="form-control" id="marks" name="marks" value="<?php echo @$editrow->marks;?>" maxlength="255">
                        <label for="marks" class="form-label">Marks *</label>
                        <span class="text-danger marks_msg form_msg"></span>
                    </div>
                </div>
                <input type="hidden" name="student_id" value="<?php echo @$editrow->student_id; ?>">
            </div>
        </div>
        <div class="hr-line-dashed"></div>     
        <div class="field-wrapper">
            <button class="btn btn-primary primary-btn admin-user_btn " type="submit">
                <div class="spinner-grow text-white mr-2 align-self-center loader-xs">Please Wait...</div>
            Submit</button>
            <button class="btn btn-dark dark-btn admin-user_btn " type="button" data-dismiss="modal" aria-label="Close">
                <div class="spinner-grow text-white mr-2 align-self-center loader-xs">Please Wait...</div>
            Cancel</button>
        </div>
    </form>
</div>
<script type="text/javascript">
    $("#student-form").submit(function(e){
        var id = "<?php echo @$editrow->student_id; ?>";
        $(".admin-user_btn").addClass('processing');
        $("#load_screen").removeClass('d-none');
        $(".form_msg").html('');
        e.stopPropagation();
        e.preventDefault();
        var formdata = $(this).serialize();
        $.ajax({
            method:"post",
            url:"<?php echo base_url('ad-student-form');?>",
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
                        $(".admin-user_btn").removeClass('processing');
                        $("#load_screen").addClass('d-none');
                    }else if(split_data.type == 'redirect'){
                        var link = split_data.link;
                        window.location.href = "<?php echo base_url();?>"+link;
                    }else if(split_data.type == 'added'){
                        Snackbar.show({
                            text: 'Student added successfully',
                            pos: 'bottom-center'
                        });
                        if(list_count == 0){
                            $("#empty_list_div").addClass('d-none');
                        }
                        list_count = (parseInt(list_count)+1);
                        $("#list_data").prepend(split_data.list_data);
                        $("#load_screen").addClass('d-none');
                        $("#form_data_div").modal('hide');
                    }else if(split_data.type == 'updated'){
                        Snackbar.show({
                            text: 'Student updated successfully',
                            pos: 'bottom-center'
                        });
                        if(id == '' || id == undefined || id == null){
                        $("#list_item_"+split_data.edit_id).html(split_data.list_data);
                        }else{
                        $("#list_item_"+id).html(split_data.list_data);
                    }
                        $("#load_screen").addClass('d-none');
                        $("#form_data_div").modal('hide');
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        $(".admin-user_btn").removeClass('processing');
                        $("#load_screen").addClass('d-none');
                    }
                }else{
                    Snackbar.show({
                        text: 'Something went wrong!',
                        pos: 'bottom-center'
                    });
                    $(".admin-user_btn").removeClass('processing');
                    $("#load_screen").addClass('d-none');
                }
            },
            error:function(error){
                Snackbar.show({
                    text: error.status+': '+error.statusText,
                    pos: 'bottom-center'
                });
                $(".admin-user_btn").removeClass('processing');
                $("#load_screen").addClass('d-none');
            }
        })
})
setTimeout(function(){
    $("#fullname").focus();
},500)
</script>