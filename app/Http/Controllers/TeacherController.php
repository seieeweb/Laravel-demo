<?php

namespace App\Http\Controllers;

class TeacherController extends Controller
{
    public function getAllTeachers()
    {
        return view('teacher');
    }
}
