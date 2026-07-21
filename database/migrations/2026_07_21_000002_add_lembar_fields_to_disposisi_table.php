<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('disposisi', function (Blueprint $table) {
            $table->date('tanggal_disposisi')->nullable()->after('nomor_disposisi');
            $table->date('tanggal_penyelesaian')->nullable()->after('tanggal_disposisi');
            $table->json('instruksi_pilihan')->nullable()->after('instruksi');
            $table->json('penerima_pilihan')->nullable()->after('instruksi_pilihan');
            $table->text('paraf')->nullable()->after('penerima_pilihan');
            $table->text('memo')->nullable()->after('paraf');
        });
    }

    public function down(): void
    {
        Schema::table('disposisi', function (Blueprint $table) {
            $table->dropColumn([
                'tanggal_disposisi',
                'tanggal_penyelesaian',
                'instruksi_pilihan',
                'penerima_pilihan',
                'paraf',
                'memo',
            ]);
        });
    }
};
