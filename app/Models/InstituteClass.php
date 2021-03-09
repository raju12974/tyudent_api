<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteClass extends Model
{
    use HasFactory;

    public function sections(){
        return $this->hasMany(InstituteClassSection::class, 'class_id');
    }
}
