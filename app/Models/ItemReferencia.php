<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Evento;

class ItemReferencia extends Model
{
    use LogsActivity;

    public $table = 'item_referencia';

    public $fillable = [
        'descricao', 'data', 'tipo_evento', 'valor', 'observacao', 'referencia_id', 'evento_id',
    ];

    public static $logAttributes = [
        'descricao', 'data', 'tipo_evento', 'valor', 'observacao', 'referencia_id', 'evento_id', 
    ];

    public $dates = ['created_at', 'updated_at', 'data'];

    const TIPOS_EVENTO = [
        'credito' => 'Crédito',
        'debito' => 'Débito',
    ];

    public function getTipoEventoTextAttribute()
    {
        return self::TIPOS_EVENTO[$this->tipo_evento];
    }

    public function evento()
    {
        return $this->belongsTo(Evento::class);
    }

    public function getDiaAttribute()
    {
        return $this->data->format('d');
    }

}
