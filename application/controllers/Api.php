<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
include('phpqrcode.php');
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
        $this->Tx->buy($post['uid'],$post['full_amount']);

        } catch(\Stripe\Error\Card $e) {
            return false;
        }



    }

    public function makecharge(){

        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }
        
        $post = $this->input->post();
        $id = $post['id'];
        $amount = $post['amount'];
        $chargeString = $id.'-'.$amount.'-'.generateRandomString();
        
        $data['json']['string'] = $chargeString;

        $this->load->model('Charges');
        $this->Charges->insert($chargeString);

        $this->load->view('json',$data);



    }

    public function qr($charge){
        $data['qr'] = $charge;
        $this->load->view('qr',$data);
    }

    public function payuser(){
        $this->load->model('Tx');
        $this->load->model('Charges');
        $this->load->model('Users');
        $post = $this->input->post();

        if($post['chargestring'] !=''){
            $chargeArr = explode("-",$post['chargestring']);
            $from = $post['id'];
            $to = $chargeArr[0];
            $amount = $chargeArr[1];
            $token = $chargeArr[2];
            $this->Tx->send($from,$to,$amount);

            $this->Charges->markpaid($token);

            $payee = $this->Users->get_id($to);

            $data['json']['payee'] = $payee['name'];
            $data['json']['amount'] = $amount;
            $this->load->view('json',$data);
        }else{
            $payee = $this->Users->get_un($post['username']);
            $from = $post['id'];
            $to = $payee['id'];
            $amount = $post['amount'];

            $this->Tx->send($from,$to,$amount);
            
            $data['json']['payee'] = $payee['name'];
            $data['json']['amount'] = $amount;
            
            $this->load->view('json',$data);
        }


    }
}
