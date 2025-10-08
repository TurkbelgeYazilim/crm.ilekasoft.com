<?php

defined('BASEPATH') OR exit('No direct script access allowed');



use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Helper\Sample;

use PhpOffice\PhpSpreadsheet\IOFactory;



class Stok extends CI_Controller {



  public function __construct(){

		parent::__construct();

		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

		$this->load->model('vt');

		

		$control = session("r", "login");





	  if(gibYetki()==1)

		  redirect("home/hata");

	  //sessionKontrolHelper();



	  if(!$control){

			redirect("check");

		}

	}



	public function stokGruplari(){

		$data["baslik"] = "Stok / Stok Grupları";



		$anaHesap = anaHesapBilgisi();



		$stokGruplariQ = "SELECT * FROM stokGruplari WHERE stokGrup_olusturanAnaHesap = '$anaHesap'";

		$data["stokGruplari"] = $this->db->query($stokGruplariQ)->result();



		$countq = "SELECT COUNT(*) as total FROM stokGruplari WHERE stokGrup_olusturanAnaHesap = '$anaHesap'";

			$countexe = $this->db->query($countq)->row();

			$count = $countexe->total;

			$data["count_of_list"] = $count;



		//logekle(8,1);



		$this->load->view("stok/stok-gruplari",$data);

	}



	public function yeniStokGrubuEkle(){

		$control2 = session("r", "login_info");

		$u_id = $control2->kullanici_id;



		date_default_timezone_set('Europe/Istanbul');

		$tarihi = (new DateTime('now'))->format('Y.m.d H:i:s');



		$anaHesap = anaHesapBilgisi();



		$stokGrup_kodu = postval("stokGrup_kodu");



		$data["stokGrup_kodu"] = $stokGrup_kodu;

		$data["stokGrup_ad"] = postval("stokGrup_ad");

		$data["stokGrup_olusturan"] = $u_id;

		$data["stokGrup_olusturanAnaHesap"] = $anaHesap;

		$data["stokGrup_olusturmaTarihi"] = $tarihi;



		$stokGrupKoduVarmiQ = "SELECT * FROM stokGruplari WHERE stokGrup_kodu = '$stokGrup_kodu' AND stokGrup_olusturanAnaHesap = '$anaHesap'";

		$stokGrupKoduVarmi = $this->db->query($stokGrupKoduVarmiQ)->row();



		if($stokGrupKoduVarmi){

			$this->session->set_flashdata('stok_grup_kodvar','OK');

			redirect($_SERVER['HTTP_REFERER']);

		}else{

			$this->vt->insert("stokGruplari",$data);

			$this->session->set_flashdata('stok_grup_ok','OK');

			logekle(8,2);

			redirect($_SERVER['HTTP_REFERER']);

		}

	}



	public function mevcutStokGrubuDuzenle(){

		$id = postval("stokGrup_id");

		$stokGrup_kodu = postval("stokGrup_kodu");



		$anaHesap = anaHesapBilgisi();



		$data["stokGrup_kodu"] = $stokGrup_kodu;

		$data["stokGrup_ad"] = postval("stokGrup_ad");



		$stokGrupKoduVarmiQ = "SELECT * FROM stokGruplari WHERE stokGrup_kodu = '$stokGrup_kodu' AND stokGrup_olusturanAnaHesap = '$anaHesap' AND stokGrup_id != $id";

		$stokGrupKoduVarmi = $this->db->query($stokGrupKoduVarmiQ)->row();



		if($stokGrupKoduVarmi){

			$this->session->set_flashdata('stok_grup_kodvar','OK');

			redirect($_SERVER['HTTP_REFERER']);

		}else{

			$this->vt->update('stokGruplari', array('stokGrup_id'=>$id), $data);

			$this->session->set_flashdata('stok_grup_updt_ok','OK');

			logekle(8,3);

			redirect($_SERVER['HTTP_REFERER']);

		}

	}



	public function stokBirimleri(){

		$data["baslik"] = "Stok / Stok Birimleri";

		$anaHesap = anaHesapBilgisi();



		$stokBirimleriQ = "SELECT * FROM stokBirimleri";

		$data["stokBirimleri"] = $this->db->query($stokBirimleriQ)->result();



		$countq = "SELECT COUNT(*) as total FROM stokBirimleri";

			$countexe = $this->db->query($countq)->row();

			$count = $countexe->total;

			$data["count_of_list"] = $count;



		//logekle(9,1);



		$this->load->view("stok/stok-birimleri",$data);

	}



