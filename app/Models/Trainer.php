<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;
    protected $fillable = [
        'trainer_name',
        'trainer_designation',
    ];
    public function trainings()
    {
        return $this->belongsToMany(Training::class, 'training_trainer');
    }
}
