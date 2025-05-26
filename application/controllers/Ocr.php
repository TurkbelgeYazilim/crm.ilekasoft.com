<?php
defined('BASEPATH') or exit('No direct script access allowed');


use Google\Cloud\Vision\VisionClient;
use furkankadioglu\eFatura\InvoiceManager;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Ocr extends CI_Controller
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


	public function index()
	{
		redirect("ocr/yuklenenDosyalar");
		/*		$data["baslik"] = "OCR / Anasayfa";

				$this->load->view('index-ocr', $data);*/
	}

	public function dosyaYukle()
	{
		$data["baslik"] = "OCR / Dosya Yükle";

		$this->load->view('ocr/dosya-yukle', $data);
	}

	public function dosyaOku()
	{
		if (!empty($_FILES['file']['name'])) {

			$anaHesap = anaHesapBilgisi();

			$file = $_FILES['file']['name'];
			$url = 'assets/ocr-img/' . $anaHesap . '';

			if (!file_exists($url))
				mkdir('assets/ocr-img/' . $anaHesap . '');

			$config['upload_path'] = $url;
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['file_name'] = $file;
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('file')) {
				$fileName = $this->upload->data('file_name');
				$uploadData = $this->upload->data();
				if ($uploadData) {
					$PATH = base_url() . 'assets/tb-ocr-343913-eb3407ba6f45.json';
					$IMG = base_url() . $url . "/" . $fileName;

					$vision = new VisionClient(['keyFile' => json_decode(file_get_contents($PATH), true)]);

					$photo = fopen($IMG, 'r');
					$image = $vision->image($photo, ['DOCUMENT_TEXT_DETECTION']);
					$annotation = $vision->annotate($image);
					$document = $annotation->fullText();

					$text = $document->text();

					$text = preg_replace("/\+/", "*", $text);

					//pattern
					$VN_PATTERN = "/(V.N.*)/";
					$VD_PATTERN = "/(V(D|O|0):.*)|(V(D|O|0):.*)|(V\.(D|O|0)\..*)|(V(D|O|0).*)|(V\.(D|O|0):.*)|(V\.0.*)|(V(D|O|0).*)|(VKN.*)|(TCKN.*)/";
					$DATE_PATTERN = '~(0[1-9]|[12][0-9]|3[01])[-/.](0[1-9]|1[012])[-/.](19|20)\d\d~';
					$FISNO_PATTERN = "/(SATIS\s.*)|(IADE\s.*)|(TEVKIFAT\s.*)|(ISTISNA\s.*)|(OZELMATRAH\s.*)/";
					$FISNO_PATTERN2 = "/((FİŞ NO :.*)|(FİŞ NO:.*)|(FIS NO :.*)|(FİS NO :.*)|(FIS NO:.*)|(FİS NO: .*)|(Fis No: .*)|(FIŞ NO:.*)|(FiS NO:.*)|(FIŞ NO\s:\s.*)|(Fatura No:\s.*)|(FIŞ NO.*))/";
					$pattern = "/((TOP|TOPLAM|NAKIT|NAKİT)(\s\*.*\s\*.*))/";
					$pattern2 = "/((TOPKDV\s\*.*)(TOPLAM\s\*.*))|(((\s\*[0-9].*)|(\s\*\s[0-9].*))|(KDV\sTOP)|(KOV\sTOP))/";
					$pattern3 = "/((KDV|KOV\s.*))/";

					preg_match_all($pattern, $text, $topkdv);

					$toplamkdv = $topkdv[0];

					if (empty($toplamkdv)) {
						preg_match_all($pattern2, $text, $topkdv);
						$toplamkdv = $topkdv[0];

						$search = array_search("KDV TOP ", $toplamkdv);
						$search2 = array_search("TOPKDV", $toplamkdv);

						if (!empty($search) || $search != null) {

							$toplamkdvReplace = str_replace(",", ".", $toplamkdv[$search + 2]);
							$toplamkdvReplace = preg_replace("/[-a-zA-Z:]|[İÜÖÇŞ]|\s|\*/", "", $toplamkdvReplace);
							$toplam = $toplamkdvReplace;


							$toplamkdvReplace = str_replace(",", ".", $toplamkdv[$search + 1]);
							$toplamkdvReplace = preg_replace("/[-a-zA-Z:]|[İÜÖÇŞ]|\s|\*/", "", $toplamkdvReplace);
							$kdv = $toplamkdvReplace;
						} else if (!empty($search2) || $search2 != null) {

							$toplamkdvReplace = str_replace(",", ".", $toplamkdv[$search2]);
							$toplamkdvReplace = preg_replace("/[-a-zA-Z:]|[İÜÖÇŞ]|\s|\*/", "", $toplamkdvReplace);
							$toplam = $toplamkdvReplace;


							$toplamkdvReplace = str_replace(",", ".", $toplamkdv[$search2 + 1]);
							$toplamkdvReplace = preg_replace("/[-a-zA-Z:]|[İÜÖÇŞ]|\s|\*/", "", $toplamkdvReplace);
							$kdv = $toplamkdvReplace;

						} else {


							preg_match("/\s([0-9].*|[A-Z].*)Not/", $text, $x);


							preg_match("/Hesaplanan KDV\(%[0-9].*\)\s([0-9].*).*/", $text, $hesaplananKDV);

							if (!empty($hesaplananKDV)) {
								$hesaplananKDV = explode(" ", $hesaplananKDV[0]);
								$hesaplananKDV = array_reverse($hesaplananKDV);
								$hesaplananKDV = str_replace(",", ".", $hesaplananKDV[1]);
								$kdv = $hesaplananKDV;

								preg_match("/Ödenecek Tutar\s.*/", $text, $odenecekTutar);
								$odenecekTutar = explode(" ", $odenecekTutar[0]);
								$odenecekTutar = array_reverse($odenecekTutar);
								$odenecekTutar = str_replace(",", ".", $odenecekTutar[1]);
								$toplam = $odenecekTutar;
							} else {
								preg_match("/[-a-zA-Z:]|[İÜÖÇŞ]|\s/", $toplamkdv[0], $metin);

								if (!empty($metin)) {
									$i = 1;
									$j = 2;
									$k = 3;
								} else {
									$i = 0;
									$j = 1;
									$k = 2;
								}
								if ($toplamkdv[$i] == $toplamkdv[$j])
									$kdv = $toplamkdv[$k];
								else
									$kdv = $toplamkdv[$i];
								$kdv = preg_replace("/[-a-zA-Z:]|[İÜÖÇŞ]|\s|\*/", "", $kdv);
								$kdv = str_replace(",", ".", $kdv);


								$toplamkdvReplace = str_replace(",", ".", $toplamkdv[$j]);
								$toplamkdvReplace = preg_replace("/[-a-zA-Z:]|[İÜÖÇŞ]|\s|\*/", "", $toplamkdvReplace);
								$toplam = $toplamkdvReplace;
							}

						}
					} else {

						$kdv = "";
						foreach ($toplamkdv as $item) {
							$toplamkdvReplace = str_replace(",", ".", $item);
							$toplamkdvReplace = preg_replace("/[-a-zA-Z:]|[İÜÖÇŞ]|\s|/", "", $toplamkdvReplace);

							$parcalanmis = explode("*", $toplamkdvReplace);
							$toplam = $parcalanmis[1];
							if ($parcalanmis[1] != $parcalanmis[2]) {
								$kdv = $parcalanmis[1];
								$toplam = $parcalanmis[2];
							}
						}
						if ($kdv == "") {
							preg_match_all($pattern3, $text, $kdvPattern);
							if (!empty($kdvPattern)) {
								$toplamkdvReplace = str_replace(",", ".", $kdvPattern[0][0]);
								$toplamkdvReplace = preg_replace("/[-a-zA-Z:]|[İÜÖÇŞ]|\s|/", "", $toplamkdvReplace);
								$parcalanmis = explode("*", $toplamkdvReplace);
								$kdv = $parcalanmis[1];

							}
						}
					}

					preg_match_all($VD_PATTERN, $text, $vkn);
					if (empty($vkn[0]))
						preg_match($VN_PATTERN, $text, $vkn);
					$vkn = $vkn[0];

					preg_match($FISNO_PATTERN2, $text, $fisno);
					if (empty($fisno[0]))
						preg_match($FISNO_PATTERN, $text, $fisno);


					preg_match($DATE_PATTERN, $text, $tarih);

					preg_match("/Fatura No:\s/", $text, $faturami);
					if (empty($faturami))
						$faturaTuru = "Fiş";
					else
						$faturaTuru = "Fatura";


					$fisno = preg_replace("((FİŞ NO :)|(FİŞ NO:)|(FIS NO :)|(FİS NO :)|(FIS NO:)|(FİS NO: )|(Fis No: )|(FIŞ NO:)|(FiS NO:)|(FIŞ NO\s:\s)|(Fatura No:\s)|(FIŞ NO)|(SATIS.*)|(IADE.*)|(TEVKIFAT.*)|(ISTISNA.*)|(OZELMATRAH.*))", "", $fisno[0]);

					$vkn = trim(preg_replace("/[-a-zA-Z:.]|(V.0.)/", " ", $vkn[0]), " ");

					//vkn/tckn sorgula
					$client = new InvoiceManager();
					$client->setCredentials("33210617", "120580");
					$client->connect();
					$vknInfo = $client->getCompanyInfo($vkn);
					if (!empty($vknInfo["data"]["unvan"]))
						$vknInfo = $vknInfo["data"]["unvan"];
					else
						$vknInfo = $vknInfo["data"]["adi"] . " " . $vknInfo["data"]["soyadi"];

					$client->logOutFromAPI();


					$control2 = session("r", "login_info");
					$u_id = $control2->kullanici_id;
					date_default_timezone_set('Europe/Istanbul');
					$tarihi = (new DateTime('now'))->format('Y.m.d');
					$saati = (new DateTime('now'))->format('H:i:s');

					$date = date_create(trim($tarih[0], " "));
					$data["ocr_dosyaAdi"] = $fileName;
					$data["ocr_faturaTarihi"] =  date_format($date, "Y/m/d");
					$data["ocr_faturaNo"] = trim($fisno, " ");
					$data["ocr_faturaTuru"] = $faturaTuru;
					$data["ocr_vknTckn"] = $vkn;
					$data["ocr_unvan"] = $vknInfo;
					$data["ocr_kdv"] = trim($kdv, " ");
					$data["ocr_toplam"] = trim($toplam, " ");
					$data["ocr_olusturan"] = $u_id;
					$data["ocr_olusturanAnaHesap"] = $anaHesap;
					$data["ocr_olusturmaTarihi"] = $tarihi;
					$data["ocr_olusturmaSaati"] = $saati;
					$this->vt->insert("ocr", $data);
					$ocrID = $this->db->insert_id();
					$this->session->set_flashdata('dosya-okundu', 'ok');
					redirect("ocr/yuklenenDosyalar");
				}
			} else {
				$this->session->set_flashdata('document_uploaded_error', 'ok');
				redirect($_SERVER['HTTP_REFERER']);
			}

		} else {
			$this->session->set_flashdata('dosya-secilmedi', 'ok');
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function dosyaGoruntule($ocrID)
	{
		$sql = "select * from ocr where ocr_id=" . $ocrID;
		$data["dosya"] = $this->db->query($sql)->row();
		$data["baslik"] = "OCR / Dosya Görüntüle";
		$this->load->view("ocr/dosya-goruntule", $data);

	}

	public function dosyaGuncelle()
	{
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;
		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');
		$anaHesap = anaHesapBilgisi();

		$ocr_id = postval("ocr_id");
		$data["ocr_vknTckn"] = postval("ocr_vknTckn");
		$data["ocr_unvan"] = postval("ocr_unvan");
		$data["ocr_faturaTarihi"] = postval("ocr_faturaTarihi");
		$data["ocr_faturaNo"] = postval("ocr_faturaNo");
		$data["ocr_kdv"] = postval("ocr_kdv");
		$data["ocr_toplam"] = postval("ocr_toplam");
		$data["ocr_olusturan"] = $u_id;
		$data["ocr_olusturanAnaHesap"] = $anaHesap;
		$data["ocr_olusturmaTarihi"] = $tarihi;
		$data["ocr_olusturmaSaati"] = $saati;

		$this->vt->update('ocr', array('ocr_id' => $ocr_id), $data);
		$this->session->set_flashdata('dosya-guncelleme', 'ok');
		redirect("ocr/yuklenenDosyalar");
	}

	public function dosyaIndir($ocrID)
	{
		$sql = "select * from ocr where ocr_id=" . $ocrID;
		$dosya = $this->db->query($sql)->row();
		$anahesap = anaHesapBilgisi();
		$image = $dosya->ocr_dosyaAdi;
		$url = base_url() . "assets/ocr-img/" . $anahesap . "/" . $image;


	}

	public function yuklenenDosyalar()
	{
		$data["baslik"] = "OCR / Yüklenen Dosyalar";
		$this->load->view('ocr/yuklenen-dosyalar', $data);
	}

	public function yuklenenDosyalarAjax()
	{
		$dataStart = '{"data": [';
		$data = '';
		$dataEnd = ']
					}';
		$firma = getirFirma();
		$deletePermission = $firma->ayarlar_deletePermission;
		$anaHesap = anaHesapBilgisi();
		$sql = "select * from ocr where ocr_olusturanAnaHesap=" . $anaHesap . "";
		$dosyalar = $this->db->query($sql)->result();
		$link = "";
		foreach ($dosyalar as $item) {
			$link = "<a href='" . base_url("ocr/dosyaGoruntule/$item->ocr_id") . "' class='btn btn-sm btn-white text-success mr-2'><i class='far fa-edit mr-1'></i> Düzenle</a>";
			$link .= "<a href='" . base_url("assets/ocr-img/$anaHesap/$item->ocr_dosyaAdi") . "' download='resim' class='btn btn-sm btn-white text-info mr-2'><i class='fa fa-download mr-1'></i> İndir</a>";

			if ($deletePermission == 1) {

				$link .= "<a href='javascript:void(0);' data-toggle='modal' data-target='#ocr_sil' class='btn btn-sm btn-white text-danger mr-2' onclick='sil(".$item->ocr_id.")'><i class='fa fa-trash-alt mr-1'></i> Sil</a>";

			}

			$data .= '{
					      "dosya": [
					        "' . $item->ocr_faturaTuru . '",
					        "' . $item->ocr_faturaTarihi . '",
					        "' . $item->ocr_faturaNo . '",
					        "' . $item->ocr_vknTckn . '",
					        "' . $item->ocr_unvan . '",
					        "' . $item->ocr_kdv . '",
					        "' . $item->ocr_toplam . '",
					        "' . $link . '"
					      ]
					      
					    },';

		}
		$data = trim($data, ",");
		echo $dataStart . $data . $dataEnd;
	}


	public function topluMmGonder()
	{
		$data = postval("data");
		$anahesap = anaHesapBilgisi();

		$sqlAyar = "select * from ayarlar where ayarlar_id=$anahesap";
		$ayarExe = $this->db->query($sqlAyar)->row();

		date_default_timezone_set('Europe/Istanbul');
		$tarih = (new DateTime('now'))->format('d.m.Y-His');

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
		$reader->setReadDataOnly(TRUE);
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->getStyle('A1:G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');

		$sheet->setCellValue('A1', 'Fatura Türü');
		$sheet->setCellValue('B1', 'Fatura Tarihi');
		$sheet->setCellValue('C1', 'Fatura Numarası');
		$sheet->setCellValue('D1', 'VKN/TCKN');
		$sheet->setCellValue('E1', 'Unvan');
		$sheet->setCellValue('F1', 'KDV');
		$sheet->setCellValue('G1', 'Toplam');
		$rows = 2;
		foreach ($data as $item) {
			$sheet->setCellValue('A' . $rows, $item["dosya"][0]);
			$sheet->setCellValue('B' . $rows, $item["dosya"][1]);
			$sheet->setCellValue('C' . $rows, $item["dosya"][2]);
			$sheet->setCellValue('D' . $rows, $item["dosya"][3]);
			$sheet->setCellValue('E' . $rows, $item["dosya"][4]);
			$sheet->setCellValue('F' . $rows, $item["dosya"][5]);
			$sheet->setCellValue('G' . $rows, $item["dosya"][6]);
			$rows++;
		}


		$writer = new Xlsx($spreadsheet);//instantiate Xlsx

		$filename = 'assets/ocr-img/ocr-' . $anahesap . '-' . $tarih . '.xlsx';
		$writer->save($filename);//download file

		$anahesap = anaHesapBilgisi();
		$sql = "select * from ocrMm where ocrMm_olusturanAnaHesap=$anahesap";
		$exe = $this->db->query($sql)->row();
		$eposta = $exe->ocrMm_eposta;

		$config = array(
			'protocol' => 'smtp',
			'smtp_crypto' => 'ssl',
			'smtp_host' => 'mail.ilekasoft.com',
			'smtp_port' => 465,
			'smtp_user' => 'mm@ilekasoft.com',
			'smtp_pass' => 'LwrX9?yqzRuG',
			'charset' => 'utf-8',
			'mailtype' => 'html',
			'wordwrap' => TRUE
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->bcc($eposta);
		$this->email->from("mm@ilekasoft.com.tr", "ilekasoft");
		//$this->email->cc("harun.pinar@turkbelge.com.tr,tevfik.yilmaz@ileka.com.tr,buse.gumusboga@turkbelge.com.tr,mine.aydin@turkbelge.com.tr");
		$this->email->subject('ilekasoft.com - Fiş / Fatura Raporu');
		$this->email->message($ayarExe->ayarlar_firmaAd . ' firmasından gelen fiş/fatura raporu ektedir.');
		$this->email->attach($filename);
		if (!$this->email->send()) {
			echo $this->email->print_debugger();

		}
		unlink($filename);
	}

	public function gibVknTcknSorgula()
	{
		$vkn = $this->input->post("vknTckn");
		$client = new InvoiceManager();
		$client->setCredentials("33210617", "120580");
		$client->connect();
		$vknInfo = $client->getCompanyInfo($vkn);
		if (!empty($vknInfo["data"]["unvan"]))
			$data["vknInfo"] = $vknInfo["data"]["unvan"];
		else
			$data["vknInfo"] = $vknInfo["data"]["adi"] . " " . $vknInfo["data"]["soyadi"];

		$client->logOutFromAPI();
		echo json_encode($data);
	}

	public function ocr_sil(){

		$id = $this->input->get("ocr_id");
		$anahesap=anaHesapBilgisi();
		$sql="select * from ocr where ocr_id=$id";
		$exe=$this->db->query($sql)->row();
		unlink("assets/ocr-img/$anahesap/$exe->ocr_dosyaAdi");
		$this->vt->del("ocr","ocr_id",$id);
		redirect("ocr/yuklenenDosyalar");
	}
}
