        <search>
        	<div class="searchblock">
        	<form action="/search/" method="GET">
        	<div class="row">
        		<div class="col-sm-9">
        			<input id="search" type="text" class="form-control @error('search') is-invalid @enderror" name="search" required autocomplete="search" autofocus placeholder="поиск..." value="<?php if (isset($search)) echo $search; ?>">
                                @error('search')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    &nbsp;
                </div>
                <div class="col-sm-3">
                	@csrf
                    <input type="submit" value="найти" class="btn btn-success">
        		</div>
        		<div class="col-sm-12">
        			<input type="radio" name="searchtype" value="1" <?php if (isset($searchtype) && $searchtype == 1) echo ' checked'?>>&nbsp; в заголовке и тексте
        			&nbsp;&nbsp;&nbsp;
        			<input type="radio" name="searchtype" value="2" <?php if (isset($searchtype) && $searchtype == 2) echo ' checked'?>>&nbsp; только в заголовке
        			&nbsp;&nbsp;&nbsp;
        			<input type="radio" name="searchtype" value="3" <?php if (isset($searchtype) && $searchtype == 3) echo ' checked'?>>&nbsp; только в тексте
        		</div>
        	</div>
        	</form>
        	</div>
        </search>