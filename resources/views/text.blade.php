@extends('layouts.app')
    

@section('content')
        
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
    	
    	@include('partitial.lasttexts')
    	
    <?php endif;?>
    </div>
    
@endsection