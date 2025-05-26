<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use AAD\Fatura\Service;
use furkankadioglu\eFatura\InvoiceManager;
use furkankadioglu\eFatura\Models\Invoice;
use furkankadioglu\eFatura\Models\Country;
use Ramsey\Uuid\Uuid;
use furkankadioglu\eFatura\Models\CurrencyType;
use furkankadioglu\eFatura\Models\InvoiceType;
use furkankadioglu\eFatura\Models\UnitType;
use PHPUnit\Framework\TestCase;
use furkankadioglu\eFatura\Interaktif;


class Gib extends CI_Controller
{


	public function __construct()
	{
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
		$this->load->model('vt');

		$this->load->helper("gib_helper");
		$control = session("r", "login");


		if (gibYetki() == 0)
			redirect("home/hata2/1");

		if (!$control) {
			redirect("check");
		}
		//sessionKontrolHelper();
	}


	public function index()
	{
		$client = new InvoiceManager();

		$endDate = date("d-m-Y");
		$startDate = date("d-m-Y", strtotime('-7 day', strtotime($endDate)));

		$bilgi = gib_giris();
		$client->setCredentials($bilgi->ma_gibUsername, $bilgi->ma_gibSifre);

		$client->connect();

		$invoice = $client->getInvoicesFromAPI($startDate, $endDate);
		$data["invoice"] = $invoice["data"];

		$data["baslik"] = "GİB / Anasayfa";
		$client->logOutFromAPI();
		$this->load->view('index-gib', $data);
	}

	public function gibBilgi()
	{
		$data["baslik"] = "GİB / GİB Bilgileri";
		//logekle(11,1);
		$anaHesap = anaHesapBilgisi();

		$client = new InvoiceManager();
		//$client->setCredentials("33210617", "120580");
		$bilgi = gib_giris();
		$client->setCredentials($bilgi->ma_gibUsername, $bilgi->ma_gibSifre);
		$client->connect();

		$userInformations = $client->getUserInformationsData();
		$data["data"] = json_decode(json_encode($userInformations->export()));

		$client->logOutFromAPI();
		$this->load->view('gib/gib-bilgileri', $data);
	}

	public function gibBilgiGuncelle()
	{
		$client = new InvoiceManager();
		$bilgi = gib_giris();
		$client->setCredentials($bilgi->ma_gibUsername, $bilgi->ma_gibSifre);
		$client->connect();
		$userInformations = $client->getUserInformationsData();
		if (strlen($userInformations->getVknTckn()) == 10) {
			$userInformations = $userInformations->setUnvan(postval("unvan"));
		} else {
			$userInformations = $userInformations->setAd(postval("ad"));
			$userInformations = $userInformations->setSoyad(postval("soyad"));
		}
		$userInformations = $userInformations->setVergiDairesi(postval("vergiDairesi"));
		$userInformations = $userInformations->setSicilNo(postval("sicilNo"));
		$userInformations = $userInformations->setMersisNo(postval("mersisNo"));
		$userInformations = $userInformations->setUlke(postval("ulke"));
		$userInformations = $userInformations->setIl(postval("il"));
		$userInformations = $userInformations->setIlce(postval("ilce"));
		$userInformations = $userInformations->setCadde(postval("cadde"));
		$userInformations = $userInformations->setIsMerkezi(postval("isMerkezi"));
		$userInformations = $userInformations->setApartmanAdi(postval("apartmanAdi"));
		$userInformations = $userInformations->setApartmanNo(postval("apartmanNo"));
		$userInformations = $userInformations->setKasaba(postval("mahalle"));
		$userInformations = $userInformations->setKapiNo(postval("kapıNo"));
		$userInformations = $userInformations->setPostaKodu(postval("postaKodu"));
		$userInformations = $userInformations->setTelNo(postval("telNo"));
		$userInformations = $userInformations->setFaksNo(postval("faksNo"));
		$userInformations = $userInformations->setEPostaAdresi(postval("eposta"));

		$client->setUserInformations($userInformations);
		$client->sendUserInformationsData();


		$client->logOutFromAPI();
		redirect("gib/gibBilgi");

	}

	public function faturaOlustur($invoice = null)
	{
		$data["baslik"] = "GİB / Fatura Oluştur";
		//logekle(11,1);
		$anaHesap = anaHesapBilgisi();

		$tevkifatQ = "SELECT * FROM tevkifatKodlari";
		$tevkifatExe = $this->db->query($tevkifatQ)->result();
		$tevkifat = "";
		foreach ($tevkifatExe as $item) {
			$tevkifat .= "<option value='" . $item->tevkifat_kodu . "|" . $item->tevkifat_orani . "'>" . $item->tevkifat_kodu . "-" . $item->tevkifat_adi . "</option>";
		}
		$data["tevkifat"] = $tevkifat;

		$istisnaQ = "SELECT * FROM istisnaKodlari";
		$istisnaExe = $this->db->query($istisnaQ)->result();
		$istisna = "";
		foreach ($istisnaExe as $item) {
			$istisna .= "<option value='" . $item->istisna_id . "'>" . $item->istisna_kodu . " " . $item->istisna_adi . "</option>";
		}
		$data["istisna"] = $istisna;
		$sqlBanka = "select * from ayarlar_banka where ayarlarbanka_olusturanAnaHesap=" . $anaHesap . " ";
		$data["faturabanka"] = $this->db->query($sqlBanka)->result();

		$stokBirimleriQ = "SELECT * FROM stokBirimleri";
		$birimler = $this->db->query($stokBirimleriQ)->result();
		$option = "";
		foreach ($birimler as $birim) {
			$option .= "<option value='$birim->stokBirim_kodu'>$birim->stokBirim_ad</option>";
		}
		$data["birimler"] = $option;

		$data["invoice"] = $invoice;
		$this->load->view("gib/fatura-olustur", $data);

	}

