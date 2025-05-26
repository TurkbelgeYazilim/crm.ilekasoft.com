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
        }        // Çek ödemesi validasyonu
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
        }// Get user and company info
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
                $this->db->insert('kasaHareketleri', $kasa_data);
                  } elseif ($tahsilat_odemeTipi == 2) { // Banka
                $banka_data = [
                    'bh_bankaID' => $tahsilat_bankaID,
                    'bh_cariID' => $cari_id,
                    'bh_tarih' => $formatted_tarih,
                    'bh_giris' => $tahsilat_tutar, // Gelen havale/EFT için giris alanını kullan
                    'bh_turu' => 1, // Gelen Havale/EFT türü
                    'bh_aciklama' => $tahsilat_aciklama,
                    'bh_belgeNumarasi' => $belge_no,
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
                    'cek_durum' => 0, // Aktif durum
                    'cek_kullaniciID' => $u_id,
                    'cek_olusturanAnaHesap' => $anaHesap,
                    'cek_sistemKayitTarihi' => date('Y-m-d'),
                    'cek_sistemKayitSaati' => date('H:i:s')                ];
                $this->db->insert('cek', $cek_data);
                
            } elseif ($tahsilat_odemeTipi == 4) { // Senet
                // Senet bilgilerini al
                $senet_tutar = $this->input->post('senet_tutar');
                $senet_vade = $this->input->post('senet_vade');

                // Her bir senet için kayıt yap
                if ($senet_tutar && $senet_vade) {
                    for ($i = 0; $i < count($senet_tutar); $i++) {
                        if (!empty($senet_tutar[$i]) && !empty($senet_vade[$i])) {
                            // Vade tarihini formatla
                            $vade_parts = explode('.', $senet_vade[$i]);
                            if (count($vade_parts) == 3) {
                                $formatted_vade = $vade_parts[2] . '-' . $vade_parts[1] . '-' . $vade_parts[0];
                            } else {
                                $formatted_vade = date('Y-m-d');
                            }

                            // Senet tablosuna kaydet
                            $senet_data = [
                                'senet_cariID' => $cari_id,
                                'senet_hareketTipi' => 1, // Alınan senet (sabit)
                                'senet_kayitTarihi' => $formatted_tarih,
                                'senet_notAciklama' => $tahsilat_aciklama . ' - Senet ' . ($i + 1),
                                'senet_portfoyNo' => $belge_no . '-S' . ($i + 1), // Belge numarası + senet sırası
                                'senet_seriNo' => 'SNT-' . time() . '-' . ($i + 1), // Otomatik seri no
                                'senet_borcluID' => $cari_id, // Senedi veren kişi (tahsilat yapılan cari)
                                'senet_vadeTarih' => $formatted_vade,
                                'senet_tutar' => $senet_tutar[$i],
                                'senet_durum' => 0, // Aktif durum
                                'senet_kullaniciID' => $u_id,
                                'senet_olusturanAnaHesap' => $anaHesap,
                                'senet_sistemKayitTarihi' => date('Y-m-d'),
                                'senet_sistemKayitSaati' => date('H:i:s')
                            ];
                            $this->db->insert('senet', $senet_data);
                        }
                    }
                }
            }            // Update cari balance (if cari hareketleri table exists)
            $cari_data = [
                'ch_cariID' => $cari_id,
                'ch_tarih' => $formatted_tarih,
                'ch_alacak' => $tahsilat_tutar, // Tahsilat alacak kaydı
                'ch_turu' => $tahsilat_odemeTipi == 3 ? 8 : ($tahsilat_odemeTipi == 4 ? 9 : 7), // 8: Alınan çek, 9: Alınan senet, 7: Tahsilat
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
                } else {
                    $this->session->set_flashdata('tahsilat_hata', 'Tahsilat kaydedilirken bir hata oluştu.');
                }
            } else {
                if ($tahsilat_odemeTipi == 3) {
                    $this->session->set_flashdata('tahsilat_ok', 'Çek başarıyla kaydedildi.');
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
            }
        }
        
        // Pass default kasa ID to view
        $data['user_default_kasa_id'] = $user_default_kasa_id;
        $this->load->view('tahsilat/tahsilat-olustur', $data);
    }
}
