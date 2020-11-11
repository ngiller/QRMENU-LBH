<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Scan_qr extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('cart');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('property_model');
        $this->load->model('outlet_model');
        $this->load->model('pages_model');
        $this->load->model('setting_model');
    }

    public function index() {
        $this->cart->destroy();
        $data_session = array(                        
            'propertyid' => "",
            'propertyname' => "",
            'outletid' => "",
            'outletname' => "",
            'tableno' => "",
            'orderid' => "",
            'guest_session' => 0
        );        
        $this->session->set_userdata($data_session);   

        $data['nav_index'] = 0;
        $data['menucat_list'] = array();
        $this->load->view($this->session->template_folder.'/scan_qr_view', $data);
    }
}
?>