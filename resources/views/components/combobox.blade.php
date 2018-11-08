<div class="form-group {{$classes ?? null}}">
	<label for="{{$id}}">{{$descricao}}</label>
	<select name="{{$id}}" id="{{$id}}" class="form-control" {{$required ?? null}}>
		@if(isset($nullable))
			@if($nullable)
				<option></option>
			@endif
		@endif
		
		@foreach($dados as $key => $text)
			@if(isset($valor))
				@if($valor == $key)
					<option value="{{$key}}" selected>{{$text}}</option>
				@else
					<option value="{{$key}}">{{$text}}</option>
				@endif
			@else 
				<option value="{{$key}}">{{$text}}</option>
			@endif
		@endforeach
	</select>
</div>
