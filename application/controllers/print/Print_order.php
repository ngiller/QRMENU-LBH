<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Print_order extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if($this->session->userdata('print_status') != "login"){
        	redirect(base_url("print/signin"));
        }

        $this->load->model('setting_model');
        $this->load->model('property_model');
        $this->load->model('print_outlet_model');
        $this->load->model('order_master_model');
        $this->load->model('order_detail_model');
        $this->load->model('order_detail_item_model');
        $this->load->model('order_print_model');
    }

    function str_center($str, $length)
    {
        $add_space = floor(($length - strlen($str)) / 2);
        $space = "";
        for ($i = 0; $i < $add_space; $i++) {
            $space = $space . " ";
        }
        return ($space . $str);
    }

    function text_right($str, $length)
    {
        $add_space = ($length - strlen($str));
        $space = "";
        for ($i = 0; $i < $add_space; $i++) {
            $space = $space . " ";
        }
        return ($space . $str);
    }

    function text_price($str)
    {
        $str = number_format($str, 0, ".", ",");
        $add_space = (15 - strlen($str));
        $space = "";
        for ($i = 0; $i < $add_space; $i++) {
            $space = $space . " ";
        }
        return ($space . "Rp. " . $str);
    }

    function print_id($id)
    {
        $id = xssclean($id);
        $order = $this->order_master_model->get_by_id($id);
         
        $text_length = 42; //---------- LEBAR KERTAS-------------------------------

        $text_print = "";
        $text_print .= $this->str_center($this->session->print_outlet_name, $text_length) . "\n";
        $text_print .= "------------------------------------------\n";
        $text_print .= $this->str_center("Order# : " . $order->id, $text_length) . "\n";
        $text_print .= "\n";
        $text_print .= "Table : " . $order->table_num . "\n";
        $text_print .= "Date  : " . $order->orderdate . "\n";
        $text_print .= substr("Guest : " . $order->guestname, 0, $text_length) . "\n";
        $text_print .= "------------------------------------------\n";

        $detail = $this->order_detail_model->get_by_id($id);
        $sub_total = 0;
        foreach ($detail as $item) {
            $text_print .= $item->name . "\n";

            if ($this->order_detail_item_model->has_item($order->id, $item->menuid) > 0) {
                $submenu = $this->order_detail_item_model->get_by_order($order->id, $item->line);
                foreach ($submenu as $subitem) {
                    $text_print .=  "  > " . $subitem->itemname;
                    if ($subitem->price > 0) {
                        $text_print .=  " Rp. " . number_format($subitem->price,0,",",".") . "\n";
                    } else {
                        $text_print .=  "\n";
                    }
                }
            }

            if ($item->note <> "") {
                $text_print .= $item->note . "\n";
            }
            $text_print .= $this->text_right($item->qty . " X Rp. " . number_format($item->price, 0, ".", ","), $text_length) . "\n";
            $sub_total += $item->price * $item->qty;
        }
        $total = $sub_total + ($sub_total * $order->tax / 100) + ($sub_total * $order->service / 100);
        $text_print .= "------------------------------------------\n";
        $text_print .=  $this->text_right("Subtotal : " . $this->text_price($sub_total), $text_length) . "\n";
        //$text_print .=  $this->text_right("Tax " . number_format($order->tax, 0, ".", ",") . " % : " . $this->text_price($sub_total * $order->tax / 100), $text_length) . "\n";
        //$text_print .=  $this->text_right("Serv. " . number_format($order->service, 0, ".", ",") . " % : " . $this->text_price($sub_total * $order->service / 100), $text_length) . "\n";
        $text_print .=  $this->text_right("Service : " . $this->text_price($sub_total * $order->service / 100), $text_length) . "\n";
        $text_print .=  $this->text_right("G.Tax : " . $this->text_price($sub_total * $order->tax / 100), $text_length) . "\n";
        $text_print .= "------------------------------------------\n";
        $text_print .=  $this->text_right("Total  : " . $this->text_price($total), $text_length) . "\n";
        if ($order->note != '') {
            $text_print .= "\n";
            $text_print .= "Order note :" . "\n";
            $text_print .= $order->note . "\n";
        }

        //--------print 2X for thermal printer---------------------
        //$text_print .= "\n\n\n".$text_print;

        return ($text_print);
    }

    public function list_order()
    {
        $order_id = array();
        $print = $this->order_print_model->get_print($this->session->print_outlet_id, $this->session->print_property_id);
        
        $text_print = "";
        foreach ($print as $item) {
            $text_print .= $this->print_id($item->order_id) . "\n\n\n\n\n";
            $order_id[] = $item->order_id;
        }
        $data = array(
            "status" => TRUE,
            "order_id" => $order_id,
            "text_print" => $text_print
        );
        echo json_encode($data);
    }

    public function set_already_print($order_id)
    {
        $id = xssclean($order_id);
        $this->order_print_model->delete_by_id($order_id);
    }

    public function id($id) {
        $id = xssclean($id);
        $text_print = "";
        $text_print .= $this->print_id($id) . "\n\n\n\n";
        $this->set_already_print($id);
        echo json_encode($text_print);
    }
}
