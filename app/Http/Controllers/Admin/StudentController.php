<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\str_slug;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $students = Student::paginate(5);
         $subjects = Subject::all();
        return view('admin.student.index', compact('students','subjects')); 
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
        // $this->validate($request,[
        //     'name' => 'required',
        //     'image' => 'required' 
             
        // ]);

        // $image = $request->file('image');
        // $slug = str_slug($request->name);

        // if (isset($image)) {
        //     $currentDate = Carbon::now()->toDateString();
        //     $imagename = $slug.'-'.$currentDate.'-'.'.'.$image->getClientOriginalExtension();
        //     if (!file_exists('images')) {
        //         mkdir('images',077, true);
        //      }
        //     $image->move('images', $imagename );
        // }else {
        //    $imagename = 'default.png';
        // }

        // $student = new Student();
        // $student->name = $request->name;
        // $student->image = $imagename;
          
        // $student->save();
        // return redirect()->route('student.index');


            
            // $this->validate($request,[
            //     'student' => 'required',
            //     'subject' => 'required', 
            //     'number' => 'required' 
                
            // ]);



       // $student_result = new Student_result();
                // $student_id = $request->student;
                // $subject_id = $request->subject;
                // $achieve_number = $request->number;
                
        // $student_result->student_id = $request->student;
        // $student_result->subject_id = $request->subject;
        // $student_result->achieve_number = $request->number;
          
                    // for ($i=0; $i < count($subject_id) ; $i++) { 
                    //     $data =[
                    //         'student_id' => $student_id,
                    //         'subject_id' => $subject_id[$i],
                    //         'achieve_number' => $achieve_number[$i]
                    //     ];
                    // $student_result = DB::table('student_results')->insert($data);
                    // }
        //$student_result->save();
                    //return redirect()->route('student.index');
     //dd($request->all());





     DB::beginTransaction();
     try {

           $this->validate($request,[
            'name' => 'required',
            'image' => 'required',
             
        ]);
        
        $image = $request->file('image');
        $slug = str_slug($request->name);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.'.'.$image->getClientOriginalExtension();
            if (!file_exists('images')) {
                mkdir('images',077, true);
             }
            $image->move('images', $imagename );
        }else {
           $imagename = 'default.png';
        }
        $student = new Student();
        $student->name = $request->name;
        $student->image = $imagename;
        $student->save();


        $student_id = $student->id;
         //$id = DB::table('students')->insertGetId($student);
        
                $subject_id = $request->subject;
                $achieve_number = $request->number;
         
        for ($i=0; $i < count($subject_id); $i++) {
        $module_permission = [
             'student_id' => $student_id,
             'subject_id' => $subject_id[$i],
             'achieve_number' => $achieve_number[$i],
              ];
              DB::table('student_results')->insert($module_permission);
            }
              
              DB::commit();
              return redirect()->route('student.index');
        // dd($request->all());



     } catch (\Exception $e) {
        //Toastr::success('Data Added Success!', 'success', ["positionClass" => "toast-top-right"]);              
         DB::rollBack();
         return redirect()->back();
          
     }



     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Student::findorfail($id);
        
        return response()->json($data);
        // $data = DB::table('students')->where('id', $id)->get();
         //return view('admin.student.form', compact('$data'));
         //dd($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Student::findorfail($id);
        return view('admin.student.editform', compact('$data'));
         //dd($data);
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
     
            $this->validate($request,[
            'name' => 'required'
             
        ]);

        $student =  Student::where('id', $request->id)->first();
        $image = $request->file('image');
        $slug = str_slug($request->name);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.'.'.$image->getClientOriginalExtension();
            if (!file_exists('images')) {
                mkdir('images',077, true);
             }
            $image->move('images', $imagename );
        }else {
           $imagename = $student->image;
        }

        $student->name = $request->name;
        $student->image = $imagename;
          
        $student->save();
        return redirect()->route('student.index'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $student = Student::find($id);
         if (file_exists('images/'.$student->image)) {
               unlink('images/'.$student->image);
             }
        $student->delete();
        return redirect()->route('student.index'); 
    }
}
