@extends('layouts.app')
    
  

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">Добавить новый текст</div>
		
		<div class="card-body">
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
		    		@csrf
		    		<input type="submit" value="добавить" class="btn btn-primary">
		    	</div>
        		
        	</div>
        	</form>
        </div>
    </div>
	
	<br>
	
	@include('lasttexts')

</div>
@endsection