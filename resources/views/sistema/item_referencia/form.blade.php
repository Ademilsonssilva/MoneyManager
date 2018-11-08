<div class="col-xs-12 col-sm-6">
	@component('components.form_text_input', [
		'id' => 'descricao',
		'descricao' => 'Descrição',
		'required' => 'required',
	]) 
		{{isset($item_referencia) ? $item_referencia->descricao : null}}
	@endcomponent
</div>

<div class="col-xs-12 col-sm-6">
	@component('components.combobox', [
		'id' => 'evento_id',
		'descricao' => 'Evento',
		'nullable' => true,
		'dados' => \App\Models\Evento::getTodosEventosArr(true),
		'valor' => isset($referencia) ? $item_referencia->evento_id : null,
		'required' => 'required'
	]) @endcomponent
</div>

<div class="col-xs-12 col-sm-6" id="novo_evento_div" hidden>
	@component('components.form_text_input', [
		'id' => 'evento',
		'descricao' => 'Novo evento',
	]) @endcomponent
</div>

<div class="col-xs-6 col-sm-3">
	@component('components.form_text_input', [
		'id' => 'dia',
		'descricao' => 'Dia',
		'required' => 'required',
	]) 
		{{ isset($item_referencia) ? $item_referencia->dia : null }}
	@endcomponent
</div>    			


<div class="col-xs-6 col-sm-3">
	@component('components.combobox', [
		'id' => 'tipo_evento',
		'descricao' => 'Tipo de evento',
		'dados' => \App\Models\ItemReferencia::TIPOS_EVENTO,
		'valor' => isset($item_referencia) ? $item_referencia->tipo_evento : null, 
	]) @endcomponent
</div>

<div class="col-xs-12 col-sm-6">
	@component('components.form_text_input', [
		'id' => 'valor',
		'descricao' => 'Valor',
		'required' => 'required',
	]) 
		{{ isset($item_referencia) ? $item_referencia->valor : null }}
	@endcomponent
</div>

<div class="col-xs-12 col-sm-6">
	@component('components.textarea', [
		'id' => 'observacao',
		'descricao' => 'Observação',
	]) 
		{{ isset($item_referencia) ? $item_referencia->observacao : null }}
	@endcomponent
</div>
