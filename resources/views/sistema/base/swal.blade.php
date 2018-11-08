@if(isset($swal_message))
	<script>

		swal("{{$swal_message['titulo']}}", "{{$swal_message['mensagem']}}", "{{$swal_message['tipo']}}");

	</script>
@endif