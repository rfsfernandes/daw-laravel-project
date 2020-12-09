<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Inscription extends Model
{
    use HasFactory;

    protected $table = 'inscription';
    public $timestamps = false;

    public static function getInscriptionByAssessmentAndUser($id_assessment, $id_user)
    {
        return DB::table('inscription')->where('id_assessment', $id_assessment)->where('id_student', $id_user)->first();
    }

    public static function inscriptionsFromAssessmentId($id)
    {
        return DB::table('inscription')
            ->select('inscription.id AS id_inscription', 'user.id', 'user.name')
            ->join('user', 'user.id', '=', 'inscription.id_student')
            ->where('id_assessment', $id)
            ->get();
    }
}
