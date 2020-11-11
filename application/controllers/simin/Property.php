<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Property extends CI_Controller {

    function __construct() {
        parent::__construct();

        if($this->session->userdata('status') != "login" OR $this->session->groupid != 1){
			redirect(base_url("simin/signin"));
        }
        

        $this->load->model('property_model');
    }

    function index() {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['active_menu'] = 999;
        $data['title'] = "PROPERTY LIST";
        $this->load->view('simin/property_view', $data);
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('code') == '') {
            $data['inputerror'][] = 'code';
            $data['error_string'][] = 'Property code is required';
            $data['status'] = FALSE;
          }
     
        if($this->input->post('name') == '') {
          $data['inputerror'][] = 'name';
          $data['error_string'][] = 'Property name is required';
          $data['status'] = FALSE;
        }

        if($this->input->post('phone') == '') {
            $data['inputerror'][] = 'phone';
            $data['error_string'][] = 'Phone is required';
            $data['status'] = FALSE;
          }
     
        if($this->input->post('email') == '') {
          $data['inputerror'][] = 'email';
          $data['error_string'][] = 'Email is required';
          $data['status'] = FALSE;
        }
    
        if($data['status'] === FALSE) {
          echo json_encode($data);
          exit();
        }
    }

    public function _check_available($oldcode, $newcode, $oldname, $newname) {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
    
        if ($oldname != $newname) {
            if ($this->property_model->is_name($newname)) {     
                $data['inputerror'][] = 'name';
                $data['error_string'][] = 'Property name already exits';
                $data['status'] = FALSE;      
            }
        }

        if ($oldcode != $newcode) {
            if ($this->property_model->is_code($newcode)) {     
                $data['inputerror'][] = 'code';
                $data['error_string'][] = 'Property code already exits';
                $data['status'] = FALSE;      
            }
        }
    
        if($data['status'] == FALSE) {
            echo json_encode($data);
            exit();
        }
    }
  
    public function ajax_list() {
        $list = $this->property_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $property) {
            $no++;
            $row = array();
            if ($property->active == 0) {
                $row[] = '<input type="checkbox" checked="checked" name="active">';
            } else {
                $row[] = '<input type="checkbox" name="active">';
            }
            $row[] = $property->code;
            $row[] = $property->name;
            $row[] = $property->address;            
            $row[] = $property->phone;
            $row[] = $property->email;
   
            //add html for action
            $row[] = '<a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="Edit" href="javascript:void(0)" onclick="edit_record('."'".$property->id."'".')"><i class="flaticon-edit"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle del_data" href="javascript:void(0)" title="Delete" onclick="delete_record('."'".$property->id."'".')"><i class="flaticon-delete"></i></a>';
            $row[] = '<input type="checkbox" name="id[]" class="delete_customer" value="' . $property->id .'" />';
           
            $data[] = $row;
        }
   
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->property_model->count_all(),
            "recordsFiltered" => $this->property_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function add_save(){   
        $active = $this->input->post('active');
        if ($active == NULL) {
            $active = 1;
        }     
        $code = xssclean($this->input->post('code'));
        $name = xssclean($this->input->post('name'));
        $address = xssclean($this->input->post('address'));
        $phone = xssclean($this->input->post('phone'));
        $email = xssclean($this->input->post('email'));
        $template_folder = xssclean($this->input->post('template_folder'));

        $this->_validate();
        $this->_check_available('', $code, '', $name);

        $this->property_model->save($active, $code, $name, $address, $phone, $email, $template_folder);
        //echo json_encode(array("status" => TRUE));
        $result = array(
            "status" => TRUE,
            "data" => $this->property_model->reload_order_by_name()
        );
        echo json_encode($result);
    }

    public function delete($id){
        $this->property_model->delete_by_id($id);
        $result = array(
            "status" => TRUE,
            "data" => $this->property_model->reload_order_by_name()
        );
        echo json_encode($result);
    }

    public function del_selected(){
        if ($this->input->post('id')) {
            foreach($_POST["id"] as $id) {
                $this->property_model->delete_by_id($id);                   
            }
            $result = array(
                "status" => TRUE,
                "data" => $this->property_model->reload_order_by_name()
            );
            echo json_encode($result);
        }    
    }

    public function ajax_update() {
        $this->_validate();        
        $this->_check_available($this->input->post('old-code'), $this->input->post('code'), $this->input->post('old-name'), $this->input->post('name'));
        $active = $this->input->post('active');
        if ($active == NULL) {
            $active = 1;
        }
        $data = array(
            'active' => $active,
            'code' => xssclean($this->input->post('code')),
            'name' => xssclean($this->input->post('name')),
            'address' => xssclean($this->input->post('address')),
            'phone' => xssclean($this->input->post('phone')),
            'email' => xssclean($this->input->post('email')),
            'template_folder' => xssclean($this->input->post('template_folder')),
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );
        $this->property_model->update(array('id' => $this->input->post('id')), $data);
        $result = array(
            "status" => TRUE,
            "data" => $this->property_model->reload_order_by_name()
        );
        echo json_encode($result);
    }
    
    public function ajax_edit($id) {
        $data = $this->property_model->get_by_id($id);
        echo json_encode($data);
    }

    public function change_property() {
        $row = $this->property_model->get_by_id($this->input->post('id'));
        $this->session->set_userdata('propertyid', $row->id);
        $this->session->set_userdata('propertyname', $row->name);
        echo json_encode(array($this->session->propertyname));
    }

    
}