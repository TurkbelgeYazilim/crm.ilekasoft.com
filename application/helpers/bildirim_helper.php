<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Destek Bildirim Helper Functions
 * Destek sistemi için bildirim işlevlerini yönetir
 */

/**
 * Kullanıcıya bildirim gönder
 * @param int $kullanici_id Bildirim gönderilecek kullanıcı ID
 * @param string $tip Bildirim tipi (destek_yanit, destek_durum, vb.)
 * @param string $baslik Bildirim başlığı
 * @param string $mesaj Bildirim mesajı
 * @param string $link Bildirim linki (opsiyonel)
 * @param int $referans_id Referans ID (opsiyonel)
 * @return bool
 */
function bildirim_gonder($kullanici_id, $tip, $baslik, $mesaj, $link = null, $referans_id = null) {
    $CI =& get_instance();
    
    $data = array(
        'bildirim_kullanici_id' => $kullanici_id,
        'bildirim_tip' => $tip,
        'bildirim_baslik' => $baslik,
        'bildirim_mesaj' => $mesaj,
        'bildirim_link' => $link,
        'bildirim_referans_id' => $referans_id,
        'bildirim_okundu' => 0,
        'bildirim_tarih' => date('Y-m-d H:i:s')
    );
    
    return $CI->vt->insert('kullanici_bildirim', $data);
}

/**
 * Kullanıcının okunmamış bildirimlerini getir
 * @param int $kullanici_id Kullanıcı ID
 * @param int $limit Limit (varsayılan: 10)
 * @return array
 */
