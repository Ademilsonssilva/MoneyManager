<?php 

function mesExtenso($mes, $tipo = 'ext')
{
    return MESES[$mes][$tipo];
}

function arrMesesCombobox($tipo = 'ext')
{
    $novoArray = [];
    
    foreach(MESES as $key => $val){
        
        $novoArray[$key] = $val[$tipo];
        
    }
    
    return $novoArray;
}

function swal($titulo, $mensagem, $tipo)
{
    return ['swal_message' => compact('titulo', 'mensagem', 'tipo')];
}
?>