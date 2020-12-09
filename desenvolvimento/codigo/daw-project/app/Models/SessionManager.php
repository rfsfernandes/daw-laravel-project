<?php


namespace App\Models;


use Illuminate\Http\Request;

class SessionManager
{

    public static function getUserFromSession(Request $request)
    {
        return $request->session()->get('_user_content');
    }

    public static function setUserToSession(Request $request, User $user)
    {
        $request->session()->put('_user_content', $user);
    }

    public static function getEmailFromSession(Request $request)
    {
        return $request->session()->get('_remember_email');
    }

    public static function setEmailToSession(Request $request, $email)
    {
        $request->session()->put('_remember_email', $email);
    }

}
