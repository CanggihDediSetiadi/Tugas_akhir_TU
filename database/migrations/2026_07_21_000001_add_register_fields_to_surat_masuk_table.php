<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->string('no_urut_masuk', 50)->nullable()->after('id');
            $table->date('tanggal_disposisi')->nullable()->after('tanggal_terima');
            $table->string('diteruskan_ke')->nullable()->after('perihal');
        });
    }

    public function down(): void
    {
        Schema::table('surat_masuk', function (Blueprint $table) {
            $table->dropColumn(['no_urut_masuk', 'tanggal_disposisi', 'diteruskan_ke']);
        });
    }
};
