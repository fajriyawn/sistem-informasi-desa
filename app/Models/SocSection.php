<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocSection extends Model
{
    protected $fillable = [
        'key',
        'title',
        'image_path',
    ];
}
