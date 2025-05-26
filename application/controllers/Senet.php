<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Senet extends CI_Controller {

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

	public function senetPortfoyu(){
		$data["baslik"]  = "Senet Portföyü";

		$urim = $this->uri->segment(2);

		$segment = 2;
		$sayfa = $this->input->get("sayfa");

		$page = $sayfa ? $sayfa : 0;
		$limit = 20;

		if($sayfa){$pagem = ($page-1)*$limit;}
		else{$pagem = 0;/*logekle(2,1);*/}

		$anaHesap = anaHesapBilgisi();

		$countq = "SELECT COUNT(*) as total FROM senet WHERE senet_olusturanAnaHesap = '$anaHesap'";
		$countexe = $this->db->query($countq)->row();
		$count = $countexe->total;
		$sorgu = "SELECT * FROM senet WHERE senet_olusturanAnaHesap = '$anaHesap' ORDER BY senet_id DESC LIMIT $pagem,$limit";

		$data["count_of_list"] = $count;

		$this->load->library("pagination");

		$config = array();
		$config["base_url"] = base_url() . "/senet/$urim";
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
		$data["senet"] = $this->db->query($sorgu)->result();

		$this->load->view("senet/senet-portfoyu", $data);
	}

	public function yeniSenet(){
		$data["baslik"] = "Yeni Senet Giriş / Çıkış";
		$this->load->view("senet/yeni-senet",$data);
	}

	public function yeniSenetOlustur(){
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$yeni_kayitTarihi = postval("senet_kayitTarihi");
		$yeni_vadeTarihi = postval("senet_vadeTarih");

		$yeniKayitTarihi = date("Y-m-d", strtotime($yeni_kayitTarihi));
		$yeniVadeTarihi = date("Y-m-d", strtotime($yeni_vadeTarihi));

		$senetPortfoyNo = postval("senet_portfoyNo");

		$senet_hareketTipi = postval("senet_hareketTipi");

		$data["senet_cariID"] = postval("senet_cariID");
		$data["senet_hareketTipi"] = postval("senet_hareketTipi");
		$data["senet_kayitTarihi"] = $yeniKayitTarihi;
		$data["senet_notAciklama"] = postval("senet_notAciklama");
		$data["senet_portfoyNo"] = $senetPortfoyNo;
		$data["senet_seriNo"] = postval("senet_seriNo");
		$data["senet_borcluID"] = postval("senet_borcluID");
		$data["senet_vadeTarih"] = $yeniVadeTarihi;
		$data["senet_tutar"] = postval("senet_tutar");
		$data["senet_durum"] = 0;
		$data["senet_kullaniciID"] = $u_id;
		$data["senet_olusturanAnaHesap"] = $anaHesap;
		$data["senet_sistemKayitTarihi"] = $tarihi;
		$data["senet_sistemKayitSaati"] = $saati;

		$this->vt->insert("senet",$data);
		$senetID = $this->db->insert_id();
		$this->session->set_flashdata('senet_ok','OK');

		//Cari Hareketleri Ekle :begin
		$data_ch["ch_belgeNumarasi"] = $senetPortfoyNo;

		if($senet_hareketTipi == 1) { //alınan senet
			$data_ch["ch_turu"] =  10;
		}elseif($senet_hareketTipi == 2){ //veirlen senet
			$data_ch["ch_turu"] =  11;
		}

		$data_ch["ch_cariID"] =  postval("senet_cariID");

		//giren borçlu / çıkan alacaklı
		if($senet_hareketTipi == 1){ //alınan senet  (eksi bakiye olarak yansıt)
			$data_ch["ch_alacak"] = postval("senet_tutar");
		}elseif($senet_hareketTipi == 2){ //verilen senet  (artı bakiye olarak yansıt)
			$data_ch["ch_borc"] = postval("senet_tutar");
		}

		$data_ch["ch_tarih"] =  $yeniKayitTarihi;

		$data_ch["ch_olusturan"] =  $u_id;
		$data_ch["ch_olusturanAnaHesap"] =  $anaHesap;
		$data_ch["ch_olusturmaTarihi"] =  $tarihi;
		$data_ch["ch_olusturmaSaati"] =  $saati;
		$data_ch["ch_senetID"] = $senetID;

		$this->vt->insert("cariHareketleri", $data_ch);
		//Cari Hareketleri Ekle :end

		//logekle(57,2); senet ekleme logu
		redirect("senet/senet-portfoyu");
	}

	public function senetDuzenle($id)
	{
		$data["baslik"]="Senet Düzenle";
		$senetQ = "SELECT * FROM senet WHERE senet_id = '$id'";
		$data["senet"] = $this->db->query($senetQ)->row();
		$this->load->view("senet/senet-duzenle",$data);

	}


	public function senetGuncelle(){
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$anaHesap = anaHesapBilgisi();

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$yeni_kayitTarihi = postval("senet_kayitTarihi");
		$yeni_vadeTarihi = postval("senet_vadeTarih");

		$yeniKayitTarihi = date("Y-m-d", strtotime($yeni_kayitTarihi));
		$yeniVadeTarihi = date("Y-m-d", strtotime($yeni_vadeTarihi));

		$senet_id = postval("senet_id");

		$senetPortfoyNo = postval("senet_portfoyNo");

		$senet_hareketTipi = postval("senet_hareketTipi");

		$data["senet_cariID"] = postval("senet_cariID");
		$data["senet_hareketTipi"] = postval("senet_hareketTipi");
		$data["senet_kayitTarihi"] = $yeniKayitTarihi;
		$data["senet_notAciklama"] = postval("senet_notAciklama");
		$data["senet_portfoyNo"] = $senetPortfoyNo;
		$data["senet_seriNo"] = postval("senet_seriNo");
		$data["senet_borcluID"] = postval("senet_borcluID");
		$data["senet_vadeTarih"] = $yeniVadeTarihi;
		$data["senet_tutar"] = postval("senet_tutar");
		$data["senet_durum"] = 0;
		$data["senet_kullaniciID"] = $u_id;
		$data["senet_olusturanAnaHesap"] = $anaHesap;
		$data["senet_sistemKayitTarihi"] = $tarihi;
		$data["senet_sistemKayitSaati"] = $saati;


		$this->vt->update("senet",array('senet_id'=>$senet_id), $data);
		$this->session->set_flashdata('senet_ok','OK');

		$this->vt->del('cariHareketleri', 'ch_senetID' , $senet_id);

		//Cari Hareketleri Ekle :begin
		$data_ch["ch_belgeNumarasi"] = $senetPortfoyNo;

		if($senet_hareketTipi == 1) { //alınan senet
			$data_ch["ch_turu"] =  10;
		}elseif($senet_hareketTipi == 2){ //veirlen senet
			$data_ch["ch_turu"] =  11;
		}

		$data_ch["ch_cariID"] =  postval("senet_cariID");

		//giren borçlu / çıkan alacaklı
		if($senet_hareketTipi == 1){ //alınan senet  (eksi bakiye olarak yansıt)
			$data_ch["ch_alacak"] = postval("senet_tutar");
		}elseif($senet_hareketTipi == 2){ //verilen senet  (artı bakiye olarak yansıt)
			$data_ch["ch_borc"] = postval("senet_tutar");
		}

		$data_ch["ch_tarih"] =  $yeniKayitTarihi;

		$data_ch["ch_olusturan"] =  $u_id;
		$data_ch["ch_olusturanAnaHesap"] =  $anaHesap;
		$data_ch["ch_olusturmaTarihi"] =  $tarihi;
		$data_ch["ch_olusturmaSaati"] =  $saati;
		$data_ch["ch_senetID"] = $senet_id;

		$this->vt->insert("cariHareketleri", $data_ch);
		//Cari Hareketleri Ekle :end

		//logekle(57,2); senet ekleme logu
		redirect("senet/senet-portfoyu");
	}


	public function senetOdeme(){
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		$senetKasa = postval("senetKasa");
		$senetBanka = postval("senetBanka");

		if($senetKasa == "" && $senetBanka == ""){
			$this->session->set_flashdata('senet_odeme_sec','OK');
			redirect("senet/senet-portfoyu");
		}

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d H:i:s');

		$senetID = postval("senetID");

		$senetQ = "SELECT * FROM senet WHERE senet_id = '$senetID'";
		$senet = $this->db->query($senetQ)->row();

		$senet_hareketTipi = $senet->senet_hareketTipi;

		if($senet_hareketTipi == 1){//alınan senet -> seçilen kasaya veya bankaya tutar ARTI (+) olarak yansır
			if($senetKasa != ""){//kasa seçildiği için kasaya artı bakiye olarak yansıt
				$data_kh["kh_senetID"] = $senet->senet_id;
				$data_kh["kh_cariID"] = $senet->senet_cariID;
				$data_kh["kh_kasaID"] = $senetKasa;
				$data_kh["kh_belgeNumarasi"] = $senet->senet_seriNo;
				$data_kh["kh_turu"] = 10;//alınan senet
				$data_kh["kh_giris"] = $senet->senet_tutar;
				$data_kh["kh_tarih"] = $senet->senet_sistemKayitTarihi;
				$data_kh["kh_aciklama"] = $senet->senet_notAciklama;

				$data_kh["kh_olusturan"] = $u_id;
				$data_kh["kh_olusturanAnaHesap"] = $anaHesap;
				$data_kh["kh_olusturmaTarihi"] =  $tarihi;
				$data_kh["kh_olusturmaSaati"] = $saati;

				$this->vt->insert("kasaHareketleri", $data_kh);
			}elseif($senetBanka != ""){//banka seçildiği için bankaya artı bakiye olarak yansıt
				$data_kh["bh_senetID"] = $senet->senet_id;
				$data_bh["bh_turu"] = 10;
				$data_bh["bh_cariID"] = $senet->senet_cariID;
				$data_bh["bh_bankaID"] = $senetBanka;
				$data_bh["bh_belgeNumarasi"] = $senet->senet_seriNo;
				$data_bh["bh_tarih"] = $senet->senet_sistemKayitTarihi;
				$data_bh["bh_giris"] = $senet->senet_tutar;
				$data_bh["bh_aciklama"] = $senet->senet_notAciklama;

				$data_bh["bh_olusturan"] = $u_id;
				$data_bh["bh_olusturanAnaHesap"] = $anaHesap;
				$data_bh["bh_olusturmaTarihi"] =  $tarihi;
				$data_bh["bh_olusturmaSaati"] = $saati;

				$this->vt->insert("bankaHareketleri", $data_bh);
			}
		}elseif($senet_hareketTipi == 2){//verilen senet -> seçilen kasaya veya bankaya tutar EKSİ (-) olarak yansır
			if($senetKasa != ""){//kasa seçildiği için kasaya eksi bakiye olarak yansıt
				$data_kh["kh_senetID"] = $senet->senet_id;
				$data_kh["kh_cariID"] = $senet->senet_cariID;
				$data_kh["kh_kasaID"] = $senetKasa;
				$data_kh["kh_belgeNumarasi"] = $senet->senet_seriNo;
				$data_kh["kh_turu"] = 11;//verilen senet
				$data_kh["kh_cikis"] = $senet->senet_tutar;
				$data_kh["kh_tarih"] = $senet->senet_sistemKayitTarihi;
				$data_kh["kh_aciklama"] = $senet->senet_notAciklama;

				$data_kh["kh_olusturan"] = $u_id;
				$data_kh["kh_olusturanAnaHesap"] = $anaHesap;
				$data_kh["kh_olusturmaTarihi"] =  $tarihi;
				$data_kh["kh_olusturmaSaati"] = $saati;

				$this->vt->insert("kasaHareketleri", $data_kh);
			}elseif($senetBanka != ""){//banka seçildiği için bankaya eksi bakiye olarak yansıt
				$data_kh["bh_senetID"] = $senet->senet_id;
				$data_bh["bh_turu"] = 11;
				$data_bh["bh_cariID"] = $senet->senet_cariID;
				$data_bh["bh_bankaID"] = $senetBanka;
				$data_bh["bh_belgeNumarasi"] = $senet->senet_seriNo;
				$data_bh["bh_tarih"] = $senet->senet_sistemKayitTarihi;
				$data_bh["bh_cikis"] = $senet->senet_tutar;
				$data_bh["bh_aciklama"] = $senet->senet_notAciklama;

				$data_bh["bh_olusturan"] = $u_id;
				$data_bh["bh_olusturanAnaHesap"] = $anaHesap;
				$data_bh["bh_olusturmaTarihi"] =  $tarihi;
				$data_bh["bh_olusturmaSaati"] = $saati;

				$this->vt->insert("bankaHareketleri", $data_bh);
			}
		}

		$data["senet_durum"] = 1;
		$data["senet_odemeTarih"] = $tarihi;

		$this->vt->update('senet', array('senet_id'=>$senetID), $data);
		$this->session->set_flashdata('senet_odeme_ok','OK');
		//logekle(57,2); çek ekleme logu
		redirect("senet/senet-portfoyu");
	}

	public function senetDetaylari($id){
  		echo $id;
	}

	public function senet_sil(){

		$senetID = postval("senet_id");
		$this->vt->del('senet', 'senet_id' , $senetID);

		$this->vt->del('cariHareketleri', 'ch_senetID' , $senetID);
		$this->session->set_flashdata('senet_sil_ok', 'OK');
		redirect("cek/cekPortfoyu");
	}

}
