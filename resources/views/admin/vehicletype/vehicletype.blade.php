@extends('layouts.app',['activePage' => 'vehicletype'])

@section('title','Vehicletype')

@section('content')

<section class="section">
    @if (Session::has('msg'))
    @include('layouts.msg')
    @endif
    <div class="section-header">
        <h1>{{__('vehicletypes')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item">{{__('Vehicletype')}}</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">{{__('Vehicletype menu')}}</h2>
        <p class="section-lead">{{__('Add, Edit, Manage Vehicletype')}}</p>
        <div class="card">
            <div class="card-header">
                @can('vehicletype_add')
                <div class="w-100">
                    <a href="{{ url('admin/vehicletype/create') }}"
                        class="btn btn-primary float-right">{{__('add new')}}</a>
                </div>
                @endcan
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered text-center" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>
                                <input name="select_all" value="1" id="master" type="checkbox" />
                                <label for="master"></label>
                            </th>
                            <th>#</th>
                            <th>{{__('Image')}}</th>
                            <th>{{__('Vehicletype name')}}</th>
                            <th>{{__('Enable')}}</th>
                            @if(Gate::check('vehicletype_edit'))
                            <th>{{__('Action')}}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicletypes as $vehicletype)
                        <tr>
                            <td>
                                <input name="id[]" value="{{$vehicletype->id}}" id="{{$vehicletype->id}}"
                                    data-id="{{ $vehicletype->id }}" class="sub_chk" type="checkbox" />
                                <label for="{{$vehicletype->id}}"></label>
                            </td>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ $vehicletype->image }}" class="rounded" width="50" height="50" alt="">
                            </td>
                            <td>{{$vehicletype->name}}</td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="status"
                                        onclick="change_status('admin/vehicletype',{{ $vehicletype->id }})"
                                        {{($vehicletype->status == 1) ? 'checked' : ''}}>
                                    <div class="slider"></div>
                                </label>
                            </td>
                            @if(Gate::check('vehicletype_edit'))
                            <td>
                                @can('vehicletype_edit')
                                <a href="{{ url('admin/vehicletype/'.$vehicletype->id.'/edit') }}"
                                    class="btn btn-primary btn-action mr-1"><i class="fas fa-pencil-alt"></i></a>
                                @endcan
                                @can('vehicletype_delete')
                                <a href="javascript:void(0);" class="table-action ml-2 btn btn-danger btn-action"
                                    onclick="deleteData('admin/vehicletype',{{ $vehicletype->id }},'Vehicletype')">
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
                <input type="button" value="Delete selected"
                    onclick="deleteAll('vehicletype_multi_delete','Vehicletype')" class="btn btn-primary">
            </div>
        </div>
    </div>
</section>

@endsection