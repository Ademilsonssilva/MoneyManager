<div class="panel {{$tipo_panel}}">

	<div class="panel-heading">
	
		{{ $panel_heading ?? null }}
		
	</div>
	
	<div class="panel-body">
	
    	{{ $slot }}
    	
	</div>
	
	<div class="panel-footer">
	
		{{ $panel_footer ?? null }}
		
	</div>
	

</div>