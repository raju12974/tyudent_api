<?php

namespace App\Http\Controllers;

use App\Models\InstituteClass;
use App\Models\InstituteClassSection;
use App\Models\StudentParent;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class FakeData extends Controller
{
    public function subjects(Request $request){
        $sections = ['A', 'B', 'C', 'D'];

        for ($i=1; $i<11;$i++){
            $class = new InstituteClass();
            $class->institute_id = 1;
            $class->name = $i;
            $class->save();

            foreach ($sections as $c){
                $section = new InstituteClassSection();
                $section->institute_id = 1;
                $section->class_id = $class->id;
                $section->name = $c;
                $section->save();
            }
        }
    }

    public function students(Request $request){
        $faker = Faker::create();

        foreach (InstituteClassSection::where('id', '>', 28)->get() as $section){
            for($i=0;$i<50; $i++){
                $user = new User();
                $user->first_name = $faker->firstName;
                $user->last_name = $faker->lastName;
                $user->type = 'student';
                $user->email = $faker->safeEmail;
                $user->gender = $faker->randomElement(['M', 'F']);
                $user->username = $faker->userName;
                $user->password = Hash::make('password');
                $user->save();

                $parent = new User();
                $parent->first_name = $faker->firstName('M');
                $parent->last_name = $faker->lastName;
                $parent->type = 'parent';
                $parent->email = $faker->safeEmail;
                $parent->mobile = $faker->phoneNumber;
                $parent->gender = $faker->randomElement(['M', 'F']);
                $parent->username = $faker->userName;
                $parent->password = Hash::make('password');
                $parent->save();

                $parent_main = new StudentParent();
                $parent_main->user_id = $parent->id;
                $parent_main->occupation = $faker->jobTitle;
                $parent_main->relation = 'Father';
                $parent_main->save();

                $student = new Student();
                $student->user_id = $user->id;
                $student->institute_id = 1;
                $student->class_id = $section->class_id;
                $student->section_id = $section->id;
                $student->roll_number = Str::random(8);
                $student->parent_id = $parent_main->id;
                $student->save();
            }
        }
    }

    public function teachers(){
        $faker = Faker::create();
        for($i=0;$i<40; $i++) {
            $user = new User();
            $user->first_name = $faker->firstName;
            $user->last_name = $faker->lastName;
            $user->type = 'teacher';
            $user->email = $faker->safeEmail;
            $user->gender = $faker->randomElement(['M', 'F']);
            $user->username = $faker->userName;
            $user->password = Hash::make('password');
            $user->save();

            $teacher = new Teacher();
            $teacher->user_id = $user->id;
            $teacher->institute_id = 1;
            $teacher->employee_id = Str::random(6);
            $teacher->save();
        }
    }
}
