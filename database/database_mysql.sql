CREATE DATABASE IF NOT EXISTS sistem_pakar_laptop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sistem_pakar_laptop;

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS hasil_diagnosas;
DROP TABLE IF EXISTS detail_konsultasis;
DROP TABLE IF EXISTS konsultasis;
DROP TABLE IF EXISTS rules;
DROP TABLE IF EXISTS kerusakans;
DROP TABLE IF EXISTS gejalas;
DROP TABLE IF EXISTS users;
SET FOREIGN_KEY_CHECKS=1;

CREATE TABLE users (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  email_verified_at TIMESTAMP NULL,
  password VARCHAR(255) NOT NULL,
  role VARCHAR(255) NOT NULL DEFAULT 'admin',
  remember_token VARCHAR(100) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE gejalas (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  kode_gejala VARCHAR(10) NOT NULL UNIQUE,
  nama_gejala VARCHAR(255) NOT NULL,
  kategori VARCHAR(100) NOT NULL DEFAULT 'Umum',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE kerusakans (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  kode_kerusakan VARCHAR(10) NOT NULL UNIQUE,
  nama_kerusakan VARCHAR(255) NOT NULL,
  kategori VARCHAR(100) NOT NULL DEFAULT 'Umum',
  deskripsi TEXT NULL,
  penyebab TEXT NULL,
  solusi TEXT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE rules (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  kerusakan_id BIGINT UNSIGNED NOT NULL,
  gejala_id BIGINT UNSIGNED NOT NULL,
  cf_pakar DECIMAL(3,2) NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  UNIQUE KEY rules_unique (kerusakan_id, gejala_id),
  CONSTRAINT rules_kerusakan_fk FOREIGN KEY (kerusakan_id) REFERENCES kerusakans(id) ON DELETE CASCADE,
  CONSTRAINT rules_gejala_fk FOREIGN KEY (gejala_id) REFERENCES gejalas(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE konsultasis (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  nama_pengguna VARCHAR(255) NOT NULL,
  tanggal DATETIME NOT NULL,
  hasil_kerusakan_id BIGINT UNSIGNED NULL,
  nilai_cf DECIMAL(5,2) NOT NULL DEFAULT 0,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  CONSTRAINT konsultasis_kerusakan_fk FOREIGN KEY (hasil_kerusakan_id) REFERENCES kerusakans(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE detail_konsultasis (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  konsultasi_id BIGINT UNSIGNED NOT NULL,
  gejala_id BIGINT UNSIGNED NOT NULL,
  cf_user DECIMAL(3,2) NOT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  CONSTRAINT detail_konsultasi_fk FOREIGN KEY (konsultasi_id) REFERENCES konsultasis(id) ON DELETE CASCADE,
  CONSTRAINT detail_gejala_fk FOREIGN KEY (gejala_id) REFERENCES gejalas(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE hasil_diagnosas (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  konsultasi_id BIGINT UNSIGNED NOT NULL,
  kerusakan_id BIGINT UNSIGNED NOT NULL,
  nilai_cf DECIMAL(5,2) NOT NULL,
  gejala_cocok_json JSON NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  UNIQUE KEY hasil_unique (konsultasi_id, kerusakan_id),
  CONSTRAINT hasil_konsultasi_fk FOREIGN KEY (konsultasi_id) REFERENCES konsultasis(id) ON DELETE CASCADE,
  CONSTRAINT hasil_kerusakan_fk FOREIGN KEY (kerusakan_id) REFERENCES kerusakans(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO users (id, name, email, password, role, created_at, updated_at) VALUES
(1, 'Admin Pakar', 'admin@sistempakar.test', '$2y$12$SOhdO/nbRw85HPqRCcyO8upmnfEjHLLc67492vR.FeVdR.vZJWXqy', 'admin', NOW(), NOW());

INSERT INTO gejalas (id, kode_gejala, nama_gejala, kategori, created_at, updated_at) VALUES
(1,'G01','Laptop tidak menyala sama sekali','Power',NOW(),NOW()),
(2,'G02','Lampu indikator charger tidak menyala','Power',NOW(),NOW()),
(3,'G03','Laptop tidak merespon saat tombol power ditekan','Power',NOW(),NOW()),
(4,'G04','Laptop hanya menyala saat charger terpasang','Power',NOW(),NOW()),
(5,'G05','Baterai cepat habis','Power',NOW(),NOW()),
(6,'G06','Baterai tidak mengisi','Power',NOW(),NOW()),
(7,'G07','Laptop menyala tetapi layar gelap','Display',NOW(),NOW()),
(8,'G08','Layar berkedip','Display',NOW(),NOW()),
(9,'G09','Layar bergaris','Display',NOW(),NOW()),
(10,'G10','Tampilan layar pecah atau buram','Display',NOW(),NOW()),
(11,'G11','Laptop cepat panas','Cooling',NOW(),NOW()),
(12,'G12','Kipas laptop berisik','Cooling',NOW(),NOW()),
(13,'G13','Laptop sering mati sendiri','Cooling',NOW(),NOW()),
(14,'G14','Laptop sangat lambat','Software',NOW(),NOW()),
(15,'G15','Laptop sering hang','Software',NOW(),NOW()),
(16,'G16','Muncul blue screen','Software',NOW(),NOW()),
(17,'G17','Windows gagal booting','Software',NOW(),NOW()),
(18,'G18','Laptop restart sendiri','Software',NOW(),NOW()),
(19,'G19','Hard disk berbunyi tidak normal','Storage',NOW(),NOW()),
(20,'G20','File sering corrupt atau hilang','Storage',NOW(),NOW()),
(21,'G21','Keyboard tidak berfungsi sebagian','Input Device',NOW(),NOW()),
(22,'G22','Keyboard mengetik sendiri','Input Device',NOW(),NOW()),
(23,'G23','Touchpad tidak merespon','Input Device',NOW(),NOW()),
(24,'G24','WiFi tidak terdeteksi','Network',NOW(),NOW()),
(25,'G25','Koneksi WiFi sering putus','Network',NOW(),NOW()),
(26,'G26','Suara laptop tidak keluar','Audio',NOW(),NOW()),
(27,'G27','Port USB tidak terbaca','Hardware',NOW(),NOW()),
(28,'G28','Aplikasi sering force close','Software',NOW(),NOW()),
(29,'G29','Banyak iklan atau pop-up muncul','Software',NOW(),NOW()),
(30,'G30','Laptop terasa berat saat membuka banyak aplikasi','Software',NOW(),NOW());

INSERT INTO kerusakans (id, kode_kerusakan, nama_kerusakan, kategori, deskripsi, penyebab, solusi, created_at, updated_at) VALUES
(1,'K01','Kerusakan charger/adaptor','Power','Adaptor atau jalur pengisian daya tidak mampu menyuplai daya dengan baik.','Kabel charger putus, adaptor rusak, port charger longgar, atau tegangan tidak stabil.','Periksa kabel charger, adaptor, dan port charger. Coba gunakan charger lain yang sesuai.',NOW(),NOW()),
(2,'K02','Kerusakan baterai','Power','Baterai tidak dapat menyimpan atau menerima daya secara normal.','Umur baterai sudah menurun, cell baterai drop, atau sistem pengisian bermasalah.','Cek kesehatan baterai, lakukan kalibrasi baterai, atau ganti baterai jika sudah drop.',NOW(),NOW()),
(3,'K03','Kerusakan RAM','Memory','RAM bermasalah sehingga sistem tidak stabil saat berjalan.','RAM kotor, slot RAM bermasalah, atau modul RAM rusak.','Lepas dan pasang ulang RAM, bersihkan pin RAM, atau coba gunakan slot RAM lain.',NOW(),NOW()),
(4,'K04','Kerusakan HDD/SSD','Storage','Media penyimpanan bermasalah sehingga sistem lambat dan file sering rusak.','Bad sector, umur storage menurun, konektor longgar, atau firmware bermasalah.','Cek kesehatan HDD/SSD, lakukan backup data, dan ganti storage jika ditemukan bad sector.',NOW(),NOW()),
(5,'K05','Overheat / sistem pendingin bermasalah','Cooling','Suhu laptop terlalu tinggi karena pendinginan tidak optimal.','Kipas kotor, ventilasi tersumbat, thermal paste kering, atau beban aplikasi terlalu berat.','Bersihkan kipas dan ventilasi, ganti thermal paste, serta gunakan cooling pad.',NOW(),NOW()),
(6,'K06','Kerusakan LCD atau fleksibel layar','Display','Tampilan layar bermasalah karena panel LCD atau kabel fleksibel terganggu.','LCD retak, fleksibel longgar, backlight bermasalah, atau konektor display rusak.','Periksa kabel fleksibel layar, sambungkan ke monitor eksternal, dan ganti LCD jika diperlukan.',NOW(),NOW()),
(7,'K07','Kerusakan keyboard','Input Device','Keyboard tidak menerima input dengan normal.','Kotoran masuk, tombol aus, jalur fleksibel keyboard longgar, atau keyboard rusak.','Bersihkan keyboard, cek konektor keyboard, atau gunakan keyboard eksternal untuk pengujian.',NOW(),NOW()),
(8,'K08','Kerusakan touchpad','Input Device','Touchpad tidak dapat menggerakkan kursor atau klik dengan normal.','Driver touchpad bermasalah, fitur touchpad nonaktif, atau konektor touchpad longgar.','Periksa driver touchpad, aktifkan pengaturan touchpad, atau cek konektor touchpad.',NOW(),NOW()),
(9,'K09','Kerusakan modul WiFi','Network','Laptop tidak dapat mendeteksi jaringan WiFi dengan stabil.','Driver WiFi error, modul WiFi rusak, atau antena WiFi bermasalah.','Cek driver WiFi, restart adaptor jaringan, atau ganti modul WiFi jika rusak.',NOW(),NOW()),
(10,'K10','Kerusakan speaker/audio','Audio','Laptop tidak menghasilkan suara dengan normal.','Driver audio rusak, speaker internal rusak, atau pengaturan audio salah.','Periksa driver audio, pengaturan suara, dan kondisi speaker internal.',NOW(),NOW()),
(11,'K11','Kerusakan port USB','Hardware','Port USB tidak dapat membaca perangkat eksternal.','Port kotor, pin rusak, driver USB bermasalah, atau jalur port terganggu.','Coba perangkat USB lain, cek driver USB, dan periksa kondisi fisik port USB.',NOW(),NOW()),
(12,'K12','Sistem operasi bermasalah','Software','Sistem operasi tidak berjalan stabil atau gagal booting.','File sistem rusak, update gagal, konfigurasi boot bermasalah, atau aplikasi konflik.','Lakukan repair Windows, update sistem, restore sistem, atau install ulang jika diperlukan.',NOW(),NOW()),
(13,'K13','Driver bermasalah','Software','Perangkat tidak berjalan normal karena driver tidak sesuai atau rusak.','Driver belum terpasang, driver corrupt, atau versi driver tidak kompatibel.','Update atau install ulang driver yang bermasalah melalui Device Manager.',NOW(),NOW()),
(14,'K14','Terinfeksi virus/malware','Software','Sistem terganggu oleh program berbahaya atau aplikasi mencurigakan.','Malware, adware, ekstensi browser berbahaya, atau file tidak aman.','Scan menggunakan antivirus, hapus program mencurigakan, dan reset browser jika banyak iklan muncul.',NOW(),NOW()),
(15,'K15','Kerusakan motherboard','Hardware','Kerusakan pada papan utama laptop yang menghubungkan seluruh komponen.','IC power rusak, jalur short, komponen terbakar, atau kerusakan kelistrikan internal.','Lakukan pemeriksaan teknisi karena kerusakan motherboard membutuhkan pengecekan komponen secara langsung.',NOW(),NOW());

INSERT INTO rules (kerusakan_id, gejala_id, cf_pakar, created_at, updated_at) VALUES
(1,1,0.85,NOW(),NOW()),(1,2,0.85,NOW(),NOW()),(1,3,0.85,NOW(),NOW()),
(2,4,0.90,NOW(),NOW()),(2,5,0.90,NOW(),NOW()),(2,6,0.90,NOW(),NOW()),
(3,7,0.80,NOW(),NOW()),(3,15,0.80,NOW(),NOW()),(3,16,0.80,NOW(),NOW()),(3,18,0.80,NOW(),NOW()),
(4,14,0.85,NOW(),NOW()),(4,15,0.85,NOW(),NOW()),(4,19,0.85,NOW(),NOW()),(4,20,0.85,NOW(),NOW()),
(5,11,0.90,NOW(),NOW()),(5,12,0.90,NOW(),NOW()),(5,13,0.90,NOW(),NOW()),
(6,7,0.85,NOW(),NOW()),(6,8,0.85,NOW(),NOW()),(6,9,0.85,NOW(),NOW()),(6,10,0.85,NOW(),NOW()),
(7,21,0.80,NOW(),NOW()),(7,22,0.80,NOW(),NOW()),
(8,23,0.75,NOW(),NOW()),
(9,24,0.80,NOW(),NOW()),(9,25,0.80,NOW(),NOW()),
(10,26,0.75,NOW(),NOW()),
(11,27,0.75,NOW(),NOW()),
(12,16,0.85,NOW(),NOW()),(12,17,0.85,NOW(),NOW()),(12,18,0.85,NOW(),NOW()),(12,28,0.85,NOW(),NOW()),
(13,24,0.80,NOW(),NOW()),(13,26,0.80,NOW(),NOW()),(13,27,0.80,NOW(),NOW()),
(14,14,0.85,NOW(),NOW()),(14,28,0.85,NOW(),NOW()),(14,29,0.85,NOW(),NOW()),(14,30,0.85,NOW(),NOW()),
(15,1,0.90,NOW(),NOW()),(15,3,0.90,NOW(),NOW()),(15,7,0.90,NOW(),NOW()),(15,13,0.90,NOW(),NOW());
