<?php
defined("BASEPATH") OR exit('No direct script access allowed');

class Category_group extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->data['per_page'] = 10;
    }
    
    public function index() {
        //Get config for pagination
        $config = $this->pagination_mylib->bootstrap_configs();
        $config['base_url'] = base_url('acp/category_group/page');
        $config['total_rows'] = $this->category_group_model->count_all();
        $config['per_page'] = $this->data['per_page'];
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        $conditions = array(
            'order' => 'id DESC',
            'limit' => $config['per_page'],
            'offset' => $this->uri->segment(4) ? ($this->uri->segment(4) - 1)*$config['per_page'] : 0
        );
        $this->data['rows'] = $this->category_group_model->get_rows($conditions);
        
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/category_group/index', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function add() {
        $this->data['row'] = $this->category_group_model->default_value();
        
        if($this->input->post('submit')) {
            $post = $this->input->post();
            $this->form_validation->set_rules('name',$this->lang->line('category_group_name'), 'required|is_unique[category_group.name]');
            $this->form_validation->set_rules('ordinal',$this->lang->line('category_group_ordinal'), 'numeric');
            if($this->form_validation->run() === TRUE){
                $post['url'] = $this->text_lib->clean_url($post['name']);
                $post['ordinal'] = $post['ordinal'] ? $post['ordinal'] : $this->category_group_model->next_id();
                $result =$this->category_group_model->insert($post);
                if($result)
                {
                    $this->session->set_flashdata('msg_success', $this->lang->line('category_group_has_been_created'));
                    $category_id = $this->category_group_model->insert_id();
                    redirect(base_url('acp/category_group/show/'.$category_id));
                }
            }  
        }
        
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/category_group/add', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function show($id = 0) {
        $result = $this->category_group_model->get_by($id);
        if(!$result)
        {
            $this->session->set_flashdata('msg_error', $this->lang->line('category_group_not_exist'));
            redirect(base_url('acp/category_group'));
        }
        $this->data['row'] = $result;
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/category_group/show', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function edit($id = 0) {
        $category = $this->category_group_model->get_by($id);
        if(!$category)
        {
            $this->session->set_flashdata('msg_error', $this->lang->line('category_group_not_exist'));
            redirect(base_url('acp/category_group'));
        }
        
        if($this->input->post('submit')) {
            $post = $this->input->post();
            $set_name = $post['name'] == $category['name'] ? "required" : "required|is_unique[category_group.name]";
            $this->form_validation->set_rules('name',$this->lang->line('category_group_name'), $set_name);
            $this->form_validation->set_rules('ordinal',$this->lang->line('category_group_ordinal'), 'numeric');
            if($this->form_validation->run() === TRUE){
                $post['url'] = $this->text_lib->clean_url($post['name']);
                $post['ordinal'] = $post['ordinal'] ? $post['ordinal'] : $this->category_group_model->next_id();
                $post['id'] = $id;
                $result =$this->category_group_model->update($post);
                if($result)
                {
                    $this->session->set_flashdata('msg_success', $this->lang->line('category_group_has_been_updated'));
                    redirect(base_url('acp/category_group/show/'.$id));
                }
            }  
        }
        $this->data['row'] = $category;
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/category_group/edit', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function delete($id = 0)
    {
        $user = $this->category_group_model->get_by($id);
        if(!$user)
        {
            $this->session->set_flashdata('msg_error', $this->lang->line('category_group_not_exist'));
            redirect(base_url('acp/category_group'));
        }
        $result = $this->category_group_model->delete($id);
        
        $this->session->set_flashdata('msg_error', $this->lang->line('category_group_has_been_deleted'));
        redirect(base_url('acp/category_group'));

    }
    
}