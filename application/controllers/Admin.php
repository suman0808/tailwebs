<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends CI_Controller {
    public function __construct(){
        parent::__construct();
        date_default_timezone_set("America/New_York");
        $this->load->model('Admin_data_model');
        $meta_info = $this->Admin_data_model->getSingleRow('meta_info','','','','mi_id ASC');
        if(@$meta_info->logo){
            $this->session->set_userdata('tailwebs_logo',$meta_info->logo);
        }
        if(@$meta_info->website_name){
            $this->session->set_userdata('tailwebs_website_name',$meta_info->website_name);
        }else{
            $this->session->set_userdata('tailwebs_website_name','Invicto Labs');
        }
        if(@$meta_info->meta_title){
            $this->session->set_userdata('tailwebs_meta_title',$meta_info->meta_title);
        }
        if(@$meta_info->footer_logo){
            $this->session->set_userdata('tailwebs_footer_logo',$meta_info->footer_logo);
        }
        if(@$meta_info->favicon){
            $this->session->set_userdata('tailwebs_favicon',$meta_info->favicon);
        }
        if(@$meta_info->copyright_year){
            $this->session->set_userdata('tailwebs_copyright_year',$meta_info->copyright_year);
        }else{
            $this->session->set_userdata('tailwebs_copyright_year',date('Y'));
        }
        $general_setting = $this->Admin_data_model->getSingleRow('general_setting','','','','gs_id ASC');
        if(@$general_setting->pri_color){
            $this->session->set_userdata('tailwebs_pri_color',$general_setting->pri_color);
        }else{
            $this->session->set_userdata('tailwebs_pri_color','#4361ee');
        }
        if(@$general_setting->sec_color){
            $this->session->set_userdata('tailwebs_sec_color',$general_setting->sec_color);
        }else{
            $this->session->set_userdata('tailwebs_sec_color','#304aca');
        }
        if(@$this->session->userdata('tailwebs_admin_logged_in')) {
            $where['admin_id'] = @$this->session->userdata('tailwebs_admin_id');
            $validate_data = $this->Admin_data_model->getSingleRow('admin',$where);
            if(@$validate_data){
                $sessiondata = array(
                    'tailwebs_admin_id' => @$validate_data->admin_id,
                    'tailwebs_admin_name' =>  @$validate_data->fullname,
                    'tailwebs_admin_email' =>  @$validate_data->email,
                    'tailwebs_admin_username' =>  @$validate_data->username,
                    'tailwebs_admin_type' =>  @$validate_data->admin_type,
                    'tailwebs_admin_level1' =>  explode(",", @$validate_data->level1),
                    'tailwebs_admin_level2' =>  explode(",", @$validate_data->level2),
                    'tailwebs_admin_image' =>  @$validate_data->profile_image?:'default_user.png',
                    'tailwebs_admin_logged_in' => TRUE,
                );
                $this->session->set_userdata($sessiondata);
            }
        }
    }
    function format_uri($string,$separator = '-'){
        $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
        $special_cases = array( '&' => 'and', "'" => '');
        $string = mb_strtolower( trim( $string ), 'UTF-8' );
        $string = urldecode($string);
        $string = str_replace( array_keys($special_cases), array_values( $special_cases), $string );
        $string = preg_replace( $accents_regex, '$1', htmlentities( $string, ENT_QUOTES, 'UTF-8' ) );
        $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
        $string = preg_replace("/[$separator]+/u", "$separator", $string);
        return $string;
    }
    function index(){
        $data = array();
        if(@$this->session->userdata('tailwebs_admin_lock')){
            $this->session->set_userdata('curr_uri','ad-auth');
            redirect('ad-auth-unlock');
        }else if(@$this->session->userdata('tailwebs_admin_logged_in')){
            redirect('ad-dashboard');
        }else{
            $this->layouts->adminview('admin/auth/login',$data,false);
        }
    }
    function login(){
        $response = array();        
        if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else if(@$this->session->userdata('tailwebs_admin_logged_in')) {
            $response['type'] = 'redirect';
            $response['link'] = 'ad-dashboard';
        }else{
            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            if($this->form_validation->run() == FALSE){
                $response['type'] = 'error';
                $input_keys = array_keys($this->input->post());
                foreach ($input_keys as $field){
                    if(@form_error($field)){
                        $response['field_error'][] = $field.'_msg||'.strip_tags(form_error($field));
                    }
                }
            }else{
                $where['username'] = $this->input->post('username');
                $password = $this->input->post('password');
                $validate_data = $this->Admin_data_model->getSingleRow('admin',$where);
                if(@$validate_data){
                    if($password != $this->encryption->decrypt(@$validate_data->password)) {
                        $response['type'] = 'error';
                        $response['field_error'][] = 'password_msg||Password invalid!';
                        //$response['field_error'][] = 'password_msg||'.$this->encryption->encrypt(@$password);
                    }else if(@!$validate_data->admin_status){
                        $response['type'] = 'error';
                        $response['field_error'][] = 'username_msg||Your account was deactivated by admin.';
                    }else{
                        $sessiondata = array(
                            'tailwebs_admin_id' => @$validate_data->admin_id,
                            'tailwebs_admin_name' =>  @$validate_data->fullname,
                            'tailwebs_admin_email' =>  @$validate_data->email,
                            'tailwebs_admin_username' =>  @$validate_data->username,
                            'tailwebs_admin_type' =>  @$validate_data->admin_type,
                            'tailwebs_admin_level1' =>  explode(",", @$validate_data->level1),
                            'tailwebs_admin_level2' =>  explode(",", @$validate_data->level2),
                            'tailwebs_admin_image' =>  @$validate_data->profile_image?:'default_user.png',
                            'tailwebs_admin_logged_in' => TRUE,
                        );
                        $this->session->set_userdata($sessiondata);
                        $unset_sessiondata = array(
                            'tailwebs_user_id',
                            'tailwebs_user_fullname',
                            'tailwebs_user_email',
                            'tailwebs_user_mobile',
                            'tailwebs_user_image',
                            'tailwebs_user_logged_in',
                        );
                        $this->session->unset_userdata($unset_sessiondata);
                        $this->session->set_flashdata('msg', 'Logged in successfully');
                        $response['type'] = 'redirect';
                        $response['link'] = 'ad-dashboard';
                    }
                }else{
                    $response['type'] = 'error';
                    $response['field_error'][] = 'username_msg||Username not registed with us.';
                }
            }
        }
        echo json_encode($response);
    }
    function recovery(){
        $data = array();
        if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else if(@$this->session->userdata('tailwebs_admin_logged_in')){
            redirect('ad-dashboard');
        }else{
            $this->layouts->adminview('admin/auth/recovery',$data,false);
        }
    }
    function recovery_form(){
        $response = array();        
        if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else if(@$this->session->userdata('tailwebs_admin_logged_in')) {
            $response['type'] = 'redirect';
            $response['link'] = 'ad-dashboard';
        }else{
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
            if($this->form_validation->run() == FALSE){
                $response['type'] = 'error';
                $input_keys = array_keys($this->input->post());
                foreach ($input_keys as $field){
                    if(@form_error($field)){
                        $response['field_error'][] = $field.'_msg||'.strip_tags(form_error($field));
                    }
                }
            }else{
                $where['email'] = $this->input->post('email');
                $validate_data = $this->Admin_data_model->getSingleRow('admin',$where);
                if(@$validate_data){
                    $this->session->set_userdata('tailwebs_admin_id',@$validate_data->admin_id);
                    $this->session->set_userdata('tailwebs_admin_email',@$validate_data->email);
                    $response['type'] = $this->send();
                }else{
                    $response['type'] = 'error';
                    $response['field_error'][] = 'email_msg||Email not registed with us.';
                }
            }
        }
        echo json_encode($response);
    }
    function send($no_redirect='')  {
        $otp = rand(100000,999999);
        $inputs=array(
            'otp'=>$otp,
            'otp_generated_on'=>date('Y-m-d H:i:s'),
        );
        $where['admin_id'] = $this->session->userdata('tailwebs_admin_id');
        $this->Admin_data_model->updateData('admin',$where,$inputs);
        $get_ea['ea_status'] = 1;
        $get_ea['email_type'] = 'otp';
        $email_account = $this->Admin_data_model->getSingleRow('email_accounts',$get_ea);
        if(!@$email_account){
            $get_ea['email_type'] = 'default';
            $email_account = $this->Admin_data_model->getSingleRow('email_accounts',$get_ea);
        }
        $this->email->set_mailtype("html");
        if(@$email_account->smtp_status){
            $config['protocol'] = 'smtp';
            $config['smtp_host'] = @$email_account->smtp_host;
            $config['smtp_user'] = @$email_account->smtp_user;
            $config['smtp_pass'] = @$email_account->smtp_pass;
            $config['smtp_port'] = @$email_account->smtp_port;
            $config['smtp_crypto'] = @$email_account->smtp_crypto;
            $config['smtp_timeout'] = '5';
        }
        $config['charset']='utf-8';
        $config['newline']="\r\n";
        $this->email->initialize($config);
        $this->email->from(@$email_account->email,@$email_account->username);
        $this->email->to($this->session->userdata('tailwebs_admin_email'));
        $this->email->set_newline("\r\n");
        $this->email->set_crlf("\r\n");
        $this->email->subject('Account Verification');
        $mail_data['subject'] = 'Hello!';
        $mail_data['message'] = "The verification code for your forgot password is ".$otp;
        $email_template = $this->load->view('email_template/account_verification',$mail_data,TRUE);
        $this->email->message(urldecode($email_template));
        if($this->email->send()){
            if(@$no_redirect){
                echo 'success';
            }else{
                return 'success'; 
            }
        }else{
            if(@$no_redirect){
                echo 'error';
            }else{
                return 'error'; 
            }
        }
    }
    function verify_form(){
        $response = array();        
        if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else if(@$this->session->userdata('tailwebs_admin_logged_in')) {
            $response['type'] = 'redirect';
            $response['link'] = 'ad-dashboard';
        }else{
            $otp = $this->input->post('otp_1').$this->input->post('otp_2').$this->input->post('otp_3').$this->input->post('otp_4').$this->input->post('otp_5').$this->input->post('otp_6');
            if(@$otp >= 6){
                $where['admin_id'] = $this->session->userdata('tailwebs_admin_id');
                $where['otp'] = $otp;
                $validate_data = $this->Admin_data_model->getSingleRow('admin',$where);
                if(@$validate_data){
                    $date1 = new DateTime(date('Y-m-d H:i:s'));
                    $date2 = new DateTime(@$validate_data->otp_generated_on);
                    $interval = $date1->diff($date2);
                    if($interval->h == 0 && $interval->d == 0){
                        if($interval->i >= 2){
                            $response['type'] = 'error';
                            $response['msg'] = 'Verification code is expired, generate new code';
                            echo json_encode($response);
                            exit;
                        }
                    }else{
                        $response['type'] = 'error';
                        $response['msg'] = 'Verification code is expired, generate new code';
                        echo json_encode($response);
                        exit;
                    }
                    $response['type'] = 'success';
                    $response['msg'] = 'Code verified successfully';
                }else{
                    $response['type'] = 'error';
                    $response['field_error'][] = 'otp_msg||OTP is invalid!';
                }
            }
        }
        echo json_encode($response);
    }
    function reset_password_form(){
        $response = array();        
        if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else if(@$this->session->userdata('tailwebs_admin_logged_in')) {
            $response['type'] = 'redirect';
            $response['link'] = 'ad-dashboard';
        }else{
            $this->form_validation->set_rules('new-password', 'Password', 'trim|required|xss_clean|min_length[6]|max_length[30]');
            $this->form_validation->set_rules('confirm-password', 'Confirm Password', 'trim|required|xss_clean|matches[new-password]|min_length[6]|max_length[30]');
            if($this->form_validation->run() == FALSE){
                $response['type'] = 'error';
                $input_keys = array_keys($this->input->post());
                foreach ($input_keys as $field){
                    if(@form_error($field)){
                        $response['field_error'][] = $field.'_msg||'.strip_tags(form_error($field));
                    }
                }
            }else{
                $inputs['password'] = $this->encryption->encrypt($this->input->post('confirm-password'));
                $where['admin_id'] = $this->session->userdata('tailwebs_admin_id');
                $update_table = $this->Admin_data_model->updateData('admin',$where,$inputs);
                if(@$update_table){
                    $this->session->set_flashdata('msg', 'Password changed successfully');
                    $response['type'] = 'redirect';
                    $response['link'] = 'ad-auth';
                }else{
                    $response['type'] = 'error';
                    $response['msg'] = 'Something went wrong!';
                }
            }
        }
        echo json_encode($response);
    }
    function unlock(){
        $data = array();
        if(@$this->session->userdata('tailwebs_admin_lock')){
            if(@$this->session->userdata('tailwebs_admin_logged_in')){
                $this->layouts->adminview('admin/auth/unlock',$data,false);
            }else{
                $this->session->unset_userdata('tailwebs_admin_lock');
                redirect('ad-auth');
            }
        }else if(@$this->session->userdata('tailwebs_admin_logged_in')){
            redirect('ad-dashboard');
        }else{
            redirect('ad-auth');
        }
    }
    function unlock_form(){
        $response = array();     
        if(@$this->session->userdata('tailwebs_admin_lock')){
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
            if($this->form_validation->run() == FALSE){
                $response['type'] = 'error';
                $input_keys = array_keys($this->input->post());
                foreach ($input_keys as $field){
                    if(@form_error($field)){
                        $response['field_error'][] = $field.'_msg||'.strip_tags(form_error($field));
                    }
                }
            }else{
                $where['admin_id'] = $this->session->userdata('tailwebs_admin_id');
                $password = $this->input->post('password');
                $validate_data = $this->Admin_data_model->getSingleRow('admin',$where);
                if(@$validate_data){
                    if($password != $this->encryption->decrypt(@$validate_data->password)) {
                        $response['type'] = 'error';
                        $response['field_error'][] = 'password_msg||Password invalid!';
                    }else if(@!$validate_data->admin_status){
                        $response['type'] = 'error';
                        $response['msg'] = 'Your account was deactivated by admin.';
                    }else{
                        $curr_uri = $this->session->userdata('curr_uri');
                        $this->session->unset_userdata('tailwebs_admin_lock');
                        $this->session->unset_userdata('curr_uri');
                        $this->session->set_flashdata('msg', 'Unlocked successfully');
                        $response['type'] = 'redirect';
                        $response['link'] = $curr_uri;
                    }
                }else{
                    $response['type'] = 'error';
                    $response['field_error'][] = 'username_msg||Username not registed with us.';
                }
            }
        }else if(@$this->session->userdata('tailwebs_admin_logged_in')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-dashboard';
        }else{
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth';
        }
        echo json_encode($response);
    }
    function set_lock(){
        $this->session->set_userdata('tailwebs_admin_lock',TRUE);
        $this->session->set_userdata('curr_uri',$this->input->post('uri'));
    }
    function gettime(){
        echo date('M d, Y h:i:s');
    }
    function dashboard(){
        $data = array();
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            redirect('ad-auth');
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $this->session->set_userdata('curr_uri','ad-dashboard');
            redirect('ad-auth-unlock');
        }else{
            if(@$this->session->userdata('tailwebs_admin_type') <=1 ){
                $data['meta_title'] = 'Admin Dashboard';
            }
            $this->layouts->adminview('admin/dashboard',$data,true);
        }
    }
    function profile(){
        $data = array();
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            redirect('ad-auth');
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $this->session->set_userdata('curr_uri','ad-profile');
            redirect('ad-auth-unlock');
        }else{
            $data['meta_title'] = 'Profile';
            $where['admin_id'] = @$this->session->userdata('tailwebs_admin_id');
            $data['editrow'] = $this->Admin_data_model->getSingleRow('admin',$where);
            $this->layouts->adminview('admin/profile',$data,true);
        }
    }
    function profile_form(){
        $response = array();     
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth';
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else{
            $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|callback__check_admin_username');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback__check_admin_email');
            if(@$this->form_validation->run('fullname') == TRUE && @$this->form_validation->run('username') == TRUE && @$this->form_validation->run('email')){
                if (!@empty($_FILES['profile_image']['name'])) {
                    $this->form_validation->set_rules('profile_image', 'Image', 'trim|xss_clean|callback__verify_profile_image_file_and_upload');
                }
            }
            if($this->form_validation->run() == FALSE){
                $response['type'] = 'error';
                $input_keys = array_keys($this->input->post());
                foreach ($input_keys as $field){
                    if(@form_error($field)){
                        $response['field_error'][] = $field.'_msg||'.strip_tags(form_error($field));
                    }
                }
                if(@form_error('profile_image')){
                    $response['field_error'][] = 'profile_image_msg||'.strip_tags(@form_error('profile_image'));
                }
            }else{
                $inputs['fullname'] = $this->input->post('fullname');
                $inputs['username'] = $this->input->post('username');
                $inputs['email'] = $this->input->post('email');
                $inputs['profile_image'] = @$this->input->post('profile_image_old')?:NULL;
                if(!empty($this->filedata)){
                    if(@$this->input->post('profile_image_old')){
                        if(file_exists('assets/uploads/customers/'.$this->input->post('profile_image_old'))){
                            unlink('assets/uploads/customers/'.$this->input->post('profile_image_old'));
                        }
                    }
                    $inputs['profile_image']=$this->filedata['file_name'];
                }else if(@$this->input->post('image_removed')){
                    if(@$this->input->post('profile_image_old')){
                        if(file_exists('assets/uploads/customers/'.$this->input->post('profile_image_old'))){
                            unlink('assets/uploads/customers/'.$this->input->post('profile_image_old'));
                        }
                    }
                    $inputs['profile_image']=NULL;
                }
                $where['admin_id'] = @$this->input->post('admin_id');
                $update_table = $this->Admin_data_model->updateData('admin',$where,$inputs);
                if(@$update_table){
                    $sessiondata = array(
                        'tailwebs_admin_name' =>  @$inputs['fullname'],
                        'tailwebs_admin_username' =>  @$inputs['username'],
                        'tailwebs_admin_image' =>  @$inputs['profile_image']?:'default_user.png',
                    );
                    $this->session->set_userdata($sessiondata);
                    $this->session->set_flashdata('msg', 'Profile updated successfully');
                    $response['type'] = 'redirect';
                    $response['link'] = 'ad-profile';
                }else{
                    $response['type'] = 'error';
                    $response['msg'] = 'Something went wrong!';
                }
            }
        }
        echo json_encode($response);
    }
    function _check_admin_username(){
        $where['username'] = @$this->input->post('username');
        $where_not[] = 'admin_id,'.@$this->input->post('admin_id');
        $validate_data = $this->Admin_data_model->getSingleRow('admin',$where,$where_not);
        if(@$validate_data){
            $this->form_validation->set_message('_check_admin_username','Username already taken!');
            return false;
        }else{
            return true;
        }
    }
    function _check_admin_email(){
        $where['email'] = @$this->input->post('email');
        $where_not[] = 'admin_id,'.@$this->input->post('admin_id');
        $validate_data = $this->Admin_data_model->getSingleRow('admin',$where,$where_not);
        if(@$validate_data){
            $this->form_validation->set_message('_check_admin_email','Email already taken!');
            return false;
        }else{
            return true;
        }
    }
    function _verify_profile_image_file_and_upload() {  
        $inputs = $this->input->post();
        $config['upload_path'] =  'assets/uploads/customers';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '1500';
        $this->load->library('upload', $config);
        $this->upload->initialize($config); 
        if (!$this->upload->do_upload('profile_image')){
            $error = $this->upload->display_errors();
            $this->form_validation->set_message('_verify_profile_image_file_and_upload', $error);
            return false;
        }
        else{
            $data = array('upload_data' => $this->upload->data());
            $this->filedata = $data['upload_data'];
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = $data['upload_data']['full_path'];
            $config['width'] = 100;
            $config['height'] = 100;
            $config['maintain_ratio'] = TRUE;
            $this->image_lib->initialize($config);
            if(!@$this->image_lib->resize()){
                $this->form_validation->set_message('_verify_profile_image_file_and_upload', $this->image_lib->display_errors());
                return false;
            }else{
                return true;
            }
        }
    }

    function password_form(){
        $response = array();     
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth';
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else{
            $this->form_validation->set_rules('current-password', 'Current Password', 'trim|required|xss_clean|callback__match_current_password');
            $this->form_validation->set_rules('new-password', 'Password', 'trim|required|xss_clean|differs[current-password]|min_length[6]|max_length[30]');
            $this->form_validation->set_rules('confirm-password', 'Confirm Password', 'trim|required|xss_clean|matches[new-password]|min_length[6]|max_length[30]');
            if($this->form_validation->run() == FALSE){
                $response['type'] = 'error';
                $input_keys = array_keys($this->input->post());
                foreach ($input_keys as $field){
                    if(@form_error($field)){
                        $response['field_error'][] = $field.'_msg||'.strip_tags(form_error($field));
                    }
                }
            }else{
                $inputs['password'] = $this->encryption->encrypt($this->input->post('confirm-password'));
                $where['admin_id'] = $this->session->userdata('tailwebs_admin_id');
                $update_table = $this->Admin_data_model->updateData('admin',$where,$inputs);
                if(@$update_table){
                    $curr_uri = $this->session->set_userdata('curr_uri','ad-dashboard');
                    $this->session->set_userdata('tailwebs_admin_lock',TRUE);
                    $this->session->set_flashdata('msg', 'Password changed successfully');
                    $response['type'] = 'redirect';
                    $response['link'] = 'ad-auth-unlock';
                }else{
                    $response['type'] = 'error';
                    $response['msg'] = 'Something went wrong!';
                }
            }
        }
        echo json_encode($response);
    }
    function _match_current_password(){
        $where['admin_id'] = @$this->session->userdata('tailwebs_admin_id');
        $validate_data = $this->Admin_data_model->getSingleRow('admin',$where);
        if(@$validate_data){
            if(@$this->input->post('current-password')){
                if(@$this->input->post('current-password') != $this->encryption->decrypt($validate_data->password)) {
                    $this->form_validation->set_message('_match_current_password','Invalid current password!');
                    return false;
                }else{
                    return true;
                }
            }
        }else{
            $this->form_validation->set_message('_match_current_password','Invalid information!');
            return false;
        }
    }
    function website_settings(){
        $data = array();
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            redirect('ad-auth');
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $this->session->set_userdata('curr_uri','ad-website-settings');
            redirect('ad-auth-unlock');
        }else if(@$this->session->userdata('tailwebs_admin_type') > 1){
            $this->session->set_flashdata('errormsg', 'Access denied!');
            redirect('ad-dashboard');
        }else{
            $data['meta_title'] = 'Website Settings';
            $where['admin_id'] = @$this->session->userdata('tailwebs_admin_id');
            $data['editrow'] = $this->Admin_data_model->getSingleRow('admin',$where);
            $this->layouts->adminview('admin/settings/website_settings',$data,true);
        }
    }
    function website_form_page(){
        $response = array();     
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth';
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else if(@$this->session->userdata('tailwebs_admin_type') > 1){
            $response['type'] = 'error';
            $response['msg'] = 'Access denied!';
        }else{
            $form_page = $this->input->post('form_page');
            if(@$form_page == 'meta_info'){
                $data['editrow'] = $this->Admin_data_model->getSingleRow('meta_info','','','','mi_id ASC');
                $response['type'] = 'success';
                $response['formpage'] = $this->load->view('admin/settings/meta_info',$data,true);
            }else if(@$form_page == 'general_setting'){
                $data['editrow'] = $this->Admin_data_model->getSingleRow('general_setting','','','','gs_id ASC');
                $response['type'] = 'success';
                $response['formpage'] = $this->load->view('admin/settings/general_setting',$data,true);
            }else if(@$form_page == 'invoice_info'){
                $data['editrow'] = $this->Admin_data_model->getSingleRow('invoice_info','','','','inv_id ASC');
                $response['type'] = 'success';
                $response['formpage'] = $this->load->view('admin/settings/invoice_info',$data,true);
            }else if(@$form_page == 'email_accounts'){
                $data['lists'] = $this->Admin_data_model->getRow('email_accounts','','','','ea_id ASC');
                $response['type'] = 'success';
                $response['formpage'] = $this->load->view('admin/settings/email_accounts/lists',$data,true);
            }else if(@$form_page == 'email_account_form'){
                $where['ea_id'] = $this->input->post('edit_id');
                $data['editrow'] = $this->Admin_data_model->getSingleRow('email_accounts',$where);
                $response['type'] = 'success';
                $response['formpage'] = $this->load->view('admin/settings/email_accounts/form_data',$data,true);
            }else if(@$form_page == 'plugin_script'){
                $data['editrow'] = $this->Admin_data_model->getSingleRow('plugin_script','','','','ps_id ASC');
                $response['type'] = 'success';
                $response['formpage'] = $this->load->view('admin/settings/plugin_script',$data,true);
            }
        }
        echo json_encode(@$response);
    }
    function plugin_script_form(){
        $response = array();     
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth';
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else if(@$this->session->userdata('tailwebs_admin_type') > 1){
            $response['type'] = 'error';
            $response['msg'] = 'Access denied!';
        }else{
            $this->form_validation->set_rules('header_script', 'Header Script', 'trim');
            $this->form_validation->set_rules('footer_script', 'Footer Script', 'trim');
            if($this->form_validation->run() == FALSE){
                $response['type'] = 'error';
                $input_keys = array_keys($this->input->post());
                foreach ($input_keys as $field){
                    if(@form_error($field)){
                        $response['field_error'][] = $field.'_msg||'.strip_tags(form_error($field));
                    }
                }
            }else{
                $inputs = $this->input->post();
                $where['ps_id'] = @$this->input->post('ps_id');
                if(@$where['ps_id']){
                    $update_table = $this->Admin_data_model->updateData('plugin_script',$where,$inputs);
                }else{
                    $insert_table = $this->Admin_data_model->saveData('plugin_script',$inputs);
                }
                if(@$update_table || @$insert_table){
                    $response['type'] = 'success';
                }else{
                    $response['type'] = 'error';
                    $response['msg'] = 'Something went wrong!';
                }
            }
        }
        echo json_encode($response);
    }
    function meta_info_form(){
        $response = array();     
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth';
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else if(@$this->session->userdata('tailwebs_admin_type') > 1){
            $response['type'] = 'error';
            $response['msg'] = 'Access denied!';
        }else{
            $this->form_validation->set_rules('website_name', 'Website Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required|xss_clean');
            $this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'trim|xss_clean');
            $this->form_validation->set_rules('copyright_year', 'Year', 'trim|xss_clean');
            if(@$this->form_validation->run('website_name') == TRUE && @$this->form_validation->run('meta_title') == TRUE && @$this->form_validation->run('meta_description')){
                if (!@empty($_FILES['logo']['name']) || @$this->input->post('image_removed_logo') || !@$this->input->post('logo_old')) {
                    $this->form_validation->set_rules('logo', 'Image', 'trim|xss_clean|callback__verify_header_logo_file_and_upload');
                }
                if (!@empty($_FILES['favicon']['name']) || @$this->input->post('image_removed_favicon') || !@$this->input->post('favicon_old')) {
                    $this->form_validation->set_rules('favicon', 'Image', 'trim|xss_clean|callback__verify_favicon_file_and_upload');
                }
                if (!@empty($_FILES['footer_logo']['name'])) {
                    $this->form_validation->set_rules('footer_logo', 'Image', 'trim|xss_clean|callback__verify_footer_logo_file_and_upload');
                }
            }
            if($this->form_validation->run() == FALSE){
                $response['type'] = 'error';
                $input_keys = array_keys($this->input->post());
                foreach ($input_keys as $field){
                    if(@form_error($field)){
                        $response['field_error'][] = $field.'_msg||'.strip_tags(form_error($field));
                    }
                }
                if(@form_error('logo')){
                    $response['field_error'][] = 'logo_msg||'.strip_tags(@form_error('logo'));
                }
                if(@form_error('favicon')){
                    $response['field_error'][] = 'favicon_msg||'.strip_tags(@form_error('favicon'));
                }
            }else{
                $inputs['website_name'] = $this->input->post('website_name');
                $inputs['meta_title'] = $this->input->post('meta_title');
                $inputs['meta_description'] = $this->input->post('meta_description');
                $inputs['meta_keywords'] = @$this->input->post('meta_keywords')?:NULL;
                $inputs['meta_keywords'] = @$this->input->post('meta_keywords')?:NULL;
                $inputs['copyright_year'] = @$this->input->post('copyright_year')?:NULL;
                if(!empty($this->filedata)){
                    if(@$this->input->post('logo_old')){
                        if(file_exists('assets/uploads/meta_info/'.$this->input->post('logo_old'))){
                            unlink('assets/uploads/meta_info/'.$this->input->post('logo_old'));
                        }
                    }
                    $inputs['logo']=$this->filedata['file_name'];
                }else if(@$this->input->post('image_removed_logo')){
                    if(@$this->input->post('logo_old')){
                        if(file_exists('assets/uploads/meta_info/'.$this->input->post('logo_old'))){
                            unlink('assets/uploads/meta_info/'.$this->input->post('logo_old'));
                        }
                    }
                    $inputs['logo']=NULL;
                }
                if(!empty($this->filedata2)){
                    if(@$this->input->post('favicon_old')){
                        if(file_exists('assets/uploads/meta_info/'.$this->input->post('favicon_old'))){
                            unlink('assets/uploads/meta_info/'.$this->input->post('favicon_old'));
                        }
                    }
                    $inputs['favicon']=$this->filedata2['file_name'];
                }else if(@$this->input->post('image_removed_favicon')){
                    if(@$this->input->post('favicon_old')){
                        if(file_exists('assets/uploads/meta_info/'.$this->input->post('favicon_old'))){
                            unlink('assets/uploads/meta_info/'.$this->input->post('favicon_old'));
                        }
                    }
                    $inputs['favicon']=NULL;
                }
                if(!empty($this->filedata3)){
                    if(@$this->input->post('footer_logo_old')){
                        if(file_exists('assets/uploads/meta_info/'.$this->input->post('footer_logo_old'))){
                            unlink('assets/uploads/meta_info/'.$this->input->post('footer_logo_old'));
                        }
                    }
                    $inputs['footer_logo']=$this->filedata3['file_name'];
                }else if(@$this->input->post('image_removed_footer_logo')){
                    if(@$this->input->post('footer_logo_old')){
                        if(file_exists('assets/uploads/meta_info/'.$this->input->post('footer_logo_old'))){
                            unlink('assets/uploads/meta_info/'.$this->input->post('footer_logo_old'));
                        }
                    }
                    $inputs['footer_logo']=NULL;
                }
                $where['mi_id'] = @$this->input->post('mi_id');
                if(@$where['mi_id']){
                    $update_table = $this->Admin_data_model->updateData('meta_info',$where,$inputs);
                }else{
                    $insert_table = $this->Admin_data_model->saveData('meta_info',$inputs);
                }
                if(@$update_table || @$insert_table){
                    $response['type'] = 'success';
                }else{
                    $response['type'] = 'error';
                    $response['msg'] = 'Something went wrong!';
                }
            }
        }
        echo json_encode($response);
    }
    function _verify_header_logo_file_and_upload() {  
        $inputs = $this->input->post();
        $config['upload_path'] =  'assets/uploads/meta_info';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = '1500';
        $this->load->library('upload', $config);
        $this->upload->initialize($config); 
        if (!$this->upload->do_upload('logo')){
            $error = $this->upload->display_errors();
            $this->form_validation->set_message('_verify_header_logo_file_and_upload', $error);
            return false;
        }
        else{
            $data = array('upload_data' => $this->upload->data());
            $this->filedata = $data['upload_data'];
            $this->load->library('image_lib');
            $config['image_library'] = 'gd2';
            $config['source_image'] = $data['upload_data']['full_path'];
            $config['x_axis'] = $inputs['file_xaxis_logo'];
            $config['y_axis'] = $inputs['file_yaxis_logo'];
            $config['width'] = $inputs['file_width_logo'];
            $config['height'] = $inputs['file_height_logo'];
            $config['maintain_ratio'] = FALSE;
            $this->image_lib->initialize($config);
            if(!@$this->image_lib->crop()){
                $this->form_validation->set_message('_verify_header_logo_file_and_upload', $this->image_lib->display_errors());
                return false;
            }else{
                $config = array();
                $config['image_library'] = 'gd2';
                $config['source_image'] = $data['upload_data']['full_path'];
                $config['width'] = 600;
                $config['height'] = 200;
                $config['maintain_ratio'] = TRUE;
                $this->image_lib->initialize($config);
                if(!@$this->image_lib->resize()){
                    $this->form_validation->set_message('_verify_header_logo_file_and_upload', $this->image_lib->display_errors());
                    return false;
                }else{
                    return true;
                }
            }
        }
    }
    function _verify_favicon_file_and_upload() {  
        $inputs = $this->input->post();
        $config2['upload_path'] =  'assets/uploads/meta_info';
        $config2['allowed_types'] = 'jpg|png|jpeg';
        $config2['encrypt_name'] = TRUE;
        $config2['max_size'] = '1500';
        $this->load->library('upload', $config2);
        $this->upload->initialize($config2); 
        if (!$this->upload->do_upload('favicon')){
            $error = $this->upload->display_errors();
            $this->form_validation->set_message('_verify_favicon_file_and_upload', $error);
            return false;
        }
        else{
            $data = array('upload_data' => $this->upload->data());
            $this->filedata2 = $data['upload_data'];
            $this->load->library('image_lib');
            $config2['image_library'] = 'gd2';
            $config2['source_image'] = $data['upload_data']['full_path'];
            $config2['x_axis'] = $inputs['file_xaxis_favicon'];
            $config2['y_axis'] = $inputs['file_yaxis_favicon'];
            $config2['width'] = $inputs['file_width_favicon'];
            $config2['height'] = $inputs['file_height_favicon'];
            $config2['maintain_ratio'] = FALSE;
            $this->image_lib->initialize($config2);
            if(!@$this->image_lib->crop()){
                $this->form_validation->set_message('_verify_favicon_file_and_upload', $this->image_lib->display_errors());
                return false;
            }else{
                $config2 = array();
                $config2['image_library'] = 'gd2';
                $config2['source_image'] = $data['upload_data']['full_path'];
                $config2['width'] = 50;
                $config2['height'] = 50;
                $config2['maintain_ratio'] = TRUE;
                $this->image_lib->initialize($config2);
                if(!@$this->image_lib->resize()){
                    $this->form_validation->set_message('_verify_favicon_file_and_upload', $this->image_lib->display_errors());
                    return false;
                }else{
                    return true;
                }
            }
        }
    }
    function _verify_footer_logo_file_and_upload() {  
        $inputs = $this->input->post();
        $config3['upload_path'] =  'assets/uploads/meta_info';
        $config3['allowed_types'] = 'jpg|png|jpeg';
        $config3['encrypt_name'] = TRUE;
        $config3['max_size'] = '1500';
        $this->load->library('upload', $config3);
        $this->upload->initialize($config3); 
        if (!$this->upload->do_upload('footer_logo')){
            $error = $this->upload->display_errors();
            $this->form_validation->set_message('_verify_footer_logo_file_and_upload', $error);
            return false;
        }
        else{
            $data = array('upload_data' => $this->upload->data());
            $this->filedata3 = $data['upload_data'];
            $this->load->library('image_lib');
            $config3['image_library'] = 'gd2';
            $config3['source_image'] = $data['upload_data']['full_path'];
            $config3['x_axis'] = $inputs['file_xaxis_footer_logo'];
            $config3['y_axis'] = $inputs['file_yaxis_footer_logo'];
            $config3['width'] = $inputs['file_width_footer_logo'];
            $config3['height'] = $inputs['file_height_footer_logo'];
            $config3['maintain_ratio'] = FALSE;
            $this->image_lib->initialize($config3);
            if(!@$this->image_lib->crop()){
                $this->form_validation->set_message('_verify_footer_logo_file_and_upload', $this->image_lib->display_errors());
                return false;
            }else{
                $config3 = array();
                $config3['image_library'] = 'gd2';
                $config3['source_image'] = $data['upload_data']['full_path'];
                $config3['width'] = 600;
                $config3['height'] = 200;
                $config3['maintain_ratio'] = TRUE;
                $this->image_lib->initialize($config3);
                if(!@$this->image_lib->resize()){
                    $this->form_validation->set_message('_verify_footer_logo_file_and_upload', $this->image_lib->display_errors());
                    return false;
                }else{
                    return true;
                }
            }
        }
    }
    function general_setting_form(){
        $response = array();     
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth';
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else if(@$this->session->userdata('tailwebs_admin_type') > 1){
            $response['type'] = 'error';
            $response['msg'] = 'Access denied!';
        }else{
            $this->form_validation->set_rules('pri_color', 'Primary Color', 'trim|required|xss_clean');
            $this->form_validation->set_rules('sec_color', 'Secondary Color', 'trim|required|xss_clean');
            $this->form_validation->set_rules('website_status', 'Website Status', 'trim|required|xss_clean');
            if(@$this->input->post('website_status') == 2){
                $this->form_validation->set_rules('launch_datetime', 'Launch Date & Time', 'trim|required|xss_clean');
            }
            if($this->form_validation->run() == FALSE){
                $response['type'] = 'error';
                $input_keys = array_keys($this->input->post());
                foreach ($input_keys as $field){
                    if(@form_error($field)){
                        $response['field_error'][] = $field.'_msg||'.strip_tags(form_error($field));
                    }
                }
            }else{
                $inputs['pri_color'] = @$this->input->post('pri_color')?:NULL;
                $inputs['sec_color'] = @$this->input->post('sec_color')?:NULL;
                $inputs['website_status'] = @$this->input->post('website_status')?:0;
                $inputs['launch_datetime'] = @$this->input->post('launch_datetime')?:NULL;
                if(@$this->input->post('website_status') != 2){
                    $inputs['launch_datetime'] = NULL;
                }
                $where['gs_id'] = @$this->input->post('gs_id');
                if(@$where['gs_id']){
                    $update_table = $this->Admin_data_model->updateData('general_setting',$where,$inputs);
                }else{
                    $insert_table = $this->Admin_data_model->saveData('general_setting',$inputs);
                }
                if(@$update_table || @$insert_table){
                    $response['type'] = 'success';
                }else{
                    $response['type'] = 'error';
                    $response['msg'] = 'Something went wrong!';
                }
            }
        }
        echo json_encode($response);
    }
    //User Management
    //Admin Users
    function admin_users(){
        $data=array();
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            redirect('ad-auth');
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $this->session->set_userdata('curr_uri','ad-admin-users');
            redirect('ad-auth-unlock');
        }else if(@$this->session->userdata('tailwebs_admin_type') != 1){
            $this->session->set_flashdata('errormsg', 'Access denied!');
            redirect('ad-dashboard');
        }else{
            $data['meta_title'] = 'Admin Users';
            $this->layouts->adminview('admin/user_management/admin_users/lists',$data,TRUE);      
        }
    }
    function get_admin_user_lists(){
        $response = array();     
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth';
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else if(@$this->session->userdata('tailwebs_admin_type') != 1){
            $response['type'] = 'error';
            $response['msg'] = 'Access denied!';
        }else{
            $data = $where = $like = array();
            $limit = $this->input->post('results');
            $offset = @$this->input->post('list_count')?:0;
            $data['offset'] = $offset;
            if(@$this->input->post('keyword')){
                $query = @$this->input->post('keyword');
                $like = "(fullname like '%$query%' or email like '%$query%' or username like '%$query%')";
            }
            if(@$this->input->post('sort_column') && @$this->input->post('sort_by')){
                $sort_column = str_replace("--", ".", @$this->input->post('sort_column'));
                $sort_by = @$sort_column.' '.@$this->input->post('sort_by');
            }else{
                $sort_by = 'fullname ASC';
            }
            $where['admin_type'] = 0;
            $data['lists'] = $this->Admin_data_model->getRow('admin',$where,'','',$sort_by,$limit,$offset,$like);
            $response['count'] = count(@$data['lists']);
            $response['type'] = 'success';
            $response['list_data'] = $this->load->view('admin/user_management/admin_users/list_data',$data,true);
        }
        echo json_encode(@$response);
    }
    function admin_user_form(){
        $response = array();     
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth';
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else if(@$this->session->userdata('tailwebs_admin_type') != 1){
            $response['type'] = 'error';
            $response['msg'] = 'Access denied!';
        }else{
            $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|callback__check_admin_username');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback__check_admin_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[6]|max_length[30]');
            if($this->form_validation->run() == FALSE){
                $response['type'] = 'error';
                $input_keys = array_keys($this->input->post());
                foreach ($input_keys as $field){
                    if(@form_error($field)){
                        $response['field_error'][] = $field.'_msg||'.strip_tags(form_error($field));
                    }
                }
            }else{
                $inputs['fullname'] = $this->input->post('fullname');
                $inputs['username'] = $this->input->post('username');
                $inputs['email'] = $this->input->post('email');
                $inputs['admin_status'] = 1;
                $inputs['admin_type'] = 0;
                $inputs['updated_on'] = date('Y-m-d H:i:s');
                $inputs['password'] = $this->encryption->encrypt($this->input->post('password'));
                $where['admin_id'] = @$this->input->post('admin_id');
                if(@$this->input->post('admin_id')){
                    $update_table = $this->Admin_data_model->updateData('admin',$where,$inputs);
                }else{
                    $insert_table = $this->Admin_data_model->saveData('admin',$inputs);
                }
                if(@$update_table){
                    $response['type'] = 'updated';
                    $data['list_type'] = 1;
                    $data['list'] = $this->Admin_data_model->getSingleRow('admin',$where);
                    $response['list_data'] = $this->load->view('admin/user_management/admin_users/single_list_data',$data,true);
                }else if(@$insert_table){
                    $response['type'] = 'added';
                    $data['list_type'] = 0;
                    $where['admin_id'] = @$insert_table;
                    $data['list'] = $this->Admin_data_model->getSingleRow('admin',$where);
                    $response['list_data'] = $this->load->view('admin/user_management/admin_users/single_list_data',$data,true);
                }else{
                    $response['type'] = 'error';
                    $response['msg'] = 'Something went wrong!';
                }
            }
        }
        echo json_encode($response);
    }
    function admin_user_form_data(){
        $response = array();     
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth';
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else if(@$this->session->userdata('tailwebs_admin_type') != 1){
            $response['type'] = 'error';
            $response['msg'] = 'Access denied!';
        }else{
            $where['admin_id'] = @$this->input->post('id');
            $data['editrow'] = $this->Admin_data_model->getSingleRow('admin',$where);
            $response['type'] = 'success';
            $response['formpage'] = $this->load->view('admin/user_management/admin_users/form_data',$data,true);
        }
        echo json_encode(@$response);
    }
    function delete_admin_user(){
        $response = array();     
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth';
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else if(@$this->session->userdata('tailwebs_admin_type') != 1){
            $response['type'] = 'error';
            $response['msg'] = 'Access denied!';
        }else{
            $where['admin_id'] = @$this->input->post('id');
            $row_det = $this->Admin_data_model->getSingleRow('admin',$where);           
            $delete_table = $this->Admin_data_model->deleteData('admin',$where);            
            if(@$delete_table){
                if(@$row_det->profile_image){
                    if(file_exists('assets/uploads/customers/'.@$row_det->profile_image)){
                        unlink('assets/uploads/customers/'.@$row_det->profile_image);
                    }
                }
                $response['type'] = 'success';
            }else{
                $response['type'] = 'error';
                $response['msg'] = 'Something went wrong!';
            }
        }
        echo json_encode($response);
    }
    function change_admin_user_status(){
        $response = array();     
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth';
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else if(@$this->session->userdata('tailwebs_admin_type') != 1){
            $response['type'] = 'error';
            $response['msg'] = 'Access denied!';
        }else{
            $where['admin_id'] = @$this->input->post('id');
            if(@$this->input->post('status')){
                $inputs['admin_status'] = 0;
            }else{
                $inputs['admin_status'] = 1;
            }
            $update_table = $this->Admin_data_model->updateData('admin',$where,$inputs);            
            if(@$update_table){
                $response['type'] = 'success';
            }else{
                $response['type'] = 'error';
                $response['msg'] = 'Something went wrong!';
            }
        }
        echo json_encode($response);
    }

    //Students
    
    function students(){
        $data=array();
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            redirect('ad-auth');
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $this->session->set_userdata('curr_uri','ad-students');
            redirect('ad-auth-unlock');
        }else{
            $data['meta_title'] = 'Students';
            $this->layouts->adminview('admin/user_management/students/lists',$data,TRUE);      
        }
    }
    function get_student_lists(){
        $response = array();     
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth';
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else{
            $data = $where = $where_not = $like = array();
            $limit = $this->input->post('results');
            $offset = @$this->input->post('list_count')?:0;
            $data['offset'] = $offset;
            if(@$this->input->post('keyword')){
                $query = @$this->input->post('keyword');
                $like = "(name like '%$query%' or subject like '%$query%' or marks like '%$query%')";
            }
            if(@$this->input->post('sort_column') && @$this->input->post('sort_by')){
                $sort_column = str_replace("--", ".", @$this->input->post('sort_column'));
                $sort_by = @$sort_column.' '.@$this->input->post('sort_by');
            }else{
                $sort_by = 'name ASC';
            }
            $data['lists'] = $this->Admin_data_model->getRow('students',$where,'','',$sort_by,$limit,$offset,$like);
            $response['count'] = count(@$data['lists']);
            $response['type'] = 'success';
            $response['list_data'] = $this->load->view('admin/user_management/students/list_data',$data,true);
        }
        echo json_encode(@$response);
    }
    function student_form(){
        $response = array();     
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth';
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else{
            $this->form_validation->set_rules('name', 'name', 'trim|required|xss_clean|callback__check_student_name');
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
            $this->form_validation->set_rules('marks', 'Marks', 'trim|required|xss_clean');
            if($this->form_validation->run() == FALSE){
                $response['type'] = 'error';
                $input_keys = array_keys($this->input->post());
                foreach ($input_keys as $field){
                    if(@form_error($field)){
                        $response['field_error'][] = $field.'_msg||'.strip_tags(form_error($field));
                    }
                }
            }else{
                $inputs['name'] = $this->input->post('name');
                $inputs['subject'] = $this->input->post('subject');
                $inputs['marks'] = $this->input->post('marks');
                $inputs['updated_on'] = date('Y-m-d H:i:s');
                $where['student_id'] = @$this->input->post('student_id');
                if(@$this->input->post('student_id')){
                    $update_table = $this->Admin_data_model->updateData('students',$where,$inputs);
                }else{
                    $insert_table = $this->Admin_data_model->saveData('students',$inputs);
                }
                if(@$update_table){
                    $response['type'] = 'updated';
                    $data['list_type'] = 1;
                    $data['list'] = $this->Admin_data_model->getSingleRow('students',$where);
                    $response['list_data'] = $this->load->view('admin/user_management/students/single_list_data',$data,true);
                }else if(@$insert_table){
                    $response['type'] = 'added';
                    $data['list_type'] = 0;
                    $where['student_id'] = @$insert_table;
                    $data['list'] = $this->Admin_data_model->getSingleRow('students',$where);
                    $response['list_data'] = $this->load->view('admin/user_management/students/single_list_data',$data,true);
                }else{
                    $response['type'] = 'error';
                    $response['msg'] = 'Something went wrong!';
                }
            }
        }
        echo json_encode($response);
    }
    function _check_student_name(){
        $where['name'] = @$this->input->post('name');
        $where_not[] = 'student_id,'.@$this->input->post('student_id');
        $validate_data = $this->Admin_data_model->getSingleRow('students',$where,$where_not);
        if(@$validate_data){
            $this->form_validation->set_message('_check_student_name','Student name already taken!');
            return false;
        }else{
            return true;
        }
    }
    function student_form_data(){
        $response = array();     
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth';
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else{
            $where['student_id'] = @$this->input->post('id');
            $data['editrow'] = $this->Admin_data_model->getSingleRow('students',$where);
            $response['type'] = 'success';
            $response['formpage'] = $this->load->view('admin/user_management/students/form_data',$data,true);
        }
        echo json_encode(@$response);
    }
    function delete_student(){
        $response = array();     
        if(!@$this->session->userdata('tailwebs_admin_logged_in')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth';
        }else if(@$this->session->userdata('tailwebs_admin_lock')){
            $response['type'] = 'redirect';
            $response['link'] = 'ad-auth-unlock';
        }else{
            $where['student_id'] = @$this->input->post('id');
            $row_det = $this->Admin_data_model->getSingleRow('students',$where);           
            $delete_table = $this->Admin_data_model->deleteData('students',$where);            
            if(@$delete_table){ 
                $response['type'] = 'success';
            }else{
                $response['type'] = 'error';
                $response['msg'] = 'Something went wrong!';
            }
        }
        echo json_encode($response);
    }
    function editor_image() {  
        $inputs = $this->input->post();
        $config['upload_path'] =  'assets/uploads/attachment';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config); 
        if (!$this->upload->do_upload('editor_image')){
            $error = $this->upload->display_errors();
            echo $error;
        }
        else{
            $data = array('upload_data' => $this->upload->data());
            $this->filedata = $data['upload_data'];
            echo base_url('assets/uploads/attachment/'.$this->filedata['file_name']);
        }
    }
    function logout(){
        $unset_sessiondata = array(
            'tailwebs_admin_id',
            'tailwebs_admin_name',
            'tailwebs_admin_email',
            'tailwebs_admin_username',
            'tailwebs_admin_image',
            'tailwebs_admin_type',
            'tailwebs_admin_lock',
            'tailwebs_admin_level1',
            'tailwebs_admin_level2',
            'tailwebs_admin_logged_in',
        );
        $this->session->unset_userdata($unset_sessiondata);
        $this->session->set_flashdata('msg', 'Logged out successfully');
        redirect('ad-auth');
    }
}