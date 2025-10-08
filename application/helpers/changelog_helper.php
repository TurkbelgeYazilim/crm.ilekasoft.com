<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Changelog Helper
 * 
 * Bu helper dosyası proje versiyonlarını ve değişiklikleri otomatik olarak takip eder.
 */

if (!function_exists('updateChangelog')) {
    /**
     * Changelog'u güncelle
     * 
     * @param string $version Yeni versiyon numarası
     * @param string $title Versiyon başlığı
     * @param array $changes Değişiklikler listesi
     * @param array $files_modified Değiştirilen dosyalar
     * @param bool $db_changes Veritabanı değişikliği var mı?
     * @return bool
     */
    function updateChangelog($version, $title, $changes = [], $files_modified = [], $db_changes = false) {
        $changelog_path = APPPATH . 'config/changelog.json';
        
        try {
            // Mevcut changelog'u oku
            $changelog_data = [];
            if (file_exists($changelog_path)) {
                $changelog_content = file_get_contents($changelog_path);
                $changelog_data = json_decode($changelog_content, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $changelog_data = [];
                }
            }
            
            // Varsayılan yapı oluştur
            if (empty($changelog_data)) {
                $changelog_data = [
                    'app_version' => $version,
                    'last_updated' => date('Y-m-d'),
                    'versions' => [],
                    'change_types' => [
                        'feature' => [
                            'label' => 'Yeni Özellik',
                            'icon' => 'fa-plus-circle',
                            'color' => 'success'
                        ],
                        'bugfix' => [
                            'label' => 'Hata Düzeltme',
                            'icon' => 'fa-bug',
                            'color' => 'warning'
                        ],
                        'improvement' => [
                            'label' => 'İyileştirme',
                            'icon' => 'fa-arrow-up',
                            'color' => 'info'
                        ],
                        'ui' => [
                            'label' => 'Arayüz',
                            'icon' => 'fa-paint-brush',
                            'color' => 'primary'
                        ],
                        'backend' => [
                            'label' => 'Altyapı',
                            'icon' => 'fa-cogs',
                            'color' => 'secondary'
                        ],
                        'security' => [
                            'label' => 'Güvenlik',
                            'icon' => 'fa-shield-alt',
                            'color' => 'danger'
                        ]
                    ]
                ];
            }
            
            // App versiyonunu güncelle
            $changelog_data['app_version'] = $version;
            $changelog_data['last_updated'] = date('Y-m-d');
            
            // Yeni versiyon ekle
            $new_version = [
                'version' => $version,
                'date' => date('Y-m-d'),
                'title' => $title,
                'changes' => $changes,
                'files_modified' => $files_modified,
                'db_changes' => $db_changes
            ];
            
            // Eğer aynı versiyon varsa güncelle, yoksa başa ekle
            $version_found = false;
            foreach ($changelog_data['versions'] as $index => $existing_version) {
                if ($existing_version['version'] === $version) {
                    $changelog_data['versions'][$index] = $new_version;
                    $version_found = true;
                    break;
                }
            }
            
            if (!$version_found) {
                array_unshift($changelog_data['versions'], $new_version);
            }
            
            // JSON dosyasına yaz
            $json_content = json_encode($changelog_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            $result = file_put_contents($changelog_path, $json_content);
            
            return $result !== false;
            
        } catch (Exception $e) {
            log_message('error', 'Changelog güncellenirken hata oluştu: ' . $e->getMessage());
            return false;
        }
    }
}

if (!function_exists('addChangelogEntry')) {
    /**
     * Mevcut versiyona yeni bir değişiklik ekle
     * 
     * @param string $type Değişiklik tipi (feature, bugfix, improvement, ui, backend, security)
     * @param string $description Değişiklik açıklaması
     * @param string $details Detaylı açıklama (opsiyonel)
     * @param array $files_modified Değiştirilen dosyalar (opsiyonel)
     * @return bool
     */
    function addChangelogEntry($type, $description, $details = '', $files_modified = []) {
        $changelog_path = APPPATH . 'config/changelog.json';
        
        try {
            if (!file_exists($changelog_path)) {
                return false;
            }
            
            $changelog_content = file_get_contents($changelog_path);
            $changelog_data = json_decode($changelog_content, true);
            
            if (json_last_error() !== JSON_ERROR_NONE || empty($changelog_data['versions'])) {
                return false;
            }
            
            // En son versiyona değişiklik ekle
            $latest_version_index = 0;
            $new_change = [
                'type' => $type,
                'description' => $description
            ];
            
            if (!empty($details)) {
                $new_change['details'] = $details;
            }
            
            // Değişikliği ekle
            $changelog_data['versions'][$latest_version_index]['changes'][] = $new_change;
            
            // Dosya listesini güncelle
            if (!empty($files_modified)) {
                $existing_files = $changelog_data['versions'][$latest_version_index]['files_modified'];
                $merged_files = array_unique(array_merge($existing_files, $files_modified));
                $changelog_data['versions'][$latest_version_index]['files_modified'] = $merged_files;
            }
            
            // Son güncelleme tarihini güncelle
            $changelog_data['last_updated'] = date('Y-m-d');
            
            // JSON dosyasına yaz
            $json_content = json_encode($changelog_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            $result = file_put_contents($changelog_path, $json_content);
            
            return $result !== false;
            
        } catch (Exception $e) {
            log_message('error', 'Changelog entry eklenirken hata oluştu: ' . $e->getMessage());
            return false;
        }
    }
}

if (!function_exists('getCurrentVersion')) {
    /**
     * Mevcut app versiyonunu getir
     * 
     * @return string
     */
    function getCurrentVersion() {
        $changelog_path = APPPATH . 'config/changelog.json';
        
        if (!file_exists($changelog_path)) {
            return '1.0.0';
        }
        
        $changelog_content = file_get_contents($changelog_path);
        $changelog_data = json_decode($changelog_content, true);
        
        if (json_last_error() !== JSON_ERROR_NONE || !isset($changelog_data['app_version'])) {
            return '1.0.0';
        }
        
        return $changelog_data['app_version'];
    }
}

if (!function_exists('incrementVersion')) {
    /**
     * Versiyon numarasını artır
     * 
     * @param string $current_version Mevcut versiyon
     * @param string $type major, minor, patch
     * @return string
     */
    function incrementVersion($current_version, $type = 'patch') {
        $version_parts = explode('.', $current_version);
        
        // Eksik kısımları tamamla
        while (count($version_parts) < 3) {
            $version_parts[] = '0';
        }
        
        $major = intval($version_parts[0]);
        $minor = intval($version_parts[1]);
        $patch = intval($version_parts[2]);
        
        switch ($type) {
            case 'major':
                $major++;
                $minor = 0;
                $patch = 0;
                break;
            case 'minor':
                $minor++;
                $patch = 0;
                break;
            case 'patch':
            default:
                $patch++;
                break;
        }
        
        return "$major.$minor.$patch";
    }
}

if (!function_exists('autoUpdateChangelog')) {
    /**
     * Otomatik changelog güncelleyici
     * Bu fonksiyon her dosya değişikliğinde çağrılabilir
     * 
     * @param array $changes Yapılan değişiklikler
     * @param array $files Değiştirilen dosyalar
     * @return bool
     */
    function autoUpdateChangelog($changes = [], $files = []) {
        if (empty($changes)) {
            return false;
        }
        
        $current_version = getCurrentVersion();
        $new_version = incrementVersion($current_version, 'patch');
        
        // Başlık otomatik oluştur
        $title = 'Otomatik Güncelleme';
        if (count($changes) === 1) {
            $title = $changes[0]['description'];
        } elseif (count($changes) > 1) {
            $title = count($changes) . ' Değişiklik';
        }
        
        return updateChangelog($new_version, $title, $changes, $files, false);
    }
}

/* End of file changelog_helper.php */
/* Location: ./application/helpers/changelog_helper.php */