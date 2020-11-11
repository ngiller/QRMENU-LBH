
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_images_model extends CI_Model {
    
	var $table = 'menu_images';
    var $column_order = array('position'); //set column field database for datatable orderable
    var $column_search = array('position'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('position' => 'asc'); // default order 	
    	
    function get_order_by_pos($menuid) {	
        $this->db->where('menuid', $menuid);
        $this->db->order_by('position', 'ASC');
		$this->db->from($this->table);
		$data = $this->db->get();
        return $data->result();
    }

    function reload_order_by_pos() {
        $this->db->where('active', 0);
        $this->db->from($this->table);
        $this->db->order_by('position', 'ASC');
        $data = $this->db->get();
        return $data->result();
    }

    function save($menuid, $active, $pos, $image) {
        $data = array(
            'active'=> $active,
            'menuid' => $menuid,
            'position' => $pos,             
            'image' => $image
        );
        $this->db->insert($this->table,$data);
    }

    function count_filtered($menuid) {       
		$this->db->where('menuid', $menuid);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }
 
    public function count_all($menuid) {
		$this->db->where('menuid', $menuid);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    private function _get_datatables_query($menuid) { 
        $this->db->where('menuid', $menuid);    
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

    function get_datatables($menuid) {
        $this->_get_datatables_query($menuid);
        if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();
        return $query->result();
    }

    public function get_next_pos($menuid) {
        $this->db->select_max('position', 'max');
        $this->db->where('menuid', $menuid);        
        $result = $this->db->get($this->table);
        $row = $result->row_array();
        $next_pos = isset($row['max']) ? ($row['max']+1) : 1;
        return $next_pos;    
    }

    public function delete_by_id($id) {		
        $this->db->delete($this->table, array("id" => $id));
    }

	public function get_by_id($id) {    
		$query = $this->db->query("select * FROM menu_images WHERE id=".$id); 		
        return $query->row();
    }
    
    public function update($where, $data) { 
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }


}
