<?php
class News_model extends MY_Model 
{
    public function __construct()
    {
        parent::__construct('news');
    }
    
    public function convert_data($data = array())
    {
        $data['image_'] = base_url('uploads/news/'.$data['image']);
        $data['get_at_'] = date('d-m-Y', $data['get_at']);
        return $data;
    }
}