<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Evento;

class EventoController extends Controller
{
    function getTipo(Request $request)
    {
        $evento = Evento::find($request->input('evento_id'));

        if($evento != null) {
            echo $evento->tipo_evento;
        }
    
    }
}
