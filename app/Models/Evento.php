<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Evento;

class Evento extends Model
{
    public $table = 'evento';

    public $fillable = ['descricao', 'tipo_evento', 'user_id'];

    const TIPOS_EVENTO = [
        'credito' => 'Crédito',
        'debito' => 'Débito',
    ];

    public static function getTodosEventosArr($eventoNovo = false)
    {
        $evento = Evento::where('user_id', \Auth::user()->id)->orderBy('descricao')->pluck('descricao', 'id')->toArray();


        if($eventoNovo) {
            $evento['novo'] = 'Novo';
        }

        return $evento;
    }



}
