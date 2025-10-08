<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Playground extends CI_Controller
{
	
	public function __construct(){
		parent::__construct();
		//error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->model('vt');
	}

	public function yukle1(){
		$ch_turu = '';
		$ch_aciklama = '';
		$spreadsheet = new Spreadsheet();

		$inputFileName  =   FCPATH.'assets/rest-2.xlsx';
		$inputFileType = 'Xlsx';

		$reader = IOFactory::createReader($inputFileType);

		$spreadsheet = $reader->load($inputFileName);
		$worksheet = $spreadsheet->getActiveSheet();
		$rows = $worksheet->toArray();

		$data['ch_olusturan'] = 161;
		$data['ch_olusturanAnaHesap'] = 148;
		$data['ch_olusturmaTarihi'] = '2022-07-19';
		$data['ch_olusturmaSaati'] = '10:49:00';

		foreach($rows as $key => $value){
			foreach($value as $iter => $column_value){
				if($iter == 0){//Fis No
					$data['ch_belgeNumarasi'] = $column_value;
					//echo $data['ch_belgeNumarasi']."<br>";
				}

				else if($iter == 1){ //Hareket Tipi
					$ch_turu = $column_value;
					
					if($ch_turu == "Banka"){
						$data['ch_turu'] = 26;
					}else if($ch_turu == "Devir"){
						$data['ch_turu'] = 14;
					}else if($ch_turu == "Evrak"){
						$data['ch_turu'] = 15;
					}else if($ch_turu == "Fatura"){
						$data['ch_turu'] = 16;
					}else if($ch_turu == "Fatura Kapali"){
						$data['ch_turu'] = 17;
					}else if($ch_turu == "İade"){
						$data['ch_turu'] = 18;
					}else if($ch_turu == "İrsaliye"){
						$data['ch_turu'] = 19;
					}else if($ch_turu == "Kasa"){
						$data['ch_turu'] = 20;
					}else if($ch_turu == "Kredi Kartı"){
						$data['ch_turu'] = 21;
					}else if($ch_turu == "Müşteri Çeki"){
						$data['ch_turu'] = 22;
					}else if($ch_turu == "Pos"){
						$data['ch_turu'] = 23;
					}else if($ch_turu == "Servis Fişi"){
						$data['ch_turu'] = 24;
					}else if($ch_turu == "Servis Fişi Kapali"){
						$data['ch_turu'] = 25;
					}else{
						$data['ch_turu'] = NULL;
					}
					
				}

				else if($iter == 2){ //Borc
					if($column_value != '0'){
						$data['ch_borc'] = $column_value;
					}else{
						$data['ch_borc'] = NULL;
					}
				}

				else if($iter == 3){ //Alacak
					if($column_value != '0'){
						$data['ch_alacak'] = $column_value;
					}else{
						$data['ch_alacak'] = NULL;
					}
				}

				else if($iter == 4){//Aciklama
					$ch_aciklama = $column_value;
				}
				
				else if($iter == 5){//Cari Kod
					$cari_kod = $column_value;
					if($cari_kod){
						$cariQ = $this->db->query("SELECT cari_id FROM cari WHERE cari_kodu = '$cari_kod' AND cari_olusturanAnaHesap = 148")->row();
						if($cariQ){
							$data['ch_cariID'] = $cariQ->cari_id;
						}else{
							$data['ch_cariID'] = NULL;
						}
					}else{
						$data['ch_cariID'] = NULL;
					}
				}
				
				else if($iter == 7){//Kayit Tarihi
					$data['ch_tarih'] = $column_value;
				}
				
				$data['ch_aciklama'] = $ch_turu." - ".$ch_aciklama;
				
				
			}
			
			//print_r($data);die;
			$this->vt->insert("cariHareketleri", $data);
		}
		
	}

	public function newRandomString($length = 12){
		return $this->rnd = rand(1, 10000); //substr(sha1(rand()), 0, $length);
	}

	public function newTimeSpan($date = null){
		return $this->timeSpan = date("YmdHis", $date ?: time());
	}

	/*public function getFormParams($id, $name, $cardNumber, $expiry, $cvv)
	{
		return [
			'ThreeDSessionId' => $id,
			'CardHolderName' => $name,
			'CardNo' => $cardNumber,
			'ExpireDate' => $expiry,
			'Cvv' => $cvv,
		];
	}*/

	public function ptt(){
		$url = "https://payment.testdgpf.dgpaysit.com/api/Payment/"; //test
		//$url = "https://aeo.ptt.gov.tr/api/Payment/"; //prod

		$testCards = [];
		$testCards[] = (object)['name' => 'John Doe', 'number' => "4119790166544284", 'expiry' => "04/24", 'cvv' => "961"];
		$testCards[] = (object)['name' => 'John Doe', 'number' => "4159560047417732", 'expiry' => "08/24", 'cvv' => "123"];

		$apiUser = "Entegrasyon_01";
		$clientId = "1000000032";
		$apiPass = "gkk4l2*TY112";

		$rnd = $this->newRandomString();
		$timeSpan = $this->newTimeSpan();

		$hashString = $apiPass . $clientId . $apiUser . $rnd . $timeSpan;

		$hashingbytes = hash("sha512", ($hashString), true);

		$hash = base64_encode($hashingbytes);

		$callBackURL = "https://crm.ilekasoft.com/Playground/welcome_back";

		$orderId = rand(100000, 999999);
		$amount = 100; //tutarı 100 ile çarparak gönderin, 1TL için 100 gönderilmeli

		$post = json_encode(array(
			"clientId" => $clientId,
			"apiUser" => $apiUser,
			"Rnd" => $rnd,
			"timeSpan" => $timeSpan,
			"Hash" => $hash,
			"callbackUrl" => $callBackURL,
			"orderId" => $orderId,
			"amount" => $amount,
			"currency" => 949,
			"installmentCount" => 0
		));

		//3d = threeDPayment
		//ortak ödeme = startPaymentThreeDSession
		$ch = curl_init($url."startPaymentThreeDSession");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		$result = curl_exec($ch);
		curl_close($ch);

		$jd = json_decode($result);
		$ThreeDSessionId = $jd->ThreeDSessionId;

		/* $card = $testCards[0];

		$params = $this->getFormParams($ThreeDSessionId, $card->name, $card->number, $card->expiry, $card->cvv);

		$ch2 = curl_init($url."ProcessCardForm");
		curl_setopt($ch2, CURLOPT_POST, 1);
		curl_setopt($ch2, CURLOPT_POSTFIELDS, json_encode($params));
		curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch2, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
		$result2 = curl_exec($ch2);
		curl_close($ch2);

		print_r($result2); */

		$data["getIframeUrl"] = $url."threeDSecure/".$ThreeDSessionId;
		$data["getFormUrl"] = $url."ProcessCardForm";
		$data["ThreeDSessionId"] = $ThreeDSessionId;

		$this->load->view("playground",$data);
	}

	public function validateHash($data){
		$apiUser = "Entegrasyon_01";
		$clientId = "1000000032";
		$apiPass = "gkk4l2*TY112";

		$HashParameters =  $data['HashParameters'];

		if (isset($HashParameters)) {
			$keys = explode(",", $HashParameters);

			$extra = ['ClientId' => $clientId, 'ApiUser' => $apiUser];

			$hashString = $apiPass;

			foreach ($keys as $key) {
				$hashString .= isset($extra[$key]) ? $extra[$key] : $data[$key];
			}

			$hashingbytes = hash("sha512", ($hashString), true);

			return $data['Hash'] === base64_encode($hashingbytes);
		}
	}

	public function welcome_back(){
		$form_data = $this->input->raw_input_stream;
		parse_str($form_data, $response_array);

		if ($this->validateHash($response_array)) {
			//V033 : 3D Kullanıcı Doğrulama Adımı Başarılı
			if(isset($response_array['BankResponseCode']) && $response_array['BankResponseCode'] === 'V033'){
				echo "ok";
			}else{
				return false;
			}
		}
	}
}
