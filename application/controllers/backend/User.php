<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['per_page'] = 25;
    }
    public function index() {
        //Get config for pagination
        $config = $this->pagination_mylib->bootstrap_configs();
        $config['base_url'] = base_url('acp/user/page');
        $config['total_rows'] = $this->user_model->count_all();
        $config['per_page'] = $this->data['per_page'];
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        $conditions = array(
            'order' => 'id DESC',
            'limit' => $config['per_page'],
            'offset' => $this->uri->segment(4) ? ($this->uri->segment(4) - 1)*$config['per_page'] : 0
        );
        $this->data['rows'] = $this->user_model->get_rows($conditions);
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/user/index', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function search()
    {
        if($this->input->post('submit')) {
            $post = $this->input->post();
            $this->session->set_userdata('user_search', array('keyword' => $post['keyword']));
           
        }
        $user_search = $this->session->userdata('user_search');
        //Query string
        $sql_like = $user_search['keyword'] ? "(`username` LIKE '%".$user_search['keyword']."%' ESCAPE '!' OR  `fullname` LIKE '%".$user_search['keyword']."%' ESCAPE '!')" : '';
        //Count
        $count_all = $user_search['keyword'] ? $this->user_model->get_query("SELECT COUNT(id) FROM ".$this->db->dbprefix."users WHERE $sql_like ", FALSE) : $this->user_model->count_all(); ;
        //Pagination
        $config = $this->pagination_mylib->bootstrap_configs();
        $config['base_url'] = base_url('acp/user/search/page');
        $config['total_rows'] = $count_all['COUNT(id)'];
        $config['per_page'] = $this->data['per_page'];
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        //List
        $offset = $this->uri->segment(5) ? ($this->uri->segment(5) - 1)*$config['per_page'] : 0;
        $this->data['rows'] = $user_search['keyword'] ? $this->user_model->get_query("SELECT * FROM ".$this->db->dbprefix."users WHERE $sql_like LIMIT ".$config['per_page']." OFFSET " . $offset)
                              : $this->user_model->get_query("SELECT * FROM ".$this->db->dbprefix."users LIMIT ".$config['per_page']." OFFSET " . $offset);
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/user/index', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
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
                        $this->session->set_flashdata('msg_success', $this->lang->line('user_has_been_created'));
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
            $this->session->set_flashdata('msg_error', $this->lang->line('user_not_exist'));
            redirect(base_url('acp/user'));
        }
        $this->data['row'] = $this->user_model->convert_data($result);
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/user/show', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function edit($id = 0)
    {
        $user = $this->user_model->get_by($id);
        if(!$user)
        {
            $this->session->set_flashdata('msg_error', $this->lang->line('user_not_exist'));
            redirect(base_url('acp/user'));
        }
        if($this->input->post('submit')) {
            $post = $this->input->post();
            $this->form_validation->set_rules('fullname',$this->lang->line('user_fullname'), 'required');
            $this->form_validation->set_rules('username',$this->lang->line('user_username'), 'required');
            $this->form_validation->set_rules('re_password',$this->lang->line('user_re_password'), 'matches[password]');
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
                        unlink(UPLOADPATH."/user/".$user['image']);
                        unlink(UPLOADPATH."/user/thumbnail/".$user['image']);
                    }
                }
                //continue
                if($success)
                {
                    $post['id'] = $id;
                    if($post['password'] != "") {
                        $post['password'] = md5(md5($post['password']));
                        $post['change_password'] = 1;
                    }else {
                        $post['password'] = $user['password'];
                    }

                    $result =$this->user_model->update($post);
                    if($result)
                    {
                        $this->session->set_flashdata('msg_success', $this->lang->line('user_has_been_updated'));
                        redirect(base_url('acp/user/show/'.$id));
                    }
                }
            }
        }
        
        $this->data['row'] = $this->user_model->convert_data($user);
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/user/edit', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function delete($id = 0)
    {
        $user = $this->user_model->get_by($id);
        if(!$user)
        {
            $this->session->set_flashdata('msg_error', $this->lang->line('user_not_exist'));
            redirect(base_url('acp/user'));
        }
        $result = $this->user_model->delete($id);
        
        $this->session->set_flashdata('msg_success', $this->lang->line('user_has_been_deleted'));
        redirect(base_url('acp/user'));

    }

}

