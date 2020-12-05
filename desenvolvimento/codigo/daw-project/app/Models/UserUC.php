<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserUC extends Model
{
    use HasFactory;
    protected $table = 'user_uc';
    public $timestamps = false;

    public function student()
    {
        return $this->hasOne('App\Models\User', 'id');
    }

    public function curricularUnit()
    {
        return $this->hasOne('App\Models\CurricularUnit', 'id');
    }
}
