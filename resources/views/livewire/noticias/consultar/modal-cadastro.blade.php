<div class="row">

    <div class="col-12">

        <div class="card ">
            <div class="card-body">
                <h4 class="card-title">Cadastro de Notícia</h4>
                <form id="form-cadastro" wire:submit.prevent='salvar' method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="titulo">Título</label>
                                <input id="titulo" name="titulo" type="text" placeholder="Insira o título da notícia"
                                    class="form-control" wire:model.defer="titulo" maxlength="100" required>
                            </div>
                            <div class="mb-3" wire:ignore>
                                <label for="categoria">Categoria</label><br>
                                <select class="form-control" style="width: 100%;" name="categoria"
                                    id="select_categoria" required>
                                    @foreach (\App\Models\Categoria::all() as $categoria)
                                        <option value="{{ $categoria->id }}">
                                            {{ $categoria->nome }}
                                        </option>}
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="fonte">Fonte</label>
                                <input id="fonte" name="fonte" type="text" placeholder="Fonte da Notícia"
                                    class="form-control" wire:model.defer="fonte" maxlength="100" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="autor">Autor</label>
                                <input id="autor" name="autor" type="text" placeholder="Insira o nome do autor"
                                    class="form-control" wire:model.defer="autor" maxlength="40" required>
                            </div>
                            <div class="mb-3">
                                <label for="publicacaodata">Data de Publicação</label>
                                <input class="form-control" name="publicacao" type="date" id="publicacaodata"
                                    wire:model.defer="publicacao" required max="{{ date('Y-m-d', strtotime('+3years')) }}">
                            </div>
                            <div class="mb-3" wire:ignore>
                                <label for="tags">Tags</label><br>
                                <select class="form-control" style="width: 100%;" name="tags[]" id="select_tag"
                                    multiple="multiple" required>
                                    @foreach (\App\Models\Tag::all() as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->nome }}
                                        </option>}
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="resumo">Resumo</label>
                            <input id="resumo" name="resumo" type="text" placeholder="Resumo da Notícia"
                                class="form-control" wire:model.defer="resumo" maxlength="250" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3">
                            <label for="tags">Tipo</label><br>
                            <select class="form-control" wire:model="tipo">
                                <option value="">Selecionar...</option>
                                <option value="0">Notícia</option>
                                <option value="1">Links</option>
                            </select>
                        </div>
                    </div>
                    @if($tipo === '1')
                        <div class="row">
                            <div class="mb-3">
                                <label for="link">Link</label>
                                <input id="link" name="link" type="text"
                                    class="form-control" wire:model="link" maxlength="255" required>
                            </div>
                        </div>
                    @endif
                    <div class="row" wire:ignore id="summernote-container">
                        <div class="mb-3">
                            <label for="resumo">Conteúdo (*)</label>
                            <textarea class="form-control" name="conteudo" id="summernote" rows="10"></textarea>
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 justify-content-end"
                        style="position: static; bottom: 15px; right: 15px; z-index: 10">
                        <button type="submit" class="btn btn-success"><i class="fas fa-save fa-lg mx-2"></i>
                            Salvar</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
    
</div>

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="{{ asset('js/croppie/croppie.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('libs/select2/css/select2.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="{{ asset('js/croppie/croppie.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="{{ asset('libs/select2/js/select2.min.js') }}"></script>
    <script>
        window.addEventListener('carregaTexto', event => {
            $('#summernote').summernote({
                height: 250,
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('conteudo', contents);
                    },
                }
            });
            $('#summernote').summernote("code", @this.conteudo);
            $('select[name="categoria"]').val(@this.categoria);
            $('select[name="categoria"]').trigger('change');
            $('select[name="tags[]"]').val(@this.tags);
            $('select[name="tags[]"]').trigger('change');
        });

        window.addEventListener('hideSummernote', event => {
            $("#summernote-container").hide();
        });

        window.addEventListener('showSummernote', event => {
            $("#summernote-container").show();
        });

        window.addEventListener('addSelect2Option', event => {
            var newOption = new Option(event.detail.nome, event.detail.id, false, false);
            $('select[name="tags[]"]').append(newOption).trigger('change');
        });

        window.addEventListener('addSelect2OptionCategoria', event => {
            var newOption = new Option(event.detail.nome, event.detail.id, false, false);
            $('select[name="categoria"]').append(newOption).trigger('change');
        });

        window.addEventListener('editSelect2OptionCategoria', event => {
            $('select[name="categoria"] option[value="' + event.detail.id + '"]').text(event.detail.nome);
            $('select[name="categoria"]').trigger('change');
        });

        $(document).ready(function() {

            $('select[name="categoria"]').select2({
                dropdownParent: $('#modalNoticia')
            });

            $('select[name="categoria"]').on("change", function(e) {
                @this.set('categoria', e.target.value);
            });

            $('select[name="tags[]"]').select2({
                dropdownParent: $('#modalNoticia'),
                tags: true
            });

            $('select[name="tags[]"]').on("change", function(e) {
                @this.set('tags', $('select[name="tags[]"]').val());
            });

            $('#sobre').summernote({
                height: 300,
                callbacks: {
                    onChange: function(contents, $editable) {
                        @this.set('sobre', contents);
                    },
                }
            });

            $('.select2-selection--spgle').height('35px');
            $('.select2-selection--single').css('display', 'flex');
            $('.select2-selection--single').css('align-items', 'center');
            $('.select2-container--default .select2-selection--single').css('border', '1px solid #ced4da');
        })
    </script>
@endpush
