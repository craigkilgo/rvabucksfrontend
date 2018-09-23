<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model {

    public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);

	}
    
    public function get_all(){


        $result_set = $this->db->get('users');
        $data = $result_set->result_array();
        return $data;
    }

}