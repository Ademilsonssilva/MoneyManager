<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Referencia extends Model
{
    use LogsActivity;
    
    public $table = 'referencia';
    
    public $fillable = [
        'id', 'mes', 'ano',
        'valor_credito', 'valor_debito', 'valor_liquido',
        'finalizado', 'data_finalizado', 'observacao', 'user_id',
    ];
    
    public static $logAttributes = [
        'id', 'mes_ref', 'ano_ref',
        'valor_credito', 'valor_debito', 'valor_liquido',
        'finalizado', 'data_finalizado', 'observacao', 'user_id',
    ];

    public function getMesExtAttribute()
    {
        return mesExtenso($this->mes);
    }

    public function getRefExtAttribute()
    {
        return $this->mes_ext . ' de ' . $this->ano;
    }
}
