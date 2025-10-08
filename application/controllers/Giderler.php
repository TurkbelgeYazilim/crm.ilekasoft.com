<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Google\Cloud\Vision\VisionClient;
use furkankadioglu\eFatura\InvoiceManager;

class Giderler extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->model('vt');

		$control = session("r", "login");


		if (gibYetki() == 1)
			redirect("home/hata");

		if (!$control) {
			redirect("check");
		}
		//sessionKontrolHelper();
	}

	public function giderKategorileri()
	{
		$data["baslik"] = "Giderler / Gider Türleri";
		$anaHesap = anaHesapBilgisi();

		$giderKategorileriQ = "SELECT * FROM giderKategorileri WHERE gk_olusturanAnaHesap = '$anaHesap' AND gk_mainID IS NULL";
		$data["giderKategorileri"] = $this->db->query($giderKategorileriQ)->result();

		$this->load->view("giderler/gider-turleri", $data);
	}

	public function yeniGiderKategorisiEkle()
	{
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d H:i:s');

		$data["gk_adi"] = postval("gk_adi");
		$data["gk_olusturan"] = $u_id;
		$data["gk_olusturanAnaHesap"] = $anaHesap;
		$data["gk_olusturmaTarihi"] = $tarihi;

		$this->vt->insert("giderKategorileri", $data);
		$this->session->set_flashdata('gk_ok', 'OK');
		logekle(57, 2);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function mevcutGiderKategorisiDuzenle()
	{
		$gk_id = postval("gk_id");

		$data["gk_adi"] = postval("gk_adi");

		$this->vt->update('giderKategorileri', array('gk_id' => $gk_id), $data);
		$this->session->set_flashdata('gk_updt_ok', 'OK');
		logekle(57, 3);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function altGiderKategorisiEkle()
	{
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d H:i:s');

		$data["gk_adi"] = postval("gk_alt_adi");
		$data["gk_mainID"] = postval("gk_id");
		$data["gk_olusturan"] = $u_id;
		$data["gk_olusturanAnaHesap"] = $anaHesap;
		$data["gk_olusturmaTarihi"] = $tarihi;

		$this->vt->insert("giderKategorileri", $data);
		$this->session->set_flashdata('gk_alt_ok', 'OK');
		logekle(57, 2);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function giderEkle()
	{
		$data["baslik"] = "Giderler / Gider Ekle";
		$anaHesap = anaHesapBilgisi();

		$giderKategorileriQ = "SELECT * FROM giderKategorileri WHERE gk_olusturanAnaHesap = '$anaHesap' AND gk_mainID IS NULL";
		$data["giderKategorileri"] = $this->db->query($giderKategorileriQ)->result();

		$bankaQ = "SELECT * FROM banka WHERE banka_olusturanAnaHesap = '$anaHesap'";
		$data["banka"] = $this->db->query($bankaQ)->result();

		$kasaQ = "SELECT * FROM kasa WHERE kasa_olusturanAnaHesap = '$anaHesap'";
		$data["kasa"] = $this->db->query($kasaQ)->result();

		$this->load->view("giderler/gider-ekle", $data);
	}

	public function yeniGiderEkle()
	{
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$giderTarihi = postval("gider_tarih");

		$yeni_gider_tarihi = date("Y-m-d", strtotime($giderTarihi));

		$odemeTipi = postval("gider_odemeTipi");

		$bankaID = postval("gider_bankaID");
		$kasaID = postval("gider_kasaID");
		$tutar = postval("gider_tutar");

		if ($odemeTipi == 1) {//kasa çıkış
			//eksiye düşüyor mu kontrol et?
			$toplamGirisQ = "SELECT SUM(kh_giris) AS toplamGiris FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kasaID'";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(kh_cikis) AS toplamCikis FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kasaID'";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$toplamGiris = $toplamGirisExe->toplamGiris;
			$toplamCikis = $toplamCikisExe->toplamCikis;
			$kalan = $toplamGiris - $toplamCikis;

			$cikart = $kalan - $tutar;

			if ($cikart < 0) {
				$this->session->set_flashdata('kasa_eksi', 'OK');
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else if ($odemeTipi == 2) {//banka çıkış
			//eksiye düşüyor mu kontrol et?
			$toplamGirisQ = "SELECT SUM(bh_giris) AS toplamGiris FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(bh_cikis) AS toplamCikis FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$toplamGiris = $toplamGirisExe->toplamGiris;
			$toplamCikis = $toplamCikisExe->toplamCikis;
			$kalan = $toplamGiris - $toplamCikis;

			$cikart = $kalan - $tutar;

			if ($cikart < 0) {
				$this->session->set_flashdata('banka_eksi', 'OK');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}

		$data["gider_gkID"] = postval("gider_gkID");
		$data["gider_gkSubID"] = postval("gider_gkSubID");
		$data["gider_kasaID"] = $kasaID;
		$data["gider_bankaID"] = $bankaID;
		$data["gider_tutar"] = $tutar;
		$data["gider_aciklama"] = postval("gider_aciklama");
		$data["gider_tarih"] = $yeni_gider_tarihi;

		$data["gider_olusturan"] = $u_id;
		$data["gider_olusturanAnaHesap"] = $anaHesap;
		$data["gider_olusturmaTarihi"] = $tarihi;
		$data["gider_olusturmaSaati"] = $saati;

		$this->vt->insert("giderler", $data);
		$gider_id = $this->db->insert_id();

		if ($odemeTipi == 1) {//kasa hareketleri
			$data_kh["kh_kasaID"] = postval("gider_kasaID");
			$data_kh["kh_turu"] = 6;
			$data_kh["kh_cikis"] = postval("gider_tutar");
			$data_kh["kh_tarih"] = $yeni_gider_tarihi;
			$data_kh["kh_aciklama"] = postval("gider_aciklama");
			$data_kh["kh_giderID"] = $gider_id;

			$data_kh["kh_olusturan"] = $u_id;
			$data_kh["kh_olusturanAnaHesap"] = $anaHesap;
			$data_kh["kh_olusturmaTarihi"] = $tarihi;
			$data_kh["kh_olusturmaSaati"] = $saati;

			$this->vt->insert("kasaHareketleri", $data_kh);
		} else if ($odemeTipi == 2) {//banka hareketleri
			$data_bh["bh_turu"] = 6;
			$data_bh["bh_bankaID"] = postval("gider_bankaID");
			$data_bh["bh_tarih"] = $yeni_gider_tarihi;

			$data_bh["bh_cikis"] = postval("gider_tutar");

			$data_bh["bh_aciklama"] = postval("gider_aciklama");
			$data_bh["bh_giderID"] = $gider_id;

			$data_bh["bh_olusturan"] = $u_id;
			$data_bh["bh_olusturanAnaHesap"] = $anaHesap;
			$data_bh["bh_olusturmaTarihi"] = $tarihi;
			$data_bh["bh_olusturmaSaati"] = $saati;

			$this->vt->insert("bankaHareketleri", $data_bh);
		}

		$this->session->set_flashdata('gider_ok', 'OK');
		logekle(56, 2);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function giderDuzenle($id)
	{
		$data["baslik"] = "Giderler / Gider Düzenle";
		$anaHesap = anaHesapBilgisi();

		$bankaQ = "SELECT * FROM banka WHERE banka_olusturanAnaHesap = '$anaHesap'";
		$data["banka"] = $this->db->query($bankaQ)->result();

		$kasaQ = "SELECT * FROM kasa WHERE kasa_olusturanAnaHesap = '$anaHesap'";
		$data["kasa"] = $this->db->query($kasaQ)->result();

		$giderlerQ = "SELECT * FROM giderler WHERE gider_id = '$id' AND gider_olusturanAnaHesap = '$anaHesap'";
		$data["gider"] = $this->db->query($giderlerQ)->row();

		$olusturanHesapKim = $data["gider"]->gider_olusturanAnaHesap;

		$giderKategorileriQ = "SELECT * FROM giderKategorileri WHERE gk_olusturanAnaHesap = '$anaHesap' AND gk_mainID IS NULL";
		$data["giderKategorileri"] = $this->db->query($giderKategorileriQ)->result();

		if ($anaHesap == $olusturanHesapKim) {
			$this->load->view("giderler/gider-duzenle", $data);
		} else {
			redirect('hata');
		}
	}

	public function mevcutGiderDuzenle()
	{
		$anaHesap = anaHesapBilgisi();

		$odemeTipi = postval("gider_odemeTipi");
		$bankaID = postval("gider_bankaID");
		$kasaID = postval("gider_kasaID");
		$tutar = postval("gider_tutar");
		$kdv = postval("gider_kdv");
		$vkn = postval("gider_vkn");
		$vknInfo = postval("gider_vknInfo");


		$giderID = postval("gider_id");

		$giderTarihi = postval("gider_tarih");
		$yeni_gider_tarihi = date("Y-m-d", strtotime($giderTarihi));

		$data["gider_gkID"] = postval("gider_gkID");
		$data["gider_gkSubID"] = postval("gider_gkSubID");
		$data["gider_kasaID"] = $kasaID;
		$data["gider_bankaID"] = $bankaID;
		$data["gider_tutar"] = $tutar;
		$data["gider_aciklama"] = postval("gider_aciklama");
		$data["gider_tarih"] = $yeni_gider_tarihi;


		$data["gider_vkn"] = $vkn;
		$data["gider_vknInfo"] = $vknInfo;
		$data["gider_kdv"] = $kdv;

		if ($odemeTipi == 1) {//kasa hareketleri
			//eksiye düşüyor mu kontrol et?
			$toplamGirisQ = "SELECT SUM(kh_giris) AS toplamGiris FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kasaID'";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(kh_cikis) AS toplamCikis FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kasaID'";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$toplamGiris = $toplamGirisExe->toplamGiris;
			$toplamCikis = $toplamCikisExe->toplamCikis;
			$kalan = $toplamGiris - $toplamCikis;

			$cikart = $kalan - $tutar;

			if ($cikart < 0) {
				$this->session->set_flashdata('kasa_eksi', 'OK');
				redirect($_SERVER['HTTP_REFERER']);
			}
		} else if ($odemeTipi == 2) {//banka hareketleri
			//eksiye düşüyor mu kontrol et?
			$toplamGirisQ = "SELECT SUM(bh_giris) AS toplamGiris FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(bh_cikis) AS toplamCikis FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$toplamGiris = $toplamGirisExe->toplamGiris;
			$toplamCikis = $toplamCikisExe->toplamCikis;
			$kalan = $toplamGiris - $toplamCikis;

			$cikart = $kalan - $tutar;

			if ($cikart < 0) {
				$this->session->set_flashdata('banka_eksi', 'OK');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}

		$this->vt->update('giderler', array('gider_id' => $giderID), $data);
		$this->session->set_flashdata('gider_updt_ok', 'OK');
		logekle(56, 3);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function giderListesi()
	{
		$data["baslik"] = "Giderler / Gider Listesi";
		$anaHesap = anaHesapBilgisi();

		$gidertur = $this->input->get('gidertur');

		$giderKategorisi = $this->input->get('giderKategorisi');

		$tarihGet = $this->input->get('tarihAraligi');

		$tarihAraligi = explode(' - ', $tarihGet);

		$tarih1 = date('Y-m-d', strtotime($tarihAraligi[0])); //küçük tarih
		$tarih2 = date('Y-m-d', strtotime($tarihAraligi[1])); //büyük tarih

		$siralama = $this->input->get('siralama');

		$urim = $this->uri->segment(2);

		$segment = 2;
		$sayfa = $this->input->get("sayfa");

		$page = $sayfa ? $sayfa : 0;
		$limit = 20;

		if ($sayfa) {
			$pagem = ($page - 1) * $limit;
		} else {
			$pagem = 0;
		}

		if ((isset($giderKategorisi) && !empty($giderKategorisi)) || (isset($gidertur) && !empty($gidertur)) || (isset($tarihGet) && !empty($tarihGet)) || (isset($siralama) && !empty($siralama))) {

			if (!empty($giderKategorisi)) {
				$sorgu1 = "AND gider_gkID = '$giderKategorisi'";
			} else {
				$sorgu1 = "";
			}


			if (!empty($tarihGet)) {
				$sorgu2 = "AND gider_tarih BETWEEN '$tarih1' AND '$tarih2'";
			} else {
				$sorgu2 = "";
			}


			if (!empty($gidertur)) {
				$sorgu3 = "AND gider_tur = '$gidertur'";
			} else {
				$sorgu3 = "";
			}

			if (!empty($siralama)) {
				if ($siralama == 1) {//Tarih büyükten küçüğe
					$sira = "ORDER BY DATE(gider_tarih) DESC";
				} else if ($siralama == 2) {//Tarih küçükten büyüğe
					$sira = "ORDER BY DATE(gider_tarih) ASC";
				} else {
					$sira = "ORDER BY gider_id DESC";
				}
			} else {
				$sira = "ORDER BY gider_id DESC";
			}


			$countq = "SELECT COUNT(*) as total FROM giderler WHERE gider_olusturanAnaHesap = '$anaHesap' " . $sorgu1 . " " . $sorgu2 . " " . $sorgu3 . " ";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;

			$sorgu = "SELECT * FROM giderler WHERE gider_olusturanAnaHesap = '$anaHesap' " . $sorgu1 . " " . $sorgu2 . " " . $sorgu3 . " " . $sira . " LIMIT $pagem,$limit";
		} else {
			$countq = "SELECT COUNT(*) as total FROM giderler WHERE gider_olusturanAnaHesap = '$anaHesap'";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;
			$sorgu = "SELECT * FROM giderler WHERE gider_olusturanAnaHesap = '$anaHesap' ORDER BY gider_id DESC LIMIT $pagem,$limit";
		}
		$data["count_of_list"] = $count;
		$this->load->library("pagination");

		$config = array();
		$config["base_url"] = base_url() . "/giderler/$urim";
		$config["total_rows"] = $count;
		$config["per_page"] = $limit;
		$config["uri_segment"] = $segment;
		$config['use_page_numbers'] = TRUE;
		$config['enable_query_strings'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		$config['query_string_segment'] = 'sayfa';
		$config['num_links'] = 9;

		$config['full_tag_open'] = '<div class="d-flex justify-content-center"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div>';

		$config['num_tag_open'] = '<span class="page-link"><li class="page-item">';
		$config['num_tag_close'] = '</li></span>';

		$config['cur_tag_open'] = '<span class="page-link"><li class="page-item active">';
		$config['cur_tag_close'] = '</li></span>';

		$config['first_link'] = '&laquo;&laquo;';
		$config['first_tag_open'] = '<span class="page-link"><li class="page-item">';
		$config['first_tag_close'] = '</li></span>';

		$config['last_link'] = '&raquo;&raquo;';
		$config['last_tag_open'] = '<span class="page-link"><li class="page-item">';
		$config['last_tag_close'] = '</li></span>';

		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<span class="page-link"><li class="page-item">';
		$config['prev_tag_close'] = '</li></span>';

		$config['next_link'] = '&raquo;';
		$config['next_tag_open'] = '<span class="page-link"><li class="page-item">';
		$config['next_tag_close'] = '</li></span>';

		$this->pagination->initialize($config);

		$data["links"] = $this->pagination->create_links();
		$data["giderler"] = $this->db->query($sorgu)->result();

		$this->load->view("giderler/gider-listesi", $data);
	}

	public function giderAltGetir()
	{
		$data = $this->input->post();
		$gkID = $data["gkID"];
		$array = $this->vt->multiple("giderKategorileri", array("gk_mainID" => $gkID));
		$data2 = array('data' => $array);

		$this->output->set_content_type('application/json')->set_output(json_encode($data2));
	}

	public function giderListesiExcel()
	{
		$anaHesap = anaHesapBilgisi();

		$giderKategorisi = $this->input->get('giderKategorisi');
		$gidertur = $this->input->get('gidertur');

		$tarihGet = $this->input->get('tarihAraligi');

		$tarihAraligi = explode(' - ', $tarihGet);

		$tarih1 = date('Y-m-d', strtotime($tarihAraligi[0])); //küçük tarih
		$tarih2 = date('Y-m-d', strtotime($tarihAraligi[1])); //büyük tarih

		if ((isset($giderKategorisi) && !empty($giderKategorisi)) || (isset($gidertur) && !empty($gidertur)) || (isset($tarihGet) && !empty($tarihGet))) {

			if (!empty($giderKategorisi)) {
				$sorgu1 = "AND gider_gkID = '$giderKategorisi'";
			} else {
				$sorgu1 = "";
			}

			if (!empty($tarihGet)) {
				$sorgu2 = "AND gider_tarih BETWEEN '$tarih1' AND '$tarih2'";
			} else {
				$sorgu2 = "";
			}


			if (!empty($gidertur)) {
				$sorgu3 = "AND gider_tur = '$gidertur'";
			} else {
				$sorgu3 = "";
			}

			$sorgu = "SELECT * FROM giderler WHERE gider_olusturanAnaHesap = '$anaHesap' " . $sorgu1 . " " . $sorgu2 . " " . $sorgu3 . " ORDER BY gider_id DESC";
		} else {
			$sorgu = "SELECT * FROM giderler WHERE gider_olusturanAnaHesap = '$anaHesap' ORDER BY gider_id DESC";
		}

		$giderListesi = $this->db->query($sorgu)->result();

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
		$reader->setReadDataOnly(TRUE);
		$spreadsheet = new Spreadsheet();

		$sheet = $spreadsheet->getActiveSheet();

		date_default_timezone_set('Europe/Istanbul');
		$tarih = (new DateTime('now'))->format('d.m.Y-His');
		$sheet->setCellValue('A1', 'Tarih');
		$sheet->setCellValue('B1', 'Gider Türü');
		if ($gidertur == "Gider") {
			$sheet->setCellValue('C1', 'Gider Kategorisi');
			$sheet->setCellValue('D1', 'Açıklama');
			$sheet->setCellValue('E1', 'Banka');
			$sheet->setCellValue('F1', 'Kasa');
			$sheet->setCellValue('G1', 'Tutar');

			$sheet->getStyle('A1:G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');
		} else {
			$sheet->setCellValue('C1', 'VKN / TCKN');
			$sheet->setCellValue('D1', 'Unvan');
			$sheet->setCellValue('E1', 'Gider Kategorisi');
			$sheet->setCellValue('F1', 'Açıklama');
			$sheet->setCellValue('G1', 'Banka');
			$sheet->setCellValue('H1', 'Kasa');
			$sheet->setCellValue('I1', 'Tutar');

			$sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');
		}


		$rows = 2;
		foreach ($giderListesi as $gdr) {
			$tarihYeni = date('d.m.Y', strtotime($gdr->gider_tarih));

			$gider_gkID = $gdr->gider_gkID;

			$gider_gkSubID = $gdr->gider_gkSubID;

			$bankaID = $gdr->gider_bankaID;
			$kasaID = $gdr->gider_kasaID;

			if ($bankaID) {
				$bankaQ = "SELECT * FROM banka WHERE banka_id = '$bankaID'";
				$bankaExe = $this->db->query($bankaQ)->row();

				$bankaTxt = $bankaExe->banka_bankaAd;
				$kasaTxt = "";
			} else if ($kasaID) {
				$kasaQ = "SELECT * FROM kasa WHERE kasa_id = '$kasaID'";
				$kasaExe = $this->db->query($kasaQ)->row();

				$kasaTxt = $kasaExe->kasa_adi;
				$bankaTxt = "";
			}

			$kategoriQ = "SELECT * FROM giderKategorileri WHERE gk_id = '$gider_gkID'";
			$kategoriExe = $this->db->query($kategoriQ)->row();

			$kategoriQ2 = "SELECT * FROM giderKategorileri WHERE gk_id ='$gider_gkSubID'";
			$kategoriExe2 = $this->db->query($kategoriQ2)->row();

			$kategorisi = $kategoriExe->gk_adi . " > " . $kategoriExe2->gk_adi;
			$sheet->setCellValue('A' . $rows, $tarihYeni);
			$sheet->setCellValue('B' . $rows, $gdr->gider_tur);
			if ($gidertur == "Gider") {
				$sheet->setCellValue('C' . $rows, $kategorisi);
				$sheet->setCellValue('D' . $rows, $gdr->gider_aciklama);
				$sheet->setCellValue('E' . $rows, $bankaTxt);
				$sheet->setCellValue('F' . $rows, $kasaTxt);
				$sheet->setCellValue('G' . $rows, $gdr->gider_tutar);
			} else {
				$sheet->setCellValue('C' . $rows, $gdr->gider_vkn);
				$sheet->setCellValue('D' . $rows, $gdr->gider_vknInfo);
				$sheet->setCellValue('E' . $rows, $kategorisi);
				$sheet->setCellValue('F' . $rows, $gdr->gider_aciklama);
				$sheet->setCellValue('G' . $rows, $bankaTxt);
				$sheet->setCellValue('H' . $rows, $kasaTxt);
				$sheet->setCellValue('I' . $rows, $gdr->gider_tutar);
			}
			$rows++;
		}

		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setAutoSize(true);
		$sheet->getColumnDimension('G')->setAutoSize(true);
		$sheet->getColumnDimension('H')->setAutoSize(true);
		$sheet->getColumnDimension('I')->setAutoSize(true);

		$writer = new Xlsx($spreadsheet);//instantiate Xlsx

		$filename = 'gider-listesi' . $tarih;//set filename for excel file to be exported

		header('Content-Type: application/vnd.ms-excel');// generate excel file
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');//download file
	}

	public function sil($type, $id)
	{
		$anaHesap = anaHesapBilgisi();

		if ($type == "gider") {
			$sorgu = "SELECT * FROM giderler WHERE gider_id = '$id' AND gider_olusturanAnaHesap = '$anaHesap' ";
			$execute = $this->db->query($sorgu)->row();

			if ($execute->gider_bankaID == NULL) {
				$del1 = "DELETE FROM kasaHareketleri WHERE kh_giderID = '$id' AND kh_olusturanAnaHesap = '$anaHesap' ";
			} else if ($execute->gider_kasaID == NULL) {
				$del1 = "DELETE FROM bankaHareketleri WHERE bh_giderID = '$id' AND bh_olusturanAnaHesap = '$anaHesap' ";
			} else {
				echo "Hata oluştu, tekrar deneyiniz.";
			}

			$del2 = "DELETE FROM giderler WHERE gider_id = '$id' AND gider_olusturanAnaHesap = '$anaHesap'";
			$this->db->query($del1);
			$this->db->query($del2);
			$this->session->set_flashdata('gider_sil', 'OK');
			logekle(56, 4);
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->session->set_flashdata('hata_sil', 'OK');
			redirect($_SERVER['HTTP_REFERER']);
		}

	}


	public function fisYukle()
	{
		$data["baslik"] = "Giderler / Fiş Yükle";
		$this->load->view("giderler/fis-yukle", $data);
	}

	public function fisOku()
	{

		$data["baslik"] = "Giderler / Fiş Oku";

		if (!empty($_FILES['file']['name'])) {
			$file = $_FILES['file']['name'];
			$url = 'assets/ocr-img';
			$config['upload_path'] = $url;
			$config['allowed_types'] = 'jpg|png|jpeg';
			$config['file_name'] = $file;
			$config['encrypt_name'] = TRUE;

			$this->load->library('upload', $config);

			if ($this->upload->do_upload('file')) {
				$fileName = $this->upload->data('file_name');
				$originalName = $this->upload->data('orig_name');

				$uploadData = $this->upload->data();

				if ($uploadData) {
					$PATH = base_url() . 'assets/tb-ocr-343913-eb3407ba6f45.json';
					$IMG = base_url() . $url . "/" . $fileName;
					$data["imgTemp"] = $url . "/" . $fileName;
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

					preg_match($FISNO_PATTERN, $text, $fisno);
					if (empty($fisno[0]))
						preg_match($FISNO_PATTERN2, $text, $fisno);


					preg_match($DATE_PATTERN, $text, $tarih);

					preg_match("/Fatura No:\s/", $text, $faturami);
					if (empty($faturami))
						$data["tur"] = "Fiş";
					else
						$data["tur"] = "Fatura";


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

					$data["image"] = $IMG;
					$data["vkn"] = $vkn;
					$data["vknInfo"] = $vknInfo;
					$data["tarih"] = trim($tarih[0], " ");
					$data["fisno"] = trim($fisno, " ");
					$data["kdv"] = trim($kdv, " ");
					$data["toplam"] = trim($toplam, " ");


					$anaHesap = anaHesapBilgisi();

					$giderKategorileriQ = "SELECT * FROM giderKategorileri WHERE gk_olusturanAnaHesap = '$anaHesap' AND gk_mainID IS NULL";
					$data["giderKategorileri"] = $this->db->query($giderKategorileriQ)->result();

					$bankaQ = "SELECT * FROM banka WHERE banka_olusturanAnaHesap = '$anaHesap'";
					$data["banka"] = $this->db->query($bankaQ)->result();

					$kasaQ = "SELECT * FROM kasa WHERE kasa_olusturanAnaHesap = '$anaHesap'";
					$data["kasa"] = $this->db->query($kasaQ)->result();


					$this->load->view("giderler/fis-oku", $data);
				}
			} else {
				$this->session->set_flashdata('document_uploaded_error', 'ok');
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}

	public function fisKaydet()
	{
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$giderTarihi = postval("gider_tarih");

		$yeni_gider_tarihi = date("Y-m-d", strtotime($giderTarihi));

		$odemeTipi = postval("gider_odemeTipi");

		$bankaID = postval("gider_bankaID");
		$kasaID = postval("gider_kasaID");
		$tutar = postval("gider_tutar");
		$kdv = postval("gider_kdv");
		$fisno = postval("gider_fisno");
		$vknInfo = postval("gider_vknInfo");
		$vkn = postval("gider_vkn");
		$tur = postval("gider_tur");

		if ($odemeTipi == 1) {//kasa çıkış
			//eksiye düşüyor mu kontrol et?
			$toplamGirisQ = "SELECT SUM(kh_giris) AS toplamGiris FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kasaID'";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(kh_cikis) AS toplamCikis FROM kasaHareketleri WHERE kh_olusturanAnaHesap = '$anaHesap' AND kh_kasaID = '$kasaID'";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$toplamGiris = $toplamGirisExe->toplamGiris;
			$toplamCikis = $toplamCikisExe->toplamCikis;
			$kalan = $toplamGiris - $toplamCikis;

			$cikart = $kalan - $tutar;

			if ($cikart < 0) {
				$this->session->set_flashdata('kasa_eksi', 'OK');
				redirect("giderler/fisYukle");
			}
		} else if ($odemeTipi == 2) {//banka çıkış
			//eksiye düşüyor mu kontrol et?
			$toplamGirisQ = "SELECT SUM(bh_giris) AS toplamGiris FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();

			$toplamCikisQ = "SELECT SUM(bh_cikis) AS toplamCikis FROM bankaHareketleri WHERE bh_olusturanAnaHesap = '$anaHesap' AND bh_bankaID = '$bankaID'";
			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();

			$toplamGiris = $toplamGirisExe->toplamGiris;
			$toplamCikis = $toplamCikisExe->toplamCikis;
			$kalan = $toplamGiris - $toplamCikis;

			$cikart = $kalan - $tutar;

			if ($cikart < 0) {
				$this->session->set_flashdata('banka_eksi', 'OK');
				redirect("giderler/fisYukle");
			}
		}

		$data["gider_tur"] = $tur;
		$data["gider_gkID"] = postval("gider_gkID");
		$data["gider_gkSubID"] = postval("gider_gkSubID");
		$data["gider_kasaID"] = $kasaID;
		$data["gider_bankaID"] = $bankaID;
		$data["gider_tutar"] = $tutar;
		$data["gider_tarih"] = $yeni_gider_tarihi;
		$data["gider_aciklama"] = postval("gider_aciklama");
		$data["gider_vkn"] = $vkn;
		$data["gider_vknInfo"] = $vknInfo;
		$data["gider_fisNo"] = $fisno;
		$data["gider_kdv"] = $kdv;


		$data["gider_olusturan"] = $u_id;
		$data["gider_olusturanAnaHesap"] = $anaHesap;
		$data["gider_olusturmaTarihi"] = $tarihi;
		$data["gider_olusturmaSaati"] = $saati;

		$this->vt->insert("giderler", $data);
		$gider_id = $this->db->insert_id();

		if ($odemeTipi == 1) {//kasa hareketleri
			$data_kh["kh_kasaID"] = postval("gider_kasaID");
			$data_kh["kh_turu"] = 6;
			$data_kh["kh_cikis"] = postval("gider_tutar");
			$data_kh["kh_tarih"] = $yeni_gider_tarihi;
			$data_kh["kh_aciklama"] = postval("gider_aciklama");
			$data_kh["kh_giderID"] = $gider_id;

			$data_kh["kh_olusturan"] = $u_id;
			$data_kh["kh_olusturanAnaHesap"] = $anaHesap;
			$data_kh["kh_olusturmaTarihi"] = $tarihi;
			$data_kh["kh_olusturmaSaati"] = $saati;

			$this->vt->insert("kasaHareketleri", $data_kh);
		} else if ($odemeTipi == 2) {//banka hareketleri
			$data_bh["bh_turu"] = 6;
			$data_bh["bh_bankaID"] = postval("gider_bankaID");
			$data_bh["bh_tarih"] = $yeni_gider_tarihi;

			$data_bh["bh_cikis"] = postval("gider_tutar");

			$data_bh["bh_aciklama"] = postval("gider_aciklama");
			$data_bh["bh_giderID"] = $gider_id;

			$data_bh["bh_olusturan"] = $u_id;
			$data_bh["bh_olusturanAnaHesap"] = $anaHesap;
			$data_bh["bh_olusturmaTarihi"] = $tarihi;
			$data_bh["bh_olusturmaSaati"] = $saati;

			$this->vt->insert("bankaHareketleri", $data_bh);
		}

		$img = postval("img");

		unlink($img);
		$this->session->set_flashdata('gider_ok', 'OK');
		logekle(56, 2);
		redirect("giderler/giderListesi");
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

}
