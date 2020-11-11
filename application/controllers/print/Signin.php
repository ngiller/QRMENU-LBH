<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Signin extends CI_Controller{
 
	function __construct(){
		parent::__construct();		
		$this->load->helper('security');
		$this->load->model('users_model');
		$this->load->model('property_model');
	}
 
	function index(){
        
		if($this->session->userdata('print_status') == "login"){			
			redirect(base_url("print/home"));
		} else {
            $data['user'] = "";
            $data['passwd'] = "";
			$this->load->view('print/signin_view', $data);
		}
    }

    function login(){
		$username = xss_clean($this->input->post('user'));
		$password = xss_clean($this->input->post('passwd'));
	
		$result_user = $this->users_model->user_check($username, $password);
		$row_user = $result_user->row();
		if (isset($row_user)) {
	
			$print_session = array(
				'print_user_id' => $row_user->id,
				'print_property_id' => $row_user->propertyid,
                'print_outlet_id' => "",
                'print_outlet_name' => "",
				'print_status' => "login"
			);
 
			$this->session->set_userdata($print_session);

			redirect(base_url("print/home"));
 
		}else{
            $data['user'] = $username;
			$data['passwd'] = $password;
			$this->session->set_flashdata('error_msg', 'Wrong user name or password');
			$this->load->view('print/signin_view', $data);
		}
	}
 
	function logout() {

		$print_session = array(
			'print_status' => "logout"
			);
        $this->session->set_userdata($print_session);
		
		redirect(base_url('print/signin'));
	}
}