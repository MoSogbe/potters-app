@extends('layout')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 col-xl-6 offset-3 grid-margin">
                <div class="card">
                
                    <div class="card-body">
                        <h4 class="card-title">Register New User</h4>
                        <form method="post" action="{{route('dashboard.users.store')}}" class="pt-3">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail">Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent"><span
                                                class="input-group-text bg-transparent border-right-0">
                                            <i class="mdi mdi-account-outline text-danger"></i></span>
                                    </div>
                                    <input type="text" name="name" class="form-control form-control-lg border-left-0"
                                           id="name" placeholder="Name">
                                </div>
                            </div>

                            


                            <div class="form-group">
                                <label for="exampleInputEmail">Email Address</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-email-open-outline text-danger"></i>
                      </span>
                                    </div>
                                    <input type="email" name="email" class="form-control form-control-lg border-left-0"
                                           id="exampleInputEmail" placeholder="Email Address">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-danger"></i>
                      </span>
                                    </div>
                                    <input type="password" name="password"
                                           class="form-control form-control-lg border-left-0"
                                           id="exampleInputPassword" placeholder="Password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputPassword">Repeat Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                                        <span class="input-group-text bg-transparent border-right-0">
                          <i class="mdi mdi-lock-outline text-danger"></i></span></div>
                                    <input type="password" name="password_confirmation"
                                           class="form-control form-control-lg border-left-0" id="password_confirmation"
                                           placeholder="Repeat Password"></div>
                            </div>


                            <div class="my-3">
                                <button type="submit"
                                        class="btn btn-block btn-danger btn-lg font-weight-medium auth-form-btn">Save
                                    User
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
