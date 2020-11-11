
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model {
    
	var $table = 'users';
    var $column_order = array('userid','name'); //set column field database for datatable orderable
    var $column_search = array('users.userid','users.name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('userid' => 'asc'); // default order 	
    
	function user_check($user, $password) {		
        $where = array(
			'userid' => $user,
            'password' => $password
		);
		return $this->db->get_where($this->table, $where);
	}		
 
    function get_order_by_name() {	
		$this->db->select('users.*, usergroups.name AS groupname');
		$this->db->join('usergroups', 'users.groupid = usergroups.id');
		$this->db->where('users.propertyid', $this->session->propertyid);
		$this->db->order_by('users.userid', 'ASC');
		$this->db->from($this->table);
		$result = $this->db->get();
        return $result;
    }

    function reload_order_by_name() {
        
        $this->db->select('users.*, usergroups.name AS groupname');
		$this->db->join('usergroups', 'users.groupid = usergroups.id');
		$this->db->where('users.propertyid', $this->session->propertyid);
		$this->db->order_by('users.userid', 'ASC');
		$this->db->from($this->table);
        $data = $this->db->get();
        return $data->result();
    }

    function save($userid, $name, $password, $groupid) {
        $data = array(
            'userid' => $userid,  
            'name' => $name,
            'password' => $password,
            'groupid' => $groupid,
            'propertyid' => $this->session->propertyid,
            'userfirst' => $this->session->id,
            'userlast' => $this->session->id,
            'datefirst' => date("Y/m/d h:i:sa"),
            'datelast' => date("Y/m/d h:i:sa")
        );
        $this->db->insert($this->table,$data);
    }

    function count_filtered() {      
        $this->db->where_not_in('users.id', 1);
		$this->db->where('propertyid', $this->session->propertyid);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }
 
    public function count_all() {
        $this->db->where_not_in('users.id', 1);
		$this->db->where('propertyid', $this->session->propertyid);
		$this->db->from($this->table);
        return $this->db->count_all_results();
    }

    private function _get_datatables_query() {
		
        $this->db->select('users.*, usergroups.name AS groupname');
        $this->db->where_not_in('users.id', 1);
		$this->db->join('usergroups', 'users.groupid = usergroups.id');
		$this->db->where('users.propertyid', $this->session->propertyid);
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
		$query = $this->db->query("select u.*, u1.name as firstname, u2.name as lastname FROM users u LEFT JOIN users u1 ON u.userfirst = u1.id LEFT JOIN users u2 ON u.userlast = u2.id WHERE u.id=".$id); 		
        return $query->row();
    }	    

    public function get_by_userid($userid) {

		$this->db->where('userid', $userid);
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
}
