<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AssessmentEpoch extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'assessment_epoch';

    public static function getAssessmentEpochById($id_epoch)
    {
        return DB::table('assessment_epoch')->where('id', $id_epoch)->first();
    }

    public static function getAll()
    {
        return DB::table('assessment_epoch')->get();
    }

}
