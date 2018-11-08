@extends('sistema.base.sistema')


@section('content')
	
	@component('components.body_row')
	
		@component('components.form', [
			'name' => 'item_referencia',
			'action' => route('sistema.item_referencia.alterar', [$referencia->id, $item_referencia->id]),
			'method' => 'POST',
			'token' => true,
		])
	
        	@component('components.panel', ['tipo_panel' => 'panel-default'])
        
        		@slot('panel_heading')
        			Alterar item da referência {{$referencia->ref_ext}}
        		@endslot
        		
        		@include('sistema.item_referencia.form')
        		
        		@slot('panel_footer')
        			<div class="row">
            			<div class="col-xs-6 col-xs-offset-3 col-sm-4 col-sm-offset-4"  style="text-align: center;">
                			@component('components.button', [
                				'id' => 'btn_enviar',
                				'texto' => 'Salvar',
                				'classe' => 'btn-success',
                			]) @endcomponent
                		</div>
            		</div>
        		@endslot
        	
			@endcomponent			
        
    	@endcomponent
    @endcomponent

@endsection

@section('js')
	<script>
		$('#evento_id').on('change', function () {
			if($(this).val() == 'novo') {
				$('#novo_evento_div').show();
				$('#evento').attr('required', true);
			}
			else {
				$('#novo_evento_div').hide();
				$('#evento').attr('required', false);
				
				if($(this).val() != '') {
					$.ajax({
						url: "{{route('sistema.evento.get_tipo')}}",
						method: 'POST',
						data: {
							_token: '{{csrf_token()}}',
							evento_id: $('#evento_id').val(),
						},
						success: function (response) {
							$('#tipo_evento').val(response);
						}
					})
				}
			}
		});
	</script>
@endsection