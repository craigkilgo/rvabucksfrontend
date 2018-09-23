<?php

$curl = curl_init();
        $api_url = 'https://api-sandbox.capitalone.com/oauth2/token';
        $api_token = 'Authorization: Basic dHNwcG1vOkhmZWltZmQxd29BTENzYVJv';


        curl_setopt_array($curl, array(
            CURLOPT_POST => 1,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POSTFIELDS => $data_string,
            CURLOPT_URL => $api_url,
            CURLOPT_HTTPHEADER => array(
            $api_token,
            '',
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))
        ));

        $result = curl_exec($curl);
        $epics = json_decode($result, true);


        ?>