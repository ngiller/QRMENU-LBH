<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Signout extends CI_Controller{
 
	function __construct(){
		parent::__construct();		
		$this->load->model('users_model');
		$this->load->model('property_model');
	}
 
	function index(){
		$data_session = array(
			'status' => "logout"
			);
		$this->session->set_userdata($data_session);
		$this->load->view('simin/signin');
		
    }
}
?>