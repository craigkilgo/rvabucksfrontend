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

    public function add($user){
        $int = rand(1,10000);
        $cat = $user['pass'].(string)$int;
        $user['pass'] = hash('sha256',$cat);
        $user['salt'] = $int;

        $this->db->insert('users',$user);

        return true;
    }

    public function check_password($email,$password){
        $where['email'] = $email;
        $result_set = $this->db->get_where('users',$where);
        $data = $result_set->result_array();

        $supplied = hash('sha256',$password.(string)$data[0]['salt']);
        if($data[0]['pass']==$supplied){
            return true;
        }else{

            return false;
        }
    }

}