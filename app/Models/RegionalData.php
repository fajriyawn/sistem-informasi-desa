<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionalData extends Model
{
    use HasFactory;

    protected $table = 'regional_data';

    protected $fillable = [
        'city_id',
        'indicator_name',
        'indicator_value',
        'year',
        'source',
    ];

    /**
     * Definisikan relasi inverse.
     * Setiap data regional "milik" satu kota.
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
