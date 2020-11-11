<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {

    function __construct() {
        parent::__construct();

        if($this->session->userdata('status') != "login"){
			redirect(base_url("simin/signin"));
		}

        $this->load->model('setting_model');
        $this->load->model('property_model');
    }

    function index() {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['active_menu'] = 940;
        $data['title'] = "GENERAL SETTING";
        $this->load->view('simin/setting_view', $data);
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('tax') == '') {
            $data['inputerror'][] = 'cotaxde';
            $data['error_string'][] = 'Tax is required';
            $data['status'] = FALSE;
          }
     
        if($this->input->post('service') == '') {
          $data['inputerror'][] = 'service';
          $data['error_string'][] = 'Serivce is required';
          $data['status'] = FALSE;
        }

        if($this->input->post('timezone') == '') {
            $data['inputerror'][] = 'timezone';
            $data['error_string'][] = 'Time zone is required';
            $data['status'] = FALSE;
          }
     
        if($this->input->post('qrsize') == '') {
          $data['inputerror'][] = 'qrsize';
          $data['error_string'][] = 'QR Size is required';
          $data['status'] = FALSE;
        }
    
        if($data['status'] === FALSE) {
          echo json_encode($data);
          exit();
        }
    }

    public function ajax_update() {
        $this->_validate();        
        date_default_timezone_set($this->session->timezone);
        $data = array(
            'value' => xssclean($this->input->post('tax')),
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );
        $this->setting_model->update(array('name' => 'tax'), $data);
        $data = array(
            'value' => xssclean($this->input->post('service')),
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );
        $this->setting_model->update(array('name' => 'service'), $data);
        $data = array(
            'value' => xssclean($this->input->post('timezone')),
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );
        $this->setting_model->update(array('name' => 'time_zone'), $data);
        $data = array(
            'value' => xssclean($this->input->post('qrsize')),
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );
        $this->setting_model->update(array('name' => 'qrsize'), $data);
        $result = array(
            "status" => TRUE
        );
        echo json_encode($result);
    }
    
    public function ajax_edit() {
        $data = $this->setting_model->get_all();
        echo json_encode($data);
    }

    public function change_property() {
        $row = $this->property_model->get_by_id($this->input->post('id'));
        $this->session->set_userdata('propertyid', $row->id);
        $this->session->set_userdata('propertyname', $row->name);
        echo json_encode(array($this->session->propertyname));
    }

    public function foreword() {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['active_menu'] = 130;
        $foreword = $this->setting_model->get_setting_value('foreword', $this->session->propertyid);
        $closeword = $this->setting_model->get_setting_value('closeword', $this->session->propertyid);
        $data['foreword'] = $foreword->text_value;
        $data['closeword'] = $closeword->text_value;
        $data['title'] = "FOREWORD & CLOSEWORD SETTING";
        $this->load->view('simin/foreword_view', $data);
    }

    public function update_foreword() {
        date_default_timezone_set($this->session->timezone);

        $data = array(
            'text_value' => $this->input->post('foreword'),
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );
        $this->setting_model->update(array('name' => 'foreword'), $data);

        $data = array(
            'text_value' => $this->input->post('closeword'),
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );
        $this->setting_model->update(array('name' => 'closeword'), $data);
        
        $result = array(
            "status" => TRUE
        );
        echo json_encode($result);
    }

    public function popup() {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['active_menu'] = 68;
        $active = $this->setting_model->get_setting_value('popup_greeting', $this->session->propertyid);
        $content = $this->setting_model->get_setting_value('popup_greeting_content', $this->session->propertyid);
        $data['active'] = $active->value;
        $data['content'] = $content->text_value;
        $data['title'] = "POPUP GREETING";
        $this->load->view('simin/popup_greeting_view', $data);
    }

    public function update_popup_greeting() {
        date_default_timezone_set($this->session->timezone);

        $data = array(
            'text_value' => $this->input->post('content'),
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );
        $this->setting_model->update(array('name' => 'popup_greeting_content'), $data);

        $active = $this->input->post('active');
        if ($active == NULL) { $active = 1; }
        $data = array(
            'value' => $active,
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );
        $this->setting_model->update(array('name' => 'popup_greeting'), $data);
        
        $result = array(
            "status" => TRUE
        );
        echo json_encode($result);
    }

    
}