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
		if(isset($session['email'])){
			header('Location: '.base_url().'main');
		}else{
			$data['error'] = null;
			$this->load->view('login',$data);
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
		$keys = array('name', 'email','username','id','verified');
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
			$arraydata = array(
				'name'  => $user['name'],
				'email'  => $user['email'],
				'username'  => $user['username'],
				'id' => $user['id'],
				'verified'=> $user['verified']
		);

		$this->session->set_userdata($arraydata);
			header('Location: '.base_url().'main');
		}else{
			$this->load->view('header');
			$this->load->view('errors/user_already.php');
		}

	}


	public function attemptLogin(){
		$post = $this->input->post();
		$this->load->model('Users');

		$check = $this->Users->check_password($post['email'],$post['pass']);

		if(!$check){
			$data['error'] = 'Username/password combination did not work.';
			$this->load->view('login',$data);
		}else{
			$user = $this->Users->get_email($post['email']);
			$arraydata = array(
				'name'  => $user['name'],
				'email'  => $user['email'],
				'username'  => $user['username'],
				'id' => $user['id'],
				'verified'=> $user['verified']
		);
		$data['data']['arraydata'] = $arraydata;
		$data['data']['user'] = $user;

		$this->session->set_userdata($arraydata);


		header('Location: '.base_url().'main');
		//	$this->load->view('dump',$data);
		}
	}

}