	public function yeniStokBirimiEkle(){

		$control2 = session("r", "login_info");

		$u_id = $control2->kullanici_id;



		date_default_timezone_set('Europe/Istanbul');

		$tarihi = (new DateTime('now'))->format('Y.m.d H:i:s');



		$anaHesap = anaHesapBilgisi();



		$data["stokBirim_ad"] = postval("stokBirim_ad");

		$data["stokBirim_kisaltma"] = postval("stokBirim_kisaltma");

		$data["stokBirim_olusturan"] = $u_id;

		$data["stokBirim_olusturanAnaHesap"] = $anaHesap;

		$data["stokBirim_olusturmaTarihi"] = $tarihi;



		$this->vt->insert("stokBirimleri",$data);

		$this->session->set_flashdata('stok_birim_ok','OK');

		logekle(9,2);

		redirect($_SERVER['HTTP_REFERER']);

	}



	public function mevcutStokBirimiDuzenle(){

		$id = postval("stokBirim_id");



		$anaHesap = anaHesapBilgisi();



		$data["stokBirim_ad"] = postval("stokBirim_ad");

		$data["stokBirim_kisaltma"] = postval("stokBirim_kisaltma");



		$this->vt->update('stokBirimleri', array('stokBirim_id'=>$id), $data);

		$this->session->set_flashdata('stok_birim_updt_ok','OK');

		logekle(9,3);

		redirect($_SERVER['HTTP_REFERER']);

	}



	public function stokKartiOlustur(){

		$data["baslik"] = "Stok / Stok Kartı Oluştur";

		

		$anaHesap = anaHesapBilgisi();



		$stokGruplariQ = "SELECT * FROM stokGruplari WHERE stokGrup_olusturanAnaHesap = '$anaHesap'";

		$data["stokGruplari"] = $this->db->query($stokGruplariQ)->result();



		$stokBirimleriQ = "SELECT * FROM stokBirimleri";

		$data["stokBirimleri"] = $this->db->query($stokBirimleriQ)->result();



		//logekle(5,1);

		$this->load->view('stok/stok-karti-olustur',$data);

	}



	public function yeniStokKartiOlustur(){

		$control2 = session("r", "login_info");

		$u_id = $control2->kullanici_id;



		date_default_timezone_set('Europe/Istanbul');

		$tarihi = (new DateTime('now'))->format('Y.m.d');

		$saati = (new DateTime('now'))->format('H:i:s');



		$anaHesap = anaHesapBilgisi();



		$stokKodu = postval("stok_kodu");



		$kritikSeviye = postval("stok_kritikSeviyesi");



		if($kritikSeviye){

			$stokKritikSeviye = $kritikSeviye;

		}else{

			$stokKritikSeviye = NULL;

		}

		$baslangic=postval("stok_baslangic");



		$data["stok_kodu"] = $stokKodu;

		$data["stok_ad"] = postval("stok_ad");

		$data["stok_barkod"] = postval("stok_barkod");

		$data["stok_baslangic"] =$baslangic;

		$data["stok_stokGrupKoduID"] = postval("stok_stokGrupKoduID");

		$data["stok_birimID"] = postval("stok_birimID");

		$data["stok_alisFiyati"] = postval("stok_alisFiyati");

		$data["stok_satisFiyati"] = postval("stok_satisFiyati");

		$data["stok_alisKDV"] = postval("stok_alisKDV");

		$data["stok_satisKDV"] = postval("stok_satisKDV");

		$data["stok_kritikSeviyesi"] = $stokKritikSeviye;

		$data["stok_aciklama"] = postval("stok_aciklama");

		$data["stok_olusturan"] = $u_id;

		$data["stok_olusturanAnaHesap"] = $anaHesap;

		$data["stok_olusturmaTarihi"] = $tarihi;

		$data["stok_olusturmaSaati"] = $saati;



		$stokKoduVarmiQ = "SELECT * FROM stok WHERE stok_kodu = '$stokKodu' AND stok_olusturanAnaHesap = '$anaHesap'";

		$stokKoduVarmi = $this->db->query($stokKoduVarmiQ)->row();



		if($stokKoduVarmi){

			$this->session->set_flashdata('stok_kodu_mevcut','OK');

			redirect("stok/stok-karti-olustur");

		}else{

			$this->vt->insert("stok",$data);

			$stok_id = $this->db->insert_id();







			$datash["sh_turu"] = 5;//baslangic

			$datash["sh_giris"] = $baslangic;

			$datash["sh_stokID"] = $stok_id;

			$datash["sh_olusturan"] = $u_id;

			$datash["sh_olusturanAnaHesap"] = $anaHesap;

			$datash["sh_olusturmaTarihi"] = $tarihi;

			$datash["sh_olusturmaSaati"] = $saati;

			$this->vt->insert("stokHareketleri",$datash);





			$this->session->set_flashdata('stok_ok','OK');

			logekle(5,2);

			redirect("stok/stok-karti-duzenle/$stok_id");

		}

	}



