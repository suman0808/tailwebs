<link href="<?php echo base_url();?>assets/admin/assets/css/components/custom-modal.css" rel="stylesheet" type="text/css">
<div id="content" class="main-content">
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="custom_body_style mb-2 filter_body">
                    <div class="row">
                        <div class="col-sm-6">
                            <a class="btn btn-primary mt-0 mt-sm-2 mb-2" href="#" onclick="callback_form_data()"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus "><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Add Admin</a>
                        </div>
                        <div class="col-sm-6">
                            <div class="float-sm-right floating-form mt-2 mt-sm-0">
                                <div class="form-group mb-0">
                                    <input type="text" class="form-control" style="max-width:300px" id="keyword">
                                    <label for="keyword" class="form-label">Search</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="item_list_div" class="custom_body_style">
                    <div id="item_lists">
                        <div class="table-responsive custome_scroll_list" id="list_scroll_data">
                            <table class="table table-bordered table-hover table-condensed">
                                <thead>
                                    <tr class="sticky-top bg-white shadow-sm">
                                        <th style="width:45px"></th>
                                        <th class="fullname_column" onclick="callback_sort_by('fullname')">
                                            Full Name
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down d-none"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                        </th>
                                        <th class="email_column" onclick="callback_sort_by('email')">
                                            Email
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down d-none"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                        </th>
                                        <th class="username_column" onclick="callback_sort_by('username')">
                                            Username
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down d-none"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                        </th>
                                        <th class="admin_status_column" onclick="callback_sort_by('admin_status')">
                                            Status
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down d-none"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                        </th>
                                        <th class="updated_on_column" onclick="callback_sort_by('updated_on')">
                                            Updated On
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down d-none"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                        </th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="list_data"></tbody>
                            </table>
                        </div>
                        <div class="text-center d-none" id="bottom_loader">
                            <div class="spinner-grow text-info align-self-center loader-lg">Loading...</div>
                        </div>
                    </div>
                </div>                                   
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="form_data_div" tabindex="-1" role="dialog" aria-labelledby="form_data_divLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content" id="form_data">

        </div>
    </div>
