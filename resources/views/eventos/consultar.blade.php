@extends('templates.main')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="{{ asset('libs/select2/css/select2.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('js/croppie/croppie.css') }}" id="app-style" rel="stylesheet" type="text/css" />
@endsection

@section('titulo')
    Institucional / <a style="color: unset" href="{{ route('painel.eventos') }}">Eventos</a>
@endsection


@section('botoes')
    <a onclick="Livewire.emit('carregaModalCadastroEvento')" class="btn btn-success" role="button">Adicionar</a>
@endsection


@section('conteudo')
    @livewire('eventos.consultar.datatable')
    @livewire('eventos.consultar.modal-cadastro')
@endsection


@section('scripts')
    
@endsection
