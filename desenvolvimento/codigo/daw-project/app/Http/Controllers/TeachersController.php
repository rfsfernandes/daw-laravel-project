<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentEpoch;
use App\Models\AssessmentType;
use App\Models\CurricularUnit;
use App\Models\Grades;
use App\Models\Inscription;
use App\Models\User;
use App\Models\UserUC;
use DateTime;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    //Index
    public function index(){

//        return view('teachers.index');
       return $this->showViewIndex();
    }

    private function showViewIndex(){
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
    }

    function assessmentsInfo(int $user){

        $userUc = UserUC::select('id_uc')->where('id_user', $user)->get();

        $assessments = Assessment::whereIn('id_uc', $userUc)->orderBy('datetime', 'asc')->get();

        $data = array();

        foreach ($assessments as $assessment) {

            $uc = CurricularUnit::select('name_uc')->where('id', $assessment->id_uc)->first();
            $assementType = AssessmentType::where('id', $assessment->id_assessment_type)->first();
            $epoch = AssessmentEpoch::where('id', $assessment->id_epoch)->first();

            $grades = count(Grades::whereIn('id_enrollment', Inscription::select('id')->where('id_assessment', $assessment->id)->get())->get());
            $hasBeenDone = false;
            if (strtotime((new DateTime())->format("Y-m-d H:i:s")) > strtotime($assessment->datetime)) {
                $hasBeenDone = true;
            } else {
                $hasBeenDone = false;
            }

            $mObject = (object)array(
                'datetime' => $assessment->datetime,
                'uc' => $uc ? $uc->name_uc : '',
                'assess_type' => $assementType ? $assementType['name_assessment_type'] : $assementType,
                'epoch' => $epoch ? $epoch['name_epoch'] : $epoch,
                'classroom' => $assessment->classroom,
                'gradesLaunched' => $grades ? true : false,
                'id' => $assessment->id,
                'hasBeenDone' => $hasBeenDone

            );

            array_push($data, $mObject);

        }

        return $data;
    }

    //Schedule assessments
    public function schedule(Request $request){
        $assessment = new Assessment();
        $assessment->datetime = $request->input('date') . " " . $request->input('time');
        $assessment->classroom = $request->input('room');
        $assessment->id_assessment_type = $request->input('type');
        $assessment->id_epoch = $request->input('epoch');
        $assessment->id_uc = $request->input('uc');

        $assessment->save();

        return redirect("/teachers");
    }

    //List of signed up students for an assessment
    public function evaluate($id){
        $users = User::select('name', 'id')
            ->whereIn('id', Inscription::select('id_student')
                ->where('id_assessment', $id)->get())
            ->get();

        return view('teachers.evaluate_assessment', ['assessment_id' => $id, 'users' => $users]);
    }

    //Grades the students of an assessment
    public function grade(Request $request){
        $userIds = $request->input('user_id');
        $grades = $request->input('grade');

        $data = array();

        for ($i = 0; $i < count($userIds); $i++) {
            array_push($data, ['value' =>  $grades[$i], 'id_enrollment' =>$userIds[$i]]);
        }

        Grades::insert($data);

        return redirect("/teachers");
    }

    //Results of an assessment
    public function results(Request $request, $id){
        $grades = Grades::select('grades, id_student')->whereIn('id_enrollment', Inscription::select('id')->where('id_assessment', $id)->get())->get();

        $student_ids = $grades->id_student;

        $names =  User::select('name')->where('id', $student_ids)->get();

        $final = $grades->merge($names);
        return view('teachers.assessment_results', $final);
    }
}
