<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    //Login page
    public function index()
    {
        //$this->value = Value::all()
        //return view('login', ['variavel'=>$this->value]);
        return view('index');
    }

    //Sign in and check user type
    public function signin(Request $request)
    {
        $email = $request->input('email');
        $remember = $request->input('remember-me');
        $user = User::where('email', $email)->get();
        die(''.$remember);
        //$this->value = Value::all()
        //return view('login', ['variavel'=>$this->value]);
        return view('index');
    }
}
