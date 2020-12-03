<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeachersController extends Controller
{
    //Index
    public function index(){
        return view('teachers.index');
    }

    //Schedule assessments
    public function schedule(){
        return view('teachers.index');
    }

    //List of signed up students for an assessment
    public function evaluate(){
        return view('teachers.evaluate_assessment');
    }

    //Grades the students of an assessment
    public function grade(){
        return view('teachers.index');
    }

    //Results of an assessment
    public function results(){
        return view('teachers.assessment_results');
    }
}
