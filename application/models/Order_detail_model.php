
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_detail_model extends CI_Model {
    
	var $table = 'order_detail';
    var $column_order = array('line'); //set column field database for datatable orderable
    var $column_search = array('name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('line' => 'desc'); // default order 	
    	
    function get_order_by_line() {	
        $this->db->where('outletid', $this->session->outletid);
        $this->db->where('propertyid', $this->session->propertyid);
        $this->db->order_by('line', 'DESC');
		$this->db->from($this->table);
		$result = $this->db->get();
        return $result;
    }

    function reload_order_by_line() {
        $this->db->where('outletid', $this->session->outletid);
		$this->db->where('propertyid', $this->session->propertyid);
		$this->db->from($this->table);
        $data = $this->db->get();
        return $data->result();
    }

    function save($id, $line, $menuid, $qty, $disc, $price, $note) {
        $data = array(
            'id' => $id,
            'line' => $line,
            'menuid' => $menuid,
            'qty' => $qty, 
            'disc' => $disc, 
            'price' => $price,
            'note' => $note            
        );
        $this->db->insert($this->table,$data);
    }

    function count_filtered() {     
        $this->db->where('outletid', $this->session->outletid);  
		$this->db->where('propertyid', $this->session->propertyid);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }
 
    public function count_all() {
        $this->db->where('outletid', $this->session->outletid);
		$this->db->where('propertyid', $this->session->propertyid);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    private function _get_datatables_query() {
        $this->db->select('order.*');
        $this->db->where('order.outletid', $this->session->outletid);
		$this->db->where('order.propertyid', $this->session->propertyid);
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
        $this->db->select('order_detail.*, menu.name');
        $this->db->where('order_detail.id', $id);
        $this->db->from($this->table);
        $this->db->join('menu','order_detail.menuid = menu.id','left');
        $this->db->order_by('order_detail.line', 'DESC');
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

    
}
