<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    public function copies(){
        return $this->hasMany(Copy::class);
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
