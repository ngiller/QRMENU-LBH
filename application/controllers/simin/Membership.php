<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Membership extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("simin/signin"));
        }

        $this->load->model('property_model');
        $this->load->model('user_group_model');
        $this->load->model('country_model');
        $this->load->model('membership_model');
        $this->load->model('order_detail_item_model');
        $this->load->model('order_detail_model');
        $this->load->model('order_master_model');
        $this->load->library('Pdf'); 
        $this->load->library('AlphaPdf'); 
    }

    function index()
    {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['country_data'] = $this->country_model->get_order_by_name();
        $data['usergroup_data'] = $this->user_group_model->get_order_by_name();
        $data['active_menu'] = 35;
        $data['title'] = "MEMBERSHIP LIST";
        $this->load->view('simin/membership_view', $data);
    }

    function order($guest_id)
    {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['country_data'] = $this->country_model->get_order_by_name();
        $data['usergroup_data'] = $this->user_group_model->get_order_by_name();
        $data['order_data'] = $this->order_master_model->get_guest_order($guest_id);
        $data['guest_data'] = $this->membership_model->get_by_id($guest_id);
        $data['active_menu'] = 30;
        $data['title'] = "GUEST LIST";
        $this->load->view('simin/guest_order_view', $data);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('email') == '') {
            $data['inputerror'][] = 'email';
            $data['error_string'][] = 'Email is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('name') == '') {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('phone') == '') {
            $data['inputerror'][] = 'phone';
            $data['error_string'][] = 'Phone is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    public function _check_available($oldcode, $newcode)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($oldcode != $newcode) {
            if ($this->membership_model->is_email($newcode)) {
                $data['inputerror'][] = 'email';
                $data['error_string'][] = 'Email already exits';
                $data['status'] = FALSE;
            }
        }

        if ($data['status'] == FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    public function ajax_list()
    {
        $list = $this->membership_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $guest) {
            $no++;
            $row = array();
            $row[] = $guest->email;
            $row[] = $guest->name;
            $row[] = $guest->phone;
            $row[] = $guest->member_id;
            $row[] = $guest->countryname;;

            //add html for action
            $row[] = '<a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="Edit" href="javascript:void(0)" onclick="edit_record(' . "'" . $guest->id . "'" . ')"><i class="flaticon-edit"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle del_data" href="javascript:void(0)" title="Delete" onclick="delete_record(' . "'" . $guest->id . "'" . ')"><i class="flaticon-delete"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="View order" href="javascript:void(0)" onclick="view_order(' . "'" . $guest->id . "'" . ')"><i class="flaticon-list-2"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="View Member Card" href="javascript:void(0)" onclick="view_member_card(' . "'" . $guest->id . "'" . ')"><i class="flaticon2-browser"></i></a>';
            $row[] = '<input type="checkbox" name="id[]" class="delete_customer" value="' . $guest->id . '" />';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->membership_model->count_all(),
            "recordsFiltered" => $this->membership_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function add_save()
    {
        $this->_validate();
        $this->_check_available('', $this->input->post('email'));
        $email = $this->input->post('email');
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $country = $this->input->post('country');
        $this->membership_model->save($email, $name, $phone, $country);
        $result = array(
            "status" => TRUE,
            "data" => $this->membership_model->reload_order_by_email()
        );
        echo json_encode($result);
    }

    public function delete($id)
    {
        $this->membership_model->delete_by_id($id);
        $result = array(
            "status" => TRUE,
            "data" => $this->membership_model->reload_order_by_email()
        );

        echo json_encode($result);
    }

    public function del_selected()
    {
        if ($this->input->post('id')) {
            foreach ($_POST["id"] as $id) {
                $this->membership_model->delete_by_id($id);
            }
            $result = array(
                "status" => TRUE,
                "data" => $this->membership_model->reload_order_by_name()
            );
            echo json_encode($result);
        }
    }

    public function ajax_update()
    {
        $this->_validate();
        $this->_check_available($this->input->post('old-code'), $this->input->post('email'));

        $active = $this->input->post('active');
        if ($active == NULL) {
            $active = 1;
        }

        $data = array(
            'email' => $this->input->post('email'),
            'name' => $this->input->post('name'),
            'phone' => $this->input->post('phone'),
            'country' => $this->input->post('country'),
            'propertyid' => $this->session->propertyid
        );
        $this->membership_model->update(array('id' => $this->input->post('id')), $data);
        $result = array(
            "status" => TRUE,
            "data" => $this->membership_model->reload_order_by_email()
        );
        echo json_encode($result);
    }

    public function ajax_edit($id)
    {
        $data = $this->membership_model->get_by_id($id);
        echo json_encode($data);
    }

    public function change_property()
    {
        $row = $this->property_model->get_by_id($this->input->post('id'));
        $this->session->set_userdata('propertyid', $row->id);
        $this->session->set_userdata('propertyname', $row->name);
        echo json_encode(array($this->session->propertyname));
    }

    public function card($id) {
        $data = $this->membership_model->get_by_id($id);

        $pdf = new AlphaPDF();
        $pdf->AddPage();
        $pdf->Image('assets/img/member-card.jpg',30,30);
        $pdf->SetAlpha(1);

        $pdf->SetFont('Arial', 'B', 14);
        $pdf->setTextColor(254, 254, 254);
        $pdf->Cell(148);
        $pdf->Cell( 1, 177, $data->member_id, 0, 0, 'R' );
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell( 1, 188, $data->name, 0, 0, 'R' ); 

        //$path = $_SERVER["DOCUMENT_ROOT"].'/uploads/cards/';
        //$pdf->Output($path.$file_name.'.pdf', 'F');
        $pdf->Output();
    }
}
