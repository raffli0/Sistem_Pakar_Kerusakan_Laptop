<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration {
    public function up(): void
    {
        $now = now();

        DB::table('users')->updateOrInsert(
            ['email' => 'admin@sistempakar.test'],
            [
                'name' => 'Admin Pakar',
                'email_verified_at' => $now,
                'password' => Hash::make('password'),
                'role' => 'admin',
                'remember_token' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ]
        );

        $gejalas = [
            ['G01', 'Laptop tidak menyala sama sekali', 'Power'],
            ['G02', 'Lampu indikator charger tidak menyala', 'Power'],
            ['G03', 'Laptop tidak merespon saat tombol power ditekan', 'Power'],
            ['G04', 'Laptop hanya menyala saat charger terpasang', 'Power'],
            ['G05', 'Baterai cepat habis', 'Power'],
            ['G06', 'Baterai tidak mengisi', 'Power'],
            ['G07', 'Laptop menyala tetapi layar gelap', 'Display'],
            ['G08', 'Layar berkedip', 'Display'],
            ['G09', 'Layar bergaris', 'Display'],
            ['G10', 'Tampilan layar pecah atau buram', 'Display'],
            ['G11', 'Laptop cepat panas', 'Cooling'],
            ['G12', 'Kipas laptop berisik', 'Cooling'],
            ['G13', 'Laptop sering mati sendiri', 'Cooling'],
            ['G14', 'Laptop sangat lambat', 'Software'],
            ['G15', 'Laptop sering hang', 'Software'],
            ['G16', 'Muncul blue screen', 'Software'],
            ['G17', 'Windows gagal booting', 'Software'],
            ['G18', 'Laptop restart sendiri', 'Software'],
            ['G19', 'Hard disk berbunyi tidak normal', 'Storage'],
            ['G20', 'File sering corrupt atau hilang', 'Storage'],
            ['G21', 'Keyboard tidak berfungsi sebagian', 'Input Device'],
            ['G22', 'Keyboard mengetik sendiri', 'Input Device'],
            ['G23', 'Touchpad tidak merespon', 'Input Device'],
            ['G24', 'WiFi tidak terdeteksi', 'Network'],
            ['G25', 'Koneksi WiFi sering putus', 'Network'],
            ['G26', 'Suara laptop tidak keluar', 'Audio'],
            ['G27', 'Port USB tidak terbaca', 'Hardware'],
            ['G28', 'Aplikasi sering force close', 'Software'],
            ['G29', 'Banyak iklan atau pop-up muncul', 'Software'],
            ['G30', 'Laptop terasa berat saat membuka banyak aplikasi', 'Software'],
        ];

        foreach ($gejalas as [$kode, $nama, $kategori]) {
            DB::table('gejalas')->updateOrInsert(
                ['kode_gejala' => $kode],
                [
                    'nama_gejala' => $nama,
                    'kategori' => $kategori,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $kerusakans = [
            ['K01', 'Kerusakan charger/adaptor', 'Power', 'Adaptor atau jalur pengisian daya tidak mampu menyuplai daya dengan baik.', 'Kabel charger putus, adaptor rusak, port charger longgar, atau tegangan tidak stabil.', 'Periksa kabel charger, adaptor, dan port charger. Coba gunakan charger lain yang sesuai.'],
            ['K02', 'Kerusakan baterai', 'Power', 'Baterai tidak dapat menyimpan atau menerima daya secara normal.', 'Umur baterai sudah menurun, cell baterai drop, atau sistem pengisian bermasalah.', 'Cek kesehatan baterai, lakukan kalibrasi baterai, atau ganti baterai jika sudah drop.'],
            ['K03', 'Kerusakan RAM', 'Memory', 'RAM bermasalah sehingga sistem tidak stabil saat berjalan.', 'RAM kotor, slot RAM bermasalah, atau modul RAM rusak.', 'Lepas dan pasang ulang RAM, bersihkan pin RAM, atau coba gunakan slot RAM lain.'],
            ['K04', 'Kerusakan HDD/SSD', 'Storage', 'Media penyimpanan bermasalah sehingga sistem lambat dan file sering rusak.', 'Bad sector, umur storage menurun, konektor longgar, atau firmware bermasalah.', 'Cek kesehatan HDD/SSD, lakukan backup data, dan ganti storage jika ditemukan bad sector.'],
            ['K05', 'Overheat / sistem pendingin bermasalah', 'Cooling', 'Suhu laptop terlalu tinggi karena pendinginan tidak optimal.', 'Kipas kotor, ventilasi tersumbat, thermal paste kering, atau beban aplikasi terlalu berat.', 'Bersihkan kipas dan ventilasi, ganti thermal paste, serta gunakan cooling pad.'],
            ['K06', 'Kerusakan LCD atau fleksibel layar', 'Display', 'Tampilan layar bermasalah karena panel LCD atau kabel fleksibel terganggu.', 'LCD retak, fleksibel longgar, backlight bermasalah, atau konektor display rusak.', 'Periksa kabel fleksibel layar, sambungkan ke monitor eksternal, dan ganti LCD jika diperlukan.'],
            ['K07', 'Kerusakan keyboard', 'Input Device', 'Keyboard tidak menerima input dengan normal.', 'Kotoran masuk, tombol aus, jalur fleksibel keyboard longgar, atau keyboard rusak.', 'Bersihkan keyboard, cek konektor keyboard, atau gunakan keyboard eksternal untuk pengujian.'],
            ['K08', 'Kerusakan touchpad', 'Input Device', 'Touchpad tidak dapat menggerakkan kursor atau klik dengan normal.', 'Driver touchpad bermasalah, fitur touchpad nonaktif, atau konektor touchpad longgar.', 'Periksa driver touchpad, aktifkan pengaturan touchpad, atau cek konektor touchpad.'],
            ['K09', 'Kerusakan modul WiFi', 'Network', 'Laptop tidak dapat mendeteksi jaringan WiFi dengan stabil.', 'Driver WiFi error, modul WiFi rusak, atau antena WiFi bermasalah.', 'Cek driver WiFi, restart adaptor jaringan, atau ganti modul WiFi jika rusak.'],
            ['K10', 'Kerusakan speaker/audio', 'Audio', 'Laptop tidak menghasilkan suara dengan normal.', 'Driver audio rusak, speaker internal rusak, atau pengaturan audio salah.', 'Periksa driver audio, pengaturan suara, dan kondisi speaker internal.'],
            ['K11', 'Kerusakan port USB', 'Hardware', 'Port USB tidak dapat membaca perangkat eksternal.', 'Port kotor, pin rusak, driver USB bermasalah, atau jalur port terganggu.', 'Coba perangkat USB lain, cek driver USB, dan periksa kondisi fisik port USB.'],
            ['K12', 'Sistem operasi bermasalah', 'Software', 'Sistem operasi tidak berjalan stabil atau gagal booting.', 'File sistem rusak, update gagal, konfigurasi boot bermasalah, atau aplikasi konflik.', 'Lakukan repair Windows, update sistem, restore sistem, atau install ulang jika diperlukan.'],
            ['K13', 'Driver bermasalah', 'Software', 'Perangkat tidak berjalan normal karena driver tidak sesuai atau rusak.', 'Driver belum terpasang, driver corrupt, atau versi driver tidak kompatibel.', 'Update atau install ulang driver yang bermasalah melalui Device Manager.'],
            ['K14', 'Terinfeksi virus/malware', 'Software', 'Sistem terganggu oleh program berbahaya atau aplikasi mencurigakan.', 'Malware, adware, ekstensi browser berbahaya, atau file tidak aman.', 'Scan menggunakan antivirus, hapus program mencurigakan, dan reset browser jika banyak iklan muncul.'],
            ['K15', 'Kerusakan motherboard', 'Hardware', 'Kerusakan pada papan utama laptop yang menghubungkan seluruh komponen.', 'IC power rusak, jalur short, komponen terbakar, atau kerusakan kelistrikan internal.', 'Lakukan pemeriksaan teknisi karena kerusakan motherboard membutuhkan pengecekan komponen secara langsung.'],
        ];

        foreach ($kerusakans as [$kode, $nama, $kategori, $deskripsi, $penyebab, $solusi]) {
            DB::table('kerusakans')->updateOrInsert(
                ['kode_kerusakan' => $kode],
                [
                    'nama_kerusakan' => $nama,
                    'kategori' => $kategori,
                    'deskripsi' => $deskripsi,
                    'penyebab' => $penyebab,
                    'solusi' => $solusi,
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );
        }

        $gejalaIds = DB::table('gejalas')->pluck('id', 'kode_gejala');
        $kerusakanIds = DB::table('kerusakans')->pluck('id', 'kode_kerusakan');

        $rules = [
            ['K01', ['G01', 'G02', 'G03'], 0.85],
            ['K02', ['G04', 'G05', 'G06'], 0.90],
            ['K03', ['G07', 'G15', 'G16', 'G18'], 0.80],
            ['K04', ['G14', 'G15', 'G19', 'G20'], 0.85],
            ['K05', ['G11', 'G12', 'G13'], 0.90],
            ['K06', ['G07', 'G08', 'G09', 'G10'], 0.85],
            ['K07', ['G21', 'G22'], 0.80],
            ['K08', ['G23'], 0.75],
            ['K09', ['G24', 'G25'], 0.80],
            ['K10', ['G26'], 0.75],
            ['K11', ['G27'], 0.75],
            ['K12', ['G16', 'G17', 'G18', 'G28'], 0.85],
            ['K13', ['G24', 'G26', 'G27'], 0.80],
            ['K14', ['G14', 'G28', 'G29', 'G30'], 0.85],
            ['K15', ['G01', 'G03', 'G07', 'G13'], 0.90],
        ];

        foreach ($rules as [$kodeKerusakan, $kodeGejalas, $cf]) {
            foreach ($kodeGejalas as $kodeGejala) {
                DB::table('rules')->updateOrInsert(
                    [
                        'kerusakan_id' => $kerusakanIds[$kodeKerusakan],
                        'gejala_id' => $gejalaIds[$kodeGejala],
                    ],
                    [
                        'cf_pakar' => $cf,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]
                );
            }
        }
    }

    public function down(): void
    {
        DB::table('rules')->delete();
        DB::table('kerusakans')->delete();
        DB::table('gejalas')->delete();
        DB::table('users')->where('email', 'admin@sistempakar.test')->delete();
    }
};
