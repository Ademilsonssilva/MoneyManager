<label for="{{$id}}">{{$descricao}}</label>
<textarea class="form-control" name="{{$id}}" id="{{$id}}" placeholder="{{$descricao}}" rows="{{$rows ?? 3}}" {{$required ?? null}}>{{$slot}}</textarea>