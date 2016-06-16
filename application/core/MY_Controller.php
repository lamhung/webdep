<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * CodeIgniter will be assigned to.
 *
 * @package	CodeIgniter
 * @subpackage	Core Controller
 * @category	My Controller
 * @author	Thanh Nguyen
 */

class MY_Controller extends CI_Controller
{
    protected $data = array();
    
    public function __construct() {
        parent::__construct();
        
        if($this->uri->segment(1) == 'acp') {
            $this->lang->load('backend');
        } else {
            $this->lang->load('frontend');
        }
        $this->data['menu_active'] = $this->router->fetch_class();
    }
}