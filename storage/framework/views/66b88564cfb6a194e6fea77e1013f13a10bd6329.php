<?php $__env->startSection('title','Vehicletype'); ?>

<?php $__env->startSection('content'); ?>

<section class="section">
    <?php if(Session::has('msg')): ?>
    <?php echo $__env->make('layouts.msg', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <div class="section-header">
        <h1><?php echo e(__('vehicletypes')); ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo e(url('admin/home')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
            <div class="breadcrumb-item"><?php echo e(__('Vehicletype')); ?></div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title"><?php echo e(__('Vehicletype menu')); ?></h2>
        <p class="section-lead"><?php echo e(__('Add, Edit, Manage Vehicletype')); ?></p>
        <div class="card">
            <div class="card-header">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vehicletype_add')): ?>
                <div class="w-100">
                    <a href="<?php echo e(url('admin/vehicletype/create')); ?>"
                        class="btn btn-primary float-right"><?php echo e(__('add new')); ?></a>
                </div>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <table id="datatable" class="table table-striped table-bordered text-center" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>
                                <input name="select_all" value="1" id="master" type="checkbox" />
                                <label for="master"></label>
                            </th>
                            <th>#</th>
                            <th><?php echo e(__('Image')); ?></th>
                            <th><?php echo e(__('Vehicletype name')); ?></th>
                            <th><?php echo e(__('Enable')); ?></th>
                            <?php if(Gate::check('vehicletype_edit')): ?>
                            <th><?php echo e(__('Action')); ?></th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $vehicletypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicletype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>
                                <input name="id[]" value="<?php echo e($vehicletype->id); ?>" id="<?php echo e($vehicletype->id); ?>"
                                    data-id="<?php echo e($vehicletype->id); ?>" class="sub_chk" type="checkbox" />
                                <label for="<?php echo e($vehicletype->id); ?>"></label>
                            </td>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td>
                                <img src="<?php echo e($vehicletype->image); ?>" class="rounded" width="50" height="50" alt="">
                            </td>
                            <td><?php echo e($vehicletype->name); ?></td>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" name="status"
                                        onclick="change_status('admin/vehicletype',<?php echo e($vehicletype->id); ?>)"
                                        <?php echo e(($vehicletype->status == 1) ? 'checked' : ''); ?>>
                                    <div class="slider"></div>
                                </label>
                            </td>
                            <?php if(Gate::check('vehicletype_edit')): ?>
                            <td>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vehicletype_edit')): ?>
                                <a href="<?php echo e(url('admin/vehicletype/'.$vehicletype->id.'/edit')); ?>"
                                    class="btn btn-primary btn-action mr-1"><i class="fas fa-pencil-alt"></i></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('vehicletype_delete')): ?>
                                <a href="javascript:void(0);" class="table-action ml-2 btn btn-danger btn-action"
                                    onclick="deleteData('admin/vehicletype',<?php echo e($vehicletype->id); ?>,'Vehicletype')">
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
                <input type="button" value="Delete selected"
                    onclick="deleteAll('vehicletype_multi_delete','Vehicletype')" class="btn btn-primary">
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app',['activePage' => 'vehicletype'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/wbr/Sites/wbr_backend/resources/views/admin/vehicletype/vehicletype.blade.php ENDPATH**/ ?>