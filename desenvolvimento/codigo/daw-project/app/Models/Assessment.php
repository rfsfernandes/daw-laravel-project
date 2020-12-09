<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'assessment';

    public static function getAssessmentsByUserUCs($userUCs, $order)
    {
        return Assessment::whereIn('id_uc', $userUCs)->orderBy('datetime', $order)->get();
    }

    public static function saveAssessment(Assessment $assessment)
    {

        $assessment->save();
    }

}
