<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct(){
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
    
	public function index()
	{
		$data['select_data'] = $this->property_model->get_order_by_name();
		$data['select_outlet'] = $this->outlet_model->get_order_by_name();
		$data['order_data'] = $this->order_master_model->show_current_order();
        $data['active_menu'] = 1;
        $data['title'] = "DASHBOARD";
		$this->load->view("simin/dashboard_view", $data);
	}

	public function change_property() {
        $row = $this->order_master_model->get_by_id($this->input->post('id'));
        $this->session->set_userdata('propertyid', $row->id);
        $this->session->set_userdata('propertyname', $row->name);
        echo json_encode(array($this->session->propertyname));
	}
	
	public function ajax_get_order() {
		$order = $this->order_master_model->show_current_order();
		$data = array();
		foreach($order->result() as $items) {

			$ani = "";
			if ($items->status == 0) {
				if (substr($items->orderdate, 0, 10) < date('Y-m-d')) {
					$stat =  "kt-badge--dark";
				} else {
					$stat =  "kt-badge--warning";
					$ani = "element-animation";
				}
			} else {
				switch ($items->status) {
					case 1 : $stat =  "kt-badge--brand"; break;
					case 2 : $stat =  "kt-badge--dark"; break;
					case 3 : $stat =  "kt-badge--success"; break; 
				}
			}
			
			switch ($items->status) {
				case 0 : $status_text = "WAITING"; break;
				case 1 : $status_text = "CONFIRM"; break;
				case 2 : $status_text = "CANCEL"; break;
				case 3 : $status_text = "FINISH"; break; 
			}

			$data[] = '<div class="col-md-3 col-sm-6 mb-3"> 
							<a href="'.base_url().'simin/dashboard/order_edit/'.$items->id.'"><div class="card">
								<div class="card-body">
								
								<span class="kt-badge '. $stat . ' kt-badge--md kt-badge--rounded '. $ani .'" style="min-width: 100%;text-align: center;display: block;padding-top: 5px;padding-left: 5px; font-weight:400;padding-top:5px;height:27px;">Table # : ' . $items->table_num . '</span>
								<h6 class="card-title mt-3"  style="color:#000;">Status : ' . $status_text . '</h6>
								<p class="card-text"style="margin-bottom:5px;">Date : ' . $items->orderdate . '</p>
								<p class="card-text"style="margin-bottom:5px;">Order ID : ' . $items->id . '</p>
								
								</div>
							</div></a>
						</div>';
		}
		$output = array(
			"count" => count($order->result()),
			"data" => $data			
		);
		echo json_encode($output);
	}

	public function order_edit($id) {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['select_outlet'] = $this->outlet_model->get_order_by_name();
        $data['order_data'] = $this->order_master_model->get_by_id($id);
		$data['detail_data'] = $this->order_detail_model->get_by_id($id);
        $data['back_to'] = 'simin/dashboard';
        $data['active_menu'] = 1;
        $data['title'] = "ORDER DETAIL";
        $this->load->view('simin/order_detail_view', $data);
    }
}