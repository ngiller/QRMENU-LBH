
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_detail_item_model extends CI_Model {
    
	var $table = 'order_detail_item';
    	
    function save($order_id, $detail_id, $menu_id, $sub_menu_id, $item_id, $price) {
        $data = array(
            'order_id' => $order_id,
            'detail_id' => $detail_id,
            'menu_id' => $menu_id,
            'sub_menu_id' => $sub_menu_id,
            'item_id' => $item_id, 
            'price' => $price          
        );
        $this->db->insert($this->table,$data);
    }   
    
    public function get_by_order($order_id, $line_id) {
        $this->db->select('order_detail_item.*, sub_menu.name as subname, sub_menu_item.name as itemname');
        $this->db->where('order_detail_item.order_id', $order_id);
        $this->db->where('order_detail_item.detail_id', $line_id);
        $this->db->from($this->table);
        $this->db->join('sub_menu','order_detail_item.sub_menu_id = sub_menu.id','left');
        $this->db->join('sub_menu_item','order_detail_item.item_id = sub_menu_item.id','left');
        $data = $this->db->get();
        return $data->result();   
    }

    public function delete_by_id($id) {		
        $this->db->delete($this->table, array("id" => $id));
    }

    public function update($where, $data) {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function has_item($order_id, $menu_id) {
        $this->db->where('order_id', $order_id);
        $this->db->where('menu_id', $menu_id);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    
}
