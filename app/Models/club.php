<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class club extends Model
{
    use HasFactory;
    public function team()
    {
        return $this->hasMany('App\Models\team','id');
    }
    public function players()
    {
        return $this->hasOne('App\Models\players','id');
    }
}
