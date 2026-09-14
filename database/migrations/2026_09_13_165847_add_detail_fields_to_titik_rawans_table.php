<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('titik_rawans', function (Blueprint $table) {
            $table->unsignedInteger('nomor')->nullable()->after('id');
            $table->string('kota_kabupaten')->nullable()->after('nama');
            $table->string('link_maps')->nullable()->after('longitude');
            $table->string('akses')->nullable()->after('link_maps');
            $table->string('jangkauan')->nullable()->after('akses');
            $table->string('tempat_sandar')->nullable()->after('jangkauan');
            $table->string('jenis_kapal')->nullable()->after('tempat_sandar');
            $table->string('mpm')->nullable()->after('jenis_kapal');
            $table->string('status_koordinat')->nullable()->after('mpm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('titik_rawans', function (Blueprint $table) {
            $table->dropColumn([
                'nomor',
                'kota_kabupaten',
                'link_maps',
                'akses',
                'jangkauan',
                'tempat_sandar',
                'jenis_kapal',
                'mpm',
                'status_koordinat',
            ]);
        });
    }
};
