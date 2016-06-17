<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function add() {
        $this->data['row'] = $this->user_model->default_value();
        
        if($this->input->post('submit')) {
            $post = $this->input->post();
            $this->form_validation->set_rules('fullname',$this->lang->line('user_fullname'), 'required');
            $this->form_validation->set_rules('username',$this->lang->line('user_username'), 'required');
            $this->form_validation->set_rules('password',$this->lang->line('user_password'), 'required');
            $this->form_validation->set_rules('re_password',$this->lang->line('user_re_password'), 'required|matches[password]');
            $this->form_validation->set_rules('email',$this->lang->line('user_email'), 'required|valid_email');
            
            if($this->form_validation->run() === TRUE){
                $success = TRUE;
                //Image
                if($_FILES['image']['name'])
                {
                    $this->load->library('image_mylib');
                    $image = $this->image_mylib->upload_one('image', 'user', NULL, array('width'=>256, 'height'=>256));
                    if($image['error'])
                    {
                        $this->data['image_error'] = $image['error'];
                        $success = FALSE;
                    }
                    else {
                        $post['image'] = $image['file_name'];
                    }
                }
                if($success)
                {
                    $post['password'] = md5(md5($post['password']));
                    $post['change_password'] = 1;
                    $post['create_at'] = time();

                    $result =$this->user_model->insert($post);
                    if($result)
                    {
                        $user_id = $this->user_model->insert_id();
                        redirect(base_url('acp/user/show/'.$user_id));
                    }
                }
            }
            
        }
        
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/user/add', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function show($id = 0) {
        $result = $this->user_model->get_by($id);
        if(!$result)
        {
            redirect(base_url('acp/user'));
        }
        $this->data['row'] = $this->user_model->convert_data($result);
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/user/show', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }

}

