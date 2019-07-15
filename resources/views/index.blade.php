@extends('layouts.app')
    
  
@section('content')
<div class="container">

	@include('partitial.searchform')

	@include('partitial.addform')
	
	<br>
	
	@include('partitial.lasttexts')

</div>
@endsection