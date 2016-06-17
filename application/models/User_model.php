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
    public function convert_data($data = array())
    {
        $data['image_'] = base_url('assets/backend/img/icons/no_avatar_256x256.png');
        if(isset($data['image']) && file_exists(UPLOADPATH . 'user/thumbnail/'.$data['image'])){
             $data['image_'] = base_url('uploads/user/thumbnail/'.$data['image']);
        }
        $data['gender_'] = $this->lang->line('user_gender_'.$data['gender']);
        $data['status_'] = $this->lang->line('user_status_'.$data['status']);
        $data['groups_'] = $this->lang->line('user_group_'.$data['status']);
        if(isset($data['create_at'])) {
            $data['create_at_'] = date('d-m-Y H:i', $data['create_at']);
        }
        return $data;
    }
}