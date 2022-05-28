<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StudentviewController extends Controller
{
    public function view($id)
    {
    // $data = Student::findorfail($id);
       // return response()->json($data);
         //$data = DB::table('students')->where('id', $id)->first();
         $data = DB::table('student_results')->leftJoin('students', 'student_results.student_id', 'students.id')->where('students.id', $id)->select('students.*','student_results.achieve_number', 'student_results.subject_id')->get();
        // $data = DB::table('students')->select('students.*','student_results.achieve_number')->leftJoin('student_results', 'students.id', 'student_results.student_id')->where('id', $id)->get();
         //$data = DB::table('students')->leftJoin('student_results', 'students.id', 'student_results.student_id')->where('students.id', $id)->select('students.*','student_results.achieve_number', 'student_results.subject_id')->get();
        // $data = DB::table('students')->select('students.*','student_results.achieve_number')->leftJoin('student_results', 'students.id', 'student_results.student_id')->where('id', $id)->get();
         //return view('admin.student.editform', compact('data'));
        // dd($data);
         return response()->json($data);
    }
 
}
