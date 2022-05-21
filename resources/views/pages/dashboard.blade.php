@extends('layout.main')

@section('titulo', 'Dashboard')

@section('conteudo')
@if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        <h6>Informe valores corretos !!!!</h6>
    </div>    
@endif

<div class="col-md-10 offset-md-1 dashboard-title-container" id="titulo_pagina">
    <h1>Dashboard</h1>
</div>

<div class="col-md-12" id="adicionarValores">
    <p>
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#inputs_RD" aria-expanded="false" aria-controls="inputs_RD">
            <i class="bi bi-plus-circle"></i>
            Adicionar Nova Receita/Despesa
        </button>
    </p>
    <div class="collapse" id="inputs_RD">
        <div class="card card-body">
            <div class="row">
                <!-- -->
                <form class= "row g-4" action="/criar_valor" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col form-group">
                        <label for="valor">Valor:</label>
                        <input id="valor" type="text" name= " valor" class="form-control @error('valor') is-invalid @enderror" placeholder="Valor R$" aria-label="Valor" value="{{old('valor')}}">

                        @error('valor')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>                            
                        @enderror

                    </div>
                    <div class="col form-group">
                        <label for="tipo">Tipo:</label>
                        <select id="tipo" class="form-select @error('tipo') is-invalid @enderror"
                        name="tipo" aria-label="Default select example">
                            <option value="0" disabled selected>Selecione uma opção</option>
                            @foreach ($nomeTipo as $item)
                                <option 
                                    value="{{$item->id_tipo}}" 
                                    {{old('tipo') == $item->id_tipo ? 'selected="selected"': ""}}
                                >{{$item->nome_tipo}}</option>
                            @endforeach
                        </select>

                        @error('tipo')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>                            
                        @enderror

                    </div>
                    <div class="col form-group">
                        <label for="banco">Banco:</label>
                        <select id="banco" name="banco" class="form-select @error('banco') is-invalid @enderror" aria-label="Default select example">
                            <option value="0" disabled selected>Selecione uma opção</option>
                            @foreach ($nomeBanco as $item)
                            <option 
                                value='{{$item->id_banco}}' 
                                {{old('banco') == $item->id_banco ? 'selected="selected"': ""}}
                            >{{$item->nome_banco}}</option>
                            @endforeach
                        </select>

                        @error('banco')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>                            
                        @enderror

                    </div>
                    <div class="row">
                        <div class="col form-group">
                            <label for="descricao">Descrição:</label>
                            <textarea class="form-control @error('descricao') is-invalid @enderror" name="descricao" id="descricao" placeholder="Descreva sobre">{{old('descricao')}}</textarea>

                            @error('descricao')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>                            
                            @enderror
                        </div>
                        <div class="col form-group">
                            <label for="data">Data:</label>
                            <input type="date" class="@error('data') is-invalid @enderror" name="data" id="data" value="<?php echo date('Y-m-d'); ?>">
                           
                            @error('valor')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>                            
                            @enderror
                        </div>
                        <div class="col" id="botoes">
                            <!--<input type="submit" id="botao" class="btn btn-primary bi bi-save" value="Salvar">-->
                            <button type="submit" onclick="salvarDados()" id="enviar_valor" class="btn btn-primary">
                                <i class="bi bi-save"></i>
                                Salvar
                            </button>
                            <button type="button" id="cancel"
                            class="btn btn-danger"
                            data-bs-toggle="collapse"
                            data-bs-target="#inputs_RD"
                            aria-expanded="false"
                            aria-controls="inputs_RD">
                            <i class="bi bi-x-square"></i>
                            Cancelar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row" id="valores_RD">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Receitas</h4>
                <a href="#" class="btn btn-success" id="grafico"><i class="bi bi-graph-up-arrow">Gráfico</i></a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Data</th>
                            <th scope="col">Banco</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($valores as $item)
                            @if ($item->tipo == 1)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->data}}</td>
                                    <td>{{$item->bancos->nome_banco}}</td>
                                    <td>R$ {{$item->valor}}</td>
                                    <td>{{$item->descricao}}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary edit-btn"><i class="bi bi-pencil-fill"></i> <!--Editar--></a>
                                        <form action="#" method="POST">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger delete-btn"><i class="bi bi-trash-fill"></i> <!--Deletar--></button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row" id="valores_RD">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Despesas</h4>
                <a href="#" class="btn btn-success" id="grafico"><i class="bi bi-graph-down-arrow"></i>Gráfico</a>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Data</th>
                            <th scope="col">Banco</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($valores as $item)
                            @if ($item->tipo == 2)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td>{{$item->data}}</td>
                                    <td>{{$item->bancos->nome_banco}}</td>
                                    <td>- R$ {{$item->valor}}</td>
                                    <td>{{$item->descricao}}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary edit-btn"><i class="bi bi-pencil-fill"></i> <!--Editar--></a>
                                        <form action="#" method="POST">
                                            @csrf 
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger delete-btn"><i class="bi bi-trash-fill"></i> <!--Deletar--></button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    
<div id= "resumo" class="row">
    <div class="col-md-6">
        <div class="card">
            <h4 class="card-header">Resumo</h4>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Total Receitas</th>
                            <th scope="col">Total Despesas</th>
                            <th scope="col">Restante em Conta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>R$ {{$total_receita}}</td>
                            <td>- R$ {{$total_despesa}}</td>
                            <td>R$ {{$total_conta}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    
<!--


<table class="table">
        
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mês</th>
                    <th scope="col">Ano</th>
                    <th scope="col">Total no mês</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                
                    <tr>
                        <td scope="row">.....</td>
                        <td>....</td>
                        <td>....</td>
                        <td>....</td>
                        <td>
                            <a href="#" class="btn btn-info edit-btn"><ion-icon name="create-outline"></ion-icon> Editar</a>
                            <form action="#" method="POST">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger delete-btn"><ion-icon name="trash-outline"></ion-icon> Deletar</button>
                            </form>
                        </td>
                    </tr>
            </tbody>
        </table> -->
    <!--
        <p>Você ainda não tem eventos!!! <a href="/events/create">Criar um evento?</a></p>
    -->

@endsection