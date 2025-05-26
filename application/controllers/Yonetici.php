<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Yonetici extends CI_Controller {

  public function __construct(){
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->model('vt');
		
		$control = session("r", "login");


	  if(!$control){
			redirect("check");
		}
	  //sessionKontrolHelper();
	}

	public function kullaniciLoglari(){

		if(gibYetki()==1)
			redirect("home/hata");
		$data["baslik"] = "Yönetici / Kullanıcı Logları";
		$anaHesap = anaHesapBilgisi();

		$islem = $this->input->get('islem');

		$tarihGet = $this->input->get('tarihAraligi');

		$tarihAraligi = explode(' - ', $tarihGet);

		$tarih1 = date('Y-m-d', strtotime($tarihAraligi[0])); //küçük tarih
		$tarih2 = date('Y-m-d', strtotime($tarihAraligi[1])); //büyük tarih

		$urim = $this->uri->segment(2);

		$segment = 2;
		$sayfa = $this->input->get("sayfa");

		$page = $sayfa ? $sayfa : 0;
		$limit = 20;

		if($sayfa){$pagem = ($page-1)*$limit;}
		else{$pagem = 0;/*logekle(51,1);*/}

		if((isset($islem) && !empty($islem)) || (isset($tarihGet) && !empty($tarihGet))){

			if(!empty($islem)){$sorgu1 = "AND log_islemTipi = '$islem'";}
			else{$sorgu1 = "";}


			if(!empty($tarihGet)){$sorgu3 = "AND log_islemTarih BETWEEN '$tarih1' AND '$tarih2'";}
			else{$sorgu3 = "";}

			$countq = "SELECT COUNT(*) as total FROM loglar WHERE log_anaHesap = '$anaHesap'  ".$sorgu1." ".$sorgu3." ";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;

			$sorgu = "SELECT * FROM loglar WHERE log_anaHesap = '$anaHesap'  ".$sorgu1." ".$sorgu3." ORDER BY log_id DESC LIMIT $pagem,$limit";
		}else{
			$countq = "SELECT COUNT(*) as total FROM loglar WHERE log_anaHesap = '$anaHesap'";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;
			$sorgu = "SELECT * FROM loglar WHERE log_anaHesap = '$anaHesap' ORDER BY log_id DESC LIMIT $pagem,$limit";
		}
		$data["count_of_list"] = $count;

		$this->load->library("pagination");

		$config = array();
		$config["base_url"] = base_url() . "/yonetici/$urim";
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
		$data["loglar"] = $this->db->query($sorgu)->result();

		$this->load->view("yonetici/kullanici-loglari",$data);
	}

	public function yeniKullaniciEkle(){

		if(gibYetki()==1)
			redirect("home/hata");

		if(isDemoActive() == 1)
			redirect("home/hata");

		$data["baslik"] = "Yönetici / Yeni Kullanıcı Ekle";
		//logekle(48,1);
		$this->load->view("yonetici/yeni-kullanici-ekle", $data);
	}

	public function kullaniciOlustur(){

		if(gibYetki()==1)
			redirect("home/hata");
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d H:i:s');

		$anaHesap = anaHesapBilgisi();

		$sifre = postval("kullanici_sifre");
		$sifreTekrar = postval("kullanici_sifreTekrar");

		$eposta = postval("kullanici_eposta");

		if($sifre == $sifreTekrar){
			$data["kullanici_eposta"] = $eposta;
			$data["kullanici_ad"] = postval("kullanici_ad");
			$data["kullanici_soyad"] = postval("kullanici_soyad");
			$data["kullanici_kullaniciAdi"] = postval("kullanici_kullaniciAdi");
			$data["kullanici_sifre"] = md5($sifre);
			$data["kullanici_yetki"] = postval("kullanici_yetki");
			$data["kullanici_durum"] = postval("kullanici_durum");
			$data["kullanici_anaHesapID"] = $anaHesap;
			$data["kullanici_olusturmaTarihi"] = $tarihi;
			$data["kullanici_olusturan"] = $u_id;

			$kullaniciEpostaVarmiQ = "SELECT * FROM kullanicilar WHERE kullanici_eposta = '$eposta'";
			$kullaniciEpostaVarmi = $this->db->query($kullaniciEpostaVarmiQ)->row();

			if($kullaniciEpostaVarmi){
				$this->session->set_flashdata('kullanici_eposta_mevcut','OK');
				redirect("yonetici/yeni-kullanici-ekle");			}else{
				$this->vt->insert("kullanicilar",$data);
				$kullanici_idsi = $this->db->insert_id();
				
				// Kullanıcı başarıyla oluşturulduktan sonra otomatik varsayılan kasa oluştur
				$this->otomatikKasaOlustur($kullanici_idsi, $u_id, $anaHesap, $tarihi);
				
				$this->session->set_flashdata('kullanici_ok','OK');
				logekle(48,2);
				redirect("yonetici/mevcut-kullanici-duzenle/$kullanici_idsi");
			}
		}else{
			$this->session->set_flashdata('kullanici_sifreHata','OK');
			redirect("yonetici/yeni-kullanici-ekle");
		}
	}

	public function mevcutKullaniciDuzenle($id){

		if(gibYetki()==1)
			redirect("home/hata");
		$data["baslik"] = "Yönetici / Mevcut Kullanıcı Düzenle";
		$anaHesap = anaHesapBilgisi();

		$kullaniciQ = "SELECT * FROM kullanicilar WHERE kullanici_id = '$id'";
		$data["kullanici"] = $this->db->query($kullaniciQ)->row();

		$olusturanHesapKim = $data["kullanici"]->kullanici_anaHesapID;

		if($anaHesap == $olusturanHesapKim){
			//logekle(48,1);
			$this->load->view("yonetici/mevcut-kullanici-duzenle", $data);
		}else{
			redirect('hata');
		}
	}

	public function kullaniciDuzenle(){

		if(gibYetki()==1)
			redirect("home/hata");
		$kullanici_id = postval("kullanici_id");

		$anaHesap = anaHesapBilgisi();

		$sifre = postval("kullanici_sifre");
		$sifreTekrar = postval("kullanici_sifreTekrar");
		$eposta = postval("kullanici_eposta");

		if(!empty($sifre) && !empty($sifreTekrar)){
			if($sifre == $sifreTekrar){
				$data["kullanici_sifre"]  = md5($sifre);
			}else{
				$this->session->set_flashdata('kullanici_sifreHata','OK');
				redirect("yonetici/mevcut-kullanici-duzenle/$kullanici_id");
			}
		}

		$data["kullanici_eposta"] = $eposta;
		$data["kullanici_ad"] = postval("kullanici_ad");
		$data["kullanici_soyad"] = postval("kullanici_soyad");
		$data["kullanici_kullaniciAdi"] = postval("kullanici_kullaniciAdi");
		$data["kullanici_yetki"] = postval("kullanici_yetki");
		$data["kullanici_durum"] = postval("kullanici_durum");

		$kullaniciEpostaVarmiQ = "SELECT * FROM kullanicilar WHERE kullanici_eposta = '$eposta' AND kullanici_id != '$kullanici_id'";
		$kullaniciEpostaVarmi = $this->db->query($kullaniciEpostaVarmiQ)->row();

		if($kullaniciEpostaVarmi){
			$this->session->set_flashdata('kullanici_eposta_mevcut','OK');
			redirect("yonetici/mevcut-kullanici-duzenle/$kullanici_id");
		}else{
			$this->vt->update('kullanicilar', array('kullanici_id'=>$kullanici_id), $data);
			$this->session->set_flashdata('kullanici_update_ok','OK');
			logekle(48,3);
			redirect("yonetici/mevcut-kullanici-duzenle/$kullanici_id");
		}
	}

	public function kullaniciListesi(){

		if(gibYetki()==1)
			redirect("home/hata");
		$data["baslik"] = "Yönetici / Kullanıcı Listesi";
		$anaHesap = anaHesapBilgisi();

		$kullaniciEposta = $this->input->get('kullaniciEposta');
		$kullaniciAdi = $this->input->get('kullaniciAdi');

		$urim = $this->uri->segment(2);
		
		$segment = 2;
		$sayfa = $this->input->get("sayfa");

		$page = $sayfa ? $sayfa : 0;
		$limit = 20;

		if($sayfa){$pagem = ($page-1)*$limit;}
		else{$pagem = 0;/*logekle(50,1);*/}

		if((isset($kullaniciEposta) && !empty($kullaniciEposta)) || (isset($kullaniciAdi) && !empty($kullaniciAdi))){
			$countq = "SELECT COUNT(*) as total FROM kullanicilar WHERE kullanici_anaHesapID = '$anaHesap' AND kullanici_eposta LIKE '%$kullaniciEposta%' AND kullanici_kullaniciAdi LIKE '%$kullaniciAdi%'";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;

			$sorgu = "SELECT * FROM kullanicilar WHERE kullanici_anaHesapID = '$anaHesap' AND kullanici_eposta LIKE '%$kullaniciEposta%' AND kullanici_kullaniciAdi LIKE '%$kullaniciAdi%' ORDER BY kullanici_id DESC LIMIT $pagem,$limit";
		}else{
			$countq = "SELECT COUNT(*) as total FROM kullanicilar WHERE kullanici_anaHesapID = '$anaHesap'";
			$countexe = $this->db->query($countq)->row();
			$count = $countexe->total;
			$sorgu = "SELECT * FROM kullanicilar WHERE kullanici_anaHesapID = '$anaHesap' ORDER BY kullanici_id DESC LIMIT $pagem,$limit";
		}

		$data["count_of_list"] = $count;

		$this->load->library("pagination");

		$config = array();
		$config["base_url"] = base_url() . "/yonetici/$urim";
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
		$data["kullanici"] = $this->db->query($sorgu)->result();

		$this->load->view("yonetici/kullanici-listesi",$data);
	}

	public function ayarlar(){
		$data["baslik"] = "Yönetici / Ayarlar";
		$anaHesap = anaHesapBilgisi();
		$ayarlarQ = "SELECT * FROM ayarlar WHERE ayarlar_id = '$anaHesap'";
		$data["ayar"] = $this->db->query($ayarlarQ)->row();

		$iller = $this->db->get('iller');

		if($iller->num_rows() > 0){$data['_iller'] = $iller->result();
		}else{$data['_iller'] = false;}

		$ayarlarBanka="select * from ayarlar_banka where ayarlarbanka_ayarID='$anaHesap'";
		$data["ayarlarBanka"]=$this->db->query($ayarlarBanka)->result();


		//logekle(53,1);
		$this->load->view("yonetici/ayarlar",$data);
	}

	public function ayarlarGuncelle(){
		$ayarlar_id = postval("ayarlar_id");

		$data["ayarlar_firmaAd"] = postval("ayarlar_firmaAd");
		$data["ayarlar_firmaSektor"] = postval("ayarlar_firmaSektor");
		$data["ayarlar_telefon"] = postval("ayarlar_telefon");
		$data["ayarlar_eposta"] = postval("ayarlar_eposta");
		$data["ayarlar_vergiDairesi"] = postval("ayarlar_vergiDairesi");
		$data["ayarlar_vergiNo"] = postval("ayarlar_vergiNo");
		$data["ayarlar_il"] = postval("ayarlar_il");
		$data["ayarlar_ilce"] = postval("ayarlar_ilce");
		$data["ayarlar_adres"] = postval("ayarlar_adres");


		$data["ayarlar_deletePermission"] = postval("ayarlar_deletePermission");

		//$data["ayarlar_lisansAnahtari"] = postval("ayarlar_lisansAnahtari");

		$ayar=$this->vt->single('ayarlar',array('ayarlar_id'=>$ayarlar_id));

		if($ayar->ayarlar_deletePermission!=$data["ayarlar_deletePermission"])
			if($data["ayarlar_deletePermission"]==1)
				logekle(64,3);
			else
				logekle(65,3);

		$this->vt->update('ayarlar', array('ayarlar_id'=>$ayarlar_id), $data);
		logekle(53,3);


		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;
		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');
		$anaHesap = anaHesapBilgisi();

		$this->db->delete('ayarlar_banka', array('ayarlarbanka_ayarID' => $ayarlar_id));

		$dataBanka["ayarlarbanka_ayarID"]=$ayarlar_id;
		$bankaAd=postval("ayarlar_bankaadi");
		$subeAd=postval("ayarlar_sube");
		$iban=postval("ayarlar_iban");
		$hesapNo=postval("ayarlar_hesapno");
		$paraBirimi=postval("ayarlar_parabirimi");
		$bankaCount=postval("bankaCount");
		for($i=0;$i<$bankaCount;$i++) {
			$dataBanka["ayarlarbanka_ad"] =$bankaAd[$i];
			$dataBanka["ayarlarbanka_subeAd"] =$subeAd[$i];
			$dataBanka["ayarlarbanka_iban"] =$iban[$i];
			$dataBanka["ayarlarbanka_hesapNo"] =$hesapNo[$i];
			$dataBanka["ayarlarbanka_paraBirim"] =$paraBirimi[$i];

			$dataBanka["ayarlarbanka_olusturan"] = $u_id;
			$dataBanka["ayarlarbanka_olusturanAnaHesap"] = $anaHesap;
			$dataBanka["ayarlarbanka_olusturmaTarihi"] = $tarihi;
			$dataBanka["ayarlarbanka_olusturmaSaati"] = $saati;
			$this->vt->insert("ayarlar_banka",$dataBanka);
			logekle(53,2);
		}

		$this->session->set_flashdata('ayarlar_update_ok','OK');
		redirect("yonetici/ayarlar");

	}

	public function kullaniciYetkileriDuzenle(){
		$data["baslik"] = "Yönetici / Kullanıcı Yetkileri Düzenle";
		$anaHesap = anaHesapBilgisi();

		$kullanici = $this->input->get("kullanici");

		$kullaniciQ = "SELECT * FROM kullanicilar WHERE kullanici_id = '$kullanici'";
		$kullaniciExe = $this->db->query($kullaniciQ)->row();

		$olusturanHesapKim = $kullaniciExe->kullanici_anaHesapID;

		if($kullanici){
			if($anaHesap == $olusturanHesapKim){
				$this->load->view("yonetici/kullanici-yetkileri-duzenle",$data);
			}else{
				redirect('hata');
			}
		}else{
			$this->load->view("yonetici/kullanici-yetkileri-duzenle",$data);
		}
		
	}

	public function kullaniciYetkileriGuncelle(){
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		$kullanici_id = postval("kullanici_id");

		$post = $this->input->post();

		//modülId = 1)Cari 2)Stok 3)Fatura 4)Kasa 5)Banka 6)Rapor 7)Giderler

		if($post["cari"]){
				$m1Array2 = [];

				foreach($post["cari"] as $ps){
					$data = array("ky_kullaniciID" => $kullanici_id, "ky_modul" => 1, "ky_yetki"=>$ps, "ky_guncelleyen"=>$u_id);

					$yetkiSorgula = yetkiSorgula($kullanici_id,1,$ps);

					if(!$yetkiSorgula){
						$this->vt->insert("kullaniciYetkileri", $data);
					}

					$m1Array2[] = $ps;
				}

				 $modul1q = "SELECT * FROM kullaniciYetkileri WHERE ky_modul = 1 AND ky_kullaniciID = '$kullanici_id'";
				 $modul1 = $this->db->query($modul1q)->result();

				 $m1Array = [];

				  foreach($modul1 as $m1exe){
				      $m1Array[] = $m1exe->ky_yetki;
				  }

				  $diff1 = array_diff($m1Array, $m1Array2);

				  if(!empty($diff1)){
				      foreach($diff1 as $key => $value){
				      	$this->db->delete('kullaniciYetkileri', array('ky_modul' => 1, 'ky_yetki' => $value, 'ky_kullaniciID' => $kullanici_id));
				      }
				  }
		}else if(empty($post["cari"])){
			$this->db->delete('kullaniciYetkileri', array('ky_modul' => 1, 'ky_kullaniciID' => $kullanici_id));
		}



		if($post["stok"]){
			$m2Array2 = [];

			foreach($post["stok"] as $ps){
				$data = array("ky_kullaniciID" => $kullanici_id, "ky_modul" => 2, "ky_yetki"=>$ps, "ky_guncelleyen"=>$u_id);
				
				$yetkiSorgula = yetkiSorgula($kullanici_id,2,$ps);

					if(!$yetkiSorgula){
						$this->vt->insert("kullaniciYetkileri", $data);
					}

				$m2Array2[] = $ps;
			}

			$modul2q = "SELECT * FROM kullaniciYetkileri WHERE ky_modul = 2 AND ky_kullaniciID = '$kullanici_id'";
				 $modul2 = $this->db->query($modul2q)->result();

				 $m2Array = [];

				  foreach($modul2 as $m2exe){
				      $m2Array[] = $m2exe->ky_yetki;
				  }

				  $diff2 = array_diff($m2Array, $m2Array2);

				  if(!empty($diff2)){
				      foreach($diff2 as $key => $value){
				      	$this->db->delete('kullaniciYetkileri', array('ky_modul' => 2, 'ky_yetki' => $value, 'ky_kullaniciID' => $kullanici_id));
				      }
				  }
		}else if(empty($post["stok"])){
			$this->db->delete('kullaniciYetkileri', array('ky_modul' => 2, 'ky_kullaniciID' => $kullanici_id));
		}

		if($post["fatura"]){
			$m3Array2 = [];
			foreach($post["fatura"] as $ps){
				$data = array("ky_kullaniciID" => $kullanici_id, "ky_modul" => 3, "ky_yetki"=>$ps, "ky_guncelleyen"=>$u_id);
				$yetkiSorgula = yetkiSorgula($kullanici_id,3,$ps);

					if(!$yetkiSorgula){
						$this->vt->insert("kullaniciYetkileri", $data);
					}

				$m3Array2[] = $ps;
			}

			$modul3q = "SELECT * FROM kullaniciYetkileri WHERE ky_modul = 3 AND ky_kullaniciID = '$kullanici_id'";
				 $modul3 = $this->db->query($modul3q)->result();

				 $m3Array = [];

				  foreach($modul3 as $m3exe){
				      $m3Array[] = $m3exe->ky_yetki;
				  }

				  $diff3 = array_diff($m3Array, $m3Array2);

				  if(!empty($diff3)){
				      foreach($diff3 as $key => $value){
				      	$this->db->delete('kullaniciYetkileri', array('ky_modul' => 3, 'ky_yetki' => $value, 'ky_kullaniciID' => $kullanici_id));
				      }
				  }
		}else if(empty($post["fatura"])){
			$this->db->delete('kullaniciYetkileri', array('ky_modul' => 3, 'ky_kullaniciID' => $kullanici_id));
		}

		if($post["kasa"]){
			$m4Array2 = [];
			foreach($post["kasa"] as $ps){
				$data = array("ky_kullaniciID" => $kullanici_id, "ky_modul" => 4, "ky_yetki"=>$ps, "ky_guncelleyen"=>$u_id);
				$yetkiSorgula = yetkiSorgula($kullanici_id,4,$ps);

					if(!$yetkiSorgula){
						$this->vt->insert("kullaniciYetkileri", $data);
					}

				$m4Array2[] = $ps;
			}

			$modul4q = "SELECT * FROM kullaniciYetkileri WHERE ky_modul = 4 AND ky_kullaniciID = '$kullanici_id'";
				 $modul4 = $this->db->query($modul4q)->result();

				 $m1Array = [];

				  foreach($modul4 as $m4exe){
				      $m4Array[] = $m4exe->ky_yetki;
				  }

				  $diff4 = array_diff($m4Array, $m4Array2);

				  if(!empty($diff4)){
				      foreach($diff4 as $key => $value){
				      	$this->db->delete('kullaniciYetkileri', array('ky_modul' => 4, 'ky_yetki' => $value, 'ky_kullaniciID' => $kullanici_id));
				      }
				  }
		}else if(empty($post["kasa"])){
			$this->db->delete('kullaniciYetkileri', array('ky_modul' => 4, 'ky_kullaniciID' => $kullanici_id));
		}

		if($post["banka"]){
			$m5Array2 = [];
			foreach($post["banka"] as $ps){
				$data = array("ky_kullaniciID" => $kullanici_id, "ky_modul" => 5, "ky_yetki"=>$ps, "ky_guncelleyen"=>$u_id);
				$yetkiSorgula = yetkiSorgula($kullanici_id,5,$ps);

					if(!$yetkiSorgula){
						$this->vt->insert("kullaniciYetkileri", $data);
					}

				$m5Array2[] = $ps;
			}

			$modul5q = "SELECT * FROM kullaniciYetkileri WHERE ky_modul = 5 AND ky_kullaniciID = '$kullanici_id'";
				 $modul5 = $this->db->query($modul5q)->result();

				 $m5Array = [];

				  foreach($modul5 as $m5exe){
				      $m5Array[] = $m5exe->ky_yetki;
				  }

				  $diff5 = array_diff($m5Array, $m5Array2);

				  if(!empty($diff5)){
				      foreach($diff5 as $key => $value){
				      	$this->db->delete('kullaniciYetkileri', array('ky_modul' => 5, 'ky_yetki' => $value, 'ky_kullaniciID' => $kullanici_id));
				      }
				  }
		}else if(empty($post["banka"])){
			$this->db->delete('kullaniciYetkileri', array('ky_modul' => 5, 'ky_kullaniciID' => $kullanici_id));
		}

		if($post["rapor"]){
			$m6Array2 = [];
			foreach($post["rapor"] as $ps){
				$data = array("ky_kullaniciID" => $kullanici_id, "ky_modul" => 6, "ky_yetki"=>$ps, "ky_guncelleyen"=>$u_id);
				$yetkiSorgula = yetkiSorgula($kullanici_id,6,$ps);

					if(!$yetkiSorgula){
						$this->vt->insert("kullaniciYetkileri", $data);
					}

				$m6Array2[] = $ps;
			}

			$modul6q = "SELECT * FROM kullaniciYetkileri WHERE ky_modul = 6 AND ky_kullaniciID = '$kullanici_id'";
				 $modul6 = $this->db->query($modul6q)->result();

				 $m6Array = [];

				  foreach($modul6 as $m6exe){
				      $m6Array[] = $m6exe->ky_yetki;
				  }

				  $diff6 = array_diff($m6Array, $m6Array2);

				  if(!empty($diff6)){
				      foreach($diff6 as $key => $value){
				      	$this->db->delete('kullaniciYetkileri', array('ky_modul' => 6, 'ky_yetki' => $value, 'ky_kullaniciID' => $kullanici_id));
				      }
				  }
		}else if(empty($post["rapor"])){
			$this->db->delete('kullaniciYetkileri', array('ky_modul' => 6, 'ky_kullaniciID' => $kullanici_id));
		}
		
		if($post["giderler"]){
			$m7Array2 = [];
			foreach($post["giderler"] as $ps){
				$data = array("ky_kullaniciID" => $kullanici_id, "ky_modul" => 7, "ky_yetki"=>$ps, "ky_guncelleyen"=>$u_id);
				$yetkiSorgula = yetkiSorgula($kullanici_id,7,$ps);

					if(!$yetkiSorgula){
						$this->vt->insert("kullaniciYetkileri", $data);
					}

				$m7Array2[] = $ps;
			}

			$modul7q = "SELECT * FROM kullaniciYetkileri WHERE ky_modul = 7 AND ky_kullaniciID = '$kullanici_id'";
				 $modul7 = $this->db->query($modul7q)->result();

				 $m7Array = [];

				  foreach($modul7 as $m7exe){
				      $m7Array[] = $m7exe->ky_yetki;
				  }

				  $diff7 = array_diff($m7Array, $m7Array2);

				  if(!empty($diff7)){
				      foreach($diff7 as $key => $value){
				      	$this->db->delete('kullaniciYetkileri', array('ky_modul' => 7, 'ky_yetki' => $value, 'ky_kullaniciID' => $kullanici_id));
				      }
				  }
		}else if(empty($post["giderler"])){
			$this->db->delete('kullaniciYetkileri', array('ky_modul' => 7, 'ky_kullaniciID' => $kullanici_id));
		}

		$this->session->set_flashdata('kullanici_yetkileri_ok','OK');
		logekle(49,3);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function logoGuncelle(){
		if(!empty($_FILES['file']['name'])){
            $config['upload_path'] = 'assets/bulut/logo'; 
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size'] = '100';
            $config['file_name'] = $_FILES['file']['name'];
            $config['encrypt_name'] = TRUE;
            $config['max_width'] = 250;
            $config['max_height'] = 250;

            $this->load->library('upload',$config); 

            if($this->upload->do_upload('file')){
                $fileName = $this->upload->data('file_name');
                $originalName = $this->upload->data('orig_name');

                $uploadData = $this->upload->data();

                if($uploadData){
                    $data_upload["ayarlar_logoName"] = $fileName;
                    $data_upload["ayarlar_logoOriginalFileName"] = $originalName;

                    $aid = postval("anaHesap");

                    $this->vt->update('ayarlar', array('ayarlar_id'=>$aid), $data_upload);

                    $this->session->set_flashdata('document_uploaded','ok');

                    redirect($_SERVER['HTTP_REFERER']);
                }
            }else{
            	$this->session->set_flashdata('document_uploaded_error','ok');

                    redirect($_SERVER['HTTP_REFERER']);
            }
        }
	}

	public function yukle($id){
		if($id == 1){//akınsoft
			$data["erp"] = 1;
			$data["erpBaslik"] = "Akınsoft";
			$this->load->view("yonetici/yukle",$data);
		}else{
			//diğer
		}
	}

	public function yukle_islem(){
		/* 
		
		Cari Hareketleri

		1 = Alış Faturası
		2 = Satış Faturası 
		3 = Banka Havalesi 
		4 = Banka EFT
		5 = Kasa Tahsilat
		6 = Kasa Ödeme
		7 = Cari Dekont 
		8 = Alınan Çek
		9 = Verilen Çek
		10 = Alınan Senet
		11 = Verilen Senet
		12 = E-Fatura
		13 = E-Arşiv


		Onların 

		Çek
		Dekont
		EFT
		Evrak
		Fatura
		Havale
		Nakit



		ALIŞ FATURASI = ch_alacak
		SATIŞ FATURASI = ch_borc


		ch_belgeNumarasi = 6
		ch_turu = 3
		ch_cariID = 1 (sorgulanmış hali)
		ch_paraBirimi = TL

			4 , 0 değilse
		ch_borc
			5 , 0 değilse
		ch_alacak


		ch_tarih == 2022-04-05
		ch_olusturan = 106
		ch_olusturanAnaHesap = 91

		ch_olusturmaTarihi = 2022-04-05
		ch_olusturmaSaati = 09:00:00




 

		*/
		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;

		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d H:i:s');

		$tarih = (new DateTime('now'))->format('Y-m-d');
		$saat = (new DateTime('now'))->format('H:i:s');

		$anaHesap = anaHesapBilgisi();

		if(!empty($_FILES['file']['name'])){
          $config['upload_path'] = 'assets/bulut'; 
          $config['allowed_types'] = 'xls|xlsx';
          $config['encrypt_name'] = TRUE;

          $this->load->library('upload',$config); 

          if($this->upload->do_upload('file')){
          	$fileName = $this->upload->data('file_name');

            $uploadData = $this->upload->data();
            if($uploadData){
            	$inputFileName = './assets/bulut/'.$fileName;

            	try {
            	$inputFileType = PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
					    $objReader = PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
					    $objPHPExcel = $objReader->load($inputFileName);
					    }catch(Exception $e) {
							    die('Hata "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
							}

							$sheet = $objPHPExcel->getSheet(0); 
							$highestRow = $sheet->getHighestRow(); 
							$highestColumn = $sheet->getHighestColumn();

							for ($row = 1; $row <= $highestRow; $row++){ 
							    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);

							    $cariKod = $rowData[0][0];
							    $stokKod = $rowData[0][1];

							    $sorgu1 = $this->db->query("SELECT cari_id FROM cari WHERE cari_kodu = '".$cariKod."' ")->row();
									$cid = $sorgu1->cari_id;

									$sorgu2 = $this->db->query("SELECT stok_id FROM stok WHERE stok_kodu = '".$stokKod."' ")->row();
									$sid = $sorgu2->stok_id;

									$islemTuru = $rowData[0][4];

									$belgeNumarasi = $rowData[0][7];

									$kpbTutar = $rowData[0][6];


								/*	if($cid && $sid){
										if($islemTuru == 'Giren'){//1 alış faturası (giriş)
										$sh_turu = 1;
										$sh_giris = $rowData[0][2];

										$this->db->query("INSERT INTO stokHareketleri (sh_turu,sh_giris,sh_cariID,sh_stokID,sh_belgeNumarasi,sh_paraBirimi,sh_tarih,sh_toplamFiyat,sh_olusturan,sh_olusturanAnaHesap,sh_olusturmaTarihi,sh_olusturmaSaati) VALUES ($sh_turu, $sh_giris,$cid,$sid,'$belgeNumarasi','TL','$tarih',$kpbTutar,$u_id,$anaHesap,'$tarih','$saat')");


										}else if($islemTuru == 'Çıkan'){//2 satış faturası (çıkış)
											$sh_turu = 2;
											$sh_cikis = $rowData[0][3];

											$this->db->query("INSERT INTO stokHareketleri (sh_turu,sh_cikis,sh_cariID,sh_stokID,sh_belgeNumarasi,sh_paraBirimi,sh_tarih,sh_toplamFiyat,sh_olusturan,sh_olusturanAnaHesap,sh_olusturmaTarihi,sh_olusturmaSaati) VALUES ($sh_turu, $sh_cikis,$cid,$sid,'$belgeNumarasi','TL','$tarih',$kpbTutar,$u_id,$anaHesap,'$tarih','$saat')");
										}
									}  */


									if($cid){
										if($turu == "Fatura"){
											if($borc == 0){
												$ch_alacak = $alacak;
												$ch_turu = 1;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_alacak,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_alacak, '".$tarih."', '106','91','".$tarih."','".$saat."')");

											}else  if($alacak == 0){
												$ch_borc = $borc;
												$ch_turu = 2;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_borc,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_borc, '".$tarih."', '106','91','".$tarih."','".$saat."')");
											}
										}

										if($turu == "Çek"){

											if($borc == 0){
												$ch_turu = 8;
												$ch_alacak = $alacak;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_alacak,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_alacak, '".$tarih."', '106','91','".$tarih."','".$saat."')");
											}else if($alacak == 0){
												$ch_turu = 9;
												$ch_borc = $borc;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_borc,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_borc, '".$tarih."', '106','91','".$tarih."','".$saat."')");
											}

										}else if($turu == "Dekont"){

											if($borc == 0){
												$ch_turu = 7;
												$ch_alacak = $alacak;
												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_alacak,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_alacak, '".$tarih."', '106','91','".$tarih."','".$saat."')");
											}else if($alacak == 0){
												$ch_turu = 7;
												$ch_borc = $borc;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_borc,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_borc, '".$tarih."', '106','91','".$tarih."','".$saat."')");
											}

										}else if($turu == "EFT"){

											if($borc == 0){
												$ch_turu = 4;
												$ch_alacak = $alacak;
												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_alacak,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_alacak, '".$tarih."', '106','91','".$tarih."','".$saat."')");
											}else if($alacak == 0){
												$ch_turu = 4;
												$ch_borc = $borc;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_borc,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_borc, '".$tarih."', '106','91','".$tarih."','".$saat."')");
											}

										}else if($turu == "Evrak"){//olmayacak

											if($borc == 0){
												$ch_turu = 8;
												$ch_alacak = $alacak;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_alacak,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_alacak, '".$tarih."', '106','91','".$tarih."','".$saat."')");
											}else if($alacak == 0){
												$ch_turu = 9;
												$ch_borc = $borc;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_borc,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_borc, '".$tarih."', '106','91','".$tarih."','".$saat."')");
											}

										}else if($turu == "Havale"){

											if($borc == 0){
												$ch_turu = 3;
												$ch_alacak = $alacak;
												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_alacak,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_alacak, '".$tarih."', '106','91','".$tarih."','".$saat."')");
											}else if($alacak == 0){
												$ch_turu = 3;
												$ch_borc = $borc;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_borc,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_borc, '".$tarih."', '106','91','".$tarih."','".$saat."')");
											}

										}else if($turu == "Nakit"){//olmayacak
											/*
														5 = Kasa Tahsilat
														6 = Kasa Ödeme
											*/
											if($borc == 0){
												$ch_turu = 5;
												$ch_alacak = $alacak;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_alacak,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_alacak, '".$tarih."', '106','91','".$tarih."','".$saat."')");
											}else if($alacak == 0){
												$ch_turu = 6;
												$ch_borc = $borc;

												$this->db->query("INSERT INTO cariHareketleri (ch_belgeNumarasi,ch_turu,ch_cariID,ch_paraBirimi,ch_borc,ch_tarih,ch_olusturan,ch_olusturanAnaHesap,ch_olusturmaTarihi,ch_olusturmaSaati) VALUES ('".$belgeNumarasi."', $ch_turu, $cid, 'TL', $ch_borc, '".$tarih."', '106','91','".$tarih."','".$saat."')");
											}

										}
									}

									

							    /* $cariAd = $rowData[0][1];

									$sorgu1 = $this->db->query("SELECT cari_id FROM cari WHERE cari_ad = '".$cariAd."' ")->row();
									$cid = $sorgu1->cari_id;

									$vkn = $rowData[0][6];
									$vknLength = strlen($vkn);

									$vd = $rowData[0][5];

									if($vknLength == 10){//vkn
										$this->db->query("UPDATE cari SET cari_vergiNumarasi = $vkn, cari_vergiDairesi = '$vd' WHERE cari_id = $cid ");
									}else if($vknLength == 11){//tckn
										$this->db->query("UPDATE cari SET cari_vergiNumarasi = '', cari_tckn = $vkn  WHERE cari_id = $cid ");
									} */
							}
            }else{
            	echo $this->upload->display_errors();
            }
            
          }
			}		}

	/**
	 * Yeni kullanıcı oluşturulduğunda otomatik olarak varsayılan kasa oluşturur
	 *
	 * @param int $kullanici_id Oluşturulan kullanıcının ID'si
	 * @param int $olusturan_kullanici_id Kasayı oluşturan kullanıcının ID'si
	 * @param int $anaHesap Ana hesap ID'si
	 * @param string $tarih Oluşturma tarihi
	 */
	private function otomatikKasaOlustur($kullanici_id, $olusturan_kullanici_id, $anaHesap, $tarih) {
		try {
			// Kullanıcı bilgilerini al
			$kullaniciQ = "SELECT kullanici_ad, kullanici_soyad FROM kullanicilar WHERE kullanici_id = '$kullanici_id'";
			$kullanici = $this->db->query($kullaniciQ)->row();
			
			if ($kullanici) {
				$kullaniciAdSoyad = $kullanici->kullanici_ad . ' ' . $kullanici->kullanici_soyad;
				
				// Otomatik kasa bilgileri
				$kasaKodu = "KASA-" . str_pad($kullanici_id, 4, '0', STR_PAD_LEFT);
				$kasaAdi = $kullaniciAdSoyad . " - Varsayılan Kasa";
				$kasaBaslangic = 0; // Başlangıç bakiyesi 0
				
				date_default_timezone_set('Europe/Istanbul');
				$saati = (new DateTime('now'))->format('H:i:s');
				
				// Aynı kasa kodunun var olup olmadığını kontrol et
				$kasaVarmiQ = "SELECT * FROM kasa WHERE kasa_kodu = '$kasaKodu' AND kasa_olusturanAnaHesap = '$anaHesap'";
				$kasaVarmi = $this->db->query($kasaVarmiQ)->row();
				
				if (!$kasaVarmi) {
					// Kasa tablosuna kayıt ekle
					$dataKasa = array(
						"kasa_kodu" => $kasaKodu,
						"kasa_adi" => $kasaAdi,
						"kasa_baslangic" => $kasaBaslangic,
						"kasa_aciklama" => "Kullanıcı oluşturulduğunda otomatik oluşturulan varsayılan kasa",
						"kasa_olusturanAnaHesap" => $anaHesap,
						"kasa_olusturan" => $olusturan_kullanici_id,
						"kasa_olusturmaTarihi" => $tarih,
						"kasa_olusturmaSaati" => $saati
					);
					
					$this->vt->insert("kasa", $dataKasa);
					$kasa_id = $this->db->insert_id();
					
					// Kasa hareketleri tablosuna başlangıç kaydı ekle
					$dataKasaHareket = array(
						"kh_kasaID" => $kasa_id,
						"kh_turu" => 14, // Kasa açılış bakiyesi türü
						"kh_giris" => $kasaBaslangic,
						"kh_tarih" => $tarih,
						"kh_aciklama" => "Otomatik Oluşturulan Kasa - Açılış Bakiyesi",
						"kh_olusturan" => $olusturan_kullanici_id,
						"kh_olusturanAnaHesap" => $anaHesap,
						"kh_olusturmaTarihi" => $tarih,
						"kh_olusturmaSaati" => $saati
					);
					
					$this->vt->insert("kasaHareketleri", $dataKasaHareket);
					
					// Log ekle (opsiyonel - eğer logekle fonksiyonu varsa)
					if (function_exists('logekle')) {
						logekle(50, 2); // Kasa oluşturma log kodu
					}
				}
			}
		} catch (Exception $e) {
			// Hata durumunda sessizce devam et, kullanıcı oluşturma işlemini etkilemesin
			// İsteğe bağlı olarak log kaydı yapılabilir
			log_message('error', 'Otomatik kasa oluşturma hatası: ' . $e->getMessage());
		}
	}


}
