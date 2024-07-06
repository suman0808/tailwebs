<?php
class Layouts { 
	private $CI;
	private $layout_title = null;
	private $layout_description = null;
	private $includes = array();
	public function __construct() {
		$this->CI =& get_instance();
	}
	function adminview($view_name='',$params='',$default=''){
		if(@$default){
			$this->CI->load->view('admin/layouts/header',$params);
			$this->CI->load->view('admin/layouts/navbar',$params);
			$this->CI->load->view($view_name, $params);
			$this->CI->load->view('admin/layouts/footer', $params);
		}else{
			$this->CI->load->view($view_name, $params);
		}
	}
	function vendorview($view_name='',$params='',$default=''){
		if(@$default){
			$this->CI->load->view('vendor/layouts/header',$params);
			$this->CI->load->view('vendor/layouts/navbar',$params);
			$this->CI->load->view($view_name, $params);
			$this->CI->load->view('vendor/layouts/footer', $params);
		}else{
			$this->CI->load->view($view_name, $params);
		}
	}
	function customerview($view_name='',$params='',$default=''){
		if(@$default){
			$this->CI->load->view('customer/layouts/header',$params);
			$this->CI->load->view('customer/layouts/navbar',$params);
			$this->CI->load->view($view_name, $params);
			$this->CI->load->view('customer/layouts/footer', $params);
		}else{
			$this->CI->load->view($view_name, $params);
		}
	}
	function userview($view_name='',$params='',$default=''){
		if(@$default){
			$this->CI->load->view('user/layouts/header',$params);
			$this->CI->load->view('user/layouts/navbar',$params);
			$this->CI->load->view($view_name, $params);
			$this->CI->load->view('user/layouts/footer', $params);
		}else{
			$this->CI->load->view($view_name, $params);
		}
	}
	function siteview($view_name='',$params='',$default=''){
		if(@$default){
			$this->CI->load->view('site/layouts/header',$params);
			$this->CI->load->view('site/layouts/navbar',$params);
			$this->CI->load->view($view_name, $params);
			$this->CI->load->view('site/layouts/footer', $params);
		}else{
			$this->CI->load->view($view_name, $params);
		}
	}
}
?>