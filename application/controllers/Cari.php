<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use furkankadioglu\eFatura\InvoiceManager;

class Cari extends CI_Controller
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

	public function cariGruplari()
	{
		$data["baslik"] = "Cari / Cari Grupları";
		$anaHesap = anaHesapBilgisi();

		$cariGruplariQ = "SELECT * FROM cariGruplari WHERE cariGrup_olusturanAnaHesap = '$anaHesap'";
		$data["cariGruplari"] = $this->db->query($cariGruplariQ)->result();

		$countq = "SELECT COUNT(*) as total FROM cariGruplari WHERE cariGrup_olusturanAnaHesap = '$anaHesap'";
		$countexe = $this->db->query($countq)->row();
		$count = $countexe->total;
		$data["count_of_list"] = $count;

		//logekle(4,1);
		$this->load->view('cari/cari-gruplari', $data);
	}

	public function yeniCariGrubuEkle()
	{
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d H:i:s');

		$anaHesap = anaHesapBilgisi();

		$cariGrup_kodu = postval("cariGrup_kodu");

		$data["cariGrup_kodu"] = $cariGrup_kodu;
		$data["cariGrup_ad"] = postval("cariGrup_ad");
		$data["cariGrup_olusturan"] = $u_id;
		$data["cariGrup_olusturanAnaHesap"] = $anaHesap;
		$data["cariGrup_olusturmaTarihi"] = $tarihi;

		$cariGrupKoduVarmiQ = "SELECT * FROM cariGruplari WHERE cariGrup_kodu = '$cariGrup_kodu' AND cariGrup_olusturanAnaHesap = '$anaHesap'";
		$cariGrupKoduVarmi = $this->db->query($cariGrupKoduVarmiQ)->row();

		if ($cariGrupKoduVarmi) {
			$this->session->set_flashdata('cari_grup_kodvar', 'OK');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->vt->insert("cariGruplari", $data);
			$this->session->set_flashdata('cari_grup_ok', 'OK');
			logekle(4, 2);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function mevcutCariGrubuDuzenle()
	{
		$id = postval("cariGrup_id");
		$cariGrup_kodu = postval("cariGrup_kodu");

		$anaHesap = anaHesapBilgisi();

		$data["cariGrup_kodu"] = $cariGrup_kodu;
		$data["cariGrup_ad"] = postval("cariGrup_ad");

		$cariGrupKoduVarmiQ = "SELECT * FROM cariGruplari WHERE cariGrup_kodu = '$cariGrup_kodu' AND cariGrup_olusturanAnaHesap = '$anaHesap' AND cariGrup_id != $id";
		$cariGrupKoduVarmi = $this->db->query($cariGrupKoduVarmiQ)->row();

		if ($cariGrupKoduVarmi) {
			$this->session->set_flashdata('cari_grup_kodvar', 'OK');
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			$this->vt->update('cariGruplari', array('cariGrup_id' => $id), $data);
			$this->session->set_flashdata('cari_grup_updt_ok', 'OK');
			logekle(4, 3);
			redirect($_SERVER['HTTP_REFERER']);
		}
	}

	public function cariKartiOlustur()
	{
		$data["baslik"] = "Cari / Cari Kartı Oluştur";
		$iller = $this->db->get('iller');

		if ($iller->num_rows() > 0) {
			$data['_iller'] = $iller->result();
		} else {
			$data['_iller'] = false;
		}

		//logekle(1,1);
		$this->load->view("cari/cari-karti-olustur", $data);
	}

	public function yeniCariKartiOlustur()
	{
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		$cariTipi = postval("cari_bireysel");
		$cariKodu = postval("cari_kodu");
		$cariVergiNo = postval("cari_vergiNumarasi");
		//	$tckn = postval("cari_tckn");
		$alias_pk = postval("cari_alias_pk");

		if ($alias_pk === "") {//earşiv
			$cariEInvoiceType = 2;
		} else {
			$cariEInvoiceType = 1;
		}

		$cariKoduLen = strlen($cariKodu);
		$cariVergiNoLen = strlen($cariVergiNo);
		//$tcknLen = strlen($tckn);

		if ($cariKoduLen < 3) {
			$this->session->set_flashdata('cari_kodu_3_karakter', 'OK');
			redirect("cari/cari-karti-olustur");
			die;
		}
		/*
				if($cariTipi == 0) {
					if ($cariVergiNoLen < 10) {
						$this->session->set_flashdata('cari_kodu_vkn_karakter', 'OK');
						redirect("cari/cari-karti-olustur");
						die;
					}
				}

				if($cariTipi == 1) {
					if ($cariVergiNoLen < 11) {
						$this->session->set_flashdata('cari_kodu_tckn_karakter', 'OK');
						redirect("cari/cari-karti-olustur");
						die;
					}
				}*/

		$vergiKontrolQ = "SELECT * FROM cari WHERE cari_olusturanAnaHesap = '$anaHesap' AND cari_vergiNumarasi = '$cariVergiNo' AND cari_durum=true";
		$vergiKontrol = $this->db->query($vergiKontrolQ)->row();

		if ($cariTipi == 0) {
			if ($vergiKontrol) {
				$this->session->set_flashdata('cari_kodu_vergino', 'OK');
				redirect("cari/cari-karti-olustur");
				die;
			}
		}

		if ($cariVergiNoLen == 10)
			$data["cari_vergiNumarasi"] = $cariVergiNo;
		else if ($cariVergiNoLen == 11)
			$data["cari_tckn"] = $cariVergiNo;


		$data["cari_kodu"] = mb_strtoupper($cariKodu, "UTF-8");;
		$data["cari_ad"] = mb_strtoupper(postval("cari_ad"), "UTF-8");
		$data["cari_soyad"] = mb_strtoupper(postval("cari_soyad"), "UTF-8");
		$data["cari_vergiDairesi"] = mb_strtoupper(postval("cari_vergiDairesi"), "UTF-8");
		/*		$data["cari_vergiNumarasi"] = $cariVergiNo;
				$data["cari_tckn"] = $tckn;*/
		$data["cari_cariGrupKoduID"] = postval("cari_cariGrupKoduID");
		$data["cari_il"] = postval("cari_il");
		$data["cari_ilce"] = postval("cari_ilce");
		$data["cari_websitesi"] = postval("cari_websitesi");
		$data["cari_firmaEPosta"] = postval("cari_firmaEPosta");
		$data["cari_firmaTelefon"] = postval("cari_firmaTelefon");
		$data["cari_adres"] = mb_strtoupper(postval("cari_adres"), "UTF-8");
		$data["cari_olusturan"] = $u_id;
		$data["cari_olusturanAnaHesap"] = $anaHesap;
		$data["cari_olusturmaTarihi"] = $tarihi;
		$data["cari_olusturmaSaati"] = $saati;
		$data["cari_bireysel"] = $cariTipi;
		$data["cari_EInvoiceType"] = $cariEInvoiceType;
		$data["cari_alias_pk"] = $alias_pk;

		$cariKoduVarmiQ = "SELECT * FROM cari WHERE cari_kodu = '$cariKodu' AND cari_olusturanAnaHesap = '$anaHesap' AND cari_durum=true";
		$cariKoduVarmi = $this->db->query($cariKoduVarmiQ)->row();

		$page = postval("page");
		if ($page == "satisfatura") {
			if ($cariKoduVarmi) {
				$this->session->set_flashdata('cari_kodu_mevcut', 'OK');
			} else {
				$this->vt->insert("cari", $data);
				$cari_id = $this->db->insert_id();
				$this->session->set_flashdata('cari_ok', 'OK');
				logekle(1, 2);
			}
			redirect("fatura/satis-faturasi/$cari_id/1");
		} else if ($page == "alisfatura") {
			if ($cariKoduVarmi) {
				$this->session->set_flashdata('cari_kodu_mevcut', 'OK');
			} else {
				$this->vt->insert("cari", $data);
				$cari_id = $this->db->insert_id();
				$this->session->set_flashdata('cari_ok', 'OK');
				logekle(1, 2);
			}
			redirect("fatura/alis-faturasi/$cari_id/1");
		} else if ($page == "earsivfatura") {
			if ($cariKoduVarmi) {
				$this->session->set_flashdata('cari_kodu_mevcut', 'OK');
			} else {
				$this->vt->insert("cari", $data);
				$cari_id = $this->db->insert_id();
				$this->session->set_flashdata('cari_ok', 'OK');
				logekle(1, 2);
			}
			redirect("fatura/earsiv-olustur/$cari_id/1");
		} else if ($page == "efatura") {
			if ($cariKoduVarmi) {
				$this->session->set_flashdata('cari_kodu_mevcut', 'OK');
			} else {
				$this->vt->insert("cari", $data);
				$cari_id = $this->db->insert_id();
				$this->session->set_flashdata('cari_ok', 'OK');
				logekle(1, 2);
			}
			redirect("fatura/efatura-olustur/$cari_id/1");
		} else {
			if ($cariKoduVarmi) {
				$this->session->set_flashdata('cari_kodu_mevcut', 'OK');
				redirect("cari/cari-karti-olustur");
			} else {
				$this->vt->insert("cari", $data);
				$cari_id = $this->db->insert_id();
				$this->session->set_flashdata('cari_ok', 'OK');
				logekle(1, 2);
				redirect("cari/cari-karti-duzenle/$cari_id");
			}
		}
	}

	public function cariKartiDuzenle($id)
	{
		$data["baslik"] = "Cari / Cari Kartı Düzenle";

		$anaHesap = anaHesapBilgisi();

		$cariQ = "SELECT * FROM cari WHERE cari_id = '$id' AND cari_durum=true";
		$data["cari"] = $this->db->query($cariQ)->row();

		$iller = $this->db->get('iller');

		if ($iller->num_rows() > 0) {
			$data['_iller'] = $iller->result();
		} else {
			$data['_iller'] = false;
		}

		$olusturanHesapKim = $data["cari"]->cari_olusturanAnaHesap;

		$cariDetayliQ = "SELECT * FROM cariDetayliIletisim WHERE cdetay_cariID = '$id'";
		$data["detaylıIletisim"] = $this->db->query($cariDetayliQ)->result();

		$cariDetayliBankaQ = "SELECT * FROM cariDetayliBanka WHERE cdetayBanka_cariID = '$id'";
		$data["detayliBanka"] = $this->db->query($cariDetayliBankaQ)->result();

		if ($anaHesap == $olusturanHesapKim) {
			//logekle(1,1);
			$this->load->view('cari/cari-karti-duzenle', $data);
		} else {
			redirect('hata');
		}
	}

	public function mevcutCariKartiDuzenle()
	{
		$cari_id = postval("cari_id");

		$anaHesap = anaHesapBilgisi();

		$cariTipi = postval("cari_bireysel");
		$cariKodu = postval("cari_kodu");
		$cariVergiNo = postval("cari_vergiNumarasi");

		$cariKoduLen = strlen($cariKodu);
		$cariVergiNoLen = strlen($cariVergiNo);
		//$tcknLen = strlen($tckn);

		if ($cariKoduLen < 3) {
			$this->session->set_flashdata('cari_kodu_3_karakter', 'OK');
			redirect("cari/cari-karti-duzenle/$cari_id");
			die;
		}

		/*	if($cariTipi == 0) {
				if ($cariVergiNoLen < 10) {
					$this->session->set_flashdata('cari_kodu_vkn_karakter', 'OK');
					redirect("cari/cari-karti-duzenle/$cari_id");
					die;
				}
			}

			if($cariTipi == 1) {
				if ($tcknLen < 11) {
					$this->session->set_flashdata('cari_kodu_tckn_karakter', 'OK');
					redirect("cari/cari-karti-duzenle/$cari_id");
					die;
				}
			}*/

		if ($cariVergiNoLen == 10)
			$where = "and cari_vergiNumarasi='" . $cariVergiNo . "'";
		else if ($cariVergiNoLen == 11)
			$where = "and cari_tckn='" . $cariVergiNo . "'";
		else $where = "";


		$vergiKontrolQ = "SELECT * FROM cari WHERE cari_olusturanAnaHesap = '$anaHesap' AND cari_durum=true  $where AND cari_id != '$cari_id'";
		$vergiKontrol = $this->db->query($vergiKontrolQ)->row();

		if ($cariTipi == 0) {
			if ($vergiKontrol) {
				$this->session->set_flashdata('cari_kodu_vergino', 'OK');
				redirect("cari/cari-karti-duzenle/$cari_id");
				die;
			}
		}

		if ($cariVergiNoLen == 10) {
			$data["cari_vergiNumarasi"] = $cariVergiNo;
			$data["cari_tckn"] = null;
			$data["cari_soyad"] = null;
		} else if ($cariVergiNoLen == 11) {
			$data["cari_tckn"] = $cariVergiNo;
			$data["cari_vergiNumarasi"] = null;
			$data["cari_soyad"] = mb_strtoupper(postval("cari_soyad"), "UTF-8");
		}

		$data["cari_kodu"] = mb_strtoupper($cariKodu, "UTF-8");
		$data["cari_ad"] = mb_strtoupper(postval("cari_ad"), "UTF-8");
		$data["cari_vergiDairesi"] = mb_strtoupper(postval("cari_vergiDairesi"), "UTF-8");
		/*$data["cari_vergiNumarasi"] = postval("cari_vergiNumarasi");
		$data["cari_tckn"] = postval("cari_vergiNumarasi");*/
		$data["cari_cariGrupKoduID"] = postval("cari_cariGrupKoduID");
		$data["cari_il"] = postval("cari_il");
		$data["cari_ilce"] = postval("cari_ilce");
		$data["cari_websitesi"] = postval("cari_websitesi");
		$data["cari_firmaEPosta"] = postval("cari_firmaEPosta");
		$data["cari_firmaTelefon"] = postval("cari_firmaTelefon");
		$data["cari_adres"] = mb_strtoupper(postval("cari_adres"), "UTF-8");
		$data["cari_bireysel"] = postval("cari_bireysel");

		$cariKoduVarmiQ = "SELECT * FROM cari WHERE cari_kodu = '$cariKodu' AND cari_durum=true AND cari_olusturanAnaHesap = '$anaHesap' AND cari_id != $cari_id";
		$cariKoduVarmi = $this->db->query($cariKoduVarmiQ)->row();

		if ($cariKoduVarmi) {
			$this->session->set_flashdata('cari_update_carikoduvar', 'OK');
			redirect("cari/cari-karti-duzenle/$cari_id");
		} else {
			$this->vt->update('cari', array('cari_id' => $cari_id), $data);
			$this->session->set_flashdata('cari_update_ok', 'OK');
			logekle(1, 3);
			redirect("cari/cari-karti-duzenle/$cari_id");
		}
	}

	public function cariListesi()
	{
		$data["baslik"] = "Cari / Cari Listesi";
		$anaHesap = anaHesapBilgisi();

		$cariKodu = $this->input->get('cariKodu');
		$cariAdi = $this->input->get('cariAdi');
		$cariTipi = $this->input->get('bireysel');
		if ($cariTipi == "true") {
			$cariTipi2 = 1;
		} else if ($cariTipi == "false") {
			$cariTipi2 = 0;
		} else {
			$cariTipi2 = 2;
		}
		$cariGrubu = $this->input->get('cariGrubu');
		$bulunduguIl = $this->input->get('bulunduguIl');
		$tarihGet = $this->input->get('tarihAraligi');

		$tarihAraligi = explode(' - ', $tarihGet);

		$tarih1 = date('Y-m-d', strtotime($tarihAraligi[0])); //küçük tarih
		$tarih2 = date('Y-m-d', strtotime($tarihAraligi[1])); //büyük tarih

		$urim = $this->uri->segment(2);

		$segment = 2;
		$sayfa = $this->input->get("sayfa");

		$page = $sayfa ? $sayfa : 0;
		$limit = 20;

		if ($sayfa) {
			$pagem = ($page - 1) * $limit;
		} else {
			$pagem = 0;/*logekle(2,1);*/
		}

		if ((isset($cariKodu) && !empty($cariKodu)) || (isset($cariAdi) && !empty($cariAdi)) || (isset($cariGrubu) && !empty($cariGrubu)) || (isset($bulunduguIl) && !empty($bulunduguIl)) || (isset($tarihGet) && !empty($tarihGet)) || ($cariTipi != 2)) {

			if (!empty($cariGrubu)) {
				$sorgu1 = "AND cari_cariGrupKoduID = '$cariGrubu'";
			} else {
				$sorgu1 = "";
			}

			if (!empty($bulunduguIl)) {
				$sorgu2 = "AND cari_il = '$bulunduguIl'";
			} else {
				$sorgu2 = "";
			}

			if (!empty($tarihGet)) {
				$sorgu3 = "AND cari_olusturmaTarihi BETWEEN '$tarih1' AND '$tarih2'";
			} else {
				$sorgu3 = "";
			}

			if (!empty($cariTipi)) {
				$sorgu4 = "AND cari_bireysel = '$cariTipi2'";
			} else {
				$sorgu4 = "";
			}

			$countq = "SELECT COUNT(*) as total FROM cari WHERE cari_olusturanAnaHesap = '$anaHesap' AND cari_kodu LIKE '%$cariKodu%' AND cari_ad LIKE '%$cariAdi%' " . $sorgu1 . " " . $sorgu2 . " " . $sorgu3 . " " . $sorgu4 . " ";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;

			$sorgu = "SELECT * FROM cari WHERE cari_olusturanAnaHesap = '$anaHesap' AND cari_durum=true AND cari_kodu LIKE '%$cariKodu%' AND cari_ad LIKE '%$cariAdi%' " . $sorgu1 . " " . $sorgu2 . " " . $sorgu3 . " " . $sorgu4 . " ORDER BY cari_id DESC LIMIT $pagem,$limit";

		} else {
			$countq = "SELECT COUNT(*) as total FROM cari WHERE cari_olusturanAnaHesap = '$anaHesap' AND cari_durum=true";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;
			$sorgu = "SELECT * FROM cari WHERE cari_olusturanAnaHesap = '$anaHesap' and cari_durum=true ORDER BY cari_id DESC LIMIT $pagem,$limit";
		}

		$data["count_of_list"] = $count;

		$this->load->library("pagination");

		$config = array();
		$config["base_url"] = base_url() . "/cari/$urim";
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
		$data["cari"] = $this->db->query($sorgu)->result();

		$this->load->view("cari/cari-listesi", $data);
	}

	public function cariDetayliIletisimEkle()
	{
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d H:i:s');

		$anaHesap = anaHesapBilgisi();

		$cari_id = postval("cdetay_cariID");

		$data["cdetay_ad"] = postval("cdetay_ad");
		$data["cdetay_soyad"] = postval("cdetay_soyad");
		$data["cdetay_gorevi"] = postval("cdetay_gorevi");
		$data["cdetay_eposta"] = postval("cdetay_eposta");
		$data["cdetay_telefon"] = postval("cdetay_telefon");
		$data["cdetay_cariID"] = $cari_id;
		$data["cdetay_olusturmaTarihi"] = $tarihi;
		$data["cdetay_olusturan"] = $u_id;
		$data["cdetay_olusturanAnaHesap"] = $anaHesap;

		$this->vt->insert("cariDetayliIletisim", $data);

		$this->session->set_flashdata('cari_detayli_ok', 'OK');
		logekle(55, 2);
		redirect("cari/cari-karti-duzenle/$cari_id");
	}

	public function cariDetayliIletisimSil($id)
	{
		$anaHesap = anaHesapBilgisi();
		$iletisimq = "SELECT * FROM cariDetayliIletisim WHERE cdetay_id = '$id'";
		$iletisimexe = $this->db->query($iletisimq)->row();

		$iletisimAnaHesap = $iletisimexe->cdetay_olusturanAnaHesap;
		if ($anaHesap == $iletisimAnaHesap) {
			$this->vt->del("cariDetayliIletisim", "cdetay_id", $id);
			$this->session->set_flashdata('cari_detayli_sil', 'OK');
			logekle(55, 4);
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect('hata');
		}
	}

	public function cariDetayliIletisimDuzenle()
	{
		$cdetay_id = postval("cdetay_id");

		$data["cdetay_ad"] = postval("cdetay_ad");
		$data["cdetay_soyad"] = postval("cdetay_soyad");
		$data["cdetay_gorevi"] = postval("cdetay_gorevi");
		$data["cdetay_eposta"] = postval("cdetay_eposta");
		$data["cdetay_telefon"] = postval("cdetay_telefon");

		$this->vt->update('cariDetayliIletisim', array('cdetay_id' => $cdetay_id), $data);
		$this->session->set_flashdata('cari_detay_update_ok', 'OK');
		logekle(55, 3);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function cariDetayliBankaEkle()
	{
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d H:i:s');

		$anaHesap = anaHesapBilgisi();

		$cari_id = postval("cdetayBanka_cariID");

		$data["cdetayBanka_cariID"] = $cari_id;
		$data["cdetayBanka_bankaAdi"] = postval("cdetayBanka_bankaAdi");
		$data["cdetayBanka_hesapAdi"] = postval("cdetayBanka_hesapAdi");
		$data["cdetayBanka_hesapNo"] = postval("cdetayBanka_hesapNo");
		$data["cdetayBanka_iban"] = postval("cdetayBanka_iban");
		$data["cdetayBanka_olusturmaTarihi"] = $tarihi;
		$data["cdetayBanka_olusturan"] = $u_id;
		$data["cdetayBanka_olusturanAnaHesap"] = $anaHesap;

		$this->vt->insert("cariDetayliBanka", $data);

		$this->session->set_flashdata('cari_detayli_banka_ok', 'OK');
		logekle(59, 2);
		redirect("cari/cari-karti-duzenle/$cari_id");
	}

	public function cariDetayliBankaDuzenle()
	{
		$cdetayBanka_id = postval("cdetayBanka_id");

		$data["cdetayBanka_bankaAdi"] = postval("cdetayBanka_bankaAdi");
		$data["cdetayBanka_hesapAdi"] = postval("cdetayBanka_hesapAdi");
		$data["cdetayBanka_hesapNo"] = postval("cdetayBanka_hesapNo");
		$data["cdetayBanka_iban"] = postval("cdetayBanka_iban");

		$this->vt->update('cariDetayliBanka', array('cdetayBanka_id' => $cdetayBanka_id), $data);
		$this->session->set_flashdata('cari_detay_banka_update_ok', 'OK');
		logekle(59, 3);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function cariDetayliBankaSil($id)
	{
		$anaHesap = anaHesapBilgisi();
		$iletisimq = "SELECT * FROM cariDetayliBanka WHERE cdetayBanka_id = '$id'";
		$iletisimexe = $this->db->query($iletisimq)->row();

		$iletisimAnaHesap = $iletisimexe->cdetayBanka_olusturanAnaHesap;
		if ($anaHesap == $iletisimAnaHesap) {
			$this->vt->del("cariDetayliBanka", "cdetayBanka_id", $id);
			$this->session->set_flashdata('cari_detayli_banka_sil', 'OK');
			logekle(59, 4);
			redirect($_SERVER['HTTP_REFERER']);
		} else {
			redirect('hata');
		}
	}

	public function cariHareketleri()
	{
		$data["baslik"] = "Cari / Cari Hareketleri";
		$anaHesap = anaHesapBilgisi();

		$cariBilgisi = $this->input->get('cari');

		$hareketTuru = $this->input->get('hareketTuru');
		$belgeNo = $this->input->get('belgeNo');

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

		if ((isset($tarihGet) && !empty($tarihGet)) || (isset($siralama) && !empty($siralama))) {

			if (!empty($tarihGet)) {
				$sorgu1 = "AND ch_tarih BETWEEN '$tarih1' AND '$tarih2'";
			} else {
				$sorgu1 = "";
			}

			if (!empty($cariBilgisi) && $cariBilgisi != "tumu") {
				$kasaQuery = "AND ch_cariID = '$cariBilgisi'";
			}

			if (!empty($siralama)) {
				if ($siralama == 1) {//Tarih büyükten küçüğe
					$sira = "ORDER BY DATE(ch_tarih) DESC";
				} else if ($siralama == 2) {//Tarih küçükten büyüğe
					$sira = "ORDER BY DATE(ch_tarih) ASC";
				} else {
					$sira = "ORDER BY ch_id DESC";
				}
			} else {
				$sira = "ORDER BY ch_id DESC";
			}

			$countq = "SELECT COUNT(*) as total FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' " . $kasaQuery . " " . $sorgu1 . " ";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;

			$sorgu = "SELECT * FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' " . $kasaQuery . " " . $sorgu1 . " " . $sira . " LIMIT $pagem,$limit";

			$toplamBorcQ = "SELECT SUM(ch_borc) AS toplamBorc FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' " . $kasaQuery . " " . $sorgu1 . " ";
			$toplamBorcExe = $this->db->query($toplamBorcQ)->row();

			$toplamAlacakQ = "SELECT SUM(ch_alacak) AS toplamAlacak FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' " . $kasaQuery . " " . $sorgu1 . " ";
			$toplamAlacakExe = $this->db->query($toplamAlacakQ)->row();

			$data["toplamBorc"] = $toplamBorcExe->toplamBorc;
			$data["toplamAlacak"] = $toplamAlacakExe->toplamAlacak;
			$data["kalan"] = $data["toplamBorc"] - $data["toplamAlacak"];
		} else {
			if (!empty($cariBilgisi) && $cariBilgisi != "tumu") {
				$kasaQuery = "AND ch_cariID = '$cariBilgisi'";
			}

			$countq = "SELECT COUNT(*) as total FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' " . $kasaQuery . "";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;
			$sorgu = "SELECT * FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' " . $kasaQuery . " ORDER BY ch_id DESC LIMIT $pagem,$limit";

			$toplamBorcQ = "SELECT SUM(ch_borc) AS toplamBorc FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' " . $kasaQuery . " ";
			$toplamBorcExe = $this->db->query($toplamBorcQ)->row();

			$toplamAlacakQ = "SELECT SUM(ch_alacak) AS toplamAlacak FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' " . $kasaQuery . "";
			$toplamAlacakExe = $this->db->query($toplamAlacakQ)->row();

			$data["toplamBorc"] = $toplamBorcExe->toplamBorc;
			$data["toplamAlacak"] = $toplamAlacakExe->toplamAlacak;
			$data["kalan"] = $data["toplamBorc"] - $data["toplamAlacak"];
		}

		$data["count_of_list"] = $count;

		$this->load->library("pagination");

		$config = array();
		$config["base_url"] = base_url() . "/cari/$urim";
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
		$data["cariHareketleri"] = $this->db->query($sorgu)->result();

		$cariQ = "SELECT * FROM cari WHERE cari_id = '$cariBilgisi' AND cari_durum=true";
		$cariExe = $this->db->query($cariQ)->row();
		$cariOlusturanAnaHesap = $cariExe->cari_olusturanAnaHesap;

		if ($cariExe) {
			if ($anaHesap == $cariOlusturanAnaHesap) {
				$this->load->view("cari/cari-hareketleri", $data);
			} else {
				redirect('hata');
			}
		} else {
			$this->load->view("cari/cari-hareketleri", $data);
		}
	}

	public function cariDekont()
	{
		$data["baslik"] = "Cari / Cari Dekont";
		$this->load->view("cari/cari-dekont", $data);
	}

	public function yeniCariDekont()
	{
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		$dekont_tarih = postval("cariDekont_tarih");
		$yeni_dekont_tarih = date("Y-m-d", strtotime($dekont_tarih));

		$cari_id = postval("cari_id");

		$islemTipi = postval("cariDekont_islemTipi");

		//Cari Hareketleri Ekle :begin
		$data_ch["ch_turu"] = 7;
		$data_ch["ch_cariID"] = $cari_id;
		if ($islemTipi == 2) {
			$data_ch["ch_borc"] = postval("cariDekont_tutar");
		} else if ($islemTipi == 1) {
			$data_ch["ch_alacak"] = postval("cariDekont_tutar");
		}
		$data_ch["ch_tarih"] = $yeni_dekont_tarih;
		$data_ch["ch_aciklama"] = postval("cariDekont_aciklama");

		$data_ch["ch_olusturan"] = $u_id;
		$data_ch["ch_olusturanAnaHesap"] = $anaHesap;
		$data_ch["ch_olusturmaTarihi"] = $tarihi;
		$data_ch["ch_olusturmaSaati"] = $saati;

		$this->vt->insert("cariHareketleri", $data_ch);
		//Cari Hareketleri Ekle :end

		$this->session->set_flashdata('cari_dekont_ok', 'OK');
		logekle(58, 2);
		redirect("cari/cari-hareketleri?cari=$cari_id");
	}

	public function cariDekontDuzenle($id)
	{
		$data["baslik"] = "Cari / Cari Dekont Düzenle";
		$anaHesap = anaHesapBilgisi();

		$data["cariDekont"] = $this->vt->single("cariHareketleri", array("ch_id" => $id));


		$olusturanHesapKim = $data["cariDekont"]->ch_olusturanAnaHesap;

		if ($anaHesap == $olusturanHesapKim) {
			$this->load->view("cari/cari-dekont-duzenle", $data);
		} else {
			redirect('hata');
		}
	}

	public function mevcutCariDekontDuzenle()
	{
		$ch_id = postval("ch_id");

		$cari_id = postval("cari_id");

		$islemTipi = postval("cariDekont_islemTipi");

		$dekont_tarih = postval("cariDekont_tarih");
		$yeni_dekont_tarih = date("Y-m-d", strtotime($dekont_tarih));

		//Cari Hareketleri Düzenle :begin
		$data_ch["ch_cariID"] = $cari_id;
		if ($islemTipi == 2) {
			$data_ch["ch_borc"] = postval("cariDekont_tutar");
		} else if ($islemTipi == 1) {
			$data_ch["ch_alacak"] = postval("cariDekont_tutar");
		}
		$data_ch["ch_tarih"] = $yeni_dekont_tarih;
		$data_ch["ch_aciklama"] = postval("cariDekont_aciklama");

		$this->vt->update('cariHareketleri', array('ch_id' => $ch_id), $data_ch);
		//Cari Hareketleri Düzenle :end

		$this->session->set_flashdata('cari_dekont_updt_ok', 'OK');
		logekle(58, 3);
		redirect("cari/cari-hareketleri?cari=$cari_id");
	}

	public function cariListesiExcel()
	{
		$anaHesap = anaHesapBilgisi();

		$cariKodu = $this->input->get('cariKodu');
		$cariAdi = $this->input->get('cariAdi');
		$cariGrubu = $this->input->get('cariGrubu');
		$bulunduguIl = $this->input->get('bulunduguIl');
		$tarihGet = $this->input->get('tarihAraligi');

		$tarihAraligi = explode(' - ', $tarihGet);

		$tarih1 = date('Y-m-d', strtotime($tarihAraligi[0])); //küçük tarih
		$tarih2 = date('Y-m-d', strtotime($tarihAraligi[1])); //büyük tarih

		if ((isset($cariKodu) && !empty($cariKodu)) || (isset($cariAdi) && !empty($cariAdi)) || (isset($cariGrubu) && !empty($cariGrubu)) || (isset($bulunduguIl) && !empty($bulunduguIl)) || (isset($tarihGet) && !empty($tarihGet))) {
			if (!empty($cariGrubu)) {
				$sorgu1 = "AND cari_cariGrupKoduID = '$cariGrubu'";
			} else {
				$sorgu1 = "";
			}

			if (!empty($bulunduguIl)) {
				$sorgu2 = "AND cari_il = '$bulunduguIl'";
			} else {
				$sorgu2 = "";
			}

			if (!empty($tarihGet)) {
				$sorgu3 = "AND cari_olusturmaTarihi BETWEEN '$tarih1' AND '$tarih2'";
			} else {
				$sorgu3 = "";
			}

			$sorgu = "SELECT * FROM cari WHERE cari_olusturanAnaHesap = '$anaHesap' AND cari_durum=true AND cari_kodu LIKE '%$cariKodu%' AND cari_ad LIKE '%$cariAdi%' " . $sorgu1 . " " . $sorgu2 . " " . $sorgu3 . " ORDER BY cari_id DESC";
		} else {
			$sorgu = "SELECT * FROM cari WHERE cari_olusturanAnaHesap = '$anaHesap' AND cari_durum=true ORDER BY cari_id DESC";
		}

		$cari = $this->db->query($sorgu)->result();

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
		$reader->setReadDataOnly(TRUE);
		$spreadsheet = new Spreadsheet();

		$sheet = $spreadsheet->getActiveSheet();

		date_default_timezone_set('Europe/Istanbul');
		$tarih = (new DateTime('now'))->format('d.m.Y-His');

		$sheet->getStyle('A1:J1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');

		$sheet->setCellValue('A1', 'CARİ KODU');
		$sheet->setCellValue('B1', 'CARİ ADI');
		$sheet->setCellValue('C1', 'CARİ GRUBU');
		$sheet->setCellValue('D1', 'VERGİ DAİRESİ');
		$sheet->setCellValue('E1', 'İL');
		$sheet->setCellValue('F1', 'Telefon');
		$sheet->setCellValue('G1', 'Borç');
		$sheet->setCellValue('H1', 'Alacak');
		$sheet->setCellValue('I1', 'Borç Bak.');
		$sheet->setCellValue('J1', 'Alacak Bak.');

		$rows = 2;
		$tumBorc=0;
		$tumAlacak=0;
		$tumBorcBak=0;
		$tumAlacakBak=0;
		foreach ($cari as $cr) {
			$grubuq = "SELECT * FROM cariGruplari WHERE cariGrup_id = '$cr->cari_cariGrupKoduID'";
			$grubuexe = $this->db->query($grubuq)->row();

			$ilq = "SELECT * FROM iller WHERE id='$cr->cari_il'";
			$ilexe = $this->db->query($ilq)->row();

			$cari_idsi = $cr->cari_id;

			$toplamBorcQ = "SELECT SUM(ch_borc) AS toplamBorc FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' AND ch_cariID = '$cari_idsi'";
			$toplamBorcExe = $this->db->query($toplamBorcQ)->row();

			$toplamAlacakQ = "SELECT SUM(ch_alacak) AS toplamAlacak FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' AND ch_cariID = '$cari_idsi'";
			$toplamAlacakExe = $this->db->query($toplamAlacakQ)->row();

			$toplamBorc = $toplamBorcExe->toplamBorc;
			$toplamAlacak = $toplamAlacakExe->toplamAlacak;
			if($toplamBorc==null)
				$toplamBorc=0;
			if($toplamAlacak==null)
				$toplamAlacak=0;
			$kalan = $toplamBorc - $toplamAlacak;

			if ($kalan < 0) {
				$borcBak = 0;
				$alacakBak = $kalan;
			} else {
				 $alacakBak= 0;
				 $borcBak= $kalan;
			}

			$tumAlacak += $toplamAlacak;
			$tumBorc +=$toplamBorc;
			$tumAlacakBak +=$alacakBak;
			$tumBorcBak += $borcBak;
			/*
						$kalann = abs($kalan);
						if (filter_var($kalan, FILTER_VALIDATE_FLOAT) && $kalan > 0) {
							$bakiye = '(B) ' . number_format($kalann, 2) . ' ₺';
						} else {
							$bakiye = '(A) ' . number_format($kalann, 2) . ' ₺';
						}*/

			$sheet->setCellValue('A' . $rows, $cr->cari_kodu);
			$sheet->setCellValue('B' . $rows, $cr->cari_ad);
			$sheet->setCellValue('C' . $rows, $grubuexe->cariGrup_ad);
			$sheet->setCellValue('D' . $rows, $cr->cari_vergiDairesi);
			$sheet->setCellValue('E' . $rows, $ilexe->il);
			$sheet->setCellValue('F' . $rows, $cr->cari_firmaTelefon);
			$sheet->setCellValue('G' . $rows, number_format($toplamBorc,3,",","."));
			$sheet->setCellValue('H' . $rows, number_format($toplamAlacak,3,",","."));
			$sheet->setCellValue('I' . $rows, number_format($borcBak,3,",","."));
			$sheet->setCellValue('J' . $rows, number_format($alacakBak,3,",","."));
			$rows++;
		}


		$satir="F".$rows.":J".$rows;
		$sheet->getStyle($satir)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');
		$sheet->setCellValue('F'.$rows, "Toplam");
		$sheet->setCellValue('G'.$rows, number_format($tumBorc,3));
		$sheet->setCellValue('H'.$rows, number_format($tumAlacak,3));
		$sheet->setCellValue('I'.$rows, number_format($tumBorcBak,3));
		$sheet->setCellValue('J'.$rows, number_format($tumAlacakBak,3));

		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);
		$sheet->getColumnDimension('F')->setAutoSize(true);
		$sheet->getColumnDimension('G')->setAutoSize(true);
		$sheet->getColumnDimension('H')->setAutoSize(true);
		$sheet->getColumnDimension('I')->setAutoSize(true);
		$sheet->getColumnDimension('J')->setAutoSize(true);

		$writer = new Xlsx($spreadsheet);//instantiate Xlsx

		$filename = 'cari-listesi-' . $tarih;//set filename for excel file to be exported

		header('Content-Type: application/vnd.ms-excel');// generate excel file
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');//download file
	}

	public function cariHareketleriExcel()
	{
		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');

		$cariBilgisi = $this->input->get('cari');

		$tarihGet = $this->input->get('tarihAraligi');

		$tarihAraligi = explode(' - ', $tarihGet);

		$tarih1 = date('Y-m-d', strtotime($tarihAraligi[0])); //küçük tarih
		$tarih2 = date('Y-m-d', strtotime($tarihAraligi[1])); //büyük tarih

		$tarihd = (new DateTime('now'))->format('d.m.Y');

		if ((isset($tarihGet) && !empty($tarihGet))) {
			if (!empty($tarihGet)) {
				$sorgu1 = "AND ch_tarih BETWEEN '$tarih1' AND '$tarih2'";
			} else {
				$sorgu1 = "";
			}

			if (!empty($cariBilgisi) && $cariBilgisi != "tumu") {
				$kasaQuery = "AND ch_cariID = '$cariBilgisi'";
			}
			$sorgu = "SELECT * FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' " . $kasaQuery . " " . $sorgu1 . " ORDER BY ch_id DESC";

			$toplamBorcQ = "SELECT SUM(ch_borc) AS toplamBorc FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' " . $kasaQuery . " " . $sorgu1 . " ORDER BY ch_id DESC ";
			$toplamBorcExe = $this->db->query($toplamBorcQ)->row();

			$toplamAlacakQ = "SELECT SUM(ch_alacak) AS toplamAlacak FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' " . $kasaQuery . " " . $sorgu1 . " ORDER BY ch_id DESC ";
			$toplamAlacakExe = $this->db->query($toplamAlacakQ)->row();
		} else {
			$sorgu = "SELECT * FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' AND ch_cariID = '$cariBilgisi' ORDER BY ch_id DESC";

			$toplamBorcQ = "SELECT SUM(ch_borc) AS toplamBorc FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' AND ch_cariID = '$cariBilgisi' ";
			$toplamBorcExe = $this->db->query($toplamBorcQ)->row();

			$toplamAlacakQ = "SELECT SUM(ch_alacak) AS toplamAlacak FROM cariHareketleri WHERE ch_olusturanAnaHesap = '$anaHesap' AND ch_cariID = '$cariBilgisi' ";
			$toplamAlacakExe = $this->db->query($toplamAlacakQ)->row();
		}

		$toplamBorc = $toplamBorcExe->toplamBorc;
		$toplamAlacak = $toplamAlacakExe->toplamAlacak;
		$kalan = $toplamBorc - $toplamAlacak;

		$kalann = abs($kalan);
		if (filter_var($kalan, FILTER_VALIDATE_FLOAT) && $kalan > 0) {
			$bakiyedurum = "(B) " . number_format($kalann, 2);
		} else {
			$bakiyedurum = "(A) " . number_format($kalann, 2);
		}

		$cariHareketleri = $this->db->query($sorgu)->result();

		$cariQ = "SELECT * FROM cari WHERE cari_id = '$cariBilgisi' AND cari_olusturanAnaHesap = '$anaHesap' AND cari_durum=true";
		$cariExe = $this->db->query($cariQ)->row();

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
		$reader->setReadDataOnly(TRUE);
		$spreadsheet = new Spreadsheet();

		$sheet = $spreadsheet->getActiveSheet();

		$sheet->setCellValue('D2', "Cari");
		$sheet->setCellValue('D3', "Tarih");

		$sheet->setCellValue('E2', $cariExe->cari_ad);
		$sheet->setCellValue('E3', $tarihd);
		$sheet->setCellValue('F4', $bakiyedurum);

		$tarih = (new DateTime('now'))->format('d.m.Y-His');

		$sheet->getStyle('A5:E5')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');

		$sheet->setCellValue('A5', 'Tarih');
		$sheet->setCellValue('B5', 'Belge Numarası');
		$sheet->setCellValue('C5', 'Türü');
		$sheet->setCellValue('D5', 'Borç');
		$sheet->setCellValue('E5', 'Alacak');

		$rows = 6;
		foreach ($cariHareketleri as $ch) {
			$tarihYeni = date('d.m.Y', strtotime($ch->ch_tarih));

			$turu = $ch->ch_turu;
			if ($turu == 1) {
				$turuTxt = 'Alış Faturası';
			} else if ($turu == 2) {
				$turuTxt = 'Satış Faturası';
			} else if ($turu == 3) {
				$turuTxt = 'Banka Havalesi';
			} else if ($turu == 4) {
				$turuTxt = 'Banka EFT';
			} else if ($turu == 5) {
				$turuTxt = 'Kasa Tahsilat';
			} else if ($turu == 6) {
				$turuTxt = 'Kasa Ödeme';
			} else if ($turu == 7) {
				$turuTxt = 'Cari Dekont';
			}

			$sheet->setCellValue('A' . $rows, $tarihYeni);
			$sheet->setCellValue('B' . $rows, $ch->ch_belgeNumarasi);
			$sheet->setCellValue('C' . $rows, $turuTxt);
			$sheet->setCellValue('D' . $rows, $ch->ch_borc);
			$sheet->setCellValue('E' . $rows, $ch->ch_alacak);
			$rows++;
		}

		$sheet->getColumnDimension('A')->setAutoSize(true);
		$sheet->getColumnDimension('B')->setAutoSize(true);
		$sheet->getColumnDimension('C')->setAutoSize(true);
		$sheet->getColumnDimension('D')->setAutoSize(true);
		$sheet->getColumnDimension('E')->setAutoSize(true);

		$writer = new Xlsx($spreadsheet);//instantiate Xlsx

		$filename = 'cari-hareketleri-' . $tarih;//set filename for excel file to be exported

		header('Content-Type: application/vnd.ms-excel');// generate excel file
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');//download file
	}

	public function cari_sil()
	{
		$id = $this->input->get('cari_id');
		$data["cari_durum"] = 0;
		$this->vt->update('cari', array('cari_id' => $id), $data);
		$this->session->set_flashdata('cari_sil_ok', 'OK');
		redirect("cari/cari-listesi");
	}


	public function gibVknTcknSorgula()
	{
		$vkn = $this->input->post("vergiNumarasi");
		$client = new InvoiceManager();
		$client->setCredentials("33210617", "120580");
		$client->connect();
		$vknInfo = $client->getCompanyInfo($vkn);
		if (!empty($vknInfo["data"]["unvan"]))
			$data["unvan"] = $vknInfo["data"]["unvan"];
		else
			$data["ad"] = $vknInfo["data"]["adi"];
		$data["soyad"] = $vknInfo["data"]["soyadi"];

		$client->logOutFromAPI();
		echo json_encode($data);
	}

	public function autocompleteDataByCariName()
	{

		$anaHesap = anaHesapBilgisi();

		$returnData = array();
		$conditions['searchTerm'] = $this->input->get('term');
		$getData = $this->vt->getRows($conditions, $anaHesap);

		if (!empty($getData)) {
			foreach ($getData as $row) {

				$data['value'] = $row["cari_ad"] . " " . $row["cari_soyad"];
				$data['id'] = $row['cari_id'];

				array_push($returnData, $data);
			}
		}

		echo json_encode($returnData);
		die;
	}

	public function cariKartiGuncelle()
	{
		$cari_id = postval("cari_id");

		$data["cari_kodu"] = postval("cari_kodu");
		$data["cari_ad"] = postval("cari_ad");
		$data["cari_soyad"] = postval("cari_soyad");
		$data["cari_vergiDairesi"] = postval("cari_vergiDairesi");
		$data["cari_vergiNumarasi"] = postval("cari_vergiNumarasi");
		$data["cari_tckn"] = postval("cari_tckn");
		$data["cari_cariGrupKoduID"] = postval("cari_cariGrupKoduID");
		$data["cari_il"] = postval("cari_il");
		$data["cari_ilce"] = postval("cari_ilce");
		$data["cari_websitesi"] = postval("cari_websitesi");
		$data["cari_firmaEPosta"] = postval("cari_firmaEPosta");
		$data["cari_firmaTelefon"] = postval("cari_firmaTelefon");
		$data["cari_adres"] = postval("cari_adres");

		// Dosya yükleme işlemleri
		$fotograf_dosyalar = [];
		if (!empty($_FILES['cari_fotograflar']['name'][0])) {
			$count = count($_FILES['cari_fotograflar']['name']);
			for ($i = 0; $i < $count; $i++) {
				$tmp_name = $_FILES['cari_fotograflar']['tmp_name'][$i];
				$name = uniqid('foto_') . '_' . basename($_FILES['cari_fotograflar']['name'][$i]);
				$upload_dir = FCPATH . 'assets/uploads/';
				if (!is_dir($upload_dir)) { mkdir($upload_dir, 0777, true); }
				if (move_uploaded_file($tmp_name, $upload_dir . $name)) {
					$fotograf_dosyalar[] = $name;
				}
			}
		}
		if (count($fotograf_dosyalar) > 0) {
			$data['fotograf_dosya'] = implode(',', $fotograf_dosyalar);
		}

		$evrak_dosyalar = [];
		if (!empty($_FILES['cari_dosya']['name'][0])) {
			$count = count($_FILES['cari_dosya']['name']);
			for ($i = 0; $i < $count; $i++) {
				$tmp_name = $_FILES['cari_dosya']['tmp_name'][$i];
				$name = uniqid('evrak_') . '_' . basename($_FILES['cari_dosya']['name'][$i]);
				$upload_dir = FCPATH . 'assets/uploads/';
				if (!is_dir($upload_dir)) { mkdir($upload_dir, 0777, true); }
				if (move_uploaded_file($tmp_name, $upload_dir . $name)) {
					$evrak_dosyalar[] = $name;
				}
			}
		}
		if (count($evrak_dosyalar) > 0) {
			$data['evrak_dosya'] = implode(',', $evrak_dosyalar);
		}

		$this->vt->update('cari', array('cari_id' => $cari_id), $data);
		$this->session->set_flashdata('cari_update_ok', 'OK');
		logekle(1, 3);
		redirect("cari/cari-karti-duzenle/$cari_id");
	}
	public function cariArama() {
        try {
            $term = $this->input->get('term');
            $anaHesap = anaHesapBilgisi();
            $returnData = array();
            if (strlen($term) >= 4) {
                $sql = "SELECT cari_id, cari_ad, cari_soyad, cari_vergiNumarasi, cari_tckn FROM cari WHERE cari_olusturanAnaHesap = ? AND (
                    cari_ad LIKE ? OR
                    cari_soyad LIKE ? OR
                    cari_vergiNumarasi LIKE ? OR
                    cari_tckn LIKE ?
                ) LIMIT 20";
                $like = "%$term%";
                $query = $this->db->query($sql, [$anaHesap, $like, $like, $like, $like]);                foreach ($query->result() as $row) {
                    $returnData[] = [
                        'cari_id' => $row->cari_id,
                        'cari_adi' => trim($row->cari_ad . ' ' . $row->cari_soyad),
                        'cari_soyad' => $row->cari_soyad,
                        'cari_vergiNumarasi' => $row->cari_vergiNumarasi,
                        'cari_tckn' => $row->cari_tckn
                    ];
                }
            }
            echo json_encode($returnData);        } catch (Exception $e) {
            echo json_encode(array('error' => $e->getMessage()));
        }
        die;
    }

    public function cariBakiyeGetir()
    {
        try {
            $cari_id = $this->input->post('cari_id');
            $anaHesap = anaHesapBilgisi();
            
            if (!$cari_id) {
                echo json_encode(['success' => false, 'message' => 'Cari ID gerekli']);
                die;
            }

            // Toplam borç hesapla
            $toplamBorcQ = "SELECT SUM(ch_borc) AS toplamBorc FROM cariHareketleri WHERE ch_olusturanAnaHesap = ? AND ch_cariID = ?";
            $toplamBorcExe = $this->db->query($toplamBorcQ, [$anaHesap, $cari_id])->row();

            // Toplam alacak hesapla
            $toplamAlacakQ = "SELECT SUM(ch_alacak) AS toplamAlacak FROM cariHareketleri WHERE ch_olusturanAnaHesap = ? AND ch_cariID = ?";
            $toplamAlacakExe = $this->db->query($toplamAlacakQ, [$anaHesap, $cari_id])->row();

            $toplamBorc = $toplamBorcExe->toplamBorc ?? 0;
            $toplamAlacak = $toplamAlacakExe->toplamAlacak ?? 0;
            $kalan = $toplamBorc - $toplamAlacak;
            $kalann = abs($kalan);

            if (filter_var($kalan, FILTER_VALIDATE_FLOAT) && $kalan > 0) {
                $bakiye = '<span class="btn btn-outline-success btn-sm">' . number_format($kalann, 2, ",", ".") . ' ₺ (B)</span>';
            } else {
                $bakiye = '<span class="btn btn-outline-danger btn-sm">' . number_format($kalann, 2, ",", ".") . ' ₺ (A)</span>';
            }

            echo json_encode([
                'success' => true,
                'bakiye' => $bakiye,
                'tutar' => $kalann,
                'tip' => $kalan > 0 ? 'borc' : 'alacak'
            ]);
            
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
        die;
    }
}
