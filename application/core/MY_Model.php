<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Model Class
 *
 * CodeIgniter will be assigned to.
 *
 * @package     CodeIgniter
 * @subpackage	Core Model
 * @category	My Model
 * @author	Thanh Nguyen
 */

class MY_Model extends CI_Model
{
    protected $table = null;
    protected $key = null;
    protected $fields = array();
    protected $CI = null;
    
    /**
     * Class constructor
     *
     * @return	void
     */
    public function __construct($table = null) {
        parent::__construct();
       
    }
}