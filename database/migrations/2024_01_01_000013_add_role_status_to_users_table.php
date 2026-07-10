<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('Staf TU')->after('email');
            // role: Admin, Kepala Sekolah, Wakasek, Staf TU, Guru, Bendahara
            $table->string('status')->default('active')->after('role');
            // status: active, inactive, pending
            $table->string('nip')->nullable()->after('status');
            $table->string('jabatan')->nullable()->after('nip');
            $table->timestamp('last_login_at')->nullable()->after('jabatan');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'status', 'nip', 'jabatan', 'last_login_at']);
        });
    }
};
