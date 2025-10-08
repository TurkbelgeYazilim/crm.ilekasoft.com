# CRM İlekasoft - Proje Kuralları

## 📁 Dosya Organizasyonu Kuralları

### ⚠️ ÖNEMLİ: Geçici Dosya Kuralı

**Tüm geçici, test, debug ve geliştirme dosyaları `.temp/` klasörüne konulmalıdır.**

#### 🚫 `.temp/` klasörüne gitmesi gereken dosyalar:
- Test dosyaları (`test_*.php`, `test_*.html`)
- Debug dosyaları (`*debug*.php`, `*diagnostic*.php`)
- Geçici SQL dosyaları (`*.sql`)
- Dokümantasyon dosyaları (`*.md`, `readme.*`)
- Log dosyaları ve geçici listeler
- Integrity check dosyaları
- Quick fix scriptleri
- Monitor dosyaları
- Boş/placeholder dosyalar

#### ✅ Ana dizinde kalması gereken dosyalar:
- Framework dosyaları (`application/`, `index.php`)
- Bağımlılık dosyaları (`composer.json`, `composer.lock`)
- Yapılandırma dosyaları (`.env`, `.htaccess`)
- Production XML/şablon dosyaları
- Lisans dosyaları (`license.txt`)
- Asset dosyaları (`assets/`)

### 🎯 Amaç
Bu kural sayesinde:
- Ana dizin sadece production dosyalarını içerir
- Proje profesyonel görünür
- Deploy işlemleri daha temiz olur
- Git repository'si düzenli kalır

### 📅 Son Güncelleme
Bu kural 7 Haziran 2025 tarihinde uygulanmıştır.
