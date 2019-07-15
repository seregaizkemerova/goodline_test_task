@extends('layouts.app')
    
  
@section('content')
<div class="container">
	@include('partitial.searchform')

	<h3>Результыта поиска:</h3>
	<div class="itemsblock">
	<?php
	if (!empty($pasta_res) ) {
		foreach ($pasta_res as $p) {
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
		<?php
		}
		echo $pasta_res->render();
	} else {
		echo '<b>по вашему запросу ничего не найдено</b>';
	}
	?>
	</div>
</div>
@endsection