<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;
    protected $table = 'inscription';
    public $timestamps = false;

    public function assessment()
    {
        return $this->hasOne('App\Models\Assessment', 'id_evaluation');
    }

    public function student()
    {
        return $this->hasOne('App\Models\User', 'id_user');
    }
}
