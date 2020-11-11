<?php
class Page extends CI_Controller
{
  function __construct()
  {
      parent::__construct();
      if ($this->session->userdata('outletid') == "") {
        redirect(base_url("/scan_qr"));
      }

      $this->load->helper('url');
      $this->load->model('outlet_model');
      $this->load->model('pages_model');
      $this->load->model('whatson_model');
      $this->load->model('guest_model');
  }

  function _remap($mid) {
    $this->index($mid);
  }
   
  public function index($mid) {    
    $data['nav_index'] = 1; 
    $data['menucatid'] = -1;
    $data['whatson_data'] = $this->whatson_model->show_whatson();
    $data['outlet_data'] = $this->outlet_model->show_outlet();
    if ($mid == "room_directory") {
        $rd = $this->pages_model->get_by_id(-1);
        if (empty($rd->descriptions)) {
          $link = "Location: " .$rd->link;
          header($link, true, 301);
          exit;
        } else {
          $data['dt'] = $this->pages_model->get_by_id(-1); 
          if ($this->session->guestid != "") {
              $guest = $this->guest_model->get_by_id($this->session->guestid);
              $data['guest_name'] = $guest->name;
          } else {
              $data['guest_name'] = "";
          }       
          $this->load->view($this->session->template_folder.'/page-view', $data);
        }    
      } else {
        $data['dt'] = $this->pages_model->get_data_by_link($mid);
        if ($this->session->guestid != "") {
            $guest = $this->guest_model->get_by_id($this->session->guestid);
            $data['guest_name'] = $guest->name;
        } else {
            $data['guest_name'] = "";
        }
        $this->load->view($this->session->template_folder.'/page-view', $data);
      }  
  }

}