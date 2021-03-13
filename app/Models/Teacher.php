<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public function tests(){
        return $this->hasMany(Test::class);
    }

    public function classes(){
        return $this->hasMany(ClassTeacher::class);
    }
}
