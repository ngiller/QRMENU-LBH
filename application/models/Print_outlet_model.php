
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Print_outlet_model extends CI_Model {
    
	var $table = 'outlet';
    	
    function show_outlet() {	
        $this->db->where('propertyid', $this->session->print_property_id);
        $this->db->where('active', 0);
        $this->db->order_by('name', 'ASC');
		$this->db->from($this->table);
		$result = $this->db->get();
        return $result;
    }

    public function get_by_id($outlet_id) {
		$this->db->where('id', $outlet_id);
		$this->db->where('propertyid', $this->session->print_property_id);
        $query = $this->db->get($this->table);
        return $query->row();
    }
}
