<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Valoresrd;
use \App\Models\Tipo;
use \App\Models\Banco;


class DashboardController extends Controller
{
    static public function index(){

        $nomeBanco = Banco::all();
        $nomeTipo = Tipo::all();

        $valores = Valoresrd::with('tipos', 'bancos')->get();

        $valoresRD = Valoresrd::resumoTotal($valores);
        
        return view('pages.dashboard', ['nomeBanco' => $nomeBanco, 'nomeTipo' => $nomeTipo, 'valores' => $valores, 'total_receita' => $valoresRD[0], 'total_despesa' => $valoresRD[1], 'total_conta' => $valoresRD[2]]);
    }

    public function store(Request $request){

        $valores = new Valoresrd;
        // Fazer uma validação de dados    
        $this->validate($request, $valores->rules, $valores->message);

        $valores->valor = $request->valor;
        $valores->banco = $request->banco;
        $valores->tipo = $request->tipo;
        $valores->descricao = $request->descricao;
        $valores->data = $request->data;

        $valores->save();

        return redirect('/')->with('msg', ' Criado com Sucesso!');
    }
}
