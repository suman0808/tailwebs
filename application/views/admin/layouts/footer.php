</div>
<script src="<?php echo base_url();?>assets/admin/bootstrap/js/popper.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/notification/snackbar/snackbar.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/assets/js/components/notification/custom-snackbar.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/assets/js/app.js"></script>
<script src="<?php echo base_url();?>assets/admin/assets/js/custom.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $("body nav#sidebar ul#navigationbar li a").each(function(){
            var href = $(this).attr('href');
            var current_url = "<?php echo 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' .$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>";
            if(href == current_url){
                $("body nav#sidebar ul#navigationbar li a").attr('aria-expanded','false');
                $(this).attr('aria-expanded','true').parents('li').addClass('active');
            }
        })
        App.init();
        <?php if(@$this->session->flashdata('msg')?:@$this->session->flashdata('errormsg')){?>
            Snackbar.show({
                text: '<?php echo $this->session->flashdata('msg')?:$this->session->flashdata('errormsg');?>',
                pos: 'bottom-center'
            });
        <?php }?>
    });
    $(document).on('click', 'a', function (e) {
        if ($(this).attr('href') == '#') {
            e.preventDefault();
        }
    });
    /*setInterval(function(){
        get_time();
    },1000)*/
    
    function callback_server_status() {
        var page_status = 0;
        $.ajax({
            method:"post",
            url:"<?php echo base_url('get-server-status'); ?>",
            data:{status:page_status},
            success:function(datas){
                var split_data = $.parseJSON(datas);
                if(typeof split_data !== undefined && split_data !='' && split_data !=null) {
                    if(split_data.type == 'redirect'){
                        var link = split_data.link;
                        if(link !=''){
                            window.location.href = "<?php echo base_url();?>"+link;
                        }
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
    <?php if(@$this->session->userdata('tailwebs_admin_type') != 1){?>
        callback_server_status();
        setInterval(function(){
            callback_server_status();
        },1000)
    <?php }?>
    function get_time() {
        $.ajax({
            method:"post",
            url:"<?php echo base_url('ad-gettime'); ?>",
            data:{},
            success:function(datetime){
                $("#datetime").html(datetime);
            }
        })
    }
    function callback_confirm_delete_list(message,id) {
        swal({
            title: "Are you sure?",
            text: message,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            buttons: [
                'No, cancel it!',
                'Yes, delete it!'
                ],
            dangerMode: true,
            closeOnConfirm: false,
            closeOnCancel: true,
            closeOnClickOutside: false,
            closeOnEsc: false
        }).then(function(isConfirm) {
            if(isConfirm){
                callback_delete_list(id);
            }else{
                return false;
            }
        })
    }
    $("#login_form").submit(function(e){
        $(".submit_btn").addClass('processing');
        $(".form_msg").html('');
        e.stopPropagation();
        e.preventDefault();
        var formdata = $(this).serialize();
        $.ajax({
            method:"post",
            url:"<?php echo base_url('ad-auth-login');?>",
            data:formdata,
            success:function(datas){
                var split_data = $.parseJSON(datas);
                if(typeof split_data !== undefined && split_data !='' && split_data !=null) {
                    if(split_data.type == 'error'){
                        var field_error_array = split_data.field_error;
                        if(typeof field_error_array !== undefined && field_error_array !='' && field_error_array !=null){
                            if(field_error_array.length > 0){
                                for(var i = 0; i < field_error_array.length; i++) {
                                    var field_array = field_error_array[i].split('||');
                                    $("."+field_array[0]).html(field_array[1]);
                                }
                            }else{
                                $('.main_msg').html('Something went wrong!');
                                $(".submit_btn").removeClass('processing');
                            }
                        }else{
                            $('.main_msg').html(split_data.msg);
                            $(".submit_btn").removeClass('processing');
                        }
                        $(".submit_btn").removeClass('processing');
                    }else if(split_data.type == 'redirect'){
                        var link = split_data.link;
                        window.location.href = "<?php echo base_url();?>"+link;
                        $(".submit_btn").removeClass('processing');
                    }else{
                        $('.main_msg').html('Something went wrong!');
                        $(".submit_btn").removeClass('processing');
                    }
                }else{
                    $('.main_msg').html('Something went wrong!');
                    $(".submit_btn").removeClass('processing');
                }
            },
            error:function(error){
                $('.main_msg').html(error.status+': '+error.statusText);
                $(".submit_btn").removeClass('processing');
            }
        })
    })
    var movement = 600;
    function noMovement() {
        if(movement == 0){
            <?php 
            $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
            $url_arr = explode(base_url(), $actual_link);
            $uri_link = '';
            if(@$url_arr[1]){
                $uri_link = @$url_arr[1];
            }
            ?>
            $.ajax({
                method:"post",
                url:"<?php echo base_url('ad-auth-set-lock');?>",
                data:{uri:"<?php echo @$uri_link;?>"},
                success:function(datas){
                    window.location.href='';
                }
            })             
        }else{
            movement--;
        }
    }
    function resetMovement() {
        movement=600;                    
    }
    $(document).ready(function(){
        $('html').mousemove(function(event){
            resetMovement();
        });
        $('html').click(function(event){
            resetMovement();
        });
        $('html').keyup(function(event){
            resetMovement();
        });
    });
    setInterval(function(){noMovement()}, 1000);
    function callback_set_lock(){
        movement = 0;
        noMovement();
    }
    <?php if($_SERVER['HTTP_HOST'] != 'localhost'){?>
        $(document).bind("contextmenu",function(e){
            return false;
        });
        document.onkeydown = function(e) {
            if(event.keyCode == 123) {
                return false;
            }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                return false;
            }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
                return false;
            }
            if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                return false;
            }
            if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                return false;
            }
        }
    <?php }?>
</script>
</body>
</html>