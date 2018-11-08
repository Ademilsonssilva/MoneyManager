<div class="form-group {{$classes ?? null}} {{$hidden ?? null}}">
	<label for="{{$id}}">{{$descricao}}</label>
	<input type="text" name="{{$id}}" id="{{$id}}" placeholder="{{$descricao}}" value="{{$slot}}" class="form-control" {{$required ?? null}}/>
</div>