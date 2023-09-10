@extends('templates.main')

@section('titulo')
    Associados / <a style="color: unset" href="{{ route('painel.servicos') }}">Serviços</a>
@endsection


@section('botoes')
    <a onclick="Livewire.emit('carregaModalCadastroServicos')" class="btn btn-success" role="button">Adicionar</a>
@endsection


@section('conteudo')
    @livewire('servicos.consultar.datable')

    @livewire('servicos.consultar.modal-cadastro')
@endsection

@section('scripts')
@endsection
