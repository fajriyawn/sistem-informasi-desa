<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'tahun',
        'ss_lingkungan',
        'ss_tata_kelola',
        'ss_pembangunan',
        'ss_matriks_icm',
        'file_laporan',
        'original_filename',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Definisikan relasi one-to-many ke DownloadLog.
     * Satu laporan bisa memiliki banyak log unduhan.
     */
    public function downloadLogs()
    {
        return $this->morphMany(DownloadLog::class, 'downloadable');
    }
}
