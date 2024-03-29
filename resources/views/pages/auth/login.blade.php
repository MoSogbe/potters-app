<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{$pageTitle??'Indomie'}}</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{asset('theme/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('theme/css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('images/Indomie_logo.png')}}"/>
</head>

<body>
<div class="container-scroller d-flex">
    <div class="container-fluid page-body-wrapper full-page-wrapper d-flex">
        <div class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
            <div class="row flex-grow">
                <div class="col-lg-6 d-flex align-items-center justify-content-center">
                    <div class="auth-form-transparent text-left p-3">
                        <div class="brand-logo">
                        

                        </div>
                        <h4>Welcome back!</h4>
                        <h6 class="font-weight-light">Happy to see you again!</h6>
                        <form method="post" action="{{route('process.login')}}" class="pt-3">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputEmail">Email Address</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-account-outline text-danger"></i>
                      </span>
                                    </div>
                                    <input type="email" name="email" class="form-control form-control-lg border-left-0"
                                           id="exampleInputEmail" placeholder="Email">
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
                                @endif

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword">Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend bg-transparent">
                      <span class="input-group-text bg-transparent border-right-0">
                        <i class="mdi mdi-lock-outline text-danger"></i>
                      </span>
                                    </div>
                                    <input type="password" name="password" class="form-control form-control-lg border-left-0"
                                           id="exampleInputPassword" placeholder="Password">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
                                @endif
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check form-check-danger">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input ">
                                        Keep me signed in
                                    </label>
                                </div>
                                
                                <a href="#" class="auth-link text-black">Forgot password?</a>
                            </div>
                            <div class="my-3">
                                <button type="submit" class="btn btn-block btn-danger btn-lg font-weight-medium auth-form-btn">LOGIN</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 login-half-bg d-none d-lg-flex flex-row">
                    <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright &copy; {{date('Y')}}
                        All rights reserved.</p>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- base:js -->
<script src="{{asset('theme/vendors/js/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="{{asset('theme/js/off-canvas.js')}}"></script>
<script src="{{asset('theme/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('theme/js/template.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


@include('pages.alerts.sweet-alert-flash-message')
<!-- endinject -->
</body>

</html>
