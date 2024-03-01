@extends('layout')

@section('content')
    <div class="content-wrapper">
             <!-- row end -->
          <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card bg-danger d-flex align-items-center">
                <div class="card-body py-5">
                  <div
                    class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                    <i class="mdi mdi-adjust  text-white icon-lg"></i>
                    <div class="ml-3 ml-md-0 ml-xl-3">
                      <h5 class="text-white font-weight-bold">{{$product_count}} Products</h5>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card bg-success d-flex align-items-center">
                <div class="card-body py-5">
                  <div
                    class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                    <i class="mdi mdi-account-check text-white icon-lg"></i>
                    <div class="ml-3 ml-md-0 ml-xl-3">
                      <h5 class="text-white font-weight-bold">{{$user_count}}  Users</h5>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card bg-warning d-flex align-items-center">
                <div class="card-body py-5">
                  <div
                    class="d-flex flex-row align-items-center flex-wrap justify-content-md-center justify-content-xl-start py-1">
                    <i class="mdi mdi-cellphone-iphone text-white icon-lg"></i>
                    <div class="ml-3 ml-md-0 ml-xl-3">
                      <h5 class="text-white font-weight-bold">{{$uploads}} Uploads</h5>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- row end -->

          <div class="card-body">
                            <h4 class="card-title">Upload Logs</h4>
                            <p class="card-description">
                                {{--Add class <code>.table-striped</code>--}}
                            </p>
                            <div class="table-responsive">
                                <table class="table table-striped" id="codes-table" >
                                    <thead>
                                    <tr>
                                        <th>
                                            Date
                                        </th>
                                        <th>
                                           File Name
                                        </th>
                                        <th>
                                           Status
                                        </th>
                                         <th>
                                          Uploaded By
                                        </th>
                                       
                                        

                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($file_upload as $code)
                                    <tr>
                                        <td class="td">{{\Carbon\Carbon::parse($code->date)->format('d-m-Y') ?? 'Invalid Date'}}</td>
                                        <td class="td">{{$code->file_name}}</td>
                                        <td class="td">{{$code->status}}</td>
                                         <td class="td">{{$code->uploaded_by}}</td>
                                         
                                        
                                    </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
        
    </div>
@stop

@section('scripts')

@stop
