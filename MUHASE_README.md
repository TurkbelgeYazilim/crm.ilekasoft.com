# Muhasebe Modülü - Karmaşık Sorgu Sistemi

Bu modül, İlekaSoft CRM sistemi için geliştirilmiş **gelişmiş muhasebe işlemlerini** yönetmek amacıyla oluşturulmuştur. Sistem, farklı tahsilat türlerini (Banka, Çek, Kasa, Senet) tek bir merkezden yönetmeyi sağlar.

## 🏗️ Sistem Mimarisi

### Karmaşık Sorgu Yaklaşımı
Sistem, dört farklı tahsilat türünü tek bir sorgu ile birleştiren **kompleks JOIN yapısı** kullanır:

1. **Banka Hareketleri** (`bankaHareketleri`)
2. **Çek İşlemleri** (`cek`) 
3. **Kasa Hareketleri** (`kasaHareketleri`)
4. **Senet İşlemleri** (`senet`)

Bu tablolar `muhasebe_tahsilat_durum` merkezi tablo üzerinden **LEFT JOIN** ile birleştirilir.

## 📋 Özellikler

### ✅ Gelişmiş Özellikler
- **🔄 Çoklu Tahsilat Yönetimi**: Banka, Çek, Kasa, Senet işlemlerini tek ekranda yönetir
- **📊 DataTable Entegrasyonu**: Türkçe lokalizasyonlu, responsive DataTable
- **🎯 Karmaşık Sorgu Sistemi**: Çoklu tablo JOIN işlemleri ile birleşik veri görüntüleme
- **✅ Filtrelenmiş Görünüm**: Sadece onay bekleyen tahsilatları listeler (WHERE mtd.durum = 1)
- **✅ Onay Süreçleri**: Durum bazlı onay/red işlemleri
- **👥 Personel Takibi**: İşlemi yapan ve onaylayan personel bilgileri
- **🖼️ Görsel Destek**: Belge/fatura görsellerini görüntüleme
- **📈 Canlı İstatistikler**: Toplam tutar, adet ve bekleyen onay sayıları

### 🎨 Görsel Özellikler
- **🎨 Tip Bazlı Renkler**: Her tahsilat türü için özel icon ve renk kodları
- **📱 Responsive Tasarım**: Mobil uyumlu Bootstrap 4 tabanlı arayüz
- **🔔 Modal Onay Sistemi**: Güvenli onay/red işlemleri için modal pencereler
- **📊 İstatistik Kartları**: Gradient renkli özet kartlar

## 📁 Dosya Yapısı

```
application/
├── controllers/
│   └── Muhase.php                     # Karmaşık sorgu controller'ı
├── views/
│   └── muhase/
│       ├── onay-bekleyen-tahsilatlar.php  # Ana DataTable sayfası
│       └── tahsilat-detay.php             # Detay sayfası
└── config/
    └── routes.php                     # Rota tanımları

assets/
└── css/
    └── muhase.css                     # Özel stiller

muhase_database_setup.sql              # Yeni veritabanı kurulum scripti
muhase_test_data.sql                   # Eski test verileri (uyumluluk için)
```

## 🗄️ Veritabanı Yapısı

### 🎯 Merkezi Tablo: muhasebe_tahsilat_durum
```sql
CREATE TABLE `muhasebe_tahsilat_durum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahsilat_tipi` tinyint(4) NOT NULL COMMENT '1:Banka, 2:Çek, 3:Kasa, 4:Senet',
  `kayit_id` int(11) NOT NULL COMMENT 'İlgili tablodaki kayıt ID si',
  `durum` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Onay Bekliyor, 2:Onaylandı, 3:Reddedildi',
  `islemi_yapan` int(11) DEFAULT NULL,
  `islem_tarihi` datetime DEFAULT NULL,
  `olusturma_tarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aciklama` text DEFAULT NULL,
  PRIMARY KEY (`id`)
);
```

