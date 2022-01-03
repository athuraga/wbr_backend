<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <script type="text/javascript">
        window.onload = () => {
            $(".main-sidebar").niceScroll();
        }
    </script>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(__('Admin dashboard')); ?></h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card card-primary rounded-lg">
                        <div class="card-header">
                            <h5><?php echo e(__('Day to Day Ride Management Records')); ?></h5>
                        </div>
                        <div class="card-body">
                            <h3><?php echo e($today_orders); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-primary rounded-lg">
                        <div class="card-header">
                            <h5><?php echo e(__("Today's earning")); ?></h5>
                        </div>
                        <div class="card-body">
                            <h3><?php echo e($currency); ?><?php echo e($today_earnings); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-primary rounded-lg">
                        <div class="card-header">
                            <h5><?php echo e(__('Total rides')); ?></h5>
                        </div>
                        <div class="card-body">
                            <h3><?php echo e($total_orders); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card card-primary rounded-lg">
                        <div class="card-header">
                            <h5><?php echo e(__('Total earning')); ?></h5>
                        </div>
                        <div class="card-body">
                            <h3><?php echo e($currency); ?><?php echo e($total_earnings); ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title"><?php echo e(__('Vehicles List')); ?></h2>
                <div class="card">
                    <div class="card-body table-responsive">
                        <table id="datatable" class="table table-striped table-bordered text-center" cellspacing="0"
                            width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Vehicle Identification Number')); ?></th>
                                    <th><?php echo e(__('Lat')); ?></th>
                                    <th><?php echo e(__('Lon')); ?></th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>

                                        <td><?php echo e($vehicle->license_number); ?></td>
                                        <td><?php echo e($vehicle->lat); ?></td>
                                        <td><?php echo e($vehicle->lang); ?></td>

                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="flex-center position-ref full-height">
                        <div class="content">
                            <h2>Vehicles Live Location</h2>
                            <div id="vlocations" data-field-id="<?php echo e($vehicles); ?>">
                            </div>
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
                                <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC2wDZend4lfhVc4oXgnWR-r3-xXe0UFxM&sensor=false"></script>
                                <script>
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
                                                    icon: '/images/wbrclipartblack.png'
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
                                            var vlocations = <?php echo json_encode($vehicles); ?>;


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
                                </script>

                                <div id='location-canvas' style='width:100%;height:500px;'>
                                </div>
                            </head>

                            </html>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-6 col-md-12 col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="text-dark w-50"><?php echo e(__('Growth & progress')); ?></h4>
                            <div class="w-50 text-right">
                                <input type="text" name="filter_date_range" class="form-control">
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="home-tab3" data-toggle="tab" href="#home3"
                                        role="tab" aria-controls="home" aria-selected="false"><?php echo e(__('rides')); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3"
                                        role="tab" aria-controls="profile" aria-selected="true"><?php echo e(__('earnings')); ?></a>
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
                            <h4><?php echo e(__('Avarage Usage Time of vehicle')); ?></h4>
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
                            <h4><?php echo e(__('Top Cities Avg. Rides/Day')); ?></h4>
                        </div>
                        <div class="card-body">
                            <?php $__currentLoopData = $topItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="tickets-list">
                                    <a class="ticket-item">
                                        <div class="ticket-title text-muted">
                                            <h4><?php echo e($topItem->itemName); ?></h4>
                                        </div>
                                        <div class="ticket-info">
                                            <div><?php echo e($topItem->total); ?><?php echo e(' time served'); ?></div>
                                            <div class="w-100">
                                                <?php if($topItem->type == 'scooter'): ?>
                                                    <img src="<?php echo e(url('images/scooter.png')); ?>" class="float-right"
                                                        alt="">
                                                <?php else: ?>
                                                    <img src="<?php echo e(url('images/bike.png')); ?>" class="float-right"
                                                        alt="">
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app',['activePage' => 'home'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/wbr/Sites/wbr_backend/resources/views/admin/home.blade.php ENDPATH**/ ?>