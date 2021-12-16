@extends('layouts.app',['activePage' => 'vehicle_report'])

@section('title','Vehicle Report')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>{{__('vehicle report')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item">{{__('vehicle report')}}</div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card p-3">
                <form action="{{ url('admin/vehicle_report') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-12">
                            <input type="text" name="date_range" class="form-control">
                        </div>
                        <div class="col-md-6 col-lg-6 col-12">
                            <input type="submit" value="{{__('apply')}}" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>{{__('vehicle report')}}</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('name')}}</th>
                                <th>{{__('email id')}}</th>
                                <th>{{__('total order')}}</th>
                                <th>{{__('earning')}}</th>
                                <th>{{__('complete settlement amount')}}</th>
                                <th>{{__('remaining settlement amount')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $vehicle->name }}</td>
                                <td>{{ $vehicle->email_id }}</td>
                                <td>{{ $vehicle->total_order }}</td>
                                <td>{{ $currency }}{{ $vehicle->vehicle_earning }}</td>
                                <td>{{ $currency }}{{ $vehicle->compelte_settle }}</td>
                                <td>{{ $currency }}{{ $vehicle->remain_settle }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection