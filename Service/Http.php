<?php

namespace CiviCoop\DrupalLoginBundle\Service;

use CiviCoop\DrupalLoginBundle\Model\Response;

class Http
{    
    public function performPostRequest($siteUrl, $data)
    {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $siteUrl);
		curl_setopt($curl, CURLOPT_POST, 1); // Do a regular HTTP POST
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data)); // Set POST data
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		
		$data = curl_exec($curl);
		
		$http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		// Check if login was successful
		if ($http_code == 200) {
			// Convert json response as array
			$data = json_decode($data);
		} else {
			// Get error msg
			$error = curl_error($curl);
		}
		
		$response = new Response($http_code, $data);
		return $response;
    }
}