	public function faturaOlusturKaydet()
	{
		$firmaID = getirFirma();
		$firma_ID = $firmaID->ayarlar_id;
		$modulGibProSorgula = modulSorgula($firma_ID, 3);

		$faturaTip = postval("faturaTip");
		$duzenlemeTarihi = postval("duzenlemeTarihi");
		$duzenlemeSaati = postval("duzenlemeSaati");
		$paraBirimi = postval("paraBirimi");
		$guncelKur = postval("guncelKur");
		$tcknvkn = postval("tcknvkn");
		$unvan = postval("unvan");
		$ad = postval("ad");
		$soyad = postval("soyad");
		$vergidairesi = postval("vergiDairesi");
		$adres = postval("adres");
		$aratop = postval("aratopHidden");
		$indirimTop = postval("indirimtopHidden");
		$netTop = postval("netTutarInput");
		$kdvTop = postval("kdvtopHidden");
		$vergiDahil = postval("vergidahilHidden");
		$genelTop = postval("geneltopHidden");
		$tevkifatTop = postval("tevkifattopHidden");
		$aciklama = postval("aciklama");
		$irsaliyeno = postval("irsaliyeNo");
		$irsaliyetarihi = postval("irsaliyeTarihi");

		if ($guncelKur)
			$dovizCevrilmis = $genelTop * $guncelKur;


		if ($faturaTip == "SATIS")
			$faturaTipID = 1;
		else if ($faturaTip == "IADE")
			$faturaTipID = 2;
		else if ($faturaTip == "TEVKIFAT")
			$faturaTipID = 3;
		else if ($faturaTip == "ISTISNA")
			$faturaTipID = 4;

		if ($paraBirimi == "TRY")
			$paraBirimiID = 1;
		else if ($paraBirimi == "USD")
			$paraBirimiID = 2;
		else if ($paraBirimi == "EUR")
			$paraBirimiID = 3;
		else if ($paraBirimi == "GBP")
			$paraBirimiID = 4;

		//gib içi fatura detay array
		$fatura_detaylari = [
			"belgeNumarasi" => "",
			"faturaTarihi" => $duzenlemeTarihi,
			"saat" => $duzenlemeSaati,
			"paraBirimi" => $paraBirimi,
			"dovzTLkur" => $guncelKur,
			"faturaTipi" => $faturaTip,
			"hangiTip" => "5000/30000",
			//"vknTckn" => "33333319",
			"vknTckn" => $tcknvkn,
			"aliciUnvan" => $unvan,
			"aliciAdi" => $ad,
			"aliciSoyadi" => $soyad,
			"binaAdi" => "",
			"binaNo" => "",
			"kapiNo" => "",
			"kasabaKoy" => "",
			"vergiDairesi" => $vergidairesi,
			"ulke" => "Türkiye",
			"bulvarcaddesokak" => $adres,
			"mahalleSemtIlce" => "",
			"sehir" => " ",
			"postaKodu" => "",
			"tel" => "",
			"fax" => "",
			"eposta" => "",
			"websitesi" => "",
			"iadeTable" => [],
			"ozelMatrahTutari" => "0",
			"ozelMatrahOrani" => 0,
			"ozelMatrahVergiTutari" => "0",
			"vergiCesidi" => " ",
			"malHizmetTable" => [],
			"matrah" => 0,
			"malhizmetToplamTutari" => $aratop,
			"toplamIskonto" => $indirimTop,
			"hesaplanankdv" => $kdvTop,
			"vergilerToplami" => $kdvTop,
			"vergilerDahilToplamTutar" => $vergiDahil,
			"odenecekTutar" => $genelTop,
			"not" => $aciklama,
			"siparisNumarasi" => "",
			"siparisTarihi" => "",
			"irsaliyeNumarasi" => $irsaliyeno,
			"irsaliyeTarihi" => $irsaliyetarihi,
			"fisNo" => "",
			"fisTarihi" => "",
			"fisSaati" => " ",
			"fisTipi" => " ",
			"zRaporNo" => "",
			"okcSeriNo" => ""
		];

		if ($modulGibProSorgula) {
			//satis faturası veritabanına kaydet (raporlama için)
			#region satisFaturasi
			$control2 = session("r", "login_info");
			$u_id = $control2->kullanici_id;
			$yeni_satis_irsaliyeTarihi = date("Y-m-d", strtotime($irsaliyetarihi));
			$yeni_satis_faturaTarihi = date("Y-m-d", strtotime($duzenlemeTarihi));
			date_default_timezone_set('Europe/Istanbul');
			$tarihi = (new DateTime('now'))->format('Y.m.d');
			$saati = (new DateTime('now'))->format('H:i:s');

			$anaHesap = anaHesapBilgisi();
			$data["satis_InvoiceType"] = 3;//gib
			$data["satis_faturaDurum"] = 1;//onaylanmadı onaylanınca 2 yap
			$data["satis_earsivfaturaTip"] = $faturaTipID;
			$data["satis_paraBirimi"] = $paraBirimiID;
			$data["satis_guncelKur"] = $guncelKur;
			$data["satis_dovizCevrilmis"] = $dovizCevrilmis != null ? $dovizCevrilmis : Null;
			$data["satis_irsaliyeNo"] = $irsaliyeno != '' ? $irsaliyeno : NULL;
			$data["satis_irsaliyeTarihi"] = $yeni_satis_irsaliyeTarihi != '' ? $yeni_satis_irsaliyeTarihi : NULL;
			$data["satis_faturaTarihi"] = $yeni_satis_faturaTarihi;
			$data["satis_faturaSaati"] = $duzenlemeSaati;
			$data["satis_aciklama"] = $aciklama;
			$data["satis_araToplam"] = $aratop;
			$data["satis_kdvToplam"] = $kdvTop;
			$data["satis_genelToplam"] = $genelTop;
			$data["satis_vergiDahilToplam"] = $vergiDahil;
			$data["satis_indirimToplam"] = $indirimTop;
			$data["satis_netTutar"] = $netTop;

			if ($tevkifatTop != null)
				$data["satis_tevkifatToplam"] = $tevkifatTop;

			$data["satis_olusturan"] = $u_id;
			$data["satis_olusturanAnaHesap"] = $anaHesap;
			$data["satis_olusturmaTarihi"] = $tarihi;
			$data["satis_olusturmaSaati"] = $saati;

			$this->vt->insert("satisFaturasi", $data);
			$satis_id = $this->db->insert_id();
			#endregion satisFaturasi
		}
		$stokadi = postval("stokadi");
		$stokid = postval("stokid");
		$birim = postval("birim");
		$miktar = postval("miktar");
		$birimfiyat = postval("birimfiyat");
		$kdv = postval("kdv");
		$toplam = postval("toplamHidden");
		$indirimtutari = postval("indirimyuzde");
		$tevkifatInput = postval("tevkifat");
		$gtipInput = postval("gtip");

		if ($modulGibProSorgula) {
			//gib pro modulü varsa cari kontrolü yap cari_id yi oluştur
			$cari_id = postval("cari_id");
			//cari seçmemişse oluştur
			if (empty($cari_id) || $cari_id == "") {
				if (strlen($tcknvkn) == 10)
					$where = " cari_vergiNumarasi=$tcknvkn";
				else
					$where = " cari_tckn=$tcknvkn";

				$sqlcari = "select * from cari where $where and cari_olusturanAnaHesap=$anaHesap";
				$execari = $this->db->query($sqlcari)->row();
				if (!$execari) {
					if (empty($unvan)) {
						$dataCari["cari_ad"] = $ad;
						$dataCari["cari_soyad"] = $soyad;
					} else
						$dataCari["cari_ad"] = $unvan;

					if (strlen($tcknvkn) == 10)
						$dataCari["cari_vergiNumarasi"] = $tcknvkn;
					else
						$dataCari["cari_tckn"] = $tcknvkn;

					$dataCari["cari_kodu"] = $tcknvkn;
					$dataCari["cari_vergiDairesi"] = $vergidairesi;
					$dataCari["cari_adres"] = $adres;

					$dataCari["cari_olusturan"] = $u_id;
					$dataCari["cari_olusturanAnaHesap"] = $anaHesap;
					$dataCari["cari_olusturmaTarihi"] = $tarihi;
					$dataCari["cari_olusturmaSaati"] = $saati;

					$this->vt->insert("cari", $dataCari);
					$cari_id = $this->db->insert_id();
				} else
					$cari_id = $execari->cari_id;
			}

		}

		#region stoklar
		$kacAdetStok = count($stokadi);
		$stokhareketID = "";
		for ($i = 0; $i < $kacAdetStok; $i++) {

			//hesaplamalar
			$fiyat = $birimfiyat[$i] * $miktar[$i];
			if ($indirimtutari[$i] == "") { // satır indirim
				$indirimOrani = "0";
				$indirim = "0";
			} else {
				$indirimOrani = $indirimtutari[$i];
				$indirim = $fiyat * $indirimtutari[$i] / 100;
			}
			$kdvTutar = $toplam[$i] * $kdv[$i] / 100;
			$tevkifatArr = [];
			$gtip = [];
			if ($tevkifatInput[$i] != "") { //gib için tevkifat array
				$tevkifatArr = explode("|", $tevkifatInput[$i]);
				$tevkifatKod = $tevkifatArr[0];
				$tevkifatOran = $tevkifatArr[1];
				$tevkifatTutari = $kdvTutar * $tevkifatOran;
				$tevkifatArr = ["tevkifatKodu" => $tevkifatKod, "V9015Orani" => $tevkifatOran * 100, "V9015Tutari" => $tevkifatTutari];
			}
			if ($faturaTip == "ISTISNA") {
				$gtip = ["gtip" => $gtipInput[$i]];
			}

			//gib için stok array
			$stok = [
				"malHizmet" => $stokadi[$i],
				"miktar" => $miktar[$i],
				"birim" => $birim[$i],
				"birimFiyat" => $birimfiyat[$i],
				"fiyat" => $fiyat,
				"iskontoNedeni" => "",
				"iskontoOrani" => $indirimOrani,
				"iskontoTutari" => $indirim,
				"iskontoNedeni" => "",
				"malHizmetTutari" => $toplam[$i],
				"kdvOrani" => $kdv[$i],
				"vergiOrani" => 0,
				"kdvTutari" => $kdvTutar,
				"vergininKdvTutari" => "0"
			];

			//gib fatura detayına ürün satırı ekle
			$fatura_detaylari["malHizmetTable"][] = $stok + $tevkifatArr + $gtip;

			#region gibPro
			if ($modulGibProSorgula) {
				//stok seçmemişse oluştur
				$stok_id = $stokid[$i];

				#region stokKontrolKayit
				if (empty($stok_id)) {
					$control2 = session("r", "login_info");
					$u_id = $control2->kullanici_id;

					date_default_timezone_set('Europe/Istanbul');
					$tarihi = (new DateTime('now'))->format('Y.m.d');
					$saati = (new DateTime('now'))->format('H:i:s');

					$anaHesap = anaHesapBilgisi();
					$stokQ = "select * from stok where stok_ad='" . $stokadi[$i] . "' and stok_olusturanAnaHesap = '$anaHesap'";
					$stokExe = $this->db->query($stokQ)->row();
					//stok adı yoksa yeni oluştur
					if (!$stokExe) {
						$stokCountQ = "SELECT COUNT(*) as total FROM stok WHERE stok_olusturanAnaHesap = '$anaHesap'";
						$stokCountE = $this->db->query($stokCountQ)->row();
						$stokKacTane = $stokCountE->total + 1;
						$stok = str_pad($stokKacTane, 8, '0', STR_PAD_LEFT);

						$birimQ = "select * from stokBirimleri where stokBirim_kodu='$birim[$i]'";
						$birimExe = $this->db->query($birimQ)->row();

						$dataStokX["stok_kodu"] = $stok;
						$dataStokX["stok_ad"] = $stokadi[$i];
						$dataStokX["stok_satisFiyati"] = $birimfiyat[$i];
						$dataStokX["stok_alisFiyati"] = 0;
						$dataStokX["stok_satisKDV"] = $kdv[$i];
						$dataStokX["stok_alisKDV"] = 0;
						$dataStokX["stok_birimID"] = $birimExe->stokBirim_id;
						$dataStokX["stok_olusturan"] = $u_id;
						$dataStokX["stok_olusturanAnaHesap"] = $anaHesap;
						$dataStokX["stok_olusturmaTarihi"] = $tarihi;
						$dataStokX["stok_olusturmaSaati"] = $saati;

						$this->vt->insert("stok", $dataStokX);
						$stok_id = $this->db->insert_id();
					} else $stok_id = $stokExe->stok_id;
				}
				#endregion stokKontrolKayit

				//satisFaturasiStok tablosuna ekle
				#region satisfaturasistok
				$dataStok["satisStok_satisFaturasiID"] = $satis_id;
				$dataStok["satisStok_stokID"] = $stok_id;
				$dataStok["satisStok_miktar"] = $miktar[$i];
				$dataStok["satisStok_birimFiyat"] = $birimfiyat[$i];
				$dataStok["satisStok_fiyatMiktar"] = $fiyat;
				$dataStok["satisStok_kdv"] = $kdv[$i];
				$dataStok["satisStok_indirimTutari"] = $indirimOrani;
				$dataStok["satisStok_satirIskonto"] = $indirim;
				$dataStok["satisStok_indirimlifiyat"] = $toplam[$i];

				if ($tevkifatInput[$i] != "" && $tevkifatInput[$i] != 0) {

					$sqltevkifat = "select * from tevkifatKodlari where tevkifat_kodu=$tevkifatKod";
					$tevkifatExe = $this->db->query($sqltevkifat)->row();
					$dataStok["satisStok_tevkifat_id"] = $tevkifatExe->tevkifat_id;

				} else {
					$dataStok["satisStok_tevkifat_id"] = 0;
				}

				$this->vt->insert("satisFaturasiStok", $dataStok);

				#endregion satisfaturasistok

				#region stokhareketleri
				$data_sh["sh_turu"] = 2;
				$data_sh["sh_cikis"] = $miktar[$i];
				$data_sh["sh_cariID"] = $cari_id;
				$data_sh["sh_stokID"] = $stok_id;
				$data_sh["sh_faturaID"] = $satis_id;
				$data_sh["sh_paraBirimi"] = $paraBirimi;
				$data_sh["sh_tarih"] = $tarihi;
				$data_sh["sh_birimFiyat"] = $birimfiyat[$i];
				$data_sh["sh_kdv"] = $kdv[$i];
				$data_sh["sh_toplamKDV"] = $kdvTutar;
				$data_sh["sh_toplamFiyat"] = $toplam[$i];
				$data_sh["sh_olusturan"] = $u_id;
				$data_sh["sh_olusturanAnaHesap"] = $anaHesap;
				$data_sh["sh_olusturmaTarihi"] = $tarihi;
				$data_sh["sh_olusturmaSaati"] = $saati;

				$this->vt->insert("stokHareketleri", $data_sh);
				$sh_id = $this->db->insert_id();
				//ekelenen stok hareketlerinin id sini dizide tut
				//belge numarası oluşunca bu stok hareketlerinin belge numarasını güncelle
				$stokhareketID .= "$sh_id,";
				#endregion stokhareketleri
			}
			#endregion gibpro
		}
		#endregion stoklar

		//iade
		$iade = [];
		$iade_count = postval("iade_count");
		if ($iade_count != 0) {

			$iadenumara = postval("iadenumara");
			$iadetarih = postval("iadetarih");
			for ($i = 0; $i < $iade_count; $i++) {
				$fatura_detaylari["iadeTable"][] = ["faturaNo" => $iadenumara[$i], "duzenlenmeTarihi" => $iadetarih[$i]];

				if ($modulGibProSorgula) {
					//gib pro ise iadeleri veritabanına ekle
					$dataIade["satis_id"] = $satis_id;
					$dataIade["fatura_numarasi"] = $iadenumara[$i];
					$dataIade["tarih"] = $iadetarih[$i];

					$this->vt->insert("iade_fatura_numaralari", $dataIade);
				}
			}
		}


		//fatura oluştur
		$client = new InvoiceManager();
		$bilgi = gib_giris();
		$client->setCredentials($bilgi->ma_gibUsername, $bilgi->ma_gibSifre);
		$client->connect();
		$inv = new Invoice();
		$inv->mapWithTurkishKeys($fatura_detaylari);
		$client->setInvoice($inv);
		$client->createDraftBasicInvoice();

		//oluşturulan faturasının uuidsini al ve belge numarasını öğren
		$uuid = $inv->getUuid();
		$oldInvoice = new Invoice();
		$oldInvoice->setUuid($uuid);
		$client->setInvoice($oldInvoice);
		$kayitFatura = $client->getInvoiceFromAPI();

		if ($modulGibProSorgula) {
			#region cariHareketiOlustur
			$data_ch["ch_belgeNumarasi"] = $kayitFatura["belgeNumarasi"];
			$data_ch["ch_turu"] = 2;
			$data_ch["ch_cariID"] = $cari_id;
			$data_ch["ch_faturaID"] = $satis_id;
			$data_ch["ch_paraBirimi"] = $paraBirimi;

			if ($dovizCevrilmis) {
				$data_ch["ch_borc"] = $dovizCevrilmis;
				$data_ch["ch_borcDoviz"] = $genelTop;
			} else
				$data_ch["ch_borc"] = $genelTop;

			$data_ch["ch_tarih"] = $yeni_satis_faturaTarihi;
			$data_ch["ch_olusturan"] = $u_id;
			$data_ch["ch_olusturanAnaHesap"] = $anaHesap;
			$data_ch["ch_olusturmaTarihi"] = $tarihi;
			$data_ch["ch_olusturmaSaati"] = $saati;

			$this->vt->insert("cariHareketleri", $data_ch);
			$ch_id = $this->db->insert_id();
			#endregion cariHareketiOlustur

			//stok hareketlerinin belge numarasını değiştir

			$sqlStokHareketUpdate = "update stokHareketleri set sh_belgeNumarasi='" . $kayitFatura["belgeNumarasi"] . "' where sh_id in (" . trim($stokhareketID, ",") . ")";
			$this->db->query($sqlStokHareketUpdate);

			//satis faturasına cari hareket idsini ekle
			$dataUpdate["satis_cariHareketiID"] = $ch_id;

			$dataUpdate["satis_cariID"] = $cari_id;
			//satis faturasının belge numarasını güncelle
			$dataUpdate["satis_faturaNo"] = $kayitFatura["belgeNumarasi"];
			$dataUpdate["satis_GUID"] = $uuid;
			$this->vt->update("satisFaturasi", array("satis_id" => $satis_id), $dataUpdate);
		}
		//çıkış yap
		$client->logOutFromAPI();

		redirect("gib/duzenlenenBelgeler");

	}