	public function stokKartiDuzenle($id){

		$data["baslik"] = "Stok / Stok Kartı Düzenle";



		$anaHesap = anaHesapBilgisi();



		$stokGruplariQ = "SELECT * FROM stokGruplari WHERE stokGrup_olusturanAnaHesap = '$anaHesap'";

		$data["stokGruplari"] = $this->db->query($stokGruplariQ)->result();



		$stokBirimleriQ = "SELECT * FROM stokBirimleri";

		$data["stokBirimleri"] = $this->db->query($stokBirimleriQ)->result();



		$stokQ = "SELECT * FROM stok WHERE stok_id = '$id'";

		$data["stok"] = $this->db->query($stokQ)->row();



		$olusturanHesapKim = $data["stok"]->stok_olusturanAnaHesap;



		if($anaHesap == $olusturanHesapKim){

			//logekle(5,1);

			$this->load->view('stok/stok-karti-duzenle',$data);

		}else{

			redirect('hata');

		}

	}



	public function mevcutStokKartiDuzenle(){

		$stok_id = postval("stok_id");



		$anaHesap = anaHesapBilgisi();



		$stokKodu = postval("stok_kodu");



		$kritikSeviye = postval("stok_kritikSeviyesi");



		if($kritikSeviye){

			$stokKritikSeviye = $kritikSeviye;

		}else{

			$stokKritikSeviye = NULL;

		}

		

		$data["stok_kodu"] = $stokKodu;

		$data["stok_ad"] = postval("stok_ad");

		$data["stok_barkod"] = postval("stok_barkod");

		$data["stok_stokGrupKoduID"] = postval("stok_stokGrupKoduID");

		$data["stok_birimID"] = postval("stok_birimID");

		$data["stok_alisFiyati"] = postval("stok_alisFiyati");

		$data["stok_satisFiyati"] = postval("stok_satisFiyati");

		$data["stok_alisKDV"] = postval("stok_alisKDV");

		$data["stok_satisKDV"] = postval("stok_satisKDV");

		$data["stok_kritikSeviyesi"] = $stokKritikSeviye;

		$data["stok_aciklama"] = postval("stok_aciklama");



		$stokKoduVarmiQ = "SELECT * FROM stok WHERE stok_kodu = '$stokKodu' AND stok_olusturanAnaHesap = '$anaHesap' AND stok_id != $stok_id";

		$stokKoduVarmi = $this->db->query($stokKoduVarmiQ)->row();



		if($stokKoduVarmi){

			$this->session->set_flashdata('stok_update_stokkoduvar','OK');

			redirect("stok/stok-karti-duzenle/$stok_id");

		}else{

			$this->vt->update('stok', array('stok_id'=>$stok_id), $data);

			$this->session->set_flashdata('stok_update_ok','OK');

			logekle(5,3);

			redirect("stok/stok-karti-duzenle/$stok_id");

		}

	}



