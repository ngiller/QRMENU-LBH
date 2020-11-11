<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('outletid') == "") {
            redirect(base_url("/scan_qr"));
        }

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('property_model');
        $this->load->model('outlet_model');
        $this->load->model('pages_model');
        $this->load->model('whatson_model');
        $this->load->model('guest_model');
    }



    function show($tid = NULL) {
        if ($tid != NULL) { 
            $this->session->tableno = $tid;
        }

        $data['nav_index'] = 1; 
        $data['menucatid'] = -1;
        $data['whatson_data'] = $this->whatson_model->show_whatson();
        $data['outlet_data'] = $this->outlet_model->show_outlet();
        if ($this->session->guestid != "") {
            $guest = $this->guest_model->get_by_id($this->session->guestid);
            $data['guest_name'] = $guest->name;
        } else {
            $data['guest_name'] = "";
        }  
        $this->load->view($this->session->template_folder.'/room_view', $data);
    }

     function to_outlet($outletid) {
        if($this->cart->total_items() > 0 AND $outletid != $this->session->outletid) {
            $this->cart->destroy();
        }
        
        $outlet = $this->outlet_model->get_by_id($outletid);
        if ($outlet->code == 999) {
            redirect("/page/room_service"); 
        } else {
            $this->session->outletid = $outlet->id;
            $this->session->outletname = $outlet->name;
            redirect("/menu/category/".$this->session->tableno);
        }
    }

}