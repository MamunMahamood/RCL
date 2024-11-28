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


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function trainings()
    {
        return $this->belongsToMany(
            Training::class,
            'training_members',  // Pivot table name
            'volunteer_id',      // Foreign key in pivot for this model
            'training_id'        // Foreign key in pivot for the related model
        )->withPivot('designation', 'status') // Include pivot data
            ->withTimestamps(); // Include timestamps from the pivot table
    }
}
