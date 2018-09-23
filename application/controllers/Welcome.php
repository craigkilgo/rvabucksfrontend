<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
 
        // load Session Library
        $this->load->library('session');
         
    }
 
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$session = $this->session->userdata();
		if(isset($session['token'])){
			header('Location: '.base_url().'main');
		}else{
			$this->load->view('login');
		}

	}

	public function basic(){
		$arraydata = array(
            'author_name'  => 'Bob Miller',
            'token' => '123456789'
    );
    $this->session->set_userdata($arraydata);
	header('Location: '.base_url().'main');
	}

	public function test(){

	$data['data'] = $this->session->userdata();
	$this->load->view('dump',$data);
	}

	public function logout(){
		$keys = array('author_name', 'token');
		$this->session->unset_userdata($keys);
		header('Location: '.base_url());
	}

	public function testdatabase(){

		$this->load->model('Users');
		$data['data'] = $this->Users->get_all();
		//$data['data']= 'null';
		
		$this->load->view('dump',$data);
	}

	public function signup(){
		$this->load->view('header');
		$this->load->view('signup');
	}
	
	public function signedup(){
		$post = $this->input->post();

		$this->load->model('Users');
		$users = $this->Users->get_all();
		$exist = false;
		foreach($users as $u){
			if($u['email']==$post['email']){
				$exist = true;	
			}
		}
		
		if(!$exist){
			$this->Users->add($post);
		}else{
			$this->load->view('header');
			$this->load->view('errors/user_already.php');
		}



	}


}
