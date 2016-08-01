<?php
class Image_model extends MY_Model 
{
    public function __construct()
    {
        parent::__construct('image');
    }
    
    public function convert_data($data) {
        $data['image_'] = base_url('uploads/post/'.$data['path_folder'].'/thumbnail/'.$data['raw_name'].$data['file_ext']);
        return $data;
    }

    
}
