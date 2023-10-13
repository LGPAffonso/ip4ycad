@extends('index')
@section('title', 'Cadastro')
@section('content')
<div class="">
    @if(isset($usuario))
    <!-- {{$usuario}} -->
    <form action="/update" method="POST" class=" cad col-9 align-items-center">
        <input type="hidden" name="flginc" id="id_flginc" value="0">
        <input type="hidden" name="id" id="id" value="{{$usuario->id}}">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-3"><label for="id_nome" class="form-label">Nome: </label></div>
            <div class="col-6"><input required type="text" name="nome" id="id_nome" value="{{$usuario->nome}}" class="form-control"></div>
        </div>
        <div class="row">
            <div class="col-3"><label for="id_sbrnome" class="form-label">Sobrenome: </label></div>
            <div class="col-6"><input required type="text" name="sobrenome" id="id_sbrnme" value="{{$usuario->sobrenome}}" class="form-control"></div>
        </div>
        <div class="row">
            <div class="col-3"><label for="id_cpf" class="form-label">CPF: </label></div>
            <div class="col-6"><input required type="text" name="cpf" id="id_cpf" value="{{$usuario->cpf}}" class="form-control ls-mask-cpf" placeholder="000.000.000-00"></div>
        </div>
        <div class="row">
            <!-- <div class="col-5 row-cols-2"> -->
            <div class="col-2"><label for="id_dtanasc" class="form-label">Data de Nascimento: </label></div>
            <div class="col-3"><input required type="text" max="" name="dtanasc" value="{{$usuario->dtanasc}}" id="id_dtanasc" class="form-control"></div>
            <!-- </div> -->
            <!-- <div class="col-4"> -->
            <div class="col-2"><label for="id_gen" class="form-label">Genero: </label></div>
            <div class="col-2">
                <select required name="genero" id="id_gen" value="{{$usuario->genero}}" class="form-control">
                    <option default></option>

                    <option @if($usuario->genero=='M') selected @endif value="M">Masculino</option>
                    <option @if($usuario->genero=='F') selected @endif value="F">Feminino</option>
                    <option @if($usuario->genero=='O') selected @endif value="O">Outro</option>
                </select>
            </div>
            <!-- </div> -->
        </div>
        <div class="row">
            <div class="col-3"><label for="id_email" class="form-label">Email: </label></div>
            <div class="col-6"><input type="email" name="email" id="id_email" value="{{$usuario->email}}" class="form-control"></div>
        </div>
        <div class="row">
            <!-- <div class="col-3"></div> -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary align-center">Alterar</button>
                <button type="reset" class="btn btn-secondary align-middle">Recomeçar</button>
            </div>
            <!-- <div class="col-3"></div> -->
        </div>
    </form>
    @else
    <form action="/insert" method="POST" class=" cad col-9 align-items-center">
        <input type="hidden" name="flginc" id="id_flginc" value="1">
        @csrf
        <div class="row">
            <div class="col-3"><label for="id_nome" class="form-label">Nome: </label></div>
            <div class="col-6"><input required type="text" name="txtnome" id="id_nome" class="form-control"></div>
        </div>
        <div class="row">
            <div class="col-3"><label for="id_sbrnome" class="form-label">Sobrenome: </label></div>
            <div class="col-6"><input required type="text" name="txtsbrnome" id="id_sbrnme" class="form-control"></div>
        </div>
        <div class="row">
            <div class="col-3"><label for="id_cpf" class="form-label">CPF: </label></div>
            <div class="col-6"><input required type="text" name="txtcpf" id="id_cpf" class="form-control ls-mask-cpf" placeholder="000.000.000-00"></div>
        </div>
        <div class="row">
            <!-- <div class="col-5 row-cols-2"> -->
            <div class="col-2"><label for="id_dtanasc" class="form-label">Data de Nascimento: </label></div>
            <div class="col-3"><input required type="text" name="txtdtanasc" id="id_dtanasc" class="form-control"></div>
            <!-- </div> -->
            <!-- <div class="col-4"> -->
            <div class="col-2"><label for="id_gen" class="form-label">Genero: </label></div>
            <div class="col-2">
                <select required name="slctgen" id="id_gen" class="form-control">
                    <option default></option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                    <option value="O">Outro</option>
                </select>
            </div>
            <!-- </div> -->
        </div>
        <div class="row">
            <div class="col-3"><label for="id_email" class="form-label">Email: </label></div>
            <div class="col-6"><input type="email" name="txtemail" id="id_email" class="form-control"></div>
        </div>
        <div class="row">
            <!-- <div class="col-3"></div> -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary align-center">Inserir</button>
                <button type="reset" class="btn btn-secondary align-middle">Recomeçar</button>
            </div>
            <!-- <div class="col-3"></div> -->
        </div>
    </form>
    @endif


</div>
@endsection