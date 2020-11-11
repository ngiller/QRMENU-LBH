
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Order_master_model extends CI_Model
{

    var $table = 'order_master';
    var $column_order = array('orderdate'); //set column field database for datatable orderable
    var $column_search = array('id'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('orderdate' => 'desc'); // default order 	

    function get_order_by_name()
    {
        $this->db->where('outletid', $this->session->outletid);
        $this->db->where('propertyid', $this->session->propertyid);
        $this->db->order_by('orderdate', 'DESC');
        $this->db->from($this->table);
        $result = $this->db->get();
        return $result;
    }

    function reload_order_by_name()
    {
        $this->db->where('outletid', $this->session->outletid);
        $this->db->where('propertyid', $this->session->propertyid);
        $this->db->from($this->table);
        $data = $this->db->get();
        return $data->result();
    }

    function get_order_by_guestid($guestid)
    {
        $this->db->where('guestid', $guestid);
        //$this->db->where('outletid', $this->session->outletid);
        $this->db->where('propertyid', $this->session->propertyid);
        $this->db->from($this->table);
        $this->db->order_by('orderdate', 'ASC');
        $this->db->order_by('id', 'ASC');
        $data = $this->db->get();
        return $data->result();
    }

    function save($id, $table, $pax, $guestid, $roomno, $note, $subtotal, $payment, $disc, $tax, $service, $total)
    {
        date_default_timezone_set($this->session->timezone);
        $data = array(
            'id' => $id,
            'orderdate' => date('Y-m-d H:i:s'),
            'table_num' => $table,
            'pax' => $pax,
            'guestid' => $guestid,
            'roomno' => $roomno,
            'note' => $note,
            'subtotal' => $subtotal,
            'payment' => $payment,
            'disc' => $disc,
            'tax' => $tax,
            'service' => $service,
            'total' => $total,
            'outletid' => $this->session->outletid,
            'propertyid' => $this->session->propertyid

        );
        $this->db->insert($this->table, $data);
    }

    function count_filtered()
    {
        $this->db->where('outletid', $this->session->outletid);
        $this->db->where('propertyid', $this->session->propertyid);
        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->where('outletid', $this->session->outletid);
        $this->db->where('propertyid', $this->session->propertyid);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function _get_datatables_query()
    {
        $bdate = substr($this->session->bdate, 6, 4) . "-" . substr($this->session->bdate, 3, 2) . "-" . substr($this->session->bdate, 0, 2) . " 00:00:00";
        $edate = substr($this->session->edate, 6, 4) . "-" . substr($this->session->edate, 3, 2) . "-" . substr($this->session->edate, 0, 2) . " 23:59:59";
        //print_r($bdate); print_r($edate); exit;
        $this->db->select('order_master.*, guests.name');
        $this->db->join('guests', 'order_master.guestid = guests.id', 'left');
        $this->db->where('order_master.outletid', $this->session->outletid);
        $this->db->where('order_master.propertyid', $this->session->propertyid);
        $this->db->where('order_master.orderdate >=', $bdate);
        $this->db->where('order_master.orderdate <=', $edate);
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
        $this->db->select('order_master.*, guests.email, guests.name as guestname, guests.phone, country.name as countryname');
        $this->db->where('order_master.id', $id);
        $this->db->join('guests', 'order_master.guestid = guests.id', 'left');
        $this->db->join('country', 'guests.country = country.id', 'left');
        $query = $this->db->get($this->table);
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

    public function get_max_id()
    {
        $this->db->select_max('id');
        $this->db->where('outletid', $this->session->outletid);
        $this->db->where('propertyid', $this->session->propertyid);
        $result = $this->db->get($this->table)->row();
        return $result->id;
    }

    public function show_current_order()
    {
        $edate = date('Y-m-d');
        $this->db->select('order_master.*, guests.email, guests.name as guestname, guests.phone');
        $this->db->where('date(order_master.orderdate) =', $edate);
        $this->db->where('order_master.outletid', $this->session->outletid);
        $this->db->where('order_master.propertyid', $this->session->propertyid);
        $this->db->or_where('order_master.status', '0');
        $this->db->where('order_master.outletid', $this->session->outletid);
        $this->db->where('order_master.propertyid', $this->session->propertyid);
        $this->db->join('guests', 'order_master.guestid = guests.id', 'left');
        $this->db->order_by('order_master.orderdate', 'DESC');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query;
    }

    public function get_status($order_id)
    {
        $this->db->select('status');
        $this->db->where('order_master.id', $order_id);
        $query = $this->db->get($this->table);
        $data = $query->row();
        return $data->status;
    }

    public function get_guest_order($guest_id)
    {
        $this->db->select('*');
        $this->db->where('guestid', $guest_id);
        $this->db->order_by('orderdate', 'DESC');
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }
}
