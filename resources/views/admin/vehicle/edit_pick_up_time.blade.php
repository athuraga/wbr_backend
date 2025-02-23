@extends('layouts.app',['activePage' => 'vehicle'])

@section('title','Vehicle Pickup Timeslots')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>{{ $vehicle->name }}&nbsp;{{__('PickUp Time')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item active"><a href="{{ url('admin/vehicle/'.$vehicle->id) }}">{{ App\Models\Vehicle::find($vehicle->id)->name }}</a></div>
                <div class="breadcrumb-item">{{__('Edit PickUp Time')}}</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">{{__('Vehicle Management System')}}</h2>

            <p class="section-lead">{{__('Edit Pickup time')}}</p>
            <div class="card p-5">
                <div class="row">
                    <input type="hidden" id="start_time" value="{{ $start_time }}">
                    <input type="hidden" id="end_time" value="{{ $end_time }}">
                    <input type="hidden" id="timeslot" value="{{ $vehicle->time_slot }}">

                    <div class="table-responsive">
                        <form action="{{ url('admin/update_pick_up_time') }}" method="post">
                        @csrf
                            <input type="hidden" name="vehicle_id" value="{{ $vehicle->id }}">
                            <table class="table deliveryTimeTable">
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td style="vertical-align: text-top">{{$item['day_index']}}</td>
                                            <td style="vertical-align: text-top">
                                                @if ($item['status'] == 1)
                                                    {{__('Open')}}
                                                @endif
                                                @if ($item['status'] == 0)
                                                    {{__('Close')}}
                                                @endif
                                            </td>
                                            <td style="vertical-align: text-top">
                                                <div>
                                                    <label class="switch">
                                                        <input type="checkbox" name="{{'status'.$item['id']}}" {{ $item['status'] == 1 ? 'checked' : '' }}>
                                                        <div class="slider"></div>
                                                    </label>
                                                </div>
                                            </td>
                                            @php
                                                $time = json_decode($item['period_list']);
                                            @endphp
                                            <td>
                                                <table>
                                                    @foreach ($time as $period_list)
                                                        <tr id="{{'tr'.$item['day_index']}}">
                                                            <td>
                                                                <input readonly class="timeslots" value="{{ $period_list->start_time }}" name="{{'start_time_'.$item['day_index'].'[]' }}" />
                                                            </td>
                                                            <td>
                                                                <input readonly class="timeslots" value="{{ $period_list->end_time }}"  name="{{'end_time_'.$item['day_index'].'[]'}}" />
                                                            </td>
                                                            <td>
                                                                @if ($loop->iteration == 1)
                                                                    <button type="button" class="btn btn-primary" onclick="addhours('{{$item['day_index']}}')">{{__('+ Add hours')}}</button>
                                                                @else
                                                                    <button type="button" class="removebtn btn btn-danger text-light"><i class="fas fa-times"></i></button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            <input type="submit" value="{{__('save')}}" class="btn btn-primary">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
