<?php

namespace App\Http\Controllers;
use App\Models\Assessment;
use App\Models\Inscription;
use App\Models\UserUC;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    //
    public function index(){
        $user = session('_user_content');
        $userUc = UserUC::where('id_student', $user->id)->get();
        $ucIds = array();

        foreach ($userUc as $uc) {
           array_push($ucIds,$uc['id_uc'] );
        }

        $assessments = Assessment::whereIn('id_uc',$ucIds)->get();

        $data = array();
        die($assessments);
        foreach ($assessments as $assessment) {
            $uc = $assessment->curricularUnit();
            $assementType = $assessment->assessmentType();
            $epoch = $assessment->epoch();

            array_push($data,
                [
                    'datetime' => $assessment->datetime,
                    'uc' => $uc ? $uc->name_uc : '',
                    'assess_type' => $assementType ? $assementType['name_evaluation'] : '',
                    'epoch' => $epoch ? $epoch['name_epoch'] : '',

                ]);
        }

        die(var_dump($data));

        return view('students.index');
    }

    public function register(Request $request){
        return view('students.index');
    }
}
