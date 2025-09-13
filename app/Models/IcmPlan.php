<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class IcmPlan extends Model {
    protected $fillable = [
        'city_id',
        'tahun',
        'ss_lingkungan', // Tambahkan
        'ss_tata_kelola', // Tambahkan
        'ss_pembangunan', // Tambahkan
        'ss_matriks_icm', // Tambahkan
        'file_laporan', // Ganti nama dari file_path
        'original_filename'
    ];

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function downloadLogs()
    {
        return $this->morphMany(DownloadLog::class, 'downloadable');
    }
}
