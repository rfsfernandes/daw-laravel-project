<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentEpoch;
use App\Models\AssessmentType;
use App\Models\Course;
use App\Models\Grades;
use App\Models\Inscription;
use App\Models\UserUC;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    //
    public function index()
    {
        $user = session('_user_content');

        if(!$user || $user->id_user_type != 2) {
            return view('index');
        }

        $userUc = UserUC::where('id_student', $user->id)->get();
        $ucIds = array();

        foreach ($userUc as $uc) {
            array_push($ucIds, $uc['id_uc']);
        }

        $assessments = Assessment::whereIn('id_uc', $ucIds)->get();

        $data = array();

        foreach ($assessments as $assessment) {

            $uc = $assessment->curricularUnit();
            $assementType = AssessmentType::where('id', $assessment->id_assessment_type)->first();
            $epoch = AssessmentEpoch::where('id', $assessment->id_epoch)->first();
            $enrollment = Inscription::where('id_assessment', $assessment->id)->where('id_student', session('_user_content')->id)->first();
            $grade = NULL;

            if ($enrollment) {
                $grade = Grades::where('id_enrollment', $enrollment->id)->first();
            }

            $mObject = (object)array(
                'datetime' => $assessment->datetime,
                'uc' => $uc ? $uc['name_uc'] : '',
                'assess_type' => $assementType ? $assementType['name_assessment_type'] : $assementType,
                'epoch' => $epoch ? $epoch['name_epoch'] : $epoch,
                'classroom' => $assessment->classroom,
                'enrollment' => $enrollment ?? NULL,
                'grade' => $grade ? $grade->value : NULL

            );

            array_push($data, $mObject);

        }

        $user = session('_user_content');
        $course = Course::where('id', $user->id_course)->first()->name_course;

        $info_user = (object) array('name' => $user->name, 'number' => $user->id, 'course' => $course);

        return view('students.index', ['info_table' => $data, 'info_user' => $info_user]);
    }

    public function register(Request $request)
    {
        return view('students.index');
    }
}
