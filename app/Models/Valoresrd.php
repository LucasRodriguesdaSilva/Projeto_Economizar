<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class Valoresrd extends Model
{
    use HasFactory;

    protected $fillable = [
        'valor',
        'descricao',
        'tipo',
        'banco',
        'data',
    ];

    public $rules = [
        'valor'     => 'required|numeric|max:99999',
        'descricao' => 'required|min:3|max:100',
        'tipo'      => 'required|not_in:0',
        'banco'     => 'required|not_in:0',
        'data'      => 'required'
    ];  
    
    public $message = [
        'valor.required'  => 'Digite um valor correto',
        'valor.numeric'   => 'O valor deve ser um número',
        'valor.max'       => 'O valor não deve passar de 99999',

        'descricao.required'  => 'Digite uma descrição correta',
        'descricao.min'       => 'Digite no mínimo 3 caracteres',
        'descricao.max'       => 'Digite no máximo 100 caracteres',
    
        'tipo.required'  =>'Escolha um tipo',
        'tipo.not_in'    =>'Escolha um tipo correto',
        
        'banco.required'  =>'Escolha um banco',
        'banco.not_in'    =>'Escolha um banco correto',

        'data.required'      => 'Escolha uma data valida'
    ];

    public function tipos(){
        return $this->hasOne('\App\Models\Tipo', 'id_tipo', 'tipo');
    }

    public function bancos(){
        return $this->hasOne('\App\Models\Banco', 'id_banco', 'banco');
    }   

    static public function resumoTotal($data){
        $valorReceita = 0;
        $valorDespesa = 0;
        foreach($data as $item){
            if($item->tipo == 1){
                //Receita
                $valorReceita += $item->valor;
            }else if ($item->tipo == 2){
                //Despesa
                $valorDespesa += $item->valor;
            }

        }
        $totalEmConta = $valorReceita - $valorDespesa;
        return [$valorReceita, $valorDespesa, $totalEmConta];
    }
}
