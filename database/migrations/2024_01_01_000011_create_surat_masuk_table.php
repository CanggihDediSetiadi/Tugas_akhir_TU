<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('surat_masuk', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat')->unique();
            $table->date('tanggal_surat')->nullable();
            $table->date('tanggal_terima');
            $table->string('asal_surat');
            $table->string('perihal');
            $table->longText('isi_surat')->nullable();
            $table->string('klasifikasi')->default('Biasa');   // Biasa, Penting, Rahasia
            $table->string('status')->default('belum_disposisi'); // belum_disposisi, sudah_disposisi, selesai
            $table->json('lampiran')->nullable();
            $table->text('keterangan')->nullable();
            $table->foreignId('diterima_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('surat_masuk');
    }
};
