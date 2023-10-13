@extends('index')
@section('title', 'Listagem')
@section('content')

<div>
    <table class="table-bordered table table-striped col-9 align-items-center">
        <thead class="thead-dark">
            <tr>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>CPF</th>
                <th>Data de Nasc.</th>
                <th>Gênero</th>
                <th>Email</th>
                <th>Açoes</th>
            </tr>
        </thead>
        <tbody>
            @if(count($usuarios)==0)
            <tr>
                <td colspan="7">
                    <p class="text-center">Nenhum usuario encontrado para listagem</p>
                </td>
            </tr>
            @else
            @foreach($usuarios as $value)
            <tr>
                <td>{{$value->nome}}</td>
                <td>{{$value->sobrenome}}</td>
                <td>{{$value->cpf}}</td>
                <td>{{$value->dtanasc}}</td>
                <td>{{$value->genero}}</td>
                <td>{{$value->email}}</td>
                <td>
                    <a href="/edit/{{$value->id}}" class="btn"><ion-icon name="create"></ion-icon></a>
                    <a href="#" id="btnmodal" class="btn" data-id="{{$value->id}}" data-cpf="{{$value->cpf}}" class="btn btn-danger delete" data-toggle="modal" data-target="#confirmModal">
                        <ion-icon name="trash"></ion-icon></a>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    @if(count($usuarios)>0)
    <a href="/api" class="bnt">Encaminhar</a>
    @endif
</div>
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="smallModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="confimBody">
                <div>
                    <form id='formdel' action="nada" method="post">
                        <div class="modal-body">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="cpf" id="cpf">
                            <input type="hidden" name="id" id="id">
                            <h5 id="h5cpf" class="text-center"></h5>
                            <p class="text-center">Essa ação não poderá ser desfeita.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
                            <button type="submit" class="btn btn-danger">Sim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection