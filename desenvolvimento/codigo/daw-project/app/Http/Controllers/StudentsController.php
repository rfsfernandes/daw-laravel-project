<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentsController extends Controller
{
    //
    public function index(){
        return view('students.index');
    }

    public function register(){
        return view('students.index');
    }
}
