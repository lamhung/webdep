<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->data['per_page'] = 25;
        $this->data['limit_short'] = 13;
    }
    
    public function index() {
        //Get config for pagination
        $config = $this->pagination_mylib->bootstrap_configs();
        $config['base_url'] = base_url('acp/news/page');
        $config['total_rows'] = $this->news_model->count_all();
        $config['per_page'] = $this->data['per_page'];
        $config['uri_segment'] = 4;
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config);
        $conditions = array(
            'order' => 'id DESC',
            'limit' => $config['per_page'],
            'offset' => $this->uri->segment(4) ? ($this->uri->segment(4) - 1)*$config['per_page'] : 0
        );
        $this->data['rows'] = $this->news_model->get_rows($conditions);
        
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/news/index', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function show($id = 0) {
        $result = $this->news_model->get_by($id);
        if(!$result)
        {
            redirect(base_url('acp/news'));
        }
        $this->data['row'] = $this->news_model->convert_data($result);
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/news/show', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function edit($id = 0) {
        $news = $this->news_model->get_by($id);
        if(!$news)
        {
            redirect(base_url('acp/news'));
        }
        
        if($this->input->post('submit')) {
            $post = $this->input->post();
            $this->form_validation->set_rules('title',$this->lang->line('news_title'), 'required');
            $this->form_validation->set_rules('description',$this->lang->line('news_description'), 'required');
            $this->form_validation->set_rules('content',$this->lang->line('news_content'), 'required');
            if($this->form_validation->run() === TRUE){
                $success = TRUE;
                //Image
                if($_FILES['image']['name'])
                {
                    $this->load->library('image_mylib');
                    $image = $this->image_mylib->upload_one('image', 'news/'.date("Y/m", time()), NULL);
                    if($image['error'])
                    {
                        $this->data['image_error'] = $image['error'];
                        $success = FALSE;
                    }
                    else {
                        $post['image'] = date("Y/m", time()).'/'.$image['file_name'];
                        unlink(UPLOADPATH."news/".$news['image']);
                    }
                }
                
                if($success)
                {
                    $post['id'] = $id;
                    $post['get_at'] = time();
                    $result =$this->news_model->update($post);
                    if($result)
                    {
                        redirect(base_url('acp/news/show/'.$id));
                    }
                }
            }  
        }
        
        
        $this->data['row'] = $this->news_model->convert_data($news);
        $this->load->view('backend/layout/header', $this->data);
        $this->load->view('backend/news/edit', $this->data);
        $this->load->view('backend/layout/footer', $this->data);
    }
    
    public function delete($id = 0)
    {
        $user = $this->news_model->get_by($id);
        if(!$user)
        {
            redirect(base_url('acp/news'));
        }
        $result = $this->news_model->delete($id);
        
        redirect(base_url('acp/news'));

    }
}