<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

    function __construct() {
        parent::__construct();

        if($this->session->userdata('status') != "login"){
			redirect(base_url("simin/signin"));
		}

        $this->load->model('property_model');
        $this->load->model('user_group_model');
        $this->load->model('pages_model');
        //$this->load->model('pages_gallery_model');
        $this->load->model('home_image_model');
    }

    function index() {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['usergroup_data'] = $this->user_group_model->get_order_by_name();
        $data['active_menu'] = 2;
        $data['title'] = "PAGES";
        $this->load->view('simin/pages_view', $data);
    }

    function addnew() {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['active_menu'] = 2;
        $data['title'] = "NEW PAGES";
        $this->load->view('simin/pages_add_view', $data);   
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('title') == '') {
            $data['inputerror'][] = 'title';
            $data['error_string'][] = 'Title is required';
            $data['status'] = FALSE;
        }    
    
        if($data['status'] === FALSE) {
          echo json_encode($data);
          exit();
        }
    }

    public function _check_available($oldtitle, $newtitle) {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
    
        if ($oldtitle != $newtitle) {
            if ($this->pages_model->get_by_title($newtitle)) {     
                $data['inputerror'][] = 'title';
                $data['error_string'][] = 'Title already exits';
                $data['status'] = FALSE;      
            }
        }        
    
        if($data['status'] == FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    function _get_link($title) {
        $count = 0;
        $link = str_replace(" ", "-", strtolower($title));
        while ($this->pages_model->get_by_link($link)) {
            $count++;
            $link = $link . $count;        
        }
        return $link;
    }

    function _check_link($oldlink, $newlink) {
        $count = 0;
        if ($oldlink != $newlink) {
            $link = str_replace(" ", "-", strtolower($newlink));
            while ($this->pages_model->get_by_link($link)) {
                $count++;
                $link = $link . $count;        
            }
            return $link;
        } else {
            return $oldlink;
        }
    }
  
    public function ajax_list() {
        $list = $this->pages_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pages) {
            $no++;
            $row = array();      
            if ($pages->active == 0) {
                $row[] = '<input type="checkbox" checked="checked" name="active">';      
            } else {
                $row[] = '<input type="checkbox" name="active">';      
            }
            $row[] = $pages->title;
            $row[] = $pages->username; 
            $row[] = $pages->datelast;         
   
            //add html for action
            //$linkedit = "simin\pages\rec_edit\";

            $row[] = '<a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="Edit" href="javascript:void(0)" onclick="edit_record('."'".$pages->id."'".')"><i class="flaticon-edit"></i></a>
            <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="Duplicate" href="javascript:void(0)" onclick="dup_record('."'".$pages->id."'".')"><i class="flaticon2-copy"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle del_data" href="javascript:void(0)" title="Delete" onclick="delete_record('."'".$pages->id."'".')"><i class="flaticon-delete"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle img_data" href="javascript:void(0)" title="Image Gallery" onclick="show_gallery('."'".$pages->id."'".')"><i class="flaticon2-photo-camera"></i></a>';
            $row[] = '<input type="checkbox" name="id[]" class="delete_customer" value="' . $pages->id .'" />';
           
            $data[] = $row;
        }
   
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->pages_model->count_all(),
            "recordsFiltered" => $this->pages_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function add_save(){
        $this->_validate();
        $this->_check_available('', $this->input->post('title'));
        $active = $this->input->post('active');
        if ($active == NULL) { $active = 1; }
        $title = $this->input->post('title');
        $desc = $this->input->post('descriptions');
        //$topimage = $this->input->post('imgPhoto');
        $topimage = "";
        $link = $this->_get_link($title);
        $this->pages_model->save($active, $title, $desc, $topimage, $link);
        $result = array(
            "status" => TRUE,
            "data" => $this->pages_model->reload_order_by_name()
        );
        echo json_encode($result);
    }

    public function delete($id){        
        $this->pages_model->delete_by_id($id);        
        $result = array(
            "status" => TRUE,
            "data" => $this->pages_model->reload_order_by_name()
        );
        
        echo json_encode($result);

    }

    public function del_selected(){
        if ($this->input->post('id')) {
            foreach($_POST["id"] as $id) {
                $this->pages_model->delete_by_id($id);                   
            }
            $result = array(
                "status" => TRUE,
                "data" => $this->pages_model->reload_order_by_name()
            );
            echo json_encode($result);
        }    
    }

    public function ajax_update() {
        $this->_validate();        
        $this->_check_available($this->input->post('old-title'), $this->input->post('title'));
        if ($this->input->post('old-link') == '' AND $this->input->post('link') == '') {
            $link = $this->_get_link($this->input->post('title'));
        } else {
            $link = $this->_check_link($this->input->post('old-link'), $this->input->post('link'));
        }
        $active = $this->input->post('active');
        if ($active == NULL) { $active = 1; }
        
        $data = array(
            'active' => $active, 
            'title' => $this->input->post('title'),
            'descriptions' => $this->input->post('descrip'),
            'topimage' => $this->input->post('imgPhoto'),
            'link' => $link,
            'link_to_url' => $this->input->post('linktopage'),
            'propertyid' => $this->session->propertyid,
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );
        $this->pages_model->update(array('id' => $this->input->post('id')), $data);       
        $result = array(
            "status" => TRUE,
            "data" => $this->pages_model->reload_order_by_name()
        );
        echo json_encode($result);
    }
    
    public function rec_edit($id) {
        $data['active_menu'] = 2;
        $data['title'] = "EDIT PAGES";
        $data['data'] = $this->pages_model->get_by_id($id);
        $data['select_data'] = $this->property_model->get_order_by_name();
        $this->load->view('/simin/pages_edit_view',$data);
        //echo json_encode($data);
    }

    public function rec_dup($id) {
        $row = $this->pages_model->get_by_id($id);
        $title = $row->title;
        if (substr($title, -4) == 'copy') {
            $count = 0;
            while ($this->pages_model->get_by_title($title)) {
                $count++;
                $title = $title . $count;
            }
        } else {
            $title = $row->title . "-copy";
        }    

        $this->pages_model->save($row->active, $title, $row->descriptions, "",$row->link, $row->link_to_url);
        $result = array(
            "status" => TRUE,
            "data" => $this->pages_model->reload_order_by_name()
        );
        echo json_encode($result);
    }

    public function directory_edit() {
        $data['active_menu'] = 60;
        $data['title'] = "EDIT ROOM DIRECTORY PAGE";
        $data['data'] = $this->pages_model->get_by_id(-1);
        $data['select_data'] = $this->property_model->get_order_by_name();
        $this->load->view('/simin/pages_directory_edit_view',$data);
        //echo json_encode($data['img']);
    }

    public function directory_update() {
        
        $active = $this->input->post('active');
        if ($active == NULL) { $active = 1; }
        
        $data = array(
            'active' => 0, 
            'descriptions' => $this->input->post('descrip'),
            'topimage' => '',
            'link' => $this->input->post('link'),
            'propertyid' => $this->session->propertyid,
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );

        $this->pages_model->update(array('id' => $this->input->post('id')), $data);       
        
        $result = array(
            "status" => TRUE,
            "data" => $this->pages_model->reload_order_by_name()
        );
        echo json_encode($result);
    }

    public function welcome_edit() {
        $data['active_menu'] = 40;
        $data['title'] = "EDIT WELCOME MESSAGE";
        $data['data'] = $this->pages_model->get_by_id(-2);
        $data['pages_data'] = $this->pages_model->get_order_by_name();
        $data['select_data'] = $this->property_model->get_order_by_name();
        $this->load->view('/simin/pages_welcome_edit_view',$data);
        //echo json_encode($data['img']);
    }

    public function welcome_update() {
        
        $active = $this->input->post('active');
        if ($active == NULL) { $active = 1; }
        
        $data = array(
            'active' => 0, 
            'descriptions' => $this->input->post('descrip'),
            'topimage' => '',
            //'link' => $this->input->post('link'),
            'propertyid' => $this->session->propertyid,
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );

        $this->pages_model->update(array('id' => $this->input->post('id')), $data);       
        
        $result = array(
            "status" => TRUE,
            "data" => $this->pages_model->reload_order_by_name()
        );
        echo json_encode($result);
    }
}