<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AssessmentType extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'assessment_type';

    public static function getAssessmentTypeById($id_assessment_type)
    {
        return DB::table('assessment_type')->where('id', $id_assessment_type)->first();
    }

    public static function getAll()
    {
        return DB::table('assessment_type')->get();
    }

}
