@extends('templates.main')

@section('styles')

@endsection

@section('titulo')
    Institucional / <a style="color: unset" href="{{ route('painel.mensagens.suporte') }}">Suporte</a>
@endsection


@section('botoes')
@endsection


@section('conteudo')
    @livewire('suporte.datatable')
    @livewire('suporte.modal-mensagem')
@endsection


@section('scripts')
    
@endsection
