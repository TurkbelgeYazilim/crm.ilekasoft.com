# İlekaSoft CRM Sistemi

İlekaSoft firması için geliştirilmiş kapsamlı Müşteri İlişkileri Yönetimi (CRM) sistemi.

## 🚀 Özellikler

### 💰 Tahsilat Yönetimi
- **Otomatik Kasa Seçimi**: Kullanıcıya özel kasa otomatik seçimi
- **Senet Yönetimi**: Kapsamlı senet (promissory note) işlemleri
- **Çoklu Ödeme Tipleri**: Kasa, Banka, Çek, Senet
- **Gelişmiş Form Validasyonu**: Kullanıcı dostu hata yönetimi

### 📊 Cari Hesap Yönetimi
- Müşteri hesap takibi
- Cari hareket kayıtları
- Bakiye raporları

### 🏦 Finansal Modüller
- Banka işlemleri yönetimi
- Kasa operasyonları
- Çek takip sistemi
- Senet portföy yönetimi

### 📈 Raporlama
- Detaylı finansal raporlar
- Cari hesap raporları
- Tahsilat analizleri

## 🛠️ Teknoloji Stack

- **Framework**: CodeIgniter 3.x
- **Veritabanı**: MySQL
- **Frontend**: Bootstrap 4, jQuery
- **Icons**: Feather Icons
- **Date Picker**: Bootstrap DatePicker
- **Session Management**: Bootstrap Session Timeout

## 📋 Son Güncellemeler (Mayıs 2025)

### ✅ Tahsilat Modülü Geliştirmeleri
1. **Kasa Dropdown Gizleme**: UI'dan kaldırıldı, arka planda otomatik seçim
2. **Senet Ödeme Tipi**: Yeni senet yönetimi sistemi eklendi
3. **Tutar Alanı Yönetimi**: Dinamik form alanları
4. **Backend Entegrasyonu**: Tam veritabanı entegrasyonu

### 🔧 Teknik İyileştirmeler
- JavaScript helper fonksiyonları
- Form validasyon güncellemeleri
- Database transaction güvenliği
- Kullanıcı deneyimi iyileştirmeleri

## 📁 Proje Yapısı

```
crm.ilekasoft.com/
├── application/
│   ├── controllers/
│   │   ├── Tahsilat.php      # Tahsilat işlemleri
│   │   ├── Senet.php         # Senet yönetimi
│   │   ├── Cari.php          # Cari hesap işlemleri
│   │   └── ...
│   ├── models/
│   │   └── Vt.php            # Veritabanı modeli
│   └── views/
│       ├── tahsilat/         # Tahsilat görünümleri
│       ├── senet/            # Senet görünümleri
│       └── ...
├── assets/
│   ├── js/                   # JavaScript dosyaları
│   ├── css/                  # Stil dosyaları
│   └── uploads/              # Yüklenen dosyalar
└── docs/                     # Dokümantasyon
```

## 🔧 Kurulum

1. **Repository'yi klonlayın**:
   ```bash
   git clone https://github.com/TurkbelgeYazilim/crm.ilekasoft.com.git
   ```

2. **Veritabanı konfigürasyonu**:
   - `application/config/database.php` dosyasını düzenleyin
   - MySQL veritabanı bilgilerini girin

3. **Web sunucusu ayarları**:
   - Apache/Nginx konfigürasyonu
   - PHP 7.4+ gerekli

## 📞 Destek

- **E-posta**: destek@ilekasoft.com
- **Website**: https://ilekasoft.com

## 📄 Lisans

Bu proje İlekaSoft tarafından geliştirilmiştir. Tüm hakları saklıdır.

---

**İlekaSoft CRM** - Müşteri İlişkileri Yönetiminde Güvenilir Çözüm
