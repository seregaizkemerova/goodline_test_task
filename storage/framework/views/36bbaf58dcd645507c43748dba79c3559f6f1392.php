
    
  
<?php $__env->startSection('content'); ?>
<div class="container">


	<?php echo $__env->make('partitial.addform', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	
	<br>
	
	<?php echo $__env->make('partitial.lasttexts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/goodline/goodline_testtask/resources/views/index.blade.php ENDPATH**/ ?>