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
        icon: '/images/wbrclipartblack.png'
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

    function livlocc() {

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
                icon: '/images/wbrclipartgreen.png'
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
        // var vlocations = [];
        // var vlocations = <?php echo json_encode($vehicles); ?>;
        // var input = document.getElementById('vlocations');
        // $.getJSON('http://localhost:8000/api/vehiclesloc', function(data) {
        //     var vlocations = "";
        //     $.each(data, function(index, node) {

        //         vlocations.id = node.id;
        //         vlocations.lat = node.lat;
        //         vlocations.lang = node.lang;
        //     });
        // });
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
            livlocc();

        });
    }

}

function scale() {
    google.maps.event.addDomListener(window, 'resize', initialize);
    google.maps.event.addDomListener(window, 'load', initialize);
}