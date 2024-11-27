<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    public function training()
    {
        return $this->belongsTo(Training::class);
    }
}
