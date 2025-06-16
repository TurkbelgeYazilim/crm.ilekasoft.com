<?php
// require_once satırı kaldırıldı, CodeIgniter kendi çekirdeğini otomatik yükler
class Teklif extends CI_Controller {    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('vt');
    }// AJAX: potansiyel_cari filtreli liste
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
            // Eğer hiç sorumluluk tanımlanmamışsa hiçbir kayıt döndürme
            $this->db->where('1 = 0');
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
            $this->db->where('potansiyel_cari_firmaTelefon', $filters['potansiyel_cari_firmaTelefon']);
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
    }    // Teklif Listele sayfası
    public function teklif_listele() {
        // Potansiyel satışları, ilgili cari adını, durum adını ve işlemi yapan kullanıcı adını çek
        $this->db->select('ps.*, pc.potansiyel_cari_ad, pd.Durum_Adi as durum_adi, CONCAT(k.kullanici_ad, " ", k.kullanici_soyad) as islemi_yapan_ad');
        $this->db->from('potansiyel_satis ps');
        $this->db->join('potansiyel_cari pc', 'ps.potansiyel_cari_id = pc.id', 'left');
        $this->db->join('potansiyel_durumlar pd', 'ps.durum_id = pd.id', 'left');
        $this->db->join('kullanicilar k', 'ps.islemi_yapan = k.kullanici_id', 'left');
        
        // URL parametrelerine göre filtreleme
        $cari_id = $this->input->get('cari_id');
        if (!empty($cari_id)) {
            $this->db->where('ps.potansiyel_cari_id', $cari_id);
        }
        
        $potansiyel_satislar = $this->db->get()->result();
        $this->load->view('teklif/teklif_listele', [
            'potansiyel_satislar' => $potansiyel_satislar
        ]);
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
        $telefonlar = array();
        foreach ($query->result() as $row) {
            $telefonlar[] = $row->potansiyel_cari_firmaTelefon;
        }
        echo json_encode($telefonlar);
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
        echo json_encode($returnData);
        die;
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
}
?>
