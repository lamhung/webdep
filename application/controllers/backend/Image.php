<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Image extends MY_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $user_login = $this->session->userdata('user_login');
        $table_name = $this->input->get('table_name') ? $this->input->get('table_name') : "";
        $table_id = $this->input->get('table_id') ? $this->input->get('table_id') : 0;
        if($this->input->post('submit')) {
            if($_FILES['images']['name'][0]) {
                $success = TRUE;
                $this->load->library('image_mylib');
                $images = $this->image_mylib->upload_multi('images', 'post/'.date("Y/m", time()), NULL,array('width' => '200', 'height' => '200'));
                foreach($images as $k => $v) {
                    if(isset($v['error'])) {
                        $this->data['image_error'] = $v['error'];
                        $success = FALSE;
                    } else {
                        $post['file_name'] = date('Y/m', time()).'/'.$v['file_name'];
                        $post['orig_name'] = $v['orig_name'];
                        $post['file_size'] = $v['file_size'];
                        $post['image_width'] = $v['image_width'];
                        $post['image_height'] = $v['image_height'];
                        $post['image_type'] = $v['image_type'];
                        $post['raw_name'] = $v['raw_name'];
                        $post['file_ext'] = $v['file_ext'];
                        $post['path_folder'] = date('Y/m', time());
                        $post['user_id'] = $user_login['id'];
                        $post['table_name'] = $table_name;
                        $post['table_id'] = $table_id;
                        $result = $this->image_model->insert($post);
                    }
                }
            }
            
            
        }
        $condition = array(
            'order' => 'id DESC',
            'where' => "table_name = '".$table_name."' AND table_id = ".$table_id." AND user_id = ".$user_login['id']
        );
        $this->data['rows'] = $this->image_model->get_rows($condition);
        
        $this->load->view('backend/image/index', $this->data);
    }
    
    public function ajax_deleteImage(){
        if($this->input->post('image_id')) {
            $image = $this->image_model->get_by($this->input->post('image_id'));
            $result = $this->image_model->delete($this->input->post('image_id'));
            if ($result) {
                unlink(UPLOADPATH . 'post/' . $image['file_name']);
                unlink(UPLOADPATH . 'post/'.$image['path_folder'].'/thumbnail/'.$image['raw_name'].$image['file_ext']);
            }
        }
    }
}


