<?php
class User_model extends MY_Model 
{
    public function __construct()
    {
        parent::__construct('users');
    }
    
    public function default_value()
    {
        return array(
            'id' => NUll,
            'fullname' => '',
            'username' => '',
            'group' => '0',
            'image_' => base_url('assets/backend/img/icons/no_avatar_256x256.png'),
            'phone' => '',
            'email' => '',
            'address' => '',
            'gender' => 1,
            'birthday' => '',
            'status' => 1
        );
    }
}