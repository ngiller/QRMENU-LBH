
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Outlet_table_model extends CI_Model
{

    var $table = 'outlet_table';
    var $column_order = array('table_no'); //set column field database for datatable orderable
    var $column_search = array('table_no'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('table_no' => 'asc'); // default order 	

    function get_order_by_name($outlet_id)
    {
        $outlet_id = xssclean($outlet_id);
        $this->db->where('outlet_id', $outlet_id);
        $this->db->where('propertyid', $this->session->propertyid);
        $this->db->order_by('table_no', 'ASC');
        $this->db->from($this->table);
        $result = $this->db->get();
        return $result;
    }

    function reload_order_by_name($outlet_id)
    {
        $outlet_id = xssclean($outlet_id);
        $this->db->where('outlet_id', $outlet_id);
        $this->db->where('propertyid', $this->session->propertyid);
        $this->db->from($this->table);
        $data = $this->db->get();
        return $data->result();
    }

    function save($outlet_id, $active, $table_no)
    {
        $data = array(
            'active' => $active,
            'outlet_id' => $outlet_id,
            'table_no' => $table_no,
            'propertyid' => $this->session->propertyid,
            'userfirst' => $this->session->id,
            'userlast' => $this->session->id,
            'datefirst' => date("Y/m/d h:i:sa"),
            'datelast' => date("Y/m/d h:i:sa")
        );
        $this->db->insert($this->table, $data);
    }

    function count_filtered($outlet_id)
    {
        $outlet_id = xssclean($outlet_id);
        $this->db->where('outlet_id', $outlet_id);
        $this->db->where('propertyid', $this->session->propertyid);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function count_all($outlet_id)
    {
        $outlet_id = xssclean($outlet_id);
        $this->db->where('outlet_id', $outlet_id);
        $this->db->where('propertyid', $this->session->propertyid);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    private function _get_datatables_query($outlet_id)
    {
        $outlet_id = xssclean($outlet_id);
        $this->db->where('outlet_id', $outlet_id);
        $this->db->where('propertyid', $this->session->propertyid);
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

    function get_datatables($outlet_id)
    {
        $outlet_id = xssclean($outlet_id);
        $this->_get_datatables_query($outlet_id);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);

        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id)
    {
        $query = $this->db->query("select rt.*, u1.name as firstname, u2.name as lastname FROM outlet_table rt LEFT JOIN users u1 ON rt.userfirst = u1.id LEFT JOIN users u2 ON rt.userlast = u2.id WHERE rt.id=".$id); 		
        return $query->row();
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

    public function check_table($propertyid, $outletid, $table) {

        $this->db->where('table_no', $table);
        $this->db->where('outlet_id', $outletid);
		$this->db->where('propertyid', $propertyid);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }    
	}
}
