<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usergroup extends CI_Controller {

    function __construct() {
        parent::__construct();

        if($this->session->userdata('status') != "login"){
			redirect(base_url("simin/signin"));
		}

        $this->load->model('property_model');
        $this->load->model('user_group_model');
    }

    function index() {        
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['active_menu'] = 980;
        $data['title'] = "USER GROUP LIST";
        $this->load->view('simin/usergroup_view', $data);
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;        
     
        if($this->input->post('name') == '') {
          $data['inputerror'][] = 'name';
          $data['error_string'][] = 'Group name is required';
          $data['status'] = FALSE;
        }       
    
        if($data['status'] === FALSE) {
          echo json_encode($data);
          exit();
        }
    }

    public function _check_available($oldname, $newname) {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
    
        if ($oldname != $newname) {
            if ($this->user_group_model->get_by_name($newname)) {     
                $data['inputerror'][] = 'name';
                $data['error_string'][] = 'Group name already exits';
                $data['status'] = FALSE;      
            }
        }        
    
        if($data['status'] == FALSE) {
            echo json_encode($data);
            exit();
        }
    }
  
    public function ajax_list() {
        $list = $this->user_group_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ugroup) {
            $no++;
            $row = array();                        
            $row[] = $ugroup->name;                    
            $row[] = '<a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="Edit" href="javascript:void(0)" onclick="edit_record('."'".$ugroup->id."'".')"><i class="flaticon-edit"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle del_data" href="javascript:void(0)" title="Delete" onclick="delete_record('."'".$ugroup->id."'".')"><i class="flaticon-delete"></i></a>';
            $row[] = '<input type="checkbox" name="id[]" class="delete_customer" value="' . $ugroup->id .'" />';
           
            $data[] = $row;
        }
   
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->user_group_model->count_all(),
            "recordsFiltered" => $this->user_group_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function add_save(){
        $this->_validate();
        $this->_check_available('', $this->input->post('name'));
        $name = $this->input->post('name');        
        $this->user_group_model->save($name);
        echo json_encode(array("status" => TRUE));
    }

    public function delete($id){
        if ($id != 1 OR $id != 2) {
            $this->user_group_model->delete_by_id($id);
            echo json_encode(array("status" => TRUE));
        } else {
            echo json_encode(array("status" => FALSE));
        }
    }

    public function del_selected(){
        if ($this->input->post('id')) {
            foreach($_POST["id"] as $id) {
                if ($id != 1 OR $id != 2) {
                    $this->user_group_model->delete_by_id($id);                
                }
            }
            echo json_encode(array("status" => TRUE));
        }    
    }

    public function ajax_update() {
        $this->_validate();        
        $this->_check_available($this->input->post('old-name'), $this->input->post('name'));
        
        $data = array(           
            'name' => $this->input->post('name'),
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                    
        );
        $this->user_group_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
    
    public function ajax_edit($id) {
        $data = $this->user_group_model->get_by_id($id);
        echo json_encode($data);
    }

    public function change_property() {
        $row = $this->property_model->get_by_id($this->input->post('id'));
        $this->session->set_userdata('propertyid', $row->id);
        $this->session->set_userdata('propertyname', $row->name);
        echo json_encode(array($this->session->propertyname));
    }

    
}