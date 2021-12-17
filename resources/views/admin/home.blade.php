@extends('layouts.app',['activePage' => 'home'])

@section('title','Admin Dashboard')

@section('content')
<script type="text/javascript">
window.onload = () => {
    $(".main-sidebar").niceScroll();
}
</script>
<section class="section">
    <div class="section-header">
        <h1>{{__('Admin dashboard')}}</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col">
                <div class="card card-primary rounded-lg">
                    <div class="card-header">
                        <h5>{{__("Day to Day Ride Management Records")}}</h5>
                    </div>
                    <div class="card-body">
                        <h3>{{ $today_orders }}</h3>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-primary rounded-lg">
                    <div class="card-header">
                        <h5>{{__("Today's earning")}}</h5>
                    </div>
                    <div class="card-body">
                        <h3>{{ $currency }}{{ $today_earnings }}</h3>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-primary rounded-lg">
                    <div class="card-header">
                        <h5>{{__("Total rides")}}</h5>
                    </div>
                    <div class="card-body">
                        <h3>{{ $total_orders }}</h3>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card card-primary rounded-lg">
                    <div class="card-header">
                        <h5>{{__("Total earning")}}</h5>
                    </div>
                    <div class="card-body">
                        <h3>{{ $currency }}{{ $total_earnings }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Vehicles Live Location')}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="row">
                                    <div class="pac-card col-md-12 mb-3" id="pac-card">
                                        <label for="pac-input">{{__('Location based on latitude/lontitude')}}<span
                                                class="text-danger">&nbsp;*</span></label>
                                        <div id="pac-container">
                                            <input id="pac-input" type="text" name="map_address"
                                                value="{{ old('map_address') }}" class="form-control"
                                                placeholder="Enter A Location" />
                                            <input type="hidden" name="lat" value="{{57.708870}}" id="lat">
                                            <input type="hidden" name="lang" value="{{11.974560}}" id="lang">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="min_order_amount">{{__('Enter VIN')}}<span
                                                class="text-danger">&nbsp;*</span></label>
                                        <input type="text" class="form-control" name="address"
                                            value="{{ old('address') }}" placeholder="{{__('Vehicle Identification')}}"
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

        </div>
        <div class="row">
            <div class="col-xl-6 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-dark w-50">{{__('Growth & progress')}}</h4>
                        <div class="w-50 text-right">
                            <input type="text" name="filter_date_range" class="form-control">
                        </div>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active show" id="home-tab3" data-toggle="tab" href="#home3"
                                    role="tab" aria-controls="home" aria-selected="false">{{__('rides')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab"
                                    aria-controls="profile" aria-selected="true">{{__('earnings')}}</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent2">
                            <div class="tab-pane fade active show" id="home3" role="tabpanel"
                                aria-labelledby="home-tab3">
                                <canvas id="orderChart" class="chartjs-render-monitor"
                                    style="display: block; width: 580px; height: 250px"></canvas>
                            </div>
                            <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                <canvas id="earningChart" class="chartjs-render-monitor"
                                    style="display: block; width: 580px; height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Avarage Usage Time of vehicle')}}</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="avarageTime" class="chartjs-render-monitor"
                            style="display: block; width: 580px; height: 250px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{__('Top Cities Avg. Rides/Day')}}</h4>
                    </div>
                    <div class="card-body">
                        @foreach ($topItems as $topItem)
                        <div class="tickets-list">
                            <a class="ticket-item">
                                <div class="ticket-title text-muted">
                                    <h4>{{ $topItem->itemName }}</h4>
                                </div>
                                <div class="ticket-info">
                                    <div>{{ $topItem->total }}{{' time served'}}</div>
                                    <div class="w-100">
                                        @if ($topItem->type == 'veg')
                                        <img src="{{ url('images/veg.png') }}" class="float-right" alt="">
                                        @else
                                        <img src="{{ url('images/non-veg.png') }}" class="float-right" alt="">
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@section('js')
<script
    src="https://maps.googleapis.com/maps/api/js?key={{ App\Models\GeneralSetting::first()->map_key }}&callback=initMap&libraries=places&v=weekly"
    defer></script>
<script src="{{ asset('js/map.js') }}"></script>
@endsection