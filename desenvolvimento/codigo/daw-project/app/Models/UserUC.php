<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserUC extends Model
{
    use HasFactory;

    protected $table = 'user_uc';
    public $timestamps = false;

    public static function getUsersUCIDsByUserId($user_id)
    {
        $userUCs = UserUC::select('id_uc')->where('id_user', $user_id)->get();

//        $ids = array();
//        foreach ($userUCs as $id) {
//            array_push($ids,(object) array('id_uc' => $id->id_uc));
//        }
////        die(var_dump($ids));
        return $userUCs;
    }

    public static function getUserUCById($id_uc)
    {
        return UserUC::select('name_uc')->where('id', $id_uc)->first();
    }
}
