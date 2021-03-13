<?php

namespace App\Http\Controllers;

use App\Models\Homework;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class HomeworkController extends Controller
{
    public function get_homeworks(Request $request){
        $user = User::find(5234);
        $teacher = Teacher::where('user_id', $user->id)->first();

        $homeworks = Homework::whereHas('class_teacher', function ($query) use($teacher) {
            $query->where('teacher_id', $teacher->id);
        })->with('class_teacher')->get()->map(function ($homework){
            $homework->class_name = $homework->class_teacher->class->name;
            $homework->class_id = $homework->class_teacher->class->name;
            $homework->section_name = $homework->class_teacher->section->name;
            $homework->section_id = $homework->class_teacher->section_id;
            $homework->subject_name = $homework->class_teacher->subject->name;
            $homework->subject_id = $homework->class_teacher->subject_id;
            unset($homework['class_teacher']);
            return $homework;
        });
        return $homeworks;
    }
}
