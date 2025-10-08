<?php
// require_once satırı kaldırıldı, CodeIgniter kendi çekirdeğini otomatik yükler
class Teklif extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('vt');
    }
    
    // AJAX: potansiyel_cari filtreli liste
    public function potansiyelCariFiltrele() {
        $filters = $this->input->post();
        
        // Debug: Log incoming filters
        log_message('debug', 'potansiyelCariFiltrele - Filters: ' . json_encode($filters));
        
        // Kullanıcının sorumluluk bölgesi kontrolü
        $control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id ?? null;
        $bugun = date('Y-m-d');
        
        // Kullanıcının sorumlu olduğu ülke ve illeri çek
        $sorumluUlkeIds = array();
        $sorumluIlIds = array();
        
        if ($u_id) {
            // Ülke sorumluluklarını çek
            $sorumluUlkelerQ = "SELECT DISTINCT ulke_kodu 
                               FROM kullanici_sorumluluk_bolgesi 
                               WHERE kullanici = '$u_id' 
                               AND durum = 1 
                               AND ulke_kodu IS NOT NULL
                               AND (baslangic_tarihi IS NULL OR baslangic_tarihi <= '$bugun') 
                               AND (bitis_tarihi IS NULL OR bitis_tarihi >= '$bugun')";
            $sorumluUlkeler = $this->db->query($sorumluUlkelerQ)->result();
            
            foreach ($sorumluUlkeler as $ulke) {
                $sorumluUlkeIds[] = $ulke->ulke_kodu;
            }
            
            // İl sorumluluklarını çek
            $sorumluIllerQ = "SELECT DISTINCT il_id 
                             FROM kullanici_sorumluluk_bolgesi 
                             WHERE kullanici = '$u_id' 
                             AND durum = 1 
                             AND il_id IS NOT NULL
                             AND (baslangic_tarihi IS NULL OR baslangic_tarihi <= '$bugun') 
                             AND (bitis_tarihi IS NULL OR bitis_tarihi >= '$bugun')";
            $sorumluIller = $this->db->query($sorumluIllerQ)->result();
            
            foreach ($sorumluIller as $il) {
                $sorumluIlIds[] = $il->il_id;
            }
        }
        
        $this->db->from('potansiyel_cari');
          // Sorumluluk bölgesi kısıtlaması - sadece sorumlu olduğu il/ülkelerdeki kayıtları getir
        if (count($sorumluIlIds) > 0) {
            $this->db->where_in('potansiyel_il_id', $sorumluIlIds);
        } else {
            // Eğer hiç sorumluluk tanımlanmamışsa tüm kayıtları göster (veya admin yetkisi kontrolü yapılabilir)
            // $this->db->where('1 = 0'); // Bu satırı kaldırıyoruz
            log_message('debug', 'Kullanıcının hiç sorumluluk bölgesi tanımlanmamış, tüm kayıtları gösteriliyor');
        }
        
        // Diğer filtreler
        if (!empty($filters['sezon'])) {
            $this->db->where('sezon_id', $filters['sezon']);
        }
        if (!empty($filters['cari_grup'])) {
            $this->db->where('potansiyel_cari_grup', $filters['cari_grup']);
        }
        if (!empty($filters['sektor'])) {
            $this->db->where('sektor_id', $filters['sektor']);
        }
        if (!empty($filters['il'])) {
            $this->db->where('potansiyel_il_id', $filters['il']);
        }
        if (!empty($filters['ilce'])) {
            $this->db->where('potansiyel_ilce_id', $filters['ilce']);
        }
        if (!empty($filters['mahalle'])) {
            $this->db->where('potansiyel_mahalle', $filters['mahalle']);
        }        if (!empty($filters['potansiyel_cari_firmaTelefon'])) {
            $searchTerm = $filters['potansiyel_cari_firmaTelefon'];
            $this->db->group_start();
            $this->db->like('potansiyel_cari_firmaTelefon', $searchTerm);
            $this->db->or_like('potansiyel_cari_ad', $searchTerm);
            $this->db->group_end();
        }
        $result = $this->db->get()->result();
        
        // Debug: Log result count
        log_message('debug', 'potansiyelCariFiltrele - Result count: ' . count($result));
        
        $data = array();
        foreach($result as $row) {
            // Sezon adı
            $sezon_adi = '';
            if ($row->sezon_id) {
                $sezon = $this->db->get_where('sezonlar', ['sezon_id' => $row->sezon_id])->row();
                $sezon_adi = $sezon ? $sezon->sezon_adi : '';
            }
            // Sektör adı
            $sektor_adi = '';
            if ($row->sektor_id) {
                $sektor = $this->db->get_where('sektorler', ['sektor_id' => $row->sektor_id])->row();
                $sektor_adi = $sektor ? $sektor->sektor_adi : '';
            }
            // İl adı
            $il_adi = '';
            if ($row->potansiyel_il_id) {
                $il = $this->db->get_where('iller', ['id' => $row->potansiyel_il_id])->row();
                $il_adi = $il ? $il->il : '';
            }
            // İlçe adı
            $ilce_adi = '';
            if ($row->potansiyel_ilce_id) {
                $ilce = $this->db->get_where('ilceler', ['id' => $row->potansiyel_ilce_id])->row();
                $ilce_adi = $ilce ? $ilce->ilce : '';
            }
            $data[] = array_merge((array)$row, [
                'sezon_adi' => $sezon_adi,
                'sektor_adi' => $sektor_adi,
                'il_adi' => $il_adi,
                'ilce_adi' => $ilce_adi
            ]);
        }
        echo json_encode([
            'status' => 'success',
            'data' => $data
        ]);
    }

    // Teklif Hazırla sayfası
    public function teklif_hazirla() {
        // Gerekli verileri view'e gönder
        $this->load->database();
        $data = array();
        $data['sezonlar'] = $this->db->get('sezonlar')->result();
        $data['cariGruplar'] = $this->db->select('potansiyel_cari_grup')->distinct()->from('potansiyel_cari')->where('potansiyel_cari_grup IS NOT NULL')->get()->result();        $data['sektorler'] = $this->db->get('sektorler')->result();
          // Tüm illeri getir (il yetkisi kısıtlaması kaldırıldı)
        $data['iller'] = $this->db->get('iller')->result();
        $data['ilceler'] = $this->db->get('ilceler')->result();
        $this->load->view('teklif/teklif_hazirla', $data);
    }
      // Teklif Listele sayfası
    public function teklif_listele() {
        // Potansiyel satışları, ilgili cari adını, durum adını ve işlemi yapan kullanıcı adını çek
        $this->db->select('ps.*, pc.potansiyel_cari_ad, pd.Durum_Adi as durum_adi, CONCAT(k.kullanici_ad, " ", k.kullanici_soyad) as islemi_yapan_ad');
        $this->db->from('potansiyel_satis ps');
        $this->db->join('potansiyel_cari pc', 'ps.potansiyel_cari_id = pc.id', 'left');
        $this->db->join('potansiyel_durumlar pd', 'ps.durum_id = pd.id', 'left');
        $this->db->join('kullanicilar k', 'ps.islemi_yapan = k.kullanici_id', 'left');
        
        // Login olan kullanıcının bilgilerini al
        $control = session("r", "login_info");
        $logged_user_id = $control->kullanici_id ?? null;
        
        if ($logged_user_id) {
            // Kendisine bağlı olan kullanıcıları bul
            $this->db->reset_query();
            $this->db->select('kullanici_id');
            $this->db->from('kullanicilar');
            $this->db->where('kullanici_sorumluMudur', $logged_user_id);
            $bağlı_kullanicilar_query = $this->db->get();
            $bağlı_kullanicilar = $bağlı_kullanicilar_query->result();
            
            // Kendisi + bağlı kullanıcıların ID'lerini topla
            $allowed_user_ids = array($logged_user_id);
            foreach ($bağlı_kullanicilar as $user) {
                $allowed_user_ids[] = $user->kullanici_id;
            }
            
            // Potansiyel satış sorgusunu yeniden başlat
            $this->db->select('ps.*, pc.potansiyel_cari_ad, pd.Durum_Adi as durum_adi, CONCAT(k.kullanici_ad, " ", k.kullanici_soyad) as islemi_yapan_ad');
            $this->db->from('potansiyel_satis ps');
            $this->db->join('potansiyel_cari pc', 'ps.potansiyel_cari_id = pc.id', 'left');
            $this->db->join('potansiyel_durumlar pd', 'ps.durum_id = pd.id', 'left');
            $this->db->join('kullanicilar k', 'ps.islemi_yapan = k.kullanici_id', 'left');
            
            // Sadece kendisi ve bağlı kullanıcıların kayıtlarını getir
            $this->db->where_in('ps.islemi_yapan', $allowed_user_ids);
        }
        
        // URL parametrelerine göre filtreleme
        $cari_id = $this->input->get('cari_id');
        if (!empty($cari_id)) {
            $this->db->where('ps.potansiyel_cari_id', $cari_id);
        }
        
        $durum_id = $this->input->get('durum_id');
        if (!empty($durum_id)) {
            $this->db->where('ps.durum_id', $durum_id);
            
            // Durum filtresi varsa da aynı kullanıcı kısıtlaması uygulanır (yukarıda zaten uygulandı)
        }
        
        $potansiyel_satislar = $this->db->get()->result();
        $this->load->view('teklif/teklif_listele', [
            'potansiyel_satislar' => $potansiyel_satislar
        ]);
    }

    // Verilen Teklifler sayfası
    public function verilen_teklifler() {
        // Yetki kontrolü - ID: 1511
        if (!grup_modul_yetkisi_var(1511)) {
            redirect('illegal');
            return;
        }
        
        // Kullanıcı bilgilerini al
        $control = session("r", "login_info");
        $kullanici_id = $control->kullanici_id;
        $kullanici_grup_id = $control->grup_id; // Kullanıcının grup ID'si
        $bugun = date('Y-m-d');
        
        // TEK FİLTRE: Her kullanıcı kendi + kendisine bağlı kullanıcıların tekliflerini görsün
        // Kendisine bağlı kullanıcıları bul (kullanici_sorumluMudur alanından)
        $bagliKullanicilarQuery = "SELECT kullanici_id FROM kullanicilar WHERE kullanici_sorumluMudur = ? OR kullanici_id = ?";
        $bagliKullanicilar = $this->db->query($bagliKullanicilarQuery, [$kullanici_id, $kullanici_id])->result();
        
        // Erişim izni olan kullanıcı ID'lerini topla
        $allowed_user_ids = array();
        foreach ($bagliKullanicilar as $user) {
            $allowed_user_ids[] = $user->kullanici_id;
        }
        
        // Eğer hiç kullanıcı bulunamazsa sadece kendisini ekle
        if (empty($allowed_user_ids)) {
            $allowed_user_ids = array($kullanici_id);
        }
        
        error_log("Kullanıcı $kullanici_id - Erişim izni olan kullanıcı ID'leri: " . implode(', ', $allowed_user_ids));
        
        try {
            // Verilen teklifleri çek (potansiyel_satis tablosundan)
            $this->db->select('ps.*, pc.potansiyel_cari_ad, pc.potansiyel_cari_firmaTelefon, 
                              pc.olusturma_zamani, pd.Durum_Adi, il.il as il_adi, ilce.ilce as ilce_adi,
                              CONCAT(k.kullanici_ad, " ", k.kullanici_soyad) as kullanici_adsoyad');
            $this->db->from('potansiyel_satis ps');
            $this->db->join('potansiyel_cari pc', 'ps.potansiyel_cari_id = pc.id', 'left');
            $this->db->join('potansiyel_durumlar pd', 'ps.durum_id = pd.id', 'left');
            $this->db->join('iller il', 'pc.potansiyel_il_id = il.id', 'left');
            $this->db->join('ilceler ilce', 'pc.potansiyel_ilce_id = ilce.id', 'left');
            $this->db->join('kullanicilar k', 'ps.islemi_yapan = k.kullanici_id', 'left');
            
            // TEK FİLTRE: Sadece izin verilen kullanıcıların yaptığı teklifleri göster
            $this->db->where_in('ps.islemi_yapan', $allowed_user_ids);
            
            $this->db->order_by('ps.islem_tarihi', 'DESC');
            $teklifler = $this->db->get()->result();
            
            // Teklifler array'ini kontrol et
            if (!is_array($teklifler)) {
                $teklifler = array();
            }
            
            // Debug: İlk kaydı kontrol et
            if (!empty($teklifler)) {
                error_log('İlk teklif verisi: ' . print_r($teklifler[0], true));
                
                // Personel ve durum verilerini debug için logla
                $personel_list = array();
                $durum_list = array();
                foreach ($teklifler as $teklif) {
                    if (!empty($teklif->kullanici_adsoyad) && !in_array($teklif->kullanici_adsoyad, $personel_list)) {
                        $personel_list[] = $teklif->kullanici_adsoyad;
                    }
                    if (!empty($teklif->Durum_Adi) && !in_array($teklif->Durum_Adi, $durum_list)) {
                        $durum_list[] = $teklif->Durum_Adi;
                    }
                }
                error_log('Personel listesi: ' . implode(', ', $personel_list));
                error_log('Durum listesi: ' . implode(', ', $durum_list));
                error_log('Toplam teklif sayısı: ' . count($teklifler));
            }
            
            // Telefon numaralarını formatla
            foreach ($teklifler as &$teklif) {
                if (!empty($teklif->potansiyel_cari_firmaTelefon)) {
                    $teklif->potansiyel_cari_firmaTelefon = $this->format_phone_number($teklif->potansiyel_cari_firmaTelefon);
                }
            }
            
        } catch (Exception $e) {
            // Hata durumunda boş array
            $teklifler = array();
            error_log('Verilen teklifler hatası: ' . $e->getMessage());
        }
        
        // View'a gönderilecek veriler
        $data = array(
            'baslik' => 'Verilen Teklifler',
            'teklifler' => isset($teklifler) ? $teklifler : array(),
            'toplam_teklif' => isset($teklifler) ? count($teklifler) : 0,
            'kullanici_grup_id' => $kullanici_grup_id // Debug için grup ID'sini de gönder
        );
        
        // Debug: Gönderilen veriyi kontrol et
        error_log('Verilen teklifler view\'a gönderilen veri: ' . print_r($data, true));
        
        $this->load->view('teklif/verilen-teklifler', $data);
    }

    // Tüm Teklifler sayfası (ID: 1512)
    public function tum_teklifler() {
        // Yetki kontrolü - ID: 1512
        if (!grup_modul_yetkisi_var(1512)) {
            redirect('illegal');
            return;
        }

        // Kullanıcı bilgilerini al
        $control = session("r", "login_info");
        $kullanici_id = $control->kullanici_id;
        $kullanici_grup_id = $control->grup_id;
        $bugun = date('Y-m-d');

        // Tüm teklifleri çek (kullanıcı kısıtı olmadan)
        try {
            $this->db->select('ps.*, pc.potansiyel_cari_ad, pc.potansiyel_cari_firmaTelefon, 
                              pc.olusturma_zamani, pd.Durum_Adi, il.il as il_adi, ilce.ilce as ilce_adi,
                              CONCAT(k.kullanici_ad, " ", k.kullanici_soyad) as kullanici_adsoyad');
            $this->db->from('potansiyel_satis ps');
            $this->db->join('potansiyel_cari pc', 'ps.potansiyel_cari_id = pc.id', 'left');
            $this->db->join('potansiyel_durumlar pd', 'ps.durum_id = pd.id', 'left');
            $this->db->join('iller il', 'pc.potansiyel_il_id = il.id', 'left');
            $this->db->join('ilceler ilce', 'pc.potansiyel_ilce_id = ilce.id', 'left');
            $this->db->join('kullanicilar k', 'ps.islemi_yapan = k.kullanici_id', 'left');
            $this->db->order_by('ps.islem_tarihi', 'DESC');
            $teklifler = $this->db->get()->result();

            if (!is_array($teklifler)) {
                $teklifler = array();
            }

            // Telefon numaralarını formatla
            foreach ($teklifler as &$teklif) {
                if (!empty($teklif->potansiyel_cari_firmaTelefon)) {
                    $teklif->potansiyel_cari_firmaTelefon = $this->format_phone_number($teklif->potansiyel_cari_firmaTelefon);
                }
            }

        } catch (Exception $e) {
            $teklifler = array();
            error_log('Tüm teklifler hatası: ' . $e->getMessage());
        }

        $data = array(
            'baslik' => 'Tüm Teklifler',
            'teklifler' => isset($teklifler) ? $teklifler : array(),
            'toplam_teklif' => isset($teklifler) ? count($teklifler) : 0,
            'kullanici_grup_id' => $kullanici_grup_id
        );

        $this->load->view('teklif/tum-teklifler', $data);
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

    // Teklif Ayarları sayfası
    public function teklif_ayar() {
        $this->load->view('teklif/teklif_ayar');
    }

    // --- SEZONLAR ---
    public function sezonlar_listele() {
        $this->load->database();
        $sezonlar = $this->db->get('sezonlar')->result();
        echo json_encode(['status'=>'success','data'=>$sezonlar]);
    }
    public function sezon_ekle() {
        $this->load->database();
        $ad = $this->input->post('sezon_adi');
        if(!$ad) { echo json_encode(['status'=>'error','msg'=>'Sezon adı zorunlu']); return; }
        $this->db->insert('sezonlar', ['sezon_adi'=>$ad]);
        echo json_encode(['status'=>'success']);
    }
    public function sezon_guncelle() {
        $this->load->database();
        $id = $this->input->post('sezon_id');
        $ad = $this->input->post('sezon_adi');
        if(!$id || !$ad) { echo json_encode(['status'=>'error','msg'=>'Eksik parametre']); return; }
        $this->db->update('sezonlar', ['sezon_adi'=>$ad], ['sezon_id'=>$id]);
        echo json_encode(['status'=>'success']);
    }
    public function sezon_sil() {
        $this->load->database();
        $id = $this->input->post('sezon_id');
        if(!$id) { echo json_encode(['status'=>'error','msg'=>'ID zorunlu']); return; }
        $this->db->delete('sezonlar', ['sezon_id'=>$id]);
        echo json_encode(['status'=>'success']);
    }

    // --- CARI GRUPLAR ---
    public function cari_gruplar_listele() {
        $this->load->database();
        $gruplar = $this->db->get('cariGruplari')->result();
        echo json_encode(['status'=>'success','data'=>$gruplar]);
    }
    public function cari_grup_ekle() {
        $this->load->database();
        $ad = $this->input->post('cari_grup');
        if(!$ad) { echo json_encode(['status'=>'error','msg'=>'Cari grup adı zorunlu']); return; }
        $this->db->insert('cariGruplari', ['cariGrup_ad'=>$ad]);
        echo json_encode(['status'=>'success']);
    }
    public function cari_grup_guncelle() {
        $this->load->database();
        $id = $this->input->post('cari_grup_id');
        $ad = $this->input->post('cari_grup');
        if(!$id || !$ad) { echo json_encode(['status'=>'error','msg'=>'Eksik parametre']); return; }
        $this->db->update('cariGruplari', ['cariGrup_ad'=>$ad], ['cariGrup_id'=>$id]);
        echo json_encode(['status'=>'success']);
    }
    public function cari_grup_sil() {
        $this->load->database();
        $id = $this->input->post('cari_grup_id');
        if(!$id) { echo json_encode(['status'=>'error','msg'=>'ID zorunlu']); return; }
        $this->db->delete('cariGruplari', ['cariGrup_id'=>$id]);
        echo json_encode(['status'=>'success']);
    }

    // --- SEKTÖRLER ---
    public function sektorler_listele() {
        $this->load->database();
        $sektorler = $this->db->get('sektorler')->result();
        echo json_encode(['status'=>'success','data'=>$sektorler]);
    }
    public function sektor_ekle() {
        $this->load->database();
        $ad = $this->input->post('sektor_adi');
        if(!$ad) { echo json_encode(['status'=>'error','msg'=>'Sektör adı zorunlu']); return; }
        $this->db->insert('sektorler', ['sektor_adi'=>$ad]);
        echo json_encode(['status'=>'success']);
    }
    public function sektor_guncelle() {
        $this->load->database();
        $id = $this->input->post('sektor_id');
        $ad = $this->input->post('sektor_adi');
        if(!$id || !$ad) { echo json_encode(['status'=>'error','msg'=>'Eksik parametre']); return; }
        $this->db->update('sektorler', ['sektor_adi'=>$ad], ['sektor_id'=>$id]);
        echo json_encode(['status'=>'success']);
    }
    public function sektor_sil() {
        $this->load->database();
        $id = $this->input->post('sektor_id');
        if(!$id) { echo json_encode(['status'=>'error','msg'=>'ID zorunlu']); return; }
        $this->db->delete('sektorler', ['sektor_id'=>$id]);
        echo json_encode(['status'=>'success']);
    }

    // --- MAHALLELER ---
    // AJAX: Seçilen il ve ilçe id'sine göre potansiyel_cari tablosundan mahalleleri döndürür
    public function get_potansiyel_mahalleler() {
        $il_id = $this->input->post('il_id');
        $ilce_id = $this->input->post('ilce_id');
        if (!$il_id || !$ilce_id) {
            echo json_encode(['status' => 'error', 'msg' => 'İl ve ilçe zorunlu']);
            return;
        }
        $this->db->select('potansiyel_mahalle');
        $this->db->from('potansiyel_cari');
        $this->db->where('potansiyel_il_id', $il_id);
        $this->db->where('potansiyel_ilce_id', $ilce_id);
        $this->db->where('potansiyel_mahalle IS NOT NULL');
        $this->db->where('potansiyel_mahalle !=', '');
        $this->db->distinct();
        $query = $this->db->get();
        $mahalleler = array();
        foreach ($query->result() as $row) {
            $mahalleler[] = $row->potansiyel_mahalle;
        }
        echo json_encode(['status' => 'success', 'data' => $mahalleler]);
    }

    // AJAX: Telefon search (potansiyel_cari_firmaTelefon)
    public function telefon_search() {
        $q = $this->input->post('q');
        $this->db->select('potansiyel_cari_firmaTelefon');
        $this->db->from('potansiyel_cari');
        if ($q) {
            $this->db->like('potansiyel_cari_firmaTelefon', $q);
        }
        $this->db->where('potansiyel_cari_firmaTelefon IS NOT NULL');
        $this->db->where('potansiyel_cari_firmaTelefon !=', '');        $this->db->distinct();
        $query = $this->db->get();
        $telefonlar = array();        foreach ($query->result() as $row) {
            $telefonlar[] = $row->potansiyel_cari_firmaTelefon;
        }
        echo json_encode($telefonlar);
    }    // Telefon/Cari Ad ile arama (Select2 için)
    public function telefon_cari_search() {
        header('Content-Type: application/json');
        $term = $this->input->post('q');
        $returnData = array();
        
        // Debug: Log the search term
        error_log("Search term: " . $term);
        
        if (strlen($term) >= 2) {
            // Kullanıcının sorumluluk bölgesi kontrolü
            $control2 = session("r", "login_info");
            $u_id = $control2->kullanici_id ?? null;
            $bugun = date('Y-m-d');
            
            // Debug: Log the query
            $this->db->select('id, potansiyel_cari_ad, potansiyel_cari_firmaTelefon, potansiyel_il_id');
            $this->db->from('potansiyel_cari');
            
            // Kullanıcının sorumlu olduğu illeri kontrol et
            if ($u_id) {
                $sorumluIllerQ = "SELECT DISTINCT il_id 
                                 FROM kullanici_sorumluluk_bolgesi 
                                 WHERE kullanici = '$u_id' 
                                 AND durum = 1 
                                 AND il_id IS NOT NULL
                                 AND (baslangic_tarihi IS NULL OR baslangic_tarihi <= '$bugun') 
                                 AND (bitis_tarihi IS NULL OR bitis_tarihi >= '$bugun')";
                $sorumluIller = $this->db->query($sorumluIllerQ)->result();
                
                $sorumluIlIds = [];
                foreach ($sorumluIller as $il) {
                    $sorumluIlIds[] = $il->il_id;
                }
                
                if (count($sorumluIlIds) > 0) {
                    $this->db->where_in('potansiyel_il_id', $sorumluIlIds);
                }
            }
            
            $this->db->group_start();
            $this->db->like('LOWER(potansiyel_cari_ad)', strtolower($term));
            $this->db->or_like('potansiyel_cari_firmaTelefon', $term);
            $this->db->group_end();
            $this->db->where('potansiyel_cari_ad IS NOT NULL');
            $this->db->where('potansiyel_cari_ad !=', '');
            $this->db->order_by('potansiyel_cari_ad', 'ASC');
            $this->db->limit(20);
            error_log("Query: " . $this->db->get_compiled_select('', FALSE));
            
            $query = $this->db->get();
            $results = $query->result();
            
            // Debug: Log result count
            error_log("Result count: " . count($results));
            
            foreach ($results as $row) {
                $display_text = $row->potansiyel_cari_ad;
                if ($row->potansiyel_cari_firmaTelefon) {
                    $display_text .= ' (' . $row->potansiyel_cari_firmaTelefon . ')';
                }
                  // Select2 formatına uygun olarak id ve text kullan
                $returnData[] = [
                    'value' => $row->potansiyel_cari_firmaTelefon, // Value olarak telefon kullan
                    'label' => $display_text, // Gösterilecek metin
                    'id' => $row->potansiyel_cari_firmaTelefon,
                    'text' => $display_text,
                    'cari_id' => $row->id,
                    'cari_ad' => $row->potansiyel_cari_ad,
                    'telefon' => $row->potansiyel_cari_firmaTelefon
                ];
            }
        }
        
        // Debug: Log return data
        error_log("Return data: " . json_encode($returnData));
        
        echo json_encode($returnData);
        die;
    }

    // Autocomplete for Potansiyel Cari
    public function potansiyel_cari_autocomplete() {
        header('Content-Type: application/json');
        $term = $this->input->get('term');
        $returnData = array();
        
        // Debug log
        log_message('debug', 'Autocomplete called with term: ' . $term);
        
        if (strlen($term) >= 4) {
            $this->db->select('id, potansiyel_cari_ad, potansiyel_cari_firmaTelefon');
            $this->db->from('potansiyel_cari');
            $this->db->group_start();
            $this->db->like('potansiyel_cari_ad', $term);
            $this->db->or_like('potansiyel_cari_firmaTelefon', $term);
            $this->db->group_end();
            $this->db->limit(20);
            
            $query = $this->db->get();
            $results = $query->result();
            
            foreach ($results as $row) {
                $display_text = $row->potansiyel_cari_ad;
                if ($row->potansiyel_cari_firmaTelefon) {
                    $display_text .= ' (' . $row->potansiyel_cari_firmaTelefon . ')';
                }
                
                $returnData[] = [
                    'id' => $row->id,
                    'value' => $display_text,
                    'label' => $display_text,
                    'cari_ad' => $row->potansiyel_cari_ad,
                    'telefon' => $row->potansiyel_cari_firmaTelefon
                ];
            }
        }
          log_message('debug', 'Returning data: ' . json_encode($returnData));
        echo json_encode($returnData);        die;
    }

    // Test endpoint for autocomplete
    public function test_autocomplete() {
        header('Content-Type: application/json');
        
        // Test query
        $this->db->select('id, potansiyel_cari_ad, potansiyel_cari_soyad, potansiyel_cari_firmaTelefon');
        $this->db->from('potansiyel_cari');
        $this->db->limit(5);
        $query = $this->db->get();
        
        $test_data = [];
        foreach ($query->result() as $row) {
            $test_data[] = [
                'id' => $row->id,
                'ad' => $row->potansiyel_cari_ad,
                'soyad' => $row->potansiyel_cari_soyad,
                'telefon' => $row->potansiyel_cari_firmaTelefon
            ];
        }
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Test endpoint working',
            'sample_data' => $test_data,
            'base_url' => base_url(),
            'current_url' => current_url()
        ]);
        die;
    }    // Potansiyel Satış Ekle
    public function potansiyel_satis_ekle() {
        $control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id ?? 1;
        
        $data = [
            'potansiyel_cari_id' => $this->input->post('potansiyel_cari_id'),
            'durum_id' => $this->input->post('durum_id'),
            'fiyat1' => $this->input->post('fiyat1'),
            'fiyat2' => $this->input->post('fiyat2'),
            'fiyat3' => $this->input->post('fiyat3'),            'aciklama' => $this->input->post('aciklama'),
            'islemi_yapan' => $u_id,
            'islem_tarihi' => date('Y-m-d H:i:s')
        ];
        
        if ($this->db->insert('potansiyel_satis', $data)) {
            $this->session->set_flashdata('success', 'Potansiyel satış başarıyla eklendi.');
        } else {
            $this->session->set_flashdata('error', 'Potansiyel satış eklenirken hata oluştu.');
        }
        
        redirect('teklif/teklif_listele');
    }

    // Test endpoint for potansiyel_cari table structure
    public function test_potansiyel_cari_structure() {
        $query = $this->db->query('DESCRIBE potansiyel_cari');
        $fields = $query->result_array();
        echo json_encode($fields);
        die;
    }

    // AJAX: İl seçimine göre kullanıcının sorumlu olduğu ilçeleri döndürür
    public function get_ilceler_by_sorumluluk() {
        $il_id = $this->input->post('il_id');
        if (empty($il_id)) {
            echo json_encode(['status' => 'error', 'message' => 'İl ID Bilgisi Alınamadı']);
            return;
        }
        $control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id ?? null;
        if (!$u_id) {
            echo json_encode(['status' => 'error', 'message' => 'Kullanıcı bilgisi alınamadı']);
            return;
        }
        // Sorumluluk bölgelerini çek
        $sorumluIlcelerQ = "SELECT DISTINCT ilce_id FROM kullanici_sorumluluk_bolgesi WHERE kullanici = '$u_id' AND il_id = '$il_id' AND durum = 1";
        $sorumluIlceler = $this->db->query($sorumluIlcelerQ)->result();
        if (empty($sorumluIlceler)) {
            echo json_encode(['status' => 'error', 'message' => 'Bu ilde sorumlu olduğunuz ilçe bulunmuyor']);
            return;
        }
        $tumIlcelerYetkisi = false;
        $sorumluIlceIds = array();
        foreach ($sorumluIlceler as $row) {
            if ($row->ilce_id == 0) {
                $tumIlcelerYetkisi = true;
                break;
            }
            $sorumluIlceIds[] = $row->ilce_id;
        }
        $this->db->select('id, ilce');
        $this->db->from('ilceler');
        $this->db->where('il_id', $il_id);
        if (!$tumIlcelerYetkisi) {
            if (empty($sorumluIlceIds)) {
                echo json_encode(['status' => 'error', 'message' => 'İlçe bulunamadı']);
                return;
            }
            $this->db->where_in('id', $sorumluIlceIds);
        }
        $this->db->order_by('ilce', 'ASC');
        $ilceler = $this->db->get();
        if ($ilceler->num_rows() > 0) {
            $ilceList = array();
            foreach ($ilceler->result() as $item) {
                $ilceList[] = array('id' => $item->id, 'ilce' => $item->ilce);
            }
            echo json_encode(['status' => 'success', 'data' => $ilceList]);        } else {
            echo json_encode(['status' => 'error', 'message' => 'İlçe bulunamadı']);
        }
    }
    
    // ÇatKapı Yeni Teklif Kaydet
    public function catkapi_kaydet() {
        // Kullanıcı kontrolü
        $control2 = session("r", "login_info");
        if (!$control2) {
            $this->session->set_flashdata('catkapi_hata', 'Oturum bilgisi bulunamadı.');
            redirect('teklif/teklif-hazirla');
            return;
        }
        
        $u_id = $control2->kullanici_id;
        $anaHesap = anaHesapBilgisi();
        
        // Tarih ve saat bilgileri
        date_default_timezone_set('Europe/Istanbul');
        $tarihi = date('Y-m-d H:i:s');
        
        try {
            // Form verilerini al
            $sezon_id = postval('sezon_id');
            $potansiyel_cari_ad = postval('potansiyel_cari_ad');
            $potansiyel_cari_firmaTelefon = postval('potansiyel_cari_firmaTelefon');
            $sektor_id = postval('sektor_id');
            $potansiyel_ulke_id = postval('potansiyel_ulke_id');
            $potansiyel_il_id = postval('potansiyel_il_id');
            $potansiyel_ilce_id = postval('potansiyel_ilce_id');
            $potansiyel_mahalle = postval('potansiyel_mahalle');
            $potansiyel_cari_adres = postval('potansiyel_cari_adres');
            
            // Zorunlu alanları kontrol et
            if (empty($sezon_id) || empty($potansiyel_cari_ad) || empty($potansiyel_cari_firmaTelefon) || 
                empty($sektor_id) || empty($potansiyel_ulke_id) || empty($potansiyel_il_id) || 
                empty($potansiyel_ilce_id) || empty($potansiyel_cari_adres)) {
                $this->session->set_flashdata('catkapi_hata', 'Lütfen tüm zorunlu alanları doldurun.');
                redirect('teklif/teklif-hazirla');
                return;
            }
            
            // Basit dosya yükleme
            $gorsel_dosya = null;
            if (isset($_FILES['potansiyel_gorsel']) && !empty($_FILES['potansiyel_gorsel']['name'])) {
                $upload_path = './assets/uploads/potansiyeller/gorseller/';
                if (!is_dir($upload_path)) {
                    mkdir($upload_path, 0755, true);
                }
                
                $file_extension = pathinfo($_FILES['potansiyel_gorsel']['name'], PATHINFO_EXTENSION);
                $new_filename = 'gorsel_' . time() . '_' . rand(1000, 9999) . '.' . $file_extension;
                
                if (move_uploaded_file($_FILES['potansiyel_gorsel']['tmp_name'], $upload_path . $new_filename)) {
                    $gorsel_dosya = $new_filename;
                }
            }
              // Veritabanına kayıt için veri hazırla
            $data = array(
                'sezon_id' => $sezon_id,
                'potansiyel_cari_ad' => $potansiyel_cari_ad,
                'potansiyel_cari_firmaTelefon' => $potansiyel_cari_firmaTelefon,
                'sektor_id' => $sektor_id,
                'potansiyel_ulke_id' => $potansiyel_ulke_id,
                'potansiyel_il_id' => $potansiyel_il_id,
                'potansiyel_ilce_id' => $potansiyel_ilce_id,
                'potansiyel_mahalle' => $potansiyel_mahalle,
                'potansiyel_cari_adres' => $potansiyel_cari_adres,
                'potansiyel_gorsel' => $gorsel_dosya,
                'olusturma_zamani' => $tarihi,
                'olusturan_kullanici' => $u_id
            );// Potansiyel cari grubunu belirle (sektör bilgisinden)
            if ($sektor_id) {
                $sektor = $this->db->get_where('sektorler', array('sektor_id' => $sektor_id))->row();
                if ($sektor) {
                    $data['potansiyel_cari_grup'] = $sektor->sektor_adi;
                }
            }
            
            // Veritabanına kaydet
            $this->vt->insert('potansiyel_cari', $data);
            $insert_id = $this->db->insert_id();
            
            if ($insert_id) {
                $this->session->set_flashdata('catkapi_basarili', 'Yeni teklif başarıyla eklendi.');
                logekle(100, 2); // ÇatKapı ekleme log
            } else {
                $this->session->set_flashdata('catkapi_hata', 'Kayıt sırasında bir hata oluştu.');
            }
            
        } catch (Exception $e) {
            $this->session->set_flashdata('catkapi_hata', 'Bir hata oluştu: ' . $e->getMessage());
        }
        
        // Teklif hazırla sayfasına yönlendir
        redirect('teklif/teklif-hazirla');
    }
    
    // AJAX: Personel arama (Verilen Teklifler için)
    public function get_personel_list() {
        try {
            header('Content-Type: application/json');
            $term = $this->input->post('term');
            if ($term === null) $term = '';
            
            // Kullanıcı bilgilerini al
            $control = session("r", "login_info");
            $kullanici_id = $control->kullanici_id;
            $kullanici_grup_id = $control->grup_id;
            
            // Kullanıcı grup mantığına göre cari filtrelemesi
            $cari_ids = array();
            
            if (in_array($kullanici_grup_id, [3, 6])) {
                // Saha Satış Temsilcisi veya Bölge Müdürü - sadece kendi ve kendisine bağlı carileri görsün
                $kendineBagliCariQuery = "
                    SELECT DISTINCT pc.id as cari_id
                    FROM potansiyel_cari pc 
                    WHERE pc.olusturan_kullanici = ?
                       OR pc.id IN (
                           SELECT DISTINCT ps.potansiyel_cari_id 
                           FROM potansiyel_satis ps 
                           WHERE ps.islemi_yapan = ?
                       )
                ";
                
                $kendineBagliCariler = $this->db->query($kendineBagliCariQuery, [$kullanici_id, $kullanici_id])->result();
                
                foreach ($kendineBagliCariler as $cari) {
                    $cari_ids[] = $cari->cari_id;
                }
                
                // Eğer hiç cari yoksa, boş sonuç dön
                if (empty($cari_ids)) {
                    $cari_ids = [-1]; // Hiçbir sonuç getirmeyecek ID
                }
            }
            
            // Daha basit sorgu
            $this->db->select('DISTINCT k.kullanici_id, k.kullanici_ad, k.kullanici_soyad');
            $this->db->from('kullanicilar k');
            $this->db->join('potansiyel_satis ps', 'ps.islemi_yapan = k.kullanici_id', 'inner');
            
            // Kullanıcı grubu bazlı cari filtrelemesi
            if (!empty($cari_ids) && $cari_ids !== [-1]) {
                $this->db->where_in('ps.potansiyel_cari_id', $cari_ids);
            } elseif ($cari_ids === [-1]) {
                // Hiçbir sonuç döndürme
                $this->db->where('1=0');
            }
            
            // Kullanıcı grubu bazlı işlem yapan filtrelemesi
            if ($kullanici_grup_id == 3) {
                // Saha Satış Temsilcisi - sadece kendi yaptığı teklifleri görsün
                $this->db->where('ps.islemi_yapan', $kullanici_id);
            } elseif ($kullanici_grup_id == 6) {
                // Bölge Müdürü - kendi ve kendisine bağlı kullanıcıların yaptığı teklifleri görsün
                $bagliKullanicilarQuery = "SELECT kullanici_id FROM kullanicilar WHERE kullanici_sorumluMudur = ?";
                $bagliKullanicilar = $this->db->query($bagliKullanicilarQuery, [$kullanici_id])->result();
                
                $allowed_user_ids = array($kullanici_id);
                foreach ($bagliKullanicilar as $user) {
                    $allowed_user_ids[] = $user->kullanici_id;
                }
                
                $this->db->where_in('ps.islemi_yapan', $allowed_user_ids);
            }
            
            // Arama terimi varsa filtrele
            if (!empty($term)) {
                $this->db->group_start();
                $this->db->like('k.kullanici_ad', $term);
                $this->db->or_like('k.kullanici_soyad', $term);
                $this->db->group_end();
            }
            
            $this->db->order_by('k.kullanici_ad', 'ASC');
            $this->db->limit(50);
            
            $query = $this->db->get();
            
            if (!$query) {
                throw new Exception('Database query failed');
            }
            
            $results = $query->result();
            $personeller = array();
            
            foreach ($results as $row) {
                $full_name = trim($row->kullanici_ad . ' ' . $row->kullanici_soyad);
                $personeller[] = array(
                    'id' => $row->kullanici_id,
                    'text' => $full_name,
                    'value' => $full_name
                );
            }
            
            echo json_encode([
                'status' => 'success',
                'data' => $personeller,
                'count' => count($personeller),
                'term' => $term
            ]);
            
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }
        exit;
    }
    
    // AJAX: Lokasyon arama (Verilen Teklifler için)
    public function get_location_list() {
        try {
            header('Content-Type: application/json');
            $term = $this->input->post('term');
            if ($term === null) $term = '';
            
            // Kullanıcı bilgilerini al
            $control = session("r", "login_info");
            $kullanici_id = $control->kullanici_id;
            $kullanici_grup_id = $control->grup_id;
            
            // Kullanıcı grup mantığına göre cari filtrelemesi
            $cari_ids = array();
            
            if (in_array($kullanici_grup_id, [3, 6])) {
                // Saha Satış Temsilcisi veya Bölge Müdürü - sadece kendi ve kendisine bağlı carileri görsün
                $kendineBagliCariQuery = "
                    SELECT DISTINCT pc.id as cari_id
                    FROM potansiyel_cari pc 
                    WHERE pc.olusturan_kullanici = ?
                       OR pc.id IN (
                           SELECT DISTINCT ps.potansiyel_cari_id 
                           FROM potansiyel_satis ps 
                           WHERE ps.islemi_yapan = ?
                       )
                ";
                
                $kendineBagliCariler = $this->db->query($kendineBagliCariQuery, [$kullanici_id, $kullanici_id])->result();
                
                foreach ($kendineBagliCariler as $cari) {
                    $cari_ids[] = $cari->cari_id;
                }
                
                // Eğer hiç cari yoksa, boş sonuç dön
                if (empty($cari_ids)) {
                    $cari_ids = [-1]; // Hiçbir sonuç getirmeyecek ID
                }
            }
            
            // Daha basit sorgu
            $this->db->select('DISTINCT il.il, ilce.ilce');
            $this->db->from('iller il');
            $this->db->join('ilceler ilce', 'ilce.il_id = il.id', 'inner');
            $this->db->join('potansiyel_cari pc', 'pc.potansiyel_il_id = il.id AND pc.potansiyel_ilce_id = ilce.id', 'inner');
            $this->db->join('potansiyel_satis ps', 'ps.potansiyel_cari_id = pc.id', 'inner');
            
            // Kullanıcı grubu bazlı cari filtrelemesi
            if (!empty($cari_ids) && $cari_ids !== [-1]) {
                $this->db->where_in('pc.id', $cari_ids);
            } elseif ($cari_ids === [-1]) {
                // Hiçbir sonuç döndürme
                $this->db->where('1=0');
            }
            
            // Kullanıcı grubu bazlı işlem yapan filtrelemesi
            if ($kullanici_grup_id == 3) {
                // Saha Satış Temsilcisi - sadece kendi yaptığı teklifleri görsün
                $this->db->where('ps.islemi_yapan', $kullanici_id);
            } elseif ($kullanici_grup_id == 6) {
                // Bölge Müdürü - kendi ve kendisine bağlı kullanıcıların yaptığı teklifleri görsün
                $bagliKullanicilarQuery = "SELECT kullanici_id FROM kullanicilar WHERE kullanici_sorumluMudur = ?";
                $bagliKullanicilar = $this->db->query($bagliKullanicilarQuery, [$kullanici_id])->result();
                
                $allowed_user_ids = array($kullanici_id);
                foreach ($bagliKullanicilar as $user) {
                    $allowed_user_ids[] = $user->kullanici_id;
                }
                
                $this->db->where_in('ps.islemi_yapan', $allowed_user_ids);
            }
            
            // İl ve ilçe bilgisi olan kayıtları al
            $this->db->where('il.il IS NOT NULL');
            $this->db->where('ilce.ilce IS NOT NULL');
            
            // Arama terimi varsa filtrele
            if (!empty($term)) {
                $this->db->group_start();
                $this->db->like('il.il', $term);
                $this->db->or_like('ilce.ilce', $term);
                $this->db->group_end();
            }
            
            $this->db->order_by('il.il', 'ASC');
            $this->db->order_by('ilce.ilce', 'ASC');
            $this->db->limit(50);
            
            $query = $this->db->get();
            
            if (!$query) {
                throw new Exception('Database query failed');
            }
            
            $results = $query->result();
            $locations = array();
            
            foreach ($results as $row) {
                $location_text = $row->il . ' / ' . $row->ilce;
                $locations[] = array(
                    'id' => $location_text,
                    'text' => $location_text,
                    'value' => $location_text,
                    'il' => $row->il,
                    'ilce' => $row->ilce
                );
            }
            
            echo json_encode([
                'status' => 'success',
                'data' => $locations,
                'count' => count($locations),
                'term' => $term
            ]);
            
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }
        exit;
    }

    // AJAX: Durum listesi (Verilen Teklifler için)
    public function get_durum_list() {
        try {
            header('Content-Type: application/json');
            $term = $this->input->post('term');
            if ($term === null) $term = '';
            
            // Kullanıcı bilgilerini al
            $control = session("r", "login_info");
            $kullanici_id = $control->kullanici_id;
            $kullanici_grup_id = $control->grup_id;
            
            // Kullanıcı grup mantığına göre cari filtrelemesi
            $cari_ids = array();
            
            if (in_array($kullanici_grup_id, [3, 6])) {
                // Saha Satış Temsilcisi veya Bölge Müdürü - sadece kendi ve kendisine bağlı carileri görsün
                $kendineBagliCariQuery = "
                    SELECT DISTINCT pc.id as cari_id
                    FROM potansiyel_cari pc 
                    WHERE pc.olusturan_kullanici = ?
                       OR pc.id IN (
                           SELECT DISTINCT ps.potansiyel_cari_id 
                           FROM potansiyel_satis ps 
                           WHERE ps.islemi_yapan = ?
                       )
                ";
                
                $kendineBagliCariler = $this->db->query($kendineBagliCariQuery, [$kullanici_id, $kullanici_id])->result();
                
                foreach ($kendineBagliCariler as $cari) {
                    $cari_ids[] = $cari->cari_id;
                }
                
                // Eğer hiç cari yoksa, boş sonuç dön
                if (empty($cari_ids)) {
                    $cari_ids = [-1]; // Hiçbir sonuç getirmeyecek ID
                }
            }
            
            // Daha basit sorgu
            $this->db->select('DISTINCT pd.id, pd.Durum_Adi');
            $this->db->from('potansiyel_durumlar pd');
            $this->db->join('potansiyel_satis ps', 'ps.durum_id = pd.id', 'inner');
            
            // Kullanıcı grubu bazlı cari filtrelemesi
            if (!empty($cari_ids) && $cari_ids !== [-1]) {
                $this->db->where_in('ps.potansiyel_cari_id', $cari_ids);
            } elseif ($cari_ids === [-1]) {
                // Hiçbir sonuç döndürme
                $this->db->where('1=0');
            }
            
            // Kullanıcı grubu bazlı işlem yapan filtrelemesi
            if ($kullanici_grup_id == 3) {
                // Saha Satış Temsilcisi - sadece kendi yaptığı teklifleri görsün
                $this->db->where('ps.islemi_yapan', $kullanici_id);
            } elseif ($kullanici_grup_id == 6) {
                // Bölge Müdürü - kendi ve kendisine bağlı kullanıcıların yaptığı teklifleri görsün
                $bagliKullanicilarQuery = "SELECT kullanici_id FROM kullanicilar WHERE kullanici_sorumluMudur = ?";
                $bagliKullanicilar = $this->db->query($bagliKullanicilarQuery, [$kullanici_id])->result();
                
                $allowed_user_ids = array($kullanici_id);
                foreach ($bagliKullanicilar as $user) {
                    $allowed_user_ids[] = $user->kullanici_id;
                }
                
                $this->db->where_in('ps.islemi_yapan', $allowed_user_ids);
            }
            
            $this->db->where('pd.Durum_Adi IS NOT NULL');
            $this->db->where('pd.Durum_Adi !=', '');
            
            // Arama terimi varsa filtrele
            if (!empty($term)) {
                $this->db->like('pd.Durum_Adi', $term);
            }
            
            $this->db->order_by('pd.Durum_Adi', 'ASC');
            $this->db->limit(50);
            
            $query = $this->db->get();
            
            if (!$query) {
                throw new Exception('Database query failed');
            }
            
            $results = $query->result();
            $durumlar = array();
            
            foreach ($results as $row) {
                $durumlar[] = array(
                    'id' => $row->id,
                    'text' => $row->Durum_Adi,
                    'value' => $row->Durum_Adi
                );
            }
            
            echo json_encode([
                'status' => 'success',
                'data' => $durumlar,
                'count' => count($durumlar),
                'term' => $term
            ]);
            
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage(),
                'data' => []
            ]);
        }
        exit;
    }

    // Test endpoint'leri - Debug için
    public function test_personel_endpoint() {
        try {
            header('Content-Type: application/json');
            
            // Basit test
            $this->db->select('COUNT(*) as total');
            $this->db->from('kullanicilar');
            $count_query = $this->db->get();
            $total_users = $count_query->row()->total;
            
            // Potansiyel satış yapan kullanıcılar
            $this->db->select('COUNT(DISTINCT islemi_yapan) as active_users');
            $this->db->from('potansiyel_satis');
            $this->db->where('islemi_yapan IS NOT NULL');
            $active_query = $this->db->get();
            $active_users = $active_query->row()->active_users;
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Personel endpoint test',
                'total_users' => $total_users,
                'active_users' => $active_users,
                'endpoint_url' => base_url('teklif/get_personel_list')
            ]);
            
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
        exit;
    }
    
    public function test_durum_endpoint() {
        try {
            header('Content-Type: application/json');
            
            // Durum sayısını kontrol et
            $this->db->select('COUNT(*) as total');
            $this->db->from('potansiyel_durumlar');
            $count_query = $this->db->get();
            $total_durumlar = $count_query->row()->total;
            
            // Kullanılan durumlar
            $this->db->select('COUNT(DISTINCT durum_id) as used_durumlar');
            $this->db->from('potansiyel_satis');
            $this->db->where('durum_id IS NOT NULL');
            $used_query = $this->db->get();
            $used_durumlar = $used_query->row()->used_durumlar;
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Durum endpoint test',
                'total_durumlar' => $total_durumlar,
                'used_durumlar' => $used_durumlar,
                'endpoint_url' => base_url('teklif/get_durum_list')
            ]);
            
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
        exit;
    }
    
    public function test_all_endpoints() {
        try {
            header('Content-Type: application/json');
            
            $results = [];
            
            // Personel test
            $personel_url = base_url('teklif/get_personel_list');
            $results['personel'] = [
                'url' => $personel_url,
                'accessible' => true
            ];
            
            // Durum test
            $durum_url = base_url('teklif/get_durum_list');
            $results['durum'] = [
                'url' => $durum_url,
                'accessible' => true
            ];
            
            // Lokasyon test
            $lokasyon_url = base_url('teklif/get_location_list');
            $results['lokasyon'] = [
                'url' => $lokasyon_url,
                'accessible' => true
            ];
            
            echo json_encode([
                'status' => 'success',
                'message' => 'All endpoints test',
                'base_url' => base_url(),
                'results' => $results,
                'timestamp' => date('Y-m-d H:i:s')
            ]);
            
        } catch (Exception $e) {
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
        exit;
    }
}
?>
