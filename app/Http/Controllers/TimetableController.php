<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Timetable;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function get_time_table(Request $request){
        $user = User::find(5234);
        $teacher = Teacher::where('user_id', $user->id)->first();

        $sessions = Timetable::whereHas('class_teacher', function ($query) use($teacher) {
           $query->where('teacher_id', $teacher->id);
        })->with(['class_teacher', 'slot'])->orderBy('week')->get()->map(function ($session){
            $session->class_name = $session->class_teacher->class->name;
            $session->class_id = $session->class_teacher->class->name;
            $session->section_name = $session->class_teacher->section->name;
            $session->section_id = $session->class_teacher->section_id;
            $session->subject_name = $session->class_teacher->subject->name;
            $session->subject_id = $session->class_teacher->subject_id;

            $session->start_time = Carbon::parse($session->slot->start_time)->format('H:i A');
            $session->end_time = Carbon::parse($session->slot->end_time)->format('H:i A');
            unset($session['slot']);
            unset($session['class_teacher']);
            return $session;
        })->groupBy('week')->map(function ($data, $week){
            $temp = ['week'=>$week, 'sessions'=>$data];
            return $temp;
        })->values();

        return $sessions;
    }
}
