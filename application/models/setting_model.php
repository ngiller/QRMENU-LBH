<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {	

    var $table = 'setting';
    var $column_order = array('name'); //set column field database for datatable orderable
    var $column_search = array('name'); //set column field database for datatable searchable just firstname , lastname , address are searchable
    var $order = array('name' => 'asc'); // default order 
 
 
    function get_setting_value($name, $property_id) {
        $this->db->where('name', $name);
        $this->db->where('property_id', $property_id);
        $query = $this->db->get($this->table);
        $result = $query->row();
        return $result;
    }


    public function get_all() {
        $setting = $this->get_setting_value("tax", $this->session->propertyid); 
        $data['tax'] = $setting->value;
        $setting = $this->get_setting_value("service", $this->session->propertyid); 
        $data['service'] = $setting->value;
        $setting = $this->get_setting_value("time_zone", $this->session->propertyid); 
        $data['timezone'] = $setting->value;
        $setting = $this->get_setting_value("qrsize", $this->session->propertyid); 
        $data['qrsize'] = $setting->value;
        return $data;
    }

    public function update($where, $data) {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }
}
