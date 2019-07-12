<script>
	function showHideAddText() {
		$("#addtext").toggle(300);
	}
</script>

	<div class="card">
		<div class="card-header"><a href="JavaScript: showHideAddText();">Добавить новый текст</a></div>
		
		<div class="card-body hidden" id="addtext">
			<form action="/add" method="POST">
        	<div class="form-group">
        		
        		<div>
        			<input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" required autocomplete="title" autofocus placeholder="Заголовок">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        		</div>
        		
        		<br>
        		
        		<div>
        			<textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body" required autocomplete="body" autofocus placeholder="Текст" rows="20"></textarea>
                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
        		</div>
        		
		    	<br>
		    	
		    	<div class="row">
		    	
		    		<div class="col-sm-12 col-md-4">
		    			<div class="strform">
				    		доступ:
				    		<select name="accesstext" class="select">
				    			<option value="public">  доступен всем, виден в списках</option>
				    			<option value="unlisted">доступен только по ссылке</option>
				    			<?php
				    			if (!empty(Auth::user() ) ) {
				    				echo '<option value="private">ТОЛЬКО АВТОРУ</option>';
				    			} 
				    			?>
				    		</select>
			    		</div>
		    		</div>
		    		
		    		<div class="col-sm-12 col-md-4">
				    	<div class="strform">
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
				    	</div>		    			
		    		</div>
		    		
		    		
		    		<div class="col-sm-12 col-md-4">
		    			<div class="strform">
				    		язык для подсветки:
				    		<select name="lang" class="select">
				    			<option value="auto">      автоматически</option>
				    			<option value="php">       PHP</option>
				    			<option value="javascript">JavaScript</option>
				    			<option value="xml">       HTML</option>
				    			<option value="apache">    Apache</option>
				    			<option value="cpp">       C++</option>
				    			<option value="cs">        C#</option>
				    			<option value="css">       CSS</option>
				    			<option value="java">      Java</option>
				    			<option value="perl">      Perl</option>
				    			<option value="python">    Python</option>
				    			<option value="sql">       SQL</option>
				    		</select>
			    		</div>
		    		</div>
		    		
		    	</div>
		    	
		    	<div class="submit">
		    		@csrf
		    		<input type="submit" value="добавить" class="btn btn-primary">
		    	</div>
        		
        	</div>
        	</form>
        </div>
        
    </div>