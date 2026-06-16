# Sistem Pakar Diagnosa Kerusakan Hardware dan Software Laptop

Project UAS berbasis **Laravel + MySQL** dengan metode **Forward Chaining** dan **Certainty Factor**.

## Fitur

- Landing page modern dan responsive
- Konsultasi gejala kerusakan laptop
- Input tingkat keyakinan user untuk setiap gejala
- Forward Chaining untuk pencocokan gejala dengan rule
- Certainty Factor untuk perhitungan persentase keyakinan
- Hasil diagnosa utama dan alternatif
- Solusi awal berdasarkan hasil diagnosa
- Cetak hasil diagnosa
- Login admin/pakar
- Dashboard admin
- CRUD gejala
- CRUD kerusakan
- CRUD rule dan nilai CF pakar
- Riwayat konsultasi
- Laporan konsultasi dan statistik diagnosa
- Database menggunakan **MySQL migration**, bukan seeder
- Data awal gejala, kerusakan, rule, dan akun admin otomatis masuk lewat migration

## Akun Admin Default

```text
Email    : admin@sistempakar.test
Password : password
```

## Cara Menjalankan dengan MySQL XAMPP/Laragon

### 1. Ekstrak Project

Ekstrak ZIP ke folder project, misalnya:

```text
C:/xampp/htdocs/sistem-pakar-laravel
```

atau folder project Laragon.

### 2. Install Dependency

Masuk ke folder project lalu jalankan:

```bash
composer install
```

### 3. Buat Database MySQL

Buat database di phpMyAdmin dengan nama:

```text
sistem_pakar_laptop
```

Atau jalankan file SQL ini di phpMyAdmin:

```text
database/create_database_mysql.sql
```

### 4. Atur File `.env`

Pastikan konfigurasi database seperti ini:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_pakar_laptop
DB_USERNAME=root
DB_PASSWORD=
```

Untuk XAMPP biasanya `DB_USERNAME=root` dan `DB_PASSWORD=` kosong.

### 5. Generate Key Laravel

```bash
php artisan key:generate
```

### 6. Jalankan Migration

Cukup jalankan:

```bash
php artisan migrate
```

Tidak perlu `--seed`, karena data awal sudah dimasukkan lewat migration:

```text
database/migrations/2026_06_15_000003_insert_initial_expert_knowledge.php
```

Migration tersebut otomatis membuat:

- akun admin default
- 30 data gejala
- 15 data kerusakan
- rule basis pengetahuan
- nilai CF pakar

### 7. Jalankan Server

```bash
php artisan serve
```

Buka browser:

```text
http://localhost:8000
```

## Cara Reset Database

Kalau ingin menghapus dan membuat ulang semua tabel MySQL:

```bash
php artisan migrate:fresh
```

Jangan pakai `--seed`, karena data awal sudah otomatis dibuat oleh migration.

## Rumus Certainty Factor

```text
CF Gejala = CF User × CF Pakar
CF Combine = CF1 + CF2 × (1 - CF1)
Persentase = CF Combine × 100%
```

## Alur Sistem

```text
User memilih gejala
        ↓
Sistem membaca rule basis pengetahuan
        ↓
Forward Chaining mencocokkan gejala dengan kerusakan
        ↓
Certainty Factor menghitung tingkat keyakinan
        ↓
Sistem menampilkan hasil diagnosa dan solusi awal
```

## Struktur Penting

```text
app/Http/Controllers/
app/Models/
database/migrations/
resources/views/
public/assets/css/app.css
public/assets/js/app.js
routes/web.php
database/create_database_mysql.sql
```

## Catatan

Sistem ini digunakan sebagai alat bantu diagnosa awal, bukan pengganti pemeriksaan langsung oleh teknisi laptop.

## UI
<img width="1358" height="613" alt="image" src="https://github.com/user-attachments/assets/b9db7477-0751-4361-b606-ceca88303545" />
<img width="1358" height="613" alt="image" src="https://github.com/user-attachments/assets/57b62eef-0ebd-4304-bf61-ef9a196f6d62" />
<img width="1358" height="613" alt="image" src="https://github.com/user-attachments/assets/710b5d09-bfa6-4d93-be6c-d573a4355d97" />


