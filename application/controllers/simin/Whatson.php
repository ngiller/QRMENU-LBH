<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Whatson extends CI_Controller {

    function __construct() {
        parent::__construct();

        if($this->session->userdata('status') != "login"){
			redirect(base_url("simin/signin"));
		}

        $this->load->model('property_model');
        $this->load->model('user_group_model');
        $this->load->model('pages_model');
        $this->load->model('whatson_model');        
    }

    function index() {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['usergroup_data'] = $this->user_group_model->get_order_by_name();
        $data['active_menu'] = 50;
        $data['title'] = "WHATS ON";
        $this->load->view('simin/whatson_view', $data);
    }

    function addnew() {
        $data['next_pos'] = $this->whatson_model->get_next_pos();
        $data['pages_data'] = $this->pages_model->get_order_by_name();
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['active_menu'] = 5;
        $data['title'] = "NEW WHATS ON";
        $this->load->view('simin/whatson_add_view', $data);   
    }

    
    function _get_link($title) {
        $count = 0;
        $link = str_replace(" ", "-", strtolower($title));
        while ($this->whatson_model->get_by_link($link)) {
            $count++;
            $link = $link . $count;        
        }
        return $link;
    }

    function _check_link($oldlink, $newlink) {
        $count = 0;
        if ($oldlink != $newlink) {
            $link = str_replace(" ", "-", strtolower($newlink));
            while ($this->whatson_model->get_by_link($link)) {
                $count++;
                $link = $link . $count;        
            }
            return $link;
        } else {
            return $oldlink;
        }
    }
  
    public function ajax_list() {
        $list = $this->whatson_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $whatson) {
            $no++;
            $row = array();      
            if ($whatson->active == 0) {
                $row[] = '<input type="checkbox" checked="checked" name="active">';      
            } else {
                $row[] = '<input type="checkbox" name="active">';      
            }
            $row[] = $whatson->position;
            $row[] = $whatson->title;
            if ($whatson->showonhome == 0) {
                $row[] = '<input type="checkbox" checked="checked" name="onhome">';      
            } else {
                $row[] = '<input type="checkbox" name="onhome">';      
            } 
            $row[] = $whatson->datelast;         
   
            //add html for action
            //$linkedit = "simin\pages\rec_edit\";

            $row[] = '<a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="Edit" href="javascript:void(0)" onclick="edit_record('."'".$whatson->id."'".')"><i class="flaticon-edit"></i></a>
            <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="Duplicate" href="javascript:void(0)" onclick="dup_record('."'".$whatson->id."'".')"><i class="flaticon2-copy"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle del_data" href="javascript:void(0)" title="Delete" onclick="delete_record('."'".$whatson->id."'".')"><i class="flaticon-delete"></i></a>';
            $row[] = '<input type="checkbox" name="id[]" class="delete_customer" value="' . $whatson->id .'" />';
           
            $data[] = $row;
        }
   
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->whatson_model->count_all(),
            "recordsFiltered" => $this->whatson_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function add_save(){
        $active = $this->input->post('active');
        if ($active == NULL) { $active = 1; }
        $onhome = $this->input->post('onhome');
        if ($onhome == NULL) { $onhome = 1; }
        $pos = $this->input->post('pos');
        $title = $this->input->post('title');
        $page_link = $this->input->post('pagelink');
        $short_desc = $this->input->post('short_desc');
        $desc = $this->input->post('descriptions');
        $homeimage = $this->input->post('homeimage');
        $topimage = $this->input->post('imgPhoto');
        $linktopage = $this->input->post('linktopage');

        if ($page_link == 0) {
            $link = $this->_get_link($title);
        } else {
            $page = $this->pages_model->get_by_id($page_link);
            $link = $page->link;
        }
        
        $this->whatson_model->save($active, $pos, $onhome, $title, $page_link, $short_desc, $desc, $homeimage, $topimage, $link, $linktopage);
        $result = array(
            "status" => TRUE,
            "data" => $this->whatson_model->reload_order_by_pos()
        );
        echo json_encode($result);
    }

    public function delete($id){        
        $this->whatson_model->delete_by_id($id);        
        $result = array(
            "status" => TRUE,
            "data" => $this->pages_model->reload_order_by_name()
        );
        
        echo json_encode($result);

    }

    public function del_selected(){
        if ($this->input->post('id')) {
            foreach($_POST["id"] as $id) {
                $this->whatson_model->delete_by_id($id);                   
            }
            $result = array(
                "status" => TRUE,
                "data" => $this->whatson_model->reload_order_by_pos()
            );
            echo json_encode($result);
        }    
    }

    public function ajax_update() {        
        if ($this->input->post('pagelink') == 0) {
            if ($this->input->post('old-link') == '' AND $this->input->post('link') == '') {
                $link = $this->_get_link($this->input->post('title'));
            } else {
                $link = $this->_check_link($this->input->post('old-link'), $this->input->post('link'));
            }                    
        } else {
            $page = $this->pages_model->get_by_id($this->input->post('pagelink'));
            $link = $page->link;
        }

        $active = $this->input->post('active');
        if ($active == NULL) { $active = 1; }

        $onhome = $this->input->post('onhome');
        if ($onhome == NULL) { $onhome = 1; }
        
        $data = array(
            'active' => $active, 
            'position' => $this->input->post('pos'),             
            'title' => $this->input->post('title'),
            'page_link' => $this->input->post('pagelink'),
            'short_desc' => $this->input->post('short_desc'),
            'descriptions' => $this->input->post('descriptions'),
            'topimage' => "",            
            'showonhome'=> $onhome,
            'homeimage' =>  $this->input->post('homeimage'),
            'link' => $link,
            'link_to_url' => $this->input->post('linktopage'),
            'propertyid' => $this->session->propertyid,
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );
        $this->whatson_model->update(array('id' => $this->input->post('id')), $data);       
        $result = array(
            "status" => TRUE,
            "data" => $this->whatson_model->reload_order_by_pos()
        );
        echo json_encode($result);
    }
    
    public function rec_edit($id) {
        $data['active_menu'] = 5;
        $data['title'] = "EDIT WHATS ON";
        $data['data'] = $this->whatson_model->get_by_id($id);
        $data['pages_data'] = $this->pages_model->get_order_by_name();
        $data['select_data'] = $this->property_model->get_order_by_name();
        $this->load->view('/simin/whatson_edit_view',$data);
        //echo json_encode($data);
    }

    public function rec_dup($id) {
        $row = $this->whatson_model->get_by_id($id);
        $title = $row->title;
        if (substr($title, -4) == 'copy') {
            $count = 0;
            while ($this->whatson_model->get_by_title($title)) {
                $count++;
                $title = $title . $count;
            }
        } else {
            $title = $row->title . "-copy";
        }    

        $this->whatson_model->save($row->active, $row->position + 1, $row->showonhome, $title, $row->page_link,$row->short_desc, $row->descriptions, $row->homeimage, $row->topimage, $row->link);
        $result = array(
            "status" => TRUE,
            "data" => $this->whatson_model->reload_order_by_pos()
        );
        echo json_encode($result);
    }

    

    
}