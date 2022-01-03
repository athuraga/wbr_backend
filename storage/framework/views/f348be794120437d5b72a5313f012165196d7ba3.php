<?php if($options['place']): ?>

    var service = new google.maps.places.PlacesService(<?php echo $options['map']; ?>);
    var request = {
        placeId: <?php echo json_encode((string) $options['place']); ?>

    };

    service.getDetails(request, function(placeResult, status) {
        if (status != google.maps.places.PlacesServiceStatus.OK) {
            alert('Unable to find the Place details.');
            return;
        }

<?php endif; ?>

<?php if($options['locate'] && $options['marker']): ?>
    if (typeof navigator !== 'undefined' && navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            marker_0.setPosition(new google.maps.LatLng(position.coords.latitude, position.coords.longitude));
        });
    }
<?php endif; ?>

var markerPosition_<?php echo $id; ?> = new google.maps.LatLng(<?php echo $options['latitude']; ?>, <?php echo $options['longitude']; ?>);

var marker_<?php echo $id; ?> = new google.maps.Marker({
    position: markerPosition_<?php echo $id; ?>,
    <?php if($options['place']): ?>
        place: {
            placeId: <?php echo json_encode((string) $options['place']); ?>,
            location: { lat: <?php echo $options['latitude']; ?>, lng: <?php echo $options['longitude']; ?> }
        },
        attribution: {
            source: document.title,
            webUrl: document.URL
        },
    <?php endif; ?>

    <?php if(isset($options['clickable'])): ?>
        clickable: <?php echo json_encode((bool) $options['clickable']); ?>,
    <?php endif; ?>

    <?php if(isset($options['cursor'])): ?>
        cursor: <?php echo json_encode((string) $options['cursor']); ?>,
    <?php endif; ?>

    <?php if(isset($options['draggable'])): ?>
        draggable: <?php echo json_encode((bool) $options['draggable']); ?>,
    <?php endif; ?>

    <?php if(isset($options['opacity'])): ?>
        opacity: <?php echo json_encode((float) $options['opacity']); ?>,
    <?php endif; ?>

    <?php if(isset($options['visible'])): ?>
        visible: <?php echo json_encode((bool) $options['visible']); ?>,
    <?php endif; ?>

    <?php if(isset($options['zIndex'])): ?>
        zIndex: <?php echo json_encode((int) $options['zIndex']); ?>,
    <?php endif; ?>

    title: <?php echo json_encode((string) $options['title']); ?>,
    label: <?php if(is_array($options['label'])): ?>
        {
            <?php $__currentLoopData = $options['label']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $key; ?>: <?php echo json_encode((string) $value); ?>,
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        }
    <?php else: ?>
        <?php echo json_encode($options['label']); ?>

    <?php endif; ?>
    ,
    animation: <?php if(empty($options['animation']) || $options['animation'] == 'NONE'): ?> '' <?php else: ?> google.maps.Animation.<?php echo $options['animation']; ?> <?php endif; ?>,
    <?php if(isset($options['icon'])): ?>
        icon: <?php if(is_array($options['icon'])): ?>
            {
                <?php $__currentLoopData = $options['icon']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php switch($key):
case ('symbol'): ?>
                            path: google.maps.SymbolPath.<?php echo $value; ?>,
                        <?php break; ?>;

                        <?php case ('size'): ?>
                        <?php case ('scaledSize'): ?>
                            <?php if(is_array($value)): ?>
                                <?php echo $key; ?>: new google.maps.Size(<?php echo $value[0]; ?>, <?php echo $value[1]; ?>),
                            <?php else: ?>
                                <?php echo $key; ?>: new google.maps.Size(<?php echo $value; ?>, <?php echo $value; ?>),
                            <?php endif; ?>
                        <?php break; ?>;

                        <?php case ('anchor'): ?>
                        <?php case ('origin'): ?>
                        <?php case ('labelOrigin'): ?>
                            <?php if(is_array($value)): ?>
                                <?php echo $key; ?>: new google.maps.Point(<?php echo $value[0]; ?>, <?php echo $value[1]; ?>),
                            <?php else: ?>
                                <?php echo $key; ?>: new google.maps.Point(<?php echo $value; ?>, <?php echo $value; ?>),
                            <?php endif; ?>
                        <?php break; ?>;

                        <?php case ('fillOpacity'): ?>
                        <?php case ('rotation'): ?>
                        <?php case ('scale'): ?>
                        <?php case ('strokeOpacity'): ?>
                        <?php case ('strokeWeight'): ?>
                            <?php echo $key; ?>: <?php echo json_encode((int) $value); ?>,
                        <?php break; ?>

                        <?php default: ?>
                            <?php echo $key; ?>: <?php echo json_encode((string) $value); ?>,
                        <?php break; ?>

                    <?php endswitch; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            }
        <?php else: ?>
            <?php echo json_encode((string) $options['icon']); ?>

        <?php endif; ?>
    <?php endif; ?>
});

bounds.extend(marker_<?php echo $id; ?>.position);

marker_<?php echo $id; ?>.setMap(<?php echo $options['map']; ?>);
markers.push(marker_<?php echo $id; ?>);

<?php if($options['place']): ?>

        marker_<?php echo $id; ?>.addListener('click', function() {
            infowindow.setContent('<a href="' + placeResult.website + '">' + placeResult.name + '</a>');
            infowindow.open(<?php echo $options['map']; ?>, this);
        });
    });

<?php else: ?>

    <?php if(!empty($options['content'])): ?>

        var infowindow_<?php echo $id; ?> = new google.maps.InfoWindow({
            content: <?php echo json_encode((string) $options['content']); ?>

        });

        <?php if(isset($options['maxWidth'])): ?>

            infowindow_<?php echo $id; ?>.setOptions({ maxWidth: <?php echo $options['maxWidth']; ?> });

        <?php endif; ?>

        <?php if(isset($options['open']) && $options['open']): ?>

            infowindow_<?php echo $id; ?>.open(<?php echo $options['map']; ?>, marker_<?php echo $id; ?>);

        <?php endif; ?>

        google.maps.event.addListener(marker_<?php echo $id; ?>, 'click', function() {

            <?php if(isset($options['autoClose']) && $options['autoClose']): ?>

                for (var i = 0; i < infowindows.length; i++) {
                    infowindows[i].close();
                }

            <?php endif; ?>

            infowindow_<?php echo $id; ?>.open(<?php echo $options['map']; ?>, marker_<?php echo $id; ?>);
        });

        infowindows.push(infowindow_<?php echo $id; ?>);

    <?php endif; ?>

<?php endif; ?>

<?php $__currentLoopData = ['eventClick', 'eventDblClick', 'eventRightClick', 'eventMouseOver', 'eventMouseDown', 'eventMouseUp', 'eventMouseOut', 'eventDrag', 'eventDragStart', 'eventDragEnd', 'eventDomReady']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

    <?php if(isset($options[$event])): ?>

        google.maps.event.addListener(marker_<?php echo $id; ?>, '<?php echo str_replace('event', '', strtolower($event)); ?>', function (event) {
            <?php echo $options[$event]; ?>

        });

    <?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /Users/wbr/Sites/wbr_backend/resources/views/cornford/googlmapper/marker.blade.php ENDPATH**/ ?>