<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class History extends CI_Controller {

    function __construct() {
        parent::__construct();

        if ($this->session->userdata('outletid') == "") {
            redirect(base_url("/scan_qr"));
        }

        $this->load->library('cart');
        $this->load->model('setting_model');
        $this->load->model('order_detail_item_model');
        $this->load->model('order_detail_model');
        $this->load->model('order_master_model');
        $this->load->model('guest_model');
        $this->load->model('country_model');
        $this->load->model('menu_cat_model');
    }

    function index() {   
        $data['nav_index'] = 3;
        $data['menucatid'] = -1;
        $data['menucat_list'] = $this->menu_cat_model->view_cat_master();   
        $data['guest'] = $this->guest_model->get_by_id($this->session->guestid);
        $data['order_history'] = $this->order_master_model->get_order_by_guestid($this->session->guestid);   
          
        $this->load->view($this->session->template_folder.'/history_view', $data);
    }

    public function detail($id) {
        if (empty($this->session->guestid)) {
            redirect('/menu/category');
            exit;
        }
        $id = xssclean($id);
        $data['nav_index'] = 3;
        $data['menucatid'] = -1;
        $data['menucat_list'] = $this->menu_cat_model->view_cat_master();
        $data['order_master'] = $this->order_master_model->get_by_id($id);
        $data['order_detail'] = $this->order_detail_model->get_by_id($id);
        $data['error_msg'] = '';
        $this->load->view($this->session->template_folder.'/history_detail_view', $data);
    }


}