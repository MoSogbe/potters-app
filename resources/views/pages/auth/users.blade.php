@extends('layout')

@section('content')
    <div class="content-wrapper">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Completed Redemptions</h4>
                            <p class="card-description text-right">
                                <a href="{{route('dashboard.users.register')}}" class="btn btn-success" >Add New User</a>
                                {{--Add class <code>.table-striped</code>--}}
                            </p>
                            <div class="table-responsive">
                                <table class="table table-striped" id="users-table" >
                                    <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Email
                                        </th>

                                      

                                        <th>
                                            Created
                                        </th>
                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="td">{{$user->id}}</td>
                                            <td class="td">{{$user->name}}</td>
                                            <td class="td">{{$user->email}}</td>

                                            

                                            <td class="td">{{$user->created_at->diffForHumans()}}</td>
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
@stop

@section('scripts')
    <script>
        $('#users-table').DataTable({
            processing: true,

        });
    </script>
@stop
