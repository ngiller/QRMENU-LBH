<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Decl_answer_detail_model extends CI_Model {
    
	var $table = 'decl_answer_detail';
    	
    public function save($id, $question_id, $answer) {
        $data = array(
            'id' => $id,  
            'question_id' => $question_id,    
            'answer' => $answer
        );
        $this->db->insert($this->table,$data);
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

    public function get_id($id) {
        $this->db->select('q.id, q.line, q.question, q.sub_of, q.answer_type, d.answer');
        $this->db->join('question q','d.question_id=q.id', 'left');
        $this->db->where('d.id', $id);
        $this->db->order_by('q.line');
        $query = $this->db->get($this->table. " d");
        return $query->result();
    }

    public function delete_by_id($id) {
        $this->db->delete($this->table, array("id" => $id));
    }
}
