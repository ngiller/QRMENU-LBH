<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();

        if($this->session->userdata('status') != "login"){
			redirect(base_url("simin/signin"));
		}

        $this->load->model('property_model');
        $this->load->model('user_group_model');
        $this->load->model('users_model');
    }

    function index() {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['usergroup_data'] = $this->user_group_model->get_order_by_name();
        $data['active_menu'] = 970;
        $data['title'] = "USER LIST";
        $this->load->view('simin/user_view', $data);
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('userid') == '') {
            $data['inputerror'][] = 'userid';
            $data['error_string'][] = 'User ID is required';
            $data['status'] = FALSE;
          }
     
        if($this->input->post('name') == '') {
          $data['inputerror'][] = 'name';
          $data['error_string'][] = 'Name is required';
          $data['status'] = FALSE;
        }  
        
        if($this->input->post('passwd') == '') {
            $data['inputerror'][] = 'passwd';
            $data['error_string'][] = 'Password is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('retypepass') == '') {
            $data['inputerror'][] = 'retypepass';
            $data['error_string'][] = 'Retype password is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('retypepass') != $this->input->post('passwd')) {
            $data['inputerror'][] = 'retypepass';
            $data['error_string'][] = 'Password do not match';
            $data['status'] = FALSE;
        }
    
        if($data['status'] === FALSE) {
          echo json_encode($data);
          exit();
        }
    }

    public function _check_available($olduserid, $newuserid) {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
    
        if ($olduserid != $newuserid) {
            if ($this->users_model->get_by_userid($newuserid)) {     
                $data['inputerror'][] = 'userid';
                $data['error_string'][] = 'User ID already exits';
                $data['status'] = FALSE;      
            }
        }        
    
        if($data['status'] == FALSE) {
            echo json_encode($data);
            exit();
        }
    }
  
    public function ajax_list() {
        $list = $this->users_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $user) {
            $no++;
            $row = array();            
            $row[] = $user->userid;
            $row[] = $user->name;
            $row[] = $user->groupname;            
   
            //add html for action
            $row[] = '<a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="Edit" href="javascript:void(0)" onclick="edit_record('."'".$user->id."'".')"><i class="flaticon-edit"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle del_data" href="javascript:void(0)" title="Delete" onclick="delete_record('."'".$user->id."'".')"><i class="flaticon-delete"></i></a>';
            $row[] = '<input type="checkbox" name="id[]" class="delete_customer" value="' . $user->id .'" />';
           
            $data[] = $row;
        }
   
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->users_model->count_all(),
            "recordsFiltered" => $this->users_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function add_save(){        
        $userid = xssclean($this->input->post('userid'));
        $name = xssclean($this->input->post('name'));
        $groupid = $this->input->post('groupid');        
        $password = xssclean($this->input->post('passwd'));

        if (substr($userid, 3, 1) <> '-') {
            $property = $this->property_model->get_by_id($this->session->propertyid);
            $userid = $property->code. '-'. $userid;
        }

        $this->_validate();
        $this->_check_available('', $userid);

        $this->users_model->save($userid, $name, $password, $groupid);
        $result = array(
            "status" => TRUE,
            "data" => $this->users_model->reload_order_by_name()
        );
        echo json_encode($result);
    }

    public function delete($id){        
        if ($id != 1) {
            $this->users_model->delete_by_id($id);
        }
        $result = array(
            "status" => TRUE,
            "data" => $this->users_model->reload_order_by_name()
        );
        
        echo json_encode($result);

    }

    public function del_selected(){
        if ($this->input->post('id')) {
            foreach($_POST["id"] as $id) {
                if ($id != 1) {
                    $this->users_model->delete_by_id($id);                   
                }
            }
            $result = array(
                "status" => TRUE,
                "data" => $this->users_model->reload_order_by_name()
            );
            echo json_encode($result);
        }    
    }

    public function ajax_update() {
        $this->_validate();        
        $this->_check_available($this->input->post('old-userid'), $this->input->post('userid'));
        
        $data = array(
            'userid' => xssclean($this->input->post('userid')),
            'name' => xssclean($this->input->post('name')),
            'password' => xssclean($this->input->post('passwd')),
            'groupid' => $this->input->post('groupid'),
            'propertyid' => $this->session->propertyid,
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );
        $this->users_model->update(array('id' => $this->input->post('id')), $data);
        $this->session->set_userdata('groupid_select', '');
        $result = array(
            "status" => TRUE,
            "data" => $this->users_model->reload_order_by_name()
        );
        echo json_encode($result);
    }
    
    public function ajax_edit($id) {
        $data = $this->users_model->get_by_id($id);
		$this->session->set_userdata('groupid_select', $data->id);
        echo json_encode($data);
    }

    public function change_property() {
        $row = $this->property_model->get_by_id($this->input->post('id'));
        $this->session->set_userdata('propertyid', $row->id);
        $this->session->set_userdata('propertyname', $row->name);
        echo json_encode(array($this->session->propertyname));
    }

    
}