### 📊 Desteklenen Tablolar
1. **bankaHareketleri** - Banka transferleri ve ödemeleri
2. **cek** - Çek işlemleri ve vade takibi  
3. **kasaHareketleri** - Nakit giriş/çıkış işlemleri
4. **senet** - Senet işlemleri ve vade takibi

## 🔍 Karmaşık Sorgu Detayları

### Ana Sorgu Yapısı
```sql
SELECT 
   mtd.id,
   CASE 
       WHEN mtd.tahsilat_tipi = 1 THEN 'Banka'
       WHEN mtd.tahsilat_tipi = 2 THEN 'Çek'
       WHEN mtd.tahsilat_tipi = 3 THEN 'Kasa'
       WHEN mtd.tahsilat_tipi = 4 THEN 'Senet'
   END as tahsilat_tipi_adi,
   COALESCE(bh_cari.cari_ad, c_cari.cari_ad, kh_cari.cari_ad, s_cari.cari_ad) as musteri_adi,
   COALESCE(bh.bh_giris, c.cek_tutar, kh.kh_giris, s.senet_tutar) as tutar
FROM muhasebe_tahsilat_durum mtd
LEFT JOIN bankaHareketleri bh ON mtd.tahsilat_tipi = 1 AND mtd.kayit_id = bh.bh_id
LEFT JOIN cek c ON mtd.tahsilat_tipi = 2 AND mtd.kayit_id = c.cek_id
LEFT JOIN kasaHareketleri kh ON mtd.tahsilat_tipi = 3 AND mtd.kayit_id = kh.kh_id
LEFT JOIN senet s ON mtd.tahsilat_tipi = 4 AND mtd.kayit_id = s.senet_id
-- + Cari bilgileri için ek JOIN'ler
ORDER BY mtd.olusturma_tarihi DESC;
```

### 🎯 COALESCE Kullanımı
Farklı tablolardan gelen aynı amaçlı verileri birleştirmek için COALESCE fonksiyonu kullanılır:
- **Müşteri Adı**: `COALESCE(bh_cari.cari_ad, c_cari.cari_ad, kh_cari.cari_ad, s_cari.cari_ad)`
- **Tutar Bilgisi**: `COALESCE(bh.bh_giris, c.cek_tutar, kh.kh_giris, s.senet_tutar)`
- **Görsel**: `COALESCE(bh.bh_gorsel, c.cek_gorsel, kh.kh_gorsel, s.senet_gorsel)`

## 🚀 Kurulum

### 1. Veritabanı Kurulumu
```sql
-- Kurulum scriptini çalıştır
SOURCE muhase_database_setup.sql;
```

### 2. Yetki Ayarları
Sidebar menüsünde aşağıdaki modül ID'leri kontrol edilir:
- **1350**: Muhasebe modülü erişimi
- **1360**: Tahsilat onay işlemleri

### 3. Route Yapılandırması
```php
$route['muhase/onay-bekleyen-tahsilatlar'] = 'muhase/onayBekleyenTahsilatlar';
$route['muhase/tahsilat-onay/(:num)'] = 'muhase/tahsilatOnay/$1';
$route['muhase/tahsilat-red/(:num)'] = 'muhase/tahsilatRed/$1';
```

## 🎮 Kullanım

### Ana Sayfa Erişimi
```
http://yourdomain.com/muhase/onay-bekleyen-tahsilatlar
```

### Desteklenen İşlemler
1. **👀 Listeleme**: Tüm tahsilat türlerini tek ekranda görüntüleme
2. **✅ Onaylama**: Bekleyen tahsilatları onaylama
3. **❌ Reddetme**: Problemli tahsilatları reddetme  
4. **🔍 Detay**: Tahsilat detaylarını görüntüleme
5. **🖼️ Görsel**: Ek belgeleri görüntüleme

## 🎨 Renk Kodları

