@extends('templates.main')

@section('styles')

@endsection

@section('titulo')
    Institucional / <a style="color: unset" href="{{ route('painel.leads') }}">Newsletter</a>
@endsection


@section('botoes')
@endsection


@section('conteudo')
    @livewire('leads.datatable')
@endsection


@section('scripts')
    
@endsection
