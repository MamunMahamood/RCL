<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExternalTraining extends Model
{
    use HasFactory;
    protected $fillable = [
        'volunteer_id',
        'training_name',
        'duration',
        'attend_date',
        'organization_name',
    ];
}
