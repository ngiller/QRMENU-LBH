<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Submenu extends CI_Controller {

    function __construct() {
        parent::__construct();

        if($this->session->userdata('status') != "login"){
			redirect(base_url("simin/signin"));
		}

        $this->load->model('sub_menu_model');
        $this->load->model('menu_model');
    }

    function index() {
        redirect('/simin/menu');
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
     
        if($this->input->post('name') == '') {
          $data['inputerror'][] = 'name';
          $data['error_string'][] = 'Sub Menu name is required';
          $data['status'] = FALSE;
        }
    
        if($data['status'] === FALSE) {
          echo json_encode($data);
          exit();
        }
    }
  
    public function ajax_list($menuid) {
        $menuid = xssclean($menuid);
        $list = $this->sub_menu_model->get_datatables($menuid); 
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $menu) {
            $no++;
            $row = array();
            if ($menu->active == 0) {
                $row[] = '<input type="checkbox" checked="checked" name="active">';      
            } else {
                $row[] = '<input type="checkbox" name="active">';      
            }   
            $row[] = $menu->position;
            $row[] = $menu->name;         
            $row[] = '<a href="javascript:void(0)" onclick="item_sub_menu('."'".$menu->id."'".')"><span class="kt-badge kt-badge--inline kt-badge--brand">items</span></a>';
   
            //add html for action
            $row[] = '<a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="Edit" href="javascript:void(0)" onclick="edit_record('."'".$menu->id."'".')"><i class="flaticon-edit"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle del_data" href="javascript:void(0)" title="Delete" onclick="delete_record('."'".$menu->id."'".')"><i class="flaticon-delete"></i></a>';                
           
            $data[] = $row;
        }
   
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->sub_menu_model->count_all($menuid),
            "recordsFiltered" => $this->sub_menu_model->count_filtered($menuid),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function add_save(){         
        $menuid = xssclean($this->input->post('menuid'));               
        $active = $this->input->post('active');
        if ($active == NULL) { $active = 1; }
        $position = xssclean($this->input->post('position'));        
        $name = xssclean($this->input->post('name'));

        //$this->_validate();

        $this->sub_menu_model->save($menuid, $active, $position, $name);
        $result = array(
            "status" => TRUE,
            "data" => $this->sub_menu_model->reload_order_by_pos($menuid)
        );
        echo json_encode($result);
    }

    public function delete($id){
        $submenu = $this->sub_menu_model->get_by_id($id);
        $this->sub_menu_model->delete_by_id($id);
        $result = array(
            "status" => TRUE,
            "data" => $this->sub_menu_model->reload_order_by_pos($submenu->menuid)
        );
        echo json_encode($result);
    }

    public function del_selected($menuid){
        $menuid = xssclean($menuid);
        if ($this->input->post('id')) {
            foreach($_POST["id"] as $id) {
                $this->sub_menu_model->delete_by_id($id);                   
            }
            $result = array(
                "status" => TRUE,
                "data" => $this->sub_menu_model->reload_order_by_sub($menuid)
            );
            echo json_encode($result);
        }    
    }

    public function ajax_update($menuid) {
        //$this->_validate();        
        //$this->_check_available(xssclean($this->input->post('old-code')), xssclean($this->input->post('code')), xssclean($this->input->post('old-loginid')), xssclean($this->input->post('loginid')), xssclean($this->input->post('old-name')), xssclean($this->input->post('name')));
        $menuid = xssclean($menuid); 
        $active = $this->input->post('active');
        if ($active == NULL) { $active = 1; };
        
        $data = array(
            'active' => $active,
            'position' => xssclean($this->input->post('position')),
            'name' => xssclean($this->input->post('name')),
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );
        $this->sub_menu_model->update(array('id' => $this->input->post('id')), $data);
        $result = array(
            "status" => TRUE,
            "data" => $this->sub_menu_model->reload_order_by_pos()
        );
        echo json_encode($result);
    }
    
    public function ajax_edit($id) {
        $data = $this->sub_menu_model->get_by_id($id);
        echo json_encode($data);
    }   
}