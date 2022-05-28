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
              <!-- <i class="far fa-edit"></i> --> Add Subject
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
                        <th> subject_name</th>
                         <th class="td-actions text-center"> Action </th>
                      </thead>
                      <tbody>


                         @foreach($subjects as $key => $subject)
                      <tr>
                        <td> {{$key+1}} </td>
                         <td>{{$subject->name}}</td> 
                         
                        <td class="td-actions text-center">
                             

                              <a href="" 
                                class="btn btn-info btn-sm edit" rel="tooltip" title="Edit" 
                                data-id="{{ $subject->id }}" data-bs-toggle="modal" 
                                data-bs-target="#editModal" data-bs-whatever="@mdo">
                                 <i class="fas fa-pencil-alt"></i> Edit</a>
                               </a>


                                   <form id="delete-form-{{$subject->id}}" action="{{route('subject.destroy', $subject->id)}}" 
                                   method="post" style="display:none">
                                   @csrf
                                   @method('DELETE')
                                   </form>
                                   <button type="submit" rel="tooltip" title="Remove" class="btn btn-danger btn-sm" onclick="if(
                                     confirm('are you sure to delete this?')){
                                       event.preventDefault();
                                       document.getElementById('delete-form-{{$subject->id}}').submit();
                                     }else{
                                       event.preventDefault();
                                     }"> <i class="fas fa-trash"></i> Delete</a>
                                   </button>

                                   <!-- view -->
                                   <a href="" rel="tooltip" title="view" 
                                   data-id="{{ $subject->id }}" class="btn btn-primary btn-sm view"
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
                     
                        <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">subject name</label>
                          <input type="text" name="name" id="subject_name" class="form-control">
                        </div>
                      </div>
 
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
            <div class="modal-dialog">
                <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add subject</h5>
                    <button type="button" class="btn btn-close text-info" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
              
                
                    <form action="{{route('subject.store')}}" method="POST"  enctype="multipart/form-data">
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
                      
                     
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">subject name</label>
                          <input type="text" name="name" class="form-control" required>
                        </div>
                      </div>
                      
                      
                    </div>
                      
                      
                    </div>
 
                  
                    <button type="submit" class="btn btn-primary pull-right mt-4">Add subject</button>
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
                            <input type="hidden" name="view-id" id="id" class="form-control">
                        </div>
                       
                        <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">subject name</label>
                          <input type="text" name="name" id="view-subject_name" class="form-control" disabled>
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
 
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

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
             
           $('#id').val(data.id);   
           $('#subject_name').val(data.name); 
           
          });
     
});
</script> 



<script type="text/javascript">
  $('body').on('click', '.view', function() {
    let id = $(this).data('id');
    //alert (id);
      $.get("/admin/subject/"+id,function(data){
           //console.log(data);
            
           $('#view-id').val(data.id); 
           $('#view-subject_name').val(data.name); 
           
           

          });
     
});
</script>

@endpush