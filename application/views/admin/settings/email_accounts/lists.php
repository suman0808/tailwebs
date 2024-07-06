<?php if(@$lists){?>
    <div class="filter_body">
        <a class="btn btn-primary" onclick="callback_website_form_page('email_account_form');" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> New Account</a>
    </div>
    <div class="hr-line-dashed"></div>
    <div id="todo-inbox" class="accordion todo-inbox" style="overflow: inherit;">
        <div class="todo-box">
            <div id="ct">
                <?php 
                $i=1;
                foreach ($lists as $list) {?>
                    <div class="todo-item all-list">
                        <div class="todo-item-inner">
                            <div class="todo-content" ondblclick="callback_website_form_page('email_account_form','<?php echo @$list->ea_id;?>');">
                                <h5 class="todo-heading"><?php echo @$i.'. '.ucwords(@$list->email_type).' - '.@$list->email.'['.@$list->username.']';?></h5>
                                <p class="meta-date"><?php echo date('M d, Y',strtotime(@$list->updated_on));?></p>
                                <p class="todo-text">
                                    <?php if(!@$list->smtp_status){
                                        echo 'No SMTP access';
                                    }else{
                                        echo 'SMTP Host: '.@$list->smtp_host.', SMTP User: '.@$list->smtp_user.', SMTP Password: '.@$list->smtp_pass.', SMTP Port: '.@$list->smtp_port.', SMTP Security: '.@$list->smtp_crypto;
                                    }?>
                                </p>
                            </div>
                            <div class="priority-dropdown custom-dropdown-icon">
                                <div class="dropdown p-dropdown">
                                    <a class="dropdown-toggle <?php if(@$list->ea_status){echo 'success';}else{echo 'danger';}?>" href="#" role="button" id="dropdownMenuLink-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle active_status <?php if(!@$list->ea_status){echo 'd-none';}?>"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-slash inactive_status <?php if(@$list->ea_status){echo 'd-none';}?>"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-1">
                                        <a class="dropdown-item success" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg> Active</a>
                                        <a class="dropdown-item danger" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-slash"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg> Inactive</a>
                                    </div>
                                </div>
                            </div>
                            <div class="action-dropdown custom-dropdown-icon">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="javascript:void(0);" role="button" id="dropdownMenuLink-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink-2">
                                        <a class="dropdown-item" onclick="callback_website_form_page('email_account_form','<?php echo @$list->ea_id;?>');" href="javascript:void(0);">Edit</a>
                                        <a class="dropdown-item" onclick="callback_confirm_delete_list('Do you want to delete this data?','<?php echo @$list->ea_id;?>')" href="javascript:void(0);">Delete</a>
                                        <a class="dropdown-item" onclick="callback_change_email_account_status('<?php echo @$list->ea_id;?>','<?php echo @$list->ea_status;?>');" href="javascript:void(0);">Change Status</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $i++;
                }?>
            </div>
        </div>
    </div>
<?php }else{?>
    <div class="text-center">
        <h1><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></h1>
        <h4>Email account not found!</h4>
        <a class="btn btn-primary my-4" onclick="callback_website_form_page('email_account_form');" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> New Account</a>
    </div>
<?php }?>
<script type="text/javascript">
    function callback_delete_list(ea_id) {
        $("#load_screen").removeClass('d-none');
        $.ajax({
            method:"post",
            url:"<?php echo base_url('ad-delete-email-account');?>",
            data:{ea_id:ea_id},
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
                        $("#load_screen").addClass('d-none');
                    }else if(split_data.type == 'redirect'){
                        var link = split_data.link;
                        window.location.href = "<?php echo base_url();?>"+link;
                    }else if(split_data.type == 'success'){
                        Snackbar.show({
                            text: 'Data deleted successfully',
                            pos: 'bottom-center'
                        });
                        $("#load_screen").addClass('d-none');
                        callback_website_form_page('email_accounts');
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        $("#load_screen").addClass('d-none');
                    }
                }else{
                    Snackbar.show({
                        text: 'Something went wrong!',
                        pos: 'bottom-center'
                    });
                    $("#load_screen").addClass('d-none');
                }
            },
            error:function(error){
                Snackbar.show({
                    text: error.status+': '+error.statusText,
                    pos: 'bottom-center'
                });
                $("#load_screen").addClass('d-none');
            }
        })
    }
    function callback_change_email_account_status(ea_id,ea_status) {
        $("#load_screen").removeClass('d-none');
        $.ajax({
            method:"post",
            url:"<?php echo base_url('ad-change-email-account-status');?>",
            data:{ea_id:ea_id,ea_status:ea_status},
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
                        $("#load_screen").addClass('d-none');
                    }else if(split_data.type == 'redirect'){
                        var link = split_data.link;
                        window.location.href = "<?php echo base_url();?>"+link;
                    }else if(split_data.type == 'success'){
                        Snackbar.show({
                            text: 'Status updated successfully',
                            pos: 'bottom-center'
                        });
                        $("#load_screen").addClass('d-none');
                        callback_website_form_page('email_accounts');
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        $("#load_screen").addClass('d-none');
                    }
                }else{
                    Snackbar.show({
                        text: 'Something went wrong!',
                        pos: 'bottom-center'
                    });
                    $("#load_screen").addClass('d-none');
                }
            },
            error:function(error){
                Snackbar.show({
                    text: error.status+': '+error.statusText,
                    pos: 'bottom-center'
                });
                $("#load_screen").addClass('d-none');
            }
        })
    }
</script>