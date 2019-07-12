
    

<?php $__env->startSection('content'); ?>
        
    <div class="container">
    <?php if (!empty($notext)):?>
    	<b>Данного текста не существует или время его показа истекло.</b>
    <?php else: ?>
    	<h2><?=$text->title?></h2>
    	<br>
    	
    	<pre><code<?php if ($text->lang != 'auto') echo ' class="' . $text->lang . '"';?>><?=htmlentities($text->body)?></code></pre>
    	
    	<script type="text/javascript">hljs.initHighlightingOnLoad();</script>
    	
    	<?php 
    	/*<div class="text"><?=htmlspecialchars($text->body)?></div>*/
    	?>
    	
    	<div class="otherinfo">
    		<b>Ссылка</b> - <?=Request::url()?><br><br>
    		<b>Добавлен</b> - <?=$text->dtadd?><br><br>
    		<b>Доступен</b> - <?=$text->access?><br><br>
    		<b>Показывается до</b> - <?=$text->dtexp?>
    	</div>
    	
    	<?php echo $__env->make('partitial.lasttexts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    	
    <?php endif;?>
    </div>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/goodline/goodline_testtask/resources/views/text.blade.php ENDPATH**/ ?>