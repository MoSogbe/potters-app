@extends('layout')

@section('content')
    <div class="content-wrapper">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                           <div class="my-3 text-center">
                           @if(auth()->user()->role === 'super admin')
                                <button type="button"
                                        class="btn btn-success btn-lg font-weight-medium auth-form-btn runSchedule" onclick="runSchedule({{$codes->count()}});">Run Schedule
                                </button>
                                @endif
                            </div>
                        <div class="card-body">
                            <h4 class="card-title">Pomo Codes</h4>
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
                                           Product Name
                                        </th>
                                        <th>
                                           Description
                                        </th>
                                         <th>
                                           Price
                                        </th>
                                        <th>
                                            Quantity
                                        </th>
                                        

                                    </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($codes as $code)
                                    <tr>
                                        <td class="td">{{\Carbon\Carbon::parse($code->date)->format('d-m-Y') ?? 'Invalid Date'}}</td>
                                        <td class="td">{{$code->name}}</td>
                                        <td class="td">{{$code->description}}</td>
                                         <td class="td">{{$code->price}}</td>
                                         <td class="td">{{$code->quantity}}</td>
                                        
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
    $('#codes-table').DataTable({
        processing: true,

    });
</script>
@stop
