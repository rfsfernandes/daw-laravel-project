<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentEpoch;
use App\Models\AssessmentType;
use App\Models\CurricularUnit;
use App\Models\Grades;
use App\Models\Inscription;
use App\Models\SessionManager;
use App\Models\UserUC;
use DateTime;
use Illuminate\Http\Request;

class TeachersController extends Controller
{
    //Index
    public function index(Request $request)
    {

//        return view('teachers.index');
        return $this->showViewIndex($request);
    }

    private function showViewIndex(Request $request)
    {
        $user = SessionManager::getUserFromSession($request);

        if (!$user || $user->id_user_type != 1) {
            if (!$user) {
                return redirect('/');
            } else {
                return redirect('/students');
            }
        }

        $ucscall = UserUC::getUsersUCIDsByUserId($user->id);

        $ucsnames = CurricularUnit::getCurricularUnitFromIDs($ucscall);

        $assesstype = AssessmentType::getAll();

        $epoch = AssessmentEpoch::getAll();


        $assessmentInfo = $this->assessmentsInfo($user->id);


        return view('teachers.index', ['ucsnames' => $ucsnames,
            'assesstype' => $assesstype, 'epochs' => $epoch, 'assessments' => $assessmentInfo]);
    }

    function assessmentsInfo(int $user)
    {

        $userUc = UserUC::getUsersUCIDsByUserId($user);

        $assessments = Assessment::getAssessmentsByUserUCs($userUc, 'asc');

        $data = array();

        foreach ($assessments as $assessment) {

            $uc = CurricularUnit::getCurricularUnitFromUCId($assessment->id_uc);
            $assementType = AssessmentType::getAssessmentTypeById($assessment->id_assessment_type);
            $epoch = AssessmentEpoch::getAssessmentEpochById($assessment->id_epoch);

            $grades = Grades::doesAssessmentHaveGrades($assessment->id);
            $hasBeenDone = false;
            if (strtotime((new DateTime())->format("Y-m-d H:i:s")) > strtotime($assessment->datetime)) {
                $hasBeenDone = true;
            } else {
                $hasBeenDone = false;
            }

            $mObject = (object)array(
                'datetime' => $assessment->datetime,
                'uc' => $uc ? $uc->name_uc : '',
                'assess_type' => $assementType ? $assementType->name_assessment_type : $assementType,
                'epoch' => $epoch ? $epoch->name_epoch : $epoch,
                'classroom' => $assessment->classroom,
                'gradesLaunched' => $grades,
                'id' => $assessment->id,
                'hasBeenDone' => $hasBeenDone

            );

            array_push($data, $mObject);

        }

        return $data;
    }

    //Schedule assessments
    public function schedule(Request $request)
    {
        $assessment = new Assessment();
        $assessment->datetime = $request->input('date') . " " . $request->input('time');
        $assessment->classroom = $request->input('room');
        $assessment->id_assessment_type = $request->input('type');
        $assessment->id_epoch = $request->input('epoch');
        $assessment->id_uc = $request->input('uc');

        Assessment::saveAssessment($assessment);

        return redirect("/teachers");
    }

    //List of signed up students for an assessment
    public function evaluate(Request $request, $id)
    {

        $data = Inscription::inscriptionsFromAssessmentId($id);

        return view('teachers.evaluate_assessment', ['assessment_id' => $id, 'data' => $data]);
    }

    // Grades the students of an assessment
    public function grade(Request $request)
    {
        $enrollments = $request->input('enrollment_id');
        $grades = $request->input('grade');

        $data = array();

        for ($i = 0; $i < count($enrollments); $i++) {
            array_push($data, ['value' => $grades[$i], 'id_enrollment' => $enrollments[$i]]);
        }

        Grades::inserGrades($data);

        return redirect("/teachers");
    }

    // Results of an assessment
    public function results(Request $request, $id)
    {

        $data = Grades::getGradesFromAssessId($id);


        return view('teachers.assessment_results', ['final' => $data, 'assessment_id' => $id]);
    }

    // Edit Submitted notes
    public function edit(Request $request, $id)
    {

        $id_enroll = $request->input('enrollment_id');
        $grade = $request->input('grade');

        Grades::updateGrade($id_enroll, $grade);

        return redirect('/teachers/assessments/results/' . $id);
    }
}
