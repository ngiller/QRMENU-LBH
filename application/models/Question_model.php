<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends CI_Model {
    
    var $table = 'question';
    var $column_order = array('line', 'question', 'score'); //set column field database for datatable orderable
    var $column_search = array('line', 'question', 'score'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('line' => 'asc');
    
    public function get_all($property_id) {
        $this->db->where('property_id', $property_id);
        $this->db->order_by('line');
        $query = $this->db->get($this->table); 
        return $query->result();   
    }
    	
    public function save($line, $question, $sub_of, $answer_type, $score) {
        $data = array(
            'line' => $line,  
            'question' => $question,    
            'sub_of' => $sub_of,
            'answer_type' => $answer_type,
            'score' => $score,
            'property_id' => $this->session->propertyid,
            'userfirst' => $this->session->id,
            'userlast' => $this->session->id,
            'datefirst' => date("Y/m/d h:i:sa"),
            'datelast' => date("Y/m/d h:i:sa")
        );
        $this->db->insert($this->table, $data);
    }

    public function find_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }    
    }

    public function get_by_id($id) {
		$this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function delete_by_id($id) {
        $this->db->delete($this->table, array("id" => $id));
    }

    public function count_all($property_id) {
        $this->db->where('property_id', $property_id);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function count_filtered() {     
		$this->db->where('property_id', $this->session->propertyid);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    private function _get_datatables_query() {
		$this->db->where('property_id', $this->session->propertyid);
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

    public function update($where, $data) {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
}
