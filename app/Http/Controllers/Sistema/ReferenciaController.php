<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Referencia;
use \Illuminate\Database\QueryException;

class ReferenciaController extends Controller
{
    
    public function index()
    {
        $referencias = Referencia::where('user_id', \Auth::user()->id)
                        ->orderBy('ano', 'desc')
                        ->orderBy('mes', 'desc')
                        ->get();
        
        return view('sistema.referencia.index', compact('referencias'));
    }
    
    public function adicionar(Request $request)
    {
        if(!$request->has('_token'))
        {
            return view('sistema.referencia.adicionar');
        }
        
        $this->validate($request, [
            'mes' => 'required|integer|between:1,12',
            'ano' => 'required|integer|between:1900,2100',
        ]);
        
        $dados = $request->except('_token');
        $dados['user_id'] = \Auth::user()->id;
        
        try {
            Referencia::create($dados);
            
            return redirect()->route('sistema.referencia.index')->with(swal('Ops', 'sucesso', 'success'));
        }
        catch(\Exception $e) {
            if ($e instanceof QueryException) {
                return redirect()->route('sistema.referencia.index')->withErrors(['A referência ja está cadastrada!']);
            }
            else {
                return redirect()->back()->with(swal('Ops', 'Houve um erro inesperado!', 'warning'));
            } 
        }
    }
    
    public function alterar(Request $request, Referencia $referencia)
    {
        if($referencia->user_id != \Auth::user()->id) {
            return redirect()->back()->withErrors('Referência não encontrada');
        }
        
        if(!$request->has('_token')) {
            return view('sistema.referencia.alterar', compact('referencia'));
        }
        
        $this->validate($request, [
            'mes' => 'required|integer|between:1,12',
            'ano' => 'required|integer|between:1900,2100',
        ]);
        
        $dados = $request->except('_token');
        
        try {
            $referencia->update($dados);
            
            return redirect()->route('sistema.referencia.index')->with(swal('Ops', 'sucesso', 'success'));
        }
        catch(\Exception $e) {
            if ($e instanceof QueryException) {
                return redirect()->route('sistema.referencia.index')->withErrors(['A referência ja está cadastrada!']);
            }
            else {
                return redirect()->back()->with(swal('Ops', 'Houve um erro inesperado!', 'warning'));
            }
            
        }
    }

    public function excluir(Referencia $referencia)
    {
        if($referencia->user_id != \Auth::user()->id) {
            return redirect()->back()->withErrors('Referência não existe');
        }

        $referencia->delete();

        return redirect()->route('sistema.referencia.index');
    }
    
}
