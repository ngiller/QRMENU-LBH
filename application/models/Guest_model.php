
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Guest_model extends CI_Model
{

    var $table = 'guests';
    var $column_order = array('email', 'name', 'phone', 'countryname'); //set column field database for datatable orderable
    var $column_search = array('email', 'guests.name', 'phone', 'country.name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('email' => 'asc'); // default order 	

    function get_order_by_email()
    {
        $this->db->where('propertyid', $this->session->propertyid);
        $this->db->order_by('email', 'ASC');
        $this->db->from($this->table);
        $result = $this->db->get();
        return $result;
    }

    function reload_order_by_email()
    {
        $this->db->select('guests.*, country.name as countryname');
        $this->db->join('country', 'guests.country = country.id', 'left');
        $this->db->where('guests.propertyid', $this->session->propertyid);
        $this->db->from($this->table);
        $data = $this->db->get();
        return $data->result();
    }

    function save($email, $name, $phone, $country = "")
    {
        $data = array(
            'email' => $email,
            'name' => $name,
            'phone' => $phone,
            'country' => $country,
            'register_date' => date('Y-m-d H:m:s'),
            'propertyid' => $this->session->propertyid

        );
        $this->db->insert($this->table, $data);
    }

    function count_filtered()
    {
        $this->db->where('propertyid', $this->session->propertyid);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->where('propertyid', $this->session->propertyid);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    private function _get_datatables_query()
    {
        $this->db->select('guests.*, country.name as countryname');
        $this->db->join('country', 'guests.country = country.id', 'left');
        $this->db->where('guests.propertyid', $this->session->propertyid);
        $this->db->from($this->table);

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

    public function get_by_id($id)
    {
        $this->db->select('guests.*, country.name as countryname');
        $this->db->where('guests.id', $id);
        $this->db->where('guests.propertyid', $this->session->propertyid);
        $this->db->from($this->table);
        $this->db->join('country', 'guests.country = country.id', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_by_email($email, $propertyid)
    {
        $this->db->select('guests.*, country.name as countryname');
        $this->db->where('guests.email', $email);
        $this->db->where('guests.propertyid', $propertyid);
        $this->db->from($this->table);
        $this->db->join('country', 'guests.country = country.id', 'left');
        $query = $this->db->get();
        return $query->row();
    }

    public function is_email($email)
    {
        $this->db->where('email', $email);
        $this->db->where('propertyid', $this->session->propertyid);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function find_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function delete_by_id($id)
    {
        $this->db->delete($this->table, array("id" => $id));
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
}
