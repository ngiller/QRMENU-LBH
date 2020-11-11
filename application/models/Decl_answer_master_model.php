
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Decl_answer_master_model extends CI_Model {
    
    var $table = 'decl_answer_master';
    var $column_order = array('m.date', 'g.name', 'g.email', 'q.score'); //set column field database for datatable orderable
    var $column_search = array('m.date', 'g.name', 'g.email', 'q.score'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('m.date' => 'asc');
    	
    public function save($id, $date, $guest_id, $property_id) {
        $data = array(
            'id' => $id,  
            'date' => $date,    
            'guest_id' => $guest_id,
            'property_id' => $property_id
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

    public function get_by_id($id) {
		$this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    function count_filtered()
    {
        $this->db->where('property_id', $this->session->propertyid);
        $this->db->where('date(date) >=', $this->session->bdate);
        $this->db->where('date(date) <=', $this->session->edate);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->where('property_id', $this->session->propertyid);
        $this->db->where('date(date) >=', $this->session->bdate);
        $this->db->where('date(date) <=', $this->session->edate);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    private function _get_datatables_query()
    {
        /*SELECT m.id, m.guest_id, m.date, g.name, sum( case when d.answer=1 then q.score else case when d.answer='' THEN q.score ELSE 0 END end ) as score FROM decl_answer_master m LEFT JOIN decl_answer_detail d on m.id=d.id LEFT JOIN guests g ON m.guest_id=g.id LEFT JOIN question q on d.question_id=q.id GROUP BY m.id*/
        $bdate = substr($this->session->bdate, 6, 4) . "-" . substr($this->session->bdate, 3, 2) . "-" . substr($this->session->bdate, 0, 2);
        $edate = substr($this->session->edate, 6, 4) . "-" . substr($this->session->edate, 3, 2) . "-" . substr($this->session->edate, 0, 2);

        $this->db->select('m.id, m.guest_id, m.date, g.name, g.email, sum( case when d.answer=1 then q.score else case when d.answer="" THEN q.score ELSE 0 END end ) as score');
        $this->db->where('date(m.date) >=', $bdate);
        $this->db->where('date(m.date) <=', $edate);
        $this->db->where('m.property_id', $this->session->propertyid);
        $this->db->join('decl_answer_detail d', ' m.id=d.id', 'left');
        $this->db->join('question q', 'd.question_id=q.id', 'left');
        $this->db->join('guests g', 'm.guest_id=g.id', 'left');
        $this->db->group_by("m.id");
        $this->db->from($this->table . " m");

        $i = 0;

        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();
        return $query->result();
    }

    public function get_id($id)
    {
        $this->db->select('m.id, m.guest_id, m.date, g.name as name, g.email, g.phone, sum( case when d.answer=1 then q.score else case when d.answer="" THEN q.score ELSE 0 END end ) as score');
        $this->db->where('m.id', $id);
        $this->db->join('decl_answer_detail d', ' m.id=d.id', 'left');
        $this->db->join('question q', 'd.question_id=q.id', 'left');
        $this->db->join('guests g', 'm.guest_id=g.id', 'left');
        $this->db->group_by("m.id");
        $this->db->from($this->table . " m");
        $query = $this->db->get();
        return $query->row();
    }
}
