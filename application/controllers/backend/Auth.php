<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    private $data = array();
    
    public function __construct() {
        parent::__construct();
        $this->lang->load('backend');
    }
    
    public function login() {
        $user_login = $this->session->userdata('user_login');
        if($user_login)
        {
            redirect(base_url('acp'));
        }
        $this->data['msg'] = '';
        
        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('u', $this->lang->line('auth_user'), 'required');
            $this->form_validation->set_rules('p', $this->lang->line('auth_pass'), 'required');
            $post = $this->input->post();
            
            if ($this->form_validation->run() == TRUE)
            {
                $result = $this->user_model->backend_login($post);
                if($result['success'])
                {
                    //Loading
                    $current_uri = $this->session->userdata('current_uri');
                    $url = $current_uri ? base_url($current_uri) : base_url('acp');
                    $this->load->view('backend/auth/loading', array('msg' => $this->lang->line('auth_login_to_system'), 'url' => $url));
                    return true;
                }
                else
                {
                    $this->data['msg'] = $result['msg'];
                } 
            }    
        }
        
        $this->load->view('backend/auth/login', $this->data);
    }
    
    public function logout() {
        $this->user_model->logout();
        redirect(base_url('acp/login'));
    }
    
    public function change_password()
    {
        $user_login = $this->session->userdata('user_login');
        if($user_login['change_pass'] == 0)
        {
            redirect(base_url('acp'));
        }
        
        $this->data['msg'] = $this->lang->line('auth_change_password_message');
        if($this->input->post('submit'))
        {
            $this->form_validation->set_rules('p1', $this->lang->line('auth_current_pasword'), 'required');
            $this->form_validation->set_rules('p2', $this->lang->line('auth_new_password'), 'required');
            $this->form_validation->set_rules('p3', $this->lang->line('auth_confirm_password'), 'required|matches[p2]');
            if ($this->form_validation->run() == TRUE)
            {
                $post = $this->input->post();
                $result = $this->user_model->change_password($post['p1'], $post['p2']);
                
                if($result['success'])
                {
                    $url = $current_uri ? base_url($current_uri) : base_url('acp');
                    redirect($url);
                }
                else
                {
                     $this->data['msg'] = "<small class='help-block' style='color:red;'>".$result['msg']."</small>";
                }
            }
        }
        $this->load->view('backend/auth/change_password', $this->data);
    }
    
    public function deny()
    {
        $this->load->view('backend/auth/deny', $this->data);
    }
}