	public function faturaDuzenle($invoice)
	{
		$data["baslik"] = "GİB / Fatura Düzenle";
		$client = new InvoiceManager();
		$bilgi = gib_giris();
		$client->setCredentials($bilgi->ma_gibUsername, $bilgi->ma_gibSifre);
		$client->connect();
		$oldInvoice = new Invoice();
		$oldInvoice->setUuid($invoice);
		$client->setInvoice($oldInvoice)->getInvoiceFromAPI();
		$data["invoice"] = $client->getInvoiceFromAPI();

		$firmaID = getirFirma();
		$firma_ID = $firmaID->ayarlar_id;
		$modulGibProSorgula = modulSorgula($firma_ID, 3);

		$anaHesap = anaHesapBilgisi();

		if ($modulGibProSorgula) {
			$sqlsatis = "select * from satisFaturasi where satis_faturaNo='" . $data["invoice"]["belgeNumarasi"] . "' and satis_GUID='" . $data["invoice"]["faturaUuid"] . "' and satis_invoiceType=3";

			$exesatis = $this->db->query($sqlsatis)->row();
			$data["satisID"] = $exesatis->satis_id;
		}
		$data["cariID"] = $exesatis->satis_cariID;


		$tevkifatQ = "SELECT * FROM tevkifatKodlari";
		$tevkifatExe = $this->db->query($tevkifatQ)->result();
		$tevkifat = "";
		foreach ($tevkifatExe as $item) {
			$tevkifat .= "<option value='" . $item->tevkifat_kodu . "|" . $item->tevkifat_orani . "'>" . $item->tevkifat_kodu . "-" . $item->tevkifat_adi . "</option>";
		}
		$data["tevkifat"] = $tevkifat;

		$stokBirimleriQ = "SELECT * FROM stokBirimleri";
		$birimler = $this->db->query($stokBirimleriQ)->result();
		$option = "";
		foreach ($birimler as $birim) {
			$option .= "<option value='$birim->stokBirim_kodu'>$birim->stokBirim_ad</option>";
		}
		$data["birimler"] = $option;

		$this->load->view("gib/fatura-olustur", $data);
	}

