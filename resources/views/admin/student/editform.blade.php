
                    <form action="" method="POST"  enctype="multipart/form-data">
                       
                    <div class="row mt-4">
                      
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="bmd-label-floating">student Name</label>
 
                            <div class="form-group" name="student">
                                {{$data->name}}
                               <input type="text" id="view-student-data" value="{{$data->name}}" class="form-control" disabled> 
                                  
                              </div>
                        </div>
                      </div>

                        <div class="col-md-6">
                         
                           <div id="image" class="mt-1">
                           <img height="80px" name="image" src="{{asset('uploads/item/')}}/{{$data->image}}">
                        </div>
                        </div>
                      

                  <table id="example" class="table border-none mt-3">
                      <thead class="">
                        <th> Subject </th> 
                        <th> Number</th>
                        <th>Total nmber </th>
                      </thead>
                  <tbody>

                         
                 @foreach($subjects as $key => $subject)
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
 
                  
                    <button type="submit" class="btn btn-primary pull-right mt-4">View Student Information</button>
                    <div class="clearfix"></div>
                  </form>