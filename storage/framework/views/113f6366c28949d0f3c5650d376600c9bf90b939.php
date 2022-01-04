<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link rel="stylesheet" href='<?php echo e(mix('/css/app.css')); ?>'>
    <link rel="stylesheet" href='<?php echo e(asset('/css/event.css')); ?>'>
     <!--<link rel="stylesheet" href='css/w3-fix.css'> -->
</head>

<body id="<?php echo $__env->yieldContent('body_id'); ?>" class="pb-2">
    <header class="navbar navbar-light bg-light fixed-top shadow cust-header">
        <div class="container-fluid">
            <?php echo $__env->yieldContent('navbar'); ?>
        </div>
    </header>
    <main class="container mt-lg-5 mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <?php echo $__env->yieldContent('contents'); ?>
            </div>
        </div>
    </main>

    <script src='<?php echo e(mix('/js/app.js')); ?>'></script>
    <script src='<?php echo e(asset('js/jquery.min.js')); ?>'></script>
    <script src='<?php echo e(asset('js/script.js')); ?>'></script>
    <?php echo $__env->yieldContent('script'); ?>

</body>

</html><?php /**PATH E:\crowdworks\ymuntae\emergency_information-main\resources\views/layouts/base.blade.php ENDPATH**/ ?>