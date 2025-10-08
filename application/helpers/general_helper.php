<?php

// Create this file.
// file: application/helpers/general_helper.php

if (!function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);

        if ($value === false) {
            return value($default);
        }

        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return;
        }

        if (($valueLength = strlen($value)) > 1 && $value[0] === '"' && $value[$valueLength - 1] === '"') {
            return substr($value, 1, -1);
        }

        return $value;
    }
}

if (!function_exists('grup_modul_yetkisi_var')) {
    /**
     * Kullanıcının belirli bir modül için yetkisi olup olmadığını kontrol eder
     *
     * @param int $modul_id Kontrol edilecek modül ID'si
     * @param int $yetki Kontrol edilecek yetki seviyesi (default: 1)
     * @return bool
     */
    function grup_modul_yetkisi_var($modul_id, $yetki = 1) {
        // Global değişkeni direkt kullan - sidebar'da zaten yükleniyor
        if (isset($GLOBALS['kullanici_grup_yetkileri'][$modul_id])) {
            return in_array($yetki, $GLOBALS['kullanici_grup_yetkileri'][$modul_id]);
        }
        
        // Eğer global değişken yoksa, database'den çek
        $CI =& get_instance();
        
        // Session'dan kullanıcı grup ID'sini al
        $control = session("r", "login_info");
        if (!$control || !isset($control->grup_id)) {
            return false;
        }
        
        $kullanici_grupID = $control->grup_id;
        
        if ($kullanici_grupID) {
            $yetkilerQ = "SELECT * FROM kullanici_grubu_yetkisi WHERE kgy_grupID = ? AND kgy_modul = ?";
            $yetkilerResult = $CI->db->query($yetkilerQ, array($kullanici_grupID, $modul_id))->result();
            
            foreach ($yetkilerResult as $yetki_item) {
                if ($yetki_item->kgy_yetki == $yetki) {
                    return true;
                }
            }
        }
        
        return false;
    }
}

if (!function_exists('tahsilat_gorsel_path')) {
    /**
     * Get correct image/document path for tahsilat based on payment type
     *
     * @param string $filename - The filename only
     * @param int $tahsilat_tipi - The payment type (1=Banka, 2=Çek, 3=Kasa, 4=Senet)
     * @return string - Full URL to the image/document
     */
    function tahsilat_gorsel_path($filename, $tahsilat_tipi)
    {
        if (empty($filename)) {
            return '';
        }
        
        // Determine subdirectory based on tahsilat_tipi
        $subdirectory = '';
        switch((int)$tahsilat_tipi) {
            case 1: // Banka
                $subdirectory = 'assets/uploads/dekontlar/';
                break;
            case 2: // Çek
                $subdirectory = 'assets/uploads/cekler/';
                break;
            case 4: // Senet
                $subdirectory = 'assets/uploads/senetler/';
                break;
            case 3: // Kasa - nadiren dosya yüklenir
            default:
                // Fallback to dekontlar directory (also includes Banka/POS now)
                $subdirectory = 'assets/uploads/dekontlar/';
                break;
        }
        
        return base_url($subdirectory . $filename);
    }
}
