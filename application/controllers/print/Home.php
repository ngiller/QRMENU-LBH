<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Home extends CI_Controller{
 
	function __construct(){
        parent::__construct();		
        
        if($this->session->userdata('print_status') != "login"){
			redirect(base_url("print/signin"));
        }

		$this->load->model('users_model');
        $this->load->model('property_model');
        $this->load->model('print_outlet_model');
	}
 
	function index() {
        $data['select_outlet'] = $this->print_outlet_model->show_outlet();
		$this->load->view('/print/home_view', $data);
    }

    public function change_outlet() {
        $row = $this->print_outlet_model->get_by_id($this->input->post('id'));
        $this->session->set_userdata('print_outlet_id', $row->id);
        $this->session->set_userdata('print_outlet_name', $row->name);
        echo json_encode(array($row->name));
    }
}