<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_cat_model extends CI_Model {
    
	var $table = 'menu_cat';
    var $column_order = array('mc1.code'); //set column field database for datatable orderable
    var $column_search = array('mc1.code', 'mc1.name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('mc1.code' => 'asc'); // default order 	
 
    function get_order_by_name() {	
        $this->db->select('*');
        $this->db->where('outletid', $this->session->outletid);
		$this->db->where('propertyid', $this->session->propertyid);
		$this->db->order_by('code', 'ASC');
		$this->db->from($this->table);
		$qry = $this->db->get();
        return $qry->result();
    }

    function reload_order_by_name() {        
        $this->db->select('menu_cat.*');
        $this->db->where('menu_cat.outletid', $this->session->outletid);
		$this->db->where('menu_cat.propertyid', $this->session->propertyid);
		$this->db->order_by('menu_cat.code', 'ASC');
		$this->db->from($this->table);
        $data = $this->db->get();
        return $data->result();
    }

    function set_master($id) {
        $data = array(
            'master' => 0
        );
        $this->menu_cat_model->update(array('id' => $id), $data);
    }

    function save($active, $code, $name, $sub_of, $master, $fb, $other_outlet, $image) {

        $data = array(
            'active' => $active,
            'code' => $code,
            'name' => $name,  
            'sub_of' => $sub_of,
            'master' => $master,
            'fb' => $fb, 
            'order_other_outlet' => $other_outlet,
            'image' => $image,
            'outletid' => $this->session->outletid,                    
            'propertyid' => $this->session->propertyid,
            'userfirst' => $this->session->id,
            'userlast' => $this->session->id,
            'datefirst' => date("Y/m/d h:i:sa"),
            'datelast' => date("Y/m/d h:i:sa")
        );
        $this->db->insert($this->table,$data);
        if ($sub_of != 0) {
            $this->set_master($sub_of);
        }
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
        $this->db->select('mc1.id, mc1.active, mc1.code, mc1.name, mc2.code AS subcode');
        $this->db->from('menu_cat mc1');
        $this->db->join('menu_cat mc2', 'mc1.sub_of=mc2.id', 'left');
        $this->db->where('mc1.outletid', $this->session->outletid);
        $this->db->where('mc1.propertyid', $this->session->propertyid);
    
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
		$query = $this->db->query("select r.*, u1.name as firstname, u2.name as lastname FROM menu_cat r LEFT JOIN users u1 ON r.userfirst = u1.id LEFT JOIN users u2 ON r.userlast = u2.id WHERE r.id=".$id); 		
        return $query->row();
    }	    
	

    public function delete_by_id($id) {		
        $this->db->delete($this->table, array("id" => $id));
    }

    public function update($where, $data) {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    function view_order_by_name() {	
        $this->db->select('menu_cat.*');
        $this->db->where('menu_cat.active', 0);
        $this->db->where('menu_cat.outletid', $this->session->outletid);
		$this->db->where('menu_cat.propertyid', $this->session->propertyid);
		$this->db->order_by('menu_cat.code', 'ASC');
		$this->db->from($this->table);
		$data = $this->db->get();
        return $data->result();
    }
    
    public function view_cat_master() {        
        $this->db->select('menu_cat.*');
        $this->db->where('menu_cat.active', 0);
        $this->db->where('menu_cat.sub_of', 0);
        $this->db->where('menu_cat.outletid', $this->session->outletid);
		$this->db->where('menu_cat.propertyid', $this->session->propertyid);
		$this->db->order_by('menu_cat.code', 'ASC');
		$this->db->from($this->table);
		$data = $this->db->get();
        return $data->result();
    }

    function get_order_by_catid($cid, $limit, $start) {	
        $this->db->select('menu_cat.code, menu_cat.name as catname, menu.*, menu_disc.disc as discpersen, menu_disc.active as discactive, menu_disc.date_start, menu_disc.date_end, menu_disc.time_start, menu_disc.time_stop, menu_disc.sun, menu_disc.mon, menu_disc.tue, menu_disc.wed, menu_disc.thu, menu_disc.fri, menu_disc.sat, menu_disc.allday');
        $this->db->where('menu_cat.id', $cid);
        $this->db->or_where('menu_cat.sub_of', $cid);
        $this->db->where('menu_cat.active', 0);
        $this->db->where('menu.active', 0);
        $this->db->where('menu.outletid', $this->session->outletid);
        $this->db->where('menu.propertyid', $this->session->propertyid);
        $this->db->join('menu', 'menu_cat.id=menu.categoryid', 'right');
        $this->db->join('menu_disc', 'menu.disc=menu_disc.id', 'left');
        $this->db->order_by('menu_cat.code', 'ASC');
        $this->db->order_by('menu.code', 'ASC');
        $this->db->from($this->table);
        $this->db->limit($limit, $start);
		$query = $this->db->get();
        return $query->result();
    }

    function get_all($limit, $start) {	
        $this->db->select('menu_cat.code as catcode, menu_cat.name as catname, menu_cat.sub_of, menu.*, menu_disc.disc as discpersen, menu_disc.active as discactive, menu_disc.date_start, menu_disc.date_end, menu_disc.time_start, menu_disc.time_stop, menu_disc.sun, menu_disc.mon, menu_disc.tue, menu_disc.wed, menu_disc.thu, menu_disc.fri, menu_disc.sat, menu_disc.allday');
        $this->db->where('menu_cat.active', 0);
        $this->db->where('menu_cat.outletid', $this->session->outletid);
        $this->db->where('menu_cat.propertyid', $this->session->propertyid);
        $this->db->join('menu', 'menu_cat.id=menu.categoryid', 'left');
        $this->db->join('menu_disc', 'menu.disc=menu_disc.id', 'left');
        $this->db->order_by('menu_cat.code', 'ASC');
        $this->db->from($this->table);
        $this->db->limit($limit, $start);
		$query = $this->db->get();
        return $query->result();
    }

    function count_by_category($cid) {
        $this->db->select('menu_cat.code, menu_cat.name as catname, menu.*, menu_disc.disc as discpersen, menu_disc.active as discactive, menu_disc.date_start, menu_disc.date_end, menu_disc.time_start, menu_disc.time_stop, menu_disc.sun, menu_disc.mon, menu_disc.tue, menu_disc.wed, menu_disc.thu, menu_disc.fri, menu_disc.sat, menu_disc.allday');
        $this->db->where('menu_cat.id', $cid);
        $this->db->or_where('menu_cat.sub_of', $cid);
        $this->db->where('menu_cat.active', 0);
        $this->db->where('menu.active', 0);
        $this->db->where('menu.outletid', $this->session->outletid);
        $this->db->where('menu.propertyid', $this->session->propertyid);
        $this->db->join('menu', 'menu_cat.id=menu.categoryid', 'right');
        $this->db->join('menu_disc', 'menu.disc=menu_disc.id', 'left');
        $this->db->from($this->table);
        $result = $this->db->count_all_results();
        return $result;
    }

    function count_all_menu() {
        $this->db->select('menu_cat.code, menu_cat.name as catname, menu.*, menu_disc.disc as discpersen, menu_disc.active as discactive, menu_disc.date_start, menu_disc.date_end, menu_disc.time_start, menu_disc.time_stop, menu_disc.sun, menu_disc.mon, menu_disc.tue, menu_disc.wed, menu_disc.thu, menu_disc.fri, menu_disc.sat, menu_disc.allday');
        $this->db->where('menu_cat.active', 0);
        $this->db->where('menu.active', 0);
        $this->db->where('menu.outletid', $this->session->outletid);
        $this->db->where('menu.propertyid', $this->session->propertyid);
        $this->db->join('menu', 'menu_cat.id=menu.categoryid', 'right');
        $this->db->join('menu_disc', 'menu.disc=menu_disc.id', 'left');
        $this->db->from($this->table);
        $result = $this->db->count_all_results();
        return $result;
    }

}
