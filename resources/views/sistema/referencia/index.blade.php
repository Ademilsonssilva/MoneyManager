@extends('sistema.base.sistema')

@section('content')
	<div class="container">
    	<div class="panel">
			<div class="panel-heading">
				Referências
			</div>
			<div class="panel-body">
				<div>
					<table class="table table-striped table-hover">
						<thead>
							<th>Mes</th>
							<th>Ano</th>
							<th class="visible-md visible-lg">Valor recebido</th>
							<th class="visible-md visible-lg">Valor pago</th>
							<th>Valor liquido</th>							
							<th>Ações</th>							
						</thead>
						
						<tbody>
							@if(sizeof($referencias) > 0)
    							@foreach($referencias as $referencia)
    								<tr>
										<td>{{mesExtenso($referencia->mes)}}</td>
										<td>{{$referencia->ano}}</td>
										<td class="visible-md visible-lg"><span class="valor_formatado">{{$referencia->valor_credito ?? '0.00'}}</span></td>
										<td class="visible-md visible-lg"><span class="valor_formatado">{{$referencia->valor_debito ?? '0.00'}}</span></td>
										<td><span class="valor_formatado">{{$referencia->valor_liquido ?? '0.00'}}</span></td>
										<td>
											@component('components.btn_alterar')
												{{route('sistema.referencia.alterar', $referencia->id)}}
											@endcomponent
											
											@component('components.btn_excluir')
												{{route('sistema.referencia.excluir', $referencia->id)}}
											@endcomponent

											@component('components.btn_submenu', [
												'titulo' => 'Itens da referência'
											])
												{{route('sistema.item_referencia.index', $referencia->id)}}
											@endcomponent

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
    										<span class="hidden-sm"><a href="{{route('sistema.referencia.adicionar')}}" class="btn btn-primary btn-sm">Nova</a></span>
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
				window.location.href = "{{route('sistema.referencia.adicionar')}}";
			}
		});
	</script>
@endsection