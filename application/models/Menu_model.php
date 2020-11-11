
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_Model
{

    var $table = 'menu';
    var $column_order = array('menu.active', 'menu.code', 'menu.name', 'menu_cat.name', 'menu.price'); //set column field database for datatable orderable
    var $column_search = array('menu.code', 'menu.name', 'menu_cat.name', 'menu.price'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('code' => 'asc'); // default order 	

    function count_by_category($cid)
    {
        $this->db->where('categoryid', $cid);
        $this->db->where('active', 0);
        $this->db->where('outletid', $this->session->outletid);
        $this->db->where('propertyid', $this->session->propertyid);
        $this->db->order_by('name', 'ASC');
        $this->db->from($this->table);
        $result = $this->db->count_all_results();
        return $result;
    }

    function get_order_by_catid($cid, $limit, $start)
    {
        $this->db->select('menu_cat.id, menu_cat.code, menu_catmenu.*, menu_disc.disc as discpersen, menu_disc.active as discactive, menu_disc.date_start, menu_disc.date_end, menu_disc.time_start, menu_disc.time_stop, menu_disc.sun, menu_disc.mon, menu_disc.tue, menu_disc.wed, menu_disc.thu, menu_disc.fri, menu_disc.sat, menu_disc.allday');
        $this->db->where('menu.categoryid', $cid);
        $this->db->where('menu.categoryid', $cid);
        $this->db->where('menu.active', 0);
        $this->db->where('menu.outletid', $this->session->outletid);
        $this->db->where('menu.propertyid', $this->session->propertyid);
        $this->db->join('menu_disc', 'menu.disc=menu_disc.id', 'left');
        $this->db->order_by('menu.name', 'ASC');
        $this->db->from($this->table);
        $this->db->limit($limit, $start);
        $result = $this->db->get();
        return $result;
    }

    function get_order_by_name()
    {
        $this->db->where('outletid', $this->session->outletid);
        $this->db->where('propertyid', $this->session->propertyid);
        $this->db->order_by('name', 'ASC');
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

    function save($code, $name, $catid, $desc, $price, $limited_stock, $stock, $min_order, $disc, $order_other, $halal, $chefrecom, $special, $favourite)
    {
        $data = array(
            'code' => $code,
            'name' => $name,
            'categoryid' => $catid,
            'descriptions' => $desc,
            'price' => $price,
            'limited_stock' => $limited_stock,
            'stock' => $stock,
            'min_order' => $min_order,
            'disc' => $disc,
            'order_other_outlet' => $order_other,
            'halal' => $halal,
            'chefrecomend' => $chefrecom,
            'special' => $special,
            'favourite' => $favourite,
            'outletid' => $this->session->outletid,
            'propertyid' => $this->session->propertyid,
            'userfirst' => $this->session->id,
            'userlast' => $this->session->id,
            'datefirst' => date("Y/m/d h:i:sa"),
            'datelast' => date("Y/m/d h:i:sa")
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

    private function _get_datatables_query()
    {
        $this->db->select('menu.*, menu_cat.name AS catname, menu_disc.code AS disccode');
        $this->db->join('menu_cat', 'menu.categoryid = menu_cat.id', 'left');
        $this->db->join('menu_disc', 'menu.disc = menu_disc.id', 'left');
        $this->db->where('menu.outletid', $this->session->outletid);
        $this->db->where('menu.propertyid', $this->session->propertyid);
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
        $query = $this->db->query("select e.*, u1.name as firstname, u2.name as lastname FROM menu e LEFT JOIN users u1 ON e.userfirst = u1.id LEFT JOIN users u2 ON e.userlast = u2.id WHERE e.id=" . $id);
        return $query->row();
    }

    public function view_by_id($id)
    {
        $this->db->select('menu.*, menu_disc.disc as discpersen, menu_disc.active as discactive, menu_disc.date_start, menu_disc.date_end, menu_disc.time_start, menu_disc.time_stop, menu_disc.sun, menu_disc.mon, menu_disc.tue, menu_disc.wed, menu_disc.thu, menu_disc.fri, menu_disc.sat, menu_disc.allday');
        $this->db->where('menu.id', $id);
        $this->db->join('menu_disc', 'menu.disc=menu_disc.id', 'left');
        $this->db->from($this->table);
        $result = $this->db->get();
        return $result->row();
    }

    public function get_by_code($code)
    {
        $this->db->where('code', $code);
        $this->db->where('propertyid', $this->session->propertyid);
        $query = $this->db->get($this->table);
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function get_by_name($name)
    {

        $this->db->where('name', $name);
        $this->db->where('propertyid', $this->session->propertyid);
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

    public function get_order_by_cat($limit, $start)
    {
        $this->db->select('menu.*, menu_cat.name as catname, menu_disc.disc as discpersen, menu_disc.active as discactive, menu_disc.date_start, menu_disc.date_end, menu_disc.time_start, menu_disc.time_stop, menu_disc.sun, menu_disc.mon, menu_disc.tue, menu_disc.wed, menu_disc.thu, menu_disc.fri, menu_disc.sat, menu_disc.allday');
        $this->db->join('menu_cat', 'menu.categoryid = menu_cat.id', 'left');
        $this->db->join('menu_disc', 'menu.disc = menu_disc.id', 'left');
        $this->db->where('menu.active', 0);
        $this->db->where('menu_cat.active', 0);
        $this->db->where('menu.outletid', $this->session->outletid);
        $this->db->where('menu.propertyid', $this->session->propertyid);
        $this->db->order_by('menu_cat.name', 'ASC');
        $this->db->order_by('menu.name', 'ASC');
        $this->db->from($this->table);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result();
    }

    function count_all_menu()
    {
        $this->db->select('menu.*, menu_cat.name as catname');
        $this->db->join('menu_cat', 'menu.categoryid = menu_cat.id', 'left');
        $this->db->where('menu.active', 0);
        $this->db->where('menu_cat.active', 0);
        $this->db->where('menu.outletid', $this->session->outletid);
        $this->db->where('menu.propertyid', $this->session->propertyid);
        $this->db->order_by('menu_cat.name', 'ASC');
        $this->db->order_by('menu.name', 'ASC');
        $this->db->from($this->table);
        $result = $this->db->count_all_results();
        return $result;
    }

    public function get_image_by_id($id)
    {
        $this->db->select('image');
        $this->db->where('id', $id);
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->row()->image;
    }

    public function get_favourite()
    {
        $this->db->where('active =', 0);
        $this->db->where('favourite =', 0);
        $this->db->where('outletid', $this->session->outletid);
        $this->db->where('propertyid', $this->session->propertyid);
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->result();
    }
}
