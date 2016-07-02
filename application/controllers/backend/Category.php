<?php
defined("BASEPATH") OR exit('No direct script access allowed');

class Category extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->data['per_page'] = 10;
    }
    
    public function index() {
        //Get config for pagination
        $config = $this->pagination_mylib->bootstrap_configs();
        $config['base_url'] = base_url('acp/category/page');
        $config['total_rows'] = $this->category_model->count_all();
        $config['per_page'] = $this->data['per_page'];
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        $conditions = array(
            'order' => 'id DESC',
            'limit' => $config['per_page'],
            'offset' => $this->uri->segment(4) ? ($this->uri->segment(4) - 1)*$config['per_page'] : 0
        );
        $this->data['rows'] = $this->category_model->get_rows($conditions);
        
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/category/index', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function add() {
        $this->data['row'] = $this->category_model->default_value();
        
        if($this->input->post('submit')) {
            $post = $this->input->post();
            $this->form_validation->set_rules('name',$this->lang->line('category_name'), 'required|is_unique[category.name]');
            $this->form_validation->set_rules('ordinal',$this->lang->line('category_ordinal'), 'numeric');
            if($this->form_validation->run() === TRUE){
                $post['url'] = $this->text_lib->clean_url($post['name']);
                $post['ordinal'] = $post['ordinal'] ? $post['ordinal'] : $this->category_model->next_id();
                $result =$this->category_model->insert($post);
                if($result)
                {
                    $category_id = $this->category_model->insert_id();
                    redirect(base_url('acp/category/show/'.$category_id));
                }
            }  
        }
        
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/category/add', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function show($id = 0) {
        $result = $this->category_model->get_by($id);
        if(!$result)
        {
            redirect(base_url('acp/category'));
        }
        $this->data['row'] = $result;
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/category/show', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function edit($id = 0) {
        $category = $this->category_model->get_by($id);
        if(!$category)
        {
            redirect(base_url('acp/category'));
        }
        
        if($this->input->post('submit')) {
            $post = $this->input->post();
            $set_name = $post['name'] == $category['name'] ? "required" : "required|is_unique[category.name]";
            $this->form_validation->set_rules('name',$this->lang->line('category_name'), $set_name);
            $this->form_validation->set_rules('ordinal',$this->lang->line('category_ordinal'), 'numeric');
            if($this->form_validation->run() === TRUE){
                $post['url'] = $this->text_lib->clean_url($post['name']);
                $post['ordinal'] = $post['ordinal'] ? $post['ordinal'] : $this->category_model->next_id();
                $post['id'] = $id;
                $result =$this->category_model->update($post);
                if($result)
                {
                    redirect(base_url('acp/category/show/'.$id));
                }
            }  
        }
        $this->data['row'] = $category;
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/category/edit', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function delete($id = 0)
    {
        $user = $this->category_model->get_by($id);
        if(!$user)
        {
            redirect(base_url('acp/category'));
        }
        $result = $this->category_model->delete($id);
        
        redirect(base_url('acp/category'));

    }
    
}