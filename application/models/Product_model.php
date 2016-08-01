<?php
class Product_model extends MY_Model 
{
    public function __construct()
    {
        parent::__construct('product');
    }
    
    public function default_value() {
        return array(
            'id' => NULL,
            'title' => '',
            'link_web' => '',
            'url' => '',
            'description' => '',
            'content' => '',
            'create_at' => '',
            'user_id' => '',
            'category_group_id' => '',
            'category_id' => '',
            'image_' => base_url('assets/backend/img/icons/clipping_pictures.png')
        );
    }
    
    public function convert_data($data = array()) {
        if($data['image'] != NULL) {
        $data['image_'] = base_url('uploads/product/thumbnail/'.$data['image']);
        }else {
          $data['image_']  = base_url('assets/backend/img/icons/clipping_pictures.png');
        }
        $category_group = $this->category_group_model->get_by($data['category_group_id']);
        $data['category_group'] = $category_group ? $category_group['name'] : "";
        $category = $this->category_model->get_by($data['category_id']);
        $data['category'] = $category ? $category['name'] : "";
        $data['create_at_'] = date('d/m/Y' , $data['create_at']);
        return $data;
    }
}