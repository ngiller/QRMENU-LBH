<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->load->library('session');
        $this->load->model('setting_model');
        $this->load->model('property_model');
        $this->load->model('guest_model');

        $this->load->library('Pdf'); 
        $this->load->library('AlphaPdf'); 
    }

    public function register($lid) {
        $lid = xssclean($lid);
        $guest = $this->guest_model->get_member_link($lid);
        if ($guest && !$guest->member_register) {
            $property = $this->property_model->get_by_id($guest->propertyid);
            $data['template_folder'] = $property->template_folder;
            $data['lid'] = $lid;
            $data['guest'] = $guest;
            $data['error_msg'] = '';
            $this->load->view($property->code.'/declaration/member_register_view', $data);
        } else {
            $this->load->view('member_register_link_notfound_view');
        }
    }

    public function post() {
        
        $lid = xssclean($this->input->post('lid'));
        $guest = $this->guest_model->get_member_link($lid);
        if (!$guest) {
            $this->load->view('member_register_link_notfind_view');
        }

        $property = $this->property_model->get_by_id($guest->propertyid);
        $data['template_folder'] = $property->template_folder;
        $data['lid'] = $lid;
        $data['guest'] = $guest;
        
        $this->form_validation->set_rules('name','Full Name','required');
        $this->form_validation->set_rules('email','Email Address','required');
        $this->form_validation->set_rules('phone','Phone Number','required');
        $this->form_validation->set_rules('phone','Phone number','required');

        if ($this->form_validation->run() == FALSE) {       
            $data['error_msg'] = '';
            $this->load->view($property->code.'/declaration/member_register_view', $data);
        } else {
            $member_count = $this->setting_model->get_setting_value('member_id_start', $guest->propertyid);
            $member_prefix = $this->setting_model->get_setting_value('member_id_prefix', $guest->propertyid);
            $file_name = $member_prefix->value . ($member_count->value + 1);

            $config['upload_path'] = './uploads/members/';
            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
            $config['file_name'] = $file_name;

            $this->load->library('upload', $config);
            
            if ( ! $this->upload->do_upload('photo')) {
                $data['error_msg'] = $this->upload->display_errors();
                $this->load->view($property->code.'/declaration/member_register_view', $data);
            } else {
                $file_data = $this->upload->data();
                $guest_data = array(
                    'email' => xssclean($this->input->post('email')),
                    'name' => xssclean($this->input->post('name')),
                    'phone' => xssclean($this->input->post('phone')),
                    'member_id' => $file_name,
                    'member_register' => 1,
                    'file_name' => $file_data['file_name']
                );
                $this->guest_model->update(array('id' => $guest->id), $guest_data);

                $member_count = array(
                    'name' => 'member_id_start',
                    'value' => $member_count->value + 1,
                    'property_id' => $guest->propertyid,
                    'userlast' => 0,
                    'datelast' => date("Y/m/d h:i:sa")
                );
                $this->setting_model->update(array('name' => 'member_id_start'), $member_count);

                $pdf = new AlphaPDF();
                $pdf->AddPage();
                $pdf->Image('assets/img/member-card.jpg',30,30);
                $pdf->SetAlpha(1);

                $pdf->SetFont('Arial', 'B', 14);
                $pdf->setTextColor(254, 254, 254);
                $pdf->Cell(148);
                $pdf->Cell( 1, 177, $file_name, 0, 0, 'R' );
                $pdf->SetFont('Arial', '', 12);
                $pdf->Cell( 1, 188, xssclean($this->input->post('name')), 0, 0, 'R' ); 

                $path = $_SERVER["DOCUMENT_ROOT"].'/uploads/cards/';
                $pdf->Output($path.$file_name.'.pdf', 'F');

                $data['template_folder'] = $property->template_folder;
                $data['lid'] = $lid;
                $data['guest'] = $guest_data;
                $this->load->view($property->code.'/declaration/member_register_success_view', $data);
            }
        }
    }
}