<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('arsip_digital', function (Blueprint $table) {
            $table->id();
            $table->string('nama_dokumen');
            $table->string('tipe')->default('file'); // file, folder
            $table->string('format')->nullable(); // pdf, docx, jpg, dll
            $table->string('kategori')->default('Umum'); // Surat Masuk, Surat Keluar, SK Guru/Staff, Ijazah/Sertifikat, Umum
            $table->string('klasifikasi')->default('Biasa'); // Rahasia, Terbatas, Biasa
            $table->string('status')->default('draft'); // tervalidasi, draft
            $table->integer('tahun')->nullable();
            $table->bigInteger('ukuran_bytes')->default(0); // ukuran file dalam bytes
            $table->string('path_file')->nullable(); // path file di storage
            $table->string('thumbnail')->nullable();
            $table->text('keterangan')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable(); // untuk folder hierarchy
            $table->foreignId('diunggah_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('arsip_digital');
    }
};
