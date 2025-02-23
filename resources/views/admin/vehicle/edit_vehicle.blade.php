@extends('layouts.app',['activePage' => 'vehicle'])

@section('title','Edit Vehicle')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>{{__('Edit Vehicle')}}</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{__('Dashboard')}}</a></div>
            <div class="breadcrumb-item"><a href="{{ url('admin/vehicle') }}">{{__('vehicle')}}</a></div>
            <div class="breadcrumb-item">{{__('Edit vehicle')}}</div>
        </div>
    </div>
    @if ($errors->any())
    <div class="alert alert-primary alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>×</span>
            </button>
            @foreach ($errors->all() as $item)
            {{ $item }}
            @endforeach
        </div>
    </div>
    @endif
    <div class="section-body">
        <h2 class="section-title">{{__('Vehicle Management System')}}</h2>
        <p class="section-lead">{{__('Edit vehicle detail')}}</p>
        <form class="container-fuild" action="{{ url('admin/vehicle/'.$vehicle->id) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h6 class="c-grey-900">{{__('Vehicle')}}</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="Promo code name">{{__('Vehicle image')}}</label>
                            <div class="logoContainer">
                                <img id="image" src="{{ $vehicle->image }}" width="180" height="150">
                            </div>
                            <div class="fileContainer sprite">
                                <span>{{__('Image')}}</span>
                                <input type="file" name="image" value="Choose File" id="previewImage" data-id="edit"
                                    accept=".png, .jpg, .jpeg, .svg">
                            </div>
                            @error('image')
                            <span class="custom_error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="Image">{{__('Vehicle logo')}}</label>
                            <div class="logoContainer">
                                <img id="licence_doc" src="{{ $vehicle->vehicle_logo }}" width="180" height="150">
                            </div>
                            <div class="fileContainer">
                                <span>{{__('Image')}}</span>
                                <input type="file" name="vehicle_logo" data-id="edit" value="Choose File"
                                    id="previewlicence_doc" accept=".png, .jpg, .jpeg, .svg">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="Vehicle name">{{__('Vehicle Name')}}<span
                                    class="text-danger">&nbsp;*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is_invalide @enderror"
                                placeholder="{{__('Vehicle Name')}}" value="{{ $vehicle->name }}" required="">

                            @error('name')
                            <span class="custom_error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="{{__('Email')}}">{{__('Email Address')}}<span
                                    class="text-danger">&nbsp;*</span></label>
                            <input type="email" name="email_id" value="{{ $vehicle->email_id }}"
                                class="form-control @error('email_id') is_invalide @enderror"
                                placeholder="{{__('Email Address')}}" readonly>

                            @error('email_id')
                            <span class="custom_error" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-5">
                            <label for="{{__('contact')}}">{{__('Contact')}}<span
                                    class="text-danger">&nbsp;*</span></label>
                            <div class="row">
                                <div class="col-md-3 p-0">
                                    <select name="phone_code" required class="form-control select2">
                                        @foreach ($phone_codes as $phone_code)
                                        <option value="+{{ $phone_code->phonecode }}"
                                            {{ $user->phone_code == $phone_code->phonecode ? 'selected' : '' }}>
                                            +{{ $phone_code->phonecode }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-9 p-0">
                                    <input type="number" name="contact" value="{{ $vehicle->contact }}" required
                                        class="form-control  @error('contact') is_invalide @enderror">
                                    @error('contact')
                                    <span class="custom_error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-header">
                    <h6 class="c-grey-900">{{__('Select Tags (For Vehicles it will be vehicletypes)')}}</h6>
                </div>
                <div class="card-body">
                    <div class="mT-30">
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="First name">{{__('Tags')}}<span class="text-danger">&nbsp;*</span></label>
                                <select class="select2 form-control" name="vehicletype_id[]" multiple="true">
                                    @foreach ($vehicletypes as $vehicletype)
                                    <option value="{{$vehicletype->id}}"
                                        {{in_array($vehicletype->id,explode(',',$vehicle->vehicletype_id)) ? 'selected' : ''}}>
                                        {{ $vehicletype->name }}</option>
                                    @endforeach
                                </select>
                                @error('vehicletype_id')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-header">
                    <h6 class="c-grey-900">{{__('Location')}}</h6>
                </div>
                <div class="card-body">
                    <div class="mT-30">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="row">
                                    <div class="pac-card col-md-12 mb-3" id="pac-card">
                                        <label for="pac-input">{{__('Location based on latitude/lontitude')}}<span
                                                class="text-danger">&nbsp;*</span></label>
                                        <div id="pac-container">
                                            <input id="pac-input" name="map_address" value="{{ $vehicle->map_address }}"
                                                type="text" class="form-control" placeholder="Enter A Location" />
                                            <input type="hidden" name="lat" value="{{ $vehicle->lat }}" id="lat">
                                            <input type="hidden" name="lang" value="{{ $vehicle->lang }}" id="lang">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="min_order_amount">{{__('Vehicle full address')}}<span
                                                class="text-danger">&nbsp;*</span></label>
                                        <input type="text" class="form-control" name="address"
                                            value="{{ $vehicle->address }}" placeholder="{{__('Vehicle Full Address')}}"
                                            id="location">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    <h6 class="">{{__('Other Information')}}</h6>
                </div>
                <div class="card-body">
                    <div class="mT-30">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="min_order_amount">{{__('Minimum Ride Amount')}}<span
                                        class="text-danger">&nbsp;*</span></label>
                                <input type="number" min=1 name="min_order_amount"
                                    placeholder="{{__('Minimum Ride Amount')}}" value="{{ $vehicle->min_order_amount }}"
                                    required class="form-control @error('min_order_amount') invalid @enderror">

                                @error('min_order_amount')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="for_two_person">{{__('Cost per minute')}}<span
                                        class="text-danger">&nbsp;*</span></label>
                                <input type="number" min=1 name="for_two_person" placeholder="{{__('€/min')}}"
                                    value="{{ old('for_two_person') }}" required
                                    class="form-control  @error('for_two_person') invalid @enderror">

                                @error('min_order_amount')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="avg_delivery_time">{{__('Avg. Run Time(in min)/Full Charge')}}<span
                                        class="text-danger">&nbsp;*</span></label>
                                <input type="number" min=1 name="avg_delivery_time"
                                    value="{{ old('avg_delivery_time') }}"
                                    placeholder="{{__('Avg. Run Time(in min)/Full Charge')}}" required
                                    class="form-control @error('avg_delivery_time') invalid @enderror">

                                @error('avg_delivery_time')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="license_number">{{__('vehicle identification number')}}<span
                                        class="text-danger">&nbsp;*</span></label>
                                <input type="text" name="license_number" value="{{ old('license_number') }}" required
                                    placeholder="{{__('vehicle identification number')}}"
                                    class="form-control @error('license_number') is-invalid @enderror">

                                @error('license_number')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="admin_comission_type">{{__('Operator commission type')}}<span
                                        class="text-danger">&nbsp;*</span></label>
                                <select name="admin_comission_type" class="form-control">
                                    <option value="amount"
                                        {{ (collect(old('admin_comission_type'))->contains('amount')) ? 'selected':'' }}>
                                        {{__('Amount')}}</option>
                                    <option value="percentage"
                                        {{ (collect(old('admin_comission_type'))->contains('percentage')) ? 'selected':'' }}>
                                        {{__('Percenatge')}}</option>
                                </select>

                                @error('admin_commission_type')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="admin_commision_value">{{__('operator comission value')}}<span
                                        class="text-danger">&nbsp;*</span></label>
                                <input type="text" name="admin_comission_value"
                                    value="{{ old('admin_comission_value') }}"
                                    placeholder="{{__('Operator Comission Value')}}" required class="form-control">

                                @error('admin_commision_value')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="vehicle_type">{{__('Vehicle type')}}<span
                                        class="text-danger">&nbsp;*</span></label>
                                <select name="vehicle_type" class="form-control">
                                    <option value="all"
                                        {{ (collect(old('vehicle_type'))->contains('all')) ? 'selected':'' }}>
                                        {{__('All')}}</option>
                                    <option value="Bike"
                                        {{ (collect(old('vehicle_type'))->contains('Bike')) ? 'selected':'' }}>
                                        {{__('Bike')}}</option>
                                    <option value="Scooter"
                                        {{ (collect(old('vehicle_type'))->contains('Scooter')) ? 'selected':'' }}>
                                        {{__('Scooter')}}</option>
                                    <option value="Bicycle"
                                        {{ (collect(old('vehicle_type'))->contains('Bicycle')) ? 'selected':'' }}>
                                        {{__('Bicycle')}}</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="admin_commision_value">{{__('Time slots')}}<span
                                        class="text-danger">&nbsp;*</span></label>
                                <select name="time_slot" class="form-control">
                                    <option value="15"
                                        {{ (collect(old('time_slot'))->contains('15')) ? 'selected':'' }}>
                                        {{__('15 mins')}}</option>
                                    <option value="30"
                                        {{ (collect(old('time_slot'))->contains('30')) ? 'selected':'' }}>
                                        {{__('30 mins')}}</option>
                                    <option value="45"
                                        {{ (collect(old('time_slot'))->contains('45')) ? 'selected':'' }}>
                                        {{__('45 mins')}}</option>
                                    <option value="60"
                                        {{ (collect(old('time_slot'))->contains('60')) ? 'selected':'' }}>
                                        {{__('1 hour')}}</option>
                                    <option value="120"
                                        {{ (collect(old('time_slot'))->contains('120')) ? 'selected':'' }}>
                                        {{__('2 hour')}}</option>
                                    <option value="180"
                                        {{ (collect(old('time_slot'))->contains('180')) ? 'selected':'' }}>
                                        {{__('3 hour')}}</option>
                                    <option value="240"
                                        {{ (collect(old('time_slot'))->contains('240')) ? 'selected':'' }}>
                                        {{__('4 hour')}}</option>
                                    <option value="300"
                                        {{ (collect(old('time_slot'))->contains('300')) ? 'selected':'' }}>
                                        {{__('5 hour')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tax">{{__('Government Tax(%)')}}<span
                                        class="text-danger">&nbsp;*</span></label>
                                <input type="text" name="tax" value="{{ old('tax') }}"
                                    placeholder="{{__('Government Tax In %')}}" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tax">{{__('vehicle language')}}</label>
                                <select name="vehicle language" class="form-control">
                                    @foreach ($languages as $language)
                                    <option value="{{ $language->name }}">{{ $language->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- <div class="row">
                            <div class="col-md-12 mb-3">
                                <input type="checkbox" id="chkbox" name="vehicle_own_driver">
                                <label for="chkbox">{{__('Vehicle Has Own Driver??')}}</label>
                            </div>
                        </div> -->

                        <div class="row">
                            <div class="col-md-12">
                                <label for="{{__('status')}}">{{__('Status')}}</label><br>
                                <label class="switch">
                                    <input type="checkbox" name="status">
                                    <div class="slider"></div>
                                </label>
                            </div>
                        </div>
                        <!-- 
                        <div class="row">
                            <div class="col-md-12">
                                <label for="Explorer">{{__('Explorer ??')}}</label><br>
                                <label class="switch">
                                    <input type="checkbox" name="isExplorer">
                                    <div class="slider"></div>
                                </label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label for="{{__('isTop')}}">{{__('Top Rest ??')}}</label><br>
                                <label class="switch">
                                    <input type="checkbox" name="isTop">
                                    <div class="slider"></div>
                                </label>
                            </div>
                        </div> -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary"
                                type="submit">{{__('Update Vehicle')}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection

@section('js')
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ App\Models\GeneralSetting::first()->map_key }}&callback=initMap&libraries=places&v=weekly"
    defer></script>
<script src="{{ asset('js/map.js') }}"></script>
@endsection