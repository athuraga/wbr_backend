@extends('layouts.app',['activePage' => 'vehicle'])

@section('title','Vehicle')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>{{__('Vehicle')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item">{{__('Vehicle')}}</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">{{__('Vehicle Management System')}}</h2>
        <p class="section-lead">{{__('Add, Edit, Manage Vehicles.')}}</p>
        <div class="card">
            <div class="card-header">
                @can('admin_vehicle_add')
                    <div class="w-100">
                        <a href="{{ url('admin/vehicle/create') }}" class="btn btn-primary float-right">{{__('Add New')}}</a>
                    </div>
                @endcan
            </div>
            <div class="card-body table-responsive">
                <table id="datatable" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>
                                <input name="select_all" value="1" id="master" type="checkbox" />
                                <label for="master"></label>
                            </th>
                            <th>#</th>
                            <th>{{__('vehicle profile')}}</th>
                            <th>{{__('vehicle name')}}</th>
                            <th>{{__('Location')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Enable')}}</th>
                            @if(Gate::check('admin_vehicle_edit'))
                                <th>{{__('Action')}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicles as $vehicle)
                        <tr>
                            <td>
                                <input name="id[]" value="{{$vehicle->id}}" id="{{$vehicle->id}}" data-id="{{ $vehicle->id }}" class="sub_chk" type="checkbox" />
                                <label for="{{$vehicle->id}}"></label>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ $vehicle->image }}" width="50" height="50" class="rounded" alt="">
                            </td>
                            <th>{{$vehicle->name}}</th>
                            <td>{{$vehicle->address}}</td>
                            <td>{{$vehicle->email_id}}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="status" onclick="change_status('admin/vehicle',{{ $vehicle->id }})" {{($vehicle->status == 1) ? 'checked' : ''}}>
                                    <div class="slider"></div>
                                </label>
                            </td>

                            @if(Gate::check('admin_vehicle_edit'))
                                <td class="d-flex justify-content-center">
                                    <a href="{{ url('admin/vehicle/'.$vehicle->id) }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="" data-original-title="{{__('show vehicle')}}"><i class="fas fa-eye"></i></a>
                                    @can('admin_vehicle_edit')
                                        <a href="{{ url('admin/vehicle/'.$vehicle->id.'/edit') }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="" data-original-title="{{__('Edit')}}"><i class="fas fa-pencil-alt"></i></a>
                                    @endcan

                                    @can('admin_vehicle_delete')
                                        <a href="javascript:void(0);" class="table-action btn btn-danger btn-action" onclick="deleteData('admin/vehicle',{{ $vehicle->id }},'Vehicle')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endcan
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <input type="button" value="Delete selected" onclick="deleteAll('vehicle_multi_delete','Vehicle')" class="btn btn-primary">
            </div>
        </div>
    </div>
</section>

@endsection
