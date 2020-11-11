
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Whatson_model extends CI_Model {
    
	var $table = 'whatson';
    var $column_order = array('position'); //set column field database for datatable orderable
    var $column_search = array('title'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('position' => 'asc'); // default order 	
    	
    function get_order_by_pos() {	
        $this->db->where('active', 0);
        $this->db->where('propertyid', $this->session->propertyid);
        $this->db->order_by('position', 'ASC');
		$this->db->from($this->table);
		$result = $this->db->get();
        return $result;
    }

    function reload_order_by_pos() {
        $this->db->where('propertyid', $this->session->propertyid);
        $this->db->order_by('position', 'ASC');
		$this->db->from($this->table);
        $data = $this->db->get();
        return $data->result();
    }

    function save($active, $pos, $onhome, $title, $page_link, $short_desc, $desc, $homeimage, $topimage, $link, $link_to_url) {
        
        $data = array(
            'active'=> $active, 
            'position'=> $pos,            
            'title' => $title, 
            'page_link' => $page_link, 
            'short_desc' => $short_desc,
            'descriptions' => $desc,             
            'topimage' => $topimage,
            'showonhome'=> $onhome, 
            'homeimage' => $homeimage,
            'link' => $link,   
            'link_to_url' => $link_to_url,       
            'propertyid' => $this->session->propertyid,
            'userfirst' => $this->session->id,
            'userlast' => $this->session->id,
            'datefirst' => date("Y/m/d h:i:sa"),
            'datelast' => date("Y/m/d h:i:sa")
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
        $this->db->select('whatson.*, users.name AS username');
        $this->db->join('users', 'whatson.userlast = users.id', 'left');     
        $this->db->where('whatson.propertyid', $this->session->propertyid);
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
		$query = $this->db->query("select p.*, u1.name as firstname, u2.name as lastname FROM whatson p LEFT JOIN users u1 ON p.userfirst = u1.id LEFT JOIN users u2 ON p.userlast = u2.id WHERE p.id=".$id); 		
        return $query->row();
    }	
    
    public function get_data_by_link($link) {    
		$this->db->where('link', $link);
        $query = $this->db->get($this->table);
        return $query->row();
    }
    
    public function get_by_title($title) {

		$this->db->where('title', $title);
		$this->db->where('propertyid', $this->session->propertyid);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }    
    }
    
    public function get_by_link($link) {
        $this->db->where('link', $link);
		$this->db->where('propertyid', $this->session->propertyid);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        } 
    }

    public function delete_by_id($id) {		
        $this->db->delete($this->table, array("id" => $id));
    }

    public function update($where, $data) { 
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function get_next_pos() {
        $this->db->select_max('position', 'max');
        $this->db->where('propertyid', $this->session->propertyid);
        $result = $this->db->get($this->table);
        $row = $result->row_array();
        $next_pos = isset($row['max']) ? ($row['max']+1) : 1;
        return $next_pos;    
    }

    public function get_data_with_link() {
        $this->db->select('whatson.*, pages.title as ptitle, pages.link as linkname');
        $this->db->join('pages', 'whatson.page_link=pages.id', 'left');
        $this->db->where('whatson.active', 0);
        $this->db->where('whatson.showonhome', 0);
        $this->db->order_by('whatson.position', 'ASC');
        $qry = $this->db->get($this->table);
        return $qry->result();
    } 
    public function show_whatson() {
        $query = $this->db->query("select w.*, 'whatson' AS subtitle, w.link as linkname FROM whatson w WHERE w.active=0 ORDER BY w.position"); 		
        $data = $query->result(); 
        //echo json_encode($data); exit;
        return $data;
    }
}
