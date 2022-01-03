@if (!$view->shared('javascript', false))

    @if ($view->share('javascript', true)) @endif

    @if ($options['async'])

        <script type="text/javascript">
            var initialize_items = [];

            function initialize_method() {
                initialize_items.forEach(function(item) {
                    item.method();
                });
            }

            function livloc() {
                var locations = <?php print_r(json_encode($vehicles)); ?>;

                var mymap = new GMaps({
                    el: '#mymap',
                    lat: 57.708870,
                    lng: 11.974560,
                    zoom: 6
                });
            });


            $.each(locations, function(index, value) {
                mymap.addMarker({
                    lat: value.lat,
                    lng: value.lon,
                    // title: value.city,
                    // click: function(e) {
                    //     alert('This is ' + value.city + ', gujarat from India.');
                    // }
                });
            });
        </script>

        <script async defer type="text/javascript"
                src="//maps.googleapis.com/maps/api/js?v={!! $options['version'] !!}&region={!! $options['region'] !!}&language={!! $options['language'] !!}&key={!! $options['key'] !!}&libraries=places&callback=initialize_method">
        </script>

    @else

        <script type="text/javascript"
                src="//maps.googleapis.com/maps/api/js?v={!! $options['version'] !!}&region={!! $options['region'] !!}&language={!! $options['language'] !!}&key={!! $options['key'] !!}&libraries=places">
        </script>

    @endif

    @if ($options['cluster'])

        <script type="text/javascript" src="//googlearchive.github.io/js-marker-clusterer/src/markerclusterer.js"></script>

    @endif

@endif
