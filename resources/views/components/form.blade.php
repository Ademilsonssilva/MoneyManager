<form name="{{$name}}" action="{{$action}}" method="{{$method}}" class="form">

	@if(isset($token))
		
		@if($token)
			{{csrf_field()}}
		@endif
		
	@endif
	
	{{$slot}}

</form>