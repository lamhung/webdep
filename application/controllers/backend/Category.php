<?php
defined("BASEPATH") OR exit('No direct script access allowed');

class Category extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->data['per_page'] = 10;
    }
    
    public function add() {
        $this->data['row'] = $this->category_model->default_value();
        
        if($this->input->post('submit')) {
            $post = $this->input->post();
            $this->form_validation->set_rules('category_group_id',$this->lang->line('category_group'), 'required');
            $this->form_validation->set_rules('name',$this->lang->line('category_name'), 'required|is_unique[category.name]');
            $this->form_validation->set_rules('ordinal',$this->lang->line('category_ordinal'), 'numeric');
            if($this->form_validation->run() === TRUE){
                $post['url'] = $this->text_lib->clean_url($post['name']);
                $post['ordinal'] = $post['ordinal'] ? $post['ordinal'] : $this->category_model->next_id();
                $result =$this->category_model->insert($post);
                if($result)
                {
                    $this->session->set_flashdata('msg_success', $this->lang->line('category_has_been_created'));
                    $category_id = $this->category_model->insert_id();
                    redirect(base_url('acp/category/show/'.$category_id));
                }
            }  
        }
        
        $this->data['category_groups'] = $this->category_group_model->get_rows(array('order_by' => 'id'));
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/category/add', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
}