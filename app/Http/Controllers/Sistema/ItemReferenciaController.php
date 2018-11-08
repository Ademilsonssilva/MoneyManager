<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Referencia;
use App\Models\ItemReferencia;
use App\Models\Evento;

use \Carbon\Carbon;

class ItemReferenciaController extends Controller
{
    public function index(Referencia $referencia)
    {
        if($referencia->user_id != \Auth::user()->id) {
            return redirect()->back()->withErrors('Referência não encontrada!');
        }

        $itens_referencia = ItemReferencia::where('referencia_id', $referencia->id)->orderBy('data', 'desc')->get();

        return view('sistema.item_referencia.index', compact('referencia', 'itens_referencia'));
    }

    public function adicionar(Request $request, Referencia $referencia)
    {

        if(!$request->has('_token')){

            return view('sistema.item_referencia.adicionar', compact('referencia'));

        }

        $this->validate($request, [
            'descricao' => 'required',
            'dia' => 'required|between:1,31',
            'valor' => 'required|numeric',
            'tipo_evento' => 'required|in:credito,debito'
        ]);

        if($request->input('evento_id') == 'novo') {
            $this->validate($request, ['evento' => 'required']);

            $dadosEvento['descricao'] = $request->input('evento');
            $dadosEvento['user_id'] = \Auth::user()->id;
            $dadosEvento['tipo_evento'] = $request->input('tipo_evento');
        }

        $data = $referencia->ano . '-' . $referencia->mes . '-' . $request->input('dia');

        try {
            $data_carbon = Carbon::parse($data);
        }
        catch(\Exception $e) {
            return redirect()->back()->withErrors('Data inválida!');
        }

        $dados = $request->except('_token');

        $dados['data'] = $data_carbon->format('Y-m-d');
        $dados['referencia_id'] = $referencia->id;

        \DB::beginTransaction();
        try{

            $evento = Evento::create($dadosEvento);

            $dados['evento_id'] = $evento->id;

            $itemRef = ItemReferencia::create($dados);

            $credito = $debito = $liquido = 0;
            foreach(ItemReferencia::where('referencia_id', $referencia->id)->get() as $item) {
                if($item->tipo_evento == 'credito') {
                    $credito += $item->valor;
                }
                else if($item->tipo_evento == 'debito') {
                    $debito += $item->valor;
                }
            }

            $liquido = $credito - $debito;

            $referencia->valor_credito = $credito;
            $referencia->valor_debito = $debito;
            $referencia->valor_liquido = $liquido;

            $referencia->save();

        }
        catch(Exception $e) {
            return redirect()->back()->withErrors('Ocorreu um erro inesperado!');
        }
        \DB::commit();

        return redirect()->route('sistema.item_referencia.index', $referencia->id);
    }

    public function alterar(Request $request, Referencia $referencia, ItemReferencia $item_referencia)
    {

        if(!$request->has('_token')) {
            return view('sistema.item_referencia.alterar', compact('referencia', 'item_referencia'));
        }



    }
}
