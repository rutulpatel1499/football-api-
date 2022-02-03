<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class team extends Model
{
    use HasFactory;
    public function club()
    {
        return $this->belongsTo('App\Models\club','club_id');
    }
    public function players()
    {
        return $this->hasMany('App\Models\players','id');
    }
}
