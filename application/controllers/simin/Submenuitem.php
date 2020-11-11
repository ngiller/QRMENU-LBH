<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Submenuitem extends CI_Controller {

    function __construct() {
        parent::__construct();

        if($this->session->userdata('status') != "login"){
			redirect(base_url("simin/signin"));
		}

        $this->load->model('sub_menu_item_model');
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
  
    public function ajax_list($submenuid) {
        $submenuid = xssclean($submenuid);
        $list = $this->sub_menu_item_model->get_datatables($submenuid); 
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
            $row[] = $menu->price;         
   
            //add html for action
            $row[] = '<a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="Edit" href="javascript:void(0)" onclick="edit_item('."'".$menu->id."'".')"><i class="flaticon-edit"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle del_data" href="javascript:void(0)" title="Delete" onclick="delete_item('."'".$menu->id."'".')"><i class="flaticon-delete"></i></a>';                
           
            $data[] = $row;
        }
   
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->sub_menu_item_model->count_all($submenuid),
            "recordsFiltered" => $this->sub_menu_item_model->count_filtered($submenuid),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function add_save(){         
        $submenuid = xssclean($this->input->post('submenuid'));               
        $active = $this->input->post('itemactive');
        if ($active == NULL) { $active = 1; }
        $position = xssclean($this->input->post('itemposition'));        
        $name = xssclean($this->input->post('itemname'));
        $price = xssclean($this->input->post('price'));

        //$this->_validate();

        $this->sub_menu_item_model->save($submenuid, $active, $position, $name, $price);
        $result = array(
            "status" => TRUE,
            "data" => $this->sub_menu_item_model->reload_order_by_pos($submenuid)
        );
        echo json_encode($result);
    }

    public function delete($id){
        $submenu = $this->sub_menu_item_model->get_by_id($id);
        $this->sub_menu_item_model->delete_by_id($id);
        $result = array(
            "status" => TRUE,
            "data" => $this->sub_menu_item_model->reload_order_by_pos($submenu->submenuid)
        );
        echo json_encode($result);
    }

    public function del_selected($submenuid){
        $submenuid = xssclean($submenuid);
        if ($this->input->post('id')) {
            foreach($_POST["id"] as $id) {
                $this->sub_menu_item_model->delete_by_id($id);                   
            }
            $result = array(
                "status" => TRUE,
                "data" => $this->sub_menu_item_model->reload_order_by_sub($submenuid)
            );
            echo json_encode($result);
        }    
    }

    public function ajax_update() {
        //$this->_validate();        
        //$this->_check_available(xssclean($this->input->post('old-code')), xssclean($this->input->post('code')), xssclean($this->input->post('old-loginid')), xssclean($this->input->post('loginid')), xssclean($this->input->post('old-name')), xssclean($this->input->post('name')));
        $id = xssclean($this->input->post('itemid'));
        $submenuid = xssclean($this->input->post('submenuid'));
        $active = $this->input->post('itemactive');
        if ($active == NULL) { $active = 1; };
        
        $data = array(
            'active' => $active,
            'position' => xssclean($this->input->post('itemposition')),
            'name' => xssclean($this->input->post('itemname')),
            'price' => xssclean($this->input->post('price')),
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );
        $this->sub_menu_item_model->update(array('id' => $id), $data);
        $result = array(
            "status" => TRUE,
            "data" => $this->sub_menu_item_model->reload_order_by_pos($submenuid)
        );
        echo json_encode($result);
    }
    
    public function ajax_edit($id) {
        $data = $this->sub_menu_item_model->get_by_id($id);
        echo json_encode($data);
    }   
}