| Tahsilat Türü | Renk | Icon | Badge Class |
|---------------|------|------|-------------|
| 🏦 Banka | Mavi | `fa-university` | `text-primary` |
| 📄 Çek | Açık Mavi | `fa-file-text-o` | `text-info` |
| 💰 Kasa | Yeşil | `fa-money` | `text-success` |
| 📜 Senet | Sarı | `fa-file-o` | `text-warning` |

## 🛠️ Teknik Notlar

### DataTable Konfigürasyonu
- **Türkçe Lokalizasyon**: Otomatik TR dil desteği
- **Sayfalama**: 25 kayıt/sayfa
- **Sıralama**: İşlem tarihine göre azalan
- **Responsive**: Mobil uyumlu görünüm

### Güvenlik Özellikleri
- **CSRF Koruması**: Form güvenliği
- **Yetki Kontrolü**: Kullanıcı bazlı erişim
- **SQL Injection Koruması**: Parameterized queries
- **Session Kontrolü**: Oturum doğrulama

### Performans Optimizasyonları
- **Index Kullanımı**: Tablolarda optimum indeksler
- **COALESCE**: Null değer kontrolü
- **LEFT JOIN**: Optimal join stratejisi
- **CASE Statements**: Hızlı durum dönüşümleri

## 🐛 Hata Ayıklama

### Yaygın Problemler
1. **Tablo Bulunamadı**: `muhase_database_setup.sql` scriptini çalıştırın
2. **Yetki Hatası**: Modül ID 1350 ve 1360'ı kontrol edin
3. **Veri Görünmüyor**: Test verilerini yükleyin

### Log Sistemi
Controller'da `logekle(1, 3)` fonksiyonu ile işlemler loglanır.

## 📞 Destek

Bu modül İlekaSoft CRM'in gelişmiş muhasebe çözümüdür. Teknik destek için:
- 📧 E-posta: support@ilekasoft.com
- 📱 Telefon: +90 XXX XXX XX XX

---
**Son Güncelleme**: 19 Haziran 2025  
**Versiyon**: 2.0 (Karmaşık Sorgu Sistemi)  
**Geliştirici**: İlekaSoft Geliştirme Ekibi
  `tahsilat_onay_tarihi` datetime DEFAULT NULL,
  `tahsilat_onaylayan` int(11) DEFAULT NULL,
  `tahsilat_olusturan` int(11) NOT NULL,
  `tahsilat_olusturma_tarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tahsilat_olusturanAnaHesap` int(11) NOT NULL,
  PRIMARY KEY (`tahsilat_id`)
);
```

### Tahsilat Türleri
- `1`: Nakit
- `2`: Kredi Kartı  
- `3`: Banka Transferi
- `4`: Çek
- `5`: Senet

### Onay Durumları
- `0`: Onay Bekliyor
- `1`: Onaylandı
- `2`: Reddedildi

## 🔐 Yetki Sistemi

### Modül Yetkileri
- **Ana Modül (1350)**: Muhasebe modülüne erişim
- **Tahsilat Onay (1360)**: Onay bekleyen tahsilatları görüntüleme

### Sidebar'da Görünüm
```php
<?php if (grup_modul_yetkisi_var(1350)): ?>
<li class="submenu">
    <a href="#"><i data-feather="calculator"></i> <span>Muhasebe</span></a>
    <ul>
        <?php if (grup_modul_yetkisi_var(1360)): ?>
        <li><a href="<?= base_url("muhase/onay-bekleyen-tahsilatlar"); ?>">Onay Bekleyen Tahsilatlar</a></li>
        <?php endif; ?>
    </ul>
