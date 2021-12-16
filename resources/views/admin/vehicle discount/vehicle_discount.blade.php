@extends('layouts.app',['activePage' => 'vehicle'])

@section('title','Vehicle Discount')

@section('content')
@if (Session::has('msg'))
    <script>
        var msg = "<?php echo Session::get('msg'); ?>"
        $(window).on('load', function()
        {
            iziToast.success(
            {
                message: msg,
                position: 'topRight'
            });
    });
    </script>
@endif

<section class="section">
    <div class="section-header">
        <h1>{{__('vehicle discount')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item active"><a href="{{ url('admin/vehicle/'.$id) }}">{{ App\Models\Vehicle::find($id)->name }}</a></div>
            <div class="breadcrumb-item">{{__('Vehicle Discount')}}</div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title">{{__("Vehicle discount")}}</h2>
        <p class="section-lead">{{__('Vehicle discount')}}</p>
        <div class="card">
            <div class="card-header">
                <div class="w-100">
                    @can('vehicle_discount_add')
                        <a href="{{ url('admin/vehicle_discount/create/'.$id) }}" class="btn btn-primary float-right">{{__('Add New')}}</a>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped text-center" id="datatable">
                        <thead>
                            <tr>
                                <th>
                                    <input name="select_all" value="1" id="master" type="checkbox" />
                                    <label for="master"></label>
                                </th>
                                <th>#</th>
                                <th>{{__('Discount image')}}</th>
                                <th>{{__('Discount type')}}</th>
                                <th>{{__('Discount')}}</th>
                                <th>{{__('Start to end date')}}</th>
                                @if(Gate::check('vehicle_discount_edit') || Gate::check('vehicle_discount_delete'))
                                    <th>{{__('Action')}}</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($discounts as $discount)
                                <tr>
                                    <td>
                                        <input name="id[]" value="{{$discount->id}}" id="{{$discount->id}}" data-id="{{ $discount->id }}" class="sub_chk" type="checkbox" />
                                        <label for="{{$discount->id}}"></label>
                                    </td>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>
                                        <img src="{{ url('images/upload/'.$discount->image) }}" width="50" height="50" class="rounded" alt="">
                                    </td>
                                    <td>{{ $discount->type }}</td>
                                    <td>
                                        @if($discount->type == 'amount')
                                            {{ $currency }}{{ $discount->discount }}
                                        @endif
                                        @if($discount->type == 'percentage')
                                            {{ $discount->discount }}%
                                        @endif
                                    </td>
                                    <td>{{ $discount->start_end_date }}</td>
                                    @if(Gate::check('vehicle_discount_edit') || Gate::check('vehicle_discount_delete'))
                                        <td>
                                            @can('vehicle_discount_edit')
                                                <a href="{{ url('admin/vehicle_discount/'.$discount->id.'/edit') }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                            @endcan

                                            @can('vehicle_discount_delete')
                                                <a href="javascript:void(0);" class="table-action btn btn-danger btn-action" onclick="deleteData('vehicle/vehicle_discount',{{ $discount->id }},'Vehicle Discount')">
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
            </div>
            <div class="card-footer">
                <input type="button" value="Delete selected" onclick="deleteAll('vehicle_discount_multi_delete','Vehicle Discount')" class="btn btn-primary">
            </div>
        </div>
    </div>
</section>

@endsection
