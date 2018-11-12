<span>
    <a class="btn_excluir_component" style="cursor: pointer;"> <i class="fas fa-trash"></i> </a>
    <form action="{{$slot}}" method="POST" style="display: inline;">{{csrf_field()}}</form>
</span>    
