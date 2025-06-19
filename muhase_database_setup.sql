-- Muhasebe Modülü - Karmaşık Sorgu Veritabanı Kurulumu
-- Bu dosya yeni muhasebe tahsilat durum sistemi için gerekli tabloları ve test verilerini oluşturur

-- 1. Muhasebe Tahsilat Durum tablosu oluştur
CREATE TABLE IF NOT EXISTS `muhasebe_tahsilat_durum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tahsilat_tipi` tinyint(4) NOT NULL COMMENT '1:Banka, 2:Çek, 3:Kasa, 4:Senet',
  `kayit_id` int(11) NOT NULL COMMENT 'İlgili tablodaki kayıt ID si',
  `durum` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Onay Bekliyor, 2:Onaylandı, 3:Reddedildi',
  `islemi_yapan` int(11) DEFAULT NULL COMMENT 'Onay/Red işlemi yapan kullanıcı ID',
  `islem_tarihi` datetime DEFAULT NULL COMMENT 'Onay/Red işlem tarihi',
  `olusturma_tarihi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `aciklama` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_tahsilat_tipi` (`tahsilat_tipi`),
  KEY `idx_durum` (`durum`),
  KEY `idx_kayit_id` (`kayit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- 2. Örnek Banka Hareketleri tablosu (test için)
CREATE TABLE IF NOT EXISTS `bankaHareketleri` (
  `bh_id` int(11) NOT NULL AUTO_INCREMENT,
  `bh_cariID` int(11) DEFAULT NULL,
  `bh_giris` decimal(15,2) DEFAULT 0.00,
  `bh_cikis` decimal(15,2) DEFAULT 0.00,
  `bh_tarih` datetime DEFAULT CURRENT_TIMESTAMP,
  `bh_aciklama` text DEFAULT NULL,
  `bh_gorsel` varchar(255) DEFAULT NULL,
  `bh_olusturan` int(11) DEFAULT NULL,
  PRIMARY KEY (`bh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- 3. Örnek Çek tablosu (test için)
CREATE TABLE IF NOT EXISTS `cek` (
  `cek_id` int(11) NOT NULL AUTO_INCREMENT,
  `cek_cariID` int(11) DEFAULT NULL,
  `cek_tutar` decimal(15,2) DEFAULT 0.00,
  `cek_vade_tarihi` date DEFAULT NULL,
  `cek_seri_no` varchar(100) DEFAULT NULL,
  `cek_banka` varchar(100) DEFAULT NULL,
  `cek_gorsel` varchar(255) DEFAULT NULL,
  `cek_kullaniciID` int(11) DEFAULT NULL,
  `cek_tarih` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cek_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- 4. Örnek Kasa Hareketleri tablosu (test için)
CREATE TABLE IF NOT EXISTS `kasaHareketleri` (
  `kh_id` int(11) NOT NULL AUTO_INCREMENT,
  `kh_cariID` int(11) DEFAULT NULL,
  `kh_giris` decimal(15,2) DEFAULT 0.00,
  `kh_cikis` decimal(15,2) DEFAULT 0.00,
  `kh_tarih` datetime DEFAULT CURRENT_TIMESTAMP,
  `kh_aciklama` text DEFAULT NULL,
  `kh_gorsel` varchar(255) DEFAULT NULL,
  `kh_olusturan` int(11) DEFAULT NULL,
  PRIMARY KEY (`kh_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- 5. Örnek Senet tablosu (test için)
CREATE TABLE IF NOT EXISTS `senet` (
  `senet_id` int(11) NOT NULL AUTO_INCREMENT,
  `senet_cariID` int(11) DEFAULT NULL,
  `senet_tutar` decimal(15,2) DEFAULT 0.00,
  `senet_vade_tarihi` date DEFAULT NULL,
  `senet_no` varchar(100) DEFAULT NULL,
  `senet_gorsel` varchar(255) DEFAULT NULL,
  `senet_kullaniciID` int(11) DEFAULT NULL,
  `senet_tarih` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`senet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

-- 6. Kullanıcılar tablosunda örnek veri (eğer yoksa)
INSERT IGNORE INTO `kullanicilar` (
    `kullanici_id`,
    `kullanici_adi`,
    `kullanici_ad`,
    `kullanici_soyad`,
    `kullanici_mail`,
    `kullanici_sifre`,
    `kullanici_yetki`,
    `kullanici_grubu`,
    `kullanici_olusturmaTarihi`,
    `kullanici_durum`
) VALUES
(1, 'admin', 'Sistem', 'Yöneticisi', 'admin@ilekasoft.com', MD5('123456'), 1, 1, NOW(), 1),
(2, 'muhasebe', 'Muhasebe', 'Uzmanı', 'muhasebe@ilekasoft.com', MD5('123456'), 2, 2, NOW(), 1),
(3, 'operator', 'Operasyon', 'Uzmanı', 'operator@ilekasoft.com', MD5('123456'), 3, 3, NOW(), 1);

-- 7. Cari tablosunda örnek müşteriler (eğer yoksa)
INSERT IGNORE INTO `cari` (
    `cari_id`,
    `cari_kodu`, 
    `cari_ad`, 
    `cari_telefon`, 
    `cari_olusturan`, 
    `cari_olusturanAnaHesap`,
    `cari_olusturmaTarihi`,
    `cari_durum`
) VALUES
(1, 'MUS001', 'ABC İnşaat Limited Şirketi', '0212 555 0001', 1, 1, NOW(), 1),
(2, 'MUS002', 'XYZ Tekstil San. ve Tic. A.Ş.', '0216 444 0002', 1, 1, NOW(), 1),
(3, 'MUS003', 'DEF Otomotiv Sanayi Ltd.', '0232 333 0003', 1, 1, NOW(), 1),
(4, 'MUS004', 'GHI Bilgisayar Teknolojileri', '0312 222 0004', 1, 1, NOW(), 1);

-- 8. Test için örnek banka hareketleri
INSERT INTO `bankaHareketleri` (
    `bh_cariID`, `bh_giris`, `bh_tarih`, `bh_aciklama`, `bh_gorsel`, `bh_olusturan`
) VALUES
(1, 15000.00, '2025-06-18 10:30:00', 'ABC İnşaat - Haziran ayı ödeme', 'uploads/banka/bh_001.jpg', 3),
(2, 28500.75, '2025-06-17 14:20:00', 'XYZ Tekstil - Fatura ödemesi', 'uploads/banka/bh_002.pdf', 3),
(3, 12250.50, '2025-06-16 09:15:00', 'DEF Otomotiv - Hizmet bedeli', NULL, 2);

-- 9. Test için örnek çek kayıtları
INSERT INTO `cek` (
    `cek_cariID`, `cek_tutar`, `cek_vade_tarihi`, `cek_seri_no`, `cek_banka`, `cek_gorsel`, `cek_kullaniciID`
) VALUES
(2, 18750.00, '2025-07-15', 'ÇK001234567', 'İş Bankası', 'uploads/cek/cek_001.jpg', 2),
(4, 9500.25, '2025-07-30', 'ÇK002345678', 'Garanti BBVA', 'uploads/cek/cek_002.jpg', 3),
(1, 22100.00, '2025-08-10', 'ÇK003456789', 'Akbank', NULL, 2);

-- 10. Test için örnek kasa hareketleri
INSERT INTO `kasaHareketleri` (
    `kh_cariID`, `kh_giris`, `kh_tarih`, `kh_aciklama`, `kh_gorsel`, `kh_olusturan`
) VALUES
(3, 5500.00, '2025-06-18 16:45:00', 'DEF Otomotiv - Nakit ödeme', NULL, 1),
(1, 8750.50, '2025-06-17 11:30:00', 'ABC İnşaat - Kapora ödemesi', 'uploads/kasa/kh_001.jpg', 2),
(4, 3200.00, '2025-06-16 13:20:00', 'GHI Bilgisayar - Hizmet bedeli', NULL, 3);

-- 11. Test için örnek senet kayıtları
INSERT INTO `senet` (
    `senet_cariID`, `senet_tutar`, `senet_vade_tarihi`, `senet_no`, `senet_gorsel`, `senet_kullaniciID`
) VALUES
(2, 35000.00, '2025-08-15', 'SN001234567', 'uploads/senet/sn_001.pdf', 1),
(3, 42500.75, '2025-09-20', 'SN002345678', 'uploads/senet/sn_002.jpg', 2),
(4, 18900.00, '2025-08-30', 'SN003456789', NULL, 3);

-- 12. Muhasebe tahsilat durum kayıtları (yukarıdaki verileri referans alarak)
INSERT INTO `muhasebe_tahsilat_durum` (
    `tahsilat_tipi`, `kayit_id`, `durum`, `islemi_yapan`, `islem_tarihi`, `aciklama`
) VALUES
-- Onay bekleyen kayıtlar
(1, 1, 1, NULL, NULL, 'ABC İnşaat banka hareketi onay bekliyor'),
(1, 2, 1, NULL, NULL, 'XYZ Tekstil banka hareketi onay bekliyor'),
(2, 1, 1, NULL, NULL, 'XYZ Tekstil çek onay bekliyor'),
(2, 2, 1, NULL, NULL, 'GHI Bilgisayar çek onay bekliyor'),
(3, 1, 1, NULL, NULL, 'DEF Otomotiv kasa hareketi onay bekliyor'),
(3, 2, 1, NULL, NULL, 'ABC İnşaat kasa hareketi onay bekliyor'),
(4, 1, 1, NULL, NULL, 'XYZ Tekstil senet onay bekliyor'),
(4, 2, 1, NULL, NULL, 'DEF Otomotiv senet onay bekliyor'),

-- Onaylanmış kayıtlar (örnek)
(1, 3, 2, 1, '2025-06-17 10:00:00', 'DEF Otomotiv banka hareketi onaylandı'),
(2, 3, 2, 1, '2025-06-17 11:00:00', 'ABC İnşaat çek onaylandı'),
(3, 3, 2, 2, '2025-06-17 12:00:00', 'GHI Bilgisayar kasa hareketi onaylandı'),

-- Reddedilen kayıtlar (örnek)
(4, 3, 3, 1, '2025-06-17 15:00:00', 'GHI Bilgisayar senet reddedildi - Tutar uyuşmazlığı');

-- 13. Bu script tamamlandıktan sonra aşağıdaki kontrol sorgusunu çalıştırabilirsiniz:
/*
SELECT 
   mtd.id,
   CASE 
       WHEN mtd.tahsilat_tipi = 1 THEN 'Banka'
       WHEN mtd.tahsilat_tipi = 2 THEN 'Çek'
       WHEN mtd.tahsilat_tipi = 3 THEN 'Kasa'
       WHEN mtd.tahsilat_tipi = 4 THEN 'Senet'
   END as tahsilat_tipi_adi,
   CASE 
       WHEN mtd.durum = 1 THEN 'Onay Bekliyor'
       WHEN mtd.durum = 2 THEN 'Onaylandı'
       WHEN mtd.durum = 3 THEN 'Reddedildi'
   END as durum_adi,
   COALESCE(bh_cari.cari_ad, c_cari.cari_ad, kh_cari.cari_ad, s_cari.cari_ad) as musteri_adi,
   COALESCE(bh.bh_giris, c.cek_tutar, kh.kh_giris, s.senet_tutar) as tutar
FROM muhasebe_tahsilat_durum mtd
LEFT JOIN bankaHareketleri bh ON mtd.tahsilat_tipi = 1 AND mtd.kayit_id = bh.bh_id
LEFT JOIN cari bh_cari ON bh.bh_cariID = bh_cari.cari_id
LEFT JOIN cek c ON mtd.tahsilat_tipi = 2 AND mtd.kayit_id = c.cek_id
LEFT JOIN cari c_cari ON c.cek_cariID = c_cari.cari_id
LEFT JOIN kasaHareketleri kh ON mtd.tahsilat_tipi = 3 AND mtd.kayit_id = kh.kh_id
LEFT JOIN cari kh_cari ON kh.kh_cariID = kh_cari.cari_id
LEFT JOIN senet s ON mtd.tahsilat_tipi = 4 AND mtd.kayit_id = s.senet_id
LEFT JOIN cari s_cari ON s.senet_cariID = s_cari.cari_id
ORDER BY mtd.olusturma_tarihi DESC;
*/

-- Bu script'i çalıştırdıktan sonra muhase/onay-bekleyen-tahsilatlar sayfasında
-- karmaşık sorgu ile birleştirilmiş test verilerini görebilirsiniz.
