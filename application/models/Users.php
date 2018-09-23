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

        if(count($data)==0){
            return false;
        }
        $supplied = hash('sha256',$password.(string)$data[0]['salt']);
        if($data[0]['pass']==$supplied){
            return true;
        }else{

            return false;
        }
    }
    public function get_email($email){
        $where['email'] = $email;
        $result_set = $this->db->get_where('users',$where);
        $data = $result_set->result_array();
        if(count($data)==0){
            return null;
        }
        
        return $data[0];

    }
    public function get_exp($exp){
        $where['exp'] = $exp;
        $result_set = $this->db->get_where('users',$where);
        $data = $result_set->result_array();
        if(count($data)==0){
            return null;
        }
        
        return $data[0];

    }
    public function get_id($id){
        $where['id'] = $id;
        $result_set = $this->db->get_where('users',$where);

        $data = $result_set->result_array();
        if(count($data)==0){
            return null;
        }
        
        return $data[0];

    }

    public function get_un($username){
        $where['username'] = $username;
        $result_set = $this->db->get_where('users',$where);
        
        $data = $result_set->result_array();
        if(count($data)==0){
            return null;
        }
        
        return $data[0];

    }

    public function get_balance($uid){
        $where['uid'] = $uid;
        $this->db->select_sum('amount');
        $result_set = $this->db->get_where('transactions',$where);
        $data = $result_set->result_array();
        if(count($data)==0){
            return null;
        }
        return $data[0];

    }

}