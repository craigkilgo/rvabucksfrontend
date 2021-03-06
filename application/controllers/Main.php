<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

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
		$this->load->model('Users');
		$session = $this->session->userdata();
		$data['session'] = $session;
		if(!isset($session['email'])){
			header('Location: '.base_url());
		}else{
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
	

			$this->session->set_userdata($arraydata);

			$this->load->view('header',$data);
			$this->load->view('welcome_message',$data);
		}
	}
	



}
