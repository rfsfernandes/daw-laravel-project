<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentEpoch;
use App\Models\AssessmentType;
use App\Models\CurricularUnit;
use App\Models\Grades;
use App\Models\Inscription;
use App\Models\UserUC;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    //Index
    public function index(){
        $user = session('_user_content');

        if(!$user || $user->id_user_type != 1) {
            if(!$user) {
                return redirect('/');
            } else {
                return redirect('/students');
            }
        }

        $ucscall = UserUC::select('id_uc')->where('id_user', $user->id)->get();

        $ucsnames = CurricularUnit::whereIn('id', $ucscall)->get();

        $assesstype = AssessmentType::get();

        $epoch = AssessmentEpoch::get();


        $assessmentInfo = $this->assessmentsInfo($user->id);


        return view('teachers.index', ['ucsnames' => $ucsnames,
            'assesstype' => $assesstype, 'epochs' => $epoch, 'assessments' => $assessmentInfo]);
//        return view('teachers.index');
    }

    function assessmentsInfo(int $user){

        $userUc = UserUC::select('id_uc')->where('id_user', $user)->get();

        $assessments = Assessment::whereIn('id_uc', $userUc)->get();

        $data = array();

        foreach ($assessments as $assessment) {

            $uc = CurricularUnit::select('name_uc')->where('id', $assessment->id_uc)->first();
            $assementType = AssessmentType::where('id', $assessment->id_assessment_type)->first();
            $epoch = AssessmentEpoch::where('id', $assessment->id_epoch)->first();

            $grades = count(Grades::whereIn('id_enrollment', Inscription::select('id')->where('id_assessment', $assessment->id)->get())->get());
            $hasBeenDone = false;
//            if (strtotime((new DateTime())->format("Y-m-d H:i:s")) > strtotime($assessment->datetime)) {
//                $hasBeenDone = false;
//            } else {
//                $hasBeenDone = true;
//            }

            $mObject = array(
                'datetime' => $assessment->datetime,
                'uc' => $uc ? $uc->name_uc : '',
                'assess_type' => $assementType ? $assementType['name_assessment_type'] : $assementType,
                'epoch' => $epoch ? $epoch['name_epoch'] : $epoch,
                'classroom' => $assessment->classroom,
                'gradesLaunched' => $grades ? true : false,
                'id' => $assessment->id,
//                'hasBeenDone' => $hasBeenDone

            );

            array_push($data, $mObject);

        }

        return $data;
    }

    //Schedule assessments
    public function schedule(){
        return view('teachers.index');
    }

    //List of signed up students for an assessment
    public function evaluate(){
        return view('teachers.evaluate_assessment');
    }

    //Grades the students of an assessment
    public function grade(){
        return view('teachers.index');
    }

    //Results of an assessment
    public function results(){
        return view('teachers.assessment_results');
    }
}
