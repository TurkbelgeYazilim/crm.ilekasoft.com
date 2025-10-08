<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Talepler extends CI_Controller {    public function __construct()

    {

        parent::__construct();

        error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

        $this->load->model('Vt', 'vt');

        $this->load->database();

        $this->load->library('session');

        $this->load->library('form_validation');

        $this->load->helper(['date', 'url', 'form']);



        // Session kontrolü

        $control = session("r", "login");

        if (!$control) {

            redirect("check");

        }

    }/**

     * Ana menü - Talepler listesi

     */

    public function index()

    {

        if (!grup_modul_yetkisi_var(1800)) {

            redirect("home/hata");

        }



        $data["baslik"] = "Talepler Listesi";

        

        // Kullanıcı bilgilerini al

        $control2 = session("r", "login_info");

        $u_id = $control2->kullanici_id;
        $grup_id = $control2->grup_id; // Kullanıcının grup ID'sini al

        $bugun = date('Y-m-d');

        
        // Grup ID = 1 ise tüm talepler görülebilir, değilse sadece kullanıcının kendi talepler
        $isAdminGroup = ($grup_id == 1);

        // Kullanıcının sorumlu olduğu il ve ilçeleri çek (sadece admin grubu değilse)

        $sorumluIlIds = array();

        $sorumluIlceIds = array();

        

        if ($u_id && !$isAdminGroup) {

            // İl sorumluluklarını çek (ilce_id = 0 olanlar tüm il için sorumluluk)

            $sorumluIllerQ = "SELECT DISTINCT il_id 

                             FROM kullanici_sorumluluk_bolgesi 

                             WHERE kullanici = '$u_id' 

                             AND durum = 1 

                             AND il_id IS NOT NULL

                             AND il_id > 0

                             AND (baslangic_tarihi IS NULL OR baslangic_tarihi <= '$bugun') 

                             AND (bitis_tarihi IS NULL OR bitis_tarihi >= '$bugun')";

            $sorumluIller = $this->db->query($sorumluIllerQ)->result();

            

            foreach ($sorumluIller as $il) {

                $sorumluIlIds[] = $il->il_id;

            }

            

            // İlçe sorumluluklarını çek (ilce_id > 0 olanlar)

            $sorumluIlcelerQ = "SELECT DISTINCT ilce_id 

                               FROM kullanici_sorumluluk_bolgesi 

                               WHERE kullanici = '$u_id' 

                               AND durum = 1 

                               AND ilce_id IS NOT NULL

                               AND ilce_id > 0

                               AND (baslangic_tarihi IS NULL OR baslangic_tarihi <= '$bugun') 

                               AND (bitis_tarihi IS NULL OR bitis_tarihi >= '$bugun')";

            $sorumluIlceler = $this->db->query($sorumluIlcelerQ)->result();

            

            foreach ($sorumluIlceler as $ilce) {

                $sorumluIlceIds[] = $ilce->ilce_id;

            }

        }

        

        // Potansiyel cari listesini getir (sadece talep olanlar) ve en son durum bilgisi

        $this->db->select('pc.*, s.sektor_adi, u.ulke_adi, il.il as il_adi, ilce.ilce as ilce_adi, CONCAT(k.kullanici_ad, " ", k.kullanici_soyad) as kullanici_adsoyad, 

                          pd.Durum_Adi as son_durum_adi,

                          (SELECT ps.durum_id FROM potansiyel_satis ps WHERE ps.potansiyel_cari_id = pc.id ORDER BY ps.id DESC LIMIT 1) as son_durum_id');

        $this->db->from('potansiyel_cari pc');

        $this->db->join('sektorler s', 'pc.sektor_id = s.sektor_id', 'left');

        $this->db->join('ulkeler u', 'pc.potansiyel_ulke_id = u.id', 'left');

        $this->db->join('iller il', 'pc.potansiyel_il_id = il.id', 'left');

        $this->db->join('ilceler ilce', 'pc.potansiyel_ilce_id = ilce.id', 'left');

        $this->db->join('kullanicilar k', 'pc.olusturan_kullanici = k.kullanici_id', 'left');

        $this->db->join('potansiyel_durumlar pd', 'pd.id = (SELECT ps.durum_id FROM potansiyel_satis ps WHERE ps.potansiyel_cari_id = pc.id ORDER BY ps.id DESC LIMIT 1)', 'left');

        $this->db->where('pc.potansitel_talep', 1); // Sadece talep olanları getir

        

        // Grup ID = 1 ise tüm talepler görülebilir, değilse sorumluluk bölgesi filtresi uygula
        if (!$isAdminGroup) {
            // Admin grubu değilse, sorumluluk bölgesi filtrelemesi (sadece il ve ilçe)
            if (!empty($sorumluIlIds) || !empty($sorumluIlceIds)) {
                $this->db->group_start();
                
                // İl bazlı sorumluluk
                if (!empty($sorumluIlIds)) {
                    $this->db->or_where_in('pc.potansiyel_il_id', $sorumluIlIds);
                }
                
                // İlçe bazlı sorumluluk
                if (!empty($sorumluIlceIds)) {
                    $this->db->or_where_in('pc.potansiyel_ilce_id', $sorumluIlceIds);
                }
                
                $this->db->group_end();
            } else {
                // Sorumluluk bölgesi yoksa sadece kendi oluşturduğu talepleri göster
                $this->db->where('pc.olusturan_kullanici', $u_id);
            }
        }
        // Admin grubu (grup_id = 1) ise hiçbir filtre uygulanmaz, tüm talepler görülür

        

        $this->db->order_by('pc.id', 'DESC');

        $talepler = $this->db->get()->result();

        

        // Telefon numaralarını formatla

        foreach ($talepler as &$talep) {

            if (!empty($talep->potansiyel_cari_firmaTelefon)) {

                $talep->potansiyel_cari_firmaTelefon = $this->format_phone_number($talep->potansiyel_cari_firmaTelefon);

            }

        }

        

        $data["talepler"] = $talepler;

        

        // Potansiyel durumları getir (modal için)

        $this->db->select('*');

        $this->db->from('potansiyel_durumlar');

        $this->db->order_by('Durum_Adi', 'ASC');

        $data["potansiyelDurumlar"] = $this->db->get()->result();

        

        $this->load->view("talepler/talep-listesi", $data);

    }    /**

     * Talep oluştur sayfası

     */

    public function talep_olustur()

    {

        if (!grup_modul_yetkisi_var(1810)) {

            redirect("home/hata");

        }



        $data["baslik"] = "Talep Oluştur";

        

        // Kullanıcı bilgilerini al

        $control2 = session("r", "login_info");

        $data["kullanici"] = $control2;

        

        // Talep kaynakları

        $data["talep_kaynaklari"] = $this->vt->multiple('talep_kaynaklari', [], 'talep_kaynaklari_adi ASC');

        

        // Talep durumları (aktif olanlar)

        $data["talep_durumlari"] = $this->vt->multiple('talep_durumlari', ['talep_durumlari_durum' => 1], 'talep_durumlari_adi ASC');

        

        // Sektörler (varsa)

        $data["sektorler"] = $this->vt->multiple('sektorler', [], 'sektor_adi ASC');        // Ülkeler

        $data["ulkeler"] = $this->vt->multiple('ulkeler', [], 'ulke_adi ASC');

        // İller - Türkiye illeri (ulke_id = 3)

        $data["iller"] = $this->vt->multiple('iller', ['ulke_id' => 3], 'il ASC');



        $this->load->view("talepler/talep-olustur", $data);

    }    /**

     * Talep kaydet/güncelle (POST)

     */

    public function talep_kaydet()

    {

        if (!grup_modul_yetkisi_var(1810)) {

            redirect("home/hata");

        }



        $control2 = session("r", "login_info");

        $u_id = $control2->kullanici_id;



        date_default_timezone_set('Europe/Istanbul');

        $tarih = date('Y-m-d H:i:s');



        // Güncelleme mi yoksa yeni kayıt mı?

        $talep_id = $this->input->post('talep_id');

        $is_update = !empty($talep_id);



        // Randevu tarih ve saati birleştir (sadece talep_cari için gerekli)

        $randevu_tarihi = $this->input->post('talep_cari_randevu_tarih');

        $randevu_saati = $this->input->post('talep_cari_randevu_saat');

        $randevu = null;

        if ($randevu_tarihi && $randevu_saati) {

            $randevu = $randevu_tarihi . ' ' . $randevu_saati;

        }



        if ($is_update) {

            // Güncelleme işlemi - potansiyel_cari tablosunu güncelle

            $telefon = $this->format_phone_number($this->input->post('talep_cari_telefon'));

            

            $data_potansiyel = array(

                'potansiyel_cari_ad' => $this->input->post('talep_cari_adsoyad') . 

                                        ($this->input->post('talep_cari_firma') ? ' - ' . $this->input->post('talep_cari_firma') : ''),

                'potansiyel_cari_firmaTelefon' => $telefon,

                'sektor_id' => $this->input->post('talep_cari_sektor_id') ?: null,

                'potansiyel_ulke_id' => $this->input->post('talep_cari_ulke_id') ?: null,

                'potansiyel_il_id' => $this->input->post('talep_cari_il_id') ?: null,

                'potansiyel_ilce_id' => $this->input->post('talep_cari_ilce_id') ?: null,

                'potansiyel_mahalle' => $this->input->post('talep_cari_mahalle'),

                'potansiyel_cari_adres' => $this->input->post('talep_cari_adres')

            );

            

            // Önce kayıt var mı kontrol et

            $existing = $this->db->where('id', $talep_id)->get('potansiyel_cari')->row();

            if (!$existing) {

                $this->session->set_flashdata('talep_hata', 'Güncellenecek kayıt bulunamadı.');

                redirect('talepler/talepler-listesi');

                return;

            }

            

            // CodeIgniter'ın built-in update metodunu kullan

            $this->db->where('id', $talep_id);

            $result = $this->db->update('potansiyel_cari', $data_potansiyel);

            

            // Veritabanı hatası var mı kontrol et

            $db_error = $this->db->error();

            if ($db_error['code'] != 0) {

                $this->session->set_flashdata('talep_hata', 'Veritabanı hatası: ' . $db_error['message']);

                redirect('talepler/talep-detay/' . $talep_id);

                return;

            }

            

            // Kaç satır etkilendi kontrol et

            $affected_rows = $this->db->affected_rows();

            

            if ($result && $affected_rows > 0) {

                $this->session->set_flashdata('talep_basarili', 'Potansiyel müşteri başarıyla güncellendi.');

                logekle(1810, 3); // Talep güncelle için log

            } else {

                $this->session->set_flashdata('talep_hata', 'Hiçbir değişiklik yapılmadı veya güncellenemedi.');

            }

            

            redirect('talepler/talep-detay/' . $talep_id);

        } else {

            // Yeni kayıt işlemi - potansiyel_cari tablosuna ekle

            $telefon = $this->format_phone_number($this->input->post('talep_cari_telefon'));

            

            $data_potansiyel = array(

                'sezon_id' => 5, // Default sezon

                'potansiyel_cari_ad' => $this->input->post('talep_cari_adsoyad') . 

                                        ($this->input->post('talep_cari_firma') ? ' - ' . $this->input->post('talep_cari_firma') : ''),

                'potansiyel_cari_firmaTelefon' => $telefon,

                'sektor_id' => $this->input->post('talep_cari_sektor_id') ?: null,

                'potansiyel_ulke_id' => $this->input->post('talep_cari_ulke_id') ?: null,

                'potansiyel_il_id' => $this->input->post('talep_cari_il_id') ?: null,

                'potansiyel_ilce_id' => $this->input->post('talep_cari_ilce_id') ?: null,

                'potansiyel_mahalle' => $this->input->post('talep_cari_mahalle'),

                'potansiyel_cari_adres' => $this->input->post('talep_cari_adres'),

                'potansitel_talep' => 1,

                'olusturan_kullanici' => $u_id,

                'olusturma_zamani' => $tarih

            );

            

            $result = $this->vt->insert('potansiyel_cari', $data_potansiyel);

            

            if ($result) {

                // Yeni eklenen kaydın ID'sini al

                $yeni_talep_id = $this->db->insert_id();

                

                // Admin'e bildirim gönder

                $this->_send_new_talep_notification($yeni_talep_id, $data_potansiyel);

                

                $this->session->set_flashdata('talep_basarili', 'Potansiyel müşteri başarıyla oluşturuldu.');

                logekle(1810, 2); // Talep oluştur modülü için log

            } else {

                $this->session->set_flashdata('talep_hata', 'Potansiyel müşteri oluşturulurken bir hata oluştu.');

            }



            redirect('talepler/talepler-listesi');

        }

    }    /**

     * Talep detayı görüntüle

     */

    public function talep_detay($id)

    {

        if (!grup_modul_yetkisi_var(1800)) {

            redirect("home/hata");

        }



        $data["baslik"] = "Talep Detayı";

        

        // Kullanıcı bilgilerini al

        $control2 = session("r", "login_info");

        $u_id = $control2->kullanici_id;

        $bugun = date('Y-m-d');



        // Potansiyel cari bilgilerini getir (JOIN ile ilişkili veriler)

        $this->db->select('pc.*, s.sektor_adi, u.ulke_adi, il.il as il_adi, ilce.ilce as ilce_adi, CONCAT(k.kullanici_ad, " ", k.kullanici_soyad) as kullanici_adsoyad');

        $this->db->from('potansiyel_cari pc');

        $this->db->join('kullanicilar k', 'pc.olusturan_kullanici = k.kullanici_id', 'left');

        $this->db->join('sektorler s', 'pc.sektor_id = s.sektor_id', 'left');

        $this->db->join('ulkeler u', 'pc.potansiyel_ulke_id = u.id', 'left');

        $this->db->join('iller il', 'pc.potansiyel_il_id = il.id', 'left');

        $this->db->join('ilceler ilce', 'pc.potansiyel_ilce_id = ilce.id', 'left');

        $this->db->where('pc.id', $id);

        $this->db->where('pc.potansitel_talep', 1); // Sadece talep olanları

        $query = $this->db->get();

        $data["talep"] = $query->row();

        

        if (!$data["talep"]) {

            $this->session->set_flashdata('hata', 'Potansiyel müşteri bulunamadı.');

            redirect('talepler/talepler-listesi');

            return;

        }



        // Kullanıcının bu bölgede yetkili olup olmadığını kontrol et

        $yetkiVarMi = false;

        

        // İl bazlı yetki kontrolü

        if ($data["talep"]->potansiyel_il_id) {

            $ilYetkiQ = "SELECT COUNT(*) as sayac 

                        FROM kullanici_sorumluluk_bolgesi 

                        WHERE kullanici = '$u_id' 

                        AND durum = 1 

                        AND il_id = '{$data["talep"]->potansiyel_il_id}'

                        AND (baslangic_tarihi IS NULL OR baslangic_tarihi <= '$bugun') 

                        AND (bitis_tarihi IS NULL OR bitis_tarihi >= '$bugun')";

            $ilYetki = $this->db->query($ilYetkiQ)->row();

            if ($ilYetki->sayac > 0) {

                $yetkiVarMi = true;

            }

        }

        

        // İlçe bazlı yetki kontrolü

        if (!$yetkiVarMi && $data["talep"]->potansiyel_ilce_id) {

            $ilceYetkiQ = "SELECT COUNT(*) as sayac 

                          FROM kullanici_sorumluluk_bolgesi 

                          WHERE kullanici = '$u_id' 

                          AND durum = 1 

                          AND ilce_id = '{$data["talep"]->potansiyel_ilce_id}'

                          AND (baslangic_tarihi IS NULL OR baslangic_tarihi <= '$bugun') 

                          AND (bitis_tarihi IS NULL OR bitis_tarihi >= '$bugun')";

            $ilceYetki = $this->db->query($ilceYetkiQ)->row();

            if ($ilceYetki->sayac > 0) {

                $yetkiVarMi = true;

            }

        }



        if (!$yetkiVarMi) {

            $this->session->set_flashdata('hata', 'Bu bölgedeki talebe erişim yetkiniz bulunmamaktadır.');

            redirect('talepler/talepler-listesi');

            return;

        }

        

        // Telefon numarasını formatla

        if (!empty($data["talep"]->potansiyel_cari_firmaTelefon)) {

            $data["talep"]->potansiyel_cari_firmaTelefon = $this->format_phone_number($data["talep"]->potansiyel_cari_firmaTelefon);

        }



        $this->load->view("talepler/talep-detay", $data);

    }    /**

     * İlçeleri AJAX ile getir

     */

    public function get_ilceler($il_id = null)

    {

        // Header'ları ayarla

        header('Content-Type: application/json; charset=utf-8');

        header('Access-Control-Allow-Origin: *');

        header('Access-Control-Allow-Methods: GET, POST');

        header('Access-Control-Allow-Headers: Content-Type');

        

        // GET parametresi veya POST ile gelen il_id

        if ($il_id === null) {

            $il_id = $this->input->post('il_id');

        }

        

        // GET parametresinden de alabilir

        if ($il_id === null) {

            $il_id = $this->input->get('il_id');

        }

        

        // Debug için log ekleyelim

        error_log("get_ilceler called with il_id: " . $il_id);

        error_log("REQUEST METHOD: " . $_SERVER['REQUEST_METHOD']);

        error_log("REQUEST URI: " . $_SERVER['REQUEST_URI']);

        

        if (empty($il_id)) {

            $data = array('status' => 'error', 'message' => 'İl ID Bilgisi Alınamadı..!');

        } else {

            // Database sorgusu ile ilçeleri getir

            $this->db->where('il_id', $il_id);

            $this->db->order_by('ilce', 'ASC');

            $ilceler = $this->db->get('ilceler');

            

            error_log("Found " . $ilceler->num_rows() . " ilceler for il_id: " . $il_id);

            

            if ($ilceler->num_rows() > 0) {

                $ilceList = array();

                foreach ($ilceler->result() as $item) {

                    $ilceList[] = array(

                        'id' => $item->id, 

                        'ilce_adi' => $item->ilce, 

                        'ilce' => $item->ilce,

                        'il_id' => $item->il_id

                    );

                }

                $data = array('status' => 'ok', 'message' => '', 'data' => $ilceList);

            } else {

                $data = array('status' => 'error', 'message' => 'İlçe Bulunamadı..!');

            }

        }

        

        error_log("Returning result: " . json_encode($data, JSON_UNESCAPED_UNICODE));

        

        // JSON response gönder

        echo json_encode($data, JSON_UNESCAPED_UNICODE);

        exit;

    }



    /**

     * İlleri AJAX ile getir (ülke bazında)

     */

    public function get_iller($ulke_id = null)

    {

        // Header'ları ayarla

        header('Content-Type: application/json; charset=utf-8');

        header('Access-Control-Allow-Origin: *');

        header('Access-Control-Allow-Methods: GET, POST');

        header('Access-Control-Allow-Headers: Content-Type');

        

        // GET parametresi veya POST ile gelen ulke_id

        if ($ulke_id === null) {

            $ulke_id = $this->input->post('ulke_id');

        }

        

        // GET parametresinden de alabilir

        if ($ulke_id === null) {

            $ulke_id = $this->input->get('ulke_id');

        }

        

        // Debug için log ekleyelim

        error_log("get_iller called with ulke_id: " . $ulke_id);

        error_log("REQUEST METHOD: " . $_SERVER['REQUEST_METHOD']);

        error_log("REQUEST URI: " . $_SERVER['REQUEST_URI']);

        

        if (empty($ulke_id)) {

            $data = array('status' => 'error', 'message' => 'Ülke ID Bilgisi Alınamadı..!');

        } else {

            // Database sorgusu ile illeri getir

            $this->db->where('ulke_id', $ulke_id);

            $this->db->order_by('il', 'ASC');

            $iller = $this->db->get('iller');

            

            error_log("Found " . $iller->num_rows() . " iller for ulke_id: " . $ulke_id);

            

            if ($iller->num_rows() > 0) {

                $ilList = array();

                foreach ($iller->result() as $item) {

                    $ilList[] = array(

                        'id' => $item->id, 

                        'il_adi' => $item->il, 

                        'il' => $item->il,

                        'ulke_id' => $item->ulke_id

                    );

                }

                $data = array('status' => 'ok', 'message' => '', 'data' => $ilList);

            } else {

                $data = array('status' => 'error', 'message' => 'İl Bulunamadı..!');

            }

        }

        

        error_log("Returning result: " . json_encode($data, JSON_UNESCAPED_UNICODE));

        

        // JSON response gönder

        echo json_encode($data, JSON_UNESCAPED_UNICODE);

        exit;

    }



    /**

     * Talep durumu güncelle

     */

    public function durum_guncelle()

    {

        if (!grup_modul_yetkisi_var(1800)) {

            echo json_encode(['success' => false, 'message' => 'Yetkiniz yok']);

            return;

        }



        $talep_id = $this->input->post('talep_id');

        $yeni_durum = $this->input->post('yeni_durum');



        // Potansiyel_satis tablosuna yeni durum kaydı ekle

        $satis_data = [

            'potansiyel_cari_id' => $talep_id,

            'durum_id' => $yeni_durum,

            'tarih' => date('Y-m-d H:i:s'),

            'olusturan_kullanici' => $this->session->userdata('kullanici_id')

        ];

        $result = $this->vt->insert('potansiyel_satis', $satis_data);

        

        if ($result) {

            logekle(1800, 3); // Talepler modülü güncelleme log

            echo json_encode(['success' => true, 'message' => 'Durum başarıyla güncellendi']);

        } else {

            echo json_encode(['success' => false, 'message' => 'Güncelleme başarısız']);

        }

    }



    /**

     * Debug - iller tablosunun sütunlarını göster

     */

    public function debug_iller() 

    {

        if (!grup_modul_yetkisi_var(1800)) {

            redirect("home/hata");

        }

        

        $fields = $this->db->list_fields('iller');

        echo "<h3>İller Tablosu Sütunları:</h3>";

        echo "<ul>";

        foreach ($fields as $field) {

            echo "<li>" . $field . "</li>";

        }

        echo "</ul>";

        

        // Birkaç örnek kayıt göster

        $sample = $this->db->limit(5)->get('iller')->result();

        echo "<h3>Örnek Kayıtlar:</h3>";

        echo "<pre>";

        print_r($sample);

        echo "</pre>";

    }



    /**

     * Debug - İlçeler tablosunu kontrol et

     */

    public function debug_ilceler($il_id = 1)

    {

        echo "<h3>İlçeler Debug - İl ID: $il_id</h3>";

        

        // Tablo var mı kontrol et

        if ($this->db->table_exists('ilceler')) {

            echo "<p style='color:green'>✓ İlceler tablosu mevcut</p>";

        } else {

            echo "<p style='color:red'>✗ İlceler tablosu yok</p>";

            return;

        }

        

        // Tablo yapısını göster

        $fields = $this->db->list_fields('ilceler');

        echo "<p><strong>Tablo alanları:</strong> " . implode(', ', $fields) . "</p>";

        

        // İl ID'ye göre ilçeleri getir

        $this->db->where('il_id', $il_id);

        $this->db->order_by('ilce', 'ASC');

        $ilceler = $this->db->get('ilceler')->result();

        

        echo "<p><strong>İl ID $il_id için bulunan ilçe sayısı:</strong> " . count($ilceler) . "</p>";

        

        if (count($ilceler) > 0) {

            echo "<h4>İlçeler:</h4><ul>";

            foreach ($ilceler as $ilce) {

                echo "<li>ID: {$ilce->id}, İlçe: {$ilce->ilce}, İl ID: {$ilce->il_id}</li>";

            }

            echo "</ul>";

            

            // JSON formatında da göster

            $result = [];

            foreach ($ilceler as $ilce) {

                $result[] = [

                    'id' => $ilce->id,

                    'ilce_adi' => $ilce->ilce,

                    'il_id' => $ilce->il_id

                ];

            }

            echo "<h4>JSON Response:</h4>";

            echo "<pre>" . json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) . "</pre>";

        } else {

            echo "<p style='color:orange'>Bu ile ait ilçe bulunamadı</p>";

        }

        

        // Örnek iller tablosundan 5 kayıt göster

        echo "<h4>Örnek İller:</h4>";

        $sample = $this->db->limit(5)->get('iller')->result();

        foreach ($sample as $il) {

            echo "<p>İl ID: {$il->id}, İl: {$il->il}</p>";

        }

    }



    /**

     * Debug - Kullanıcının sorumluluk bölgelerini test et

     */

    public function debug_sorumluluk($user_id = null)

    {

        if (!grup_modul_yetkisi_var(1800)) {

            redirect("home/hata");

        }

        

        if (!$user_id) {

            $control2 = session("r", "login_info");

            $user_id = $control2->kullanici_id;

        }

        

        $bugun = date('Y-m-d');

        

        echo "<h3>Kullanıcı ID: $user_id için Sorumluluk Bölgesi Debug</h3>";

        echo "<p><strong>Bugünün tarihi:</strong> $bugun</p>";

        

        // Ham sorumluluk verilerini göster

        $hamVeriQ = "SELECT * FROM kullanici_sorumluluk_bolgesi WHERE kullanici = '$user_id'";

        $hamVeri = $this->db->query($hamVeriQ)->result();

        

        echo "<h4>Ham Sorumluluk Verileri:</h4>";

        echo "<table border='1' style='border-collapse: collapse;'>";

        echo "<tr><th>ID</th><th>Ülke</th><th>İl ID</th><th>İlçe ID</th><th>Durum</th><th>Başlangıç</th><th>Bitiş</th></tr>";

        foreach ($hamVeri as $veri) {

            echo "<tr>";

            echo "<td>{$veri->sorumluluk_id}</td>";

            echo "<td>{$veri->ulke_kodu}</td>";

            echo "<td>{$veri->il_id}</td>";

            echo "<td>{$veri->ilce_id}</td>";

            echo "<td>{$veri->durum}</td>";

            echo "<td>{$veri->baslangic_tarihi}</td>";

            echo "<td>{$veri->bitis_tarihi}</td>";

            echo "</tr>";

        }

        echo "</table>";

        

        // Aktif il sorumluluklarını çek

        $sorumluIllerQ = "SELECT DISTINCT il_id 

                         FROM kullanici_sorumluluk_bolgesi 

                         WHERE kullanici = '$user_id' 

                         AND durum = 1 

                         AND il_id IS NOT NULL

                         AND il_id > 0

                         AND (baslangic_tarihi IS NULL OR baslangic_tarihi <= '$bugun') 

                         AND (bitis_tarihi IS NULL OR bitis_tarihi >= '$bugun')";

        $sorumluIller = $this->db->query($sorumluIllerQ)->result();

        

        echo "<h4>Aktif İl Sorumlulukları:</h4>";

        $ilIds = [];

        foreach ($sorumluIller as $il) {

            $ilIds[] = $il->il_id;

        }

        echo "<p><strong>İl ID'leri:</strong> " . implode(', ', $ilIds) . "</p>";

        

        // İl isimlerini getir

        if (!empty($ilIds)) {

            $this->db->where_in('id', $ilIds);

            $iller = $this->db->get('iller')->result();

            echo "<ul>";

            foreach ($iller as $il) {

                echo "<li>ID: {$il->id}, İl: {$il->il}</li>";

            }

            echo "</ul>";

        }

        

        // Aktif ilçe sorumluluklarını çek

        $sorumluIlcelerQ = "SELECT DISTINCT ilce_id 

                           FROM kullanici_sorumluluk_bolgesi 

                           WHERE kullanici = '$user_id' 

                           AND durum = 1 

                           AND ilce_id IS NOT NULL

                           AND ilce_id > 0

                           AND (baslangic_tarihi IS NULL OR baslangic_tarihi <= '$bugun') 

                           AND (bitis_tarihi IS NULL OR bitis_tarihi >= '$bugun')";

        $sorumluIlceler = $this->db->query($sorumluIlcelerQ)->result();

        

        echo "<h4>Aktif İlçe Sorumlulukları:</h4>";

        $ilceIds = [];

        foreach ($sorumluIlceler as $ilce) {

            $ilceIds[] = $ilce->ilce_id;

        }

        echo "<p><strong>İlçe ID'leri:</strong> " . implode(', ', $ilceIds) . "</p>";

        

        // Test sorgusu - bu kullanıcının görebileceği talep sayısı

        echo "<h4>Test Filtreleme:</h4>";

        if (!empty($ilIds) || !empty($ilceIds)) {

            $this->db->select('COUNT(*) as toplam');

            $this->db->from('potansiyel_cari pc');

            $this->db->where('pc.potansitel_talep', 1);

            

            $this->db->group_start();

            if (!empty($ilIds)) {

                $this->db->or_where_in('pc.potansiyel_il_id', $ilIds);

            }

            if (!empty($ilceIds)) {

                $this->db->or_where_in('pc.potansiyel_ilce_id', $ilceIds);

            }

            $this->db->group_end();

            

            $sonuc = $this->db->get()->row();

            echo "<p><strong>Bu kullanıcının görebileceği talep sayısı:</strong> {$sonuc->toplam}</p>";

        } else {

            echo "<p style='color:red;'><strong>Bu kullanıcının hiç aktif sorumluluk bölgesi yok!</strong></p>";

        }

    }



    /**

     * Debug - Kullanıcının modül yetkilerini kontrol et

     */

    public function debug_yetkiler($user_id = null)

    {

        if (!$user_id) {

            $control2 = session("r", "login_info");

            $user_id = $control2->kullanici_id;

        }

        

        echo "<h3>Kullanıcı ID: $user_id için Modül Yetkileri Debug</h3>";

        

        // 1800 ve 1810 modül yetkilerini kontrol et

        $yetki1800 = grup_modul_yetkisi_var(1800);

        $yetki1810 = grup_modul_yetkisi_var(1810);

        

        echo "<p><strong>1800 (Talepler Listesi) Yetkisi:</strong> " . ($yetki1800 ? "VAR" : "YOK") . "</p>";

        echo "<p><strong>1810 (Teklif Ekleme) Yetkisi:</strong> " . ($yetki1810 ? "VAR" : "YOK") . "</p>";

        

        // Kullanıcının tüm grup yetkilerini göster

        $control2 = session("r", "login_info");

        echo "<h4>Session Bilgileri:</h4>";

        echo "<pre>";

        print_r($control2);

        echo "</pre>";

        

        // Grup modül yetkilerini direkt sorgudan kontrol et

        if (function_exists('grup_modul_yetkisi_var')) {

            echo "<h4>grup_modul_yetkisi_var Fonksiyonu Mevcut</h4>";

        } else {

            echo "<h4 style='color:red;'>grup_modul_yetkisi_var Fonksiyonu Bulunamadı!</h4>";

        }

    }



    /**

     * Talep düzenle

     */

    public function talep_duzenle($id)

    {

        if (!grup_modul_yetkisi_var(1810)) {

            redirect("home/hata");

        }



        $data["baslik"] = "Talep Düzenle";

        

        // Kullanıcı bilgilerini al

        $control2 = session("r", "login_info");

        $data["kullanici"] = $control2;

        

        // Mevcut talep bilgilerini getir

        $this->db->select('tc.*');

        $this->db->from('potansiyel_cari tc');

        $this->db->where('tc.id', $id);

        $query = $this->db->get();

        $data["talep"] = $query->row();

        

        if (!$data["talep"]) {

            $this->session->set_flashdata('hata', 'Talep bulunamadı.');

            redirect('talepler/talepler-listesi');

        }

        

        // Dropdown verileri

        $data["talep_kaynaklari"] = $this->vt->multiple('talep_kaynaklari', [], 'talep_kaynaklari_adi ASC');

        $data["talep_durumlari"] = $this->vt->multiple('talep_durumlari', ['talep_durumlari_durum' => 1], 'talep_durumlari_adi ASC');

        $data["sektorler"] = $this->vt->multiple('sektorler', [], 'sektor_adi ASC');

        $data["ulkeler"] = $this->vt->multiple('ulkeler', [], 'ulke_adi ASC');

        $data["iller"] = $this->vt->multiple('iller', ['ulke_id' => 3], 'il ASC');

        

        // Seçili ile ait ilçeleri getir

        if ($data["talep"]->potansiyel_il_id) {

            $data["ilceler"] = $this->vt->multiple('ilceler', ['il_id' => $data["talep"]->potansiyel_il_id], 'ilce ASC');

        } else {

            $data["ilceler"] = [];

        }

        

        // Edit mode flag

        $data["edit_mode"] = true;

        $data["talep_id"] = $id;



        $this->load->view("talepler/talep-olustur", $data);

    }



    /**

     * Potansiyel satış (teklif) ekleme

     */

    public function potansiyel_satis_ekle()

    {

        // Debug için log

        error_log("potansiyel_satis_ekle metodu çağrıldı");

        error_log("HTTP Method: " . $_SERVER['REQUEST_METHOD']);

        error_log("POST data: " . print_r($_POST, true));

        

        // Geçici olarak yetki kontrolünü devre dışı bırak

        // if (!grup_modul_yetkisi_var(1810)) {

        //     error_log("Yetki hatası");

        //     redirect("home/hata");

        // }



        if ($this->input->method() == 'post') {

            error_log("POST metodu ile gelen veri işleniyor");

            

            $potansiyel_cari_id = $this->input->post('potansiyel_cari_id');

            $durum_id = $this->input->post('durum_id');

            $fiyat1 = $this->input->post('fiyat1');

            $fiyat2 = $this->input->post('fiyat2');

            $fiyat3 = $this->input->post('fiyat3');

            $aciklama = $this->input->post('aciklama');



            error_log("Potansiyel cari ID: " . $potansiyel_cari_id);

            error_log("Durum ID: " . $durum_id);



            // Kullanıcı bilgilerini al

            $control2 = session("r", "login_info");

            $u_id = $control2->kullanici_id;

            $bugun = date('Y-m-d');



            // Önce potansiyel cari kaydının mevcut olduğunu ve kullanıcının bu bölgede yetkili olduğunu kontrol et

            $this->db->select('pc.*, u.ulke_adi, il.il as il_adi, ilce.ilce as ilce_adi');

            $this->db->from('potansiyel_cari pc');

            $this->db->join('ulkeler u', 'pc.potansiyel_ulke_id = u.id', 'left');

            $this->db->join('iller il', 'pc.potansiyel_il_id = il.id', 'left');

            $this->db->join('ilceler ilce', 'pc.potansiyel_ilce_id = ilce.id', 'left');

            $this->db->where('pc.id', $potansiyel_cari_id);

            $this->db->where('pc.potansitel_talep', 1);

            $potansiyel_cari = $this->db->get()->row();



            if (!$potansiyel_cari) {

                error_log("Potansiyel cari bulunamadı");

                $this->session->set_flashdata('error', 'Geçersiz talep ID.');

                redirect('talepler/talepler-listesi');

                return;

            }



            error_log("Potansiyel cari bulundu: " . $potansiyel_cari->potansiyel_cari_ad);



            // Kullanıcının bu bölgede yetkili olup olmadığını kontrol et

            $yetkiVarMi = false;

            

            // İl bazlı yetki kontrolü

            if ($potansiyel_cari->potansiyel_il_id) {

                $ilYetkiQ = "SELECT COUNT(*) as sayac 

                            FROM kullanici_sorumluluk_bolgesi 

                            WHERE kullanici = '$u_id' 

                            AND durum = 1 

                            AND il_id = '{$potansiyel_cari->potansiyel_il_id}'

                            AND (baslangic_tarihi IS NULL OR baslangic_tarihi <= '$bugun') 

                            AND (bitis_tarihi IS NULL OR bitis_tarihi >= '$bugun')";

                $ilYetki = $this->db->query($ilYetkiQ)->row();

                if ($ilYetki->sayac > 0) {

                    $yetkiVarMi = true;

                }

            }

            

            // İlçe bazlı yetki kontrolü

            if (!$yetkiVarMi && $potansiyel_cari->potansiyel_ilce_id) {

                $ilceYetkiQ = "SELECT COUNT(*) as sayac 

                              FROM kullanici_sorumluluk_bolgesi 

                              WHERE kullanici = '$u_id' 

                              AND durum = 1 

                              AND ilce_id = '{$potansiyel_cari->potansiyel_ilce_id}'

                              AND (baslangic_tarihi IS NULL OR baslangic_tarihi <= '$bugun') 

                              AND (bitis_tarihi IS NULL OR bitis_tarihi >= '$bugun')";

                $ilceYetki = $this->db->query($ilceYetkiQ)->row();

                if ($ilceYetki->sayac > 0) {

                    $yetkiVarMi = true;

                }

            }



            if (!$yetkiVarMi) {

                error_log("Yetki yok");

                $this->session->set_flashdata('error', 'Bu bölgede teklif ekleme yetkiniz bulunmamaktadır.');

                redirect('talepler/talepler-listesi');

                return;

            }



            // Fiyat alanlarını formatla (virgülü noktaya çevir)

            $fiyat1 = !empty($fiyat1) ? str_replace(',', '.', str_replace('.', '', $fiyat1)) : null;

            $fiyat2 = !empty($fiyat2) ? str_replace(',', '.', str_replace('.', '', $fiyat2)) : null;

            $fiyat3 = !empty($fiyat3) ? str_replace(',', '.', str_replace('.', '', $fiyat3)) : null;



            $data = array(

                'potansiyel_cari_id' => $potansiyel_cari_id,

                'durum_id' => $durum_id,

                'fiyat1' => $fiyat1,

                'fiyat2' => $fiyat2,

                'fiyat3' => $fiyat3,

                'aciklama' => $aciklama,

                'islemi_yapan' => $u_id,

                'islem_tarihi' => date('Y-m-d H:i:s')

            );



            error_log("Veritabanına eklenecek veri: " . print_r($data, true));



            $result = $this->db->insert('potansiyel_satis', $data);



            if ($result) {

                error_log("Teklif başarıyla eklendi");

                $this->session->set_flashdata('success', 'Teklif başarıyla eklendi.');

            } else {

                error_log("Teklif eklenirken hata oluştu");

                $this->session->set_flashdata('error', 'Teklif eklenirken bir hata oluştu.');

            }



            redirect('talepler/talepler-listesi');

        } else {

            error_log("POST metodu değil, redirect yapılıyor");

            redirect('talepler/talepler-listesi');

        }

    }



    /**

     * Telefon numarasını standart formata çevir (05xxxxxxxxx)

     */

    private function format_phone_number($phone)

    {

        if (empty($phone)) {

            return $phone;

        }

        

        // Sadece rakamları al

        $phone = preg_replace('/[^0-9]/', '', $phone);

        

        // Boş ise geri döndür

        if (empty($phone)) {

            return $phone;

        }

        

        // Türkiye telefon formatına çevir

        if (strlen($phone) == 10 && substr($phone, 0, 1) == '5') {

            // 5xxxxxxxxx -> 05xxxxxxxxx

            return '0' . $phone;

        } elseif (strlen($phone) == 11 && substr($phone, 0, 2) == '05') {

            // 05xxxxxxxxx -> 05xxxxxxxxx (zaten doğru format)

            return $phone;

        } elseif (strlen($phone) == 12 && substr($phone, 0, 3) == '905') {

            // 905xxxxxxxxx -> 05xxxxxxxxx

            return '0' . substr($phone, 2);

        } elseif (strlen($phone) == 13 && substr($phone, 0, 4) == '+905') {

            // +905xxxxxxxxx -> 05xxxxxxxxx

            return '0' . substr($phone, 3);

        }

        

        // Diğer durumlar için olduğu gibi döndür

        return $phone;

    }



    /**

     * Potansiyel müşteri için teklifleri getir (AJAX)

     */

    public function get_teklifler()

    {

        // JSON response için header ayarla

        header('Content-Type: application/json; charset=utf-8');

        

        $cari_id = $this->input->get('cari_id');

        

        if (empty($cari_id)) {

            echo json_encode(['success' => false, 'message' => 'Geçersiz müşteri ID']);

            return;

        }

        

        try {

            // Potansiyel satış tablosundan teklifleri getir

            $this->db->select('ps.*, pd.Durum_Adi, ps.islem_tarihi as tarih');

            $this->db->from('potansiyel_satis ps');

            $this->db->join('potansiyel_durumlar pd', 'ps.durum_id = pd.id', 'left');

            $this->db->where('ps.potansiyel_cari_id', $cari_id);

            $this->db->order_by('ps.id', 'DESC');

            

            $query = $this->db->get();

            $teklifler = $query->result();

            

            // Sonuçları formatla

            $formatted_teklifler = array();

            foreach ($teklifler as $teklif) {

                $formatted_teklifler[] = array(

                    'id' => $teklif->id,

                    'tarih' => date('d.m.Y H:i', strtotime($teklif->tarih)),

                    'durum' => $teklif->Durum_Adi ?: 'Belirtilmemiş',

                    'fiyat1' => $teklif->fiyat1 ? number_format($teklif->fiyat1, 2, ',', '.') . ' ₺' : null,

                    'fiyat2' => $teklif->fiyat2 ? number_format($teklif->fiyat2, 2, ',', '.') . ' ₺' : null,

                    'fiyat3' => $teklif->fiyat3 ? number_format($teklif->fiyat3, 2, ',', '.') . ' ₺' : null,

                    'aciklama' => $teklif->aciklama

                );

            }

            

            echo json_encode([

                'success' => true,

                'teklifler' => $formatted_teklifler,

                'total' => count($formatted_teklifler)

            ], JSON_UNESCAPED_UNICODE);

            

        } catch (Exception $e) {

            echo json_encode(['success' => false, 'message' => 'Veriler alınırken hata oluştu: ' . $e->getMessage()]);

        }

    }



    /**

     * Otomatik destek talebi oluşturma (mobil upload hataları için)

     */

    public function otomatik_talep_olustur()

    {

        try {

            // POST verilerini al

            $error_type = $this->input->post('error_type');

            $user_agent = $this->input->post('user_agent');

            $screen_resolution = $this->input->post('screen_resolution');

            $viewport_size = $this->input->post('viewport_size');

            $url = $this->input->post('url');

            $timestamp = $this->input->post('timestamp');

            $browser_info = $this->input->post('browser_info');

            $device_info = $this->input->post('device_info');

            $error_details = $this->input->post('error_details');

            

            // Kullanıcı bilgilerini al

            $control = session("r", "login_info");

            $kullanici_id = $control->kullanici_id;

            $kullanici_adi = $control->kullanici_adi;

            $firma_id = $control->firma_id;

            

            // Talep başlığı ve açıklaması oluştur

            $baslik = "Otomatik Destek Talebi - " . ($error_type == 'ERR_FILE_ACCESS' ? 'Dosya Erişim Hatası' : 'Mobil Dosya Yükleme Hatası');

            $aciklama = "Bu talep otomatik olarak oluşturulmuştur.\n\n";

            $aciklama .= "**Hata Türü:** " . $error_type . "\n";

            $aciklama .= "**Kullanıcı:** " . $kullanici_adi . "\n";

            $aciklama .= "**Sayfa:** " . $url . "\n";

            $aciklama .= "**Zaman:** " . $timestamp . "\n\n";

            $aciklama .= "**Teknik Bilgiler:**\n";

            $aciklama .= "- Tarayıcı: " . $browser_info . "\n";

            $aciklama .= "- User Agent: " . $user_agent . "\n";

            $aciklama .= "- Ekran Çözünürlüğü: " . $screen_resolution . "\n";

            $aciklama .= "- Viewport Boyutu: " . $viewport_size . "\n";

            $aciklama .= "- Cihaz Bilgisi: " . $device_info . "\n\n";

            $aciklama .= "**Hata Detayları:**\n" . $error_details . "\n\n";

            $aciklama .= "**Önerilen Çözümler:**\n";

            $aciklama .= "- Dosyayı tekrar seçmek\n";

            $aciklama .= "- Tarayıcıyı yeniden başlatmak\n";

            $aciklama .= "- Farklı dosya formatı denemek\n";

            $aciklama .= "- Dosya boyutunu küçültmek\n";

            

            // Destek talebi verisini hazırla (mevcut tablo yapısına uygun)

            $destek_data = array(

                'destek_title' => $baslik,

                'destek_priority' => 2, // Orta öncelik

                'destek_department' => 1, // Teknik departman

                'destek_status' => 1, // Açık

                'destek_date' => date('Y-m-d H:i:s'),

                'destek_lastUpdateDate' => date('Y-m-d H:i:s'),

                'destek_ip' => $this->input->ip_address(),

                'destek_olusturan' => $kullanici_id,

                'destek_olusturanAnaHesap' => $firma_id,

                'destek_isRead' => 0

                // Not: Yeni alanlar veritabanına eklendikten sonra aşağıdaki satırlar açılacak

                /*

                'destek_otomatik_olusturuldu' => 1,

                'destek_hata_turu' => $error_type,

                'destek_user_agent' => $user_agent,

                'destek_screen_resolution' => $screen_resolution,

                'destek_viewport_size' => $viewport_size,

                'destek_browser_info' => $browser_info,

                'destek_device_info' => $device_info,

                'destek_url' => $url,

                'destek_error_timestamp' => date('Y-m-d H:i:s', strtotime($timestamp)),

                'destek_teknik_detay' => $error_details

                */

            );

            

            // Destek talebini veritabanına ekle

            $this->db->insert('destek', $destek_data);

            $destek_id = $this->db->insert_id();

            

            if ($destek_id) {

                // Destek yanıtı ekle (otomatik mesaj)

                $yanit_data = array(

                    'destek_id' => $destek_id,

                    'destek_mesaj' => $aciklama,

                    'destek_mesaj_tarih' => date('Y-m-d H:i:s'),

                    'destek_mesaj_olusturan' => $kullanici_id,

                    'destek_mesaj_olusturanAnaHesap' => $firma_id,

                    'destek_mesaj_tipi' => 'otomatik'

                );

                $this->db->insert('destek_yanit', $yanit_data);

                

                // Başarılı response

                echo json_encode([

                    'success' => true,

                    'ticket_id' => $destek_id,

                    'message' => 'Otomatik destek talebi oluşturuldu'

                ]);

                

                // Destek ekibine bildirim gönder (opsiyonel)

                $this->_send_auto_ticket_notification($destek_id, $kullanici_adi, $error_type);

                

            } else {

                echo json_encode([

                    'success' => false,

                    'message' => 'Destek talebi oluşturulurken hata oluştu'

                ]);

            }

            

        } catch (Exception $e) {

            echo json_encode([

                'success' => false,

                'message' => 'Sistem hatası: ' . $e->getMessage()

            ]);

        }

    }

    

    /**

     * Otomatik talep için destek ekibine bildirim

     */

    private function _send_auto_ticket_notification($talep_id, $kullanici_adi, $error_type)

    {

        try {

            // Destek ekibi e-posta adresleri (config'den alınabilir)

            $destek_emails = ['destek@ilekasoft.com', 'teknik@ilekasoft.com'];

            

            // Kullanıcı bilgilerini al

            $control2 = session("r", "login_info");

            $kullanici = $control2 ? $control2 : null;

            

            // Talep detaylarını al

            $talep_detay = $this->db->query("SELECT pc.*, s.sektor_adi, il.il as il_adi, ilce.ilce as ilce_adi 

                                           FROM potansiyel_cari pc 

                                           LEFT JOIN sektorler s ON pc.sektor_id = s.sektor_id 

                                           LEFT JOIN iller il ON pc.potansiyel_il_id = il.id 

                                           LEFT JOIN ilceler ilce ON pc.potansiyel_ilce_id = ilce.id 

                                           WHERE pc.id = $talep_id")->row();

            

            $konu = "🎫 İlekaSoft CRM - Yeni Otomatik Destek Talebi #" . $talep_id . " - " . $error_type;

            

            // HTML mail içeriği

            $mesaj = '

<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <style>

        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; }

        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }

        .header { background-color: #dc3545; color: white; padding: 20px; text-align: center; }

        .content { padding: 30px; }

        .info-box { background-color: #f8f9fa; border-left: 4px solid #dc3545; padding: 15px; margin: 15px 0; }

        .warning-box { background-color: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; margin: 15px 0; }

        .btn { display: inline-block; padding: 12px 24px; background-color: #dc3545; color: white; text-decoration: none; border-radius: 4px; margin: 15px 0; }

        .footer { background-color: #6c757d; color: white; padding: 15px; text-align: center; font-size: 12px; }

    </style>

</head>

<body>

    <div class="container">

        <div class="header">

            <h2>⚠️ Otomatik Destek Talebi Oluşturuldu</h2>

        </div>

        <div class="content">

            <p>Merhaba,</p>

            <p>Sistemde otomatik olarak yeni bir destek talebi oluşturuldu. Bu talep sistem hatası nedeniyle otomatik olarak açılmıştır.</p>

            

            <div class="warning-box">

                <h4>⚠️ Hata Türü</h4>

                <p><strong>' . htmlspecialchars($error_type) . '</strong></p>

            </div>

            

            <div class="info-box">

                <h4>📋 Talep Bilgileri</h4>

                <p><strong>Talep ID:</strong> #' . $talep_id . '</p>

                <p><strong>Kullanıcı:</strong> ' . htmlspecialchars($kullanici_adi) . '</p>';

                

            if ($kullanici) {

                $mesaj .= '<p><strong>Kullanıcı E-posta:</strong> ' . htmlspecialchars($kullanici->kullanici_eposta ?? 'Bilinmiyor') . '</p>';

                $mesaj .= '<p><strong>Kullanici ID:</strong> ' . ($kullanici->kullanici_id ?? 'Bilinmiyor') . '</p>';

            }

            

            $mesaj .= '<p><strong>Oluşturma Tarihi:</strong> ' . date('d.m.Y H:i:s') . '</p>

            </div>';

            

            if ($talep_detay) {

                $mesaj .= '

                <div class="info-box">

                    <h4>👤 Potansiyel Müşteri Bilgileri</h4>

                    <p><strong>Müşteri Adı:</strong> ' . htmlspecialchars($talep_detay->potansiyel_cari_ad ?? 'Bilinmiyor') . '</p>

                    <p><strong>Telefon:</strong> ' . htmlspecialchars($talep_detay->potansiyel_cari_firmaTelefon ?? 'Bilinmiyor') . '</p>

                    <p><strong>Sektör:</strong> ' . htmlspecialchars($talep_detay->sektor_adi ?? 'Bilinmiyor') . '</p>

                    <p><strong>Konum:</strong> ' . htmlspecialchars($talep_detay->il_adi ?? 'Bilinmiyor') . 

                    ($talep_detay->ilce_adi ? ' / ' . htmlspecialchars($talep_detay->ilce_adi) : '') . '</p>

                    <p><strong>Adres:</strong> ' . htmlspecialchars(substr($talep_detay->potansiyel_cari_adres ?? 'Bilinmiyor', 0, 100)) . 

                    (strlen($talep_detay->potansiyel_cari_adres ?? '') > 100 ? '...' : '') . '</p>

                </div>';

            }

            

            $mesaj .= '

            <p>Bu otomatik talep acil olarak incelenmeli ve gerekli teknik müdahale yapılmalıdır.</p>

            

            <a href="https://crm.ilekasoft.com/talepler/talep-detay/' . $talep_id . '" class="btn">🔗 Talebi Görüntüle</a>

        </div>

        <div class="footer">

            <p>Bu e-posta İlekaSoft CRM sistemi tarafından otomatik olarak gönderilmiştir.</p>

            <p>' . date('Y') . ' © İlekaSoft - Tüm hakları saklıdır.</p>

        </div>

    </div>

</body>

</html>';

            

            // E-posta gönderimi (mevcut mail konfigürasyonu kullanılabilir)

            foreach ($destek_emails as $email) {

                // CI'ın email library'si kullan

                $mail_config = Array(

                    'protocol' => 'smtp',

                    'smtp_crypto' => 'ssl',

                    'smtp_host' => 'mail.ilekasoft.com',

                    'smtp_port' => 465,

                    'smtp_user' => 'ticket@ilekasoft.com',

                    'smtp_pass' => '0oqZknrfOw',

                    'charset'   => 'utf-8',

                    'mailtype'  => 'html',

                    'wordwrap' => TRUE

                );

                

                $this->load->library('email', $mail_config);

                $this->email->clear();

                $this->email->set_newline("\r\n");

                $this->email->to($email);

                $this->email->from("ticket@ilekasoft.com", "İlekaSoft CRM Sistemi");

                $this->email->subject($konu);

                $this->email->message($mesaj);

                

                if (!$this->email->send()) {

                    log_message('error', 'Otomatik talep mail gönderimi başarısız: ' . $this->email->print_debugger());

                }

            }

            

        } catch (Exception $e) {

            // Bildirim hatası önemli değil, loglama yapılabilir

            log_message('error', 'Auto ticket notification failed: ' . $e->getMessage());

        }

    }



    /**

     * Yeni talep için admin'e bildirim gönder

     */

    private function _send_new_talep_notification($talep_id, $talep_data)

    {

        try {

            // Admin e-posta adresleri

            $admin_emails = ['destek@ilekasoft.com', 'teknik@ilekasoft.com'];

            

            // Kullanıcı bilgilerini al

            $control2 = session("r", "login_info");

            $kullanici = $control2 ? $control2 : null;

            

            // Sektör, il, ilçe bilgilerini al

            $sektor_adi = 'Bilinmiyor';

            $il_adi = 'Bilinmiyor';

            $ilce_adi = 'Bilinmiyor';

            

            if (!empty($talep_data['sektor_id'])) {

                $sektor = $this->db->query("SELECT sektor_adi FROM sektorler WHERE sektor_id = " . $talep_data['sektor_id'])->row();

                if ($sektor) $sektor_adi = $sektor->sektor_adi;

            }

            

            if (!empty($talep_data['potansiyel_il_id'])) {

                $il = $this->db->query("SELECT il FROM iller WHERE id = " . $talep_data['potansiyel_il_id'])->row();

                if ($il) $il_adi = $il->il;

            }

            

            if (!empty($talep_data['potansiyel_ilce_id'])) {

                $ilce = $this->db->query("SELECT ilce FROM ilceler WHERE id = " . $talep_data['potansiyel_ilce_id'])->row();

                if ($ilce) $ilce_adi = $ilce->ilce;

            }

            

            $konu = "🎯 İlekaSoft CRM - Yeni Potansiyel Müşteri Talebi #" . $talep_id;

            

            // HTML mail içeriği

            $mesaj = '

<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <style>

        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f4f4f4; }

        .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }

        .header { background-color: #28a745; color: white; padding: 20px; text-align: center; }

        .content { padding: 30px; }

        .info-box { background-color: #f8f9fa; border-left: 4px solid #28a745; padding: 15px; margin: 15px 0; }

        .customer-box { background-color: #e3f2fd; border-left: 4px solid #2196f3; padding: 15px; margin: 15px 0; }

        .btn { display: inline-block; padding: 12px 24px; background-color: #28a745; color: white; text-decoration: none; border-radius: 4px; margin: 15px 0; }

        .footer { background-color: #6c757d; color: white; padding: 15px; text-align: center; font-size: 12px; }

        .highlight { background-color: #fff3cd; padding: 10px; border-radius: 4px; margin: 10px 0; }

    </style>

</head>

<body>

    <div class="container">

        <div class="header">

            <h2>🎯 Yeni Potansiyel Müşteri Talebi</h2>

        </div>

        <div class="content">

            <p>Merhaba,</p>

            <p>Sistemde yeni bir potansiyel müşteri talebi oluşturuldu. Bu fırsat değerlendirilmelidir!</p>

            

            <div class="info-box">

                <h4>📋 Talep Bilgileri</h4>

                <p><strong>Talep ID:</strong> #' . $talep_id . '</p>';

                

            if ($kullanici) {

                $mesaj .= '<p><strong>Oluşturan Kullanıcı:</strong> ' . htmlspecialchars($kullanici->kullanici_ad . ' ' . $kullanici->kullanici_soyad) . '</p>';

                $mesaj .= '<p><strong>Kullanıcı E-posta:</strong> ' . htmlspecialchars($kullanici->kullanici_eposta ?? 'Bilinmiyor') . '</p>';

            }

            

            $mesaj .= '<p><strong>Oluşturma Tarihi:</strong> ' . date('d.m.Y H:i:s') . '</p>

            </div>

            

            <div class="customer-box">

                <h4>👤 Potansiyel Müşteri Bilgileri</h4>

                <p><strong>Müşteri/Firma Adı:</strong> ' . htmlspecialchars($talep_data['potansiyel_cari_ad'] ?? 'Bilinmiyor') . '</p>

                <p><strong>Telefon:</strong> ' . htmlspecialchars($talep_data['potansiyel_cari_firmaTelefon'] ?? 'Bilinmiyor') . '</p>

                <p><strong>Sektör:</strong> ' . htmlspecialchars($sektor_adi) . '</p>

                <p><strong>Konum:</strong> ' . htmlspecialchars($il_adi) . 

                ($ilce_adi !== 'Bilinmiyor' ? ' / ' . htmlspecialchars($ilce_adi) : '') . '</p>';

                

            if (!empty($talep_data['potansiyel_mahalle'])) {

                $mesaj .= '<p><strong>Mahalle:</strong> ' . htmlspecialchars($talep_data['potansiyel_mahalle']) . '</p>';

            }

            

            if (!empty($talep_data['potansiyel_cari_adres'])) {

                $mesaj .= '<p><strong>Adres:</strong> ' . htmlspecialchars($talep_data['potansiyel_cari_adres']) . '</p>';

            }

            

            $mesaj .= '

            </div>

            

            <div class="highlight">

                <h4>⚡ Hızlı İşlem Gerekli</h4>

                <p>Bu potansiyel müşteri ile en kısa sürede iletişime geçilmesi önerilir. Fırsatın kaçırılmaması için gerekli takip işlemlerini başlatın.</p>

            </div>

            

            <p>Detaylı bilgi için CRM panelini kontrol edin ve gerekli işlemleri yapın.</p>

            

            <a href="https://crm.ilekasoft.com/talepler/talep-detay/' . $talep_id . '" class="btn">🔗 Talebi Görüntüle ve İşle</a>

        </div>

        <div class="footer">

            <p>Bu e-posta İlekaSoft CRM sistemi tarafından otomatik olarak gönderilmiştir.</p>

            <p>' . date('Y') . ' © İlekaSoft - Tüm hakları saklıdır.</p>

        </div>

    </div>

</body>

</html>';

            

            // E-posta gönderimi

            foreach ($admin_emails as $email) {

                $mail_config = Array(

                    'protocol' => 'smtp',

                    'smtp_crypto' => 'ssl',

                    'smtp_host' => 'mail.ilekasoft.com',

                    'smtp_port' => 465,

                    'smtp_user' => 'ticket@ilekasoft.com',

                    'smtp_pass' => '0oqZknrfOw',

                    'charset'   => 'utf-8',

                    'mailtype'  => 'html',

                    'wordwrap' => TRUE

                );

                

                $this->load->library('email', $mail_config);

                $this->email->clear();

                $this->email->set_newline("\r\n");

                $this->email->to($email);

                $this->email->from("ticket@ilekasoft.com", "İlekaSoft CRM Sistemi");

                $this->email->subject($konu);

                $this->email->message($mesaj);

                

                if (!$this->email->send()) {

                    log_message('error', 'Yeni talep mail gönderimi başarısız: ' . $this->email->print_debugger());

                }

            }

            

        } catch (Exception $e) {

            log_message('error', 'New talep notification failed: ' . $e->getMessage());

        }

    }



    // ...existing code...

}

?>

