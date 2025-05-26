<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cek extends CI_Controller {

  public function __construct(){
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->model('vt');
		
		$control = session("r", "login");


	  if(gibYetki()==1)
		  redirect("home/hata");

	  if(!$control){
			redirect("check");
		}

	  //sessionKontrolHelper();
	}

	public function cekPortfoyu(){
  		$data["baslik"]  = "Çek Portföyü";

		$urim = $this->uri->segment(2);

		$segment = 2;
		$sayfa = $this->input->get("sayfa");

		$page = $sayfa ? $sayfa : 0;
		$limit = 20;

		if($sayfa){$pagem = ($page-1)*$limit;}
		else{$pagem = 0;/*logekle(2,1);*/}

		$anaHesap = anaHesapBilgisi();

		$countq = "SELECT COUNT(*) as total FROM cek WHERE cek_olusturanAnaHesap = '$anaHesap'";
		$countexe = $this->db->query($countq)->row();
		$count = $countexe->total;
		$sorgu = "SELECT * FROM cek WHERE cek_olusturanAnaHesap = '$anaHesap' ORDER BY cek_id DESC LIMIT $pagem,$limit";

		$data["count_of_list"] = $count;

		$this->load->library("pagination");

		$config = array();
		$config["base_url"] = base_url() . "/cek/$urim";
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
		$data["cek"] = $this->db->query($sorgu)->result();

		$this->load->view("cek/cek-portfoyu", $data);
	}

	public function yeniCek(){
  		$data["baslik"] = "Yeni Çek Giriş / Çıkış";
  		$this->load->view("cek/yeni-cek",$data);
	}

	public function yeniCekOlustur(){
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$yeni_kayitTarihi = postval("cek_kayitTarihi");
		$yeni_vadeTarihi = postval("cek_vadeTarih");

		$yeniKayitTarihi = date("Y-m-d", strtotime($yeni_kayitTarihi));
		$yeniVadeTarihi = date("Y-m-d", strtotime($yeni_vadeTarihi));

		$cekPortfoyNo = postval("cek_portfoyNo");

		$cek_hareketTipi = postval("cek_hareketTipi");

		$data["cek_cariID"] = postval("cek_cariID");
		$data["cek_hareketTipi"] = postval("cek_hareketTipi");
		$data["cek_kayitTarihi"] = $yeniKayitTarihi;
		$data["cek_notAciklama"] = postval("cek_notAciklama");
		$data["cek_portfoyNo"] = $cekPortfoyNo;
		$data["cek_seriNo"] = postval("cek_seriNo");
		$data["cek_borcluID"] = postval("cek_borcluID");
		$data["cek_vadeTarih"] = $yeniVadeTarihi;
		$data["cek_bankaID"] = postval("cek_bankaID");
		$data["cek_bankaSube"] = postval("cek_bankaSube");
		$data["cek_tutar"] = postval("cek_tutar");
		$data["cek_durum"] = 0;
		$data["cek_kullaniciID"] = $u_id;
		$data["cek_olusturanAnaHesap"] = $anaHesap;
		$data["cek_sistemKayitTarihi"] = $tarihi;
		$data["cek_sistemKayitSaati"] = $saati;

		$this->vt->insert("cek",$data);
		$cekID = $this->db->insert_id();
		$this->session->set_flashdata('cek_ok','OK');

		//Cari Hareketleri Ekle :begin
		$data_ch["ch_belgeNumarasi"] = $cekPortfoyNo;

		if($cek_hareketTipi == 1) { //alınan çek
			$data_ch["ch_turu"] =  8;
		}elseif($cek_hareketTipi == 2){ //veirlen çek
			$data_ch["ch_turu"] =  9;
		}

		$data_ch["ch_cariID"] =  postval("cek_cariID");

		//giren borçlu / çıkan alacaklı
		if($cek_hareketTipi == 1){ //alınan çek  (eksi bakiye olarak yansıt)
			$data_ch["ch_alacak"] = postval("cek_tutar");
		}elseif($cek_hareketTipi == 2){ //verilen çek  (artı bakiye olarak yansıt)
			$data_ch["ch_borc"] = postval("cek_tutar");
		}

		$data_ch["ch_tarih"] =  $yeniKayitTarihi;

		$data_ch["ch_olusturan"] =  $u_id;
		$data_ch["ch_olusturanAnaHesap"] =  $anaHesap;
		$data_ch["ch_olusturmaTarihi"] =  $tarihi;
		$data_ch["ch_olusturmaSaati"] =  $saati;
		$data_ch["ch_cekID"] = $cekID;

		$this->vt->insert("cariHareketleri", $data_ch);
		//Cari Hareketleri Ekle :end

		//logekle(57,2); çek ekleme logu
		redirect("cek/cek-portfoyu");
	}

	public function cekDuzenle($id)
	{
		$data["baslik"]="Çek Düzenle";
		$cekQ = "SELECT * FROM cek WHERE cek_id = '$id'";
		$data["cek"] = $this->db->query($cekQ)->row();
		$this->load->view("cek/cek-duzenle",$data);

	}

	public function cekGuncelle()
	{
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$yeni_kayitTarihi = postval("cek_kayitTarihi");
		$yeni_vadeTarihi = postval("cek_vadeTarih");

		$yeniKayitTarihi = date("Y-m-d", strtotime($yeni_kayitTarihi));
		$yeniVadeTarihi = date("Y-m-d", strtotime($yeni_vadeTarihi));

		$cek_id = postval("cek_id");

		$cekPortfoyNo = postval("cek_portfoyNo");

		$cek_hareketTipi = postval("cek_hareketTipi");

		$data["cek_cariID"] = postval("cek_cariID");
		$data["cek_hareketTipi"] = postval("cek_hareketTipi");
		$data["cek_kayitTarihi"] = $yeniKayitTarihi;
		$data["cek_notAciklama"] = postval("cek_notAciklama");
		$data["cek_portfoyNo"] = $cekPortfoyNo;
		$data["cek_seriNo"] = postval("cek_seriNo");
		$data["cek_borcluID"] = postval("cek_borcluID");
		$data["cek_vadeTarih"] = $yeniVadeTarihi;
		$data["cek_bankaID"] = postval("cek_bankaID");
		$data["cek_bankaSube"] = postval("cek_bankaSube");
		$data["cek_tutar"] = postval("cek_tutar");
		$data["cek_durum"] = 0;
		$data["cek_kullaniciID"] = $u_id;
		$data["cek_olusturanAnaHesap"] = $anaHesap;
		$data["cek_sistemKayitTarihi"] = $tarihi;
		$data["cek_sistemKayitSaati"] = $saati;

		$this->vt->update("cek",array('cek_id'=>$cek_id), $data);
		$this->session->set_flashdata('cek_ok','OK');

		//Cari Hareketleri

		$this->vt->del('cariHareketleri', 'ch_cekID' , $cek_id);

		$data_ch["ch_belgeNumarasi"] = $cekPortfoyNo;

		if($cek_hareketTipi == 1) { //alınan çek
			$data_ch["ch_turu"] =  8;
		}elseif($cek_hareketTipi == 2){ //veirlen çek
			$data_ch["ch_turu"] =  9;
		}

		$data_ch["ch_cariID"] =  postval("cek_cariID");

		//giren borçlu / çıkan alacaklı
		if($cek_hareketTipi == 1){ //alınan çek  (eksi bakiye olarak yansıt)
			$data_ch["ch_alacak"] = postval("cek_tutar");
		}elseif($cek_hareketTipi == 2){ //verilen çek  (artı bakiye olarak yansıt)
			$data_ch["ch_borc"] = postval("cek_tutar");
		}

		$data_ch["ch_tarih"] =  $yeniKayitTarihi;

		$data_ch["ch_olusturan"] =  $u_id;
		$data_ch["ch_olusturanAnaHesap"] =  $anaHesap;
		$data_ch["ch_olusturmaTarihi"] =  $tarihi;
		$data_ch["ch_olusturmaSaati"] =  $saati;
		$data_ch["ch_cekID"] = $cek_id;

		$this->vt->insert("cariHareketleri", $data_ch);
		//Cari Hareketleri Ekle :end

		//logekle(57,2); çek ekleme logu
		redirect("cek/cek-portfoyu");
	}

	public function cekOdeme(){
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

  		$cekKasa = postval("cekKasa");
  		$cekBanka = postval("cekBanka");

  		if($cekKasa == "" && $cekBanka == ""){
			$this->session->set_flashdata('cek_odeme_sec','OK');
			redirect("cek/cek-portfoyu");
		}

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d H:i:s');

  		$cekID = postval("cekID");

  		$cekQ = "SELECT * FROM cek WHERE cek_id = '$cekID'";
  		$cek = $this->db->query($cekQ)->row();

  		$cek_hareketTipi = $cek->cek_hareketTipi;

  		if($cek_hareketTipi == 1){//alınan çek -> seçilen kasaya veya bankaya tutar ARTI (+) olarak yansır
			if($cekKasa != ""){//kasa seçildiği için kasaya artı bakiye olarak yansıt
				$data_kh["kh_cekID"] = $cek->cek_id;
				$data_kh["kh_cariID"] = $cek->cek_cariID;
				$data_kh["kh_kasaID"] = $cekKasa;
				$data_kh["kh_belgeNumarasi"] = $cek->cek_seriNo;
				$data_kh["kh_turu"] = 8;//alınan çek
				$data_kh["kh_giris"] = $cek->cek_tutar;
				$data_kh["kh_tarih"] = $cek->cek_sistemKayitTarihi;
				$data_kh["kh_aciklama"] = $cek->cek_notAciklama;

				$data_kh["kh_olusturan"] = $u_id;
				$data_kh["kh_olusturanAnaHesap"] = $anaHesap;
				$data_kh["kh_olusturmaTarihi"] =  $tarihi;
				$data_kh["kh_olusturmaSaati"] = $saati;

				$this->vt->insert("kasaHareketleri", $data_kh);
			}elseif($cekBanka != ""){//banka seçildiği için bankaya artı bakiye olarak yansıt
				$data_kh["bh_cekID"] = $cek->cek_id;
				$data_bh["bh_turu"] = 8;
				$data_bh["bh_cariID"] = $cek->cek_cariID;
				$data_bh["bh_bankaID"] = $cekBanka;
				$data_bh["bh_belgeNumarasi"] = $cek->cek_seriNo;
				$data_bh["bh_tarih"] = $cek->cek_sistemKayitTarihi;
				$data_bh["bh_giris"] = $cek->cek_tutar;
				$data_bh["bh_aciklama"] = $cek->cek_notAciklama;

				$data_bh["bh_olusturan"] = $u_id;
				$data_bh["bh_olusturanAnaHesap"] = $anaHesap;
				$data_bh["bh_olusturmaTarihi"] =  $tarihi;
				$data_bh["bh_olusturmaSaati"] = $saati;

				$this->vt->insert("bankaHareketleri", $data_bh);
			}
		}elseif($cek_hareketTipi == 2){//verilen çek -> seçilen kasaya veya bankaya tutar EKSİ (-) olarak yansır
			if($cekKasa != ""){//kasa seçildiği için kasaya eksi bakiye olarak yansıt
				$data_kh["kh_cekID"] = $cek->cek_id;
				$data_kh["kh_cariID"] = $cek->cek_cariID;
				$data_kh["kh_kasaID"] = $cekKasa;
				$data_kh["kh_belgeNumarasi"] = $cek->cek_seriNo;
				$data_kh["kh_turu"] = 9;//verilen çek
				$data_kh["kh_cikis"] = $cek->cek_tutar;
				$data_kh["kh_tarih"] = $cek->cek_sistemKayitTarihi;
				$data_kh["kh_aciklama"] = $cek->cek_notAciklama;

				$data_kh["kh_olusturan"] = $u_id;
				$data_kh["kh_olusturanAnaHesap"] = $anaHesap;
				$data_kh["kh_olusturmaTarihi"] =  $tarihi;
				$data_kh["kh_olusturmaSaati"] = $saati;

				$this->vt->insert("kasaHareketleri", $data_kh);
			}elseif($cekBanka != ""){//banka seçildiği için bankaya eksi bakiye olarak yansıt
				$data_kh["bh_cekID"] = $cek->cek_id;
				$data_bh["bh_turu"] = 9;
				$data_bh["bh_cariID"] = $cek->cek_cariID;
				$data_bh["bh_bankaID"] = $cekBanka;
				$data_bh["bh_belgeNumarasi"] = $cek->cek_seriNo;
				$data_bh["bh_tarih"] = $cek->cek_sistemKayitTarihi;
				$data_bh["bh_cikis"] = $cek->cek_tutar;
				$data_bh["bh_aciklama"] = $cek->cek_notAciklama;

				$data_bh["bh_olusturan"] = $u_id;
				$data_bh["bh_olusturanAnaHesap"] = $anaHesap;
				$data_bh["bh_olusturmaTarihi"] =  $tarihi;
				$data_bh["bh_olusturmaSaati"] = $saati;

				$this->vt->insert("bankaHareketleri", $data_bh);
			}
		}

  		$data["cek_durum"] = 1;
  		$data["cek_odemeTarih"] = $tarihi;

		$this->vt->update('cek', array('cek_id'=>$cekID), $data);
		$this->session->set_flashdata('cek_odeme_ok','OK');
		//logekle(57,2); çek ekleme logu
		redirect("cek/cek-portfoyu");
	}

	public function cekDetaylari($id){
  		echo $id;
	}

	public function cek_sil(){

		$cekID = postval("cek_id");
		$this->vt->del('cek', 'cek_id' , $cekID);

		$this->vt->del('cariHareketleri', 'ch_cekID' , $cekID);
		$this->session->set_flashdata('cek_sil_ok', 'OK');
		redirect("cek/cekPortfoyu");
	}

}
