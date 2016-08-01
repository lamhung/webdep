<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class  Product extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['per_page'] = 25;
    }
    
    public function index() {
        //Get config for pagination
        $config = $this->pagination_mylib->bootstrap_configs();
        $config['base_url'] = base_url('acp/product/page');
        $config['total_rows'] = $this->product_model->count_all();
        $config['per_page'] = $this->data['per_page'];
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        $conditions = array(
            'order' => 'id DESC',
            'limit' => $config['per_page'],
            'offset' => $this->uri->segment(4) ? ($this->uri->segment(4) - 1)*$config['per_page'] : 0
        );
        $this->data['rows'] = $this->product_model->get_rows($conditions);
        
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/product/index', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function add() {
        $this->data['row'] = $this->product_model->default_value();
        
        if($this->input->post('submit')) {
            $post = $this->input->post();
            $this->form_validation->set_rules('category_group_id',$this->lang->line('category_group'), 'required');
            $this->form_validation->set_rules('category_id',$this->lang->line('category'), 'required');
            $this->form_validation->set_rules('title',$this->lang->line('product_title'), 'required');
            if($this->form_validation->run() === TRUE){
                $success = TRUE;
                //Image
                if($_FILES['image']['name'])
                {
                    $this->load->library('image_mylib');
                    $image = $this->image_mylib->upload_one('image', 'product', NULL,array('width' => 193, 'height' => 120));
                    if($image['error'])
                    {
                        $this->data['image_error'] = $image['error'];
                        $success = FALSE;
                    }
                    else {
                        $post['image'] = $image['file_name'];
                    }
                }
                $user_login = $this->session->userdata('user_login');
                if($success)
                {
                    $post['create_at'] = time();
                    $post['user_id'] = $user_login['id'];
                    $post['url'] = $this->text_lib->clean_url($post['title']);
                    $result =$this->product_model->insert($post);       
                    if($result)
                    {
                        $this->session->set_flashdata('msg_success', $this->lang->line('product_has_been_created'));
                        $product_id = $this->user_model->insert_id();
                        $dieuken = array(
                            'table_id' => 0,
                            'user_id' => $user_login['id'],
                            'table_name'=> 'product',
                        );
                        $post_image = array();
                        $post_image['table_id'] = $product_id;
                        $image = $this->image_model->update($post_image, $dieuken);
                        redirect(base_url('acp/product/show/'.$product_id));
                    }
                }
            }  
        }
       
        $this->data['category_groups'] =  $this->category_group_model->get_rows(array('order_by' => 'id ASC' ));
        if($this->input->post('category_group_id')){
            $this->data['categories'] = $this->category_model->get_rows(array('where' => 'category_group_id = '.$this->input->post('category_group_id')));
        }
        
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/product/add', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function show($id = 0) {
        $result = $this->product_model->get_by($id);
        if(!$result)
        {
            $this->session->set_flashdata('msg_error', $this->lang->line('product_not_exist'));
            redirect(base_url('acp/product'));
        }
        $this->data['row'] = $this->product_model->convert_data($result);

        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/product/show', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
     
    public function edit($id = 0) {
        $result = $this->product_model->get_by($id);
        if(!$result)
        {
            $this->session->set_flashdata('msg_error', $this->lang->line('product_not_exist'));
            redirect(base_url('acp/product'));
        }
        
        if($this->input->post('submit')) {
            $post = $this->input->post();
            $this->form_validation->set_rules('category_group_id',$this->lang->line('category_group'), 'required');
            $this->form_validation->set_rules('category_id',$this->lang->line('category'), 'required');
            $this->form_validation->set_rules('title',$this->lang->line('product_title'), 'required');
            if($this->form_validation->run() === TRUE){
                $success = TRUE;
                //Image
                if($_FILES['image']['name'])
                {
                    $this->load->library('image_mylib');
                    $image = $this->image_mylib->upload_one('image', 'product', NULL, array('width' => 193, 'height' => 120));
                    if($image['error'])
                    {
                        $this->data['image_error'] = $image['error'];
                        $success = FALSE;
                    }
                    else {
                        $post['image'] = $image['file_name'];
                        if(isset($result['image'])) {
                            unlink(UPLOADPATH.'product/'.$result['image']);
                            unlink(UPLOADPATH.'product/thumbnail/'.$result['image']);
                        }
                    }
                }
                
                $user_login = $this->session->userdata('user_login');
                if($success)
                {
                    $post['id'] = $id;
                    $post['create_at'] = time();
                    $post['user_id'] = $user_login['id'];
                    $post['url'] = $this->text_lib->clean_url($post['title']);
                    $result =$this->product_model->update($post);
                    if($result)
                    {
                        $this->session->set_flashdata('msg_success', $this->lang->line('product_has_been_update'));
                        redirect(base_url('acp/product/show/'.$id));
                    }
                }
            }  
        }
       
        $this->data['category_groups'] =  $this->category_group_model->get_rows(array('order_by' => 'id ASC' ));
        
        $category_group_id = $this->input->post('category_group_id') ? $this->input->post('category_group_id') : $result['category_group_id'];
        $this->data['categories'] = $this->category_model->get_rows(array('where' => 'category_group_id = '.$category_group_id));
        
        $this->data['row'] = $this->product_model->convert_data($result);
        
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/product/edit', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function delete($id = 0)
    {
        $product = $this->product_model->get_by($id);
        if(!$product)
        {
            $this->session->set_flashdata('msg_error', $this->lang->line('product_not_exist'));
            redirect(base_url('acp/product'));
        }
        
        $result = $this->product_model->delete($id);
        
        $image = $this->image_model->get_by(array('table_id' => $id));
        $image_del = $this->image_model->delete(array('table_id' => $id));
        if($image_del){
            unlink(UPLOADPATH . 'post/' . $image['file_name']);
            unlink(UPLOADPATH . 'post/'.$image['path_folder'].'/thumbnail/'.$image['raw_name'].$image['file_ext']);
        }
        
        $this->session->set_flashdata('msg_success', $this->lang->line('product_has_been_deleted'));
        redirect(base_url('acp/product'));

    }
    
    public function ajax_get_category(){
        $this->data['row'] = $this->product_model->default_value();
        if($this->input->post('category_group')){
            $this->data['categories'] = $this->category_model->get_rows(array('where' => 'category_group_id = '.$this->input->post('category_group')));
            $this->load->view('backend/product/category',$this->data);
        }else {
            echo "<option value=''>-- ".$this->lang->line('category_group_select')."--</option>";
        }  
    }
    
    
 }