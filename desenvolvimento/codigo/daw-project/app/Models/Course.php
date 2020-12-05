<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'course';
    public $timestamps = false;

    public function school()
    {
        return $this->hasOne('App\Models\School', 'id_school');
    }
}
