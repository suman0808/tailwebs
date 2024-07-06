<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Status extends CI_Controller {
	public function __construct(){
		parent::__construct();
		date_default_timezone_set("America/New_York");
		$this->load->model('Status_data_model');
		$meta_info = $this->Status_data_model->getSingleRow('meta_info','','','','mi_id ASC');
		if(@$meta_info->logo){
			$this->session->set_userdata('traceqlabs_logo',$meta_info->logo);
		}
		if(@$meta_info->website_name){
			$this->session->set_userdata('traceqlabs_website_name',$meta_info->website_name);
		}else{
			$this->session->set_userdata('traceqlabs_website_name','POS');
		}
		if(@$meta_info->meta_title){
			$this->session->set_userdata('traceqlabs_meta_title',$meta_info->meta_title);
		}
        if(@$meta_info->footer_logo){
            $this->session->set_userdata('traceqlabs_footer_logo',$meta_info->footer_logo);
        }
		if(@$meta_info->favicon){
			$this->session->set_userdata('traceqlabs_favicon',$meta_info->favicon);
		}
		if(@$meta_info->copyright_year){
			$this->session->set_userdata('traceqlabs_copyright_year',$meta_info->copyright_year);
		}else{
			$this->session->set_userdata('traceqlabs_copyright_year',date('Y'));
		}
		$general_setting = $this->Status_data_model->getSingleRow('general_setting','','','','gs_id ASC');
		if(@$general_setting->pri_color){
			$this->session->set_userdata('traceqlabs_pri_color',$general_setting->pri_color);
		}else{
			$this->session->set_userdata('traceqlabs_pri_color','#4361ee');
		}
		if(@$general_setting->sec_color){
			$this->session->set_userdata('traceqlabs_sec_color',$general_setting->sec_color);
		}else{
			$this->session->set_userdata('traceqlabs_sec_color','#304aca');
		}
	}
	function pagenotfound(){
		$data = array();
		$this->load->view('status/pagenotfound',$data);
	}
	function coming_soon(){
		$data = array();
		$general_setting = $this->Status_data_model->getSingleRow('general_setting','','','','gs_id ASC');
		$data['launch_datetime'] = @$general_setting->launch_datetime?:date('Y-m-d H:i:s');
		$this->load->view('status/coming_soon',$data);
	}
	function under_maintenance(){
		$data = array();
		$this->load->view('status/under_maintenance',$data);
	}
	function get_server_status(){
		$response = array();
		$general_setting = $this->Status_data_model->getSingleRow('general_setting','','','','gs_id ASC');
		if(@$general_setting){
			if(!@$general_setting->website_status){
				$response['type'] = 'redirect';
				$response['link'] = '';
			}else if(@$general_setting->website_status == 1){
				if(@$this->input->post('status') != 1){
					$response['type'] = 'redirect';
					$response['link'] = 'under-maintenance';
				}else{
					$response['type'] = 'success';
				}
			}else if(@$general_setting->website_status == 2){
				if(@$this->input->post('status') != 2){
					$response['type'] = 'redirect';
					$response['link'] = 'coming-soon';
				}else{
					if(date('Y-m-d H:i:s') >= @$general_setting->launch_datetime){
						$inputs['launch_datetime'] = NULL;
						$inputs['website_status'] = 0;
						$where['gs_id'] = @$general_setting->gs_id;
						$this->Status_data_model->updateData('general_setting',$where,$inputs);
						$response['type'] = 'redirect';
						$response['link'] = '';
					}else if(date('Y-m-d H:i:s',strtotime(@$this->input->post('datetime'))) != @$general_setting->launch_datetime){
						$response['type'] = 'launch_datetime';
						$response['datetime'] = @$general_setting->launch_datetime;
					}else{
						$response['type'] = 'success';
					}
				}
			}
		}else{
			$response['type'] = 'redirect';
			$response['link'] = '';
		}
		echo json_encode($response);
	}
}