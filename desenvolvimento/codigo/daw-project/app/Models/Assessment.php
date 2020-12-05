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
        return $this->belongsTo('App\Models\CurricularUnit', 'id')->first();
    }

    public function epoch()
    {
        return $this->belongsTo('App\Models\AssessmentEpoch', 'id')->first();
    }

    public function assessmentType()
    {
        return $this->belongsTo('App\Models\AssessmentType', 'id')->first();
    }
}
