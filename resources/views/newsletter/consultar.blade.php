@extends('templates.main')

@section('styles')

@endsection

@section('titulo')
    Institucional / <a style="color: unset" href="{{ route('painel.newsletter') }}">Newsletter</a>
@endsection


@section('botoes')
@endsection


@section('conteudo')
    @livewire('newsletter.datatable')
@endsection


@section('scripts')
    
@endsection