	public function faturaDuzenleKaydet()
	{
		$firmaID = getirFirma();
		$firma_ID = $firmaID->ayarlar_id;
		$modulGibProSorgula = modulSorgula($firma_ID, 3);
		$anaHesap = anaHesapBilgisi();

		$control2 = session("r", "login_info");
		$u_id = $control2->kullanici_id;
		date_default_timezone_set('Europe/Istanbul');
		$tarihi = (new DateTime('now'))->format('Y.m.d');
		$saati = (new DateTime('now'))->format('H:i:s');

		$faturaTip = postval("faturaTip");
		$faturaUuid = postval("faturaUuid");
		$belgeno = postval("belgeNumarasi");
		$satis_id = postval("satis_id");

		if ($modulGibProSorgula) {
			$this->vt->del("iade_fatura_numaralari", "satis_id", $satis_id);
			$this->vt->del("satisFaturasiStok", "satisStok_satisFaturasiID", $satis_id);
			$this->vt->del("cariHareketleri", "ch_faturaID", $satis_id);
			$this->vt->del("stokHareketleri", "sh_faturaID", $satis_id);
		}

		$duzenlemeTarihi = postval("duzenlemeTarihi");
		$duzenlemeSaati = postval("duzenlemeSaati");
		$paraBirimi = postval("paraBirimi");
		$guncelKur = postval("guncelKur");
		$tcknvkn = postval("tcknvkn");
		$unvan = postval("unvan");
		$ad = postval("ad");
		$soyad = postval("soyad");
		$vergidairesi = postval("vergiDairesi");
		$adres = postval("adres");
		$aratop = postval("aratopHidden");
		$indirimTop = postval("indirimtopHidden");
		$netTop = postval("netTutarInput");
		$kdvTop = postval("kdvtopHidden");
		$vergiDahil = postval("vergidahilHidden");
		$genelTop = postval("geneltopHidden");
		$tevkifatTop = postval("tevkifattopHidden");
		$aciklama = postval("aciklama");
		$irsaliyeno = postval("irsaliyeNo");
		$irsaliyetarihi = postval("irsaliyeTarihi");

		if ($guncelKur)
			$dovizCevrilmis = $genelTop * $guncelKur;

		if ($faturaTip == "SATIS")
			$faturaTipID = 1;
		else if ($faturaTip == "IADE")
			$faturaTipID = 2;
		else if ($faturaTip == "TEVKIFAT")
			$faturaTipID = 3;
		else if ($faturaTip == "ISTISNA")
			$faturaTipID = 4;

		if ($paraBirimi == "TRY")
			$paraBirimiID = 1;
		else if ($paraBirimi == "USD")
			$paraBirimiID = 2;
		else if ($paraBirimi == "EUR")
			$paraBirimiID = 3;
		else if ($paraBirimi == "GBP")
			$paraBirimiID = 4;

		//gib için fatura detay array
		$fatura_detaylari = [
			"faturaUuid" => $faturaUuid,
			"belgeNumarasi" => $belgeno,
			"faturaTarihi" => $duzenlemeTarihi,
			"saat" => $duzenlemeSaati,
			"paraBirimi" => $paraBirimi,
			"dovzTLkur" => $guncelKur,
			"faturaTipi" => $faturaTip,
			"hangiTip" => "5000/30000",
			//"vknTckn" => "33333319",
			"vknTckn" => $tcknvkn,
			"aliciUnvan" => $unvan,
			"aliciAdi" => $ad,
			"aliciSoyadi" => $soyad,
			"binaAdi" => "",
			"binaNo" => "",
			"kapiNo" => "",
			"kasabaKoy" => "",
			"vergiDairesi" => $vergidairesi,
			"ulke" => "Türkiye",
			"bulvarcaddesokak" => $adres,
			"mahalleSemtIlce" => "",
			"sehir" => " ",
			"postaKodu" => "",
			"tel" => "",
			"fax" => "",
			"eposta" => "",
			"websitesi" => "",
			"iadeTable" => [],
			"ozelMatrahTutari" => "0",
			"ozelMatrahOrani" => 0,
			"ozelMatrahVergiTutari" => "0",
			"vergiCesidi" => " ",
			"malHizmetTable" => [],
			"matrah" => 0,
			"malhizmetToplamTutari" => $aratop,
			"toplamIskonto" => $indirimTop,
			"hesaplanankdv" => $kdvTop,
			"vergilerToplami" => $kdvTop,
			"vergilerDahilToplamTutar" => $vergiDahil,
			"odenecekTutar" => $genelTop,
			"not" => $aciklama,
			"siparisNumarasi" => "",
			"siparisTarihi" => "",
			"irsaliyeNumarasi" => $irsaliyeno,
			"irsaliyeTarihi" => $irsaliyetarihi,
			"fisNo" => "",
			"fisTarihi" => "",
			"fisSaati" => " ",
			"fisTipi" => " ",
			"zRaporNo" => "",
			"okcSeriNo" => ""
		];

		$yeni_satis_irsaliyeTarihi = date("Y-m-d", strtotime($irsaliyetarihi));
		$yeni_satis_faturaTarihi = date("Y-m-d", strtotime($duzenlemeTarihi));


		$stokid = postval("stokid");
		$stokadi = postval("stokadi");
		$birim = postval("birim");
		$miktar = postval("miktar");
		$birimfiyat = postval("birimfiyat");
		$kdv = postval("kdv");
		$toplam = postval("toplamHidden");
		$indirimtutari = postval("indirimyuzde");
		$tevkifatInput = postval("tevkifat");
		$gtipInput = postval("gtip");

		if ($modulGibProSorgula) {
			//gib pro modulü varsa cari kontrolü yap cari_id yi oluştur
			$cari_id = postval("cari_id");
			//cari seçmemişse oluştur
			if (empty($cari_id) || $cari_id == "") {
				if (strlen($tcknvkn) == 10)
					$where = " cari_vergiNumarasi=$tcknvkn";
				else
					$where = " cari_tckn=$tcknvkn";

				$sqlcari = "select * from cari where $where and cari_olusturanAnaHesap=$anaHesap";
				$execari = $this->db->query($sqlcari)->row();
				if (!$execari) {
					if (empty($unvan)) {
						$dataCari["cari_ad"] = $ad;
						$dataCari["cari_soyad"] = $soyad;
					} else
						$dataCari["cari_ad"] = $unvan;

					if (strlen($tcknvkn) == 10)
						$dataCari["cari_vergiNumarasi"] = $tcknvkn;
					else
						$dataCari["cari_tckn"] = $tcknvkn;

					$dataCari["cari_kodu"] = $tcknvkn;
					$dataCari["cari_vergiDairesi"] = $vergidairesi;
					$dataCari["cari_adres"] = $adres;

					$dataCari["cari_olusturan"] = $u_id;
					$dataCari["cari_olusturanAnaHesap"] = $anaHesap;
					$dataCari["cari_olusturmaTarihi"] = $tarihi;
					$dataCari["cari_olusturmaSaati"] = $saati;

					$this->vt->insert("cari", $dataCari);
					$cari_id = $this->db->insert_id();
				} else
					$cari_id = $execari->cari_id;
			}


			#region cariHareketiOlustur
			$data_ch["ch_belgeNumarasi"] = $belgeno;
			$data_ch["ch_turu"] = 2;
			$data_ch["ch_cariID"] = $cari_id;
			$data_ch["ch_faturaID"] = $satis_id;
			$data_ch["ch_paraBirimi"] = $paraBirimi;

			if ($dovizCevrilmis) {
				$data_ch["ch_borc"] = $dovizCevrilmis;
				$data_ch["ch_borcDoviz"] = $genelTop;
			} else
				$data_ch["ch_borc"] = $genelTop;

			$data_ch["ch_tarih"] = $yeni_satis_faturaTarihi;
			$data_ch["ch_olusturan"] = $u_id;
			$data_ch["ch_olusturanAnaHesap"] = $anaHesap;
			$data_ch["ch_olusturmaTarihi"] = $tarihi;
			$data_ch["ch_olusturmaSaati"] = $saati;

			$this->vt->insert("cariHareketleri", $data_ch);
			$ch_id = $this->db->insert_id();
			#endregion cariHareketiOlustur

			//satis faturası veritabanında güncelle (raporlama için)
			#region satisFaturasi


			$data["satis_InvoiceType"] = 3;//gib
			$data["satis_faturaDurum"] = 1;//onaylanmadı onaylanınca 2 yap
			$data["satis_earsivfaturaTip"] = $faturaTipID;
			$data["satis_paraBirimi"] = $paraBirimiID;
			$data["satis_guncelKur"] = $guncelKur;
			$data["satis_dovizCevrilmis"] = $dovizCevrilmis != null ? $dovizCevrilmis : Null;
			$data["satis_irsaliyeNo"] = $irsaliyeno != '' ? $irsaliyeno : NULL;
			$data["satis_irsaliyeTarihi"] = $yeni_satis_irsaliyeTarihi != '' ? $yeni_satis_irsaliyeTarihi : NULL;
			$data["satis_faturaTarihi"] = $yeni_satis_faturaTarihi;
			$data["satis_faturaSaati"] = $duzenlemeSaati;
			$data["satis_aciklama"] = $aciklama;
			$data["satis_araToplam"] = $aratop;
			$data["satis_kdvToplam"] = $kdvTop;
			$data["satis_genelToplam"] = $genelTop;
			$data["satis_vergiDahilToplam"] = $vergiDahil;
			$data["satis_indirimToplam"] = $indirimTop;
			$data["satis_netTutar"] = $netTop;
			$data["satis_cariID"] = $cari_id;

			if ($tevkifatTop != null)
				$data["satis_tevkifatToplam"] = $tevkifatTop;

			$data["satis_olusturan"] = $u_id;
			$data["satis_olusturmaTarihi"] = $tarihi;
			$data["satis_olusturmaSaati"] = $saati;

			$this->vt->update("satisFaturasi", array("satis_id" => $satis_id, "satis_olusturanAnaHesap" => $anaHesap), $data);

			#endregion satisFaturasi
		}

		//stoklar
		$kacAdetStok = count($stokadi);
		for ($i = 0; $i < $kacAdetStok; $i++) {

			$fiyat = $birimfiyat[$i] * $miktar[$i];
			if ($indirimtutari[$i] == "") {
				$indirimOrani = "0";
				$indirim = "0";
			} else {
				$indirimOrani = $indirimtutari[$i];
				$indirim = $fiyat * $indirimtutari[$i] / 100;
			}
			$kdvTutar = $toplam[$i] * $kdv[$i] / 100;
			$tevkifatArr = [];
			$gtip = [];
			if ($faturaTip == "TEVKIFAT") {
				if ($tevkifatInput[$i] != "") {
					$tevkifatArr = explode("|", $tevkifatInput[$i]);
					$tevkifatKod = $tevkifatArr[0];
					$tevkifatOran = $tevkifatArr[1];
					$tevkifatTutari = $kdvTutar * $tevkifatOran;
					$tevkifatArr = ["tevkifatKodu" => $tevkifatKod, "V9015Orani" => $tevkifatOran * 100, "V9015Tutari" => $tevkifatTutari];
				}
			}
			if ($faturaTip == "ISTISNA") {
				$gtip = ["gtip" => $gtipInput[$i]];
			}

			$stok = [
				"malHizmet" => $stokadi[$i],
				"miktar" => $miktar[$i],
				"birim" => $birim[$i],
				"birimFiyat" => $birimfiyat[$i],
				"fiyat" => $fiyat,
				"iskontoNedeni" => "",
				"iskontoOrani" => $indirimOrani,
				"iskontoTutari" => $indirim,
				"iskontoNedeni" => "",
				"malHizmetTutari" => $toplam[$i],
				"kdvOrani" => $kdv[$i],
				"vergiOrani" => 0,
				"kdvTutari" => $kdvTutar,
				"vergininKdvTutari" => "0"
			];

			$fatura_detaylari["malHizmetTable"][] = $stok + $tevkifatArr + $gtip;
			if ($modulGibProSorgula) {
				$stok_id = $stokid[$i];
				if (empty($stok_id)) {

					$stokQ = "select * from stok where stok_ad='" . $stokadi[$i] . "' and stok_olusturanAnaHesap = '$anaHesap'";
					$stokExe = $this->db->query($stokQ)->row();
					if (!$stokExe) {
						$stokCountQ = "SELECT COUNT(*) as total FROM stok WHERE stok_olusturanAnaHesap = '$anaHesap'";
						$stokCountE = $this->db->query($stokCountQ)->row();
						$stokKacTane = $stokCountE->total + 1;
						$stok = str_pad($stokKacTane, 8, '0', STR_PAD_LEFT);

						$birimQ = "select * from stokBirimleri where stokBirim_kodu='$birim[$i]'";
						$birimExe = $this->db->query($birimQ)->row();

						$dataStokX["stok_kodu"] = $stok;
						$dataStokX["stok_ad"] = $stokadi[$i];
						$dataStokX["stok_satisFiyati"] = $birimfiyat[$i];
						$dataStokX["stok_alisFiyati"] = 0;
						$dataStokX["stok_satisKDV"] = $kdv[$i];
						$dataStokX["stok_alisKDV"] = 0;
						$dataStokX["stok_birimID"] = $birimExe->stokBirim_id;
						$dataStokX["stok_olusturan"] = $u_id;
						$dataStokX["stok_olusturanAnaHesap"] = $anaHesap;
						$dataStokX["stok_olusturmaTarihi"] = $tarihi;
						$dataStokX["stok_olusturmaSaati"] = $saati;

						$this->vt->insert("stok", $dataStokX);
					} else $stok_id = $stokExe->stok_id;


				}
				//satisFaturasiStok tablosuna ekle
				#region satisfaturasistok
				$dataStok["satisStok_satisFaturasiID"] = $satis_id;
				$dataStok["satisStok_stokID"] = $stok_id;
				$dataStok["satisStok_miktar"] = $miktar[$i];
				$dataStok["satisStok_birimFiyat"] = $birimfiyat[$i];
				$dataStok["satisStok_fiyatMiktar"] = $fiyat;
				$dataStok["satisStok_kdv"] = $kdv[$i];
				$dataStok["satisStok_indirimTutari"] = $indirimOrani;
				$dataStok["satisStok_satirIskonto"] = $indirim;
				$dataStok["satisStok_indirimlifiyat"] = $toplam[$i];

				if ($tevkifatInput[$i] != "" && $tevkifatInput[$i] != 0) {

					$sqltevkifat = "select * from tevkifatKodlari where tevkifat_kodu=$tevkifatKod";
					$tevkifatExe = $this->db->query($sqltevkifat)->row();
					$dataStok["satisStok_tevkifat_id"] = $tevkifatExe->tevkifat_id;

				} else {
					$dataStok["satisStok_tevkifat_id"] = 0;
				}

				$this->vt->insert("satisFaturasiStok", $dataStok);

				#endregion satisfaturasistok

				#region stokhareketleri
				$data_sh["sh_belgeNumarasi"] = $belgeno;
				$data_sh["sh_turu"] = 2;
				$data_sh["sh_cikis"] = $miktar[$i];
				$data_sh["sh_cariID"] = $cari_id;
				$data_sh["sh_stokID"] = $stok_id;
				$data_sh["sh_faturaID"] = $satis_id;
				$data_sh["sh_paraBirimi"] = $paraBirimi;
				$data_sh["sh_tarih"] = $tarihi;
				$data_sh["sh_birimFiyat"] = $birimfiyat[$i];
				$data_sh["sh_kdv"] = $kdv[$i];
				$data_sh["sh_toplamKDV"] = $kdvTutar;
				$data_sh["sh_toplamFiyat"] = $toplam[$i];
				$data_sh["sh_olusturan"] = $u_id;
				$data_sh["sh_olusturanAnaHesap"] = $anaHesap;
				$data_sh["sh_olusturmaTarihi"] = $tarihi;
				$data_sh["sh_olusturmaSaati"] = $saati;

				$this->vt->insert("stokHareketleri", $data_sh);
				#endregion stokhareketleri

			}
		}
		//iade
		$iade = [];
		$iade_count = postval("iade_count");
		if ($iade_count != 0) {

			$iadenumara = postval("iadenumara");
			$iadetarih = postval("iadetarih");
			for ($i = 0; $i < $iade_count; $i++) {
				$fatura_detaylari["iadeTable"][] = ["faturaNo" => $iadenumara[$i], "duzenlenmeTarihi" => $iadetarih[$i]];
				if ($modulGibProSorgula) {
					$dataIade["satis_id"] = $satis_id;
					$dataIade["fatura_numarasi"] = $iadenumara[$i];
					$dataIade["tarih"] = $iadetarih[$i];

					$this->vt->insert("iade_fatura_numaralari", $dataIade);
				}
			}
		}

		$inv = new Invoice();
		$client = new InvoiceManager();
		$bilgi = gib_giris();
		$client->setCredentials($bilgi->ma_gibUsername, $bilgi->ma_gibSifre);
		$client->connect();
		$inv->mapWithTurkishKeys($fatura_detaylari);
		$client->setInvoice($inv);
		$client->createDraftBasicInvoice();


		$client->logOutFromAPI();


		redirect("gib/duzenlenenBelgeler");


	}

