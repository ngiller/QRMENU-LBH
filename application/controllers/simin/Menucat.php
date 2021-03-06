<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menucat extends CI_Controller {

    function __construct() {
        parent::__construct();

        if($this->session->userdata('status') != "login"){
			redirect(base_url("simin/signin"));
		}

        $this->load->model('property_model');
        $this->load->model('outlet_model');
        $this->load->model('menu_cat_model');
    }

    function index() {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['select_outlet'] = $this->outlet_model->get_order_by_name();
        $data['select_cat'] = $this->menu_cat_model->get_order_by_name();
        $data['active_menu'] = 80;
        $data['title'] = "MENU CATEGORY";
        $this->load->view('simin/menu_cat_view', $data);
    }
    
    public function ajax_list() {
        $list = $this->menu_cat_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $menucat) {
            $no++;
            $row = array();       
            if ($menucat->active == 0) {
                $row[] = '<input type="checkbox" checked="checked" name="active">';      
            } else {
                $row[] = '<input type="checkbox" name="active">';      
            }
            $row[] = $menucat->code;
            if ($menucat->subcode <> "") {
                $row[] = '&nbsp;&nbsp;&nbsp; > ' . $menucat->name;   
            } else {
                $row[] = $menucat->name;
            }          
            
            $row[] = $menucat->subcode;
   
            //add html for action
            $row[] = '<a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="Edit" href="javascript:void(0)" onclick="edit_record('."'".$menucat->id."'".')"><i class="flaticon-edit"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle del_data" href="javascript:void(0)" title="Delete" onclick="delete_record('."'".$menucat->id."'".')"><i class="flaticon-delete"></i></a>';
            $row[] = '<input type="checkbox" name="id[]" class="delete_customer" value="' . $menucat->id .'" />';
           
            $data[] = $row;
        }
   
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->menu_cat_model->count_all(),
            "recordsFiltered" => $this->menu_cat_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function add_save(){
        //$this->_validate();
        //$this->_check_available('', $this->input->post('code'));
        $active = $this->input->post('active');
        if ($active == NULL) { $active = 1; }

        $other_outlet = $this->input->post('other_outlet');
        if ($other_outlet == NULL) { $other_outlet = 1; }

        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $subof = $this->input->post('subof');
        $fb = $this->input->post('fbtype');
        $image = $this->input->post('image');
        $this->menu_cat_model->save($active, $code, $name, $subof, 1, $fb, $other_outlet, $image);
        $result = array(
            "status" => TRUE,
            "data" => $this->menu_cat_model->reload_order_by_name(0)
        );
        echo json_encode($result);
    }

    public function delete($id){                
        $this->menu_cat_model->delete_by_id($id);
        $result = array(
            "status" => TRUE,
            "data" => $this->menu_cat_model->reload_order_by_name(0)
        );
        
        echo json_encode($result);

    }

    public function del_selected(){
        if ($this->input->post('id')) {
            foreach($_POST["id"] as $id) {
                $this->menu_cat_model->delete_by_id($id);                                   
            }
            $result = array(
                "status" => TRUE,
                "data" => $this->menu_cat_model->reload_order_by_name(0)
            );
            echo json_encode($result);
        }    
    }

    public function ajax_update() {

        $active = $this->input->post('active');
        if ($active == NULL) { $active = 1; }

        $other_outlet = $this->input->post('other_outlet');
        if ($other_outlet == NULL) { $other_outlet = 1; }
        
        $data = array(
            'active' => $active,            
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
            'sub_of' => $this->input->post('subof'),
            'master' => 0,
            'fb' => $this->input->post('fbtype'),
            'order_other_outlet' => $other_outlet,
            'image' => $this->input->post('image'),
            'outletid' => $this->session->outletid,
            'propertyid' => $this->session->propertyid,
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );
        $this->menu_cat_model->update(array('id' => $this->input->post('id')), $data);
        $result = array(
            "status" => TRUE,
            "data" => $this->menu_cat_model->reload_order_by_name(0)
        );
        echo json_encode($result);
    }
    
    public function ajax_edit($id) {
        $data = $this->menu_cat_model->get_by_id($id);
        echo json_encode($data);
    }

    public function change_property() {
        $row = $this->property_model->get_by_id($this->input->post('id'));
        $this->session->set_userdata('propertyid', $row->id);
        $this->session->set_userdata('propertyname', $row->name);
        echo json_encode(array($this->session->propertyname));
    }

    public function change_outlet() {
        $row = $this->outlet_model->get_by_id($this->input->post('id'));
        $this->session->set_userdata('outletid', $row->id);
        $this->session->set_userdata('outletname', $row->name);
        echo json_encode(array($this->session->outletname));
    }

    public function get_cat_dropdown() {
        $data = $this->menu_cat_model->view_order_by_name();
        echo json_encode($data);
    }
}