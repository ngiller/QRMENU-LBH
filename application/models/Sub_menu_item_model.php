
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_menu_item_model extends CI_Model {
    
	var $table = 'sub_menu_item';
    var $column_order = array('position', 'name'); //set column field database for datatable orderable
    var $column_search = array('name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('position' => 'asc'); // default order 	
    	
    
    function get_order_by_pos($submenuid) {	
        $this->db->where('submenuid', $submenuid);
        $this->db->order_by('position', 'ASC');
		$this->db->from($this->table);
		$result = $this->db->get();
        return $result;
    }

    function reload_order_by_pos($submenuid) {
        $this->db->where('submenuid', $submenuid);
		$this->db->from($this->table);
        $data = $this->db->get();
        return $data->result();
    }

    function save($submenuid, $active, $pos, $name, $price) {
        $data = array(
            'submenuid' => $submenuid,
            'active' => $active,
            'position' => $pos,
            'name' => $name,
            'price' => $price,  
            'userfirst' => $this->session->id,
            'userlast' => $this->session->id,
            'datefirst' => date("Y/m/d h:i:sa"),
            'datelast' => date("Y/m/d h:i:sa")
        );
        $this->db->insert($this->table,$data);
    }

    function count_filtered($submenuid) { 
        $this->db->where('submenuid', $submenuid);    
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }
 
    public function count_all($submenuid) {
        $this->db->where('submenuid', $submenuid);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    private function _get_datatables_query($submenuid) {
        $this->db->where('submenuid', $submenuid);
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

    function get_datatables($submenuid) {
        $this->_get_datatables_query($submenuid);
        if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();
        return $query->result();
    }

	public function get_by_id($id) {    
        $query = $this->db->query("select e.*, u1.name as firstname, u2.name as lastname FROM sub_menu_item e LEFT JOIN users u1 ON e.userfirst = u1.id LEFT JOIN users u2 ON e.userlast = u2.id WHERE e.id=".$id); 		
        return $query->row();
    }	
    
    public function view_by_submenuid($submenuid) {
        $submenuid = xssclean($submenuid);
        $this->db->where('submenuid', $submenuid);
        $this->db->where('active', 0);
        $this->db->order_by('position', 'ASC');
        $this->db->from($this->table);
		$result = $this->db->get();
        return $result->result();
    }

    public function delete_by_id($id) {		
        $this->db->delete($this->table, array("id" => $id));
    }

    public function update($where, $data) {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

}