	public function duzenlenenBelgeler()
	{
		$data["baslik"] = "GİB / Düzenlenen Bilgiler";
		$client = new InvoiceManager();

		$tarih = $this->input->get("tarihAraligi");

		if ($tarih != "") {
			$tarih = explode("&", $tarih);
			$startDate = "" . $tarih[0] . "";
			$endDate = "" . $tarih[1] . "";
			$startDate = trim($startDate, " ");
			$endDate = trim($endDate, " ");
		} else {
			$endDate = date("d-m-Y");
			$startDate = date("d-m-Y", strtotime('-30 day', strtotime($endDate)));
		}
		$bilgi = gib_giris();
		$client->setCredentials($bilgi->ma_gibUsername, $bilgi->ma_gibSifre);

		$client->connect();

		$invoice = $client->getInvoicesFromAPI($startDate, $endDate);
		$data["invoice"] = $invoice;

		$client->logOutFromAPI();

		$data["startDate"] = $startDate;
		$data["endDate"] = $endDate;

		$this->load->view('gib/duzenlenen-belgeler', $data);
	}

	public function adimaDuzenlenenBelgeler()
	{
		$data["baslik"] = "GİB / Adıma Düzenlenen Belgeler";
		$client = new Interaktif();
		$tarih = $this->input->get("tarihAraligi");

		if ($tarih != "") {
			$tarih = explode("&", $tarih);
			$startDate = "" . $tarih[0] . "";
			$endDate = "" . $tarih[1] . "";
			$startDate = trim($startDate, " ");
			$endDate = trim($endDate, " ");
			$startDate = date("Y-m-d", strtotime($startDate));
			$endDate = date("Y-m-d", strtotime($endDate));
		} else {
			$endDate = date("Y-m-d");
			$startDate = date("Y-m-d", strtotime('-7 day', strtotime($endDate)));
		}

		$bilgi = gib_giris();
		$client->setCredentials($bilgi->ma_gibUsername, $bilgi->ma_gibSifre);

		$client->connect();


		$invoice = $client->getInvoicesMeFromAPI($startDate, $endDate);

		$data["invoice"] = $invoice["data"]["FATURASONUC"];

		$data["startDate"] = date("d-m-Y", strtotime($startDate));
		$data["endDate"] = date("d-m-Y", strtotime($endDate));
		$client->logOutFromAPI();

		$this->load->view('gib/adima-duzenlenen-belgeler', $data);
	}

