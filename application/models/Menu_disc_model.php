
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_disc_model extends CI_Model {
    
	var $table = 'menu_disc';
    var $column_order = array('name'); //set column field database for datatable orderable
    var $column_search = array('menu_disc.name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('menu_disc.name' => 'asc'); // default order 	
    
		
 
    function get_order_by_name() {	
        $this->db->select('menu_disc.*');
        $this->db->where('menu_disc.outletid', $this->session->outletid);
		$this->db->where('menu_disc.propertyid', $this->session->propertyid);
		$this->db->order_by('menu_disc.name', 'ASC');
		$this->db->from($this->table);
		$data = $this->db->get();
        return $data->result();
    }

    function reload_order_by_name() {
        
        $this->db->select('menu_disc.*');
        $this->db->where('menu_disc.outletid', $this->session->outletid);
		$this->db->where('menu_disc.propertyid', $this->session->propertyid);
		$this->db->order_by('menu_disc.name', 'ASC');
		$this->db->from($this->table);
        $data = $this->db->get();
        return $data->result();
    }

    function save($active, $code, $name, $disc, $startdate, $enddate, $starttime, $endtime, $allday, $sun, $mon, $tue, $wed, $thu, $fri, $sat) {
        $data = array(
            'active' => $active,
            'code' => $code,
            'name' => $name,
            'disc' => $disc,
            'date_start' => $startdate, 
            'date_end' => $enddate,
            'time_start' => $starttime, 
            'time_stop' => $endtime,
            'allday' => $allday, 
            'sun' => $sun,
            'mon' => $mon, 
            'tue' => $tue,
            'wed' => $wed, 
            'thu' => $thu, 
            'fri' => $fri,
            'sat' => $sat,
            'outletid' => $this->session->outletid,                    
            'propertyid' => $this->session->propertyid,
            'userfirst' => $this->session->id,
            'userlast' => $this->session->id,
            'datefirst' => date("Y/m/d h:i:sa"),
            'datelast' => date("Y/m/d h:i:sa")
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
		
        $this->db->select('menu_disc.*');
        $this->db->where('menu_disc.outletid', $this->session->outletid);
		$this->db->where('menu_disc.propertyid', $this->session->propertyid);
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
		$query = $this->db->query("select r.*, u1.name as firstname, u2.name as lastname FROM menu_disc r LEFT JOIN users u1 ON r.userfirst = u1.id LEFT JOIN users u2 ON r.userlast = u2.id WHERE r.id=".$id); 		
        return $query->row();
    }	    
	

    public function delete_by_id($id) {		
        $this->db->delete($this->table, array("id" => $id));
    }

    public function update($where, $data) {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function get_by_code($code) {
        $this->db->where('code', $code);
        $this->db->where('outletid', $this->session->outletid);
		$this->db->where('propertyid', $this->session->propertyid);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }    
    }

    public function get_by_name($name) {
        $this->db->where('name', $name);
        $this->db->where('outletid', $this->session->outletid);
        $this->db->where('propertyid', $this->session->propertyid);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    
    }
}
