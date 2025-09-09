<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'title',
        'type',
        'location_name',
        'address_detail',
        'city_name',
        'latitude',
        'longitude',
        'content',
        'status',
        'internal_notes',
        'tracking_code',
    ];

    protected static function booted(): void
    {
        static::creating(function (Service $service) {
            // Jika tracking_code belum diisi, buat yang baru
            if (empty($service->tracking_code)) {

                do {

                    $code = 'LP-' . strtoupper(Str::random(8));
                } while (self::where('tracking_code', $code)->exists());

                $service->tracking_code = $code;
            }
        });
    }


}