</li>
<?php endif; ?>
```

## 🌐 URL Yapısı

### Ana Rotalar
- `/muhase/onay-bekleyen-tahsilatlar` - Ana sayfa
- `/muhase/tahsilat-detay/{id}` - Tahsilat detayı
- `/muhase/tahsilat-onay/{id}` - Tahsilat onaylama
- `/muhase/tahsilat-red/{id}` - Tahsilat reddetme

## 🎨 Görsel Tasarım

### Renk Paleti
- **Ana Renk**: `#667eea` → `#764ba2` (Gradient)
- **Onay Rengi**: `#28a745` (Yeşil)
- **Red Rengi**: `#dc3545` (Kırmızı)
- **Bekleyen**: `#ffc107` (Sarı)

### CSS Sınıfları
- `.muhase-card` - Ana kart tasarımı
- `.tahsilat-item` - Tahsilat listesi öğeleri
- `.tutar-buyuk`, `.tutar-orta`, `.tutar-kucuk` - Tutar gösterimleri
- `.badge-bekliyor`, `.badge-onaylandi`, `.badge-reddedildi` - Durum rozetleri

## 🚀 Kurulum

1. **Controller Dosyası**: `application/controllers/Muhase.php` dosyasını projeye ekleyin
2. **View Dosyaları**: `application/views/muhase/` klasörünü oluşturun
3. **Rotalar**: `application/config/routes.php` dosyasına muhasebe rotalarını ekleyin
4. **Sidebar**: `application/views/include/sidebar.php` dosyasına menü öğesini ekleyin
5. **CSS**: `assets/css/muhase.css` dosyasını projeye ekleyin
6. **Veritabanı**: `muhase_test_data.sql` dosyasını çalıştırarak test verilerini oluşturun

## 🔧 Kullanım

### 1. Ana Sayfa Erişimi
```
https://siteniz.com/muhase/onay-bekleyen-tahsilatlar
```

### 2. Controller Metodları
```php
// Ana sayfa
public function onayBekleyenTahsilatlar()

// Detay sayfası  
public function tahsilatDetay($tahsilat_id)

// Onaylama işlemi
public function tahsilatOnay($tahsilat_id)

// Reddetme işlemi
public function tahsilatRed($tahsilat_id)
```

### 3. Veri Çekme Örneği
```php
$tahsilatlar = $this->db->query("
    SELECT t.*, c.cari_ad, c.cari_kodu, c.cari_telefon,
           k.kullanici_ad, k.kullanici_soyad
    FROM tahsilatlar t
    LEFT JOIN cari c ON t.tahsilat_cari_id = c.cari_id
    LEFT JOIN kullanicilar k ON t.tahsilat_olusturan = k.kullanici_id
    WHERE t.tahsilat_onay_durumu = 0
    ORDER BY t.tahsilat_tarihi DESC
")->result();
```

## 📱 Responsive Tasarım

- **Desktop**: Tam özellikli görünüm
- **Tablet**: Kart düzeni optimize edilmiş
- **Mobile**: Tek kolon, büyük butonlar

## 🔒 Güvenlik

- SQL Injection koruması
- XSS koruması  
- CSRF token kullanımı
- Yetki bazlı erişim kontrolü
- Input validation

## 📈 Performans

- Veritabanı indeksleri
- Lazy loading
- Önbellekleme (gelecek sürümlerde)
- Sayfalama desteği

## 🐛 Hata Ayıklama

### Debug Modu
```php
// Controller'da hata ayıklama için
error_log("Tahsilat ID: " . $tahsilat_id);
```

### Log Kayıtları
```php
// İşlem logları
logekle(1360, 1); // Muhasebe modülü, görüntüleme
logekle(1360, 2); // Muhasebe modülü, onaylama
```

## 📞 Destek

- **Geliştirici**: İlekaSoft Yazılım Ekibi
- **E-mail**: destek@ilekasoft.com
- **Versiyon**: 1.0.0
- **Son Güncelleme**: 18 Haziran 2025

---

> **Not**: Bu modül sürekli geliştirme aşamasındadır. Yeni özellikler ve iyileştirmeler düzenli olarak eklenmektedir.
