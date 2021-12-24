<?php $__env->startSection('title','License Setting'); ?>

<?php $__env->startSection('setting'); ?>
<section class="section">
    <?php if(Session::has('msg')): ?>
        <?php echo $__env->make('layouts.msg', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>
    <div class="section-header">
        <h1><?php echo e(__('License settings')); ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo e(url('admin/home')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
            <div class="breadcrumb-item active"><a href="<?php echo e(url('admin/setting')); ?>"><?php echo e(__('Setting')); ?></a></div>
            <div class="breadcrumb-item"><?php echo e(__('License setting')); ?></div>
        </div>
    </div>
    <div class="section-body">
        <h2 class="section-title"><?php echo e(__('License Setting')); ?></h2>
        <p class="section-lead"><?php echo e(__('License setting')); ?></p>
        <?php if(session::has('error_msg')): ?>
            <div class="alert alert-danger alert-dismissible fade show message_alert error_alert" role="alert">
                <?php echo e(session::get('error_msg')); ?> <br>
            </div>
        <?php endif; ?>
        <form action="<?php echo e(url('admin/update_license')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="card p-2">
                <div class="card-body">
                    <h5 class="mt-3"><?php echo e(__('License setting')); ?></h5>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="licensecode"><?php echo e(__('License Code')); ?></label>
                            <input type="text" required name="license_code" class="form-control" value="<?php echo e($general_setting->license_code); ?>" <?php echo e($general_setting->license_verify == 1 ? 'disabled' : ''); ?> style="text-transform: none;">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="client_name"><?php echo e(__('License client name')); ?></label>
                            <input type="text" required name="client_name" class="form-control" value="<?php echo e($general_setting->client_name); ?>" <?php echo e($general_setting->license_verify == 1 ? 'disabled' : ''); ?> style="text-transform: none;">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12 text-center">
                            <input type="submit" value="<?php echo e(__('Update')); ?>" <?php echo e($general_setting->license_verify == 1 ? 'disabled' : ''); ?> class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app',['activePage' => 'setting'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/wbr/Sites/wbr_backend/resources/views/admin/setting/license_setting.blade.php ENDPATH**/ ?>