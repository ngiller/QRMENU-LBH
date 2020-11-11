<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("simin/signin"));
        }

        $this->load->model('property_model');
        $this->load->model('outlet_model');
        $this->load->model('menu_cat_model');
        $this->load->model('menu_disc_model');
        $this->load->model('menu_images_model');
        $this->load->model('menu_model');
    }

    function index()
    {
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['menucat_data'] = $this->menu_cat_model->view_order_by_name();
        $data['menudisc_data'] = $this->menu_disc_model->get_order_by_name();
        $data['select_outlet'] = $this->outlet_model->get_order_by_name();
        $data['active_menu'] = 70;
        $data['title'] = "MENU LIST";
        $this->load->view('simin/menu_view', $data);
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('code') == '') {
            $data['inputerror'][] = 'code';
            $data['error_string'][] = 'Menu code is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('name') == '') {
            $data['inputerror'][] = 'name';
            $data['error_string'][] = 'Menu name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('price') == '') {
            $data['inputerror'][] = 'price';
            $data['error_string'][] = 'Menu price is required';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    public function _check_available($oldcode, $newcode, $oldname, $newname)
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($oldname != $newname) {
            if ($this->menu_model->get_by_name($newname)) {
                $data['inputerror'][] = 'name';
                $data['error_string'][] = 'Menu name already exits';
                $data['status'] = FALSE;
            }
        }

        if ($oldcode != $newcode) {
            if ($this->menu_model->get_by_code($newcode)) {
                $data['inputerror'][] = 'code';
                $data['error_string'][] = 'Menu ID already exits';
                $data['status'] = FALSE;
            }
        }


        if ($data['status'] == FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    public function ajax_list()
    {
        $list = $this->menu_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $menu) {
            $no++;
            $row = array();
            if ($menu->active == 0) {
                $row[] = '<input type="checkbox" checked="checked" name="active">';
            } else {
                $row[] = '<input type="checkbox" name="active">';
            }
            $row[] = $menu->code;
            $row[] = $menu->name;
            $row[] = $menu->catname;
            $row[] = number_format($menu->price, 0, ",", ".");
            $row[] = $menu->disccode;
            $row[] = '<a href="javascript:void(0)" onclick="submenu(' . "'" . $menu->id . "'" . ')"><span class="kt-badge kt-badge--inline kt-badge--brand">Sub menu</span></a>';

            //add html for action
            $row[] = '<a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="Edit" href="javascript:void(0)" onclick="edit_record(' . "'" . $menu->id . "'" . ')"><i class="flaticon-edit"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle del_data" href="javascript:void(0)" title="Delete" onclick="delete_record(' . "'" . $menu->id . "'" . ')"><i class="flaticon-delete"></i></a>
                <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle img_data" href="javascript:void(0)" title="Menu Image" onclick="show_gallery(' . "'" . $menu->id . "'" . ')"><i class="flaticon2-photo-camera"></i></a>';
            $row[] = '<input type="checkbox" name="id[]" class="delete_customer" value="' . $menu->id . '" />';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->menu_model->count_all(),
            "recordsFiltered" => $this->menu_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function add_save()
    {
        $active = $this->input->post('active');
        if ($active == NULL) {
            $active = 1;
        }
        $code = xssclean($this->input->post('code'));
        $name = xssclean($this->input->post('name'));
        $catid = xssclean($this->input->post('catid'));
        $desc = xssclean($this->input->post('desc'));
        $price = xssclean($this->input->post('price'));
        $stock = xssclean($this->input->post('stock'));
        $min_order = xssclean($this->input->post('min_order'));
        $disc = $this->input->post('disc');
        if ($disc == NULL) {
            $disc = 1;
        }
        $disc = $this->input->post('active');
        $halal = xssclean($this->input->post('halal'));
        if ($halal == NULL) {
            $halal = 1;
        }
        $chefrecom = $this->input->post('chefrecom');
        if ($chefrecom == NULL) {
            $chefrecom = 1;
        }
        $special = xssclean($this->input->post('special'));
        if ($special == NULL) {
            $special = 1;
        }
        $favourite = $this->input->post('favourite');
        if ($favourite == NULL) {
            $favourite = 1;
        }
        $limited_stock = xssclean($this->input->post('limited_stock'));
        if ($limited_stock == NULL) {
            $limited_stock = 1;
        };
        $other_outlet = xssclean($this->input->post('other_outlet'));
        if ($other_outlet == NULL) {
            $other_outlet = 1;
        };

        $this->_validate();
        $this->_check_available('', $code, '', $name, '');

        $this->menu_model->save($code, $name, $catid, $desc, $price, $limited_stock, $stock, $min_order, $disc, $other_outlet, $halal, $chefrecom, $special, $favourite);
        $result = array(
            "status" => TRUE,
            "data" => $this->menu_model->reload_order_by_name()
        );
        echo json_encode($result);
    }

    public function delete($id)
    {
        $this->menu_model->delete_by_id($id);
        $result = array(
            "status" => TRUE,
            "data" => $this->menu_model->reload_order_by_name()
        );
        echo json_encode($result);
    }

    public function del_selected()
    {
        if ($this->input->post('id')) {
            foreach ($_POST["id"] as $id) {
                $this->menu_model->delete_by_id($id);
            }
            $result = array(
                "status" => TRUE,
                "data" => $this->menu_model->reload_order_by_name()
            );
            echo json_encode($result);
        }
    }

    public function ajax_update()
    {
        //$this->_validate();        
        //$this->_check_available(xssclean($this->input->post('old-code')), xssclean($this->input->post('code')), xssclean($this->input->post('old-loginid')), xssclean($this->input->post('loginid')), xssclean($this->input->post('old-name')), xssclean($this->input->post('name')));

        $active = $this->input->post('active');
        if ($active == NULL) {
            $active = 1;
        };
        $halal = xssclean($this->input->post('halal'));
        if ($halal == NULL) {
            $halal = 1;
        };
        $chefrecom = xssclean($this->input->post('chefrecom'));
        if ($chefrecom == NULL) {
            $chefrecom = 1;
        };
        $special = xssclean($this->input->post('special'));
        if ($special == NULL) {
            $special = 1;
        };
        $favourite = xssclean($this->input->post('favourite'));
        if ($favourite == NULL) {
            $favourite = 1;
        };
        $limited_stock = xssclean($this->input->post('limited_stock'));
        if ($limited_stock == NULL) {
            $limited_stock = 1;
        };
        $other_outlet = xssclean($this->input->post('other_outlet'));
        if ($other_outlet == NULL) {
            $other_outlet = 1;
        };

        $data = array(
            'active' => $active,
            'code' => xssclean($this->input->post('code')),
            'name' => xssclean($this->input->post('name')),
            'categoryid' => xssclean($this->input->post('catid')),
            'descriptions' => xssclean($this->input->post('desc')),
            'price' => xssclean($this->input->post('price')),
            'limited_stock' => $limited_stock,
            'stock' => xssclean($this->input->post('stock')),
            'min_order' => xssclean($this->input->post('min_order')),
            'disc' => xssclean($this->input->post('disc')),
            'order_other_outlet' => $other_outlet,
            'halal' => $halal,
            'chefrecomend' => $chefrecom,
            'special' => $special,
            'favourite' => $favourite,
            'userlast' => $this->session->id,
            'datelast' => date("Y/m/d h:i:sa")
        );
        $this->menu_model->update(array('id' => $this->input->post('id')), $data);
        $result = array(
            "status" => TRUE,
            "data" => $this->menu_model->reload_order_by_name()
        );
        echo json_encode($result);
    }

    public function ajax_edit($id)
    {
        $data = $this->menu_model->get_by_id($id);
        echo json_encode($data);
    }

    function do_upload()
    {
        $config['upload_path'] = "./assets/media/users/";
        $config['allowed_types'] = 'gif|jpg|png|bmp|jpeg';
        $config['max_size'] = 4096;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload("file")) {
            $data = array('upload_data' => $this->upload->data());
            $image = $data['upload_data']['file_name'];
            $data = $this->upload->data();
            echo $data['file_name'];
        }
    }

    public function change_property()
    {
        $row = $this->menu_model->get_by_id($this->input->post('id'));
        $this->session->set_userdata('propertyid', $row->id);
        $this->session->set_userdata('propertyname', $row->name);
        echo json_encode(array($this->session->propertyname));
    }

    function image($pid)
    {
        $data['active_menu'] = 4;
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['menu_image'] = $this->menu_model->get_image_by_id($pid);
        $row = $this->menu_model->get_by_id($pid);
        $data['title'] = "MENU IMAGES - " . $row->name;
        $data['menuid'] = $pid;
        $this->load->view('simin/menu_images_view', $data);
    }

    public function image_list($menuid)
    {

        if ($menuid == '') {
            $menuid = 0;
        }

        $list = $this->menu_images_model->get_datatables($menuid);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $image) {
            $no++;
            $row = array();
            if ($image->active == 0) {
                $row[] = '<input type="checkbox" checked="checked" name="active">';
            } else {
                $row[] = '<input type="checkbox" name="active">';
            }
            $row[] = $image->position;
            $row[] = '<img src="' . $image->image . '" height="auto" width="217px">';


            $row[] = '<a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle edit_data" title="Edit" href="javascript:void(0)" onclick="edit_img(' . "'" . $image->id . "'" . ')"><i class="flaticon-edit"></i></a>
                    <a class="btn btn-outline-hover-info btn-sm btn-icon btn-circle del_data" href="javascript:void(0)" title="Delete" onclick="delete_record(' . "'" . $image->id . "'" . ')"><i class="flaticon-delete"></i></a>';
            $row[] = '<input type="checkbox" name="id[]" class="delete_customer" value="' . $image->id . '" />';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->menu_images_model->count_all($menuid),
            "recordsFiltered" => $this->menu_images_model->count_filtered($menuid),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function get_next_pos_image($menuid)
    {
        $result = array(
            "status" => TRUE,
            "nextpos" => $this->menu_images_model->get_next_pos($menuid)
        );
        echo json_encode($result);
    }

    function add_image()
    {
        $pid = $this->input->post('menuid');
        $active = $this->input->post('active');
        if ($active == NULL) {
            $active = 1;
        }
        $pos = $this->input->post('pos');
        $img = $this->input->post('image');
        $this->menu_images_model->save($pid, $active, $pos, $img);
        $result = array(
            "status" => TRUE,
            "data" => $this->menu_images_model->reload_order_by_pos()
        );
        echo json_encode($result);
    }

    public function delete_image($id)
    {
        $this->menu_images_model->delete_by_id($id);
        $result = array(
            "status" => TRUE,
            "data" => $this->menu_images_model->reload_order_by_pos()
        );

        echo json_encode($result);
    }

    public function del_selected_image()
    {
        if ($this->input->post('id')) {
            foreach ($_POST["id"] as $id) {
                $this->menu_images_model->delete_by_id($id);
            }
            $result = array(
                "status" => TRUE,
                "data" => $this->menu_images_model->reload_order_by_pos()
            );
            echo json_encode($result);
        }
    }

    public function image_edit($id)
    {
        $data['active_menu'] = 2;
        $data['data'] = $this->menu_images_model->get_by_id($id);
        echo json_encode($data);
    }

    public function image_update()
    {
        $active = $this->input->post('active');
        if ($active == NULL) {
            $active = 1;
        }

        $data = array(
            'menuid' => $this->input->post('menuid'),
            'active' => $active,
            'position' => $this->input->post('pos'),
            'image' => $this->input->post('image')
        );
        $this->menu_images_model->update(array('id' => $this->input->post('id')), $data);
        $result = array(
            "status" => TRUE,
            "data" => $this->menu_images_model->reload_order_by_pos()
        );
        echo json_encode($result);
    }

    public function save_image()
    {
        $data = array(
            'image' => $this->input->post('image')
        );
        $this->menu_model->update(array('id' => $this->input->post('id')), $data);
        $result = array(
            "status" => TRUE,
            "data" => $this->menu_images_model->reload_order_by_pos()
        );
        echo json_encode($result);
    }

    public function submenu($id)
    {
        $menu = $this->menu_model->get_by_id($id);
        $data['select_data'] = $this->property_model->get_order_by_name();
        $data['active_menu'] = 70;
        $data['menuid'] = $id;
        $data['title'] = "SUB MENU - " . $menu->name;
        $this->load->view('simin/sub_menu_view', $data);
    }
}
