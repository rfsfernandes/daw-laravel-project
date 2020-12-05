<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grades extends Model
{
    use HasFactory;
    protected $table = 'grades';

    public function inscription()
    {
        return $this->hasOne('App\Models\Inscription', 'id_enrollment');
    }
}
