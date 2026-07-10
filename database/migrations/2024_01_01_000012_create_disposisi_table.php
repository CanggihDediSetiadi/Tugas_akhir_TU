<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('disposisi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_masuk_id')->nullable()->constrained('surat_masuk')->nullOnDelete();
            $table->string('nomor_disposisi')->unique();
            $table->string('diteruskan_ke');          // Wakasek Kurikulum, Bendahara, dll
            $table->string('sifat')->default('segera'); // segera, sangat_segera
            $table->text('instruksi')->nullable();
            $table->string('status')->default('pending'); // pending, diproses, selesai
            $table->foreignId('dibuat_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('dikirim_at')->nullable();
            $table->timestamp('selesai_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('disposisi');
    }
};
