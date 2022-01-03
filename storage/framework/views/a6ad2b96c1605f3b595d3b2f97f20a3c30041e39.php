<div id="map-canvas-<?php echo $id; ?>" style="width: 100%; height: 100%; margin: 0; padding: 0; position: relative; overflow: hidden;"></div>

<script type="text/javascript">

    var maps = [];

    function initialize_<?php echo $id; ?>() {
        var bounds = new google.maps.LatLngBounds();
        var infowindow = new google.maps.InfoWindow();
        var position = new google.maps.LatLng(<?php echo $options['latitude']; ?>, <?php echo $options['longitude']; ?>);

        var mapOptions_<?php echo $id; ?> = {
            <?php if($options['center']): ?>
                center: position,
            <?php endif; ?>
            zoom: <?php echo $options['zoom']; ?>,
            mapTypeId: google.maps.MapTypeId.<?php echo $options['type']; ?>,
            disableDefaultUI: <?php if(!$options['ui']): ?> true <?php else: ?> false <?php endif; ?>,
            scrollwheel: <?php if($options['scrollWheelZoom']): ?> true <?php else: ?> false <?php endif; ?>,
            zoomControl: <?php if($options['zoomControl']): ?> true <?php else: ?> false <?php endif; ?>,
            mapTypeControl: <?php if($options['mapTypeControl']): ?> true <?php else: ?> false <?php endif; ?>,
            scaleControl: <?php if($options['scaleControl']): ?> true <?php else: ?> false <?php endif; ?>,
            streetViewControl: <?php if($options['streetViewControl']): ?> true <?php else: ?> false <?php endif; ?>,
            rotateControl: <?php if($options['rotateControl']): ?> true <?php else: ?> false <?php endif; ?>,
            fullscreenControl: <?php if($options['fullscreenControl']): ?> true <?php else: ?> false <?php endif; ?>,
            gestureHandling: '<?php echo $options['gestureHandling']; ?>'
        };

        var map_<?php echo $id; ?> = new google.maps.Map(document.getElementById('map-canvas-<?php echo $id; ?>'), mapOptions_<?php echo $id; ?>);
        map_<?php echo $id; ?>.setTilt(<?php echo $options['tilt']; ?>);

        var markers = [];
        var infowindows = [];
        var shapes = [];

        <?php $__currentLoopData = $options['markers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $marker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $marker->render($key, $view); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php $__currentLoopData = $options['shapes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $shape): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo $shape->render($key, $view); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if($options['overlay'] == 'BIKE'): ?>
            var bikeLayer = new google.maps.BicyclingLayer();
            bikeLayer.setMap(map_<?php echo $id; ?>);
        <?php endif; ?>

        <?php if($options['overlay'] == 'TRANSIT'): ?>
            var transitLayer = new google.maps.TransitLayer();
            transitLayer.setMap(map_<?php echo $id; ?>);
        <?php endif; ?>

        <?php if($options['overlay'] == 'TRAFFIC'): ?>
            var trafficLayer = new google.maps.TrafficLayer();
            trafficLayer.setMap(map_<?php echo $id; ?>);
        <?php endif; ?>

        var idleListener = google.maps.event.addListenerOnce(map_<?php echo $id; ?>, "idle", function () {
            map_<?php echo $id; ?>.setZoom(<?php echo $options['zoom']; ?>);

            <?php if(!$options['center']): ?>
                map_<?php echo $id; ?>.fitBounds(bounds);
            <?php endif; ?>

            <?php if($options['locate']): ?>
                if (typeof navigator !== 'undefined' && navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {
                        map_<?php echo $id; ?>.setCenter(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
                    });
                }
            <?php endif; ?>
        });

        var map = map_<?php echo $id; ?>;

        <?php if(isset($options['eventBeforeLoad'])): ?>
            <?php echo $options['eventBeforeLoad']; ?>

        <?php endif; ?>

        <?php if(isset($options['eventAfterLoad'])): ?>
            google.maps.event.addListenerOnce(map_<?php echo $id; ?>, "tilesloaded", function() {
                <?php echo $options['eventAfterLoad']; ?>

            });
        <?php endif; ?>

        <?php if($options['cluster']): ?>
            var markerClusterOptions = {
                imagePath: '<?php echo $options['clusters']['icon']; ?>',
                gridSize: <?php echo $options['clusters']['grid']; ?>,
                maxZoom: <?php if($options['clusters']['zoom'] === null): ?> null <?php else: ?> <?php echo $options['clusters']['zoom']; ?> <?php endif; ?>,
                averageCenter: <?php if($options['clusters']['center'] === true): ?> true <?php else: ?> false <?php endif; ?>,
                minimumClusterSize: <?php echo $options['clusters']['size']; ?>

            };
            var markerCluster = new MarkerClusterer(map_<?php echo $id; ?>, markers, markerClusterOptions);
        <?php endif; ?>

        maps.push({
            key: <?php echo $id; ?>,
            markers: markers,
            infowindows: infowindows,
            map: map_<?php echo $id; ?>,
            shapes: shapes
        });
    }

    <?php if(!$options['async']): ?>

        google.maps.event.addDomListener(window, 'load', initialize_<?php echo $id; ?>);

    <?php endif; ?>

</script>
<?php /**PATH /Users/wbr/Sites/wbr_backend/resources/views/cornford/googlmapper/map.blade.php ENDPATH**/ ?>