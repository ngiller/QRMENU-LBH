<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Question extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->load->library('session');
        $this->load->model('setting_model');
        $this->load->model('property_model');
        $this->load->model('question_model');
        $this->load->model('guest_model');
    }

    public function index()
    {
        if (!$this->session->has_userdata('q1')) {
            $data_session = array(
                'q1' => "-1",
                'q2' => "",
                'q3' => "-1",
                'q4' => "",
                'q5' => "-1",
                'q6' => "-1",
                'q7' => "-1",
                'q8' => "-1",
                'q9' => "-1"
            );
            $this->session->set_userdata($data_session);
        }

        $data['arrival_date'] = $this->session->flashdata('arrival_date');
        $data['arrival_time'] = $this->session->flashdata('arrival_time');
        $data['question'] = $this->question_model->get_all($this->session->propertyid);
        $data['template_folder'] = $this->session->template_folder;
        $this->load->view($this->session->template_folder . '/declaration/question_view', $data);
    }
}
