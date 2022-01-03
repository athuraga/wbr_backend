@extends('admin.layout.base')
@section('title', 'Add Zone ')
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
</head>
<style>
    html,
    body {
        padding: 0;
        margin: 0;
        width: 100%;
        height: 100%;
    }

    #map {
        padding: 0;
        margin: 0;
        width: 100%;
        height: 80%;
    }

    #submit_zone_btn {
        background-color: #b01d23;
        color: #fff !important;
        font-weight: bold;
    }

    .intr {
        color: red;
        font-style: italic;
    }

    #panel {
        width: 200px;
        font-family: Arial, sans-serif;
        font-size: 13px;
        float: right;
        margin: 10px;
    }

    #color-palette {
        clear: both;
        display: none;
    }

    .color-button {
        width: 14px;
        height: 14px;
        font-size: 0;
        margin: 2px;
        float: left;
        cursor: pointer;
    }

    #delete-button {
        margin-top: 5px;
        display: none;
    }

    .gmnoprint>div:nth-child(4),
    .gmnoprint>div:nth-child(5) {
        display: none !important;
    }

</style>

<body>

    <div class="content-area py-1" style="">
        <div class="container-fluid">
            @section('content')

                <div class='box' style="background: #fff;">
                    <h5 style='padding: 10px;margin-bottom: -15px;'><span class="s-icon"><i
                                class="ti-zoom-in"></i></span>&nbsp; Add Location</h5>
                    <hr>
                    <input id="pac-input" class="form-control" type="text" placeholder="Enter Location"
                        style="top:5px!important;width:50%;">

                    <div id="panel">
                        <div id="color-palette"></div>
                        <div>
                            <button id="delete-button">Delete Selected Shape</button>
                        </div>
                    </div>
                    <div id="map"></div>

                </div>
            </div>
        </div>
        @include('admin.layout.partials.zone_form')

    @endsection
    </div>
</body>

@section('scripts')
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=geometry,places,drawing&callback=initialize&ext=.js">
    </script>
    <script type="text/javascript">
        var map;
        var geocoder;
        var drawingManager;
        var selectedShape;
        var colors = ['#1E90FF', '#FF1493', '#32CD32', '#FF8C00', '#4B0082'];
        var selectedColor;
        var colorButtons = {};
        var polygons = [];
        var polygonArray = [];
        var googleMarkers = [];
        var all_zones = [];
        var edit_polygon;

        var polygonOptions = {
            fillColor: '#BCDCF9',
            fillOpacity: 0.0,
            strokeWeight: 2,
            strokeColor: '#57ACF9',
            zIndex: 1
        };
        var markerOptions = {
            icon: 'images/car-icon.png'
        };
        var drawingControl = true;

        <?php if( isset( $zone ) ) { ?>
        edit_zone = {!! json_encode($zone) !!};
        if (edit_zone) {

            edit_polygon = edit_zone.coordinate;
        }
        <?php  }  ?>

        <?php if( count($all_zones) ) { ?>
        var all_zones = <?php echo json_encode($all_zones); ?>;
        <?php } ?>


        var locations = [
            ['Bondi Beach', -33.890542, 151.274856, 4],
            ['Coogee Beach', -33.923036, 151.259052, 5],
            ['Cronulla Beach', -34.028249, 151.157507, 3],
            ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
            ['Maroubra Beach', -33.950198, 151.259302, 1]
        ];
        var lat = parseFloat($('#lat').val());
        var lng = parseFloat($('#lang').val());

        function initMap() {
            const map = new google.maps.Map(document.getElementById("livloc"), {
                center: {
                    lat: lat,
                    lng: lng
                },
                zoom: 13,
                mapTypeId: "roadmap",
            });

            const a = new google.maps.Marker({
                position: {
                    lat: lat,
                    lng: lng
                },
                map,
            });
        }
        var map = new google.maps.Map(document.getElementById("livloc"), {
            zoom: 10,
            center: new google.maps.LatLng(-33.92, 151.25),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
        // var latv = {
        //     axios.get('http://localhost:8000/api/vehiclesloc')
        //         .then((response) => this.vehicles = response.data)
        //         .catch((error) => console.error(error));
        // }




        // data() {
        //     return {
        //         mapName: "map",

        //         // Create the estate object first, otherwise it will not be reactive
        //         estates: {}
        //     }
        // },

        // mounted() {
        //     this.fetchEstates();
        //     this.initMap();
        // },
        // methods: {
        //     fetchEstates: function(page = 1) {
        //         axios.get('/ajax', {
        //             params: {
        //                 page
        //             }
        //         }).then((response) => {
        //             this.estates = response.data.data;

        //             // Once estates have been populated, we can insert markers
        //             this.insertMarkers();

        //             //pagination and stuff...
        //         });
        //     },

        //     // Iniitialize map without creating markers
        //     initMap: function() {
        //         var mapOptions = {
        //             zoom: 6,
        //             center: {
        //                 lat: 34.652500,
        //                 lng: 135.506302
        //             }
        //         };

        //         var map = new google.maps.Map(document.getElementById(this.mapName), mapOptions);
        //     },

        //     // Helper method to insert markers
        //     insertMarkers: function() {

        //         // Iterate through each individual estate
        //         // Each estate will create a new marker
        //         this.estates.forEach(estate => {
        //             var marker = new google.maps.Marker({
        //                 map: map,
        //                 icon: 'imgs/marker.png',
        //                 url: "http://localhost:8000/api/vehiclesloc",
        //                 label: {
        //                     text: estate.price,
        //                     color: "#fff",
        //                 },
        //                 position: {
        //                     lat: estate.lat,
        //                     lng: estate.lng
        //                 }
        //             });

        //             google.maps.event.addListener(marker, 'click', function() {
        //                 window.location.href = this.url;
        //             });
        //         });
        //     }
        // },
    </script>
@endsection
