@include('head')
    
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
    	
    	@include('lasttexts')
    	
    <?php endif;?>
    </div>
    
    </body>
</html>