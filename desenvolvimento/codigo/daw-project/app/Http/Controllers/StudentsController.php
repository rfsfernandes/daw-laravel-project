<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentEpoch;
use App\Models\AssessmentType;
use App\Models\Course;
use App\Models\CurricularUnit;
use App\Models\Grades;
use App\Models\Inscription;
use App\Models\User;
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
            if(!$user) {
                return redirect('/');
            } else {
                return redirect('/teachers');
            }
        }

        $info_user = $this->arrangeUserInfo($user);

        return view('students.index', ['info_table' => $this->assessmentsInfo($user->id), 'info_user' => $info_user]);
    }

    function arrangeUserInfo(User $user){
        $course = Course::where('id', $user->id_course)->first()->name_course;

        $info_user = (object) array('name' => $user->name, 'number' => $user->id, 'course' => $course);
        return $info_user;
    }

    function assessmentsInfo(int $user){

        $userUc = UserUC::select('id_uc')->where('id_user', $user)->get();

        $assessments = Assessment::whereIn('id_uc', $userUc)->orderBy('datetime', 'asc')->get();

        $data = array();

        foreach ($assessments as $assessment) {

            $uc = CurricularUnit::select('name_uc')->where('id', $assessment->id_uc)->first();
            $assementType = AssessmentType::where('id', $assessment->id_assessment_type)->first();
            $epoch = AssessmentEpoch::where('id', $assessment->id_epoch)->first();
            $enrollment = Inscription::where('id_assessment', $assessment->id)->where('id_student', session('_user_content')->id)->first();

            $grade = NULL;

            if ($enrollment) {
                $grade = Grades::where('id_enrollment', $enrollment->id)->first();
            }

            $mObject = (object)array(
                'datetime' => $assessment->datetime,
                'uc' => $uc ? $uc->name_uc : '',
                'assess_type' => $assementType ? $assementType['name_assessment_type'] : $assementType,
                'epoch' => $epoch ? $epoch['name_epoch'] : $epoch,
                'classroom' => $assessment->classroom,
                'enrollment' => $enrollment ? $enrollment : NULL,
                'grade' => $grade ? $grade->value : NULL,
                'id' => $assessment->id

            );

            array_push($data, $mObject);

        }
        return $data;
    }

    public function register(Request $request)
    {
        $user = session('_user_content');

        if(!$user || $user->id_user_type != 2) {
            if(!$user) {
                return redirect('/');
            } else {
                return redirect('/teachers');
            }
        }

        $inscription = new Inscription();
        $inscription->id_assessment = $request->input('user_id');
        $inscription->id_student = $request->input('assessment_id');

        $inscription->save();

        $info_user = $this->arrangeUserInfo($user);

        return view('students.index', ['info_table' => $this->assessmentsInfo($user->id), 'info_user' => $info_user]);
    }
}
