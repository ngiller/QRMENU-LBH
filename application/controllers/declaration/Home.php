<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->load->library('session');
        $this->load->model('setting_model');
        $this->load->model('property_model');
        $this->load->model('outlet_model');
        $this->load->model('guest_model');

    }

    public function guest($pid) {
        $pid = xssclean($pid);
        if ($this->property_model->is_code($pid)) {

            $property = $this->property_model->get_by_code($pid);
            $time_zone = $this->setting_model->get_setting_value('time_zone', $property->id);
            date_default_timezone_set($time_zone->value);

            $this->form_validation->set_rules('name','Full Name','required');
		    $this->form_validation->set_rules('email','Email Address','required');
            $this->form_validation->set_rules('phone','Phone Number','required');
            $this->form_validation->set_rules('arrival','Arrival Date','required');
            $this->form_validation->set_rules('time','Arrival Time','required');

            if ($this->form_validation->run() == FALSE) {

                if (!$this->session->has_userdata('guestid')) {
                    $data_session = array(                        
                        'propertyid' => $property->id,
                        'propertyname' => $property->name,
                        'outletoriginid' => "",
                        'outletid' => "",
                        'outletname' => "",
                        'tableno' => "",
                        'orderid' => "",
                        'guestid' => "",
                        'pax' => 0,
                        'payment' => "",
                        'guest_session' => 0,
                        'timezone' => $time_zone->value,
                        'template_folder' => $property->template_folder
                    );
                    $this->session->set_userdata($data_session);

                    $data['name'] = "";
                    $data['email'] = "";
                    $data['phone'] = "";
                    $data['arrival_date'] = date('Y-m-d');
                    $data['arrival_time'] = date('H:i:s');
                } else {
                    //echo $this->session->guestid; exit;
                    if ($this->guest_model->find_id($this->session->guestid)==TRUE) {
                        $guest = $this->guest_model->get_by_id($this->session->guestid);
                        $data['name'] = $guest->name;
                        $data['email'] = $guest->email;
                        $data['phone'] = $guest->phone;
                        $data['arrival_date'] = date('Y-m-d');
                        $data['arrival_time'] = date('H:i:s');
                    } else { 
                        $data['name'] = "";
                        $data['email'] = "";
                        $data['phone'] = "";
                        $data['arrival_date'] = date('Y-m-d');
                        $data['arrival_time'] = date('H:i:s');
                    }
                }
                
                $data['template_folder'] = $property->template_folder;
                $data['pid'] = $pid; 
                if ($this->property_model->is_code($pid) == TRUE) {
                    $foreword = $this->setting_model->get_setting_value('foreword', $property->id);
                    $data['foreword'] = $foreword->text_value;
                    $this->load->view($pid.'/declaration/home_view', $data);
                }
            } else {

                $pid = xssclean($this->input->post('pid'));
                $email = xssclean($this->input->post('email'));
                $name = xssclean($this->input->post('name'));
                $arrival = xssclean($this->input->post('arrival'));
                $time = xssclean($this->input->post('time'));
                $phone = xssclean($this->input->post('phone'));

                if ($this->guest_model->is_email($email) == FALSE) {
                    $this->guest_model->save($email, $name, $phone, "");
                }
                $guest = $this->guest_model->get_by_email($email, $property->id);

                if ($guest->register_link == '') {
                    $this->load->library('randomlink');
                    $link = $this->randomlink->create_link(40);
                } else {
                    $link = $guest->register_link;
                }

                $guest_id = $guest->id;
                $guest_update = array(
                    'email' => $email,
                    'name' => $name,
                    'phone' => $phone,
                    'register_link' => $link
                );
                $this->guest_model->update(array('id' => $guest_id), $guest_update);

                $outlet = $this->outlet_model->get_by_code($property->id, '999');
                
                $data_session = array(                        
                    'propertyid' => $property->id,
                    'propertyname' => $property->name,
                    'outletoriginid' => "",
                    'outletid' => "",
                    'outletname' => "",
                    'tableno' => "",
                    'orderid' => "",
                    'guestid' => $guest->id,
                    'pax' => 0,
                    'payment' => "",
                    'guest_session' => $outlet->guest_timeout,
                    'timezone' => $time_zone->value,
                    'template_folder' => $property->template_folder
                );
                $this->session->set_userdata($data_session);

                $this->session->set_flashdata('arrival_date', $arrival);
                $this->session->set_flashdata('arrival_time', $time);
                redirect('/declaration/question');

            }
        } else {
            $this->load->view('/not_found_view');
        }
    }

    public function find_guest()
    {
        $email = xssclean($this->input->post('email'));
        if ($this->guest_model->is_email($email)) {
            $guest = $this->guest_model->get_by_email($email, $this->session->propertyid);
            $status = 'TRUE';
        } else {
            $status = 'FALSE';
            $guest = "";
        }

        if ($status == 'FALSE') {
            $data_session = array(
                'q1' => "-1",
                'q2' => "-1",
                'q3' => "-1",
                'q4' => "-1",
                'q5' => "-1",
                'q6' => "",
                'q7' => "-1",
                'q8' => "",
                'q9' => "-1"
            );
            $this->session->set_userdata($data_session);
        }

        $data = array(
            'status' => $status,
            'guest' => $guest
        );

        echo json_encode($data);
    }

}    