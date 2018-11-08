<span>
    <a class="btn_excluir_component"> <i class="fas fa-trash"></i> </a>
    <form action="{{route('sistema.referencia.excluir', $slot)}}" method="POST" style="display: inline;">{{csrf_field()}}</form>
</span>    
