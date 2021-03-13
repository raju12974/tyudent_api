<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    public function class(){
        return $this->belongsTo(InstituteClass::class, 'class_id');
    }

    public function section(){
        return $this->belongsTo(InstituteClassSection::class, 'section_id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }
}
