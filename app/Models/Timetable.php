<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    public function class_teacher(){
        return $this->belongsTo(ClassTeacher::class);
    }

    public function slot(){
        return $this->belongsTo(TimeTableSlot::class, 'time_table_slot_id');
    }
}
