<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Charges extends CI_Model {

    public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);

    }
    
    public function insert($string){

        $stringArr = explode("-",$string);
        $data = array(
            'payee' => $stringArr[0],
            'amount' => $stringArr[1],
            'token' => $stringArr[2]
        );
        $this->db->insert('charges', $data);
    }

}