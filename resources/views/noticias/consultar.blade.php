@extends('templates.main')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="{{ asset('libs/select2/css/select2.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('js/croppie/croppie.css') }}" id="app-style" rel="stylesheet" type="text/css" />
@endsection

@section('titulo')
    Institucional / <a style="color: unset" href="{{ route('painel.noticias') }}">Noticias</a>
@endsection


@section('botoes')
    <a onclick="Livewire.emit('abreModalCadastro')" class="btn btn-success" role="button">Adicionar</a>
@endsection


@section('conteudo')
    @livewire('noticias.consultar.datatable')
    <div class="modal fade" id="modalNoticia" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Adicionando Notícia</h5>
                    <i data-bs-dismiss="modal" aria-label="Close" class="fas fa-times text-white cpointer"></i>
                </div>
                <div class="modal-body bg-modal">
                    @livewire('noticias.consultar.modal-cadastro')
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalCategoria" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Categoria</h5><i data-bs-dismiss="modal" aria-label="Close"
                        class="fas fa-times text-white cpointer"></i>
                </div>
                <div class="modal-body">
                    @livewire('noticias.consultar.categorias.modal-cadastro')
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        window.addEventListener("abreModalNoticias", (event) => {
            $("#modalNoticia").modal("show");
        })

        window.addEventListener("fechaModalNoticias", (event) => {
            $("#modalNoticia").modal("hide");
        })

        window.addEventListener("abreModalCategorias", (event) => {
            $("#modalCategoria").modal("show");
        })

        window.addEventListener("fechaModalCategorias", (event) => {
            $("#modalCategoria").modal("hide");
        })
    </script>
@endsection