	public function stokListesi(){

		$data["baslik"] = "Stok / Stok Listesi";



		$anaHesap = anaHesapBilgisi();



		$stokKodu = $this->input->get('stokKodu');

		$stokAdi = $this->input->get('stokAdi');

		$stokGrubu = $this->input->get('stokGrubu');



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

		else{$pagem = 0;/*logekle(6,1);*/}





		if((isset($stokKodu) && !empty($stokKodu)) || (isset($stokAdi) && !empty($stokAdi)) || (isset($stokGrubu) && !empty($stokGrubu)) || (isset($tarihGet) && !empty($tarihGet)) ){



			if(!empty($stokGrubu)){$sorgu1 = "AND stok_stokGrupKoduID = '$stokGrubu'";}

			else{$sorgu1 = "";}



			if(!empty($tarihGet)){$sorgu2 = "AND stok_olusturmaTarihi BETWEEN '$tarih1' AND '$tarih2'";}

			else{$sorgu2 = "";}



			$countq = "SELECT COUNT(*) as total FROM stok WHERE stok_durum=1 and stok_olusturanAnaHesap = '$anaHesap' AND stok_kodu LIKE '%$stokKodu%' AND stok_ad LIKE '%$stokAdi%' ".$sorgu1." ".$sorgu2." ";

			$countexe = $this->db->query($countq)->row();

			$count = $countexe->total;



			$sorgu = "SELECT * FROM stok WHERE stok_durum=1 and stok_olusturanAnaHesap = '$anaHesap' AND stok_kodu LIKE '%$stokKodu%' AND stok_ad LIKE '%$stokAdi%' ".$sorgu1." ".$sorgu2." ORDER BY stok_id DESC LIMIT $pagem,$limit";

		}else{

			$countq = "SELECT COUNT(*) as total FROM stok WHERE stok_durum=1 and stok_olusturanAnaHesap = '$anaHesap'";

			$countexe = $this->db->query($countq)->row();

			$count = $countexe->total;

			$sorgu = "SELECT * FROM stok WHERE stok_durum=1 and stok_olusturanAnaHesap = '$anaHesap' ORDER BY stok_id DESC LIMIT $pagem,$limit";

		}



		$data["count_of_list"] = $count;



		$this->load->library("pagination");



		$config = array();

		$config["base_url"] = base_url() . "/stok/$urim";

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

		$data["stok"] = $this->db->query($sorgu)->result();



		$this->load->view('stok/stok-listesi',$data);

	}



	public function stokHareketleri(){

	$data["baslik"] = "Stok / Stok Hareketleri";

		

	$anaHesap = anaHesapBilgisi();



	$stokBilgisi = $this->input->get('stok');



    $stokTuru = $this->input->get('stokTuru');



	$stokKodu = $this->input->get('stokKodu');



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



    if($sayfa){$pagem = ($page-1)*$limit;}

    else{$pagem = 0;}



    if((isset($stokTuru) && !empty($stokTuru)) || (isset($stokKodu) && !empty($stokKodu)) || (isset($tarihGet) && !empty($tarihGet)) || (isset($siralama) && !empty($siralama))  ){



        if(!empty($stokTuru)){$sorgu1 = "AND sh_turu = '$stokTuru'";}

        else{$sorgu1 = "";}





		if(!empty($stokKodu)){$sorgu3 = "AND stok.stok_kodu = '$stokKodu'";}

		else{$sorgu3 = "";}



        if(!empty($stokBilgisi) && $stokBilgisi != "tumu"){

    		$kasaQuery = "AND sh_stokID = '$stokBilgisi'";

    	}



    	if(!empty($tarihGet)){$sorgu2 = "AND sh_tarih BETWEEN '$tarih1' AND '$tarih2'";}

		else{$sorgu2 = "";}



		if(!empty($siralama)){

			if($siralama == 1){//Tarih büyükten küçüğe

				$sira = "ORDER BY DATE(sh_tarih) DESC";

			}else if($siralama == 2){//Tarih küçükten büyüğe

				$sira = "ORDER BY DATE(sh_tarih) ASC";

			}else{

				$sira="ORDER BY sh_id DESC";

			}

		}

		else{$sira="ORDER BY sh_id DESC";}



        $countq = "SELECT COUNT(*) as total FROM stokHareketleri inner join stok on stok_id=sh_stokID WHERE stok_durum=1 and sh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ".$sorgu1." ".$sorgu2." ".$sorgu3." ";

        $countexe = $this->db->query($countq)->row();

        $count = $countexe->total;



        $sorgu = "SELECT * FROM stokHareketleri  inner join stok on stok_id=sh_stokID WHERE stok_durum=1 and sh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ".$sorgu1." ".$sorgu2." ".$sorgu3." ".$sira." LIMIT $pagem,$limit";



        $toplamGirisQ = "SELECT SUM(sh_giris) AS toplamGiris FROM stokHareketleri  inner join stok on stok_id=sh_stokID WHERE stok_durum=1 and sh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ".$sorgu1." ".$sorgu2." ".$sorgu3." ";

				$toplamGirisExe = $this->db->query($toplamGirisQ)->row();



				$toplamCikisQ = "SELECT SUM(sh_cikis) AS toplamCikis from stokHareketleri inner join stok on stok_id=sh_stokID WHERE stok_durum=1 and sh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ".$sorgu1." ".$sorgu2." ".$sorgu3." ";

				$toplamCikisExe = $this->db->query($toplamCikisQ)->row();



				$data["toplamGiris"] = $toplamGirisExe->toplamGiris;

				$data["toplamCikis"] = $toplamCikisExe->toplamCikis;

				$data["kalan"] = $data["toplamGiris"] - $data["toplamCikis"];

    }else{



    	if(!empty($stokBilgisi) && $stokBilgisi != "tumu"){

    		$kasaQuery = "AND sh_stokID = '$stokBilgisi'";

    	} 



        $countq = "SELECT COUNT(*) as total FROM stokHareketleri  inner join stok on stok_id=sh_stokID WHERE stok_durum=1 and sh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery."";

        $countexe = $this->db->query($countq)->row();

        $count = $countexe->total;

        $sorgu = "SELECT * FROM stokHareketleri  inner join stok on stok_id=sh_stokID WHERE stok_durum=1 and sh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ORDER BY sh_id DESC LIMIT $pagem,$limit";



				$toplamGirisQ = "SELECT SUM(sh_giris) AS toplamGiris FROM stokHareketleri  inner join stok on stok_id=sh_stokID WHERE stok_durum=1 and sh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ";

				$toplamGirisExe = $this->db->query($toplamGirisQ)->row();



				$toplamCikisQ = "SELECT SUM(sh_cikis) AS toplamCikis FROM stokHareketleri  inner join stok on stok_id=sh_stokID WHERE stok_durum=1 and sh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery."";

				$toplamCikisExe = $this->db->query($toplamCikisQ)->row();



				$data["toplamGiris"] = $toplamGirisExe->toplamGiris;

				$data["toplamCikis"] = $toplamCikisExe->toplamCikis;

				$data["kalan"] = $data["toplamGiris"] - $data["toplamCikis"];

    }

    $data["count_of_list"] = $count;



    $this->load->library("pagination");



    $config = array();

    $config["base_url"] = base_url() . "/stok/$urim";

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

    $data["stokHareketleri"] = $this->db->query($sorgu)->result();



		$this->load->view('stok/stok-hareketleri', $data);

	}



