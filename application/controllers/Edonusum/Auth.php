<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

  public function __construct(){
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->model('vt');
		
		$control = session("r", "login");
		
		if(!$control){
			redirect("check");
		}
	}

/*	public function login(){
		$ws = 'https://authenticationws.turkbelge.com.tr/AuthenticationWS?wsdl';

		$trace = true;
		$exceptions = false;

		$xml_array -> REQUEST_HEADER -> SESSION_ID  = '-1';
    	$xml_array -> REQUEST_HEADER -> APPLICATION_NAME  = 'ilekasoftCRMDemo';
		$xml_array -> USER_NAME = "4710710430";
		$xml_array -> PASSWORD = "ileka321";
		

		try{
			$client = new SoapClient($ws, array('trace' => $trace, 'exceptions' => $exceptions));

			var_dump($client->__getFunctions());
			var_dump($client->__getTypes());
			//print("<pre>".print_r($client->__getTypes(),true)."</pre>");

			$response = $client->Login($xml_array);

	$session_ID=$response->SESSION_ID;

		echo $session_ID;

			//echo $response->faultstring;
		}catch (SoapFault $e){
			echo "Error!";
			echo $e -> getMessage ();
			echo 'Last response: '. $client->__getLastResponse();
		}
	}*/
	
	public function GetGibUserList(){

		$ws=env(AUTH_URL);

		$trace = true;
		$exceptions = false;

	//	$xml_array -> REQUEST_HEADER -> SESSION_ID  = '165bb355-73f4-4c36-b349-708257774b85';
   		$xml_array -> REQUEST_HEADER -> APPLICATION_NAME  = 'ilekasoftCRMDemo';
   		$xml_array -> ALIAS_TYPE = "GB";
   		//$xml_array -> ALIAS_MODIFY_DATE  = '2021-08-20';

		$client = new SoapClient($ws, array('trace' => $trace, 'exceptions' => $exceptions));

		$response = $client->GetGibUserList($xml_array);

		$raspuns = ($client->__getLastResponse());
		
		$file = "response.xml";
		file_put_contents($file,$raspuns);

		$b64 = "response.txt";
		$dom = new DomDocument();
		$dom->load("response.xml");

		$data = $dom->getElementsByTagName("CONTENT");

		foreach($data as $a) {$nv = $a->nodeValue;}

		$catchb64 = $nv;
		file_put_contents($b64,$catchb64);

		$input_file = "response.txt";
		$output_file = "result.zip";
		$content = file_get_contents($input_file);
		$binary = base64_decode($content);
		file_put_contents($output_file,$binary);
	}
	

 public function CheckUser(){
	 $data = $this->input->post();

	 $vergiNumarasi = $data["vergiNumarasi"];

	 $ws = env('AUTH_URL');

	 $trace = true;
	 $exceptions = false;

	 $xml_array -> REQUEST_HEADER -> SESSION_ID  = getSessionID();
	 $xml_array -> REQUEST_HEADER -> APPLICATION_NAME  = env('APPLICATION_NAME');
	 $xml_array -> USER -> IDENTIFIER = $vergiNumarasi; //Mükellefiyeti sorgulanacak firmanın vergi kimlik numarası
	 $xml_array -> DOCUMENT_TYPE = "INVOICE"; //	Mükelleffiyet kontrol edilecek ürün tipi. E-Fatura için INVOICE, E-İrsaliye için DESPATCHADVICE gönderilmelidir.

	 $client = new SoapClient($ws, array('trace' => $trace, 'exceptions' => $exceptions));

	 $response = $client->CheckUser($xml_array);

	 $error_short_des= $response->ERROR_TYPE->ERROR_SHORT_DES;
	 if(isSessionKilled($error_short_des) == 1){//session koptu anlamına gelir, yeni session üretilip yazılmalı ve tekrar denenmelidir.
		 generateNewSession();
		 $this->CheckUser();
	 }else{//session devam eder, normal prosedür devam et.
		 $dataf = (array)$response;
		 $dataff["identifier"] = $dataf["USER"][0]->IDENTIFIER;
		 $dataff["alias"] = $dataf["USER"][0]->ALIAS;
		 $dataff["title"] = $dataf["USER"][0]->TITLE;
		echo json_encode($dataff);
	 }
 }

}
