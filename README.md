# 🏢 İleka CRM Sistemi

Modern ve güçlü bir CRM (Müşteri İlişkileri Yönetimi) sistemi. Türk işletmeleri için özelleştirilmiş, e-fatura, e-irsaliye, muhasebe ve stok yönetimi entegrasyonlu.

[![License](https://img.shields.io/badge/License-Proprietary-red.svg)](LICENSE)
[![PHP Version](https://img.shields.io/badge/PHP-7.4%2B-blue.svg)](https://php.net)
[![CodeIgniter](https://img.shields.io/badge/CodeIgniter-3.x-orange.svg)](https://codeigniter.com)

## 🚀 Özellikler

### 💼 CRM & Satış
- 📋 Müşteri ve cari kart yönetimi
- 💰 Teklif hazırlama ve takip sistemi
- 📊 Satış raporları ve analizler
- 🎯 Talep yönetimi sistemi

### 📄 E-Dönüşüm Entegrasyonu
- 🧾 **E-Fatura** - GİB entegrasyonu
- 📦 **E-İrsaliye** - Otomatik gönderim
- 📋 **E-Arşiv** - Dijital arşivleme
- 🔐 **E-İmza** desteği

### 💳 Finansal Yönetim
- 💰 Kasa ve banka hesap yönetimi
- 📝 Çek & senet takip sistemi
- 💸 Tahsilat ve ödeme işlemleri
- 📊 Gelir-gider raporları

### 📦 Stok & Envanter
- 📋 Stok kartı yönetimi
- 🔄 Stok hareket takibi
- ⚠️ Kritik stok uyarıları
- 📈 Stok raporları

### 👥 Kullanıcı Yönetimi
- 🔐 Rol bazlı yetki sistemi
- 👤 Kullanıcı grupları
- 📍 Konum takibi
- 📋 Aktivite logları

## 🛠️ Teknoloji Stack

- **Backend:** PHP 7.4+ / CodeIgniter 3.x
- **Veritabanı:** MySQL 5.7+
- **Frontend:** Bootstrap 4, jQuery, DataTables
- **PDF:** mPDF
- **Excel:** PhpSpreadsheet
- **SMS:** Mobilisim API
- **OCR:** Google Cloud Vision API

## 📋 Sistem Gereksinimleri

- **PHP:** 7.4 veya üzeri
- **MySQL:** 5.7 veya üzeri
- **Web Server:** Apache/Nginx
- **Extensions:** mysqli, gd, curl, json, mbstring
- **Memory:** Minimum 256MB RAM

## ⚡ Hızlı Kurulum

```bash
# Repository'i klonlayın
git clone https://github.com/TurkbelgeYazilim/crm.ilekasoft.com.git

# Proje dizinine gidin
cd crm.ilekasoft.com

# Bağımlılıkları yükleyin
composer install

# Konfigürasyon dosyalarını oluşturun
cp application/config/database.example.php application/config/database.php
cp application/config/sms.example.php application/config/sms.php
cp application/config/email.example.php application/config/email.php
```

Detaylı kurulum için [SETUP.md](SETUP.md) dosyasına bakın.

## 🔧 Konfigürasyon

### Veritabanı Ayarları
```php
// application/config/database.php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'kullanici_adi',
    'password' => 'sifre',
    'database' => 'veritabani_adi',
    // ...
);
```

### SMS API Ayarları
```php
// application/config/sms.php
$config['sms_username'] = 'api_kullanici_adi';
$config['sms_password'] = 'api_sifresi';
```

## 📁 Proje Yapısı

```
├── application/          # CodeIgniter uygulaması
│   ├── controllers/      # Controller dosyaları
│   ├── models/          # Model dosyaları
│   ├── views/           # View dosyaları
│   ├── config/          # Konfigürasyon dosyaları
│   └── helpers/         # Helper fonksiyonları
├── assets/              # CSS, JS, resim dosyaları
├── system/              # CodeIgniter framework
├── uploads/             # Yüklenen dosyalar
├── vendor/              # Composer bağımlılıkları
└── .temp/               # Geçici dosyalar
```

## 📊 Dashboard Önizleme

- 📈 **Satış Grafikleri** - Aylık/yıllık satış analizleri
- 💰 **Gelir-Gider** - Finansal durum özeti
- 📋 **Bekleyen İşler** - Onay bekleyen işlemler
- 🎯 **Hedef Takibi** - Satış hedefleri

## 🛡️ Güvenlik

- ✅ SQL Injection koruması
- ✅ XSS koruması
- ✅ CSRF token sistemi
- ✅ Kullanıcı session yönetimi
- ✅ Dosya upload güvenliği

## 📄 Lisans

Bu proje özel lisans altındadır. Ticari kullanım için [İleka Yazılım](https://ilekasoft.com) ile iletişime geçin.

## 👨‍💻 Geliştirici

**Batuhan Kahraman**
- 📧 [batuhan.kahraman@ileka.com.tr](mailto:batuhan.kahraman@ileka.com.tr)
- 📱 +90 501 357 10 85
- 🌐 [GitHub](https://github.com/Batuhan-Kahraman/)

## 🤝 Katkıda Bulunma

1. Bu repository'i fork edin
2. Feature branch oluşturun (`git checkout -b feature/yeni-ozellik`)
3. Değişikliklerinizi commit edin (`git commit -am 'Yeni özellik eklendi'`)
4. Branch'inizi push edin (`git push origin feature/yeni-ozellik`)
5. Pull Request oluşturun

## 📞 Destek

- 📧 **E-posta:** [destek@ilekasoft.com](mailto:destek@ilekasoft.com)
- 🌐 **Website:** [https://ilekasoft.com](https://ilekasoft.com)
- � **Telefon:** +90 501 357 10 85

---

## �📁 Dosya Organizasyonu Kuralları

### ⚠️ ÖNEMLİ: Geçici Dosya Kuralı

**Tüm geçici, test, debug ve geliştirme dosyaları `.temp/` klasörüne konulmalıdır.**

#### 🚫 `.temp/` klasörüne gitmesi gereken dosyalar:
- Test dosyaları (`test_*.php`, `test_*.html`)
- Debug dosyaları (`*debug*.php`, `*diagnostic*.php`)
- Geçici SQL dosyaları (`*.sql`)
- Log dosyaları ve geçici listeler
- Integrity check dosyaları
- Quick fix scriptleri

#### ✅ Ana dizinde kalması gereken dosyalar:
- Framework dosyaları (`application/`, `index.php`)
- Bağımlılık dosyaları (`composer.json`, `composer.lock`)
- Yapılandırma dosyaları (`.env`, `.htaccess`)
- Production dosyaları

### 🎯 Amaç
Bu kural sayesinde:
- Ana dizin sadece production dosyalarını içerir
- Proje profesyonel görünür
- Deploy işlemleri daha temiz olur
- Git repository'si düzenli kalır

---

*© 2025 İleka Yazılım - Tüm hakları saklıdır.*
