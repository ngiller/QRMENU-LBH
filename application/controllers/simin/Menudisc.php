<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menudisc extends CI_Controller {

    function __construct() {
        parent::__construct();

        if($this->session->userdata('status') != "login"){
			redirect(base_url("simin/signin"));
		}

        $this->load->model('property_model');
        $this->load->model('outlet_model');
        $this->load->model('menu_disc_model');
    }

    function index() {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['select_outlet'] = $this->outlet_model->get_order_by_name();
        $data['outletid'] = $this->session->outletid;
        $data['active_menu'] = 90;
        $data['title'] = "MENU DISCOUNT";
        $this->load->view('simin/menu_disc_view', $data);
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('code') == '') {
            $data['inputerror'][] = 'code';
            $data['error_string'][] = 'Code is required';
            $data['status'] = FALSE;
          }
     
        if($this->input->post('name') == '') {
          $data['inputerror'][] = 'name';
          $data['error_string'][] = 'Name is required';
          $data['status'] = FALSE;
        }
        
        if($this->input->post('disc') == '') {
            $data['inputerror'][] = 'disc';
            $data['error_string'][] = 'Discount is required';
            $data['status'] = FALSE;
          }
    
        if($data['status'] === FALSE) {
          echo json_encode($data);
          exit();
        }
    }

    public function _check_available($oldcode, $newcode, $oldname, $newname) {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;
    
        if ($oldname != $newname) {
            if ($this->menu_disc_model->get_by_name($newname)) {     
                $data['inputerror'][] = 'name';
                $data['error_string'][] = 'Name already exits';
                $data['status'] = FALSE;      
            }
        }

        if ($oldcode != $newcode) {
            if ($this->menu_disc_model->get_by_code($newcode)) {     
                $data['inputerror'][] = 'code';
                $data['error_string'][] = 'Menu ID already exits';
                $data['status'] = FALSE;      
            }
        }

    
        if($data['status'] == FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    
    public function ajax_list() {
        $list = $this->menu_disc_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $menudisc) {
            $no++;
            $row = array();       
            if ($menudisc->active == 0) {
                $row[] = '<input type="checkbox" checked="checked" name="active">';      
            } else {
                $row[] = '<input type="checkbox" name="active">';      
            }
            $row[] = $menudisc->code;          
            $row[] = $menudisc->name; 
            $row[] = $menudisc->disc;             
   
            //add html for action
            $row[] = '<a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="Edit" href="javascript:void(0)" onclick="edit_record('."'".$menudisc->id."'".')"><i class="flaticon-edit"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle del_data" href="javascript:void(0)" title="Delete" onclick="delete_record('."'".$menudisc->id."'".')"><i class="flaticon-delete"></i></a>';
            $row[] = '<input type="checkbox" name="id[]" class="delete_customer" value="' . $menudisc->id .'" />';
           
            $data[] = $row;
        }
   
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->menu_disc_model->count_all(),
            "recordsFiltered" => $this->menu_disc_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function add_save(){
        $this->_validate();
        $this->_check_available('', $this->input->post('code'), '', $this->input->post('name'));

        $code = $this->input->post('code');
        $name = $this->input->post('name');
        $disc = $this->input->post('disc');        
        $starttime = $this->input->post('starttime');
        $endtime = $this->input->post('endtime');

        $startdate = $this->input->post('startdate');
        $dd = substr($startdate, 0, 2);
        $mm = substr($startdate, 3, 2);
        $yyyy = substr($startdate, 6, 4);
        $startdate = $yyyy . "-" . $mm . "-" . $dd;
        $enddate = $this->input->post('enddate');
        $dd = substr($enddate, 0, 2);
        $mm = substr($enddate, 3, 2);
        $yyyy = substr($enddate, 6, 4);
        $enddate = $yyyy . "-" . $mm . "-" . $dd;

        $active = $this->input->post('active');
        if ($active == NULL) { $active = 1; }
        $allday = $this->input->post('allday');
        if ($allday == NULL) { $allday = 1; }
        $sun = $this->input->post('sun');
        if ($sun == NULL) { $sun = 1; }
        $mon = $this->input->post('mon');
        if ($mon == NULL) { $mon = 1; }
        $tue = $this->input->post('tue');
        if ($tue == NULL) { $tue = 1; }
        $wed = $this->input->post('wed');
        if ($wed == NULL) { $wed = 1; }
        $thu = $this->input->post('thu');
        if ($thu == NULL) { $thu = 1; }
        $fri = $this->input->post('fri');
        if ($fri == NULL) { $fri = 1; }
        $sat = $this->input->post('sat');
        if ($sat == NULL) { $sat = 1; }
        
        $this->menu_disc_model->save($active, $code, $name, $disc, $startdate, $enddate, $starttime, $endtime, $allday, $sun, $mon, $tue, $wed, $thu, $fri, $sat);
        $result = array(
            "status" => TRUE
        );
        echo json_encode($result);
    }

    public function delete($id){                
        $this->menu_disc_model->delete_by_id($id);
        $result = array(
            "status" => TRUE,
            "data" => $this->menu_disc_model->reload_order_by_name()
        );
        
        echo json_encode($result);

    }

    public function del_selected(){
        if ($this->input->post('id')) {
            foreach($_POST["id"] as $id) {
                $this->menu_disc_model->delete_by_id($id);                                   
            }
            $result = array(
                "status" => TRUE,
                "data" => $this->menu_disc_model->reload_order_by_name()
            );
            echo json_encode($result);
        }    
    }

    public function ajax_update() {
        $this->_validate();
        $this->_check_available($this->input->post('oldcode'), $this->input->post('code'), $this->input->post('oldname'), $this->input->post('name'));

        $active = $this->input->post('active');
        if ($active == NULL) { $active = 1; }
        $allday = $this->input->post('allday');
        if ($allday == NULL) { $allday = 1; }
        $sun = $this->input->post('sun');
        if ($sun == NULL) { $sun = 1; }
        $mon = $this->input->post('mon');
        if ($mon == NULL) { $mon = 1; }
        $tue = $this->input->post('tue');
        if ($tue == NULL) { $tue = 1; }
        $wed = $this->input->post('wed');
        if ($wed == NULL) { $wed = 1; }
        $thu = $this->input->post('thu');
        if ($thu == NULL) { $thu = 1; }
        $fri = $this->input->post('fri');
        if ($fri == NULL) { $fri = 1; }
        $sat = $this->input->post('sat');
        if ($sat == NULL) { $sat = 1; }

        $startdate = $this->input->post('startdate');
        $dd = substr($startdate, 0, 2);
        $mm = substr($startdate, 3, 2);
        $yyyy = substr($startdate, 6, 4);
        $startdate = $yyyy . "-" . $mm . "-" . $dd;
        $enddate = $this->input->post('enddate');
        $dd = substr($enddate, 0, 2);
        $mm = substr($enddate, 3, 2);
        $yyyy = substr($enddate, 6, 4);
        $enddate = $yyyy . "-" . $mm . "-" . $dd;
        
        $data = array(
            'active'=> $active, 
            'code'=> $this->input->post('code'),
            'name' => $this->input->post('name'),
            'disc' => $this->input->post('disc'),
            'date_start' => $startdate,
            'date_end' => $enddate,
            'time_start' => $this->input->post('starttime'),
            'time_stop' => $this->input->post('endtime'),
            'allday' => $allday, 
            'sun' => $sun,
            'mon' => $mon, 
            'tue' => $tue,
            'wed' => $wed, 
            'thu' => $thu, 
            'fri' => $fri,
            'sat' => $sat,
            'outletid' => $this->session->outletid,
            'propertyid' => $this->session->propertyid,
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")                
        );
        $this->menu_disc_model->update(array('id' => $this->input->post('id')), $data);
        $result = array(
            "status" => TRUE,
            "data" => $this->menu_disc_model->reload_order_by_name()
        );
        echo json_encode($result);
    }
    
    public function ajax_edit($id) {
        $data = $this->menu_disc_model->get_by_id($id);
        echo json_encode($data);
    }

    public function change_property() {
        $row = $this->property_model->get_by_id($this->input->post('id'));
        $this->session->set_userdata('propertyid', $row->id);
        $this->session->set_userdata('propertyname', $row->name);
        echo json_encode(array($this->session->propertyname));
    }

    public function change_outlet() {
        $row = $this->outlet_model->get_by_id($this->input->post('id'));
        $this->session->set_userdata('outletid', $row->id);
        $this->session->set_userdata('outletname', $row->name);
        echo json_encode(array($this->session->outletname));
    }

    public function testsave() {
        $this->menu_disc_model->save(0, 'D20', 'DISC 20', 20, '', '', '', '', '', '', '', '', '', '', '', '');       
    }
}