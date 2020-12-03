<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function signin()
    {
        //$this->value = Value::all()
        //return view('login', ['variavel'=>$this->value]);
        return view('index');
    }
}
