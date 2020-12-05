<?php

namespace App\Http\Controllers;
use App\Models\Inscription;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    //
    public function index(){
        return view('students.index');
    }

    public function register(Request $request){
        return view('students.index');
    }
}
