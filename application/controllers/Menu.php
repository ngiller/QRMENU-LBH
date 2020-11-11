<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    function __construct() {
        parent::__construct();

        if ($this->session->userdata('outletid') == "") {
            redirect(base_url("/scan_qr"));
        }

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->library('pagination');
        $this->load->model('property_model');
        $this->load->model('outlet_model');
        $this->load->model('menu_images_model');
        $this->load->model('menu_cat_model');
        $this->load->model('menu_model');
        $this->load->model('sub_menu_model');
        $this->load->model('sub_menu_item_model');
        $this->load->model('whatson_model');
        $this->load->model('guest_model');
    }

    /*function _remap($cid) {
        $this->index($cid);
    }

    function index() {
        
    }*/

    public function item($cid) {
        $cid = $this->security->xss_clean($cid);        
        $data['menucat_data'] = $this->menu_cat_model->get_by_id($cid);
        $data['menucat_list'] = $this->menu_cat_model->view_cat_master();
        
        $config = array();
        $config["base_url"] = base_url() . "menu/item/".$cid;
        $config['total_rows'] = $this->menu_cat_model->count_by_category($cid);
        $config["per_page"] = 10;
        $config["uri_segment"] = 4;        
        $config["num_links"] = 4;

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav aria-label="navigation"><ul class="pagination justify-content-end mt-10">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);

        $data['nav_index'] = 0;
        $data['menucatid'] = $cid;
        $data['page'] = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;
        $data['menu_data'] = $this->menu_cat_model->get_order_by_catid($cid, $config["per_page"], $data['page']);
        $data['pagination'] = $this->pagination->create_links();
        $data['template_folder'] = $this->session->template_folder;
        if ($this->session->guestid != "") {
            $guest = $this->guest_model->get_by_id($this->session->guestid);
            $data['guest_name'] = $guest->name;
        } else {
            $data['guest_name'] = "";
        }
        $outlet = $this->outlet_model->get_by_id($this->session->outletid);
        $data['orderable'] = $outlet->orderable;  
 
        $this->load->view($this->session->template_folder.'/menuitemcat_view', $data);
    }

    function category($tid = NULL) {
        if ($tid != NULL) { 
            $this->session->tableno = $tid;
        }

        $data['nav_index'] = 1; 
        $data['menucatid'] = -1;
        $data['fav_menu'] = $this->menu_model->get_favourite();
        $data['whatson_data'] = $this->whatson_model->show_whatson();;
        $data['menucat_data'] = $this->menu_cat_model->view_cat_master();
        $data['menucat_list'] = $this->menu_cat_model->view_cat_master();
        $data['template_folder'] = $this->session->template_folder;
        if ($this->session->guestid != "") {
            $guest = $this->guest_model->get_by_id($this->session->guestid);
            $data['guest_name'] = $guest->name;
        } else {
            $data['guest_name'] = "";
        } 

        $this->load->view($this->session->template_folder.'/menu_cat_view', $data);
    }

    function detail($menuid) {
        $menuid = $this->security->xss_clean($menuid);      
        $menu = $this->menu_model->view_by_id($menuid);
        $data['nav_index'] = 0;
        $data['menucatid'] = $menu->categoryid;
        $data['menu_data'] = $menu; 
        $data['menucat_data'] = $this->menu_cat_model->get_by_id($menu->categoryid);
        $data['menucat_list'] = $this->menu_cat_model->view_cat_master();
        $data['submenu_list'] = $this->sub_menu_model->view_by_menuid($menuid);
        $data['template_folder'] = $this->session->template_folder;
        $this->load->view($this->session->template_folder.'/menu_detail_view', $data);
    }

    public function all() {

        $config = array();
        $config["base_url"] = base_url() . "menu/all/";
        $config['total_rows'] = $this->menu_cat_model->count_all_menu();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;        
        $config["num_links"] = 3;

        // Membuat Style pagination untuk BootStrap v4
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav aria-label="navigation"><ul class="pagination justify-content-end mt-10">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';
 
        $this->pagination->initialize($config);

        $data['page'] = ($this->uri->segment($config['uri_segment'])) ? $this->uri->segment($config['uri_segment']) : 0;

        $data['nav_index'] = 2;
        $data['menucatid'] = -1;
        $data['menucat_list'] = $this->menu_cat_model->view_cat_master();
        $data['menu_data'] = $this->menu_cat_model->get_all($config["per_page"], $data['page']);
        $data['pagination'] = $this->pagination->create_links();
        $data['template_folder'] = $this->session->template_folder;
        if ($this->session->guestid != "") {
            $guest = $this->guest_model->get_by_id($this->session->guestid);
            $data['guest_name'] = $guest->name;
        } else {
            $data['guest_name'] = "";
        }  
        $this->load->view($this->session->template_folder.'/menu_all_view', $data);
    }  

    function view_by_submenuid($id) {
        $data = $this->sub_menu_item_model->view_by_submenuid($id);
        echo json_encode($data);
    }
}