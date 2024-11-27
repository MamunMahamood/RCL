<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'unit_id',
        'designation',
        'phone_number',
        'blood_group',
        'address',
        'profile_picture',
        'email',
        'extra_skill',
        'unique_id',
        'joining_date',
        'education',
        'awards',
        'blood_donation_count',
        'reveiew_points',
    ];


    public function user(){
        return $this->belongsTo(User::class);
    }


    
}
