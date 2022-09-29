@extends('templates.main')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="{{ asset('libs/select2/css/select2.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('js/croppie/croppie.css') }}" id="app-style" rel="stylesheet" type="text/css" />
@endsection

@section('titulo')
    Institucional / <a style="color: unset" href="{{ route('painel.associados') }}">Associados</a>
@endsection


@section('botoes')
    <a onclick="Livewire.emit('carregaModalCadastroAssociado')" class="btn btn-success" role="button">Adicionar</a>
    <a href="{{ route('painel.associados.importar') }}" class="btn btn-info" role="button">Importar</a>
    <a href="{{ route('painel.associados.exportar') }}" class="btn btn-info" role="button">Exportar</a>
@endsection


@section('conteudo')
    @livewire('associados.consultar.datatable')
    @livewire('associados.consultar.modal-cadastro')
    @livewire('associados.consultar.modal-contrato')
@endsection


@section('scripts')
    
@endsection
