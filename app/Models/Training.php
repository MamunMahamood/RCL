<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_event_name',
        'training_event_type',
        'training_event_duration',
        'training_event_location',
        'training_event_total_members',
        'training_event_description',
        'training_event_schedule',
        'training_event_banner_img',
    ];


    public function trainers()
    {
        return $this->belongsToMany(Trainer::class, 'training_trainer');
    }
    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}
