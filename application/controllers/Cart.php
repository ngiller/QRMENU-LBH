<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cart extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('outletid') == "") {
            redirect(base_url("/scan_qr"));
        }

        $this->load->library('cart');
        $this->load->model('property_model');
        $this->load->model('outlet_model');
        $this->load->model('menu_cat_model');
        $this->load->model('menu_model');
        $this->load->model('sub_menu_model');
        $this->load->model('sub_menu_item_model');
        $this->load->model('setting_model');
    }

    /*function _remap($cid) {
        $this->index($cid);
    }*/

    function index()
    {
        $data['nav_index'] = 0;
        $data['menucatid'] = -1;
        $data['menucat_list'] = $this->menu_cat_model->view_cat_master();
        $data['tax'] = $this->setting_model->get_setting_value('tax', $this->session->propertyid);
        $data['service'] = $this->setting_model->get_setting_value('service', $this->session->propertyid);
        $this->load->view($this->session->template_folder.'/cart_view', $data);
    }

    function show()
    {
        $data['menucat_list'] = $this->menu_cat_model->view_cat_master();
        $data['tax'] = $this->setting_model->get_setting_value('tax', $this->session->propertyid);
        $data['service'] = $this->setting_model->get_setting_value('service', $this->session->propertyid);
        
        $this->load->view($this->session->template_folder.'/cart_view', $data);
    }

    function add()
    {
        //$this->cart->destroy();
        $id = $this->security->xss_clean($this->input->post('menuid'));
        $qty = $this->security->xss_clean($this->input->post('quantity'));
        $note = $this->security->xss_clean($this->input->post('note'));
        $menu = $this->menu_model->view_by_id($id);
        $options = array();
        $submenu = $this->sub_menu_model->view_by_menuid($id);
        $add_price = 0;
        if (count($submenu) > 0) {
            foreach ($submenu as $smenu) {
                if (isset($_POST['sl_' . $smenu->id])) {
                    $itemid = $this->security->xss_clean($this->input->post('sl_' . $smenu->id));
                    $items = $this->sub_menu_item_model->get_by_id($itemid);
                    $item_name = $items->name;
                    $item_price = $items->price;
                } else {
                    $itemid = '';
                    $item_name = '';
                    $item_price = 0;
                }
                $options[] =  array($smenu->id, $smenu->name, $itemid, $item_name, $item_price);
                $add_price = $add_price + $item_price;
            }
        }
        $line = $this->cart->total_items();
        $data = array(
            'line'    => $line + 1,
            'id'      => $id,
            'item_price' => $menu->price,
            'price'   => $menu->price - ($menu->price * $menu->discpersen / 100) + $add_price,
            'name'    => '-',
            'qty'     => $qty,
            'disc'    => $menu->discpersen,
            'image'   => $menu->image,
            'note'    => $note,
            'options' => $options
        );
        
        $this->cart->insert($data); 
        redirect(site_url('cart'));
    }

    function update($rowid, $qty)
    {
        $rowid = $this->security->xss_clean($rowid);
        $qty = $this->security->xss_clean($qty);
        $data = array(
            'rowid' => $rowid,
            'qty'   => $qty
        );

        $this->cart->update($data);
        echo json_encode($this->cart->get_item($rowid));
    }

    function note_update($rowid, $note = "")
    {
        $rowid = $this->security->xss_clean($rowid);
        $note = $this->security->xss_clean($note);
        $data = array(
            'rowid' => $rowid,
            'note'   => $note
        );
        $this->cart->update($data);
        echo json_encode($this->cart->total());
    }

    function show_total()
    {
        echo json_encode($this->cart->total());
    }

    function remove($rowid)
    {
        $rowid = $this->security->xss_clean($rowid);
        $this->cart->remove($rowid);

        echo json_encode($this->cart->total());
    }

    function options_update($rowid, $submenuid, $itemid)
    {
        $newopt = array();
        $price = 0;
        $add_price = 0;

        $cart_item = $this->cart->get_item($rowid);
        if (count($cart_item['options']) > 0) {
            foreach ($cart_item['options'] as $opitem) {
                if ($opitem[0] == $submenuid) {
                    $subitem = $this->sub_menu_item_model->get_by_id($itemid);
                    $newopt[] = array($opitem[0], $opitem[1], $itemid, $subitem->name, $subitem->price);
                    $add_price = $add_price + $subitem->price;
                } else {
                    $newopt[] = array($opitem[0], $opitem[1], $opitem[2], $opitem[3], $opitem[4]);
                    $add_price = $add_price + $opitem[4];
                }
            }
            $data = array(
                'rowid' => $rowid,
                'price' => $cart_item['item_price'] - ($cart_item['item_price'] * $cart_item['disc'] / 100) + $add_price,
                'options' => $newopt
            );
            $this->cart->update($data);
        }
        echo json_encode($this->cart->get_item($rowid));
    }

    function get_cart()
    {
        echo json_encode($this->cart->contents());
    }
}
