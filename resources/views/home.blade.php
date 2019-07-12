@extends('layouts.app')

@section('content')
<div class="container">
	
	@include('partitial.addform')
	
	<br>
	
	<h3>Ваши тексты:</h3>
	<div class="itemsblock">
	<?php
	if (!empty($pasta_pages) && count($pasta_pages) > 0) {  
		foreach ($pasta_pages as $p) {
		$dtexp = new DateTime($p->dtexp);
		if (date_format($dtexp, "Y") > 3000) {
			$dtexp = 'без ограничения';
		} else {
			$dtexp = date_format($dtexp, "d.m.Y H:i:s");
		}
			
		if ($p->access == 'private') {
			$acc = 'ТОЛЬКО АВТОРУ';
		} elseif ($p->access == 'public') {
			$acc = 'доступен всем, виден в списках';
		} else {
			$acc = 'доступен только по ссылке';
		}
	?>
		<div class="item">
			<b><?=$p->title?></b><br>
			<a href="/<?=$p->link?>"><?=Request::url() . '/' . $p->link?></a><br>
			<i class="green"><b>Добавлен:</b>  <?=date_format(new DateTime($p->dtadd), "d.m.Y H:i:s")?></i>&nbsp;
			<i class="red"><b>Срок доступа до:</b>  <?=$dtexp?></i>&nbsp;
			<i class="blue"><b>Доступ:</b>  <?=$acc?></i>&nbsp;
		</div>
    <?php } ?>
    </div>
    
    <?php echo $pasta_pages->render();
	} 
    ?>
	
</div>
@endsection