	public function stokListesiExcel(){

		$anaHesap = anaHesapBilgisi();



		$stokKodu = $this->input->get('stokKodu');

		$stokAdi = $this->input->get('stokAdi');

		$stokGrubu = $this->input->get('stokGrubu');



		$tarihGet = $this->input->get('tarihAraligi');



		$tarihAraligi = explode(' - ', $tarihGet);



		$tarih1 = date('Y-m-d', strtotime($tarihAraligi[0])); //küçük tarih

		$tarih2 = date('Y-m-d', strtotime($tarihAraligi[1])); //büyük tarih



		if((isset($stokKodu) && !empty($stokKodu)) || (isset($stokAdi) && !empty($stokAdi)) || (isset($stokGrubu) && !empty($stokGrubu)) || (isset($tarihGet) && !empty($tarihGet)) ){



		if(!empty($stokGrubu)){$sorgu1 = "AND stok_stokGrupKoduID = '$stokGrubu'";}

		else{$sorgu1 = "";}



		if(!empty($tarihGet)){$sorgu2 = "AND stok_olusturmaTarihi BETWEEN '$tarih1' AND '$tarih2'";}

		else{$sorgu2 = "";}



		$sorgu = "SELECT * FROM stok WHERE stok_olusturanAnaHesap = '$anaHesap' AND stok_kodu LIKE '%$stokKodu%' AND stok_ad LIKE '%$stokAdi%' ".$sorgu1." ".$sorgu2." ORDER BY stok_id DESC";

		}else{

			$sorgu = "SELECT * FROM stok WHERE stok_olusturanAnaHesap = '$anaHesap' ORDER BY stok_id DESC";

		}



		$stok = $this->db->query($sorgu)->result();

$reader=PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');

		$reader->setReadDataOnly(TRUE);

		$spreadsheet = new Spreadsheet();

		

	   	$sheet = $spreadsheet->getActiveSheet();



	   	date_default_timezone_set('Europe/Istanbul');

		$tarih = (new DateTime('now'))->format('d.m.Y-His');



		//$sheet->getStyle('A1:G1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');

		

		$sheet->setCellValue('A1', 'STOK KODU');

		$sheet->setCellValue('B1', 'STOK ADI');

		$sheet->setCellValue('C1', 'BİRİM');

		$sheet->setCellValue('D1', 'GRUP ADI');

		$sheet->setCellValue('E1', 'DURUM');

		$sheet->setCellValue('F1', 'ALIŞ FİYATI');

		$sheet->setCellValue('G1', 'SATIŞ FİYATI');



		$rows = 2;

		$toplamDurum=0;$toplamAlis=0;$toplamSatis=0;

		foreach($stok as $st){

			$birimQ = "SELECT * FROM stokBirimleri WHERE stokBirim_id = '$st->stok_birimID'";

			$birimExe = $this->db->query($birimQ)->row();



			$grupQ = "SELECT * FROM stokGruplari WHERE stokGrup_olusturanAnaHesap='$anaHesap' AND stokGrup_id = '$st->stok_stokGrupKoduID'";

			$grupExe = $this->db->query($grupQ)->row();



			$toplamGirisQ = "SELECT SUM(sh_giris) AS toplamGiris FROM stokHareketleri WHERE sh_olusturanAnaHesap = '$anaHesap' AND sh_stokID = '$st->stok_id'";

			$toplamGirisExe = $this->db->query($toplamGirisQ)->row();



			$toplamCikisQ = "SELECT SUM(sh_cikis) AS toplamCikis FROM stokHareketleri WHERE sh_olusturanAnaHesap = '$anaHesap' AND sh_stokID = '$st->stok_id'";

			$toplamCikisExe = $this->db->query($toplamCikisQ)->row();



			$toplamGiris = $toplamGirisExe->toplamGiris;

			$toplamCikis = $toplamCikisExe->toplamCikis;

			$kalan = $toplamGiris - $toplamCikis;



			$sheet->setCellValue('A'.$rows, $st->stok_kodu);

			$sheet->setCellValue('B'.$rows, $st->stok_ad);

			$sheet->setCellValue('C'.$rows, $birimExe->stokBirim_ad);

			$sheet->setCellValue('D'.$rows, $grupExe->stokGrup_ad);

			$sheet->setCellValue('E'.$rows, $kalan);

			$sheet->setCellValue('F'.$rows, $st->stok_alisFiyati);

			$sheet->setCellValue('G'.$rows, $st->stok_satisFiyati);



			$toplamDurum += $kalan;

			$toplamSatis +=$st->stok_satisFiyati;

			$toplamAlis +=$st->stok_alisFiyati;

			$rows++;

		}

		$rows++;





		$sheet->setCellValue('D'.$rows, "Toplam");

		$sheet->setCellValue('E'.$rows, $toplamDurum);

		$sheet->setCellValue('F'.$rows, $toplamAlis);

		$sheet->setCellValue('G'.$rows, $toplamSatis);



		$satir="D".$rows.":G".$rows;

//		$sheet->getStyle($satir)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');





		$sheet->getColumnDimension('A')->setAutoSize(true);

		$sheet->getColumnDimension('B')->setAutoSize(true);

		$sheet->getColumnDimension('C')->setAutoSize(true);

		$sheet->getColumnDimension('D')->setAutoSize(true);

		$sheet->getColumnDimension('E')->setAutoSize(true);

		$sheet->getColumnDimension('F')->setAutoSize(true);

		$sheet->getColumnDimension('G')->setAutoSize(true);



		$writer = new Xlsx($spreadsheet);//instantiate Xlsx

			

	    $filename = 'stok-listesi-'.$tarih;//set filename for excel file to be exported



	    header('Content-Type: application/vnd.ms-excel');// generate excel file

	    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 

	    header('Cache-Control: max-age=0');

	    

		$writer->save('php://output');//download file 

	}



