@extends('layouts.apps')
@section('title', 'subject || admin controller')
@push('css')
 <link rel="stylesheet" href="{{asset('backend/dist/css/bootstrap.min.css')}}">
@endpush

@section('content')

<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
            <button class="btn my-3 btn-primary" rel="tooltip" title="Add" 
              data-bs-toggle="modal" data-bs-target="#AddModal" data-bs-whatever="@mdo">
              + Add New student result
            
            </button>
             <div class="card">
                 <div class="card-header card-header-primary">
                    <h4 class="card-title ">subject</h4>
                  </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table id="example" class="table table-striped" >
                      <thead class=" text-primary">
                        <th> DT_rawIndex  </th> 
                        <th> Image</th>
                        <th> Student_name</th>
                        <th> Subject</th>
                        <th> Number</th>
                        <th class="text-center"> Action </th>
                      </thead>
                      <tbody>


                         @foreach($results as $key => $result)
                      <tr>
                        <td>{{$key+1}} </td>
                        <td><img height="50px" src="{{asset('images/'.$result->student->image)}}" alt="{{$result->student->image}}"></td>
                        <td>{{$result->student->name}}</td>
                        <td>{{$result->subject->name}}</td>
                        <td>{{$result->achieve_number}}</td>  

                        <td class="td-actions text-center">
                             

                              <a href="" 
                                class="btn btn-info btn-sm edit" rel="tooltip" title="Edit" 
                                data-id="{{ $result->id }}" data-bs-toggle="modal" 
                                data-bs-target="#editModal" data-bs-whatever="@mdo">
                                 <i class="fas fa-pencil-alt"></i> Edit</a>
                               </a>


                                   <form id="delete-form-{{$result->id}}" action="{{route('student_result.destroy', $result->id)}}" 
                                   method="post" style="display:none">
                                   @csrf
                                   @method('DELETE')
                                   </form>
                                   <button type="submit" rel="tooltip" title="Remove" class="btn btn-danger btn-sm" onclick="if(
                                     confirm('are you sure to delete this?')){
                                       event.preventDefault();
                                       document.getElementById('delete-form-{{$result->id}}').submit();
                                     }else{
                                       event.preventDefault();
                                     }"> <i class="fas fa-trash"></i> Delete</a>
                                   </button>

                                   <!-- view -->
                                   <a href="" rel="tooltip" title="view" 
                                   data-id="{{ $result->id }}" class="btn btn-primary btn-sm view"
                                   data-bs-toggle="modal" data-bs-target="#viewModal">
                                  <i class="fas fa-folder"></i> View</a>

                            </td>
                      </tr>
                       @endforeach

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

 
            
          <!-- edit From data post in id by modal -->                       
           <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Data</h5>
                    <button type="button" class="btn btn-close text-info" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <form action="{{route('subject.update','subject->id')}}" method="POST"  enctype="multipart/form-data">
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

                    <div class="row">
                      
                        <div class="form-group mt-3 py-2">
                            <input type="hidden" name="id" id="id" class="form-control">
                        </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">student_name</label>
                             
                          <select class="form-select" name="student">
                              <option selected="" id="student_id"> </option>
                             

                               @foreach($students as $student)
                               <option value="{{$student->id}}" class="form-control">{{$student->name}}</option>             
                                @endforeach
                            </select>
                        </div>
                      </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">subject name</label>
                          <input type="text" name="name" id="subject_name" class="form-control">
                        </div>
                      </div>

 
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">subject Description</label>
                           <textarea name="description" class="form-control" id="description"></textarea>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">subject Price</label>
                          <input type="text" name="price" id="price" class="form-control">
                        </div>
                      </div>
                      
                    </div>
                      <div class="col-md-12 mt-5">
                       <div id="image" class="mt-1"></div>
                       <label class="bmd-label-floating mb-2">Before Image</label>
                       <input type="file" name="image" id="image" class="form-control">
                        </div>
                      
                    </div>
                
                    <button type="submit" class="btn btn-primary pull-right my-4">update</button>
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
              
                
                    <form action="{{route('student_result.store')}}" method="POST"  enctype="multipart/form-data">
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
                          <label class="bmd-label-floating">student</label>
 
                            <select class="form-select" name="student">
                              <!-- <option selected="" required>Choose a student</option> -->
                               @foreach($students as $student)
                                <option value="{{$student->id}}" class="form-control">{{$student->name}}</option>
                                 
                                @endforeach
                                    
                            </select>
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
                          <input type="text" name="number[]" class="form-control" required>
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
           
           


          
              <!-- view  data by modal -->                       
           <div class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add subject</h5>
                    <button type="button" class="btn btn-close text-info" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
              
                
                    <form action="{{route('student_result.store')}}" method="POST"  enctype="multipart/form-data">
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
                          <label class="bmd-label-floating">student</label>
 
                            <select class="form-select" name="student">
                              <!-- <option selected="" required>Choose a student</option> -->
                               @foreach($students as $student)
                                <option value="{{$student->id}}" class="form-control">{{$student->name}}</option>
                                 
                                @endforeach
                                    
                            </select>
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
                          <input type="text" name="number[]" class="form-control" required>
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
           
           


            
            <!-- view data id by modal -->                       
           <div class="modal fade" id="viewModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Data</h5>
                    <button type="button" class="btn btn-close text-info" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <form action="" method="POST"  enctype="multipart/form-data">
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

                    <div class="row">
                      
                        <div class="form-group mt-3 py-2">
                            <input type="hidden" name="view-id" id="id" class="form-control">
                        </div>
                       <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">student_name</label>
                            
                          <select class="form-select" name="student" disabled>
                              <option selected="" id="view-student_id"> </option>
                             </select>
                        </div>
                      </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">subject name</label>
                          <input type="text" name="name" id="view-subject" class="form-control" disabled>
                        </div>
                      </div>

  
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">subject Price</label>
                          <input type="text" name="price" id="view-number" class="form-control"disabled>
                        </div>
                      </div>
                      
                    </div>
                      <div class="col-md-12 my-5">
                       <div id="view-image" class="mt-3"></div>
                         </div>
                      
                    </div>
                   </form>
                 </div>
                </div>
            </div>
           

