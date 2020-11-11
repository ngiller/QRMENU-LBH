<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guest_answer extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('property_model');
        $this->load->model('user_group_model');
        $this->load->model('decl_answer_master_model');
        $this->load->model('decl_answer_detail_model');
    }

    public function index()
    {

        date_default_timezone_set('Asia/Makassar');
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['usergroup_data'] = $this->user_group_model->get_order_by_name();
        $data['active_menu'] = 110;
        $data['title'] = 'Guest Answer';
        if ($this->session->bdate == "") {
            $this->session->bdate = date('m-d-Y');
            $this->session->edate = date('m-d-Y');
        }
        $this->load->view('/simin/guest_answer_view', $data);
    }

    public function get_list()
    {
        $list = $this->decl_answer_master_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $answer) {
            $no++;
            $row = array();
            $row[] = $answer->date;
            $row[] = $answer->name;
            $row[] = $answer->email;
            $row[] = $answer->score;
            $row[] = $row[] = '<a class="btn btn-info btn-sm edit_data" title="Edit" href="javascript:void(0)" onclick="show_detail('."'".$answer->id."'".')">View detail</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->decl_answer_master_model->count_all(),
            "recordsFiltered" => $this->decl_answer_master_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function get_range()
    {
        $bdate = xssclean($this->input->post('fromdate'));
        $edate = xssclean($this->input->post('todate'));
        $this->session->bdate = $bdate;
        $this->session->edate = $edate;


        $data = array(
            'status' => 'true',
            'tgl' => $bdate
        );
        echo json_encode($data);
    }

    public function detail($id)
    {
        $id = xssclean($id);
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['active_menu'] =110;
        $data['title'] = "GUEST ANSWER DETAIL";
        $data['master'] = $this->decl_answer_master_model->get_id($id);
        $data['detail'] = $this->decl_answer_detail_model->get_id($id);
        $this->load->view('/simin/guest_answer_detail_view', $data);
    }

    public function get_detail($id) {
        print_r($this->decl_answer_detail_model->get_id($id));
    }

}