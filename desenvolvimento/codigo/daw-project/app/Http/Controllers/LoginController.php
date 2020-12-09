<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //Login page
    public function index(Request $request)
    {
        $storedEmail = $request->session()->get('_remember_email');

        $user = $request->session()->get('_user_content');

        if ($user) {
            if ($user->id_user_type == 1) {
                return redirect('/teachers');
            } else {
                return redirect('/students');
            }
        }

        return view('index', ['error_snack' => '']);
    }

    //Sign in and check user type
    public function signin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $remember = $request->input('remember-me');
        $user = User::checkCredentials($email, $password);

        if ($remember == "on") {
            $request->session()->put('_remember_email', $email);
        } else {
            $request->session()->put('_remember_email', '');
        }

        if ($user) {
            $request->session()->put('_user_content', $user);
            if ($user->id_user_type == 1) {
                return redirect()->route('teachers');
            } else {
                return redirect('students');
            }
        } else {
            return view('index', ['error_snack' => 'Email ou password incorretos.']);
        }
    }

    //logout
    public function logout(Request $request)
    {
        $request->session()->put('_user_content', '');
        return redirect()->route('login');
    }
}
