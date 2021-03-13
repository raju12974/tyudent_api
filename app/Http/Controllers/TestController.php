<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Test;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function get_tests(Request $request){
        $user = User::find(5234);
        $teacher = Teacher::where('user_id', $user->id)->first();

        $tests = $teacher->tests()->with('subject')->with('class')->with('section')
            ->get()->map(function ($test){
                $test->subject_name = $test->subject->name;
                $test->class_name = $test->class->name;
                $test->section_name = $test->section->name;

                unset($test['subject']);
                unset($test['class']);
                unset($test['section']);
                return $test;
            });
        return $tests;
    }

    public function add_test(Request $request){
        $test = new Test();
        $test->teacher_id = 1;
        $test->class_id = $request->class_id;
        $test->section_id = $request->section_id;
        $test->subject_id = $request->subject_id;
        $test->date = Carbon::parse($request->date)->format('Y-m-d');
        $test->text = $request->text;
        $test->active = 'Y';
        $test->save();

        return ['success'=>'Y'];
    }
}
