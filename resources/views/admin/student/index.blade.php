@extends('layouts.apps')
@section('title', 'student || admin dashboard')
@push('css')

 
@endpush

@section('content')

<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">


              <div class="card">
                 <div class="card-header card-header-primary">
                    <button class="btn my-3 btn-primary" rel="tooltip" title="Add" 
                    data-bs-toggle="modal" data-bs-target="#AddModal" data-bs-whatever="@mdo">
                    + Add New student + result
                   </button>
 
                  </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" >
                      <thead class=" text-primary">
                        <th> DT_rowIndex </th>
                        <th> Image </th>
                        <th> Student name</th>
                        <th> Total Number </th>
                        <th class="td-actions text-center"> Action </th>
                      </thead>
                      <tbody>
 
                      @foreach($students as $key => $student)
                         <tr>
                          <td>{{$student->id}} </td>
                          <td><img src="{{asset('images/'.$student->image)}}" alt="" height="60px" width="60px" alt="{{$student->image}}"></td>
                          <td>{{$student->name}} </td>
                            @php
                           $num = DB::table('student_results')->where('student_id', $student->id)->select('student_results.achieve_number')->sum('achieve_number');  
                           @endphp

                           <td>{{  $num }} </td>
                            
                            

                          <td class="td-actions text-center">
                              <a href="" 
                                class="btn btn-info btn-sm edit" rel="tooltip" title="Edit" data-id="{{ $student->id }}" data-bs-toggle="modal" 
                                data-bs-target="#editModal" data-bs-whatever="@mdo">
                                 <i class="fas fa-pencil-alt"></i> Edit</a>
                               </a>
                                  
                                   <form id="delete-form-{{$student->id}}" action="{{route('student.destroy', $student->id)}}" 
                                   method="post" style="display:none">
                                   @csrf
                                   @method('DELETE')
                                   </form>
                                   <button type="submit" rel="tooltip" title="Remove" class="btn btn-danger btn-sm" onclick="if(
                                     confirm('are you sure to delete this?')){
                                       event.preventDefault();
                                       document.getElementById('delete-form-{{$student->id}}').submit();
                                     }else{
                                       event.preventDefault();
                                     }"><i class="fas fa-trash"></i> Delete</a>
                                   </button>

 
                                  <!-- admin/student/{student}/edit -->
                                   <a href="" rel="tooltip" title="view" 
                                   data-id="{{ $student->id }}" class="btn btn-primary btn-sm view"
                                   data-bs-toggle="modal" data-bs-target="#viewModal">
                                 <i class="fas fa-folder"></i> View</a>
            
                              </td>
                          </tr>
                      @endforeach
                      </tbody>
                    </table>

                   <div class="float-right "> {{ $students->links() }}</div>

                   <div class="text-start">
                     Showing {{$students->firstItem()}} - {{$students->lastItem()}} of students 
                      {{$students->total()}} 
                   </div>
                  </div>
                </div>
              </div>
            
  
            </div>
          </div>
        </div>
      </div>



            
          <!-- edit From data post in id by modal -->                       
           <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <form action="{{route('student.update','$student')}}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
  
                                                @if (session('status'))
                                                    <div class="alert alert-success">
                                                        {{ session('status') }}
                                                    </div>
                                                @endif
             
                                        <div class="form-group mt-3 py-2">
                                              <input type="hidden" name="id" id="id" class="form-control">
                                        </div>
                                        
                                        <div class="form-group mt-3 py-2">
                                            <label for="" class="fw-bold">Name</label>
                                            <input type="text" name="name" id="name" class="form-control" required>
                                        </div>

                                         <div class="col-md-12">
                                             <p>Before Images</p>
                                            <div class="form-group" id="view-image">
                                             </div>
                                        </div>

                                         <div class="col-md-12">
                                            <div class="form-group">
                                            <label class="bmd-label-floating">Image</label>
                                            <input type="file" name="image" class="form-control">
                                            </div>
                                        </div>
                      
                                       
                                        <div class="form-group my-4">
                                            <input type="submit" name="submit" value="Update" class="form-control btn btn-danger">
                                          <div class="clearfix"></div>
                                        </div>                                        
                            </form> 
                 </div>
                </div>
            </div>
          </div> 



          
              <!-- view  data by modal -->                       
           <div class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View student information</h5>
                    <button type="button" class="btn btn-close text-info" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">
               
                 
                    <form action="#" method="POST"  enctype="multipart/form-data">
                       
                    <div class="row mt-4">
                      
                      <div class="col-md-6">
                        
                        <div class="form-group">
                           <label class="bmd-label-floating">student name</label>
                          <input type="text" id="view-student-data" class="form-control" disabled> 
                            
                        </div>
                      </div>

 

                        <div class="col-md-6">
                          <label class="bmd-label-floating">student Profile</label>
                           <div class="mt-1" id="view-image-data">
                           
                        </div>
                        </div>
                      

                  <table id="example" class="table border-none mt-3">
                      <thead class="">
                        <th> Subject code</th> 
                        <th> Number</th>
                        <th>Total number </th>
                      </thead>
                  <tbody>

                         
                   <tr>
                    <td class=""> 
                        <div class="col-md-12">
                        <div class="form-group">
                          <span id="view-subject-data"></span>
                        </div>
                      </div>
                    </td>

                    <td class="">
                      <div class="col-md-12">
                        <div class="form-group">
                          <input type="text" name="number[]" class="form-control" id="view-number-data" disabled>
                        </div>
                      </div>
                    </td>

                        <td class="td-actions text-center">
                           <span id="total-number"></span>
                          </td>
                      </tr>
                     
                      </tbody>
                    </table>
                 
                  </div>
                      
                </div>
 
                  
                    <button  class="btn btn-primary pull-right mt-4">View Student Information</button>
                    <div class="clearfix"></div>
                  </form>


                 </div>
                </div>
            </div>
           
           

                       

 <!-- Add  data by modal -->                       
           <div class="modal fade" id="AddModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add subject</h5>
                    <button type="button" class="btn btn-close text-info" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
              
                
                    <form action="{{route('student.store')}}" method="POST"  enctype="multipart/form-data">
                       @csrf

                       @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    <div class="row mt-4">
                      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">student name</label>
                           <input type="text" name="name" class="form-control">
                          </div>
                        </div>
                        

                        <div class="col-md-6">
                          <div class="form-group">
                          <label class="bmd-label-floating">Image</label>
                           <input type="file" name="image" class="form-control">
                          </div>
                        </div>
                      

                  <table id="example" class="table border-none mt-3">
                      <thead class="">
                        <th> Subject </th> 
                        <th> Number</th>
                        <th class="text-center"> <span rel="tooltip" title="addRow" class="btn btn-info btn-sm addRow"> 
                             <i class="fas fa-add"></i> Add More</a>
                            </span> </th>
                      </thead>
                  <tbody>

                         
                 @foreach($subjects as $key => $subject)
                  <tr>
                    <td class=""> 
                        <div class="col-md-12">
                        <div class="form-group">
                           <select class="form-select" name="subject[]">
                              @foreach($subjects as $subject)
                                <option value="{{$subject->id}}" class="form-control">{{$subject->name}}</option>
                              @endforeach
                           </select>
                        </div>
                      </div>
                    </td>

                    <td class="">
                      <div class="col-md-12">
                        <div class="form-group">
                          <input type="number" name="number[]" class="form-control" required>
                        </div>
                      </div>
                    </td>

                        <td class="td-actions text-center">
                           <a href="javascritp:;" rel="tooltip" title="Remove" class="btn btn-danger btn-sm deleteRow" > 
                             <i class="fas fa-trash"></i> Delete</a>
                                    </a>
                          </td>
                      </tr>
                       @endforeach

                      </tbody>
                    </table>
                 
                  </div>
                      
                </div>
 
                  
                    <button type="submit" class="btn btn-primary pull-right mt-4">Submit</button>
                    <div class="clearfix"></div>
                  </form>
                
                 
                 </div>
                </div>
            </div>
           
           

 
