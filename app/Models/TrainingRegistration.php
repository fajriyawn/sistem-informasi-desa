<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'organization_name',
        'participant_count',
        'training_topic',
        'proposed_date',
        'message',
        'status',
    ];

    protected $casts = [
        'proposed_date' => 'date',
    ];
}
