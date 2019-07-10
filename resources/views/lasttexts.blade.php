	<br>
	<b>Доступные тексты:</b>
	<div class="itemsblock">
		<?php
		foreach ($pasta_res as $p) {
			$dtexp = new DateTime($p->dtexp);
			if (date_format($dtexp, "Y") > 3000) {
				$dtexp = 'без ограничения';
			} else {
				$dtexp = date_format($dtexp, "d.m.Y H:i:s");
			}
		?>
		<div class="item">
			<b><?=$p->title?></b><br>
			<a href="/<?=$p->link?>"><?=Request::url() . '/' . $p->link?></a><br>
			<i class="green">Добавлен:  <?=date_format(new DateTime($p->dtadd), "d.m.Y H:i:s")?></i>&nbsp;
			<i class="red">Доступен до:  <?=$dtexp?></i>&nbsp;
		</div>
		<?php
		} 
		?>
	</div>