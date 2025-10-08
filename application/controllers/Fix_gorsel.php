<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fix_gorsel extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index() {
        // Sadece yetkili kullanıcılar erişebilsin
        // $this->load->helper('url');
        // if (!$this->session->userdata('logged_in')) {
        //     redirect('login');
        // }
        
        $data = [];
        
        if ($this->input->post('action')) {
            $data = $this->process_action();
        }
        
        $this->load->view('fix_gorsel_view', $data);
    }
    
    private function process_action() {
        $action = $this->input->post('action');
        $result = [
            'total_found' => 0,
            'total_fixed' => 0,
            'results' => [],
            'action' => $action
        ];
        
        // Tabloları ve görsel alanlarını tanımla
        $tables_to_check = [
            'bankaHareketleri' => ['bh_id', 'bh_gorsel'],
            'cari' => ['cari_id', 'fotograf_dosya'],
            'giderler' => ['gider_id', 'gider_gorsel'],
            'tahsilatlar' => ['tahsilat_id', 'tahsilat_gorsel'], 
            'kasaHareketleri' => ['kh_id', 'kh_gorsel'],
            'cekler' => ['cek_id', 'cek_gorsel'],
            'senetler' => ['senet_id', 'senet_gorsel']
        ];
        
        foreach ($tables_to_check as $table => $fields) {
            $id_field = $fields[0];
            $gorsel_field = $fields[1];
            
            // Tablo var mı kontrol et
            if (!$this->db->table_exists($table)) {
                continue;
            }
            
            // Alan var mı kontrol et  
            if (!$this->db->field_exists($gorsel_field, $table)) {
                continue;
            }
            
            // Hatalı kayıtları bul
            $sql = "SELECT $id_field, $gorsel_field FROM `$table` WHERE `$gorsel_field` LIKE '[%]' AND `$gorsel_field` LIKE '%]'";
            $query = $this->db->query($sql);
            
            if ($query->num_rows() > 0) {
                $table_result = [
                    'table' => $table,
                    'found' => $query->num_rows(),
                    'fixed' => 0,
                    'records' => []
                ];
                
                $result['total_found'] += $query->num_rows();
                
                foreach ($query->result_array() as $row) {
                    $decoded = json_decode($row[$gorsel_field], true);
                    if (is_array($decoded) && count($decoded) > 0) {
                        $new_value = $decoded[0];
                        
                        $record = [
                            'id' => $row[$id_field],
                            'old_value' => $row[$gorsel_field],
                            'new_value' => $new_value,
                            'success' => false
                        ];
                        
                        if ($action == 'fix') {
                            // Güncelleme yap
                            $this->db->where($id_field, $row[$id_field]);
                            $update_result = $this->db->update($table, [$gorsel_field => $new_value]);
                            
                            if ($update_result) {
                                $record['success'] = true;
                                $table_result['fixed']++;
                                $result['total_fixed']++;
                            }
                        }
                        
                        $table_result['records'][] = $record;
                    }
                }
                
                $result['results'][] = $table_result;
            }
        }
        
        return $result;
    }
}
?>
