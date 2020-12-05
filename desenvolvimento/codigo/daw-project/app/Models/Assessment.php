<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;

    protected $table = 'assessment';

    public function curricularUnit()
    {
        return $this->hasOne('App\Models\CurricularUnit', 'id_uc');
    }

    public function epoch()
    {
        return $this->hasOne('App\Models\AssessmentEpoch', 'id_epoch');
    }

    public function assessmentType()
    {
        return $this->hasOne('App\Models\AssessmentType', 'id_evaluation_type');
    }
}
