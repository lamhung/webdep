<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Banner extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->data['per_page'] = 10;
        $this->data['limit_short'] = 13;
    }
    
    public function index() {
        //Get config for pagination
        $config = $this->pagination_mylib->bootstrap_configs();
        $config['base_url'] = base_url('acp/banner/page');
        $config['total_rows'] = $this->banner_model->count_all();
        $config['per_page'] = $this->data['per_page'];
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        $conditions = array(
            'order' => 'id DESC',
            'limit' => $config['per_page'],
            'offset' => $this->uri->segment(4) ? ($this->uri->segment(4) - 1)*$config['per_page'] : 0
        );
        $this->data['rows'] = $this->banner_model->get_rows($conditions);
        
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/banner/index', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function search()
    {
        if($this->input->post('submit')) {
            $post = $this->input->post();
            $this->session->set_userdata('banner_search', array('keyword' => $post['keyword']));
           
        }
        $banner_search = $this->session->userdata('banner_search');
        //Query string
        $sql_like = $banner_search['keyword'] ? "(`weblink` LIKE '%".$banner_search['keyword']."%' ESCAPE '!' OR  `company` LIKE '%".$banner_search['keyword']."%' ESCAPE '!')" : '';
        //Count
        $count_all = $banner_search['keyword'] ? $this->banner_model->get_query("SELECT COUNT(id) FROM ".$this->db->dbprefix."banner WHERE $sql_like ", FALSE) : $this->banner_model->count_all(); ;
        //Pagination
        $config = $this->pagination_mylib->bootstrap_configs();
        $config['base_url'] = base_url('acp/banner/search/page');
        $config['total_rows'] = $count_all['COUNT(id)'];
        $config['per_page'] = $this->data['per_page'];
        $config['uri_segment'] = 5;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        //List
        $offset = $this->uri->segment(5) ? ($this->uri->segment(5) - 1)*$config['per_page'] : 0;
        $this->data['rows'] = $banner_search['keyword'] ? $this->banner_model->get_query("SELECT * FROM ".$this->db->dbprefix."banner WHERE $sql_like LIMIT ".$config['per_page']." OFFSET " . $offset)
                              : $this->banner_model->get_query("SELECT * FROM ".$this->db->dbprefix."banner LIMIT ".$config['per_page']." OFFSET " . $offset);
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/banner/index', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function add() {
        $this->data['row'] = $this->banner_model->default_value();
        
        if($this->input->post('submit')) {
            $post = $this->input->post();
            $this->form_validation->set_rules('weblink',$this->lang->line('user_weblink'), 'required');
            $this->form_validation->set_rules('company',$this->lang->line('user_company'), 'required');
            $this->form_validation->set_rules('posted_date',$this->lang->line('banner_posted_date'), 'required');
            $this->form_validation->set_rules('expiration_date',$this->lang->line('banner_expiration_date'), 'required');
            if($this->form_validation->run() === TRUE){
                $success = TRUE;
                //Image
                if($_FILES['image']['name'])
                {
                    $this->load->library('image_mylib');
                    $image = $this->image_mylib->upload_one('image', 'banner', NULL);
                    if($image['error'])
                    {
                        $this->data['image_error'] = $image['error'];
                        $success = FALSE;
                    }
                    else {
                        $post['file_name'] = $image['file_name'];
                        $post['orig_name'] = $image['orig_name'];
                        $post['file_size'] = $image['file_size'];
                        $post['image_width'] = $image['image_width'];
                        $post['image_height'] = $image['image_height'];
                        $post['image_type'] = $image['image_type'];
                    }
                } else {
                    $this->data['image_error'] = $this->lang->line('banner_please_select_image');
                    $success = FALSE;
                }
                if($success)
                {
                    $post['posted_date'] = strtotime($post['posted_date']);
                    $post['expiration_date'] = strtotime($post['expiration_date']);
                    $result =$this->banner_model->insert($post);
                    if($result)
                    {
                        $user_id = $this->user_model->insert_id();
                        redirect(base_url('acp/banner/show/'.$user_id));
                    }
                }
            }  
        }
        
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/banner/add', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function show($id = 0) {
        $result = $this->banner_model->get_by($id);
        if(!$result)
        {
            redirect(base_url('acp/banner'));
        }
        $this->data['row'] = $this->banner_model->convert_data($result);
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/banner/show', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function edit($id = 0) {
        $banner = $this->banner_model->get_by($id);
        if(!$banner)
        {
            redirect(base_url('acp/banner'));
        }
        
        if($this->input->post('submit')) {
            $post = $this->input->post();
            $this->form_validation->set_rules('weblink',$this->lang->line('user_weblink'), 'required');
            $this->form_validation->set_rules('company',$this->lang->line('user_company'), 'required');
            $this->form_validation->set_rules('posted_date',$this->lang->line('banner_posted_date'), 'required');
            $this->form_validation->set_rules('expiration_date',$this->lang->line('banner_expiration_date'), 'required');
            if($this->form_validation->run() === TRUE){
                $success = TRUE;
                //Image
                if($_FILES['image']['name'])
                {
                    $this->load->library('image_mylib');
                    $image = $this->image_mylib->upload_one('image', 'banner', NULL);
                    if($image['error'])
                    {
                        $this->data['image_error'] = $image['error'];
                        $success = FALSE;
                    }
                    else {
                        $post['file_name'] = $image['file_name'];
                        $post['orig_name'] = $image['orig_name'];
                        $post['file_size'] = $image['file_size'];
                        $post['image_width'] = $image['image_width'];
                        $post['image_height'] = $image['image_height'];
                        $post['image_type'] = $image['image_type'];
                        unlink(UPLOADPATH."/banner/".$banner['file_name']);
                    }
                }
                
                if($success)
                {
                    $post['id'] = $id;
                    $post['posted_date'] = strtotime($post['posted_date']);
                    $post['expiration_date'] = strtotime($post['expiration_date']);
                    $result =$this->banner_model->update($post);
                    if($result)
                    {
                        redirect(base_url('acp/banner/show/'.$id));
                    }
                }
            }  
        }
        
        
        $this->data['row'] = $this->banner_model->convert_data($banner);
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/banner/edit', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function delete($id = 0)
    {
        $user = $this->banner_model->get_by($id);
        if(!$user)
        {
            redirect(base_url('acp/banner'));
        }
        $result = $this->banner_model->delete($id);
        
        redirect(base_url('acp/banner'));

    }
}
