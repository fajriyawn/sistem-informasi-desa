<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadLog extends Model
{
    use HasFactory;

    protected $fillable = ['soc_report_id', 'name', 'email'];

    /**
     * Definisikan relasi inverse one-to-many.
     * Setiap log unduhan "milik" satu SocReport.
     */
    public function socReport()
    {
        return $this->belongsTo(SocReport::class);
    }

    public function downloadable()
    {
        return $this->morphTo();
    }
}
