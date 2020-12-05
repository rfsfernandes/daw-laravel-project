<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserUC extends Model
{
    use HasFactory;
    protected $table = 'user_uc';

    public function student()
    {
        return $this->hasOne('App\Models\User', 'id_student');
    }

    public function curricularUnit()
    {
        return $this->hasOne('App\Models\CurricularUnit', 'id_uc');
    }
}
