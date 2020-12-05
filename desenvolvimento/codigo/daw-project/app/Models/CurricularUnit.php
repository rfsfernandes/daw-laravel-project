<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurricularUnit extends Model
{
    use HasFactory;
    protected $table = 'curricular_unit';

    public function course()
    {
        return $this->hasOne('App\Models\Course', 'id_course');
    }
}
