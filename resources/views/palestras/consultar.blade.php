@extends('templates.main')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endsection

@section('titulo')
    Institucional / <a style="color: unset" href="{{ route('painel.eventos.palestras', ['evento' => $evento->id]) }}">Palestras</a>
@endsection


@section('botoes')
    <a onclick="Livewire.emit('carregaModalCadastroPalestra')" class="btn btn-success" role="button">Adicionar</a>
@endsection


@section('conteudo')
    @livewire('palestras.consultar.datatable', ['evento' => $evento->id])
    @livewire('palestras.consultar.modal-cadastro', ['evento_id' => $evento->id])
@endsection


@section('scripts')
    
@endsection
