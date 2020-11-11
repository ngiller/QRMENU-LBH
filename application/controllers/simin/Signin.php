<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Signin extends CI_Controller{
 
	function __construct(){
		parent::__construct();		
		$this->load->helper('security');
		$this->load->model('users_model');
		$this->load->model('property_model');
		$this->load->model('setting_model');
	}
 
	function index(){
		if($this->session->userdata('status') == "login"){			
			redirect(base_url("simin/dashboard"));
		} else {
			$this->load->view('simin/signin');
		}
    }

    function do_login(){
		$username = xss_clean($this->input->post('user'));
		$password = xss_clean($this->input->post('passwd'));
	
		$result_user = $this->users_model->user_check($username, $password);
		$row_user = $result_user->row();
		if (isset($row_user)) {

			$row_property = $this->property_model->get_by_id($row_user->propertyid);
			$time_zone = $this->setting_model->get_setting_value('time_zone', $row_user->propertyid);	
			date_default_timezone_set($time_zone->value);		
	
			$data_session = array(
				'id' => $row_user->id,
				'userid' => $username,
				'uname' => $row_user->name,
				'groupid' => $row_user->groupid,
				'propertyid' => $row_user->propertyid,
				'propertyname' => $row_property->name,
				'outletid' => "",
				'outletname' => "",
				'bdate' => date('d-m-Y'),
				'edate' => date('d-m-Y'),
				'status' => "login",
				'timezone' => $time_zone->value
			);
 
			$this->session->set_userdata($data_session);

			echo json_encode(['code'=>200, 'success'=>1, 'id' => $row_user->id, 'username' => $row_user->name]);
 
		}else{
			echo json_encode(['code'=>404]);
		}
	}
 
	function logout() {

		$this->session->sess_destroy();
		$data_session = array(
			'nama' => "",
			'status' => "logout"
			);
		$this->session->unset_userdata($data_session);
		
		redirect(base_url('simin/signin'));
	}
}