@endsection

@push('js')
 
<script src="{{asset('backend/dist/js/bootstrap.bundle.min.js')}}"></script>
 
<script src="{{asset('backend/dist/js/jquery.min.js')}}"></script>
<script>
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>


<script type="text/javascript">
  $('body').on('click', '.edit', function() {
    let id = $(this).data('id');
    //alert (id);
      $.get("/admin/subject/"+id,function(data){
           //console.log(data);
           //data.array();
           for(i=0; i<= data.length; i++){
           
           $('#id').val(data[i].id);
           $('#student_id').val(data[i].student_id);
           $('#student_id').text(data[i].name); 
           $('#subject_name').val(data[i].subject_name); 
           $('#description').val(data[i].description); 
           $('#price').val(data[i].price);
           $('#image').html('<img height="80px" name="image" src="{{asset('uploads/subject/')}}/'+data[i].image+'"'+">"); 
     
           }

          });
     
});

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

</script> 



<script type="text/javascript">
  $('body').on('click', '.view', function() {
    let id = $(this).data('id');
    //alert (id);
      $.get("/admin/student_result/"+id,function(data){
           //console.log(data);
           
           $('#id').val(data.id);
           $('#view-student_id').val(data.student_id);
           $('#view-student_id').text(data.name); 
           $('#view-subject').val(data.subject_id) ;
           $('#view-subject').val(data.subject_id) ;
            $('#view-number').val(data.achieve_number);
           $('#view-image').html('<img height="150px" src="{{asset('images/')}}/'+data.image+'"'+">"); 
     
           

          });
     
});
</script>


<script type="text/javascript">
  $('body').on('click', '.editb', function() {
    let id = $(this).data('id');
    $.get("/admin/edit/"+id,function(data){
            $("#modal-body").html(data);

          });
     
});
</script> 
@endpush