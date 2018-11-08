@extends('sistema.base.sistema')

@section('content')
	<div class="container">
    	<div class="panel">
			<div class="panel-heading">
                Items da referência {{$referencia->ref_ext}}
			</div>
			<div class="panel-body">
				<div>
					<table class="table table-striped table-hover">
						<thead>
							<th>Data</th>
							<th>Valor</th>
							<th>Tipo</th>
							<th>Ações</th>							
						</thead>
						
						<tbody>
                            @if(sizeof($itens_referencia) > 0)
    							@foreach($itens_referencia as $item)
    								<tr>
										<td>{{$item->data->format('d/m/Y')}}</td>
										<td class="valor_formatado">{{$item->valor}}</td>
                                        <td>{{$item->tipo_evento_text}}</td>
										<td>

                                            @component('components.btn_alterar')
												{{route('sistema.item_referencia.alterar', [$referencia->id, $item->id])}}
                                            @endcomponent
											
											@component('components.btn_excluir', ['slot' => [$referencia->id, $item->id]])@endcomponent

										</td>
									</tr>
    							@endforeach
    						@else
    							<tr><td colspan="6"><i>Nenhuma informação encontrada!</i></td></tr>
    						@endif
						</tbody>
						<tfoot>
							<tr>
								<td colspan="6">
    								<div class="visible-md visible-lg">
    									<div class="col-sm-4">
    										<span class="hidden-sm"><a href="{{route('sistema.item_referencia.adicionar', $referencia->id)}}" class="btn btn-primary btn-sm">Nova</a></span>
    									</div>
    								</div>
    								<div class="row">
    									<div class="visible-xs visible-sm">
            								<div class="col-xs-6 col-xs-offset-3 form-group">
            									<select id="acoes" class="form-control">
            										<option></option>
            										<option value="adicionar">Adicionar</option>
            									</select>
            								</div>
            							</div>
            						</div>
								</td>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>    	
    	</div>
	</div>	
@endsection

@section('js')
	<script>
		$('#acoes').on('change', function () {
			if($(this).val() == 'adicionar') {
				window.location.href = "{{route('sistema.item_referencia.adicionar', $referencia->id)}}";
			}
		});
	</script>
@endsection