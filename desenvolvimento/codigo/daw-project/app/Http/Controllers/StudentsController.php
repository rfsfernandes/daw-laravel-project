<?php

namespace App\Http\Controllers;

use App\Models\Assessment;
use App\Models\AssessmentEpoch;
use App\Models\AssessmentType;
use App\Models\Course;
use App\Models\CurricularUnit;
use App\Models\Grades;
use App\Models\Inscription;
use App\Models\SessionManager;
use App\Models\UserUC;
use DateTime;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    //
    public function index(Request $request)
    {
        $user = SessionManager::getUserFromSession($request);

        if (!$user || $user->id_user_type != 2) {
            if (!$user) {
                return redirect('/');
            } else {
                return redirect('/teachers');
            }
        }

        $info_user = $this->arrangeUserInfo($user);

        return view('students.index', ['info_table' => $this->assessmentsInfo($request, $user->id), 'info_user' => $info_user]);
    }

    function arrangeUserInfo($user)
    {
        $course = Course::getCourseById($user->id_course)->name_course;

        $info_user = (object)array('name' => $user->name, 'number' => $user->id, 'course' => $course);
        return $info_user;
    }

    function assessmentsInfo(Request $request, int $user)
    {

        $userUc = UserUC::getUsersUCIDsByUserId($user);

        $assessments = Assessment::getAssessmentsByUserUCs($userUc, 'asc');

        $data = array();

        foreach ($assessments as $assessment) {

            $uc = CurricularUnit::getCurricularUnitFromUCId($assessment->id_uc);
            $assementType = AssessmentType::getAssessmentTypeById($assessment->id_assessment_type);
            $epoch = AssessmentEpoch::getAssessmentEpochById($assessment->id_epoch);
            $enrollment = Inscription::getInscriptionByAssessmentAndUser($assessment->id, SessionManager::getUserFromSession($request)->id);

            $grade = NULL;

            if ($enrollment) {
                $grade = Grades::getCurricularUnitFromEnrollment($enrollment->id);
            }

            $ass_time = new DateTime($assessment->datetime);
            $ass_time->modify("-1 day");

            $expiredDate = false;
            if (strtotime((new DateTime())->format("Y-m-d H:i:s")) > strtotime($ass_time->format("Y-m-d H:i:s"))) {
                $expiredDate = true;
            } else {
                $expiredDate = false;
            }

            $mObject = (object)array(
                'datetime' => $assessment->datetime,
                'uc' => $uc ? $uc->name_uc : '',
                'assess_type' => $assementType ? $assementType->name_assessment_type : $assementType,
                'epoch' => $epoch ? $epoch->name_epoch : $epoch,
                'classroom' => $assessment->classroom,
                'enrollment' => $enrollment ? $enrollment : NULL,
                'grade' => $grade ? $grade->value : NULL,
                'id' => $assessment->id,
                'allow' => $expiredDate

            );

            array_push($data, $mObject);

        }
        return $data;
    }

    public function register(Request $request)
    {
        $user = session('_user_content');

        if (!$user || $user->id_user_type != 2) {
            if (!$user) {
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

        return view('students.index', ['info_table' => $this->assessmentsInfo($request, $user->id), 'info_user' => $info_user]);
    }
}
