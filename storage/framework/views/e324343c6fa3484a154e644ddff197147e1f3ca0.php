<?php echo $__env->make('head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
    <div class="container">
    	<a href="/">добавить новый текст</a>
    	
    	<br><br>
    <?php if (!empty($notext)):?>
    	<b>Данного текста не существует или время его показа истекло.</b>
    <?php else: ?>
    	<b><?=$text->title?></b>
    	<br>
    	<div class="text"><?=htmlspecialchars($text->body)?></div>
    	
    	<div class="otherinfo">
    		<b>Ссылка</b> - <?=Request::url()?><br><br>
    		<b>Добавлен</b> - <?=$text->dtadd?><br><br>
    		<b>Доступен</b> - <?=$text->access?><br><br>
    		<b>Показывается до</b> - <?=$text->dtexp?>
    	</div>
    	
    	<?php echo $__env->make('lasttexts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    	
    <?php endif;?>
    </div>
    
    </body>
</html><?php /**PATH /var/www/html/goodline/goodline_testtask/resources/views/text.blade.php ENDPATH**/ ?>