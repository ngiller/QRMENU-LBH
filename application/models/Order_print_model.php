<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_print_model extends CI_Model {
    
	var $table = 'order_print';

    function save($order_id, $outletid, $propertyid) {

        $data = array(
            'order_id' => $order_id,
            'outlet_id' => $outletid,                    
            'property_id' => $propertyid
        );
        $this->db->insert($this->table,$data);
    }

    function count_filtered($outletid, $propertyid) {       
        $this->db->where('outletid', $outletid);
		$this->db->where('propertyid', $propertyid);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

	public function get_print($outletid, $propertyid) {    
        $this->db->where('outlet_id', $outletid);
		$this->db->where('property_id', $propertyid);
        $query = $this->db->get($this->table);
        return $query->result();
    }	    
	
    public function delete_by_id($order_id) {		
        $this->db->delete($this->table, array("order_id" => $order_id));
    }
}
