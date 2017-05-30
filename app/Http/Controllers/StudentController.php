<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;

use App\Models\Student;

class StudentController extends Controller
{
    public function getAllStudents()
    {
        return view('student')->with('students', Student::all());
    }

    public function addStudent(Request $request)
    {
        $inputs = $request->all();

        $validator = Validator::make(
            $inputs,
            [
                'name' => 'required',
                'phone' => 'regex:/^1\d{10}$/',
                'birthday' => 'required|date'
            ],
            [],
            [
                'name' => '姓名',
                'phone' => '手机号',
                'birthday' => '生日'
            ]
        );
        if ($validator->fails()) {
            return response()->json(['result' => 'failed', 'msg' => $validator->messages()->first()]);
        }

        if (Carbon::parse($inputs['birthday']) > Carbon::now()) {
            return response()->json(['result' => 'failed', 'msg' => '生日不能超过今天。']);
        }

        $student = new Student;
        $student->name = $inputs['name'];
        $student->phone = $inputs['phone'];
        $student->birthday = date('Y-m-d H:i:s', strtotime($inputs['birthday']));
        $student->save();

        return response()->json(['result' => 'success', 'id' => $student->id]);
    }

    public function updateStudent(Request $request)
    {
        $inputs = $request->all();

        $validator = Validator::make(
            $inputs,
            [
                'id' => 'required|integer|min:0',
                'name' => 'required',
                'phone' => 'regex:/^1\d{10}$/',
                'birthday' => 'required|date'
            ],
            [],
            [
                'id' => '学生编号',
                'name' => '姓名',
                'phone' => '手机号',
                'birthday' => '生日'
            ]
        );
        if ($validator->fails()) {
            return response()->json(['result' => 'failed', 'msg' => $validator->messages()->first()]);
        }

        if (Carbon::parse($inputs['birthday']) > Carbon::now()) {
            return response()->json(['result' => 'failed', 'msg' => '生日不能超过今天。']);
        }

        $student = Student::find($inputs['id']);
        if (!$student) {
            return response()->json(['result' => 'failed', 'msg' => '该学生编号不存在。']);
        }

        $student->name = $inputs['name'];
        $student->phone = $inputs['phone'];
        $student->birthday = date('Y-m-d H:i:s', strtotime($inputs['birthday']));
        $student->save();

        return response()->json(['result' => 'success']);
    }

    public function deleteStudent(Request $request)
    {
        $inputs = $request->all();

        $validator = Validator::make(
            $inputs,
            [
                'id' => 'required|integer|min:0'
            ],
            [],
            [
                'id' => '学生编号'
            ]
        );
        if ($validator->fails()) {
            return response()->json(['result' => 'failed', 'msg' => $validator->messages()->first()]);
        }

        $student = Student::find($inputs['id']);
        if (!$student) {
            return response()->json(['result' => 'failed', 'msg' => '该学生编号不存在。']);
        }

        $student->delete();

        return response()->json(['result' => 'success']);
    }
}
