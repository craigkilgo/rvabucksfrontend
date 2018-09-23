<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tx extends CI_Model {

    public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);

    }
    
    public function buy($id,$amount){
        $data = array(
            'uid' => $id,
            'amount' => $amount,
            'payer' => $id
    );
    
    $this->db->insert('transactions', $data);
    }

    public function send($from,$to,$amount){
        //subtract
        $data = array(
            'uid' => $from,
            'amount' => -1 * $amount,
            'payer' => $to
        );
        
        $this->db->insert('transactions', $data);


        //add
        $data2 = array(
            'uid' => $to,
            'amount' => $amount,
            'payer' => $from
        );
    
        $this->db->insert('transactions', $data2);
    }


}