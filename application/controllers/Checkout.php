<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('outletid') == "") {
            redirect(base_url("/scan_qr"));
        }

        $this->load->library('cart');
        $this->load->helper('email');
        $this->load->model('setting_model');
        $this->load->model('outlet_model');
        $this->load->model('order_detail_item_model');
        $this->load->model('order_detail_model');
        $this->load->model('order_master_model');
        $this->load->model('guest_model');
        $this->load->model('country_model');
        $this->load->model('menu_cat_model');
        $this->load->model('menu_model');
        $this->load->model('property_model');
        $this->load->model('order_print_model');
    }

    function index()
    {
        if ($this->cart->total_items() == 0) {
            redirect('/menu/category');
            exit;
        }
        $this->show_checkout_form();
    }

    function show_checkout_form($error_msg = '')
    {
        $data['country_data'] = $this->country_model->get_order_by_name();
        if (!empty($this->session->guestid)) {
            $data['guest_data'] = $this->guest_model->get_by_id($this->session->guestid); //echo $this->session->guestid; exit;
        } else {
            $data['guest_data'] = "";
        }
        $data['menucat_list'] = $this->menu_cat_model->view_cat_master();
        $data['nav_index'] = 0;
        $data['menucatid'] = -1;
        $data['tax'] = $this->setting_model->get_setting_value('tax', $this->session->propertyid);
        $data['service'] = $this->setting_model->get_setting_value('service', $this->session->propertyid);
        $data['error_msg'] = $error_msg;
        
        $this->load->view($this->session->template_folder.'/checkout_view', $data);
    }

    function save()
    {
        $data = $this->_validate();
        if ($data['status'] == FALSE) {
            redirect('/checkout');
            exit;
        }

        $pax = xssclean($this->input->post('pax'));
        if ($pax == '') {
            $pax = 0;
        }
        $email = xssclean($this->input->post('email'));
        $name = xssclean($this->input->post('name'));
        $phone = xssclean($this->input->post('phone'));
        $country = xssclean($this->input->post('country'));
        $roomno = xssclean($this->input->post('roomno'));
        $note = xssclean($this->input->post('note'));
        $payment = xssclean($this->input->post('payment'));
        $subtotal = $this->cart->total();
        $disc = 0;
        $tax = $this->setting_model->get_setting_value('tax', $this->session->propertyid);
        $service = $this->setting_model->get_setting_value('service', $this->session->propertyid);
        $total = $subtotal + (($subtotal * $tax->value) / 100) + (($subtotal * $service->value) / 100);

        if ($note == "Note") {
            $note = "";
        }

        if ($this->guest_model->is_email($email) == "TRUE") {
            $data = array(
                'name' => $name,
                'phone' => $phone,
                'country' => $country
            );
            $this->guest_model->update(array('email' => $email), $data);
            $guest = $this->guest_model->get_by_email($email, $this->session->propertyid);
        } else {
            $this->guest_model->save($email, $name, $phone, $country);
            $guest = $this->guest_model->get_by_email($email, $this->session->propertyid);
        }

        //---- check stock if limited---------------------------------
        $error_msg = '';
        foreach ($this->cart->contents() as $item) {
            $menu = $this->menu_model->get_by_id($item['id']);
            if ($menu->limited_stock == 0 and $menu->stock <= 0) {
                $error_msg .= 'Sorry, ' . $menu->name . ' no longer available<br>';
            }
        }

        //------------- if no stock error message--------------------------------
        if ($error_msg == '') {
            $num = $this->order_master_model->get_max_id() + 1;
            if (strlen($num) >= 12) {
                $num = substr($num, -4);
            } else {
                $num = substr("0000{$num}", -4);
            }
            $outlet = $this->outlet_model->get_by_id($this->session->outletid);
            $property = $this->property_model->get_by_id($this->session->propertyid);
            $order_id = $property->code.$outlet->code . date('y') . date('m') . $num;

            $this->order_master_model->save($order_id, $this->session->tableno, $pax, $guest->id, $roomno, $note, $subtotal, $payment, $disc, $tax->value, $service->value, $total);

            $line = 1;
            foreach ($this->cart->contents() as $item) {
                $this->order_detail_model->save($order_id, $line, $item['id'], $item['qty'], 0, $item['price'], $item['note']);

                //------------if any sub menu-------------------------------------
                if ($this->cart->has_options($item['rowid'])) {
                    foreach ($this->cart->product_options($item['rowid']) as $options) {
                        $this->order_detail_item_model->save($order_id, $line, $item['id'], $options[0], $options[2], $options[4]);
                    }
                }

                //---- if limited stock, reduce stock----------------------------
                $menu = $this->menu_model->get_by_id($item['id']);
                if ($menu->limited_stock == 0 and $menu->stock > 0) {
                    $data = array(
                        'stock' => $menu->stock - 1
                    );
                    $this->menu_model->update(array('id' => $menu->id), $data);
                }

                ++$line;
            }

            $this->order_print_model->save($order_id, $this->session->outletid, $this->session->propertyid);

            $this->session->orderid = $order_id;
            $this->session->guestid = $guest->id;
            $this->session->pax = $pax;
            $this->session->payment = $payment;

            $this->cart->destroy();

            redirect('/checkout/finish');
        } else {
        //---------------------If any error----------------------------------------------------
            $data['country_data'] = $this->country_model->get_order_by_name();
            if (!empty($this->session->guestid)) {
                $data['guest_data'] = $this->guest_model->get_by_id($this->session->guestid);
            } else {
                $data['guest_data'] = "";
            }
            $data['menucat_list'] = $this->menu_cat_model->view_cat_master();
            $data['nav_index'] = 0;
            $data['menucatid'] = -1;
            $data['tax'] = $this->setting_model->get_setting_value('tax', $this->session->propertyid);
            $data['service'] = $this->setting_model->get_setting_value('service', $this->session->propertyid);
            $data['error_msg'] = $error_msg;
            $this->load->view($this->session->template_folder.'/checkout_view', $data);
        }
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

        /*if ($this->input->post('pax') == '') {
            $data['inputerror'][] = 'pax';
            $data['error_string'][] = 'Pax is required';
            $data['status'] = FALSE;
        }*/

        if ($this->input->post('phone') == '') {
            $data['inputerror'][] = 'phone';
            $data['error_string'][] = 'Phone is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('country') == '') {
            $data['inputerror'][] = 'country';
            $data['error_string'][] = 'Country is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('payment') == '' and $this->cart->total() > 0) {
            $data['inputerror'][] = 'payment';
            $data['error_string'][] = 'Payment is required';
            $data['status'] = FALSE;
        }

        /*if($data['status'] === FALSE) {
          echo json_encode($data);
          exit();
        }*/

        return $data;
    }

    public function find_guest()
    {
        $email = xssclean($this->input->post('email'));
        $guest = $this->guest_model->get_by_email($email, $this->session->propertyid);

        echo json_encode($guest);
    }

    public function finish()
    {
        if (empty($this->session->orderid)) {
            redirect('/menu/category');
            exit;
        }

        $data['nav_index'] = 0;
        $data['menucatid'] = -1;
        $data['menucat_list'] = $this->menu_cat_model->view_cat_master();
        $data['order_master'] = $this->order_master_model->get_by_id($this->session->orderid);
        $data['order_detail'] = $this->order_detail_model->get_by_id($this->session->orderid);
        $data['tax_data'] = $this->setting_model->get_setting_value('tax', $this->session->propertyid);
        $data['service_data'] = $this->setting_model->get_setting_value('service', $this->session->propertyid);
        
        $this->load->view($this->session->template_folder.'/finish_view', $data);
    }

    public function cancel($order_id)
    {
        if (empty($order_id)) {
            redirect('/menu/category');
            exit;
        }
        //---------------GET ORDER STATUS----------------------------------
        $status = $this->order_master_model->get_status($order_id);
        if ($status <> 1) { //---- if statis not confirm----------------------
            //--------------UPDATE STATUS--------------------------------------
            $data = array(
                'status' => 2
            );
            $this->order_master_model->update(array('id' => $order_id), $data);

            $data['nav_index'] = 0;
            $data['menucatid'] = -1;
            $data['menucat_list'] = $this->menu_cat_model->view_cat_master();
            $data['order_master'] = $this->order_master_model->get_by_id($order_id);
            $data['order_detail'] = $this->order_detail_model->get_by_id($order_id);
            $data['tax_data'] = $this->setting_model->get_setting_value('tax', $this->session->propertyid);
            $data['service_data'] = $this->setting_model->get_setting_value('service', $this->session->propertyid);
            $this->load->view($this->session->template_folder.'/cancel_order_view', $data);
        } else {
            $data['nav_index'] = 3;
            $data['menucatid'] = -1;
            $data['menucat_list'] = $this->menu_cat_model->view_cat_master();
            $data['order_master'] = $this->order_master_model->get_by_id($order_id);
            $data['order_detail'] = $this->order_detail_model->get_by_id($order_id);
            $data['error_msg'] = 'Your order already confirm or cancel';
            $this->load->view($this->session->template_folder.'/history_detail_view', $data);
        }
    }
}
