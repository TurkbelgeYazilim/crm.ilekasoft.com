<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muhase extends CI_Controller {
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

		// Session kontrolü - varsa aktifleştir
		// sessionKontrolHelper();
	}	public function onayBekleyenTahsilatlar()
	{
		$data["baslik"] = "Muhasebe / Onay Bekleyen Tahsilatlar";
		$anaHesap = anaHesapBilgisi();
		
		// Giriş yapan kullanıcı bilgisi
		$control = session("r", "login_info");
		$u_id = $control->kullanici_id;
				// Muhasebe tahsilat durum tablosunun varlığını kontrol et
		$tableExists = $this->db->query("SHOW TABLES LIKE 'muhasebe_tahsilat_durum'")->num_rows();
		
		if ($tableExists == 0) {
			// Tablo yoksa boş veri döndür ve kullanıcıyı bilgilendir
			$data["tahsilatlar"] = array();
			$data["toplam_tutar"] = 0;
			$data["toplam_adet"] = 0;
			$data["error_message"] = "Muhasebe tahsilat durum tablosu henüz oluşturulmamış. Lütfen 'muhase_database_setup.sql' dosyasını veritabanında çalıştırın.";
		} else {
			// Bağımlı tabloların varlığını da kontrol et
			$requiredTables = ['bankaHareketleri', 'cek', 'kasaHareketleri', 'senet', 'cari', 'kullanicilar'];
			$missingTables = [];
			
			foreach($requiredTables as $table) {
				$exists = $this->db->query("SHOW TABLES LIKE '$table'")->num_rows();
				if($exists == 0) {
					$missingTables[] = $table;
				}
			}
			
			if(!empty($missingTables)) {
				$data["tahsilatlar"] = array();
				$data["toplam_tutar"] = 0;
				$data["toplam_adet"] = 0;
				$data["error_message"] = "Eksik tablolar tespit edildi: " . implode(', ', $missingTables) . ". Lütfen veritabanı kurulumunu tamamlayın.";
			} else {
			// Ana sorgu: Muhasebe tahsilat durum tablosundan veri çek
			$tahsilatlarQ = "SELECT 
			   mtd.id,
			   CASE 
				   WHEN mtd.tahsilat_tipi = 1 THEN 'Banka'
				   WHEN mtd.tahsilat_tipi = 2 THEN 'Çek'
				   WHEN mtd.tahsilat_tipi = 3 THEN 'Kasa'
				   WHEN mtd.tahsilat_tipi = 4 THEN 'Senet'
				   ELSE 'Bilinmiyor'
			   END as tahsilat_tipi_adi,
			   mtd.kayit_id,
			   CASE 
				   WHEN mtd.durum = 1 THEN 'Onay Bekliyor'
				   WHEN mtd.durum = 2 THEN 'Onaylandı'
				   WHEN mtd.durum = 3 THEN 'Reddedildi'
				   ELSE 'Bilinmiyor'
			   END as durum_adi,
			   mtd.durum,
			   COALESCE(bh_cari.cari_ad, c_cari.cari_ad, kh_cari.cari_ad, s_cari.cari_ad) as musteri_adi,
			   COALESCE(bh.bh_gorsel, c.cek_gorsel, kh.kh_gorsel, s.senet_gorsel) as gorsel,
			   COALESCE(bh.bh_giris, c.cek_tutar, kh.kh_giris, s.senet_tutar) as tutar,
			   CONCAT(onay_k.kullanici_ad, ' ', onay_k.kullanici_soyad) as onay_yapan_personel,
			   CASE 
				   WHEN mtd.tahsilat_tipi = 1 THEN CONCAT(bh_k.kullanici_ad, ' ', bh_k.kullanici_soyad)
				   WHEN mtd.tahsilat_tipi = 2 THEN CONCAT(c_k.kullanici_ad, ' ', c_k.kullanici_soyad)
				   WHEN mtd.tahsilat_tipi = 3 THEN CONCAT(kh_k.kullanici_ad, ' ', kh_k.kullanici_soyad)
				   WHEN mtd.tahsilat_tipi = 4 THEN CONCAT(s_k.kullanici_ad, ' ', s_k.kullanici_soyad)
			   END as islemi_yapan_personel,
			   mtd.islem_tarihi,
			   mtd.olusturma_tarihi,
			   mtd.aciklama
			FROM muhasebe_tahsilat_durum mtd
			
			-- Onay yapan personel
			LEFT JOIN kullanicilar onay_k ON mtd.islemi_yapan = onay_k.kullanici_id
			
			-- Banka hareketleri
			LEFT JOIN bankaHareketleri bh ON mtd.tahsilat_tipi = 1 AND mtd.kayit_id = bh.bh_id
			LEFT JOIN kullanicilar bh_k ON bh.bh_olusturan = bh_k.kullanici_id
			LEFT JOIN cari bh_cari ON bh.bh_cariID = bh_cari.cari_id
			
			-- Çek
			LEFT JOIN cek c ON mtd.tahsilat_tipi = 2 AND mtd.kayit_id = c.cek_id
			LEFT JOIN kullanicilar c_k ON c.cek_kullaniciID = c_k.kullanici_id
			LEFT JOIN cari c_cari ON c.cek_cariID = c_cari.cari_id
			
			-- Kasa hareketleri
			LEFT JOIN kasaHareketleri kh ON mtd.tahsilat_tipi = 3 AND mtd.kayit_id = kh.kh_id
			LEFT JOIN kullanicilar kh_k ON kh.kh_olusturan = kh_k.kullanici_id
			LEFT JOIN cari kh_cari ON kh.kh_cariID = kh_cari.cari_id
					-- Senet
			LEFT JOIN senet s ON mtd.tahsilat_tipi = 4 AND mtd.kayit_id = s.senet_id
			LEFT JOIN kullanicilar s_k ON s.senet_kullaniciID = s_k.kullanici_id
			LEFT JOIN cari s_cari ON s.senet_cariID = s_cari.cari_id
			
			WHERE mtd.durum = 1  -- Sadece onay bekleyen tahsilatlar
			
			ORDER BY mtd.olusturma_tarihi DESC";
			
			$data["tahsilatlar"] = $this->db->query($tahsilatlarQ)->result();
			
			// İstatistikler			$data["toplam_adet"] = count($data["tahsilatlar"]);
			
			// Toplam tutar hesapla
			$toplam_tutar = 0;
			foreach($data["tahsilatlar"] as $tahsilat) {
				if($tahsilat->tutar) {
					$toplam_tutar += $tahsilat->tutar;
				}
			}
			$data["toplam_tutar"] = $toplam_tutar;
			}
		}
		
		// Sayfa yükle
		$this->load->view("muhase/onay-bekleyen-tahsilatlar", $data);
	}
	public function tahsilatOnay($tahsilat_id)
	{
		$anaHesap = anaHesapBilgisi();
		$control = session("r", "login_info");
		$u_id = $control->kullanici_id;
		
		// Muhasebe tahsilat durum tablosundan bilgiyi kontrol et
		$tahsilatQ = "SELECT * FROM muhasebe_tahsilat_durum WHERE id = '$tahsilat_id'";
		$tahsilat = $this->db->query($tahsilatQ)->row();
		
		if ($tahsilat && $tahsilat->durum == 1) { // Sadece onay bekleyen durumda olanlar
			// Onay işlemi
			$data = array(
				'durum' => 2, // 2 = Onaylandı
				'islem_tarihi' => date('Y-m-d H:i:s'),
				'islemi_yapan' => $u_id
			);
			
			$this->db->where('id', $tahsilat_id);
			$this->db->update('muhasebe_tahsilat_durum', $data);
			
			$this->session->set_flashdata('tahsilat_onay_ok', 'OK');
			logekle(1, 3); // Log ekle
		} else {
			$this->session->set_flashdata('tahsilat_onay_hata', 'OK');
		}
		
		redirect("muhase/onay-bekleyen-tahsilatlar");
	}
	public function tahsilatRed($tahsilat_id)
	{
		$anaHesap = anaHesapBilgisi();
		$control = session("r", "login_info");
		$u_id = $control->kullanici_id;
		
		// Muhasebe tahsilat durum tablosundan bilgiyi kontrol et
		$tahsilatQ = "SELECT * FROM muhasebe_tahsilat_durum WHERE id = '$tahsilat_id'";
		$tahsilat = $this->db->query($tahsilatQ)->row();
		
		if ($tahsilat && $tahsilat->durum == 1) { // Sadece onay bekleyen durumda olanlar
			// Red işlemi
			$data = array(
				'durum' => 3, // 3 = Reddedildi
				'islem_tarihi' => date('Y-m-d H:i:s'),
				'islemi_yapan' => $u_id
			);
			
			$this->db->where('id', $tahsilat_id);
			$this->db->update('muhasebe_tahsilat_durum', $data);
			
			$this->session->set_flashdata('tahsilat_red_ok', 'OK');
			logekle(1, 3); // Log ekle
		} else {
			$this->session->set_flashdata('tahsilat_red_hata', 'OK');
		}
		
		redirect("muhase/onay-bekleyen-tahsilatlar");
	}
	public function tahsilatDetay($tahsilat_id)
	{
		$anaHesap = anaHesapBilgisi();
		
		// Muhasebe tahsilat durum tablosundan detayı getir
		$tahsilatQ = "SELECT 
		   mtd.id,
		   CASE 
			   WHEN mtd.tahsilat_tipi = 1 THEN 'Banka'
			   WHEN mtd.tahsilat_tipi = 2 THEN 'Çek'
			   WHEN mtd.tahsilat_tipi = 3 THEN 'Kasa'
			   WHEN mtd.tahsilat_tipi = 4 THEN 'Senet'
			   ELSE 'Bilinmiyor'
		   END as tahsilat_tipi_adi,
		   mtd.kayit_id,
		   CASE 
			   WHEN mtd.durum = 1 THEN 'Onay Bekliyor'
			   WHEN mtd.durum = 2 THEN 'Onaylandı'
			   WHEN mtd.durum = 3 THEN 'Reddedildi'
			   ELSE 'Bilinmiyor'
		   END as durum_adi,
		   mtd.durum,
		   COALESCE(bh_cari.cari_ad, c_cari.cari_ad, kh_cari.cari_ad, s_cari.cari_ad) as musteri_adi,
		   COALESCE(bh_cari.cari_kodu, c_cari.cari_kodu, kh_cari.cari_kodu, s_cari.cari_kodu) as musteri_kodu,
		   COALESCE(bh_cari.cari_telefon, c_cari.cari_telefon, kh_cari.cari_telefon, s_cari.cari_telefon) as musteri_telefon,
		   COALESCE(bh.bh_gorsel, c.cek_gorsel, kh.kh_gorsel, s.senet_gorsel) as gorsel,
		   COALESCE(bh.bh_giris, c.cek_tutar, kh.kh_giris, s.senet_tutar) as tutar,
		   CONCAT(onay_k.kullanici_ad, ' ', onay_k.kullanici_soyad) as onay_yapan_personel,
		   CASE 
			   WHEN mtd.tahsilat_tipi = 1 THEN CONCAT(bh_k.kullanici_ad, ' ', bh_k.kullanici_soyad)
			   WHEN mtd.tahsilat_tipi = 2 THEN CONCAT(c_k.kullanici_ad, ' ', c_k.kullanici_soyad)
			   WHEN mtd.tahsilat_tipi = 3 THEN CONCAT(kh_k.kullanici_ad, ' ', kh_k.kullanici_soyad)
			   WHEN mtd.tahsilat_tipi = 4 THEN CONCAT(s_k.kullanici_ad, ' ', s_k.kullanici_soyad)
		   END as islemi_yapan_personel,
		   mtd.islem_tarihi,
		   mtd.olusturma_tarihi,
		   mtd.aciklama
		FROM muhasebe_tahsilat_durum mtd
		
		-- Onay yapan personel
		LEFT JOIN kullanicilar onay_k ON mtd.islemi_yapan = onay_k.kullanici_id
		
		-- Banka hareketleri
		LEFT JOIN bankaHareketleri bh ON mtd.tahsilat_tipi = 1 AND mtd.kayit_id = bh.bh_id
		LEFT JOIN kullanicilar bh_k ON bh.bh_olusturan = bh_k.kullanici_id
		LEFT JOIN cari bh_cari ON bh.bh_cariID = bh_cari.cari_id
		
		-- Çek
		LEFT JOIN cek c ON mtd.tahsilat_tipi = 2 AND mtd.kayit_id = c.cek_id
		LEFT JOIN kullanicilar c_k ON c.cek_kullaniciID = c_k.kullanici_id
		LEFT JOIN cari c_cari ON c.cek_cariID = c_cari.cari_id
		
		-- Kasa hareketleri
		LEFT JOIN kasaHareketleri kh ON mtd.tahsilat_tipi = 3 AND mtd.kayit_id = kh.kh_id
		LEFT JOIN kullanicilar kh_k ON kh.kh_olusturan = kh_k.kullanici_id
		LEFT JOIN cari kh_cari ON kh.kh_cariID = kh_cari.cari_id
		
		-- Senet
		LEFT JOIN senet s ON mtd.tahsilat_tipi = 4 AND mtd.kayit_id = s.senet_id
		LEFT JOIN kullanicilar s_k ON s.senet_kullaniciID = s_k.kullanici_id
		LEFT JOIN cari s_cari ON s.senet_cariID = s_cari.cari_id
		
		WHERE mtd.id = '$tahsilat_id'";
		
		$data["tahsilat"] = $this->db->query($tahsilatQ)->row();
		
		if ($data["tahsilat"]) {
			$data["baslik"] = "Muhasebe / Tahsilat Detayı";
			$this->load->view("muhase/tahsilat-detay", $data);
		} else {
			redirect('hata');
		}
	}
}
