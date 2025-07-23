<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function socReports()
    {
        return $this->hasMany(SocReport::class);
    }
}
