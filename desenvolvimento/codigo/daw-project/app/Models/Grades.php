<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{
    use HasFactory;

    protected $table = 'grades';
    public $timestamps = false;

    public static function getCurricularUnitFromUCId($id_uc)
    {
        return Grades::select('name_uc')->where('id', $id_uc)->first();
    }

    public static function getCurricularUnitFromEnrollment($id_enrollment)
    {
        return Grades::where('id_enrollment', $id_enrollment)->first();
    }

    public static function doesAssessmentHaveGrades($assessment_id)
    {
        $grades = count(Grades::whereIn('id_enrollment', Inscription::select('id')->where('id_assessment', $assessment_id)->get())->get());
        return $grades ? true : false;
    }

    public static function inserGrades($data)
    {
        Grades::insert($data);
    }

    public static function getGradesFromAssessId($id)
    {
        return Grades::select('inscription.id AS id_inscription', 'user.id', 'user.name', 'grades.value')
            ->join('inscription', 'inscription.id', '=', 'grades.id_enrollment')
            ->join('user', 'user.id', '=', 'inscription.id_student')
            ->where('inscription.id_assessment', $id)
            ->get();
    }

    public static function updateGrade($id_enroll, $value)
    {
        Grades::where('id_enrollment', $id_enroll)->update(['value' => $value]);
    }
}
