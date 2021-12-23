var map;
var speaker_markers = new Array();
var speaker_pins = new Array();
var infowindow;
var mapScheme;

window.onload = function() {
    initMap();
    applyFilter('');
    monitorFilters(map);
};

function initMap(details) {

    var myOptions = {
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: true,
        scaleControl: true,
        streetViewControl: false,
        center: {
            lat: 53.802,
            lng: -1.261
        },
        zoom: 7,
        draggableCursor: 'default',
        styles: mapScheme,
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    infowindow = new google.maps.InfoWindow({
        content: 'Please wait',
        pixelOffset: new google.maps.Size(0, -16),
    });

    recenter(map);
    return map;
}

function recenter(map) {
    axios.get('{{ route('
            map.recenter ') }}')
        .then(function(response) {
            map.panTo({
                lat: parseFloat(response.data.lat),
                lng: parseFloat(response.data.lng)
            });
            map.setZoom(parseInt(response.data.z));
        });
}

function loadMarkers(map) {
    infowindow.close();

    // clear any current markers
    speaker_pins.forEach(function(marker) {
        marker.setMap(null);
    });
    speaker_pins = [];
    speaker_markers = [];

    axios.get('{{ $specific ? route('
            map.getSpecificSpeaker ', $specific) : route('
            map.getSpeakers ') }}')
        .then(function(response) {

            response.data.forEach(function(speaker, index) {
                addSpeakerMarker(speaker, infowindow, index);
            });

            updateSpeakerCount(response.data.length);
        })
        .catch(function(response) {
            console.log(response);
        });

}

function updateSpeakerCount(count) {
    document.getElementById('spkCount').textContent = count;
    $('#spkCount').addClass('spkCountChanged');
    setTimeout(function() {
        $('#spkCount').removeClass('spkCountChanged');
    }, 3000);
}

function addSpeakerMarker(speaker, infowindow, index) {
    var dodge = new Array(
        [0, 0], [+0.006, -0.01], [-0.006, +0.01], [-0.006, -0.01], [+0.006, +0.01], [+0.006, 0], [+0, +0.01], [+0, -0.01], [-0.006, 0]
    );

    region = document.getElementById('region').value

    if (region == '' || speaker.regioncode == region) {
        icon = '/images/SpeakernetSymbol_32x32_native.png'

    } else {
        icon = '/images/SpeakernetSymbol_32x32_native_red.png'
    }

    var pin = new google.maps.Marker({
        position: {
            lat: parseFloat(speaker.latitude) + parseFloat(dodge[index % 9][0]),
            lng: parseFloat(speaker.longitude) + parseFloat(dodge[index % 9][1])
        },
        map: map,
        icon: icon
    });

    speaker_markers.push(speaker);
    speaker_pins.push(pin);

    google.maps.event.addListener(pin, 'click', function(ev) {
        infowindow.setPosition(ev.latLng);
        infowindow.open(map);
        infowindow.setContent(speaker.speaker.replace(/\b\w/g, function(l) {
            return l.toUpperCase()
        }));
        fillCard(speaker, map, infowindow);
    }, {
        passive: true
    });

}

function fillCard(speaker, map, infowindow) {
    url = '/map/speaker/' + speaker.id + '?lat=' + map.getCenter().lat() + '&lng=' + map.getCenter().lng() + '&z=' +
        map.getZoom();

    axios.get(url)
        .then(function(response) {
            infowindow.setContent(response.data);
        })
        .catch(function(response) {
            console.log(response);
        });

}

function monitorFilters(map) {
    $('#category').on('change', function() {
        applyFilter('cat=' + this.value);
    });

    $('#fee').on('change', function() {
        applyFilter('fee=' + this.value);
    });

    $('#region').on('change', function() {
        applyFilter('region=' + this.value);
    });

    $('#recency').on('change', function() {
        applyFilter('recency=' + this.value);
    });

    $('#notice').on('change', function() {
        applyFilter('notice=' + this.value);
    });

    $('#online').on('change', function() {
        applyFilter('online=' + this.value);
    });
}

function applyFilter(filter) {
    axios.post('/filter?' + filter)
        .then(function(response) {
            loadMarkers(map);
            setFilters(response.data);
            setFilterString(response.data);
        });
}

function setFilters(filters) {
    filterItems = (Object.keys(filters));
    var filterString = '';
    filterItems.forEach(function(item) {
        filterString += '<span class="filterpill">' + filters[item] +
            '<a href="#" onclick="removeFilter(\'' + item + '\')">X</a></span>';
    });

    document.getElementById('filterPills').innerHTML = filterString;
}

function setFilterString(filters) {
    if (Object.keys(filters).length > 0) {
        document.getElementById('filterText').innerHTML = ' vehicles matching your filters';
    } else {
        document.getElementById('filterText').innerHTML = ' vehicles, with no filters applied';
    }
}

function removeFilter(filter) {
    axios.delete('/removefilter/' + filter)
        .then(function(response) {
            loadMarkers(map);
            setFilters(response.data);
            setFilterString(response.data);
            $('#' + filter).get(0).selectedIndex = 0;
        });
}

include('guest._mapScheme')
src = "https://maps.googleapis.com/maps/api/js?key={{ config('app.maps.key') }}&v=3";
src = "https://unpkg.com/axios/dist/axios.min.js"