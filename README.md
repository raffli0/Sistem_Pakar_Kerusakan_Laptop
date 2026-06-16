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
<img width="1352" height="611" alt="image" src="https://github.com/user-attachments/assets/66974abb-91d1-4687-bc8a-e356077d1ba7" />

---

<img width="1352" height="611" alt="image" src="https://github.com/user-attachments/assets/0bfe955b-95b0-4df9-b4c2-7683b0238dce" />

---

<img width="1352" height="611" alt="image" src="https://github.com/user-attachments/assets/be5969dd-649a-47e8-a9e6-d4ec5acba61f" />

---

<img width="1352" height="611" alt="image" src="https://github.com/user-attachments/assets/46fb64c7-ef57-41b9-b733-58d0fd3339c8" />

---

<img width="1352" height="611" alt="image" src="https://github.com/user-attachments/assets/da638fd7-92a9-408f-a9ca-7e41658ad822" />

---

<img width="1352" height="611" alt="image" src="https://github.com/user-attachments/assets/40111d5c-129e-4081-ab2a-490507206551" />

---

<img width="1352" height="611" alt="image" src="https://github.com/user-attachments/assets/18a0b091-da5e-492a-ba15-b6f9fc50b6d2" />

---

<img width="1352" height="611" alt="image" src="https://github.com/user-attachments/assets/993307ab-db47-4009-8114-1668e1b4bdde" />

---

<img width="1358" height="613" alt="image" src="https://github.com/user-attachments/assets/710b5d09-bfa6-4d93-be6c-d573a4355d97" />

---

<img width="1352" height="611" alt="image" src="https://github.com/user-attachments/assets/8b40d701-d6fd-4929-94fd-55196f788b80" />

---

<img width="1352" height="611" alt="image" src="https://github.com/user-attachments/assets/80531a90-d651-4954-9908-6beee7f76191" />

---

<img width="1352" height="611" alt="image" src="https://github.com/user-attachments/assets/c1ceb533-a8e1-4431-b68b-ba6c217fb282" />

---

<img width="1352" height="611" alt="image" src="https://github.com/user-attachments/assets/9e57397e-7b80-4b62-ae02-b9dd3f3f7cbc" />

---

<img width="1352" height="611" alt="image" src="https://github.com/user-attachments/assets/e4048593-6f56-4eb9-b76f-2fdf561672f8" />

---

<img width="1352" height="611" alt="image" src="https://github.com/user-attachments/assets/31d8d2a9-8118-4784-a58c-dd2cab3a0537" />

---
