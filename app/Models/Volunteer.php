<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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


    public static function generateVolunteerId()
    {
        // Prefix
        $prefix = 'RC';

        // Year (last two digits)
        $year = Carbon::now()->format('y'); // e.g., 2024 becomes '24'

        // Get the last roll number for the current year
        $lastId = DB::table('volunteers')
            ->where('volunteer_id', 'like', "{$prefix}{$year}%")
            ->orderBy('volunteer_id', 'desc')
            ->value('volunteer_id');

        // Extract the last 4-digit roll number or default to 0000
        $lastRollNumber = $lastId ? (int)substr($lastId, -4) : 0;

        // Increment roll number
        $newRollNumber = str_pad($lastRollNumber + 1, 4, '0', STR_PAD_LEFT);

        // Combine parts to form the new volunteer ID
        return "{$prefix}{$year}{$newRollNumber}";
    }
}
