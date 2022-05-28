<?php

namespace App\Http\Controllers\Admin;

use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Student_result;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StudentResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
        $students = Student::all();
        $results = Student_result::all();
        return view('admin.result.index', compact('subjects','students','results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $this->validate($request,[
            'student' => 'required',
            'subject' => 'required', 
            'number' => 'required' 
             
        ]);

       // $student_result = new Student_result();
        $student_id = $request->student;
        $subject_id = $request->subject;
        $achieve_number = $request->number;
          
        // $student_result->student_id = $request->student;
        // $student_result->subject_id = $request->subject;
        // $student_result->achieve_number = $request->number;
          
        for ($i=0; $i < count($subject_id) ; $i++) { 
            $data =[
                'student_id' => $student_id,
                'subject_id' => $subject_id[$i],
                'achieve_number' => $achieve_number[$i]
            ];
        $student_result = DB::table('student_results')->insert($data);
        }
        //$student_result->save();
        return redirect()->route('student_result.index');
     //dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $data = Student_result::findorfail($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $data = Student_result::findorfail($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         
       $data =[
                'student_id' => $request->student,
                'subject_id' => $request->subject,
                'achieve_number' => $request->number
            ];
        DB::table('student_results')->update($data);
       return redirect()->route('student_result.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student_result = Student_result::find($id);      
        $student_result->delete();
        return redirect()->route('student_result.index'); 
    }
}
