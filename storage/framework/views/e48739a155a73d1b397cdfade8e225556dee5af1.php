<?php $__env->startSection('title','Genereal Setting'); ?>

<?php $__env->startSection('content'); ?>

<section class="section">
    <?php if(Session::has('msg')): ?>
        <?php echo $__env->make('layouts.msg', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php endif; ?>

    <div class="section-header">
        <h1><?php echo e(__('General Settings')); ?></h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo e(url('admin/home')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
            <div class="breadcrumb-item active"><a href="<?php echo e(url('admin/setting')); ?>"><?php echo e(__('Setting')); ?></a></div>
            <div class="breadcrumb-item"><?php echo e(__('general setting')); ?></div>
        </div>
    </div>
    <div class="section-body">
        <?php if($errors->any()): ?>
        <div class="alert alert-primary alert-dismissible show fade">
            <div class="alert-body">
                <button class="close" data-dismiss="alert">
                    <span>×</span>
                </button>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($item); ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        <?php endif; ?>
        <h2 class="section-title"><?php echo e(__('general setting')); ?></h2>
        <p class="section-lead"><?php echo e(__('Customise your General Settings')); ?></p>
        <div class="card p-2">
            <div class="card-body">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <form action="<?php echo e(url('admin/update_general_setting')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <h5 class="mt-3"><?php echo e(__('General setting')); ?></h5>
                            <hr>

                            <div class="row">
                                <div class="col-md-6 mb-5">
                                    <label for="Image"><?php echo e(__('Company black logo')); ?></label>
                                    <div class="logoContainer">
                                        <img id="licence_doc" src="<?php echo e($general_setting->blacklogo); ?>"  width="180" height="150">
                                    </div>
                                    <div class="fileContainer">
                                        <span><?php echo e(__('Image')); ?></span>
                                        <input type="file" name="company_black_logo" value="Choose File" id="previewlicence_doc" data-id="edit" accept=".png, .jpg, .jpeg, .svg">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="Image"><?php echo e(__('Company Favicon')); ?></label>
                                    <div class="logoContainer">
                                        <img id="imgFavicon" src="<?php echo e(url('images/upload/'.$general_setting->favicon)); ?>"  width="180" height="150">
                                    </div>
                                    <div class="fileContainer">
                                        <span><?php echo e(__('Image')); ?></span>
                                        <input type="file" name="favicon" value="Choose File" data-id="edit" id="previewFaviconImg" accept=".png, .jpg, .jpeg, .svg">
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="name"><?php echo e(__('business name')); ?></label>
                                    <input type="text" name="business_name" class="form-control" value="<?php echo e($general_setting->business_name); ?>" placeholder="<?php echo e(__('Business Name')); ?>">
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <label for="contact"><?php echo e(__('country')); ?></label>
                                    <select name="country" class="form-control select2">
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($country->name); ?>"
                                            <?php echo e($general_setting->country == $country->name ? 'selected' : ''); ?>>
                                            (+<?php echo e($country->phonecode); ?>)&nbsp;<?php echo e($country->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-12">
                                    <label for="timezone"><?php echo e(__('timezone')); ?></label>
                                    <select class="form-control select2" name="timezone">
                                        <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timezone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($timezone->TimeZone); ?>"
                                            <?php echo e($general_setting->timezone == $timezone->TimeZone ? 'selected' : ''); ?>>
                                            <?php echo e($timezone->UTC_DST_offset); ?>&nbsp;&nbsp;<?php echo e($timezone->TimeZone); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <label for="tax_id"><?php echo e(__('Currency')); ?></label>
                                    <select class="form-control select2 <?php $__errorArgs = ['currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        data-toggle="select" title="select currency" name="currency"
                                        data-placeholder="Select A Currency" id="currency">
                                        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($currency->code); ?>"
                                            <?php echo e($general_setting->currency == $currency->code ? 'selected' : ''); ?>>
                                            <?php echo e($currency->country); ?>&nbsp;&nbsp;(<?php echo e($currency->currency); ?>)&nbsp;&nbsp;(<?php echo e($currency->code); ?>)
                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="google key"><?php echo e(__('Google map key')); ?></label>
                                    <input type="text" name="map_key" class="form-control" value="<?php echo e($general_setting->map_key); ?>" style="text-transform: none;">
                                </div>
                            </div>

                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <label for=""><?php echo e(__('radius (How many kms of vehicle is shown in the app)')); ?></label>
                                    <input type="number" name="radius" class="form-control"
                                        value="<?php echo e($general_setting->radius); ?>">
                                </div>
                            </div>

                            <h5 class="mt-5"><?php echo e(__('bussiness hours time')); ?></h5>
                            <hr>
                            <div class="row mb-5">
                                <div class="col-md-6">
                                    <label for="start time"><?php echo e(__('start time')); ?></label>
                                    <input type="time" class="form-control" value="<?php echo e($general_setting->start_time); ?>" name="start_time">
                                </div>
                                <div class="col-md-6">
                                    <label for="end time"><?php echo e(__('end time')); ?></label>
                                    <input type="time" class="form-control" value="<?php echo e($general_setting->end_time); ?>" name="end_time">
                                </div>
                            </div>

                            <h5 class="mt-5"><?php echo e(__('bussiness Availability')); ?></h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="max_user"><?php echo e(__('Status')); ?></label><br>
                                    <label class="switch">
                                        <input type="checkbox" name="business_availability"
                                            <?php echo e($general_setting->business_availability == 1 ? 'checked' : ''); ?>>
                                        <div class="slider"></div>
                                    </label>
                                </div>
                                <div
                                    class="col-md-6 business_avai_msg <?php echo e($general_setting->business_availability == 1 ? 'hide' : ''); ?>">
                                    <label for="message"><?php echo e(__('Message')); ?></label>
                                    <textarea name="message" class="form-control"><?php echo e($general_setting->message); ?></textarea>
                                </div>
                            </div>

                            <h5 class="mt-5"><?php echo e(__('Tax')); ?></h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="max_user"><?php echo e(__('All items price included in tax')); ?></label><br>
                                    <label class="switch">
                                        <input type="checkbox" name="isItemTax"
                                            <?php echo e($general_setting->isItemTax == 1 ? 'checked' : ''); ?>>
                                        <div class="slider"></div>
                                    </label>
                                </div>
                                <div class="col-md-6 <?php echo e($general_setting->isItemTax == 1 ? 'hide' : ''); ?> txtItemTax">
                                    <label for="gstin"><?php echo e(__('GSTIN(%)')); ?></label>
                                    <input type="text" name="item_tax" value="<?php echo e($general_setting->item_tax); ?>" class="form-control">
                                </div>
                            </div>

                            <h5 class="mt-5"><?php echo e(__('Other')); ?></h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="max_user"><?php echo e(__('Takeaway feature')); ?></label><br>
                                    <label class="switch">
                                        <input type="checkbox" name="isPickup"
                                            <?php echo e($general_setting->isPickup == 1 ? 'checked' : ''); ?>>
                                        <div class="slider"></div>
                                    </label>
                                </div>
                            </div>
                            <h5 class="mt-5"><?php echo e(__('Site color changes')); ?></h5>
                            <hr>
                            <div class="form-group">
                                <label><?php echo e(__('Site color')); ?></label>
                                <input id="cp1" name="site_color" type="text" class="form-control"
                                    value="<?php echo e($general_setting->site_color); ?>" />
                            </div>

                            <div class="mt-5 text-center">
                                <button type="submit" class="btn btn-primary"><?php echo e(__('Update')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app',['activePage' => 'setting'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/wbr/Sites/wbr_backend/resources/views/admin/setting/general_setting.blade.php ENDPATH**/ ?>