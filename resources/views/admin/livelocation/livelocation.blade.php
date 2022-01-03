@extends('layouts.app',['activePage' => 'livelocation'])

@section('title', 'Livelocation')

@section('content')

    <section class="section">
        <div class="section-header">
            <h1>{{ __('Livelocation') }}</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ url('admin/home') }}">{{ __('Dashboard') }}</a></div>
                <div class="breadcrumb-item">{{ __('Livelocation') }}</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">{{ __('Vehicles List') }}</h2>
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="datatable" class="table table-striped table-bordered text-center" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th>{{ __('VIN') }}</th>
                                <th>{{ __('Lat') }}</th>
                                <th>{{ __('Lon') }}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicles as $vehicle)
                                <tr>

                                    <td>{{ $vehicle->license_number }}</td>
                                    <td>{{ $vehicle->lat }}</td>
                                    <td>{{ $vehicle->lang }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="flex-center position-ref full-height">
                    <div class="content">
                        <h2>Vehicles Live Location
                        </h2>
                        {{-- <div id="vlocations" data-field-id="{{ $vehicles }}">
                        </div> --}}
                        <!DOCTYPE html>
                        <html>

                        <head>
                            <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
                            <style type="text/css">
                                html {
                                    height: 100%;
                                }

                                body {
                                    height: 100%;
                                    margin: 0px;
                                    padding: 0px;
                                }

                                #location_canvas {
                                    height: 100%;
                                }

                            </style>
                            {{-- <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC2wDZend4lfhVc4oXgnWR-r3-xXe0UFxM&sensor=false"></script> --}}
                            {{-- <script>
                                function initialize() {
                                    var laa = 33.88785065024179;
                                    var lonn = -118.41315937548767;
                                    var mapOptions = {
                                        zoom: 10,
                                        center: new google.maps.LatLng(laa, lonn),
                                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                                        maxZoom: 16,
                                        minZoom: 2
                                    };

                                    var map = new google.maps.Map(document.getElementById('location-canvas'),
                                        mapOptions);

                                    var marker = new google.maps.Marker({
                                        map: map,
                                        draggable: false,
                                        position: new google.maps.LatLng(laa, lonn),
                                        icon: '/images/wbrclipartback.png'
                                    });

                                    function bind(eventName) {
                                        google.maps.event.addListener(map, eventName, function() {
                                            common();

                                        });
                                    }

                                    bind('zoom_changed');
                                    bind('center_changed');
                                    bind('tilesloaded');
                                    bind('idle');

                                    function common() {
                                        var bounds = map.getBounds();
                                        var southWest = bounds.getSouthWest();
                                        var northEast = bounds.getNorthEast();
                                        var getcentre = bounds.getCenter();
                                        var ne = map.getBounds().getNorthEast();
                                        var sw = map.getBounds().getSouthWest();
                                        var zoom = map.getZoom();
                                        var centre_lat = getcentre.lat();
                                        var centre_long = getcentre.lng();
                                        var myLatlng = new google.maps.LatLng(centre_lat, centre_long);
                                        var mapProp = {
                                            center: new google.maps.LatLng(centre_lat, centre_long),
                                            zoom: zoom,
                                            maxZoom: 16,
                                            minZoom: 2,
                                            mapTypeId: google.maps.MapTypeId.ROADMAP
                                        };

                                    }

                                    function livloc() {

                                        var locations = [
                                            ['California', 34.0755477146572, -118.35536890917659, 1],
                                            ['Gothenburg', 57.70709934911183, 11.969606646032718, 2],
                                            ['Chennai', 13.00007091319314, 80.27235211815434, 3],
                                            ['Bangalore', 13.01889811132328, 77.56257716744605, 4],
                                            ['Delhi', 28.557001085022492, 77.09989342524587, 5],
                                            ['Mumbai', 19.10958483688843, 72.824281495344, 6],
                                            ['Hyderabad', 17.450721489001552, 78.38066067334638, 7],
                                            ['Coimbatore', 11.06157357793813, 76.99572885636955, 8]
                                        ];
                                        var lat = parseFloat($('#lat').val());
                                        var lng = parseFloat($('#lang').val());
                                        var base_url = $("#mainurl").val();


                                        var infowindow = new google.maps.InfoWindow();

                                        var marker, i;

                                        for (i = 0; i < locations.length; i++) {
                                            var marker = new google.maps.Marker({
                                                map: map,
                                                draggable: false,
                                                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                                                icon: '/images/wbrclipartgradient.png'
                                            });

                                        };

                                        google.maps.event.addListener(marker, 'click', (function(marker, i) {
                                            return function() {
                                                infowindow.setContent(locations[i][0]);
                                                infowindow.open(map, marker);
                                            }
                                        })(marker, i));

                                        // api url
                                        const api_url =
                                            "http://localhost:8000/api/vehiclesloc";
                                        var marker, j;
                                        var vlocations = [];

                                        for (j = 0; j < vlocations.length; j++) {
                                            var marker = new google.maps.Marker({
                                                map: map,
                                                draggable: false,
                                                position: new google.maps.LatLng(vlocations[j].lat, vlocations[j].lang),
                                                icon: '/images/wbrclipartgradient.png'
                                            });

                                        };

                                        google.maps.event.addListener(marker, 'click', (function(marker, j) {
                                            return function() {
                                                infowindow.setContent(locations[j][0]);
                                                infowindow.open(map, marker);
                                            }
                                        })(marker, j));
                                    }

                                    function bind(eventName) {
                                        google.maps.event.addListener(map, eventName, function() {
                                            livloc();

                                        });
                                    }

                                }

                                google.maps.event.addDomListener(window, 'resize', initialize);
                                google.maps.event.addDomListener(window, 'load', initialize);
                            </script> --}}
                            {{-- <script src="{{ asset('js/livloc.js') }}"></script> --}}

                            <div id='location-canvas' style='width:100%;height:500px;'> </div>

                            <script>
                                var vlocations = @json($vehicles);
                            </script>
                        </head>

                        </html>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ App\Models\GeneralSetting::first()->map_key }}&callback=initialize"
        defer></script>
    <script src="{{ asset('js/livloc.js') }}"></script>
@endsection
