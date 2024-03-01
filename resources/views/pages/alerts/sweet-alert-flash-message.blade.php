
@if(session()->has('message'))
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Information Hub',
            html: '{{ session()->get('message') }}',
            showConfirmButton: false,
            timer: 4000
        })
    </script>
@endif

@if(session()->has('error'))
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'error',
            title: 'Information Hub',
            html: '{{ session()->get('message') }}',
            showConfirmButton: false,
            timer: 4000
        })
    </script>
@endif

@if($errors->any())

    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'warning',
            title: 'Information Hub',
            html:
                '<ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
            showConfirmButton: false,
            timer: 4000
        })
    </script>

@endif

{{--

@if ($message = Session::get('success'))
    <script>
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Your work has been saved',
            showConfirmButton: false,
            timer: 3500
        })
    </script>
@endif

@if ($message = Session::get('message'))
    <script>
        Swal.fire({
            title: 'Information Hub',
            text: '{{ $message }}',
            icon: 'success',
            showConfirmButton: false,
            timer: 3500
        })
    </script>
@endif


@if ($message = Session::get('error'))
    <script>
        Swal.fire({
            title:'Information Hub',
            text: '{{ $message }}',
            icon: 'error',
            showConfirmButton: false,
            timer: 3500
        })
    </script>
@endif


@if ($message = Session::get('warning'))
    <script>
        Swal.fire({
            title: 'Information Hub',
            text: '{{ $message }}',
            icon: 'warning',
            showConfirmButton: false,
            timer: 3500
        })
    </script>
@endif


@if ($message = Session::get('info'))
    <script>
        Swal.fire({
            title: 'Information Hub',
            text: '{{ $message }}',
            icon: 'info',
            showConfirmButton: false,
            timer: 3500
        })
    </script>
@endif

@if ($errors->any())

    <script>
        Swal.fire({
            title: 'Information Hub',
            text: 'Please check the form below for errors',
            icon: 'warning',
            showConfirmButton: false,
            timer: 3500
        })
    </script>
@endif

@if($errors->any())
    <div class="alert alert-danger">
        <p><strong>Opps Something went wrong</strong></p>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
@endif

@if(session('error'))
    <div class="alert alert-danger">{{session('error')}}</div>
@endif
--}}
