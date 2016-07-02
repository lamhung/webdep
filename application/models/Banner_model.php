<?php
class Banner_model extends MY_Model 
{
    public function __construct()
    {
        parent::__construct('banner');
    }
    
    public function default_value() {
        return array(
            'id' => NULL,
            'orig_name' => '',
            'file_name' => '',
            'file_size' => '',
            'image_width' => '',
            'image_height' => '',
            'image_type' => '',
            'weblink' => '',
            'company' => '',
            'posted_date' => '',
            'expiration_date' => '',
            'posted_date_' => '',
            'expiration_date_' => '',
            'position_place' => '',
            'image_' => base_url('assets/backend/img/icons/no_avatar_256x256.png')
        );
    }
    
    public function convert_data($data = array())
    {
        $data['image_'] = base_url('uploads/banner/'.$data['file_name']);
        $data['file_size_'] = $data['file_size']." kb";
        $data['image_width_'] = $data['image_width']." px";
        $data['image_height_'] = $data['image_height']." px";
        $data['image_type_'] = $data['image_type'];
        $data['posted_date_'] = date('d-m-Y', $data['posted_date']);
        $data['expiration_date_'] = date('d-m-Y', $data['expiration_date']);
        return $data;
    }
}
