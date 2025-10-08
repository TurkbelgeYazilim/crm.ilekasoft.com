<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * SMS Helper
 * 
 * SMS gönderme işlemleri için helper fonksiyonları
 */

if (!function_exists('send_sms')) {
    /**
     * SMS Gönderme Fonksiyonu
     * 
     * @param string $message Gönderilecek mesaj
     * @param mixed $numbers Telefon numarası veya numaralar (string veya array)
     * @param string $schedule_date Zamanlanmış gönderim tarihi (opsiyonel)
     * @return array Sonuç array'i
     */
    function send_sms($message, $numbers, $schedule_date = '') {
        // CI instance'ını al
        $CI = &get_instance();
        
        // SMS konfigürasyonunu yükle
        $CI->config->load('sms');
        
        // Telefon numaralarını düzenle
        if (is_array($numbers)) {
            $numbers = implode(',', $numbers);
        }
        
        // Telefon numaralarından başındaki 0'ı kaldır ve +90 ekle
        $numbers = preg_replace('/^0/', '', $numbers);
        $numbers = preg_replace('/(\d{10})/', '90$1', $numbers);
        
        // XML Body oluştur
        $xml_body = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml_body .= '<MainmsgBody>' . "\n";
        $xml_body .= '    <UserName>' . $CI->config->item('sms_username') . '</UserName>' . "\n";
        $xml_body .= '    <PassWord>' . $CI->config->item('sms_password') . '</PassWord>' . "\n";
        $xml_body .= '    <Action>' . $CI->config->item('sms_action') . '</Action>' . "\n";
        $xml_body .= '    <Mesgbody>' . htmlspecialchars($message) . '</Mesgbody>' . "\n";
        $xml_body .= '    <Numbers>' . $numbers . '</Numbers>' . "\n";
        $xml_body .= '    <Originator>' . $CI->config->item('sms_originator') . '</Originator>' . "\n";
        $xml_body .= '    <SDate>' . $schedule_date . '</SDate>' . "\n";
        $xml_body .= '</MainmsgBody>';
        
        // CURL ile API'ye istek gönder
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $CI->config->item('sms_api_url'));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml_body);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: text/xml',
            'Content-Length: ' . strlen($xml_body)
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, $CI->config->item('sms_timeout'));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        
        curl_close($ch);
        
        // Sonucu döndür
        return array(
            'success' => ($http_code == 200 && empty($error)),
            'response' => $response,
            'http_code' => $http_code,
            'error' => $error,
            'sent_data' => $xml_body
        );
    }
}

if (!function_exists('format_phone_number')) {
    /**
     * Telefon numarasını SMS için uygun formata çevir
     * 
     * @param string $phone Telefon numarası
     * @return string Formatlanmış telefon numarası
     */
    function format_phone_number($phone) {
        // Sadece rakamları al
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Başındaki 0'ı kaldır
        $phone = ltrim($phone, '0');
        
        // Başında 90 yoksa ekle
        if (substr($phone, 0, 2) !== '90') {
            $phone = '90' . $phone;
        }
        
        return $phone;
    }
}

if (!function_exists('validate_phone_number')) {
    /**
     * Telefon numarasının geçerli olup olmadığını kontrol et
     * 
     * @param string $phone Telefon numarası
     * @return boolean
     */
    function validate_phone_number($phone) {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        
        // Türkiye telefon numarası formatını kontrol et
        if (preg_match('/^(0?5\d{9}|905\d{9})$/', $phone)) {
            return true;
        }
        
        return false;
    }
}
