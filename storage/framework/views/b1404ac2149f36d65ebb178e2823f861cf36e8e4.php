<?php $__env->startSection('title', 'Livelocation'); ?>

<?php $__env->startSection('content'); ?>

    <section class="section">
        <div class="section-header">
            <h1><?php echo e(__('Livelocation')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(url('admin/home')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
                <div class="breadcrumb-item"><?php echo e(__('Livelocation')); ?></div>
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
                                <th><?php echo e(__('VIN')); ?></th>
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
                        <h2>Vehicles Live Location
                        </h2>
                        
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
                            
                            
                            

                            <div id='location-canvas' style='width:100%;height:500px;'> </div>

                            <script>
                                var vlocations = <?php echo json_encode($vehicles, 15, 512) ?>;
                            </script>
                        </head>

                        </html>
                    </div>

                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=<?php echo e(App\Models\GeneralSetting::first()->map_key); ?>&callback=initialize"
        defer></script>
    <script src="<?php echo e(asset('js/livloc.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app',['activePage' => 'livelocation'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/wbr/Sites/wbr_backend/resources/views/admin/livelocation/livelocation.blade.php ENDPATH**/ ?>