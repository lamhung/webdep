<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function add() {

        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/user/add', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }

}

