<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Get_news extends MY_Controller {
    
    protected $htmt = NULL;
    public function __construct() {
        parent::__construct();
        require_once APPPATH . 'third_party/simple_html_dom.php';
        $this->html = new Simple_html_dom();
        $this->html->load_file('http://vnexpress.net');
        $this->load->helper("MY_directory");
    }
    public function add() {
        $count = 0;
        $post = array();
        
        $directory = "news/".date("Y/m", time());
        if (!directory_exist($directory)) {
            create_directory($directory);
        }
        $records = $this->html->find('div.thumb');
        
        echo count($records);
        foreach ($records as $record) {
            $a = $record->find('a', 0);
            $img = $record->find('a img');
            
            if($img)
            {
                $html = new Simple_html_dom();
                $html->load_file($a->href);
                $titles =  $html->find("div.title_news h1");
                if($titles){
                    $post['title'] = $titles[0]->innertext;

                    $descriptions = $html->find('div.short_intro');
                    if($descriptions) {
                        $post['description'] = $descriptions[0]->innertext;
                    }

                    $contents = $html->find("div.fck_detail");
                    if($contents) {
                        $post['content'] = $contents[0]->innertext;
                    }

                    $url = $this->text_lib->clean_url($titles[0]->innertext);
                    $post['url'] = $url;
                    //Lưu hình Về  
                    $folder = UPLOADPATH.$directory.'/'.basename($img[0]->src);
                    file_put_contents($folder, file_get_contents($img[0]->src));
                    
                    $post['image'] = date("Y/m", time())."/".basename($img[0]->src);
                }
            }
            $post['get_at'] = time();
            $get_url = $this->news_model->get_by(array('url' => $url));
            if(!$get_url) {
                $this->news_model->insert($post); 
                $count += 1;
            }
            if($count >9 ){
                    break;
            }
        }
        
        redirect(base_url('acp/news'));
//        exit;
//        //$this->news_model->insert($post);
//        
//        $this->data['titles'] = $titles;
//        //$this->data['descs'] = $descs;
//        
//        
//        $this->load->view('backend/layout/header', $this->data);
//        $this->load->view('backend/news/get_news', $this->data);
//        $this->load->view('backend/layout/footer', $this->data);
    }
    
    

}
