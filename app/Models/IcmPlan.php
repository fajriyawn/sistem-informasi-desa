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
        'original_filename',
        'reviews_enabled',
        'description'
    ];

    protected $casts = [
        'reviews_enabled' => 'boolean',
    ];

    protected $attributes = [
        'reviews_enabled' => true,
    ];

    public function city() {
        return $this->belongsTo(City::class);
    }

    public function downloadLogs()
    {
        return $this->morphMany(DownloadLog::class, 'downloadable');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable')->where('is_published', true)->orderBy('created_at', 'desc');
    }
}
