<?php
defined('BASEPATH') or exit('No direct script access allowed');


use furkankadioglu\eFatura\InvoiceManager;
use furkankadioglu\eFatura\Models\Invoice;
use furkankadioglu\eFatura\Interaktif;


class Modul extends CI_Controller
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
		//sessionKontrolHelper();
	}

	public function modulAyar($modul)
	{
		$modulQ = "SELECT * FROM moduller WHERE modul_link = '$modul'";
		$modulExe = $this->db->query($modulQ)->row();
		$data["baslik"] = $modulExe->modul_ad . " Modül Ayarları";
		$data["modul"] = $modulExe;


		$this->load->view("modul/modul-ayar", $data);
	}

	public function efaturaModulGuncelle(){
		$modulID = postval("ma_modulID");
		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		//şablonlar ayarlar tablosuna ekle
		if (isset($_FILES["efaturaXSLT"])) {
			if ($_FILES['efaturaXSLT']['size'] != 0 && $_FILES['efaturaXSLT']['error'] == 0){
				$tmp_name = $_FILES["efaturaXSLT"]["tmp_name"];
				$name = $_FILES["efaturaXSLT"]["name"];

				echo $tmp_name;
				$file_path = 'assets/bulut/sablonlar/' . $name;
				if (move_uploaded_file($tmp_name, $file_path)) {
					$myfile = fopen($file_path, "r") or die("Dosya açılamıyor!");
					$dosya = fread($myfile, filesize($file_path));
					$dataAyar["ayarlar_faturaXSLT"] = base64_encode($dosya);
					fclose($myfile);

				} else {
					$dataAyar["ayarlar_faturaXSLT"] = null;
				}
				unlink($tmp_name);

				$this->vt->update('ayarlar', array('ayarlar_id' => $anaHesap), $dataAyar);
			}
		}

		if (isset($_FILES["earsivXSLT"])) {
			if ($_FILES['earsivXSLT']['size'] != 0 && $_FILES['earsivXSLT']['error'] == 0){
				$tmp_name = $_FILES["earsivXSLT"]["tmp_name"];
				$name = $_FILES["earsivXSLT"]["name"];
				$file_path = 'assets/bulut/sablonlar/' . $name;
				if (move_uploaded_file($tmp_name, $file_path)) {
					$myfile = fopen($file_path, "r") or die("Dosya açılamıyor!");
					$dosya = fread($myfile, filesize($file_path));
					$dataAyar["ayarlar_arsivXSLT"] = base64_encode($dosya);
					fclose($myfile);

				} else {
					$dataAyar["ayarlar_arsivXSLT"] = null;
				}
				unlink($tmp_name);

				$this->vt->update('ayarlar', array('ayarlar_id' => $anaHesap), $dataAyar);
			}
		}

		if (isset($_FILES["ortakXSLT"])) {
			if ($_FILES['eirsaliyeXSLT']['size'] != 0 && $_FILES['eirsaliyeXSLT']['error'] == 0){
				$tmp_name = $_FILES["ortakXSLT"]["tmp_name"];
				$name = $_FILES["ortakXSLT"]["name"];
				$file_path = 'assets/bulut/sablonlar/' . $name;
				if (move_uploaded_file($tmp_name, $file_path)) {
					$myfile = fopen($file_path, "r") or die("Dosya açılamıyor!");
					$dosya = fread($myfile, filesize($file_path));
					$dataAyar["ayarlar_ortakXSLT"] = base64_encode($dosya);
					fclose($myfile);

				} else {
					$dataAyar["ayarlar_ortakXSLT"] = null;
				}
				unlink($tmp_name);

				$this->vt->update('ayarlar', array('ayarlar_id' => $anaHesap), $dataAyar);
			}
		}

		//modul ayarları
		$data["ma_modulID"] = $modulID;
		$data["ma_entegrator"] = postval("efatura_entegrator");
		$data["ma_olusturanAnaHesap"] = $anaHesap;
		$data["ma_olusturmaTarihi"] = $tarihi;
		$data["ma_olusturmaSaati"] = $saati;
		$data["ma_efaturaUsername"] = postval("efatura_kullaniciadi");
		$data["ma_efaturaSifre"] = postval("efatura_sifre");

		$sorgulaQ = "SELECT * FROM modulAyarlari WHERE ma_modulID = '$modulID' AND ma_olusturanAnaHesap = '$anaHesap'";
		$sorgulaExe = $this->db->query($sorgulaQ)->row();

		//hesabın efatura modülü kayıtlı ise güncelle değil ise kaydet

		if ($sorgulaExe) {
			$this->vt->update('modulAyarlari', array('ma_olusturanAnaHesap' => $anaHesap, 'ma_modulID' => $modulID), $data);

		} else {
			$this->vt->insert("modulAyarlari", $data);
		}

		$kullanici = session("r", "login_info");
		$kullaniciID = $kullanici->kullanici_id;

		generateNewSession();

		$this->session->set_flashdata('efatura_ok', 'OK');
		redirect('modul/ayarlar/efatura');
	}

	public function eirsaliyeModulGuncelle(){
		$modulID = postval("ma_modulID");
		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		if (isset($_FILES["eirsaliyeXSLT"])) {
			if ($_FILES['eirsaliyeXSLT']['size'] != 0 && $_FILES['eirsaliyeXSLT']['error'] == 0){
				$tmp_name = $_FILES["eirsaliyeXSLT"]["tmp_name"];
				$name = $_FILES["eirsaliyeXSLT"]["name"];
				$file_path = 'assets/bulut/sablonlar/' . $name;
				if (move_uploaded_file($tmp_name, $file_path)) {
					$myfile = fopen($file_path, "r") or die("Dosya açılamıyor!");
					$dosya = fread($myfile, filesize($file_path));
					$dataAyar["ayarlar_irsaliyeXSLT"] = base64_encode($dosya);
					fclose($myfile);

				} else {
					$dataAyar["ayarlar_irsaliyeXSLT"] = null;
				}
				unlink($tmp_name);

				$this->vt->update('ayarlar', array('ayarlar_id' => $anaHesap), $dataAyar);
			}
		}

		if (isset($_FILES["eirsaliyeYanitXSLT"])) {
			if ($_FILES['eirsaliyeYanitXSLT']['size'] != 0 && $_FILES['eirsaliyeYanitXSLT']['error'] == 0){
				$tmp_name = $_FILES["eirsaliyeYanitXSLT"]["tmp_name"];
				$name = $_FILES["eirsaliyeYanitXSLT"]["name"];
				$file_path = 'assets/bulut/sablonlar/' . $name;
				if (move_uploaded_file($tmp_name, $file_path)) {
					$myfile = fopen($file_path, "r") or die("Dosya açılamıyor!");
					$dosya = fread($myfile, filesize($file_path));
					$dataAyar["ayarlar_irsaliyeYanitXSLT"] = base64_encode($dosya);
					fclose($myfile);

				} else {
					$dataAyar["ayarlar_irsaliyeYanitXSLT"] = null;
				}
				unlink($tmp_name);

				$this->vt->update('ayarlar', array('ayarlar_id' => $anaHesap), $dataAyar);
			}
		}

		//modul ayarları
		$data["ma_modulID"] = $modulID;
		$data["ma_entegrator2"] = postval("eirsaliye_entegrator");
		$data["ma_olusturanAnaHesap"] = $anaHesap;
		$data["ma_olusturmaTarihi"] = $tarihi;
		$data["ma_olusturmaSaati"] = $saati;
		$data["ma_eirsaliyeUsername"] = postval("eirsaliye_kullaniciadi");
		$data["ma_eirsaliyeSifre"] = postval("eirsaliye_sifre");

		$sorgulaQ = "SELECT * FROM modulAyarlari WHERE ma_modulID = '$modulID' AND ma_olusturanAnaHesap = '$anaHesap'";
		$sorgulaExe = $this->db->query($sorgulaQ)->row();

		if ($sorgulaExe) {
			$this->vt->update('modulAyarlari', array('ma_olusturanAnaHesap' => $anaHesap, 'ma_modulID' => $modulID), $data);

		} else {
			$this->vt->insert("modulAyarlari", $data);
		}

		generateNewSessionizi();

		$this->session->set_flashdata('efatura_ok', 'OK');
		redirect('modul/ayarlar/eirsaliye');
	}

	public function gibModulGuncelle()
	{
		$modulID = postval("ma_modulID");
		$gib_username = postval("gib_kullaniciadi");
		$gib_sifre = postval("gib_sifre");

		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$data["ma_modulID"] = $modulID;
		$data["ma_entegrator"] = postval("efatura_entegrator");
		$data["ma_olusturanAnaHesap"] = $anaHesap;
		$data["ma_olusturmaTarihi"] = $tarihi;
		$data["ma_olusturmaSaati"] = $saati;
		$data["ma_gibUsername"] = $gib_username;
		$data["ma_gibSifre"] = $gib_sifre;

		$sorgulaQ = "SELECT * FROM modulAyarlari WHERE ma_modulID = '$modulID' AND ma_olusturanAnaHesap = '$anaHesap'";
		$sorgulaExe = $this->db->query($sorgulaQ)->row();
		if ($sorgulaExe) {
			$this->vt->update('modulAyarlari', array('ma_olusturanAnaHesap' => $anaHesap, 'ma_modulID' => $modulID), $data);
		} else {
			$this->vt->insert("modulAyarlari", $data);
			//modul ilk kaydedildiğinde gib ten 6 aylık düzenlenen faturaları çeker sisteme ekler
			$endDate = date("d-m-Y");
			$startDate = date("d-m-Y", strtotime('-6 month', strtotime($endDate)));

			$client = new InvoiceManager();
			$client->setCredentials($gib_username, $gib_sifre);
			$client->connect();
			$invoices = $client->getInvoicesFromAPI($startDate, $endDate);
			$invoices = $invoices["data"];
			$klasorYol = "assets/gib/$gib_username";

			if (!file_exists($klasorYol))
				mkdir("assets/gib/" . $gib_username);

			foreach ($invoices as $item) {
				$invoice = $item["ettn"];
				$oldInvoice = new Invoice();
				$oldInvoice->setUuid($invoice);
				$client->setInvoice($oldInvoice)->getInvoiceFromAPI();

				$downloadUrl = $client->getDownloadURL(null, true);

				$file = "assets/gib/" . $gib_username . "/" . $invoice . '.zip';
				file_put_contents($file, fopen($downloadUrl, 'r'));
				header("Content-length: " . filesize($file));
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="' . $file . '"');
				readfile("$file");
			}
			$client->logOutFromAPI();
		}

		$this->session->set_flashdata('efatura_ok', 'OK');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function ocrModulGuncelle()
	{
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$anahesap = anaHesapBilgisi();

		$this->vt->del("ocrMm", "ocrMm_olusturanAnaHesap", $anahesap);
		$mmEposta = postval("mmEposta");
		$data["ocrMm_olusturan"] = $u_id;
		$data["ocrMm_olusturanAnaHesap"] = $anahesap;
		$data["ocrMm_olusturmaTarihi"] = $tarihi;
		$data["ocrMm_olusturmaSaati"] = $saati;
		$eposta = "";
		foreach ($mmEposta as $item) {
			$eposta .= $item . ",";
		}
		$data["ocrMm_eposta"] =trim($eposta,",");
		$this->db->insert("ocrMm", $data);

		$this->session->set_flashdata('efatura_ok', 'OK');
		redirect('modul/ayarlar/ocr');
	}

	public function moduller()
	{
		$data["baslik"] = "Modüller";
		$this->load->view("modul/moduller", $data);
	}

	public function sablonIndir($secenek)
	{
		$anaHesap = anaHesapBilgisi();
		$ayarlarSql = "select ayarlar_faturaXSLT,ayarlar_arsivXSLT,ayarlar_irsaliyeXSLT,ayarlar_ortakXSLT,ayarlar_irsaliyeYanitXSLT from ayarlar where ayarlar_id=$anaHesap";
		$ayarlarExe = $this->db->query($ayarlarSql)->row();
		$sablon = "";
		$xslt = "";
		if ($secenek == 1) {
			$xslt = $ayarlarExe->ayarlar_faturaXSLT;
		} else if ($secenek == 2) {
			$xslt = $ayarlarExe->ayarlar_arsivXSLT;
		} else if ($secenek == 3) {
			$xslt = $ayarlarExe->ayarlar_irsaliyeXSLT;
		} else if ($secenek == 4) {
			$xslt = $ayarlarExe->ayarlar_ortakXSLT;
		} else if ($secenek == 5) {
			$xslt = $ayarlarExe->eirsaliyeYanitXSLT;
		}
		$sablon = base64_decode($xslt);

		$file = "sablon.xslt";
		file_put_contents($file, $sablon);
		if ((isset($file)) && (file_exists($file))) {

			header("Content-length: " . filesize($file));
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename="' . $file . '"');
			readfile("$file");
		}
		redirect('modul/ayarlar/efatura');
	}

}
