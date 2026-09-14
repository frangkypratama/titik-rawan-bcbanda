<?php

namespace App\Console\Commands;

use App\Models\TitikRawan;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:import-titik-rawan {path : Path ke file JSON} {--truncate : Hapus semua data titik rawan lama sebelum import}')]
#[Description('Import data titik rawan dari file JSON')]
class ImportTitikRawan extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = $this->argument('path');

        if (! is_file($path)) {
            $this->error("File tidak ditemukan: {$path}");

            return self::FAILURE;
        }

        $json = json_decode(file_get_contents($path), true);

        if (! is_array($json)) {
            $this->error('File JSON tidak valid atau bukan berupa array.');

            return self::FAILURE;
        }

        if ($this->option('truncate')) {
            TitikRawan::query()->delete();
            $this->warn('Data titik rawan lama telah dihapus.');
        }

        $imported = 0;
        $perluVerifikasi = 0;

        foreach ($json as $row) {
            $latitude = $row['latitude'] ?? null;
            $longitude = $row['longitude'] ?? null;

            if (! is_numeric($latitude) || ! is_numeric($longitude)) {
                $latitude = null;
                $longitude = null;
                $perluVerifikasi++;
            }

            TitikRawan::create([
                'nomor' => $row['no'] ?? null,
                'nama' => $row['nama_lokasi'] ?? '(Tanpa Nama)',
                'kota_kabupaten' => $row['kota_kabupaten'] ?? null,
                'deskripsi' => $row['keterangan'] ?? null,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'link_maps' => $row['link_maps'] ?? null,
                'akses' => $row['akses'] ?? null,
                'jangkauan' => $row['jangkauan'] ?? null,
                'tempat_sandar' => $row['tempat_sandar'] ?? null,
                'jenis_kapal' => $row['jenis_kapal'] ?? null,
                'mpm' => $row['mpm'] ?? null,
                'status_koordinat' => $row['status_koordinat'] ?? null,
            ]);

            $imported++;
        }

        $this->info("Berhasil mengimpor {$imported} titik rawan.");

        if ($perluVerifikasi > 0) {
            $this->warn("{$perluVerifikasi} titik memiliki koordinat tidak valid dan perlu diverifikasi manual (bisa dicek lewat kolom status_koordinat / link_maps).");
        }

        return self::SUCCESS;
    }
}
