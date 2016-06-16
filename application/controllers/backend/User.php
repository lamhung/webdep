<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
         $this->load->database();
    }

    public function add() {
        $this->data['row'] = $this->user_model->default_value();
        print_r($this->db->list_fields('users'));
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/user/add', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }

}