	public function htmlGoster($invoice)
	{
		$client = new InvoiceManager();
		$bilgi = gib_giris();
		$client->setCredentials($bilgi->ma_gibUsername, $bilgi->ma_gibSifre);
		$client->connect();
		$oldInvoice = new Invoice();
		$oldInvoice->setUuid($invoice);
		$client->setInvoice($oldInvoice)->getInvoiceFromAPI();
		print_r($client->getInvoiceHTML());
		$client->logOutFromAPI();
	}

	public function pdfGoster($invoice)
	{
		$client = new InvoiceManager();
		$bilgi = gib_giris();
		$client->setCredentials($bilgi->ma_gibUsername, $bilgi->ma_gibSifre);
		$client->connect();
		$oldInvoice = new Invoice();
		$oldInvoice->setUuid($invoice);
		$client->setInvoice($oldInvoice)->getInvoiceFromAPI();
		print_r($client->getInvoicePDF());
		$client->logOutFromAPI();
	}

	public function indir($invoice)
	{
		$client = new InvoiceManager();
		$bilgi = gib_giris();
		$client->setCredentials($bilgi->ma_gibUsername, $bilgi->ma_gibSifre);
		$client->connect();
		$oldInvoice = new Invoice();
		$oldInvoice->setUuid($invoice);
		$client->setInvoice($oldInvoice)->getInvoiceFromAPI();
		//header('Location:'.$client->getDownloadURL());

		$downloadUrl = $client->getDownloadURL(null, true);
		$file = $invoice . '.zip';
		file_put_contents($file, fopen($downloadUrl, 'r'));
		header("Content-length: " . filesize($file));
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="' . $file . '"');
		readfile("$file");
		$client->logOutFromAPI();
	}

