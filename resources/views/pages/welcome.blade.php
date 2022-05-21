@extends('layout.main')
@section('title', 'Economiza')

@section('conteudo')
    
    <div id="buscar-container" class="col-md-12">
        <h1>Busque pelo mês:</h1>
        <form action="/" method="GET">
            <input type="text" id="buscar" name="buscar" class="form-control" placeholder="Procurar">
        </form>
    </div>

    <div class="row" id="cards-container">
        <div class="card col-md-3">
            <!-- Corpo do card -->
            <div class="card-body">
                <!-- Mês do card-->
                <h5 class="card-mes"> Mês 1 ano 1</h5>
                <p class="card-total">Total: R$ </p>
                <a href="#" class="btn btn-primary"> Detalhes</a>

            </div>
        </div>
    </div>
@endsection