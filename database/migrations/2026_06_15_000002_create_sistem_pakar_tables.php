<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('gejalas', function (Blueprint $table) {
            $table->id();
            $table->string('kode_gejala', 10)->unique();
            $table->string('nama_gejala');
            $table->string('kategori')->default('Umum');
            $table->timestamps();
        });

        Schema::create('kerusakans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kerusakan', 10)->unique();
            $table->string('nama_kerusakan');
            $table->string('kategori')->default('Umum');
            $table->text('deskripsi')->nullable();
            $table->text('penyebab')->nullable();
            $table->text('solusi')->nullable();
            $table->timestamps();
        });

        Schema::create('rules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kerusakan_id')->constrained('kerusakans')->cascadeOnDelete();
            $table->foreignId('gejala_id')->constrained('gejalas')->cascadeOnDelete();
            $table->decimal('cf_pakar', 3, 2);
            $table->timestamps();
            $table->unique(['kerusakan_id', 'gejala_id']);
        });

        Schema::create('konsultasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pengguna');
            $table->dateTime('tanggal');
            $table->foreignId('hasil_kerusakan_id')->nullable()->constrained('kerusakans')->nullOnDelete();
            $table->decimal('nilai_cf', 5, 2)->default(0);
            $table->timestamps();
        });

        Schema::create('detail_konsultasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konsultasi_id')->constrained('konsultasis')->cascadeOnDelete();
            $table->foreignId('gejala_id')->constrained('gejalas')->cascadeOnDelete();
            $table->decimal('cf_user', 3, 2);
            $table->timestamps();
        });

        Schema::create('hasil_diagnosas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konsultasi_id')->constrained('konsultasis')->cascadeOnDelete();
            $table->foreignId('kerusakan_id')->constrained('kerusakans')->cascadeOnDelete();
            $table->decimal('nilai_cf', 5, 2);
            $table->json('gejala_cocok_json')->nullable();
            $table->timestamps();
            $table->unique(['konsultasi_id', 'kerusakan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hasil_diagnosas');
        Schema::dropIfExists('detail_konsultasis');
        Schema::dropIfExists('konsultasis');
        Schema::dropIfExists('rules');
        Schema::dropIfExists('kerusakans');
        Schema::dropIfExists('gejalas');
    }
};
