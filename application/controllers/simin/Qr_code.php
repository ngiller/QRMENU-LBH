<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Qr_code extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("simin/signin"));
        }

        $this->load->model('property_model');
        $this->load->model('outlet_table_model');
        $this->load->model('property_model');
        $this->load->model('outlet_model');
    }

    public function ajax_list($outlet_id)
    {
        $outlet_id = xssclean($outlet_id);
        $list = $this->outlet_table_model->get_datatables($outlet_id);
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
            $row[] = $outlet->table_no;
            $row[] = '<a href="javascript:void(0)" onclick="show_qr(' . "'" . $outlet->id . "'" . ')"><span class="kt-badge kt-badge--inline kt-badge--brand">Show QR</span></a>';

            //add html for action
            $row[] = '<a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="Edit" href="javascript:void(0)" onclick="edit_record(' . "'" . $outlet->id . "'" . ')"><i class="flaticon-edit"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle del_data" href="javascript:void(0)" title="Delete" onclick="delete_record(' . "'" . $outlet->id . "'" . ')"><i class="flaticon-delete"></i></a>';
            $row[] = '<input type="checkbox" name="id[]" class="delete_customer" value="' . $outlet->id . '" />';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->outlet_table_model->count_all($outlet_id),
            "recordsFiltered" => $this->outlet_table_model->count_filtered($outlet_id),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('table_no') == '') {
            $data['inputerror'][] = 'table_no';
            $data['error_string'][] = 'Room / table number is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    function add_save()
    {
        $this->_validate();
        $active = xssclean($this->input->post('active'));
        if ($active == NULL) {
            $active = 1;
        }
        $table_no = xssclean($this->input->post('table_no'));
        $outlet_id = xssclean($this->input->post('outlet_id'));

        $this->outlet_table_model->save($outlet_id, $active, $table_no);
        $result = array(
            "status" => TRUE,
            "data" => $this->outlet_table_model->reload_order_by_name($outlet_id)
        );
        echo json_encode($result);
    }

    public function delete($id)
    {

        $this->outlet_table_model->delete_by_id($id);

        $result = array(
            "status" => TRUE,
            "data" => $this->outlet_table_model->reload_order_by_name($id)
        );

        echo json_encode($result);
    }

    public function del_selected()
    {
        if ($this->input->post('id')) {
            foreach ($_POST["id"] as $id) {
                if ($id <> -1) {
                    $this->outlet_table_model->delete_by_id($id);
                }
            }
            $result = array(
                "status" => TRUE,
                "data" => $this->outlet_table_model->reload_order_by_name($id)
            );
            echo json_encode($result);
        }
    }

    public function ajax_update()
    {
        $this->_validate();

        $active = $this->input->post('active');
        if ($active == NULL) {
            $active = 1;
        }

        $data = array(
            'outlet_id' => xssclean($this->input->post('outlet_id')),
            'active' => $active,     
            'table_no' => xssclean($this->input->post('table_no')),
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")
        );
        $this->outlet_table_model->update(array('id' => xssclean($this->input->post('id'))), $data);
        $result = array(
            "status" => TRUE,
            "data" => $this->outlet_model->reload_order_by_name()
        );
        echo json_encode($result);
    }

    public function ajax_edit($id)
    {
        $id = xssclean($id);
        $data = $this->outlet_table_model->get_by_id($id);
        echo json_encode($data);
    }

    public function show($id)
    {
        $id = xssclean($id);
        $qr_data = $this->outlet_table_model->get_by_id($id); 
        $property = $this->property_model->get_by_id($this->session->propertyid);
        $outlet = $this->outlet_model->get_by_id($qr_data->outlet_id);

        $this->load->library('ciqrcode');
        $config['imagedir']     = 'uploads/qr_code/'.$property->code.'/';
        if (!is_dir($config['imagedir'])) {
            mkdir($config['imagedir'], 0755, true);
        }
        $config['quality']      = true;
        $config['black']        = array(224, 255, 255);
        $config['white']        = array(70, 130, 180);
        $this->ciqrcode->initialize($config);

        $image_name = $property->code . $outlet->code . $qr_data->table_no.'.png';
        unlink(FCPATH . $config['imagedir'] . $image_name);

        $params['data'] = base_url('/home/' . $property->code . '/' . $outlet->code . '/' . $qr_data->table_no);
        $params['level'] = 'H';
        $params['size'] = '1024';
        $params['savename'] = FCPATH . $config['imagedir'] . $image_name;
        $this->ciqrcode->generate($params);

        $result = array(
            "status" => TRUE,
            "qr_code" => base_url($config['imagedir'] . $image_name),
            "table_no" => $qr_data->table_no,
            "outlet_name" => $outlet->name
        );
        echo json_encode($result);
    }
}
