<?php

class Category_group_model extends MY_Model {

    public function __construct() {
        parent::__construct('category_group');
    }

    public function default_value() {
        return array(
            'id' => NULL,
            'name' => '',
            'url' => '',
            'ordinal' => ''
            
        );
    }

}
