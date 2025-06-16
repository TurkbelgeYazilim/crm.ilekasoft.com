<?php
// require_once satırı kaldırıldı, CodeIgniter kendi çekirdeğini otomatik yükler
class Illegal extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Vt');
    }

    // AJAX: potansiyel_cari filtreli liste
    public function potansiyelCariFiltrele() {
        $filters = $this->input->post();
        $this->db->from('potansiyel_cari');
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
        }
        if (!empty($filters['potansiyel_cari_firmaTelefon'])) {
            $this->db->where('potansiyel_cari_firmaTelefon', $filters['potansiyel_cari_firmaTelefon']);
        }        
        $this->db->order_by('potansiyel_cari_id', 'DESC');
        $result = $this->db->get()->result();
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

    // İllegal Hazırla sayfası
    public function illegal_hazirla() {
        // Gerekli verileri view'e gönder
        $this->load->database();
        $data = array();        $data['sezonlar'] = $this->db->get('sezonlar')->result();
        $data['cariGruplar'] = $this->db->select('potansiyel_cari_grup')->distinct()->from('potansiyel_cari')->where('potansiyel_cari_grup IS NOT NULL')->get()->result();
        $data['sektorler'] = $this->db->get('sektorler')->result();
        
        $data['iller'] = $this->db->get('iller')->result();
        $data['ilceler'] = $this->db->get('ilceler')->result();
        $this->load->view('illegal/illegal_hazirla', $data);
    }

    // İllegal Listele sayfası
    public function illegal_listele() {
        // Potansiyel satışları, ilgili cari adını, durum adını ve işlemi yapan kullanıcı adını çek
        $this->db->select('ps.*, pc.potansiyel_cari_ad, pd.Durum_Adi as durum_adi, CONCAT(k.kullanici_ad, " ", k.kullanici_soyad) as islemi_yapan_ad');
        $this->db->from('potansiyel_satis ps');
        $this->db->join('potansiyel_cari pc', 'ps.potansiyel_cari_id = pc.id', 'left');
        $this->db->join('potansiyel_durumlar pd', 'ps.durum_id = pd.id', 'left');
        $this->db->join('kullanicilar k', 'ps.islemi_yapan = k.kullanici_id', 'left');
        $potansiyel_satislar = $this->db->get()->result();
        $this->load->view('illegal/illegal_listele', [
            'potansiyel_satislar' => $potansiyel_satislar
        ]);
    }

    // İllegal Ayarları sayfası
    public function illegal_ayar() {
        $this->load->view('illegal/illegal_ayar');
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
        $this->db->where('potansiyel_cari_firmaTelefon !=', '');
        $this->db->distinct();
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
    }

    // Potansiyel Satış Ekle
    public function potansiyel_satis_ekle() {
        $control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id ?? 1;
        
        $data = [
            'potansiyel_cari_id' => $this->input->post('potansiyel_cari_id'),
            'durum_id' => $this->input->post('durum_id'),
            'fiyat1' => $this->input->post('fiyat1'),
            'fiyat2' => $this->input->post('fiyat2'),
            'fiyat3' => $this->input->post('fiyat3'),
            'aciklama' => $this->input->post('aciklama'),
            'islemi_yapan' => $u_id,
            'islem_tarihi' => date('Y-m-d H:i:s')
        ];
        
        if ($this->db->insert('potansiyel_satis', $data)) {
            $this->session->set_flashdata('success', 'Potansiyel satış başarıyla eklendi.');
        } else {
            $this->session->set_flashdata('error', 'Potansiyel satış eklenirken hata oluştu.');
        }
        
        redirect('illegal/illegal_listele');
    }

    // Test endpoint for potansiyel_cari table structure
    public function test_potansiyel_cari_structure() {
        $query = $this->db->query('DESCRIBE potansiyel_cari');
        $fields = $query->result_array();
        echo json_encode($fields);
        die;
    }
}
