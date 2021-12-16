@extends('layouts.app',['activePage' => 'vehicle'])

@section('title','Vehicle Profile')

@section('content')

<section class="section">
        <div class="section-header">
            <h1>{{__('Vehicle profile')}}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('vehicle/vehicle_home') }}">{{__('Dashboard')}}</a></div>
                <div class="breadcrumb-item">{{__('vehicle profile')}}</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">{{__("Vehicle profile")}}</h2>
            <p class="section-lead">{{__('Vehicle profile')}}</p>
            <form class="container-fuild" action="{{ url('vehicle/vehicle/'.$vehicle->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-header">
                        <h6 class="c-grey-900">{{__('Vehicle')}}</h6>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="Promo code name">{{__('Vehicle image')}}</label>
                                <div class="logoContainer">
                                    <img id="image" src="{{url($vehicle->image)}}"  width="180" height="150" class="rounded-lg p-2">
                                </div>
                                <div class="fileContainer sprite">
                                    <span>{{__('Image')}}</span>
                                    <input type="file" data-id="edit" name="image" value="Choose File" id="previewImage" accept=".png, .jpg, .jpeg, .svg">
                                </div>
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="Image">{{__('Vehicle logo')}}</label>
                                <div class="logoContainer">
                                    <img id="licence_doc" src="{{ $vehicle->vehicle_logo }}" width="200" height="182" class="rounded-lg p-2">
                                </div>
                                <div class="fileContainer">
                                    <span>{{__('Image')}}</span>
                                    <input type="file" data-id="edit" name="vehicle_logo" value="Choose File" id="previewlicence_doc"
                                        accept=".png, .jpg, .jpeg, .svg">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="Vehicle name">{{__('Vehicle Name')}}<span class="text-danger">&nbsp;*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is_invalide @enderror"
                                    placeholder="{{__('Vehicle Name')}}" value="{{ $vehicle->name }}" required=""
                                    style="text-transform: none;">

                                @error('name')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="{{__('Email')}}">{{__('Email Address')}}</label>
                                <input type="text" name="email_id" value="{{ $vehicle->email_id }}"
                                    class="form-control @error('email_id') is_invalide @enderror"
                                    placeholder="{{__('Email id')}}" style="text-transform: none;" readonly>

                                @error('email_id')
                                <span class="custom_error" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-5">
                                <label for="{{__('contact')}}">{{__('Contact')}}<span class="text-danger">&nbsp;*</span></label>
                                <div class="row">
                                    <div class="col-md-3 p-0">
                                        <select name="phone_code" required class="form-control select2">
                                            @foreach ($phone_codes as $phone_code)
                                                <option value="+{{ $phone_code->phonecode }}" {{ $user->phone_code == $phone_code->phonecode ? 'selected' : '' }}>+{{ $phone_code->phonecode }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-9 p-0">
                                        <input type="number" value="{{ $vehicle->contact }}" name="contact" value="{{ old('contact') }}" required class="form-control  @error('contact') is_invalide @enderror">
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
                        <h6 class="c-grey-900">{{__('Select Tags (For Vehicles it will be vehicle_types)')}}</h6>
                    </div>
                    <div class="card-body">
                        <div class="mT-30">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="First name">{{__('Tags')}}<span class="text-danger">&nbsp;*</span></label>

                                    <select class="select2 form-control" name="vehicle_type_id[]" multiple="true">
                                        @foreach ($vehicle_types as $vehicle_type)
                                            <option value="{{$vehicle_type->id}}" {{in_array($vehicle_type->id,explode(',',$vehicle->vehicle_type_id)) ? 'selected' : ''}}>{{ $vehicle_type->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('vehicle_type_id')
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
                                            <label for="pac-input">{{__('Location based on latitude/lontitude')}}<span class="text-danger">&nbsp;*</span></label>
                                            <div id="pac-container">
                                                <input id="pac-input" name="map_address" value="{{ $vehicle->map_address }}" type="text" class="form-control" placeholder="Enter a location" />
                                                @if ($vehicle->lat == null && $vehicle->lang == null)
                                                    <input type="hidden" name="lat" value="22.3039" id="lat">
                                                    <input type="hidden" name="lang" value="70.8022" id="lang">
                                                @else
                                                    <input type="hidden" name="lat" value="{{$vehicle->lat}}" id="lat">
                                                    <input type="hidden" name="lang" value="{{$vehicle->lang}}" id="lang">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="min_order_amount">{{__('Vehicle full address')}}<span class="text-danger">&nbsp;*</span></label>
                                            <input type="text" class="form-control" name="address" value="{{ $vehicle->address }}" placeholder="{{__('Vehicle full address')}}" id="location">
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
                                    <label for="min_order_amount">{{__('Minimum order amount')}}<span class="text-danger">&nbsp;*</span></label>
                                    <input type="number" name="min_order_amount" placeholder="{{__('Minimum order amount')}}"
                                        value="{{ $vehicle->min_order_amount }}" required class="form-control @error('min_order_amount') invalid @enderror">

                                        @error('min_order_amount')
                                        <span class="custom_error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="for_two_person">{{__('Cost of two person')}}<span class="text-danger">&nbsp;*</span></label>
                                    <input type="number" name="for_two_person" placeholder="{{__('Cost of two person')}}"
                                        value="{{ $vehicle->for_two_person }}" required class="form-control  @error('for_two_person') invalid @enderror">

                                        @error('min_order_amount')
                                        <span class="custom_error" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="avg_delivery_time">{{__('Avg. delivery time(in min)')}}<span class="text-danger">&nbsp;*</span></label>
                                    <input type="number" name="avg_delivery_time" value="{{ $vehicle->avg_delivery_time }}" placeholder="{{__('Avg delivery time(in min)')}}" required class="form-control @error('avg_delivery_time') invalid @enderror">

                                    @error('avg_delivery_time')
                                    <span class="custom_error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="license_number">{{__('Business License number')}}<span class="text-danger">&nbsp;*</span></label>
                                    <input type="text" name="license_number" value="{{ $vehicle->license_number }}"  required placeholder="{{__('Business License number')}}" class="form-control @error('license_number') is-invalid @enderror">

                                    @error('license_number')
                                    <span class="custom_error" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="vehicle_type">{{__('Vehicle type')}}<span class="text-danger">&nbsp;*</span></label>
                                    <select name="vehicle_type" class="form-control">
                                        <option value="all" {{ $vehicle->vehicle_type == 'all' ? 'selected':'' }}>{{__('All')}}</option>
                                        <option value="veg" {{ $vehicle->vehicle_type == 'veg' ? 'selected':'' }}>{{__('pure veg')}}</option>
                                        <option value="non_veg" {{ $vehicle->vehicle_type == 'non_veg' ? 'selected':'' }}>{{__('none veg')}}</option>
                                        <option value="non_applicable" {{ $vehicle->vehicle_type == 'non_applicable' ? 'selected':'' }}>{{__('non applicable')}}</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="admin_commision_value">{{__('Time slots')}}<span class="text-danger">&nbsp;*</span></label>
                                    <select name="time_slot" class="form-control">
                                        <option value="15"  {{ $vehicle->time_slot == '15' ? 'selected':'' }}>{{__('15 mins')}}</option>
                                        <option value="30"  {{ $vehicle->time_slot == '30' ? 'selected':'' }}>{{__('30 mins')}}</option>
                                        <option value="45"  {{ $vehicle->time_slot == '45' ? 'selected':'' }}>{{__('45 mins')}}</option>
                                        <option value="60"  {{ $vehicle->time_slot == '60' ? 'selected':'' }}>{{__('1 hour')}}</option>
                                        <option value="120" {{ $vehicle->time_slot == '120' ? 'selected':'' }}>{{__('2 hour')}}</option>
                                        <option value="180" {{ $vehicle->time_slot == '180' ? 'selected':'' }}>{{__('3 hour')}}</option>
                                        <option value="240" {{ $vehicle->time_slot == '240' ? 'selected':'' }}>{{__('4 hour')}}</option>
                                        <option value="300" {{ $vehicle->time_slot == '300' ? 'selected':'' }}>{{__('5 hour')}}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <!-- <div class="col-md-6 mb-3">
                                    <label for="tax">{{__('GSTIN(%)')}}<span class="text-danger">&nbsp;*</span></label>
                                    <input type="number" required name="tax" value="{{ $vehicle->tax }}" placeholder="{{__('Resturant tax in %')}}" class="form-control">
                                </div> -->

                                <div class="col-md-6 mb-3">
                                    <label for="tax">{{__('vehicle language')}}</label>
                                    <select name="vehicle language" class="form-control">
                                        @foreach ($languages as $language)
                                            <option value="{{ $language->name }}" {{ $language->name == $vehicle->vehicle_language ? 'selected' : '' }}>{{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label for="{{__('status')}}">{{__('Status')}}</label><br>
                                    <label class="switch">
                                        <input type="checkbox" name="status" {{ $vehicle->status == 1 ? 'checked' : '' }}>
                                        <div class="slider"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" type="submit">{{__('Update Vehicle')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
</section>

@endsection

@section('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ App\Models\GeneralSetting::first()->map_key }}&callback=initMap&libraries=places&v=weekly" defer></script>
    <script src="{{ asset('js/map.js') }}"></script>
@endsection