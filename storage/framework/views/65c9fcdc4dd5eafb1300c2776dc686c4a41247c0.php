<?php $__env->startSection('title','Vehicle'); ?>

<?php $__env->startSection('content'); ?>

<section class="section">
    <div class="section-header">
        <h1><?php echo e(__('Vehicle')); ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo e(url('admin/home')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
            <div class="breadcrumb-item"><?php echo e(__('Vehicle')); ?></div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title"><?php echo e(__('Vehicle Management System')); ?></h2>
        <p class="section-lead"><?php echo e(__('Add, Edit, Manage Vehicles.')); ?></p>
        <div class="card">
            <div class="card-header">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_vehicle_add')): ?>
                    <div class="w-100">
                        <a href="<?php echo e(url('admin/vehicle/create')); ?>" class="btn btn-primary float-right"><?php echo e(__('Add New')); ?></a>
                    </div>
                <?php endif; ?>
            </div>
            <div class="card-body table-responsive">
                <table id="datatable" class="table table-striped table-bordered text-center" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>
                                <input name="select_all" value="1" id="master" type="checkbox" />
                                <label for="master"></label>
                            </th>
                            <th>#</th>
                            <th><?php echo e(__('vehicle profile')); ?></th>
                            <th><?php echo e(__('vehicle name')); ?></th>
                            <th><?php echo e(__('Location')); ?></th>
                            <th><?php echo e(__('Email')); ?></th>
                            <th><?php echo e(__('Enable')); ?></th>
                            <?php if(Gate::check('admin_vehicle_edit')): ?>
                                <th><?php echo e(__('Action')); ?></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $vehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <input name="id[]" value="<?php echo e($vehicle->id); ?>" id="<?php echo e($vehicle->id); ?>" data-id="<?php echo e($vehicle->id); ?>" class="sub_chk" type="checkbox" />
                                <label for="<?php echo e($vehicle->id); ?>"></label>
                            </td>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td>
                                <img src="<?php echo e($vehicle->image); ?>" width="50" height="50" class="rounded" alt="">
                            </td>
                            <th><?php echo e($vehicle->name); ?></th>
                            <td><?php echo e($vehicle->address); ?></td>
                            <td><?php echo e($vehicle->email_id); ?></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="status" onclick="change_status('admin/vehicle',<?php echo e($vehicle->id); ?>)" <?php echo e(($vehicle->status == 1) ? 'checked' : ''); ?>>
                                    <div class="slider"></div>
                                </label>
                            </td>

                            <?php if(Gate::check('admin_vehicle_edit')): ?>
                                <td class="d-flex justify-content-center">
                                    <a href="<?php echo e(url('admin/vehicle/'.$vehicle->id)); ?>" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="" data-original-title="<?php echo e(__('show vehicle')); ?>"><i class="fas fa-eye"></i></a>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_vehicle_edit')): ?>
                                        <a href="<?php echo e(url('admin/vehicle/'.$vehicle->id.'/edit')); ?>" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="" data-original-title="<?php echo e(__('Edit')); ?>"><i class="fas fa-pencil-alt"></i></a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin_vehicle_delete')): ?>
                                        <a href="javascript:void(0);" class="table-action btn btn-danger btn-action" onclick="deleteData('admin/vehicle',<?php echo e($vehicle->id); ?>,'Vehicle')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <input type="button" value="Delete selected" onclick="deleteAll('vehicle_multi_delete','Vehicle')" class="btn btn-primary">
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app',['activePage' => 'vehicle'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/wbr/Sites/wbr_backend/resources/views/admin/vehicle/vehicle.blade.php ENDPATH**/ ?>