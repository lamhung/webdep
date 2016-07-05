<?php

class Category_model extends MY_Model {

    public function __construct() {
        parent::__construct('category');
    }

    public function default_value() {
        return array(
            'id' => NULL,
            'name' => '',
            'url' => '',
            'ordinal' => '',
            'category_group_id' => ''
            
        );
    }
    
    public function convert_data($data = array()) {
            $category_group = $this->category_group_model->get_by($data['category_group_id']);
            $data['category_group'] = $category_group ? $category_group['name'] : "";
            
            return $data;
    }

}
