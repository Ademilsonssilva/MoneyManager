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

            if(isset($dadosEvento)) {
                $evento = Evento::create($dadosEvento);
            }
            else {
                $evento = Evento::find($request->input('evento_id'));
            }

            $dados['evento_id'] = $evento->id;

            $itemRef = ItemReferencia::create($dados);

            $referencia->calculaValores();

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

        if($item_referencia->referencia->user_id != $referencia->id){
            return redirect()->back()->withErrors('Referência não encontrada!');
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

            if(isset($dadosEvento)) {
                $evento = Evento::create($dadosEvento);
            }
            else {
                $evento = Evento::find($request->input('evento_id'));
            }

            $dados['evento_id'] = $evento->id;

            $itemRef = $item_referencia->update($dados);

            $referencia->calculaValores();

        }
        catch(Exception $e) {
            return redirect()->back()->withErrors('Ocorreu um erro inesperado!');
        }
        \DB::commit();

        return redirect()->route('sistema.item_referencia.index', $referencia->id);

    }

    public function excluir(Referencia $referencia, ItemReferencia $item_referencia)
    {
        if($item_referencia->referencia->user_id != \Auth::user()->id){
            return redirect()->back()->withErrors('Item da referência não encontrado!');
        }

        \DB::beginTransaction();

            $item_referencia->delete();

            $referencia->calculaValores();

        \DB::commit();

        return redirect()->route('sistema.item_referencia.index', $referencia->id);
    }
}
