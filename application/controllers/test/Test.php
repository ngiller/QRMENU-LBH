<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('order_print_model');
        $this->load->model('order_master_model');
        $this->load->model('order_detail_model');
        $this->load->model('order_detail_item_model');
        
    }

    public function gettest() {
        //$oid = $this->input->post('outletid');
        //$pid = $this->input->post('propertyid');
        $data = $this->order_print_model->get_print(1, 1);
        $print = array();
        foreach ($data as $item) {
            $order = $this->order_master_model->get_by_id($item->order_id);
            $master['orderid'] = $order->id;
            $master['orderdate'] = $order->orderdate;
            $master['table_num'] = $order->table_num;
            $master['pax'] = $order->pax;
            $master['note'] = $order->note;
            $master['subtotal'] = $order->subtotal;
            $master['disc'] = $order->disc;
            $master['tax'] = $order->tax;
            $master['service'] = $order->service;
            $master['total'] = $order->total;
            $master['payment'] = $order->payment;
            $master['status'] = $order->status;
            $master['email'] = $order->email;
            $master['guestname'] = $order->guestname;
            $master['countryname'] = $order->countryname;
            $master['phone'] = $order->phone;

            $order_detail = $this->order_detail_model->get_by_id($order->id);
            $detail = array();
            foreach ($order_detail as $itemdetail) {
                $detailitem['line'] = $itemdetail->line;
                $detailitem['menuid'] = $itemdetail->menuid;
                $detailitem['name'] = $itemdetail->name;
                $detailitem['qty'] = $itemdetail->qty;
                $detailitem['price'] = $itemdetail->price;
                $detailitem['disc'] = $itemdetail->disc;
                
                $subdetail = array();
                if ($this->order_detail_item_model->has_item($order->id, $itemdetail->menuid) > 0) {
                    $subdetail = $this->order_detail_item_model->get_by_order($order->id, $itemdetail->line);
                    //$subdetail[] = $subdetailitem;
                } else {
                    $subdetail[] = null;
                }
                $detailitem['subdetail'] = $subdetail;

                $detail[] = $detailitem;
            }

            $master['detail'] = $detail;
            $print[] = $master;
        }

        $dt = array(
            'data' => $print
        );
        echo json_encode($dt);
    }

}