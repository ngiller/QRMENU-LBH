<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_group_model extends CI_Model {	

    var $table = 'usergroups';
    var $column_order = array('name',); //set column field database for datatable orderable
    var $column_search = array('name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('name' => 'asc'); // default order 

    function get_order_by_name() {
        $this->db->where_not_in('id', 1);
        $this->db->order_by('name', 'ASC');
        $result = $this->db->get($this->table);
        return $result;
    }

    function save($name) {
        $data = array(            
            'name' => $name,
            'propertyid' => $this->session->propertyid,
            'userfirst' => $this->session->id,
            'userlast' => $this->session->id,
            'datefirst' => date("Y/m/d h:i:sa"),
            'datelast' => date("Y/m/d h:i:sa")
        );
        $this->db->insert($this->table, $data);
    }

    function count_filtered() {        
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }
 
    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    private function _get_datatables_query() {
        $this->db->where_not_in('id', 1);    
        $this->db->from($this->table);
    
        $i = 0;
        
        foreach ($this->column_search as $item) {
            if($_POST['search']['value']) {                    
                if($i===0) {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
    
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
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
        
        $query = $this->db->query("select g.*, u.name as firstname, u1.name as lastname FROM usergroups g LEFT JOIN users u ON g.userfirst = u.id LEFT JOIN users u1 ON g.userlast = u1.id WHERE g.id=".$id);
 
        return $query->row();
    }	

    public function get_by_name($name) {

        $this->db->where('name', $name);
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
}