	public function stokHareketleriExcel(){

		$anaHesap = anaHesapBilgisi();



		$stokBilgisi = $this->input->get('stok');



		$stokTuru = $this->input->get('stokTuru');



		$stokKodu = $this->input->get('stokKodu');



		$tarihGet = $this->input->get('tarihAraligi');



		$tarihAraligi = explode(' - ', $tarihGet);



		$tarih1 = date('Y-m-d', strtotime($tarihAraligi[0])); //küçük tarih

		$tarih2 = date('Y-m-d', strtotime($tarihAraligi[1])); //büyük tarih



		if( (isset($stokTuru) && !empty($stokTuru)) ||(isset($stokKodu) && !empty($stokKodu)) || (isset($tarihGet) && !empty($tarihGet))  || (isset($stokBilgisi) && !empty($stokBilgisi)) ){



        if(!empty($stokTuru)){$sorgu1 = "AND sh_turu = '$stokTuru'";}

        else{$sorgu1 = "";}



			if(!empty($stokKodu)){$sorgu3 = "AND stok.stok_kodu = '$stokKodu'";}

			else{$sorgu3 = "";}



        if(!empty($stokBilgisi) && $stokBilgisi != "tumu"){

    		$kasaQuery = "AND sh_stokID = '$stokBilgisi'";

    	}



    	if(!empty($tarihGet)){$sorgu2 = "AND sh_tarih BETWEEN '$tarih1' AND '$tarih2'";}

		else{$sorgu2 = "";}



        $sorgu = "SELECT * FROM stokHareketleri WHERE sh_olusturanAnaHesap = '$anaHesap' ".$kasaQuery." ".$sorgu1." ".$sorgu2." ".$sorgu3." ORDER BY sh_id DESC";

   	 	}else{

   	 		$sorgu = "SELECT * FROM stokHareketleri WHERE sh_olusturanAnaHesap = '$anaHesap' ORDER BY sh_id DESC";

   		}



   		$stokHareketleri = $this->db->query($sorgu)->result();



		$reader = IOFactory::createReader('Xlsx');

		$reader->setReadDataOnly(TRUE);

		$spreadsheet = new Spreadsheet();

		

	   	$sheet = $spreadsheet->getActiveSheet();



	   	date_default_timezone_set('Europe/Istanbul');

		$tarih = (new DateTime('now'))->format('d.m.Y-His');



		//$sheet->getStyle('A1:I1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');

		

		$sheet->setCellValue('A1', 'TARİH');

		$sheet->setCellValue('B1', 'STOK ADI');

		$sheet->setCellValue('C1', 'TÜRÜ');

		$sheet->setCellValue('D1', 'GİRİŞ');

		$sheet->setCellValue('E1', 'ÇIKIŞ');

		$sheet->setCellValue('F1', 'BİRİM FİYAT');

		$sheet->setCellValue('G1', 'KDV YUZDE');

		$sheet->setCellValue('H1', 'KDV TL');

		$sheet->setCellValue('I1', 'TOPLAM FİYAT');



		$rows = 2;

		foreach($stokHareketleri as $sh){

			$tarihYeni = date('d.m.Y', strtotime($sh->sh_tarih));



			$stokID = $sh->sh_stokID;

			$stokQ = "SELECT * FROM stok WHERE stok_id = '$stokID' AND stok_olusturanAnaHesap = '$anaHesap'";

			$stokexe = $this->db->query($stokQ)->row();



			$turu = $sh->sh_turu;

			if($turu == 1){

				$turuTxt = 'Alış Faturası';

				$giris = number_format($sh->sh_giris,2);

				$cikis = '';

			}else if($turu == 2){

				$turuTxt = 'Satış Faturası';

				$giris = '';

				$cikis = number_format($sh->sh_cikis,2);

			}



			$sheet->setCellValue('A'.$rows, $tarihYeni);

			$sheet->setCellValue('B'.$rows, $stokexe->stok_ad);

			$sheet->setCellValue('C'.$rows, $turuTxt);

			$sheet->setCellValue('D'.$rows, $giris);

			$sheet->setCellValue('E'.$rows, $cikis);

			$sheet->setCellValue('F'.$rows, $sh->sh_birimFiyat);

			$sheet->setCellValue('G'.$rows, $sh->sh_kdv);

			$sheet->setCellValue('H'.$rows, $sh->sh_toplamKDV);

			$sheet->setCellValue('I'.$rows, $sh->sh_toplamFiyat);

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

			

	    $filename = 'stok-hareketleri-'.$tarih;//set filename for excel file to be exported



	    header('Content-Type: application/vnd.ms-excel');// generate excel file

	    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 

	    header('Cache-Control: max-age=0');

	    

		$writer->save('php://output');//download file 

	}



	public function stok_sil()

	{

		$id= $this->input->get('stok_id');

		$data["stok_durum"]=0;

		$this->vt->update('stok', array('stok_id'=>$id), $data);

		$this->session->set_flashdata('stok_sil_ok','OK');

		redirect("stok/stok-listesi");

	}



	public function anonimKayit()

	{

		$control2 = session("r", "login_info");

		$u_id = $control2->kullanici_id;



		date_default_timezone_set('Europe/Istanbul');

		$tarihi = (new DateTime('now'))->format('Y.m.d H:i:s');



		$anaHesap = anaHesapBilgisi();



		$cikis = postval("anonimMiktar");

		$giris = postval("anonimMiktar2");





		if($cikis == "" && $giris == ""){

			$this->session->set_flashdata('stok_hareket_hata','OK');

			redirect("stok/stokHareketleri");

		}



		$data["sh_turu"]=6;



		if($cikis){

			$data["sh_cikis"]=postval("anonimMiktar");

		}else if($giris){

			$data["sh_giris"]=postval("anonimMiktar2");

		}

		

		$data["sh_stokID"]=postval("anonimStokID");

		$data["sh_paraBirimi"]=postval("anonimParaBirimi");

		$data["sh_tarih"]=$tarihi;

		$data["sh_birimFiyat"]=postval("anonimBirimFiyat");

		$data["sh_kdv"]=postval("anonimKdv");

		$data["sh_toplamKDV"]=postval("anonimKdvHesap");

		$data["sh_toplamFiyat"]=postval("anonimToplam");

		$data["sh_olusturan"] = $u_id;

		$data["sh_olusturanAnaHesap"] = $anaHesap;

		$data["sh_olusturmaTarihi"] = $tarihi;



		$this->vt->insert("stokHareketleri",$data);

		$this->session->set_flashdata('stok_hareket_kayit','OK');

		redirect("stok/stokHareketleri");

	}



	public function anonimDuzenle()

	{

		$control2 = session("r", "login_info");

		$u_id = $control2->kullanici_id;



		date_default_timezone_set('Europe/Istanbul');

		$tarihi = (new DateTime('now'))->format('Y.m.d H:i:s');



		$anaHesap = anaHesapBilgisi();



		$id=postval("anonimID");



		$data["sh_turu"]=6;

		$data["sh_cikis"]=postval("anonimMiktar");

		$data["sh_stokID"]=postval("anonimStokID");

		$data["sh_paraBirimi"]=postval("anonimParaBirimi");

		$data["sh_tarih"]=$tarihi;

		$data["sh_birimFiyat"]=postval("anonimBirimFiyat");

		$data["sh_kdv"]=postval("anonimKdv");

		$data["sh_toplamKDV"]=postval("anonimKdvHesap");

		$data["sh_toplamFiyat"]=postval("anonimToplam");

		$data["sh_olusturan"] = $u_id;

		$data["sh_olusturanAnaHesap"] = $anaHesap;

		$data["sh_olusturmaTarihi"] = $tarihi;



		$this->vt->update("stokHareketleri",array("sh_id"=>$id),$data);

		$this->session->set_flashdata('stok_hareket_duzenle','OK');

		redirect("stok/stokHareketleri");

	}
	
	/**
	 * Stok arama - jQuery UI Autocomplete için
	 * AJAX endpoint
	 */
	public function stokArama()
	{
		$term = $this->input->get('term');
		
		if (strlen($term) < 2) {
			echo json_encode([]);
			return;
		}
		
		try {
			$anaHesap = anaHesapBilgisi();
			
			$query = "
				SELECT 
					stok_id,
					stok_ad,
					stok_kodu,
					stok_satisFiyati,
					stok_satisKDV
				FROM stok 
				WHERE stok_olusturanAnaHesap = ? 
				AND stok_durum = 1
				AND (
					stok_ad LIKE ? 
					OR stok_kodu LIKE ?
				)
				ORDER BY stok_ad ASC
				LIMIT 20
			";
			
			$search_term = '%' . $term . '%';
			$result = $this->db->query($query, [$anaHesap, $search_term, $search_term])->result();
			
			$data = [];
			foreach ($result as $row) {
				$data[] = [
					'label' => $row->stok_ad . ' (' . ($row->stok_kodu ?: 'Kod Yok') . ')',
					'value' => $row->stok_ad,
					'stok_id' => $row->stok_id,
					'stok_kodu' => $row->stok_kodu,
					'stok_ad' => $row->stok_ad,
					'stok_satisFiyati' => $row->stok_satisFiyati,
					'stok_satisKDV' => $row->stok_satisKDV
				];
			}
			
			echo json_encode($data);
			
		} catch (Exception $e) {
			error_log("Stok arama error: " . $e->getMessage());
			echo json_encode([]);
		}
	}



}

