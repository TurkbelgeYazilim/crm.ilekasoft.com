<?php
// filepath: application/controllers/Tahsilat.php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahsilat extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('vt');
        // Giriş kontrolü (örnek)
        $control = session('r', 'login');
        if (!$control) {
            redirect('check');
        }
    }    public function tahsilat_kaydet() {
        // Formdan gelen veriler
        $cari_id = $this->input->post('cari_id');
        $tahsilat_cariKodu = $this->input->post('tahsilat_cariKodu');
        $tahsilat_cariAdi = $this->input->post('tahsilat_cariAdi');
        $tahsilat_odemeTipi = $this->input->post('tahsilat_odemeTipi');
        $tahsilat_kasaID = $this->input->post('tahsilat_kasaID');
        $tahsilat_bankaID = $this->input->post('tahsilat_bankaID');
        $tahsilat_tarih = $this->input->post('tahsilat_tarih');
        $tahsilat_tutar = $this->input->post('tahsilat_tutar');
        $tahsilat_aciklama = $this->input->post('tahsilat_aciklama');

        // Validasyon kontrolleri
        if (!$cari_id) {
            $this->session->set_flashdata('tahsilat_hata', 'Lütfen geçerli bir cari seçiniz.');
            redirect('tahsilat/tahsilat-olustur');
            return;
        }

        if (!$tahsilat_odemeTipi) {
            $this->session->set_flashdata('tahsilat_hata', 'Lütfen ödeme türü seçiniz.');
            redirect('tahsilat/tahsilat-olustur');
            return;
        }

        if ($tahsilat_odemeTipi == 1 && !$tahsilat_kasaID) {
            $this->session->set_flashdata('tahsilat_hata', 'Kasa ödemesi için lütfen kasa seçiniz.');
            redirect('tahsilat/tahsilat-olustur');
            return;
        }        if ($tahsilat_odemeTipi == 2 && !$tahsilat_bankaID) {
            $this->session->set_flashdata('tahsilat_hata', 'Banka ödemesi için lütfen banka seçiniz.');
            redirect('tahsilat/tahsilat-olustur');
            return;
        }
        
        if ($tahsilat_odemeTipi == 5 && !$tahsilat_bankaID) {
            $this->session->set_flashdata('tahsilat_hata', 'Pos ödemesi için lütfen banka seçiniz.');
            redirect('tahsilat/tahsilat-olustur');
            return;
        }// Çek ödemesi validasyonu
        if ($tahsilat_odemeTipi == 3) {
            $cek_bankaID = $this->input->post('cek_bankaID');
            $cek_bankaSube = $this->input->post('cek_bankaSube');

            if (!$cek_bankaID || !$cek_bankaSube) {
                $this->session->set_flashdata('tahsilat_hata', 'Çek ödemesi için çek bankası ve banka şubesi bilgilerini doldurunuz.');
                redirect('tahsilat/tahsilat-olustur');
                return;
            }
        }

        // Senet ödemesi validasyonu
        if ($tahsilat_odemeTipi == 4) {
            $senet_tutar = $this->input->post('senet_tutar');
            $senet_vade = $this->input->post('senet_vade');

            // En az bir senet girişinin dolu olduğunu kontrol et
            $valid_senet_count = 0;
            if ($senet_tutar && $senet_vade) {
                for ($i = 0; $i < count($senet_tutar); $i++) {
                    if (!empty($senet_tutar[$i]) && !empty($senet_vade[$i])) {
                        $valid_senet_count++;
                    }
                }
            }

            if ($valid_senet_count == 0) {
                $this->session->set_flashdata('tahsilat_hata', 'Senet ödemesi için en az bir senet bilgisi giriniz (tutar ve vade tarihi).');
                redirect('tahsilat/tahsilat-olustur');
                return;
            }
        }

        // Ana tutar alanı validasyonu (Senet ödemesi dışında zorunlu)
        if ($tahsilat_odemeTipi != 4 && (empty($tahsilat_tutar) || $tahsilat_tutar <= 0)) {
            $this->session->set_flashdata('tahsilat_hata', 'Lütfen geçerli bir tutar giriniz.');
            redirect('tahsilat/tahsilat-olustur');
            return;
        }

        // Get user and company info
        $control2 = session("r", "login_info");
        $u_id = $control2->kullanici_id;
        $anaHesap = anaHesapBilgisi();
        
        // Tarihi formatla
        $tarih_parts = explode('.', $tahsilat_tarih);
        if (count($tarih_parts) == 3) {
            $formatted_tarih = $tarih_parts[2] . '-' . $tarih_parts[1] . '-' . $tarih_parts[0];
        } else {
            $formatted_tarih = date('Y-m-d');
        }

        // Generate unique document number
        $belge_no = 'THS-' . date('Ymd') . '-' . time();        try {
            $this->db->trans_start();            // Insert into appropriate movement table based on payment type
            if ($tahsilat_odemeTipi == 1) { // Kasa
                $kasa_data = [
                    'kh_kasaID' => $tahsilat_kasaID,
                    'kh_cariID' => $cari_id,
                    'kh_tarih' => $formatted_tarih,
                    'kh_giris' => $tahsilat_tutar, // Tahsilat için giriş alanını kullan
                    'kh_turu' => 8, // Tahsilat türü
                    'kh_aciklama' => $tahsilat_aciklama,
                    'kh_belgeNumarasi' => $belge_no,
                    'kh_olusturan' => $u_id,
                    'kh_olusturanAnaHesap' => $anaHesap,
                    'kh_olusturmaTarihi' => date('Y-m-d'),
                    'kh_olusturmaSaati' => date('H:i:s')
                ];
                $this->db->insert('kasaHareketleri', $kasa_data);            } elseif ($tahsilat_odemeTipi == 2) { // Banka
                // Banka dosya yükleme işlemi
                $uploaded_file_name = null;
                if (isset($_FILES['banka_gorsel']) && !empty($_FILES['banka_gorsel']['name'])) {
                    $config['upload_path'] = './assets/uploads/dekontlar/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size'] = 5120; // 5MB
                    $config['encrypt_name'] = TRUE;
                    
                    // Upload dizinini kontrol et ve yoksa oluştur
                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0755, true);
                    }
                    
                    $this->load->library('upload', $config);
                    
                    if ($this->upload->do_upload('banka_gorsel')) {
                        $upload_data = $this->upload->data();
                        $uploaded_file_name = $upload_data['file_name'];
                    }
                }

                $banka_data = [
                    'bh_bankaID' => $tahsilat_bankaID,
                    'bh_cariID' => $cari_id,
                    'bh_tarih' => $formatted_tarih,
                    'bh_giris' => $tahsilat_tutar, // Gelen havale/EFT için giris alanını kullan
                    'bh_turu' => 1, // Gelen Havale/EFT türü
                    'bh_aciklama' => $tahsilat_aciklama,
                    'bh_belgeNumarasi' => $belge_no,
                    'bh_gorsel' => $uploaded_file_name, // Yüklenen dosya adı
                    'bh_olusturan' => $u_id,
                    'bh_olusturanAnaHesap' => $anaHesap,
                    'bh_olusturmaTarihi' => date('Y-m-d'),
                    'bh_olusturmaSaati' => date('H:i:s')
                ];
                $this->db->insert('bankaHareketleri', $banka_data);
                  } elseif ($tahsilat_odemeTipi == 3) { // Çek
                // Çek bilgilerini al
                $cek_bankaID = $this->input->post('cek_bankaID');
                $cek_bankaSube = $this->input->post('cek_bankaSube');

                // Çek dosya yükleme işlemi
                $uploaded_file_name = null;
                if (isset($_FILES['cek_gorsel']) && !empty($_FILES['cek_gorsel']['name'])) {
                    $config['upload_path'] = './assets/uploads/cekler/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size'] = 5120; // 5MB
                    $config['encrypt_name'] = TRUE;
                    
                    // Upload dizinini kontrol et ve yoksa oluştur
                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0755, true);
                    }
                    
                    $this->load->library('upload', $config);
                    
                    if ($this->upload->do_upload('cek_gorsel')) {
                        $upload_data = $this->upload->data();
                        $uploaded_file_name = $upload_data['file_name'];
                    }
                }

                // Çek tablosuna kaydet
                $cek_data = [
                    'cek_cariID' => $cari_id,
                    'cek_hareketTipi' => 1, // Alınan çek (sabit)
                    'cek_kayitTarihi' => $formatted_tarih,
                    'cek_notAciklama' => $tahsilat_aciklama,
                    'cek_portfoyNo' => $belge_no, // Belge numarasını portföy no olarak kullan
                    'cek_seriNo' => 'CHK-' . time(), // Otomatik seri no
                    'cek_borcluID' => $cari_id, // Çeki veren kişi (tahsilat yapılan cari)
                    'cek_vadeTarih' => $formatted_tarih, // Tahsilat tarihi ile aynı
                    'cek_bankaID' => $cek_bankaID,
                    'cek_bankaSube' => $cek_bankaSube,
                    'cek_tutar' => $tahsilat_tutar,
                    'cek_gorsel' => $uploaded_file_name, // Yüklenen dosya adı
                    'cek_durum' => 0, // Aktif durum
                    'cek_kullaniciID' => $u_id,
                    'cek_olusturanAnaHesap' => $anaHesap,
                    'cek_sistemKayitTarihi' => date('Y-m-d'),
                    'cek_sistemKayitSaati' => date('H:i:s')                ];
                $this->db->insert('cek', $cek_data);
                  } elseif ($tahsilat_odemeTipi == 4) { // Senet
                // Senet kontrol bilgilerini al
                $senet_birim_tutari = $this->input->post('senet_tutari');
                $senet_adedi = $this->input->post('senet_adedi'); 
                $senet_ilk_vade = $this->input->post('senet_vade_tarihi');
                
                // Dinamik senet bilgilerini al
                $senet_tutar_array = $this->input->post('senet_tutar');
                $senet_vade_array = $this->input->post('senet_vade');

                // Validasyon: Kontrol alanları dolu olmalı
                if (empty($senet_birim_tutari) || empty($senet_adedi) || empty($senet_ilk_vade)) {
                    $this->session->set_flashdata('tahsilat_hata', 'Senet bilgileri eksik. Senet tutarı, adedi ve vade tarihi gereklidir.');
                    redirect(base_url() . 'tahsilat/olustur');
                    return;
                }

                // Validasyon: Senet adedi makul sınırlar içinde olmalı
                if ($senet_adedi < 1 || $senet_adedi > 10) {
                    $this->session->set_flashdata('tahsilat_hata', 'Senet adedi 1-10 arasında olmalıdır.');
                    redirect(base_url() . 'tahsilat/olustur');
                    return;
                }                // Her bir senet için kayıt yap
                if ($senet_tutar_array && $senet_vade_array && count($senet_tutar_array) == $senet_adedi) {
                    for ($i = 0; $i < count($senet_tutar_array); $i++) {
                        if (!empty($senet_tutar_array[$i]) && !empty($senet_vade_array[$i])) {
                            // Vade tarihini formatla
                            $vade_parts = explode('.', $senet_vade_array[$i]);
                            if (count($vade_parts) == 3) {
                                $formatted_vade = $vade_parts[2] . '-' . $vade_parts[1] . '-' . $vade_parts[0];
                            } else {
                                $formatted_vade = date('Y-m-d');
                            }

                            // Dosya yükleme işlemi
                            $uploaded_file_name = null;
                            if (isset($_FILES['senet_gorsel']['name'][$i]) && !empty($_FILES['senet_gorsel']['name'][$i])) {
                                $config['upload_path'] = './assets/uploads/senetler/';
                                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                                $config['max_size'] = 5120; // 5MB
                                $config['encrypt_name'] = TRUE;
                                
                                // Upload dizinini kontrol et ve yoksa oluştur
                                if (!is_dir($config['upload_path'])) {
                                    mkdir($config['upload_path'], 0755, true);
                                }
                                
                                $this->load->library('upload', $config);
                                
                                // Tek dosya upload için $_FILES'ı düzenle
                                $_FILES['senet_file']['name'] = $_FILES['senet_gorsel']['name'][$i];
                                $_FILES['senet_file']['type'] = $_FILES['senet_gorsel']['type'][$i];
                                $_FILES['senet_file']['tmp_name'] = $_FILES['senet_gorsel']['tmp_name'][$i];
                                $_FILES['senet_file']['error'] = $_FILES['senet_gorsel']['error'][$i];
                                $_FILES['senet_file']['size'] = $_FILES['senet_gorsel']['size'][$i];
                                
                                if ($this->upload->do_upload('senet_file')) {
                                    $upload_data = $this->upload->data();
                                    $uploaded_file_name = $upload_data['file_name'];
                                }
                            }

                            // Senet tablosuna kaydet
                            $senet_data = [
                                'senet_cariID' => $cari_id,
                                'senet_hareketTipi' => 1, // Alınan senet (sabit)
                                'senet_kayitTarihi' => $formatted_tarih,
                                'senet_notAciklama' => $tahsilat_aciklama . ' - Senet ' . ($i + 1) . '/' . $senet_adedi,
                                'senet_portfoyNo' => $belge_no . '-S' . ($i + 1), // Belge numarası + senet sırası
                                'senet_seriNo' => 'SNT-' . time() . '-' . ($i + 1), // Otomatik seri no
                                'senet_borcluID' => $cari_id, // Senedi veren kişi (tahsilat yapılan cari)
                                'senet_vadeTarih' => $formatted_vade,
                                'senet_tutar' => $senet_tutar_array[$i],
                                'senet_gorsel' => $uploaded_file_name, // Yüklenen dosya adı
                                'senet_durum' => 0, // Aktif durum
                                'senet_kullaniciID' => $u_id,
                                'senet_olusturanAnaHesap' => $anaHesap,
                                'senet_sistemKayitTarihi' => date('Y-m-d'),
                                'senet_sistemKayitSaati' => date('H:i:s')
                            ];                            $this->db->insert('senet', $senet_data);
                        }
                    }
                } else {
                    $this->session->set_flashdata('tahsilat_hata', 'Senet detay bilgileri eksik veya tutarsız.');
                    redirect(base_url() . 'tahsilat/olustur');
                    return;
                }
                  } elseif ($tahsilat_odemeTipi == 5) { // Pos
                // Pos dosya yükleme işlemi
                $uploaded_file_name = null;
                if (isset($_FILES['pos_gorsel']) && !empty($_FILES['pos_gorsel']['name'])) {
                    $config['upload_path'] = './assets/uploads/fisler/';
                    $config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
                    $config['max_size'] = 5120; // 5MB
                    $config['encrypt_name'] = TRUE;
                    
                    // Upload dizinini kontrol et ve yoksa oluştur
                    if (!is_dir($config['upload_path'])) {
                        mkdir($config['upload_path'], 0755, true);
                    }
                    
                    $this->load->library('upload', $config);
                    
                    if ($this->upload->do_upload('pos_gorsel')) {
                        $upload_data = $this->upload->data();
                        $uploaded_file_name = $upload_data['file_name'];
                    }
                }

                $banka_data = [
                    'bh_bankaID' => $tahsilat_bankaID,
                    'bh_cariID' => $cari_id,
                    'bh_tarih' => $formatted_tarih,
                    'bh_giris' => $tahsilat_tutar, // Pos ödemesi için giris alanını kullan
                    'bh_turu' => 15, // POS Gelirleri (yeni tür)
                    'bh_aciklama' => $tahsilat_aciklama,
                    'bh_belgeNumarasi' => $belge_no,
                    'bh_gorsel' => $uploaded_file_name, // Yüklenen dosya adı
                    'bh_olusturan' => $u_id,
                    'bh_olusturanAnaHesap' => $anaHesap,
                    'bh_olusturmaTarihi' => date('Y-m-d'),
                    'bh_olusturmaSaati' => date('H:i:s')
                ];
                $this->db->insert('bankaHareketleri', $banka_data);}            // Calculate total amount based on payment type
            $total_amount = $tahsilat_tutar; // Default to main amount field
            
            // For Senet payments, calculate total from individual senet amounts
            if ($tahsilat_odemeTipi == 4) {
                $total_amount = 0;
                $senet_tutar_array = $this->input->post('senet_tutar');
                if ($senet_tutar_array && is_array($senet_tutar_array)) {
                    foreach ($senet_tutar_array as $tutar) {
                        if (!empty($tutar) && is_numeric($tutar)) {
                            $total_amount += floatval($tutar);
                        }
                    }
                }
                  // Tahsilat tutarını senet toplamı ile güncelle
                $tahsilat_tutar = $total_amount;
            }            // Update cari balance (if cari hareketleri table exists)
            $cari_data = [
                'ch_cariID' => $cari_id,
                'ch_tarih' => $formatted_tarih,
                'ch_alacak' => $total_amount, // Use calculated total amount
                'ch_turu' => $tahsilat_odemeTipi == 3 ? 8 : ($tahsilat_odemeTipi == 4 ? 9 : ($tahsilat_odemeTipi == 5 ? 10 : 7)), // 8: Alınan çek, 9: Alınan senet, 10: Pos tahsilatı, 7: Tahsilat
                'ch_aciklama' => $tahsilat_aciklama,
                'ch_belgeNumarasi' => $belge_no,
                'ch_olusturan' => $u_id,
                'ch_olusturanAnaHesap' => $anaHesap,
                'ch_olusturmaTarihi' => date('Y-m-d'),
                'ch_olusturmaSaati' => date('H:i:s')
            ];
            
            // Check if cariHareketleri table exists
            if ($this->db->table_exists('cariHareketleri')) {
                $this->db->insert('cariHareketleri', $cari_data);
            }

            $this->db->trans_complete();            if ($this->db->trans_status() === FALSE) {
                if ($tahsilat_odemeTipi == 3) {
                    $this->session->set_flashdata('tahsilat_hata', 'Çek kaydedilirken bir hata oluştu.');
                } elseif ($tahsilat_odemeTipi == 5) {
                    $this->session->set_flashdata('tahsilat_hata', 'Pos tahsilatı kaydedilirken bir hata oluştu.');
                } else {
                    $this->session->set_flashdata('tahsilat_hata', 'Tahsilat kaydedilirken bir hata oluştu.');
                }
            } else {
                if ($tahsilat_odemeTipi == 3) {
                    $this->session->set_flashdata('tahsilat_ok', 'Çek başarıyla kaydedildi.');
                } elseif ($tahsilat_odemeTipi == 5) {
                    $this->session->set_flashdata('tahsilat_ok', 'Pos tahsilatı başarıyla kaydedildi.');
                } else {
                    $this->session->set_flashdata('tahsilat_ok', 'Tahsilat başarıyla kaydedildi.');
                }
            }

        } catch (Exception $e) {
            $this->session->set_flashdata('tahsilat_hata', 'Tahsilat kaydedilirken bir hata oluştu: ' . $e->getMessage());
        }

        redirect('tahsilat/tahsilat-olustur');
    }    public function tahsilat_olustur() {
        // Get current user's ID
        $control2 = session("r", "login_info");
        $kullanici_id = $control2->kullanici_id;
        $u_id = $kullanici_id;
        
        // Format user ID with leading zeros (e.g., 187 -> 0187)
        $formatted_user_id = str_pad($kullanici_id, 4, '0', STR_PAD_LEFT);
        
        // Create kasa code pattern: KASA-0187
        $user_kasa_code = 'KASA-' . $formatted_user_id;
          // Find user's default kasa ID by matching the kasa code
        $user_default_kasa_id = null;
        $vaults = getVaultsofCompany();
          if ($vaults) {
            foreach ($vaults as $vault) {
                if ($vault->kasa_kodu === $user_kasa_code) {
                    $user_default_kasa_id = $vault->kasa_id;
                    break;
                }
            }        }
        
        // Pass data to view
        $data['baslik'] = 'Tahsilat / Tahsilat Oluştur';
        $data['user_default_kasa_id'] = $user_default_kasa_id;
        
        // Add permission variables for sidebar
        // Cari permissions
        // $data['yetkiSorgul1_cari'] = yetkiSorgula($u_id, 1, 1);
        // $data['yetkiSorgul2_cari'] = yetkiSorgula($u_id, 1, 2);
        // $data['yetkiSorgul3_cari'] = yetkiSorgula($u_id, 1, 3);
        // $data['yetkiSorgul4_cari'] = yetkiSorgula($u_id, 1, 4);
        // $data['yetkiSorgul5_cari'] = yetkiSorgula($u_id, 1, 5);
        // $data['yetkiSorgul6_cari'] = yetkiSorgula($u_id, 1, 6);
        // $data['yetkiSorgul7_cari'] = yetkiSorgula($u_id, 1, 7);
        // $data['yetkiSorgul8_cari'] = yetkiSorgula($u_id, 1, 8);
        // $data['yetkiSorgul9_cari'] = yetkiSorgula($u_id, 1, 9);
        // Stok permissions
        // $data['yetkiSorgul1_stok'] = yetkiSorgula($u_id, 2, 1);
        // $data['yetkiSorgul2_stok'] = yetkiSorgula($u_id, 2, 2);
        // $data['yetkiSorgul3_stok'] = yetkiSorgula($u_id, 2, 3);
        // $data['yetkiSorgul4_stok'] = yetkiSorgula($u_id, 2, 4);
        // $data['yetkiSorgul5_stok'] = yetkiSorgula($u_id, 2, 5);
        // $data['yetkiSorgul6_stok'] = yetkiSorgula($u_id, 2, 6);
        // $data['yetkiSorgul7_stok'] = yetkiSorgula($u_id, 2, 7);
        // Fatura permissions
        // $data['yetkiSorgul1_fatura'] = yetkiSorgula($u_id, 3, 1);
        // $data['yetkiSorgul2_fatura'] = yetkiSorgula($u_id, 3, 2);
        // $data['yetkiSorgul3_fatura'] = yetkiSorgula($u_id, 3, 3);
        // $data['yetkiSorgul4_fatura'] = yetkiSorgula($u_id, 3, 4);
        // $data['yetkiSorgul5_fatura'] = yetkiSorgula($u_id, 3, 5);
        // $data['yetkiSorgul6_fatura'] = yetkiSorgula($u_id, 3, 6);
        // $data['yetkiSorgul7_efatura'] = yetkiSorgula($u_id, 3, 7);
        // $data['yetkiSorgul8_earsiv'] = yetkiSorgula($u_id, 3, 8);
        // Kasa permissions
        // $data['yetkiSorgul1_kasa'] = yetkiSorgula($u_id, 4, 1);
        // $data['yetkiSorgul2_kasa'] = yetkiSorgula($u_id, 4, 2);
        // $data['yetkiSorgul3_kasa'] = yetkiSorgula($u_id, 4, 3);
        // $data['yetkiSorgul4_kasa'] = yetkiSorgula($u_id, 4, 4);
        // $data['yetkiSorgul5_kasa'] = yetkiSorgula($u_id, 4, 5);
        // $data['yetkiSorgul6_kasa'] = yetkiSorgula($u_id, 4, 6);
        // $data['yetkiSorgul7_kasa'] = yetkiSorgula($u_id, 4, 7);
        // $data['yetkiSorgul8_kasa'] = yetkiSorgula($u_id, 4, 8);
        // $data['yetkiSorgul9_kasa'] = yetkiSorgula($u_id, 4, 9);
        // $data['yetkiSorgul10_kasa'] = yetkiSorgula($u_id, 4, 10);
        // $data['yetkiSorgul11_kasa'] = yetkiSorgula($u_id, 4, 11);
        // $data['yetkiSorgul12_kasa'] = yetkiSorgula($u_id, 4, 12);
        // Banka permissions
        // $data['yetkiSorgul1_banka'] = yetkiSorgula($u_id, 5, 1);
        // $data['yetkiSorgul2_banka'] = yetkiSorgula($u_id, 5, 2);
        // $data['yetkiSorgul3_banka'] = yetkiSorgula($u_id, 5, 3);
        // $data['yetkiSorgul4_banka'] = yetkiSorgula($u_id, 5, 4);
        // $data['yetkiSorgul5_banka'] = yetkiSorgula($u_id, 5, 5);
        // $data['yetkiSorgul6_banka'] = yetkiSorgula($u_id, 5, 6);
        // $data['yetkiSorgul7_banka'] = yetkiSorgula($u_id, 5, 7);
        // $data['yetkiSorgul8_banka'] = yetkiSorgula($u_id, 5, 8);
        // $data['yetkiSorgul9_banka'] = yetkiSorgula($u_id, 5, 9);
        // $data['yetkiSorgul10_banka'] = yetkiSorgula($u_id, 5, 10);
        // $data['yetkiSorgul11_banka'] = yetkiSorgula($u_id, 5, 11);
        // $data['yetkiSorgul12_banka'] = yetkiSorgula($u_id, 5, 12);
        // Giderler permissions
        // $data['yetkiSorgul1_giderler'] = yetkiSorgula($u_id, 7, 1);
        // $data['yetkiSorgul2_giderler'] = yetkiSorgula($u_id, 7, 2);
        // $data['yetkiSorgul3_giderler'] = yetkiSorgula($u_id, 7, 3);
        
        $this->load->view('tahsilat/tahsilat-olustur', $data);
    }
}
