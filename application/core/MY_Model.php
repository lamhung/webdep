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
        $this->initialize($table);
    }
    /**
     * Initialize model
     */
    private function  initialize($table = NULL) {
        $this->CI = &get_instance();
        
        $this->CI->load->database();
        if(!is_null($table)) {
            $this->table = $this->db->dbprefix($table);
            
            $this->fields = $this->db->list_fields($this->table);
            
            $fields = $this->db->field_data($this->table);
            
            foreach ($fields as $row)
            {
                if($row->primary_key) {
                    $this->key = $row->name;
                     break;
                }
            }
        }else {
            show_error("CRUD : __construct() must have table name");
        }
    }
    /**
     * Get one row
     * @param Array OR Numberic
     * @output a row
     */
    public function get_by($conditions = array())
    {
        if(is_numeric($conditions)) {
            $this->db->where($this->key, $conditions);
        } 
        else if(is_array($conditions) && count($conditions) > 0) {
            foreach ($conditions as $field => $data)
            {
                if(!in_array($field, $this->fields)) {
                    show_error("CRUD : '$this->table' don't have in '$field'");
                }
            }
            $this->db->where($conditions);
        } 
        else {
            show_error("Method: get_by() CRUD : Param must be ARRAY OR NUMBERIC and NOT empty!");
        }
        
        $query = $this->db->get($this->table);
        return $query->row_array(); 
    }






    /**
     * Insert Data
     * @param type $input
     * @return boolean
     */
    public function insert($input = array()) {
        $data = array();
        foreach ($this->fields as $v) {
          if(isset($input[$v])) {
              $data[$v] = $input[$v];
          }  
        }
        
        return $this->db->insert($this->table, $data);
    }
    /**
     * Get Insert ID
     * @return number
     */
    public function insert_id() {
        return $this->db->insert_id();
    }
}