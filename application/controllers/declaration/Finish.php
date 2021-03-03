<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Finish extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url', 'checkbox'));
        $this->load->library('form_validation');

        $this->load->library('session');
        $this->load->model('setting_model');
        $this->load->model('property_model');
        $this->load->model('guest_model');
        $this->load->model('decl_answer_master_model');
        $this->load->model('decl_answer_detail_model');
        $this->load->model('question_model');
    }

    public function index()
    {
        if ($this->session->has_userdata('q1')) {
            if ($this->session->has_userdata('guestid')) {
                $property = $this->property_model->get_by_id($this->session->propertyid);
                $id = $property->code . date('Y') . date('m') . date('d') . $this->session->guestid;

                $this->session->q1 = checkbox_to_boolean(xssclean($this->input->post('q1')));
                $this->session->q2 = xssclean($this->input->post('q2'));
                $this->session->q3 = checkbox_to_boolean(xssclean($this->input->post('q3')));
                $this->session->q4 = xssclean($this->input->post('q4'));
                $this->session->q5 = checkbox_to_boolean(xssclean($this->input->post('q5')));
                $this->session->q6 = checkbox_to_boolean(xssclean($this->input->post('q6')));
                $this->session->q7 = checkbox_to_boolean(xssclean($this->input->post('q7')));
                $this->session->q8 = checkbox_to_boolean(xssclean($this->input->post('q8')));

                if ($this->decl_answer_master_model->find_id($id) == FALSE) {
                    $this->decl_answer_master_model->save($id, date('Y-m-d H:m:s'), $this->session->guestid, $this->session->propertyid);
                }
                if ($this->decl_answer_detail_model->find_id($id) == TRUE) {
                    $this->decl_answer_detail_model->delete_by_id($id);
                }

                $X = 1;
                $answer = array();
                $question = $this->question_model->get_all($this->session->propertyid);
                foreach ($question as $item) {
                    if ($item->answer_type == 1) {
                        $answer[$X] = checkbox_to_boolean(xssclean($this->input->post('q' . $X)));
                    } else {
                        $answer[$X] = xssclean($this->input->post('q' . $X));
                    }
                    $this->decl_answer_detail_model->save($id, $item->id, $answer[$X]);
                    $X++;
                }

                $this->session->question = $answer;
            }
        }

        $guest = $this->guest_model->get_link_id($this->session->guestid);
        $this->send_member_mail($guest->email, $guest->register_link);

        $data['template_folder'] = $this->session->template_folder;
        $closeword = $this->setting_model->get_setting_value('closeword', $this->session->propertyid);
        $data['closeword'] = $closeword->text_value;
        $this->load->view($this->session->template_folder . '/declaration/finish_view', $data);
    }

    function send_member_mail($to_email, $link) {
        // Konfigurasi email
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'mail.pps.co.id',
            'smtp_user' => 'noreply@pps.co.id',  // Email gmail
            'smtp_pass'   => 'inbali8118',  // Password gmail
            'smtp_crypto' => 'tls',
            'smtp_port'   => 587,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        $this->load->library('email', $config);

        // Email dan nama pengirim
        $this->email->from('norepply@pps.co.id', 'PPS info');

        // Email penerima
        $this->email->to($to_email); // Ganti dengan email tujuan

        // Lampiran email, isi dengan url/path file
        //$this->email->attach('https://masrud.com/content/images/20181215150137-codeigniter-smtp-gmail.png');

        // Subject email
        $this->email->subject('Delaration Submision');

        // Isi email
        $this->email->message("Thank you form your declaration submision.<br><br> Click <strong><a href='https://contactless.easyconnect.id/declaration/member/register/" . $link . "' target='_blank' rel='noopener'>here</a></strong> if you want to be a member.");

        // Tampilkan pesan sukses atau error
        //$this->email->send();
        if ($this->email->send()) {
            echo 'Sukses! email berhasil dikirim.';
        } else {
            echo 'Error! email tidak dapat dikirim.';
        }
    
    }
}
