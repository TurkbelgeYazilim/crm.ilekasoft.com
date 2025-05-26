<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Odeme extends CI_Controller
{
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

	public function index(){
		$control = session("r", "login");

		if(!$control){
			$this->session->set_flashdata('login_error','ok');
			redirect('check/basarili');
		}

		$anaHesap = anaHesapBilgisi();

		$modulID = $this->input->get("modulID");

		if(!$modulID){redirect('hata');}

		if(!isset($modulID)){redirect('hata');}

		$data["modul"] = $this->db->query("SELECT * FROM moduller WHERE modul_id = $modulID AND modul_durum = 1")->row();

		if(!$data['modul']){redirect('hata');}

		$modulVarmi = $this->db->query("SELECT * FROM firmaModulleri WHERE firmaModul_moduleID = '$modulID' AND firmaModul_firmaID = '$anaHesap' ")->row();

		if($modulVarmi){redirect('hata');}

		$ucret = $data["modul"]->modul_ucret;
		$ucretKDV = $ucret * 1.18;

		//$url = "https://payment.testdgpf.dgpaysit.com/api/Payment/"; //test
		$url = "https://aeo.ptt.gov.tr/api/Payment/"; //prod

		/*$testCards = [];
		$testCards[] = (object)['name' => 'John Doe', 'number' => "4119790166544284", 'expiry' => "04/24", 'cvv' => "961"];
		$testCards[] = (object)['name' => 'John Doe', 'number' => "4159560047417732", 'expiry' => "08/24", 'cvv' => "123"];*/

		//$apiUser = "Entegrasyon_01";  //test
		//$clientId = "1000000032";     //test
		//$apiPass = "gkk4l2*TY112";    //test

		$apiUser = "apiUser3030796";  //prod
		$clientId = "1000020693";     //prod
		$apiPass = "R5QHAY8JYV";    //prod

		$rnd = $this->newRandomString();
		$timeSpan = $this->newTimeSpan();

		$hashString = $apiPass . $clientId . $apiUser . $rnd . $timeSpan;

		$hashingbytes = hash("sha512", ($hashString), true);

		$hash = base64_encode($hashingbytes);

		$orderId = rand(100000, 999999);
		$orderIdNew = $modulID.''.$orderId;
		$amount = $ucretKDV*100; //tutarı 100 ile çarparak gönderin, 1TL için 100 gönderilmeli

		$callBackURL = "https://crm.ilekasoft.com/odeme/welcome_back/$anaHesap/$modulID/$ucretKDV";

		$post = json_encode(array(
			"clientId" => $clientId,
			"apiUser" => $apiUser,
			"Rnd" => $rnd,
			"timeSpan" => $timeSpan,
			"Hash" => $hash,
			"callbackUrl" => $callBackURL,
			"orderId" => $orderIdNew,
			"amount" => $amount,
			"currency" => 949,
			"installmentCount" => 0
		));

		//3d = threeDPayment
		//ortak ödeme = startPaymentThreeDSession
		$ch = curl_init($url."threeDPayment");
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

		$this->load->view("odeme/odeme",$data);
	}

	public function index2(){
		$anaHesap = $this->session->flashdata("anaHesap");
		$control = session("r", "login");

		if($anaHesap && !$control){
			$modulID = 999;

			$ucret = 2900;
			$ucretKDV = $ucret * 1.18;

			$url = "https://aeo.ptt.gov.tr/api/Payment/"; //prod

			$apiUser = "apiUser3030796";  //prod
			$clientId = "1000020693";     //prod
			$apiPass = "R5QHAY8JYV";    //prod

			$rnd = $this->newRandomString();
			$timeSpan = $this->newTimeSpan();

			$hashString = $apiPass . $clientId . $apiUser . $rnd . $timeSpan;

			$hashingbytes = hash("sha512", ($hashString), true);

			$hash = base64_encode($hashingbytes);

			$orderId = rand(100000, 999999);
			$amount = $ucretKDV*100; //tutarı 100 ile çarparak gönderin, 1TL için 100 gönderilmeli

			$callBackURL = "https://crm.ilekasoft.com/odeme/welcome_back/$anaHesap/$modulID/$ucretKDV";

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
			$ch = curl_init($url."threeDPayment");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
			$result = curl_exec($ch);
			curl_close($ch);

			$jd = json_decode($result);
			$ThreeDSessionId = $jd->ThreeDSessionId;

			$data["getIframeUrl"] = $url."threeDSecure/".$ThreeDSessionId;
			$data["getFormUrl"] = $url."ProcessCardForm";
			$data["ThreeDSessionId"] = $ThreeDSessionId;

			$this->load->view("satin-al",$data);
		}else{
			redirect('hata');
		}
	}

	public function validateHash($data){
		//$apiUser = "Entegrasyon_01";  //test
		//$clientId = "1000000032";     //test
		//$apiPass = "gkk4l2*TY112";    //test

		$apiUser = "apiUser3030796";  //prod
		$clientId = "1000020693";     //prod
		$apiPass = "R5QHAY8JYV";    //prod

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

	public function welcome_back($anaHesap,$modul,$ucret){
		$form_data = $this->input->raw_input_stream;
		parse_str($form_data, $response_array);

		if ($this->validateHash($response_array)) {
			if(isset($response_array['BankResponseCode']) && $response_array['BankResponseCode'] === '00'){
				date_default_timezone_set('Europe/Istanbul');
				$tarih = (new DateTime('now'))->format('Y.m.d');
				$tarihsaat = (new DateTime('now'))->format('Y.m.d H:i:s');

				$data_odeme["odeme_anaHesap"] = $anaHesap;
				$data_odeme["odeme_ucret"] = $ucret;
				$data_odeme["odeme_modul"] = $modul;
				$data_odeme["odeme_tarih"] = $tarihsaat;
				$this->vt->insert("odeme", $data_odeme);

				if($modul == 999){
					$userKim = $this->db->query("SELECT * FROM kullanicilar WHERE kullanici_anaHesapID = '$anaHesap'")->row();
					$userid = $userKim->kullanici_id;

					$data_user["kullanici_demo"] = NULL;
					$data_user["kullanici_demoSonTarihi"] = NULL;

					$this->vt->update('kullanicilar', array('kullanici_id'=>$userid), $data_user);
				}else{
					$data_modul["firmaModul_moduleID"] = $modul;
					$data_modul["firmaModul_firmaID"] = $anaHesap;
					$data_modul["firmaModul_durum"] = 1;
					$data_modul["firmaModul_tarih"] = $tarih;
					$this->vt->insert("firmaModulleri", $data_modul);
				}

				$this->session->set_flashdata('odeme_ok', 'Ödeme başarılı bir şekilde gerçekleşti, modül aktif edildi.');
				redirect("check/basarili");
			}else{
				$BankResponseCode = $response_array['BankResponseCode'];
				$BankResponseMessage = $response_array['BankResponseMessage'];
				$Error = $BankResponseCode." - ".$BankResponseMessage;

				$this->session->set_flashdata('odeme_error', $Error);
				redirect("check/basarili");
			}
		}
	}
}
