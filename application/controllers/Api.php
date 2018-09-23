<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
class Api extends CI_Controller {

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

    }
    
    public function balance()
	{   
        $post = $this->input->post();

        $this->load->model('Users');
        $balance = $this->Users->get_balance($post['id']);
        $data['json'] = $balance;
        $this->load->view('json',$data);
	}
    
    public function charge(){

        \Stripe\Stripe::setApiKey("sk_test_rxOBhUywxHDIjhExck0Jo6uY");
        $post = $this->input->post();

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $post['stripeToken'];
        try{
        $charge = \Stripe\Charge::create([
            'amount' => $post['amount'],
            'currency' => 'usd',
            'description' => 'RVA Bucks',
            'source' => $token,
        ]);
        $this->load->model('Tx');
        $this->Tx->buy($post['uid'],$post['amount']);

        } catch(\Stripe\Error\Card $e) {
            return false;
        }



    }
}
