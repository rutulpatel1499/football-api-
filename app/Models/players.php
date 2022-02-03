<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class players extends Model
{
    use HasFactory;
    public function team()
    {
        return $this->belongsTo('App\Models\team','team_id');
    }
    public function club()
    {
        return $this->belongsTo('App\Models\club','club_id');
    }
}
