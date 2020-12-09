<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurricularUnit extends Model
{
    use HasFactory;

    protected $table = 'curricular_unit';
    public $timestamps = false;

    public static function getCurricularUnitFromUCId($id_uc)
    {
        return CurricularUnit::select('name_uc')->where('id', $id_uc)->first();
    }

    public static function getCurricularUnitFromIDs($ids)
    {
        return CurricularUnit::whereIn('id', $ids)->get();
    }
}
