<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Codes extends CI_Model {

    public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);

    }

    public function put($data)
	{
        $this->db->insert('codes',$data);

        $curl = curl_init();
            $api_url = 'https://api-sandbox.capitalone.com/identity/proof/tools/web-button?redirectURI=https://rvabucks.io/prove/identity';
            $api_token = 'Authorization: Bearer eyJlbmMiOiJBMTI4Q0JDLUhTMjU2IiwicGNrIjoxLCJhbGciOiJkaXIiLCJ0diI6Miwia2lkIjoicjRxIn0..H6Sw1a5Ljq8oUoTDAwU8EA._ZpzOJF4sldE310Nw8DIR26wcbRYps1s5uYUcco6kJomL3FFCpkjVoyj9I4QG1J_J6qiqD_D6meEhkyAC3f32ly1IZwo8aOhP_K20SvgBq0sS7E6a2VDwv0X1SuB3jtxNQ2QAxGYXKFUmSwD0Jnxaieeo2HXS4pGnAICAOdToF7KPIZOck6d7QQU_6pLOnlGAqzwtyW_OZx2TlQ_8woZaNwVCJJR3-PXo-y2e3KN9TcQ6mYMolI_X01I-iW7R81W1q4zrB0oYbmYAwQkwrjOZfQRXnTmoyEVRLka6hNkHBs.5XMYzb_zyyM5f6YYUlUEtg';

            curl_setopt_array($curl, array(
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => $api_url,
                CURLOPT_HTTPHEADER => array(
                $api_token,'Accept: text/html;v=1','Correlation-Id: ccid'.$session['id']
                )
            ));

            $result = curl_exec($curl);
            echo $result;

        return true;

    }
}