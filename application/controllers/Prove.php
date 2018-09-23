<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prove extends CI_Controller {


    public function identity()
	{

        $this->load->model('Users');
        $session = $this->session->userdata();
        $this->Users->verify($session['id']);
        $arraydata = array(
            'verified'=> 1
    );


        $this->session->set_userdata($arraydata);
        header('Location: '.base_url().'main');
        
        

    }

}
