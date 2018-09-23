<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prove extends CI_Controller {


    public function identity()
	{

        $user = $this->Users->get_email($session['email']);
			$arraydata = array(
				'name'  => $user['name'],
				'email'  => $user['email'],
				'username'  => $user['username'],
				'id' => $user['id'],
				'verified'=> $user['verified'],
				'exp'=> $user['exp'],
				'level'=> $user['level'],
        );
        

        $data['code'] = $this->input->get('code', TRUE);
        $data['state'] = $this->input->get('state', TRUE);

        $this->load->view('header');
        
    }

}
