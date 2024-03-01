@extends('layout')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 col-xl-6 offset-3 grid-margin">
                <div class="card">
                
                    <div class="card-body">
                        <h4 class="card-title">Upload Contacts</h4>
                        @if(session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif

                          @if(session()->has('errors'))
                            <div class="alert alert-success">
                            @foreach($errors as $error)
                            <div class="alert alert-success">
                                {{ $error }}
                                </div>
                            </div>
                            @endforeach
                        @endif
                        <form action="{{ route('dashboard.import.contacts') }}" method="POST" enctype="multipart/form-data" class="pt-3">
                            @csrf
                           

                    <div class="form-group">
                      <label>File upload</label>
                      <input type="file" name="file" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Excel File">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-danger" type="button">Upload</button>
                        </span>
                      </div>
                    </div>
              

                          

                            <div class="my-3">
                                <button type="submit"
                                        class="btn btn-block btn-danger btn-lg font-weight-medium auth-form-btn">Upload Contacts
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@section('scripts')

@stop
