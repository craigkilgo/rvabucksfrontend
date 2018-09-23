<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Codes extends CI_Model {

    public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);

    }

    public function put($data)
	{
        $this->db->insert('codes',$data);
        return true;

    }
}