	public function iptal()
	{
		$invoice = postval("fatura_ettn");
		$client = new InvoiceManager();
		$bilgi = gib_giris();
		$client->setCredentials($bilgi->ma_gibUsername, $bilgi->ma_gibSifre);
		$client->connect();
		$oldInvoice = new Invoice();
		$oldInvoice->setUuid($invoice);
		$client->setInvoice($oldInvoice)->getInvoiceFromAPI();
		$client->cancelInvoice();
		$client->logOutFromAPI();
		redirect("gib/duzenlenenBelgeler");
	}

	public function smsDogrula()
	{
		$data["baslik"] = "Gib / Sms Doğrulama";
		$_SESSION["uuid"] = postval("fatura_onay_ettn");
		$client = new InvoiceManager();
		$bilgi = gib_giris();
		$client->setCredentials($bilgi->ma_gibUsername, $bilgi->ma_gibSifre);
		$client->connect();
		$_SESSION["smsOid"] = $client->sendSMSVerification();
		$client->logOutFromAPI();
		$this->load->view("gib/sms-dogrula", $data);
	}

	public function smsOnayla()
	{
		$kod = $_POST["kod"][0] . $_POST["kod"][1] . $_POST["kod"][2] . $_POST["kod"][3] . $_POST["kod"][4] . $_POST["kod"][5];
		$client = new InvoiceManager();
		$bilgi = gib_giris();
		$client->setCredentials($bilgi->ma_gibUsername, $bilgi->ma_gibSifre);
		$client->connect();
		$dateStart = "01-01-2022";
		$dateEnd = date("d-m-Y");
		$client->getEttnInvoiceFromAPIArray($dateStart, $dateEnd, $_SESSION["uuid"]);

		//$client->getEttnInvoiceFromAPIArray($dateStart, $dateEnd, $uuid);

		$result = $client->verifySMSCode($kod, $_SESSION["smsOid"]);

		if ($result) {
			$this->session->set_flashdata('kod-dogru', 'OK');

		} else {
			$this->session->set_flashdata('kod-hatali', 'OK');

		}
		$client->logOutFromAPI();
		redirect("gib/duzenlenenBelgeler");
	}