function okunmamis_bildirimler($kullanici_id, $limit = 10) {
    $CI =& get_instance();
    
    $query = $CI->db->query("
        SELECT * FROM kullanici_bildirim 
        WHERE bildirim_kullanici_id = ? AND bildirim_okundu = 0 
        ORDER BY bildirim_tarih DESC 
        LIMIT ?
    ", array($kullanici_id, $limit));
    
    return $query->result();
}

/**
 * Kullanıcının okunmamış bildirim sayısını getir
 * @param int $kullanici_id Kullanıcı ID
 * @return int
 */
function okunmamis_bildirim_sayisi($kullanici_id) {
    $CI =& get_instance();
    
    $query = $CI->db->query("
        SELECT COUNT(*) as toplam FROM kullanici_bildirim 
        WHERE bildirim_kullanici_id = ? AND bildirim_okundu = 0
    ", array($kullanici_id));
    
    $result = $query->row();
    return $result ? $result->toplam : 0;
}

/**
 * Bildirimi okundu olarak işaretle
 * @param int $bildirim_id Bildirim ID
 * @param int $kullanici_id Kullanıcı ID (güvenlik için)
 * @return bool
 */
function bildirim_okundu_isaretle($bildirim_id, $kullanici_id) {
    $CI =& get_instance();
    
    $data = array('bildirim_okundu' => 1);
    $where = array('bildirim_id' => $bildirim_id, 'bildirim_kullanici_id' => $kullanici_id);
    
    return $CI->vt->update('kullanici_bildirim', $where, $data);
}

/**
 * Belirli bir destek talebindeki okunmamış yanıtları getir
 * @param int $destek_id Destek ID
 * @param int $kullanici_id Kullanıcı ID
 * @return array
 */
function okunmamis_destek_yanitlari($destek_id, $kullanici_id) {
    $CI =& get_instance();
    
    $query = $CI->db->query("
        SELECT dy.*, CONCAT(k.kullanici_ad, ' ', k.kullanici_soyad) as kullanici_adsoyad 
        FROM destek_yanit dy
        LEFT JOIN kullanicilar k ON dy.dyanit_yanitlayan = k.kullanici_id
        WHERE dy.dyanit_destekID = ? 
        AND dy.dyanit_yanitlayan != ?
        AND (dy.dyanit_isRead = 0 OR dy.dyanit_isRead IS NULL)
        ORDER BY dy.dyanit_tarih DESC
    ", array($destek_id, $kullanici_id));
    
    return $query->result();
}

/**
 * Destek yanıtını okundu olarak işaretle
 * @param int $yanit_id Yanıt ID
 * @param int $kullanici_id Kullanıcı ID
 * @return bool
 */
function destek_yanit_okundu_isaretle($yanit_id, $kullanici_id) {
    $CI =& get_instance();
    
    // Önce yanıtın bu kullanıcıya ait olmadığını kontrol et
    $query = $CI->db->query("
        SELECT dy.dyanit_yanitlayan, d.destek_olusturan 
        FROM destek_yanit dy 
        JOIN destek d ON dy.dyanit_destekID = d.destek_id 
        WHERE dy.dyanit_id = ?
    ", array($yanit_id));
    
    $result = $query->row();
    if($result && ($result->destek_olusturan == $kullanici_id || $result->dyanit_yanitlayan != $kullanici_id)) {
        $data = array('dyanit_isRead' => 1);
        $where = array('dyanit_id' => $yanit_id);
        return $CI->vt->update('destek_yanit', $where, $data);
    }
    
    return false;
}

/**
 * Destek talebindeki okunmamış yanıt sayısını güncelle
 * @param int $destek_id Destek ID
 * @return bool
 */
function destek_okunmamis_yanit_sayisi_guncelle($destek_id) {
    $CI =& get_instance();
    
    // Okunmamış yanıt sayısını hesapla
    $query = $CI->db->query("
        SELECT COUNT(*) as toplam FROM destek_yanit 
        WHERE dyanit_destekID = ? AND (dyanit_isRead = 0 OR dyanit_isRead IS NULL)
    ", array($destek_id));
    
    $result = $query->row();
    $okunmamis_sayi = $result ? $result->toplam : 0;
    
    // Destek tablosunu güncelle
    $data = array('destek_unreadReplies' => $okunmamis_sayi);
    $where = array('destek_id' => $destek_id);
    
    return $CI->vt->update('destek', $where, $data);
}

/**
 * Destek talebi için e-posta bildirimi gönder
 * @param int $destek_id Destek ID
 * @param string $tip Bildirim tipi (yeni_yanit, durum_degisti, vb.)
 * @param string $ek_mesaj Ek mesaj
 * @return bool
 */
function destek_eposta_bildirim_gonder($destek_id, $tip, $ek_mesaj = '') {
    $CI =& get_instance();
    
    // Destek talebini ve sahibini getir - Fixed for kullanici_adsoyad error
    $query = $CI->db->query("
        SELECT d.*, CONCAT(k.kullanici_ad, ' ', k.kullanici_soyad) as kullanici_adsoyad, k.kullanici_eposta 
        FROM destek d
        LEFT JOIN kullanicilar k ON d.destek_olusturan = k.kullanici_id
        WHERE d.destek_id = ?
    ", array($destek_id));
    
    $destek = $query->row();
    if(!$destek) return false;
    
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
    
    $CI->load->library('email', $mail_config);
    $CI->email->set_newline("\r\n");
    
    $konu = '';
    $mesaj = '';
    
    switch($tip) {
        case 'yeni_yanit':
            $konu = 'Destek Talebinize Yanıt Geldi - #' . $destek->destek_id;
            $mesaj = "
                <h3>Destek Talebinize Yanıt Geldi</h3>
                <p><strong>Talep ID:</strong> #{$destek->destek_id}</p>
                <p><strong>Konu:</strong> {$destek->destek_title}</p>
                <p><strong>Tarih:</strong> " . date('d.m.Y H:i') . "</p>
                <p>{$ek_mesaj}</p>
                <p><a href='" . base_url("destek/detay/{$destek->destek_id}") . "'>Yanıtı Görüntüle</a></p>
            ";
            break;
        case 'durum_degisti':
            $konu = 'Destek Talebinizin Durumu Değişti - #' . $destek->destek_id;
            $mesaj = "
                <h3>Destek Talebinizin Durumu Değişti</h3>
                <p><strong>Talep ID:</strong> #{$destek->destek_id}</p>
                <p><strong>Konu:</strong> {$destek->destek_title}</p>
                <p><strong>Yeni Durum:</strong> {$ek_mesaj}</p>
                <p><strong>Tarih:</strong> " . date('d.m.Y H:i') . "</p>
                <p><a href='" . base_url("destek/detay/{$destek->destek_id}") . "'>Talebi Görüntüle</a></p>
            ";
            break;
    }
    
    $CI->email->to($destek->kullanici_eposta);
    $CI->email->from("ticket@ilekasoft.com", "ilekasoft.com Destek");
    $CI->email->subject($konu);
    $CI->email->message($mesaj);
    
    return $CI->email->send();
}
?>
