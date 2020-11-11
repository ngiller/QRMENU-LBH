<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Question extends CI_Controller {

    function __construct() {
        parent::__construct();

        if($this->session->userdata('status') != "login"){
			redirect(base_url("simin/signin"));
		}

        $this->load->model('property_model');
        $this->load->model('user_group_model');
        $this->load->model('question_model');
    }

    function index() {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['usergroup_data'] = $this->user_group_model->get_order_by_name();
        $data['active_menu'] = 120;
        $data['title'] = "DECLARATION QUESTION LIST";
        $this->load->view('simin/question_view', $data);
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('question') == '') {
            $data['inputerror'][] = 'question';
            $data['error_string'][] = 'Question is required';
            $data['status'] = FALSE;
          }
     
        if($this->input->post('line') == '') {
          $data['inputerror'][] = 'line';
          $data['error_string'][] = 'Line number is required';
          $data['status'] = FALSE;
        } 
        
        if($this->input->post('score') == '') {
            $data['inputerror'][] = 'score';
            $data['error_string'][] = 'Score is required';
            $data['status'] = FALSE;
          }
    
        if($data['status'] === FALSE) {
          echo json_encode($data);
          exit();
        }
    }
  
    public function ajax_list() {
        $list = $this->question_model->get_datatables(); 
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $question) {
            $no++;
            $row = array();                      
            $row[] = $question->line;
            $row[] = $question->question;
            $row[] = $question->sub_of;
            if ($question->answer_type == 1) {
                $row[] = 'Yes/No';
            } else {
                if ($question->answer_type == 2) {
                    $row[] = 'Text input';
                } else {
                    $row[] = '';
                }
            }  
            $row[] = $question->score;        
   
            //add html for action
            $row[] = '<a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="Edit" href="javascript:void(0)" onclick="edit_record('."'".$question->id."'".')"><i class="flaticon-edit"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle del_data" href="javascript:void(0)" title="Delete" onclick="delete_record('."'".$question->id."'".')"><i class="flaticon-delete"></i></a>';
            $row[] = '<input type="checkbox" name="id[]" class="delete_customer" value="' . $question->id .'" />';
           
            $data[] = $row;
        }
   
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->question_model->count_all($this->session->propertyid),
            "recordsFiltered" => $this->question_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function add_save(){
        $this->_validate();
        $line = $this->input->post('line');
        $question = $this->input->post('question');
        $sub_of = $this->input->post('sub_of');
        $answer_type = $this->input->post('answer_type');
        $score = $this->input->post('score');
        $this->question_model->save($line, $question, $sub_of, $answer_type, $score);
        $result = array(
            "status" => TRUE
        );
        echo json_encode($result);
    }

    public function delete($id){        
        $this->question_model->delete_by_id($id);        
        $result = array(
            "status" => TRUE
        );
        
        echo json_encode($result);

    }

    public function del_selected(){
        if ($this->input->post('id')) {
            foreach($_POST["id"] as $id) {
                $this->question_model->delete_by_id($id);                   
            }
            $result = array(
                "status" => TRUE
            );
            echo json_encode($result);
        }    
    }

    public function ajax_update() {
        $this->_validate();        

        //$active = $this->input->post('active');
        //if ($active == NULL) { $active = 1; }
        
        $data = array(            
            'line' => $this->input->post('line'),
            'question' => $this->input->post('question'),
            'sub_of' => $this->input->post('sub_of'),
            'answer_type' => $this->input->post('answer_type'),
            'score' => $this->input->post('score'),
            'property_id' => $this->session->propertyid,
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")               
        );
        $this->question_model->update(array('id' => $this->input->post('id')), $data);       
        $result = array(
            "status" => TRUE
        );
        echo json_encode($result);
    }
    
    public function ajax_edit($id) {
        $data = $this->question_model->get_by_id($id);
        echo json_encode($data);
    }

    public function change_property() {
        $row = $this->property_model->get_by_id($this->input->post('id'));
        $this->session->set_userdata('propertyid', $row->id);
        $this->session->set_userdata('propertyname', $row->name);
        echo json_encode(array($this->session->propertyname));
    }

    
}