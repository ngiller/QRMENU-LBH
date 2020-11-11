<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library('cart');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('property_model');
        $this->load->model('outlet_model');
        $this->load->model('outlet_table_model');
        $this->load->model('pages_model');
        $this->load->model('setting_model');
    }

    public function _remap() {
        if ($this->uri->total_segments() == 3) {
            $this->single($this->uri->segment(2), $this->uri->segment(3)); 
        } else {
            if ($this->uri->total_segments() == 4) {
                $this->multi($this->uri->segment(2), $this->uri->segment(3), $this->uri->segment(4));  
            } else {
                $this->multi(-100,-100,-100);
            }
        }
    }


    public function single($oid, $tid) {
    /*    $oid = $this->security->xss_clean($oid);
        $tid = $this->security->xss_clean($tid);
        
        $result = $this->setting_model->get_setting_value('default_property');
        $property = $this->property_model->get_by_id($result->value);

        //-----cari outlet---------------------------
        if ($this->outlet_model->is_code($oid)) {
            $outlet = $this->outlet_model->get_by_code($oid);
        } else { //outlet tidak ditemukan
            $result = $this->setting_model->get_setting_value('default_outlet');
            $outlet = $this->outlet_model->get_by_id($result->value);
        }

        $this->cart->destroy();
        
        $data_session = array(                        
            'propertyid' => $property->id,
            'propertyname' => $property->name,
            'outletid' => $outlet->id,
            'outletname' => $outlet->name,
            'tableno' => $tid,
            'orderid' => "",
            'guestid' => "",
            'pax' => "",
            'roomno' => "",
            'payment' => "",
            'guest_session' => $outlet->guest_timeout
        );        
        $this->session->set_userdata($data_session); 
        if ($outlet->code == 999) { 
            $data['welcome'] = $this->pages_model->get_by_id(-2);
            $this->load->view('directory_home_view', $data);
        } else {    
            $this->load->view('home_view');
        }
*/
    }

    public function multi($pid, $oid, $tid)
    {
        $pid = $this->security->xss_clean($pid);
        $oid = $this->security->xss_clean($oid);
        $tid = $this->security->xss_clean($tid);

        $notfound = false;
        $this->cart->destroy();
        
        if ($this->property_model->is_code($pid) == TRUE) { 
            $property = $this->property_model->get_by_code($pid);
        } else { // property tidak ditemukan
            $notfound = true;
        }

        if (!$notfound) {
            if ($this->outlet_model->check_code($property->id, $oid) == TRUE) {
                $outlet = $this->outlet_model->get_by_code($property->id, $oid);
                if ($this->outlet_table_model->check_table($property->id, $outlet->id, $tid) == FALSE) {
                    $notfound = true; 
                }
            } else { //outlet tidak ditemukan
                $notfound = true;
            }
        }

        if (!$notfound) {
            //----------- CHECK OPEN  OR CLOSE --------------------------
            $data['outlet_msg'] = "";
            $time_zone = $this->setting_model->get_setting_value('time_zone', $property->id);
            date_default_timezone_set($time_zone->value);
            if ( $outlet->opentime != "00:00:00" AND $outlet->closetime != "00:00:00") {
                $this_time = date("H:i:s");
                if ($this_time >= $outlet->opentime AND $this_time <= $outlet->closetime) {
                    $data['outlet_msg'] = "";
                } else {
                    $data['outlet_msg'] = "we are close now";
                }
            }
            
            if ($data['outlet_msg'] == "") {
                if ($this->session->guestid != "") {
                    $this->session->outletoriginid = $outlet->id;
                    $this->session->outletid = $outlet->id;
                    $this->session->outletname = $outlet->name;
                    $this->session->tableno= $tid;
                } else {
                    $data_session = array(                        
                        'propertyid' => $property->id,
                        'propertyname' => $property->name,
                        'outletoriginid' => $outlet->id,
                        'outletid' => $outlet->id,
                        'outletname' => $outlet->name,
                        'tableno' => $tid,
                        'orderid' => "",
                        'guestid' => '',
                        'pax' => 0,
                        'payment' => "",
                        'guest_session' => $outlet->guest_timeout,
                        'timezone' => $time_zone->value,
                        'template_folder' => $property->template_folder
                    );
                    $this->session->set_userdata($data_session);
                }
                
            } else {
                $data_session = array(                        
                    'propertyid' => "",
                    'propertyname' => "",
                    'outletoriginid' => "",
                    'outletid' => "",
                    'outletname' => "",
                    'tableno' => "",
                    'orderid' => "",
                    'guestid' => '',
                    'pax' => 0,
                    'payment' => "", 
                    'guest_session' => 0,
                    'timezone' => $time_zone->value,
                    'template_folder' => $property->template_folder
                );
                $this->session->set_userdata($data_session);
            }      
 
            $data['template_folder'] = $property->template_folder;   
            if ($outlet->code == 999) { 
                $data['welcome'] = $this->pages_model->get_by_id(-2);
                $popup = $this->setting_model->get_setting_value('popup_greeting', $property->id);
                $data['popup'] = $popup->value;
                $popup_content = $this->setting_model->get_setting_value('popup_greeting_content', $property->id);
                $data['popup_content'] = $popup_content->text_value;
                $this->load->view($property->template_folder.'/directory_home_view', $data);
            } else {    

                $this->load->view($property->template_folder.'/home_view', $data);
            }   

        } else {
            $data['template_folder'] = $property->template_folder; 
            $this->load->view('/not_found_view', $data);
        }
    }
}