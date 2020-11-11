
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Country_model extends CI_Model {
    
	var $table = 'country';
    var $column_order = array('iso','name'); //set column field database for datatable orderable
    var $column_search = array('iso','name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('iso' => 'asc'); // default order 	
    	
    function get_order_by_name() {	
        $this->db->order_by('name', 'ASC');
		$this->db->from($this->table);
		$data = $this->db->get();
        return $data->result();
    }

    function reload_order_by_name() {
        $this->db->from($this->table);
        $this->db->order_by('name', 'ASC');
        $data = $this->db->get();
        return $data->result();
    }

    function save($code, $name, $phonecode) {
        $data = array(
            'iso' => $code,  
            'name' => $name,    
            'phonecode' => $phonecode
        );
        $this->db->insert($this->table,$data);
    }

    function count_filtered() {       
		$this->db->where('propertyid', $this->session->propertyid);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }
 
    public function count_all() {
		$this->db->where('propertyid', $this->session->propertyid);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    private function _get_datatables_query() {
		$this->db->where('propertyid', $this->session->propertyid);
		$this->db->from($this->table);
    
        $i = 0;
        
        foreach ($this->column_search as $item) {
            if($_POST['search']['value']) {                    
                if($i===0) {
                    $this->db->group_start(); 
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
    
                if(count($this->column_search) - 1 == $i) 
                    $this->db->group_end();
            }
            $i++;
        }
         
        if(isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables() {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();
        return $query->result();
    }

	public function get_by_id($id) {    
		$this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row(); 
    }	  
    
    public function get_by_code($code) {

		$this->db->where('iso', $code);
        $query = $this->db->get($this->table);
        return $query->row(); 
	}

    public function delete_by_id($id) {		
        $this->db->delete($this->table, array("id" => $id));
    }

    public function update($where, $data) {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
}
