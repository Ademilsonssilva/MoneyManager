@extends('sistema.base.sistema')


@section('content')

    @component('components.body_row')
    
        @component('components.form', [
            'name' => 'folha',
            'action' => route('sistema.referencia.alterar', $referencia->id),
            'method' => 'POST',
            'token' => true,
        ])
        
        	@component('components.panel', ['tipo_panel' => 'panel-default'])
            
                @slot('panel_heading')
                	Alterar referência
                @endslot
                
                @include('sistema.referencia.form')
                
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

