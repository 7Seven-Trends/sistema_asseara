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
    <button onclick="Livewire.emit('abreModalImportacao')" type="button" class="btn btn-info">Importar</button>
    <a href="{{ route('painel.associados.senhas') }}" class="btn btn-info" role="button">Atualizar Senhas</a>
    <a href="{{ route('painel.associados.exportar') }}" class="btn btn-info" role="button">Exportar</a>
@endsection


@section('conteudo')
    @livewire('associados.consultar.datatable')
    @livewire('associados.consultar.modal-cadastro')
    @livewire('associados.consultar.modal-contrato')

    <div class="modal fade" id="modalImportacao" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Importar Associados
                    </h5><i data-bs-dismiss="modal" aria-label="Close" class="fas fa-times text-white cpointer"></i>
                </div>
                <div class="modal-body">
                    @livewire('associados.consultar.importacao')
                </div>
            </div>
        </div>
    </div>
@endsection



@section('scripts')
    <script>
        window.addEventListener("abreModalImportacao", (event) => {
            $("#modalImportacao").modal("show");
        })

        window.addEventListener("fechaModalImportacao", (event) => {
            $("#modalImportacao").modal("hide");
        })
    </script>
@endsection