</div>
<script type="text/javascript">
    var bottom_loader = false;
    var sort_column = 'fullname';
    var column_sort_by = 'ASC';
    var list_count = 0;
    function callback_reset_list_data() {
        list_count = 0;
        callback_get_list_data();
    }
    function callback_form_data(id) {
        $("#load_screen").removeClass('d-none');
        $.ajax({
            method:'post',
            url:"<?php echo base_url('ad-admin-user-form-data');?>",
            data:{id:id},
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
                        $("#form_data").html(split_data.formpage);
                        $("#load_screen").addClass('d-none');
                        $("#form_data_div").modal('show');
                    }else if(split_data.type == 'no-access'){
                        Snackbar.show({
                            text: 'Access denied!',
                            pos: 'bottom-center'
                        });
                        $("#load_screen").addClass('d-none');
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
    function callback_get_list_data() {
        $("#load_screen,#bottom_loader").removeClass('d-none');
        var results = 50;
        var keyword = $("#keyword").val();
        $.ajax({
            method:"post",
            url:"<?php echo base_url('ad-get-admin-user-lists');?>",
            data:{list_count:list_count,results:results,keyword:keyword,sort_by:column_sort_by,sort_column:sort_column},
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
                        $("#load_screen,#bottom_loader").addClass('d-none');
                    }else if(split_data.type == 'redirect'){
                        var link = split_data.link;
                        window.location.href = "<?php echo base_url();?>"+link;
                    }else if(split_data.type == 'success'){
                        $("#load_screen,#bottom_loader").addClass('d-none');
                        if(split_data.count == results){
                            bottom_loader = true;
                        }else{
                            bottom_loader = false;
                        }
                        if(list_count == 0){
                            $("#list_data").html('<tr id="empty_list_div"> <th colspan="7" class="text-center">No data found!</th> </tr>');
                        }
                        $("#list_data").append(split_data.list_data);
                        list_count = (parseInt(list_count)+parseInt(split_data.count));
                        if(list_count > 0){
                            $("#empty_list_div").addClass('d-none');
                        }
                        $("#item_list_div").removeClass('d-none');
                    }else{
                        Snackbar.show({
                            text: 'Something went wrong!',
                            pos: 'bottom-center'
                        });
                        $("#load_screen,#bottom_loader").addClass('d-none');
                    }
                }else{
                    Snackbar.show({
                        text: 'Something went wrong!',
                        pos: 'bottom-center'
                    });
                    $("#load_screen,#bottom_loader").addClass('d-none');
                }
            },
            error:function(error){
                Snackbar.show({
                    text: error.status+': '+error.statusText,
                    pos: 'bottom-center'
                });
                $("#load_screen,#bottom_loader").addClass('d-none');
            }
        })
    }
    callback_get_list_data();
    $("#keyword").keyup(function(){
        if($(this).val().length >= 2 || $(this).val().length == 0){
            if(list_count != 0 || $("#empty_list_div").hasClass('d-none') == false){
                list_count = 0;
                callback_get_list_data();
            }
        }
    })
    function callback_delete_list(id) {
        $("#load_screen").removeClass('d-none');
        $.ajax({
            method:"post",
            url:"<?php echo base_url('ad-delete-admin-user');?>",
            data:{id:id},
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
                        list_count = (parseInt(list_count)-1);
                        if(list_count == 0){
                            $("#empty_list_div").removeClass('d-none');
                        }
                        $("#list_item_"+id).remove();
                        $("#load_screen").addClass('d-none');
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
    function callback_change_list_status(id,status) {
        $("#load_screen").removeClass('d-none');
        var displ_status = $("#status").val();
        $.ajax({
            method:"post",
            url:"<?php echo base_url('ad-change-admin-user-status');?>",
            data:{id:id,status:status},
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
                        if(status == 0){
                            $("#list_item_"+id+" .priority-dropdown .dropdown-toggle").removeClass('danger').addClass('success');
                            $("#list_item_"+id+" .inactive_status").addClass('d-none');
                            $("#list_item_"+id+" .active_status").removeClass('d-none');
                            $("#list_item_"+id+" .status_link").attr('onclick','callback_change_list_status('+id+',1)');
                            if(displ_status == 0){
                                $("#list_item_"+id).remove();
                                list_count = (parseInt(list_count)-1);
                                if(list_count == 0){
                                    $("#empty_list_div").removeClass('d-none');
                                }
                            }
                        }else{
                            $("#list_item_"+id+" .priority-dropdown .dropdown-toggle").removeClass('success').addClass('danger');
                            $("#list_item_"+id+" .active_status").addClass('d-none');
                            $("#list_item_"+id+" .inactive_status").removeClass('d-none');
                            $("#list_item_"+id+" .status_link").attr('onclick','callback_change_list_status('+id+',0)');
                            if(displ_status == 1){
                                $("#list_item_"+id).remove();
                                list_count = (parseInt(list_count)-1);
                                if(list_count == 0){
                                    $("#empty_list_div").removeClass('d-none');
                                }
                            }
                        }
                        $("#load_screen").addClass('d-none');
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
$("#list_scroll_data").on('scroll', function() {
    if ($(window).scrollTop() >= $('#list_data').offset().top + $('#list_data').outerHeight() - window.innerHeight && bottom_loader) {
        bottom_loader = false;
        callback_get_list_data();
    }
});
function callback_sort_by(column_name,sort_by){
    if($(".table thead th."+column_name+"_column svg").hasClass('rotated') == false){
        $(".table thead th svg").removeClass('rotated').addClass('d-none');
        $(".table thead th."+column_name+"_column svg").addClass('rotated').removeClass('d-none');
        column_sort_by = 'ASC';
    }else{
        $(".table thead th svg").removeClass('rotated').addClass('d-none');
        $(".table thead th."+column_name+"_column svg").removeClass('d-none');
        column_sort_by = 'DESC';
    }
    sort_column = column_name;
    list_count = 0;
    callback_get_list_data();
}
</script>