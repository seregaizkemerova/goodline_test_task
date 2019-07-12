	<br>
	<h3>Доступные тексты:</h3>
	<div class="itemsblock">
	<?php
	
	if (!empty($pasta_res) && count($pasta_res) > 0) {
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
	}

	if (!empty($pasta_users_res) && count($pasta_users_res) > 0) {
	?>
	<br>
	<h3>Ваши тексты:</h3>
	<div class="itemsblock">
	<?php
		foreach ($pasta_users_res as $p) {
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
	?>
	</div>
	<?php
	}
	?>
	</div>