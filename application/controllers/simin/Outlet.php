<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Outlet extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("simin/signin"));
        }

        $this->load->model('property_model');
        $this->load->model('setting_model');
        $this->load->model('user_group_model');
        $this->load->model('outlet_model');
    }

    function index()
    {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['usergroup_data'] = $this->user_group_model->get_order_by_name();
        $data['active_menu'] = 100;
        $data['title'] = "OUTLET LIST";
        $this->load->view('simin/outlet_view', $data);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('code') == '') {
            $data['inputerror'][] = 'code';
            $data['error_string'][] = 'Code is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('name') == '') {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Name is required';
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
            if ($this->outlet_model->is_code($newcode)) {
                $data['inputerror'][] = 'code';
                $data['error_string'][] = 'Code already exits';
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
        $list = $this->outlet_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $outlet) {
            $no++;
            $row = array();
            if ($outlet->active == 0) {
                $row[] = '<input type="checkbox" checked="checked" name="active">';
            } else {
                $row[] = '<input type="checkbox" name="active">';
            }
            $row[] = $outlet->code;
            $row[] = $outlet->name;
            $row[] = $outlet->opentime;
            $row[] = $outlet->closetime;
            $row[] = '<a href="/simin/outlet/qr_code/' . $outlet->id . '"><span class="kt-badge kt-badge--inline kt-badge--brand">QR Code</span></a>';

            //add html for action
            $row[] = '<a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="Edit" href="javascript:void(0)" onclick="edit_record(' . "'" . $outlet->id . "'" . ')"><i class="flaticon-edit"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle del_data" href="javascript:void(0)" title="Delete" onclick="delete_record(' . "'" . $outlet->id . "'" . ')"><i class="flaticon-delete"></i></a>';
            $row[] = '<input type="checkbox" name="id[]" class="delete_customer" value="' . $outlet->id . '" />';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->outlet_model->count_all(),
            "recordsFiltered" => $this->outlet_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function add_save()
    {
        $this->_validate();
        $this->_check_available('', $this->input->post('code'));
        
        $active = $this->input->post('active');
        if ($active == NULL) {
            $active = 1;
        }
        $orderable = $this->input->post('orderable');
        if ($orderable == NULL) {
            $orderable = 1;
        }

        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $open = $this->input->post('open');
        $close = $this->input->post('close');
        $guest_timeout = $this->input->post('guest_timeout');
        $image = $this->input->post('image');
        $this->outlet_model->save($active, $code, $name, $open, $close, $guest_timeout, $orderable, $image);
        $result = array(
            "status" => TRUE,
            "data" => $this->outlet_model->reload_order_by_name()
        );
        echo json_encode($result);
    }

    public function delete($id)
    {
        if ($id <> -1) {
            $this->outlet_model->delete_by_id($id);
        }
        $result = array(
            "status" => TRUE,
            "data" => $this->outlet_model->reload_order_by_name()
        );

        echo json_encode($result);
    }

    public function del_selected()
    {
        if ($this->input->post('id')) {
            foreach ($_POST["id"] as $id) {
                if ($id <> -1) {
                    $this->outlet_model->delete_by_id($id);
                }
            }
            $result = array(
                "status" => TRUE,
                "data" => $this->outlet_model->reload_order_by_name()
            );
            echo json_encode($result);
        }
    }

    public function ajax_update()
    {
        $this->_validate();
        $this->_check_available($this->input->post('old-code'), $this->input->post('code'));

        $active = $this->input->post('active');
        if ($active == NULL) {
            $active = 1;
        }

        $orderable = $this->input->post('orderable');
        if ($orderable == NULL) {
            $orderable = 1;
        }

        $data = array(
            'active' => $active,
            'code' => $this->input->post('code'),
            'name' => $this->input->post('name'),
            'opentime' => $this->input->post('open'),
            'closetime' => $this->input->post('close'),
            'guest_timeout' => $this->input->post('guest_timeout'),
            'orderable' => $orderable,
            'image' => $this->input->post('image'),
            'propertyid' => $this->session->propertyid,
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")
        );
        $this->outlet_model->update(array('id' => $this->input->post('id')), $data);
        $result = array(
            "status" => TRUE,
            "data" => $this->outlet_model->reload_order_by_name()
        );
        echo json_encode($result);
    }

    public function ajax_edit($id)
    {
        $data = $this->outlet_model->get_by_id($id);
        echo json_encode($data);
    }

    public function change_property()
    {
        $row = $this->property_model->get_by_id($this->input->post('id'));
        $this->session->set_userdata('propertyid', $row->id);
        $this->session->set_userdata('propertyname', $row->name);
        echo json_encode(array($this->session->propertyname));
    }

    public function qr_code($id)
    {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['usergroup_data'] = $this->outlet_model->get_order_by_name();
        $qrsize = $this->setting_model->get_setting_value('qrsize', $this->session->propertyid);
        $data['qr_size'] = $qrsize->value;
        $data['active_menu'] = 100;
        $outlet = $this->outlet_model->get_by_id($id);
        $data['outlet_id'] = $outlet->id;
        $data['title'] = "QR CODE - " . $outlet->name;
        //$data['qrcode'] = $image_name;
        $this->load->view('simin/qrcode_view', $data);
    }
}
