<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class home_image_model extends CI_Model {	

    var $table = 'home_image';

    function get_order_by_id() {
        $this->db->order_by('id', 'ASC');
        $qry = $this->db->get($this->table);
        return $qry->result();
    }

    public function get_data_with_link() {
        $this->db->select('home_image.*, pages.title, pages.link as linkname');
        $this->db->join('pages', 'home_image.link=pages.id');
        $this->db->order_by('home_image.id', 'ASC');
        $qry = $this->db->get($this->table);
        return $qry->result();
    } 

    public function update($where, $data) {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
}