<!--Create new student Modal -->
<div class="modal fade" id="AddModalstudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       
              <div class="card shadow-none"> 
                <div class="card-body p-3">
                    <form action="{{route('student.store')}}" method="POST"  enctype="multipart/form-data">
                       @csrf

                       @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    <div class="row">
                      
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Name</label>
                          <input type="text" name="name" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Image</label>
                          <input type="file" name="image" class="form-control">
                        </div>
                      </div>
                      
                    </div>
  
                    <button type="submit" class="btn btn-primary pull-right mt-2">Add student</button>
                    <div class="clearfix"></div>
                  </form>
                </div> 
          </div>
        </div>
      </div>
 
      </div>      
    </div> 


@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> 
 
<script src="{{asset('backend/dist/js/bootstrap.bundle.min.js')}}"></script>
  
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
 
<script>
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
 
<script type="text/javascript">
  $('body').on('click', '.edit', function() {
    let id = $(this).data('id');
    //alert (id);
      $.get("/admin/student/"+id,function(data){
        
         // console.log(data);
           $('#id').val(data.id);
           $('#name').val(data.name);
           $('#view-image').html('<img height="150px" src="{{asset("images/")}}/'+data.image+'"'+">"); 
      
    }); 
});
</script> 
 


<script>
  
$('body').on('click', '.addRow', function() {
    let tr ='<tr>'+ 
            '<td class="">'+ 
                        '<div class="col-md-12">'+
                        '<div class="form-group">'+
                           '<select class="form-select" name="subject">'+
                              '@foreach($subjects as $subject)'+
                                '<option value="{{$subject->id}}"'+
                                 'class="form-control">'+'{{$subject->name}}'+'</option>'+
                              '@endforeach'+
                           '</select>'+
                        '</div>'+
                      '</div>'+
                    '</td>'+

  '<td><div class="col-md-12"><div class="form-group"><input type="text" name="number" class="form-control" required></div></div></td>'+
  '<td class="td-actions text-center"><a href="javascritp:;" rel="tooltip" title="Remove" class="btn btn-danger btn-sm deleteRow" ><i class="fas fa-trash"></i> Delete</a> </a> </td> </tr>';
     $('tbody').append(tr);
});

$('body').on('click', '.deleteRow', function() {
    let id = $(this).parent().parent().remove();
     
});

 

  $('body').on('click', '.view2', function() {
    let id = $(this).data('id');
     $.get("/admin/edit/"+id,function(data){
            $("#modal-body").html(data);

          });
     
}); 

 

  $('body').on('click', '.view', function() {
    let id = $(this).data('id');
     $.get("/admin/edit/"+id,function(data){
            //console.log(data);
           
          for(i=0; i<= data.length; i++){

           let student_id = $('#id').val(data[i].id); 

           //$('#view-student').val(data[i].student_id);
           $('#view-student-data').val(data[i].name);
           //$('#view-subject').val(data[i].subject_id) ;
           $('#view-subject-data').text(data[i].subject_id) ;
          $('#view-number-data').val(data[i].achieve_number);
          $('#total-number').text(data[i].achieve_number);
           $('#view-image-data').html('<img height="150px" src="{{asset('images/')}}/'+data[i].image+'"'+">"); 
     
          }
           });
     
}); 

 
           
          
     



</script>  
  
@endpush