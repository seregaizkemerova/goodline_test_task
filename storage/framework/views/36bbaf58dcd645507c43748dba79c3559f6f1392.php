<?php echo $__env->make('head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    
<script type="text/javascript">
function SendForm() {
	_title = document.getElementById('title').value;
	_body  = document.getElementById('body').value; 

	if (_title != '' && _body != '') {
    	return true;
    } else {
        if (_title == '') {
    		alert('Вы не ввели заголовок');
    		return false;
        }

        if (_body == '') {
    		alert('Вы не ввели текст');
    		return false;
        }
    }
}
</script>
    
    
<div class="container">
    
	<form action="/add" method="POST" onsubmit="return SendForm();">
	
		<b>Добавить новый текст:</b>
    	<div>
    		<input type="text" name="title" placeholder="Заголовок" class="input" id="title">
    	</div>
    	<br>
    	<div>
    		<textarea name="body" rows="20" placeholder="Текст" class="input" id="body"></textarea>
    	</div>
    	<br>
    	<div>
    		показывать:&nbsp;
    		<select name="exp" class="select">
    			<option value="PT10M"> 10 минут</option>
    			<option value="PT1H">  1 час</option>
    			<option value="PT3H">  3 часа</option>
    			<option value="P1D">   1 день</option>
    			<option value="P1W">   1 неделя</option>
    			<option value="P1M">   1 месяц</option>
    			<option value="P1000Y">без ограничения</option>
    		</select>
    		
    		&nbsp;&nbsp;
    		
    		доступ:
    		<select name="access" class="select">
    			<option value="public">  доступен всем, виден в списках</option>
    			<option value="unlisted">доступен только по ссылке</option>
    		</select>
    	</div>
    	<div class="submit">
    		<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
    		<input type="submit" value="добавить" class="button">
    	</div>
	</form>
	
	<br>
	
	<?php echo $__env->make('lasttexts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</div>
    
    
    
    
    </body>
</html><?php /**PATH /var/www/html/goodline/goodline_testtask/resources/views/index.blade.php ENDPATH**/ ?>