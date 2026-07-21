<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('disposisi', function (Blueprint $table) {
            $table->string('nomor_agenda', 100)->nullable()->after('nomor_disposisi');
            $table->string('asal_surat')->nullable()->after('tanggal_penyelesaian');
            $table->date('tanggal_surat')->nullable()->after('asal_surat');
            $table->date('tanggal_terima')->nullable()->after('tanggal_surat');
            $table->string('perihal')->nullable()->after('tanggal_terima');
        });
    }

    public function down(): void
    {
        Schema::table('disposisi', function (Blueprint $table) {
            $table->dropColumn(['nomor_agenda', 'asal_surat', 'tanggal_surat', 'tanggal_terima', 'perihal']);
        });
    }
};
