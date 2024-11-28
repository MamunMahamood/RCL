<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TrainingMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_id',
        'volunteer_id',  
        'designation',
        'status',
    ];




    public static function getMembers()
    {
        return self::join('volunteers', 'training_members.volunteer_id', '=', 'volunteers.id')
            ->join('users', 'volunteers.user_id', '=', 'users.id')
            ->select('users.name as user_name', DB::raw('COUNT(training_members.id) as total_members'))
            ->groupBy('users.name')
            ->get();
    }
}
