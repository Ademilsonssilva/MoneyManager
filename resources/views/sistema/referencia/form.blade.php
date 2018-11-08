
<div class="col-xs-6 col-sm-3">
	@component('components.combobox', [
		'id' => 'mes',
		'descricao' => 'Mes de referência',
		'dados' => arrMesesCombobox(),
		'valor' => isset($referencia) ? $referencia->mes : null, 
	]) @endcomponent
</div>

<div class="col-xs-6 col-sm-3">
	@component('components.form_text_input', [
		'id' => 'ano',
		'descricao' => 'Ano de referência',
		'required' => 'required',
	]) 
		{{ isset($referencia) ? $referencia->ano : null }}
	@endcomponent
</div>    			

<div class="col-xs-12 col-sm-6">
	@component('components.form_text_input', [
		'id' => 'observacao',
		'descricao' => 'Observações',
	]) 
		{{ isset($referencia) ? $referencia->observacao : null }}
	@endcomponent
</div>