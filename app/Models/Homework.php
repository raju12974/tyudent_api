<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;
    protected $hidden = ['created_at', 'updated_at'];

    public function class_teacher(){
        return $this->belongsTo(ClassTeacher::class);
    }
}
