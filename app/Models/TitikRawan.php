<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'nomor', 'nama', 'kota_kabupaten', 'deskripsi', 'latitude', 'longitude',
    'kategori', 'foto', 'link_maps', 'akses', 'jangkauan', 'tempat_sandar',
    'jenis_kapal', 'mpm', 'status_koordinat',
])]
class TitikRawan extends Model
{
    protected function casts(): array
    {
        return [
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
        ];
    }

    public function fotoUrl(): ?string
    {
        return $this->foto ? route('titik-rawan.foto', $this) : null;
    }

    public static function mapPoints(): array
    {
        return static::query()
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get()
            ->map(fn (self $titik) => [
                'nama' => $titik->nama,
                'kota_kabupaten' => $titik->kota_kabupaten,
                'deskripsi' => $titik->deskripsi,
                'latitude' => $titik->latitude,
                'longitude' => $titik->longitude,
                'foto_url' => $titik->fotoUrl(),
                'akses' => $titik->akses,
                'jenis_kapal' => $titik->jenis_kapal,
                'show_url' => route('titik-rawan.show', $titik),
            ])->all();
    }
}
