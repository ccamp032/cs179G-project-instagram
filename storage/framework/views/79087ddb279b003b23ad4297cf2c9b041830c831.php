<?php $__env->startSection('content'); ?>
<div class="container" style="height: auto;">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          <h1 class="text-white text-center"><?php echo e(__('Welcome to Material Dashboard FREE Laravel Live Preview.')); ?></h1>
      </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'home', 'title' => __('Material Dashboard')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/Sites/instagram_179/instagram_179/resources/views/welcome.blade.php ENDPATH**/ ?>