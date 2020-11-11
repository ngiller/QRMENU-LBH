<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_cat_model extends CI_Model {
    
	var $table = 'menu_cat';
    var $column_order = array('name'); //set column field database for datatable orderable
    var $column_search = array('menu_cat.name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('menu_cat.name' => 'asc'); // default order 	
    
		
 
    function get_order_by_name($sub_of) {	
        $this->db->select('*');
        $this->db->where('sub_of', $sub_of);
        $this->db->where('outletid', $this->session->outletid);
		$this->db->where('propertyid', $this->session->propertyid);
		$this->db->order_by('position', 'ASC');
		$this->db->from($this->table);
		$qry = $this->db->get();
        return $qry->result();
    }

    function reload_order_by_name($sub_of) {        
        $this->db->select('menu_cat.*');
        $this->db->where('menu_cat.sub_of', $sub_of);
        $this->db->where('menu_cat.outletid', $this->session->outletid);
		$this->db->where('menu_cat.propertyid', $this->session->propertyid);
		$this->db->order_by('menu_cat.position', 'ASC');
		$this->db->from($this->table);
        $data = $this->db->get();
        return $data->result();
    }

    function save($active, $pos, $name, $sub_of, $master, $fb, $image) {
        $data = array(
            'active' => $active,
            'position' => $pos,
            'name' => $name,  
            'sub_of' => $sub_of,
            'master' => $master,
            'fb' => $fb, 
            'image' => $image,
            'outletid' => $this->session->outletid,                    
            'propertyid' => $this->session->propertyid,
            'userfirst' => $this->session->id,
            'userlast' => $this->session->id,
            'datefirst' => date("Y/m/d h:i:sa"),
            'datelast' => date("Y/m/d h:i:sa")
        );
        $this->db->insert($this->table,$data);
    }

    function count_filtered($sub_of) {       
        $this->db->where('sub_of', $sub_of);
        $this->db->where('outletid', $this->session->outletid);
		$this->db->where('propertyid', $this->session->propertyid);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }
 
    public function count_all($sub_of) {
        $this->db->where('sub_of', $sub_of);
        $this->db->where('outletid', $this->session->outletid);
		$this->db->where('propertyid', $this->session->propertyid);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    private function _get_datatables_query($sub_of) {
		
        $this->db->select('menu_cat.*');
        $this->db->where('menu_cat.sub_of', $sub_of);
        $this->db->where('menu_cat.outletid', $this->session->outletid);
		$this->db->where('menu_cat.propertyid', $this->session->propertyid);
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

    function get_datatables($sub_of) {
        $this->_get_datatables_query($sub_of);
        if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();
        return $query->result();
    }

	public function get_by_id($id) {    
		$query = $this->db->query("select r.*, u1.name as firstname, u2.name as lastname FROM menu_cat r LEFT JOIN users u1 ON r.userfirst = u1.id LEFT JOIN users u2 ON r.userlast = u2.id WHERE r.master=0 AND r.id=".$id); 		
        return $query->row();
    }	    
	

    public function delete_by_id($id) {		
        $this->db->delete($this->table, array("id" => $id));
    }

    public function update($where, $data) {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    function view_order_by_name($sub_of) {	
        $this->db->select('menu_cat.*');
        $this->db->where('menu_cat.active', 0);
        $this->db->where('menucat.sub_of', $sub_of);
        $this->db->where('menu_cat.outletid', $this->session->outletid);
		$this->db->where('menu_cat.propertyid', $this->session->propertyid);
		$this->db->order_by('menu_cat.position', 'ASC');
		$this->db->from($this->table);
		$data = $this->db->get();
        return $data->result();
    }

}
