<?php

namespace App\Http\Controllers;

use App\Models\ClassTeacher;
use App\Models\InstituteClass;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function get_teacher_sections(Request $request){
        $user = User::find(5234);
        $teacher = Teacher::where('user_id', $user->id)->first();

        $classes = $teacher->classes()->with(['class', 'section', 'subject'])
            ->get()->map(function ($class){
                $class->subject_name = $class->subject->name;
                $class->class_name = $class->class->name;
                $class->section_name = $class->section->name;

                unset($class['subject']);
                unset($class['class']);
                unset($class['section']);
                return $class;
            });
        return $classes;
    }

    public function get_sections(Request $request, $institute_id){
        $classes = InstituteClass::where('institute_id', $institute_id)
            ->with('sections:id,class_id,name')
            ->select('id', 'name', 'institute_id')
            ->get();
        return $classes;
    }

    public function get_students(Request $request){
        $class_id = $request->class_id;
        $section_id = $request->section_id;

        $students = Student::where('section_id', $section_id)->with('user')->get();
        return $students;
    }

    public function get_subjects(Request $request){
        $class_id = $request->class_id;
        $subjects = Subject::where('class_id', $class_id)->select('id', 'name', 'class_id', 'teacher_id')->get();

        return $subjects;
    }
}
