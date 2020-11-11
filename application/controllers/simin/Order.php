<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    function __construct() {
        parent::__construct();

        if($this->session->userdata('status') != "login"){
			redirect(base_url("simin/signin"));
		}

        $this->load->model('setting_model');
        $this->load->model('property_model');
        $this->load->model('outlet_model');
        $this->load->model('order_master_model');
        $this->load->model('order_detail_model');
        $this->load->model('order_detail_item_model');
    }

    function index() {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['select_outlet'] = $this->outlet_model->get_order_by_name();
        $data['active_menu'] = 20;
        $data['title'] = "ORDER LIST"; //echo $this->session->bdate; exit;
        if ($this->session->bdate == "") {
            $this->session->bdate = date('d-m-Y');
            $this->session->edate = date('d-m-Y');
        }
        $this->load->view('simin/order_view', $data);
    }
  
    public function ajax_list() {
        $list = $this->order_master_model->get_datatables(); //print_r($this->session->edate); exit;
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $order) {
            $no++;
            $row = array();            
            $row[] = $order->id;
            $row[] = $order->orderdate;
            $row[] = $order->table_num; 
            $row[] = $order->pax;
            $row[] = $order->name;            
            $row[] = "Rp. ".number_format($order->total,0,",",".");
            switch ($order->status) {
                case 0 : 
                    $row[] = 'WAITING';
                    break;
                case 1 :
                    $row[] = 'CONFIRM';
                    break;
                case 2 :
                    $row[] = 'CANCEL';
                    break;
            }
            //add html for action
            $row[] = '<a class="btn btn-info btn-sm edit_data" title="Edit" href="javascript:void(0)" onclick="edit_record('."'".$order->id."'".')"><i class="flaticon-edit"></i> Edit status</a>';                
            
           
            $data[] = $row;
        }
   
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->order_master_model->count_all(),
            "recordsFiltered" => $this->order_master_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function ajax_update() {
        //$this->_validate();        
        //$this->_check_available(xssclean($this->input->post('old-code')), xssclean($this->input->post('code')), xssclean($this->input->post('old-loginid')), xssclean($this->input->post('loginid')), xssclean($this->input->post('old-name')), xssclean($this->input->post('name')));

        $active = $this->input->post('active');
        if ($active == NULL) { $active = 1; };
        $halal = xssclean($this->input->post('halal'));
        if ($halal == NULL) { $halal = 1; };
        $chefrecom = xssclean($this->input->post('chefrecom'));
        if ($chefrecom == NULL) { $chefrecom = 1; };
        
        $data = array(
            'active' => $active,
            'code' => xssclean($this->input->post('code')),
            'name' => xssclean($this->input->post('name')),
            'categoryid' => xssclean($this->input->post('catid')),
            'descriptions' => xssclean($this->input->post('desc')),
            'price' => xssclean($this->input->post('price')),
            'disc' => xssclean($this->input->post('disc')),
            'halal' => $halal,
            'chefrecomend' => $chefrecom,
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );
        $this->order_master_model->update(array('id' => $this->input->post('id')), $data);
        $result = array(
            "status" => TRUE,
            "data" => $this->order_master_model->reload_order_by_name()
        );
        echo json_encode($result);
    }
    
    public function ajax_edit($id) {
        $data = $this->order_master_model->get_by_id($id);
        echo json_encode($data);
    }   
    

    public function change_property() {
        $row = $this->order_master_model->get_by_id($this->input->post('id'));
        $this->session->set_userdata('propertyid', $row->id);
        $this->session->set_userdata('propertyname', $row->name);
        echo json_encode(array($this->session->propertyname));
    }

    public function show_record() {
        $bdate = $this->input->post('fromdate');
        $edate = $this->input->post('todate');

        $this->session->bdate = $bdate;
        $this->session->edate = $edate;

        $result = array("status" => $this->session->edate);
        echo json_encode($result);
    }

    public function detail($id) {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['select_outlet'] = $this->outlet_model->get_order_by_name();
        $data['order_data'] = $this->order_master_model->get_by_id($id);
        $data['detail_data'] = $this->order_detail_model->get_by_id($id);
        $data['tax_data'] = $this->setting_model->get_setting_value('tax', $this->session->propertyid);
        $data['service_data'] = $this->setting_model->get_setting_value('service', $this->session->propertyid);
        $data['back_to'] = 'simin/order';
        $data['active_menu'] = 2;
        $data['title'] = "ORDER DETAIL";
        $this->load->view('simin/order_detail_view', $data);
    }

    public function change_status() {
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        $data = array(
            'status' => $status
        );
        $this->order_master_model->update(array('id' => $id), $data);
        $result = array("status" => "TRUE");
        echo json_encode($result);
    }

    public function test() {
        $this->order_master_model->_get_datatables_query();
    }
}