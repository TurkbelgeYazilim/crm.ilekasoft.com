<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Earsiv extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->model('vt');

		$control = session("r", "login");

		if (!$control) {
			redirect("check");
		}
	}

	public function WriteToArchiveExtended()
	{
		$anaHesap = anaHesapBilgisi();

		$satis_id = postval("satis_id");
		$normal = postval("normal");
		$internet = postval("internet");
		$guid = getGUID();

		if ($internet == "" && $normal == "") {
			$this->session->set_flashdata('seri_ikibos', 'OK');
			redirect($_SERVER['HTTP_REFERER']);
		} else if ($internet != "" && $normal != "") {
			$this->session->set_flashdata('seri_ikidolu', 'OK');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			if ($normal != "") {
				$seri = $normal;
			} else {
				$seri = $internet;
			}

			$satisFaturasi = $this->db->query("SELECT * FROM satisFaturasi WHERE satis_id = '$satis_id' ")->row();
			$satisFaturasiStok = $this->db->query("SELECT * FROM satisFaturasiStok WHERE satisStok_satisFaturasiID = '$satis_id' ")->result();

			$faturabanka=$this->db->query("select * from ayarlar_banka inner join faturabanka_bilgileri on ayarlarbanka_id=faturabanka_ayarbankaID where faturabanka_faturaID='$satis_id'")->result();

			$earsivTipi = "NORMAL";
			$satis_earsivTipi = $satisFaturasi->satis_earsivTipi;//1:normal 2:internet
			if ($satis_earsivTipi == 2)
				$earsivTipi = "INTERNET";

			$seriYonetimi = $this->db->query("SELECT * FROM seriYonetimi WHERE seri_id = '$seri'")->row();

			$faturaNo = $satisFaturasi->satis_faturaNo;
			$cariNo = $satisFaturasi->satis_cariID;

			$alici = $this->db->query("SELECT * FROM cari WHERE cari_id = '$cariNo'")->row();
			$cari_firmaEPosta = $alici->cari_firmaEPosta;

			$serioneki = $seriYonetimi->seri_seriOnEki;
			$seriYili = $seriYonetimi->seri_seriYili;
			$seriSiraNo = $seriYonetimi->seri_siraNo;

			$yeniFaturaNumarasi = $serioneki . "" . $seriYili . "" . sprintf('%09d', $seriSiraNo);

		}

		header('Content-type: text/json');

		$dosya = fopen("veri.xml", "w");

		$gonderici = $this->db->query("SELECT * FROM ayarlar WHERE ayarlar_id = '$anaHesap'")->row();
		$g_il = $this->db->query("SELECT * FROM iller WHERE id = '$gonderici->ayarlar_il' ")->row();
		$g_ilce = $this->db->query("SELECT * FROM ilceler WHERE id = '$gonderici->ayarlar_ilce' ")->row();

		$a_il = $this->db->query("SELECT * FROM iller WHERE id = '$alici->cari_il' ")->row();
		$a_ilce = $this->db->query("SELECT * FROM ilceler WHERE id = '$alici->cari_ilce' ")->row();

		$satis_earsivfaturaTip = $satisFaturasi->satis_earsivfaturaTip;
		$satis_earsivGonderimSekli = $satisFaturasi->satis_earsivGonderimSekli;

		if ($satis_earsivfaturaTip == 1) {
			$new_earsivFaturaTip = "SATIS";
		} else if ($satis_earsivfaturaTip == 2) {
			$new_earsivFaturaTip = "IADE";
		} else if ($satis_earsivfaturaTip == 3) {
			$new_earsivFaturaTip = "TEVKIFAT";
		} else if ($satis_earsivfaturaTip == 4) {
			$new_earsivFaturaTip = "ISTISNA";
		} else if ($satis_earsivfaturaTip == 5) {
			$new_earsivFaturaTip = "IADE";
		}

		if ($satis_earsivGonderimSekli == 1) {
			$new_earsivGonderimSekli = "KAGIT";
		} else if ($satis_earsivGonderimSekli == 2) {
			$new_earsivGonderimSekli = "ELEKTRONIK";
		}

		$LineCount = $this->db->query("SELECT COUNT(*) as total FROM satisFaturasiStok WHERE satisStok_satisFaturasiID = '$satis_id'")->row();


		$earsiv_internet = $this->db->query("SELECT * FROM earsiv_internet_bilgileri WHERE satis_id = '$satis_id' ")->row();
		if (strlen($earsiv_internet->earsiv_tasiyanvkntckn) == 10)
			$tasiyanTip = "vkn";
		else
			$tasiyanTip = "tckn";

		if ($satisFaturasi->satis_paraBirimi == "1")
			$paraBirimi = "TRY";
		if ($satisFaturasi->satis_paraBirimi == "2")
			$paraBirimi = "USD";
		if ($satisFaturasi->satis_paraBirimi == "3")
			$paraBirimi = "EUR";
		if ($satisFaturasi->satis_paraBirimi == "4")
			$paraBirimi = "GBP";

		$internetTip = array(
			"Eposta" => $earsiv_internet->earsiv_eposta,
			"Odeme_Sekli" => $earsiv_internet->earsiv_odemesekli,
			"Araci" => $earsiv_internet->earsiv_odemearaci,
			"Odeme_Tarih" => $earsiv_internet->earsiv_odemetarihi,
			"Satis_Bilgi" => $earsiv_internet->earsiv_internetsatisbilgisi,
			"Tasiyan" => $earsiv_internet->earsiv_tasiyan,
			"TasiyanTip" => $tasiyanTip,
			"Tasiyan_VKN_TCKN" => $earsiv_internet->earsiv_tasiyanvkntckn,
			"Tasiyan_Unvan" => $earsiv_internet->earsiv_tasiyanunvan,
			"Tasiyan_Tarih" => $earsiv_internet->earsiv_tasiyantarih
		);

		$xslt = "";
		if ($gonderici->ayarlar_faturaXSLT != null)
			$xslt = $gonderici->ayarlar_arsivXSLT;
		else
			$xslt = $gonderici->ayarlar_ortakXSLT;
		if ($xslt == "")
			$this->session->set_flashdata('fatura_xslt_error', 'OK');
		else {
			//General Information
			$information = array(
				"UBLVersionID" => "2.1",
				"CustomizationID" => "TR1.2",
				"ProfileID" => "EARSIVFATURA",
				"ID" => $yeniFaturaNumarasi,
				"CopyIndicator" => "false",
				"UUID" => $guid,
				"IssueDate" => date("Y-m-d"),
				"IssueTime" => date("H:i:s"),
				"InvoiceTypeCode" => $new_earsivFaturaTip,
				"Note1" => $satisFaturasi->satis_aciklama,
				"DocumentCurrencyCode" => $paraBirimi,
				"LineCountNumeric" => $LineCount->total,
				"XSLT" => $xslt);

			$gonderim_sekli = array(
				"IssueDate" => date("Y-m-d"),
				"DocumentTypeCode" => "SendingType",
				"DocumentType" => $new_earsivGonderimSekli,
			);

			$earsiv_tipi=array(
				"IssueDate" => date("Y-m-d"),
				"DocumentTypeCode" => "EArchiveType",
				"DocumentType" => $earsivTipi
			);

			//AccountingSupplierParty - Gönderici Bilgileri

			$ASP_PostalAddress_Country_Name = "Türkiye";

			//AccountingCustomerParty - Alıcı Bilgileri

			$ACP_PostalAddress_Country_Name = "Türkiye";

			$kdv = array(
				"TaxTotal_TaxScheme_Name" => "KDV",
				"TaxTotal_TaxScheme_TaxTypeCode" => "0015");
			$veri = '<Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:ns8="urn:oasis:names:specification:ubl:schema:xsd:ApplicationResponse-2" xmlns:xades="http://uri.etsi.org/01903/v1.3.2#" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2 UBL-Invoice-2.1.xsd">';

			$veri .= UBLSettings($information, $satis_id);//ubl ayarları
			$veri .= UBLAdditionalDocumentReference($gonderim_sekli);//earşiv gönderim şekli
			if($earsivTipi=="INTERNET")
				$veri .= UBLAdditionalDocumentReference($earsiv_tipi);//earşiv tipi (internet)
			$veri .= UBLSignature($information["ID"]);//ubl imza (ileka)
			$veri .= UBLAccountingSuplierParty($gonderici, $g_il->il, $g_ilce->ilce, $ASP_PostalAddress_Country_Name);//faturayı düzenleyen
			$veri .= UBLAccountingCustomerParty($alici, $a_il->il, $a_ilce->ilce, $ACP_PostalAddress_Country_Name);//faturayı alan
			if ($paraBirimi != "TRY")
				$veri .= UBLPricingExchangeRate($paraBirimi, $satisFaturasi->satis_guncelKur);//doviz kuru
			if ($satisFaturasi->satis_indirimToplam != 0)
				$veri .= UBLAllowanceCharge($satis_id, $satisFaturasi->satis_araToplam, $paraBirimi, $satisFaturasiStok);//indirim
			if($earsivTipi=="INTERNET")
				$veri .= UBLDelivery($internetTip);
			if(count($faturabanka)!=0)
				$veri .=UBLPaymentMeans($faturabanka,$paraBirimi);
			$veri .= UBLTaxTotal($satisFaturasi, $paraBirimi, $kdv);//kdv fiyatları
			$veri .= UBLWithholdingTaxTotal($satisFaturasiStok, $paraBirimi);//tevkifat
			$veri .= UBLLegalMonetaryTotal($paraBirimi, $satisFaturasi, $satisFaturasiStok);//toplam fiyatlar
			$veri .= UBLInvoiceLine($satisFaturasiStok, $paraBirimi, $kdv);//faturadaki stok satırları

			$veri .= '</Invoice>';

			$yaz = fputs($dosya, $veri);
			ini_set("soap.wsdl_cache_enabled", "0");

			$ws_archive = env(EARSIV_URL);

			$SESSION_ID = getSessionID();
			$client_archive = new SoapClient($ws_archive);

			//$RequestHeader["SESSION_ID"] = "-1";
			$RequestHeader["APPLICATION_NAME"] = env(APPLICATION_NAME);

			$content = file_get_contents(env(VERI_XML));

		
			$session=login();
			$RequestHeader["SESSION_ID"] = $session;
			

			if ($internetTip["Eposta"] != "") {
				$Request = array(
					"REQUEST_HEADER" => array(
						"SESSION_ID" => $session,
						"COMPRESSED" => "N"
					),
					"ArchiveInvoiceExtendedContent" => array(
						"INVOICE_PROPERTIES" => array(
							"EARSIV_FLAG" => "Y",
							"EARSIV_PROPERTIES" => array(
								"EARSIV_TYPE" => $earsivTipi,
								"EARSIV_EMAIL_FLAG" => "Y",
								"EARSIV_EMAIL" => $internetTip["Eposta"],
								"SUB_STATUS" => "NEW"
							),
							"INVOICE_CONTENT" => $content
						)
					)
				);
			} else {
				$Request = array(
					"REQUEST_HEADER" => array(
						"SESSION_ID" => $session,
						"COMPRESSED" => "N"
					),
					"ArchiveInvoiceExtendedContent" => array(
						"INVOICE_PROPERTIES" => array(
							"EARSIV_FLAG" => "Y",
							"EARSIV_PROPERTIES" => array(
								"EARSIV_TYPE" => $earsivTipi,
								"EARSIV_EMAIL_FLAG" => "N",
								"SUB_STATUS" => "NEW"
							),
							"INVOICE_CONTENT" => $content
						)
					)
				);
			}

			$sendF = $client_archive->WriteToArchiveExtended($Request);
			
			$error_short_des = $sendF->ERROR_TYPE->ERROR_SHORT_DES;

			if ($error_short_des == null || $error_short_des == "") {
				$updateQ = "UPDATE satisFaturasi SET satis_faturaDurum = 2 WHERE satis_id = '$satis_id'";
				$this->db->query($updateQ);

				if ($faturaNo == "") {
					$updateQ = "UPDATE satisFaturasi SET satis_faturaNo = '$yeniFaturaNumarasi',satis_GUID='$guid' WHERE satis_id = $satis_id";
					$this->db->query($updateQ);

					$seriSiraNoYeni = $seriSiraNo + 1;

					$updateQ2 = "UPDATE seriYonetimi SET seri_siraNo = '$seriSiraNoYeni' WHERE seri_id = '$seri'";
					$this->db->query($updateQ2);
				}

				$this->session->set_flashdata('fatura_gonder_ok', 'OK');
				logekle(65, 2);

			} else {

				$updateQ = "UPDATE satisFaturasi SET satis_faturaNo = '',satis_faturaDurum=1,satis_GUID=null WHERE satis_id = '$satis_id'";
				$this->db->query($updateQ);
				if (isSessionKilled($error_short_des) == 1) {
					generateNewSession();
					$this->WriteToArchiveExtended();
				} else {
					$this->session->set_flashdata('fatura_gonder_error', 'OK');

					$this->session->set_flashdata('error', $error_short_des);
				}
			}
		}
		redirect('fatura/earsiv-faturalari');
	}

	// tip=1:html ,2=xml
	public function ReadFromArchive($guid, $tip)
	{
		$ws_archive = env(EARSIV_URL);
		$SESSION_ID = getSessionID();

		$trace = true;
		$exceptions = false;

		if ($tip == 1)
			$Profile = "HTML";
		else if ($tip == 2)
			$Profile = "XML";

		$xml_array->REQUEST_HEADER->SESSION_ID = $SESSION_ID;
		$xml_array->REQUEST_HEADER->APPLICATION_NAME = env(APPLICATION_NAME);
		$xml_array->REQUEST_HEADER->COMPRESSED = 'N'; //Faturaları XML formatında sıkıştırılmadan çekmek için mutlaka COMPRESSED elemanı eklenmeli ve N değeri gönderilmelidir. Eğer gönderilmezse faturalar sıkıştırılmış/ziplenmiş olarak dönülecektir.
		$xml_array->INVOICEID = $guid; //Evrensel Tekil Tanımlama Numarası (ETTN) ile fatura okumak için kullanılabilir. GUID formatında
		$xml_array->PORTAL_DIRECTION = "OUT"; //	OUT değeri gönderilecek.
		$xml_array->PROFILE = $Profile; //faturayı almak istediğini formattır. PDF, HTML, XML değeri alabilir. XML değeri gönderilmezse faturanın imzalı UBL-TR XML dosyası dönülecektir.

		$client = new SoapClient($ws_archive, array('trace' => $trace, 'exceptions' => $exceptions));

		$response = $client->ReadFromArchive($xml_array);

		$error_short_des = $response->ERROR_TYPE->ERROR_SHORT_DES;

		if ($error_short_des == null || $error_short_des == "") {

			$a = (array)$response;
			$b = (array)$a["INVOICE"];

			if ($tip == 1)
				echo $b["_"];
			else {

				$file = "response.xml";

				file_put_contents($file, $b["_"]);
				if ((isset($file)) && (file_exists($file))) {
					header("Content-length: " . filesize($file));
					header('Content-Type: application/octet-stream');
					header('Content-Disposition: attachment; filename="' . $file . '"');
					readfile("$file");
				}
				redirect('fatura/earsiv-faturalari');
			}
		} else {

			if (isSessionKilled($error_short_des) == 1) {
				generateNewSession();
				$this->ReadFromArchive($guid, $tip);
			} else {
				$this->session->set_flashdata('fatura_goster_error', 'OK');

				$this->session->set_flashdata('error', $error_short_des);
				redirect('fatura/earsiv-faturalari');
			}
		}
	}

	public function GetEArchiveInvoiceStatus()
	{
		$ws_archive = env(EARSIV_URL);

		$SESSION_ID = getSessionID();

		$trace = true;
		$exceptions = false;

		$xml_array->REQUEST_HEADER->SESSION_ID = $SESSION_ID;
		$xml_array->REQUEST_HEADER->APPLICATION_NAME = env(APPLICATION_NAME);;
		$xml_array->UUID = '7e51beaa-27eb-4aad-ba41-f57ddce99d1e';

		$client = new SoapClient($ws_archive, array('trace' => $trace, 'exceptions' => $exceptions));

		$response = $client->GetEArchiveInvoiceStatus($xml_array);

		$error_short_des = $response->ERROR_TYPE->ERROR_SHORT_DES;
		if ($error_short_des == null || $error_short_des == "") {
			print_r($response);
		} else {
			if (isSessionKilled($error_short_des) == 1) {//session koptu anlamına gelir, yeni session üretilip yazılmalı ve tekrar denenmelidir.
				generateNewSession();
				$this->GetEArchiveInvoiceStatus();
			} else {
				print_r("hata");
			}
		}
	}

	public function CancelEArchiveInvoice()
	{
		$ws_archive = env(EARSIV_URL);
		$SESSION_ID = getSessionID();

		$trace = true;
		$exceptions = false;

		$xml_array->REQUEST_HEADER->SESSION_ID = $SESSION_ID;
		$xml_array->REQUEST_HEADER->APPLICATION_NAME = env(APPLICATION_NAME);;
		$xml_array->CancelEArsivInvoiceContent->FATURA_UUID = "ed02ae31-3088-44a2-a182-a19ac49cd73d"; //	İptal edilecek faturanın Evrensel Tekil Tanımlama Numarası (ETTN). GUID formatında  (veya FATURA_ID = İptal edilecek faturanın numarası. FYA201800000001 formatında)
		/*
		$xml_array -> CancelEArsivInvoiceContent -> UPLOAD_FLAG = ""; //	E-Arşiv platformunda bulunmayan bir faturayı iptal etmek için Y degeri gönderilmesi ve İptal Tarihi, Toplam Tutar ve Fatura Tarihi parametrelerinin doldurulması gerekir.
		$xml_array -> CancelEArsivInvoiceContent -> EARSIV_CANCEL_EMAIL = ""; //İptal edilecek e-arşiv faturasının alıcısına e-posta olarak bildirimi için kullanılacak parametre. Birden fazla e-posta adresini virgül , ile ayırarak gönderebilirsiniz. E-Posta formatında olmalıdır. (adsoyad@domain.com)
		$xml_array -> CancelEArsivInvoiceContent -> DELETE_FLAG = ""; //Sisteme yüklenmiş ama raporlanmamış bir e-Arşiv faturasını hiç raporlamamak için kullanılan parametredir. Y değeri gönderilirse fatura GİB'e hiç bir türlü raporlanmayacaktır. Silinen fatura müteselsilliği bozmamak için tekrar yüklenmelidir.
		$xml_array -> CancelEArsivInvoiceContent -> IPTAL_TARIHI = ""; //E-Arşiv platformunda bulunmayan bir faturanın iptal isteğinde gönderilecek. Faturanın iptal tarihi.
		$xml_array -> CancelEArsivInvoiceContent -> TOPLAM_TUTAR = ""; //iptal edilen faturanın ödenecek tutarı. E-Arşiv platformunda bulunmayan bir faturayı iptal ederken gönderilmelidir.
		*/

		$client = new SoapClient($ws_archive, array('trace' => $trace, 'exceptions' => $exceptions));

		$response = $client->CancelEArchiveInvoice($xml_array);
		$error_short_des = $response->ERROR_TYPE->ERROR_SHORT_DES;

		if ($error_short_des == null || $error_short_des == "") {
			print_r($response);
		} else {
			print_r("hata");
		}
	}

	public function GetEmailEarchiveInvoice()
	{
		$ws_archive = env(EARSIV_URL);

		$SESSION_ID = getSessionID();

		$trace = true;
		$exceptions = false;

		$xml_array->REQUEST_HEADER->SESSION_ID = $res->SESSION_ID;
		$xml_array->REQUEST_HEADER->APPLICATION_NAME = env(APPLICATION_NAME);;
		$xml_array->FATURA_UUID = "ed02ae31-3088-44a2-a182-a19ac49cd73d"; //E-Posta olarak iletilecek faturanın Evrensel Tekil Tanımlama Numarası (ETTN). GUID formatında.
		$xml_array->EMAIL = "yigitogluahmet123@gmail.com"; //E-Arşiv faturasının iletileceği e-posta adresi. E-Posta formatında olmalıdır. Birden fazla e-postaya göndermek için virgül (,) ile ayırarak gönderilmelidir.

		$client = new SoapClient($ws_archive, array('trace' => $trace, 'exceptions' => $exceptions));

		$response = $client->GetEmailEarchiveInvoice($xml_array);
		$error_short_des = $response->ERROR_TYPE->ERROR_SHORT_DES;

		if ($error_short_des == null || $error_short_des == "") {
			print_r($response);
		} else {
			print_r("hata");
		}
	}

	public function GetEArchiveReport()
	{
		$ws_archive = env(EARSIV_URL);
		$SESSION_ID = getSessionID();

		$trace = true;
		$exceptions = false;

		$xml_array->REQUEST_HEADER->SESSION_ID = $SESSION_ID;
		$xml_array->REQUEST_HEADER->APPLICATION_NAME = env(APPLICATION_NAME);;
		$xml_array->REPORT_PERIOD = "202012"; //Rapor listesinin alınmak istenilen dönem bilgisi. Örnek: Mayıs 2018 dönemi için 201805
		$xml_array->REPORT_STATUS_FLAG = "Y"; //Rapor durumunun sonuca eklenmesi isteniyorsa Y, değilse N değeri gönderilmelidir.

		$client = new SoapClient($ws_archive, array('trace' => $trace, 'exceptions' => $exceptions));

		$response = $client->GetEArchiveReport($xml_array);
		$error_short_des = $response->ERROR_TYPE->ERROR_SHORT_DES;

		if ($error_short_des == null || $error_short_des == "") {
			print_r($response);
		} else {
			print_r("hata");
		}
	}

	public function ReadEArchiveReport()
	{
		$ws_archive = env(EARSIV_URL);

		$SESSION_ID = getSessionID();

		$trace = true;
		$exceptions = false;

		$xml_array->REQUEST_HEADER->SESSION_ID = $SESSION_ID;
		$xml_array->REQUEST_HEADER->APPLICATION_NAME = env(APPLICATION_NAME);
		$xml_array->RAPOR_NO = "5beff342-e58a-494b-aef6-8cff8c78a004"; //Detay/içeriği çekilecek raporun IDsi. Rapor IDsine GetEArchiveReport servisini kullanarak erişebilirsiniz.

		$client = new SoapClient($ws_archive, array('trace' => $trace, 'exceptions' => $exceptions));

		$response = $client->ReadEArchiveReport($xml_array);
		$error_short_des = $response->ERROR_TYPE->ERROR_SHORT_DES;

		if ($error_short_des == null || $error_short_des == "") {
			print_r($response);
		} else {
			print_r("hata");
		}
	}
}