	public function guvenliCikis()
	{
		$client = new InvoiceManager();
		$bilgi = gib_giris();
		$client->setCredentials($bilgi->ma_gibUsername, $bilgi->ma_gibSifre);
		/*$client->setUsername("XXXX")->setPassword("XXXX");

		// Test Environment
		$client->setDebugMode(true)->setTestCredentials();
		*/

		$client->connect();
		$client->logOutFromAPI();

		echo "çıkış";
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

	public function adimaDuzenlenenExcel()
	{

		$client = new Interaktif();
		$tarih = $this->input->get("tarihAraligi");

		$tarih = explode("&", $tarih);
		$startDate = "" . $tarih[0] . "";
		$endDate = "" . $tarih[1] . "";
		$startDate = trim($startDate, " ");
		$endDate = trim($endDate, " ");
		$startDate = date("Y-m-d", strtotime($startDate));
		$endDate = date("Y-m-d", strtotime($endDate));

		$bilgi = gib_giris();
		$client->setCredentials($bilgi->ma_gibUsername, $bilgi->ma_gibSifre);

		$client->connect();

		$invoice = $client->getInvoicesMeFromAPI($startDate, $endDate);
		$invoice = $invoice["data"]["FATURASONUC"];
		$client->logOutFromAPI();

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
		$reader->setReadDataOnly(TRUE);
		$spreadsheet = new Spreadsheet();

		$sheet = $spreadsheet->getActiveSheet();

		date_default_timezone_set('Europe/Istanbul');
		$tarih = (new DateTime('now'))->format('d.m.Y-His');

		$sheet->getStyle('A1:K1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');

		$sheet->setCellValue('A1', 'Düzenleme Tarihi');
		$sheet->setCellValue('B1', 'Düzenleme Saati');
		$sheet->setCellValue('C1', 'Belge Numarası');
		$sheet->setCellValue('D1', 'Alıcı VKN / TCKN');
		$sheet->setCellValue('E1', 'Alıcı Unvan');
		$sheet->setCellValue('F1', 'Toplam Tutar');
		$sheet->setCellValue('G1', 'Ödenecek Tutar');
		$sheet->setCellValue('H1', 'Vergiler Toplamı');
		$sheet->setCellValue('I1', 'Para Birimi');
		$sheet->setCellValue('J1', 'Tesisat Numarası');
		$sheet->setCellValue('K1', 'Gönderim Şekli');


		$rows = 2;
		foreach ($invoice as $item) {
			$sheet->setCellValue('A' . $rows, date("d-m-Y", strtotime($item["tarih"])));
			$sheet->setCellValue('B' . $rows, $item["zaman"]);
			$sheet->setCellValue('C' . $rows, $item["faturaNo"]);
			$sheet->setCellValue('D' . $rows, $item["mukVkn"]);
			$sheet->setCellValue('E' . $rows, $item["unvan"]);
			$sheet->setCellValue('F' . $rows, $item["toplam"]);
			$sheet->setCellValue('G' . $rows, $item["odenecek"]);
			$sheet->setCellValue('H' . $rows, $item["vergi"]);
			$sheet->setCellValue('I' . $rows, $item["paraBirimi"]);
			$sheet->setCellValue('J' . $rows, $item["tesisatNo"]);
			$sheet->setCellValue('K' . $rows, $item["gonderimSekli"]);

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
		$sheet->getColumnDimension('J')->setAutoSize(true);
		$sheet->getColumnDimension('K')->setAutoSize(true);


		$writer = new Xlsx($spreadsheet);//instantiate Xlsx

		$filename = 'adima-duzenlenen-belgeler-' . $tarih;//set filename for excel file to be exported

		header('Content-Type: application/vnd.ms-excel');// generate excel file
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');//download file


	}

	public function duzenlenenExcel()
	{

		$firmaID = getirFirma();
		$firma_ID = $firmaID->ayarlar_id;
		$modulGibProSorgula = modulSorgula($firma_ID, 3);
		$anaHesap = anaHesapBilgisi();

		$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
		$reader->setReadDataOnly(TRUE);
		$spreadsheet = new Spreadsheet();

		$sheet = $spreadsheet->getActiveSheet();


		if ($modulGibProSorgula)//veritabanından excel al
		{

			$tarih = $this->input->get("tarihAraligi");
			$tarih = explode("$", $tarih);
			$startDate = "" . $tarih[0] . "";
			$endDate = "" . $tarih[1] . "";
			$startDate = trim($startDate, " ");
			$endDate = trim($endDate, " ");
			$startDate = date("Y-m-d", strtotime($startDate));
			$endDate = date("Y-m-d", strtotime($endDate));
			$sheet->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');

			$sheet->setCellValue('A1', 'Düzenleme Tarihi');
			$sheet->setCellValue('B1', 'Düzenleme Saati');
			$sheet->setCellValue('C1', 'Belge Numarası');
			$sheet->setCellValue('D1', 'Alıcı VKN / TCKN');
			$sheet->setCellValue('E1', 'Alıcı Unvan');
			$sheet->setCellValue('F1', 'Toplam Tutar');
			$sheet->setCellValue('G1', 'Ödenecek Tutar');
			$sheet->setCellValue('H1', 'Vergiler Toplamı');
			$sheet->setCellValue('I1', 'Para Birimi');
			$rows = 2;
			$faturalarsql = "select * from satisFaturasi where satis_invoiceType=3 and satis_olusturanAnaHesap=$anaHesap and satis_faturaTarihi between '$startDate' and '$endDate'";
			$faturalarExe = $this->db->query($faturalarsql)->result();
			foreach ($faturalarExe as $item) {

				$cariSql = "select * from cari where cari_id=$item->satis_cariID and cari_olusturanAnaHesap=$anaHesap";
				$cariExe = $this->db->query($cariSql)->row();
				if ($cariExe->cari_vergiNumarasi != Null) {
					$mukVkn = $cariExe->cari_vergiNumarasi;
					$unvan = $cariExe->cari_ad;
				} else if ($cariExe->cari_tckn != Null) {
					$mukVkn = $cariExe->cari_tckn;
					$unvan = $cariExe->cari_ad . " " . $cariExe->cari_soyad;
				}
				if ($item->satis_paraBirimi == 1)
					$paraBirimi = "TRY";
				else if ($item->satis_paraBirimi == 2)
					$paraBirimi = "USD";
				else if ($item->satis_paraBirimi == 3)
					$paraBirimi = "EUR";
				else if ($item->satis_paraBirimi == 4)
					$paraBirimi = "GBP";

				$sheet->setCellValue('A' . $rows, date("d-m-Y", strtotime($item->satis_faturaTarihi)));
				$sheet->setCellValue('B' . $rows, $item->satis_faturaSaati);
				$sheet->setCellValue('C' . $rows, $item->satis_faturaNo);
				$sheet->setCellValue('D' . $rows, $mukVkn);
				$sheet->setCellValue('E' . $rows, $unvan);
				$sheet->setCellValue('F' . $rows, $item->satis_araToplam);
				$sheet->setCellValue('G' . $rows, $item->satis_genelToplam);
				$sheet->setCellValue('H' . $rows, $item->satis_kdvToplam);
				$sheet->setCellValue('I' . $rows, $paraBirimi);

				$rows++;
			}
		}
		else//gibten excel al
		{
			$tarih = $this->input->get("tarihAraligi");

			$client = new InvoiceManager();
				$tarih = explode("&", $tarih);
				$startDate = "" . $tarih[0] . "";
				$endDate = "" . $tarih[1] . "";
				$startDate = trim($startDate, " ");
				$endDate = trim($endDate, " ");


			$bilgi = gib_giris();
			//$client->setCredentials($bilgi->ma_gibUsername, $bilgi->ma_gibSifre);
			$client->setCredentials("33210617", "120580");
			$client->connect();

			$invoice = $client->getInvoicesFromAPI($startDate, $endDate);



			$client->logOutFromAPI();


			$sheet->getStyle('A1:G1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('CCCCCC');

			$sheet->setCellValue('A1', 'Düzenleme Tarihi');
			$sheet->setCellValue('B1', 'Belge Türü');
			$sheet->setCellValue('C1', 'Belge Numarası');
			$sheet->setCellValue('D1', 'Alıcı VKN / TCKN');
			$sheet->setCellValue('E1', 'Alıcı Unvan');
			$sheet->setCellValue('F1', 'Onay Durumu');
			$sheet->setCellValue('G1', 'İptal/İtiraz Durumu');
			$rows = 2;
			foreach ($invoice["data"] as $item) {

				if ($item["iptalItiraz"] == "0")
					$iptalItiraz = "İptal Kabul Edildi";
				else if ($item["iptalItiraz"] == "1")
					$iptalItiraz = "İptal Kabul Edilmedi";
				else
					$iptalItiraz = "---";
				$sheet->setCellValue('A' . $rows, date("d-m-Y", strtotime($item["belgeTarihi"])));
				$sheet->setCellValue('B' . $rows, $item["belgeTuru"]);
				$sheet->setCellValue('C' . $rows, $item["belgeNumarasi"]);
				$sheet->setCellValue('D' . $rows, $item["aliciVknTckn"]);
				$sheet->setCellValue('E' . $rows, $item["aliciUnvanAdSoyad"]);
				$sheet->setCellValue('F' . $rows, $item["onayDurumu"]);
				$sheet->setCellValue('G' . $rows, $iptalItiraz);
				$rows++;
			}

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

		$filename = 'duzenlenen-belgeler-' . $tarih;//set filename for excel file to be exported

		header('Content-Type: application/vnd.ms-excel');// generate excel file
		header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output');//download file


	}
}
