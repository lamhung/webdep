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
            'ordinal' => ''
            
        );
    }

}
