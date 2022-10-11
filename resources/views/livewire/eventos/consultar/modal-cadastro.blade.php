<div class="modal fade" id="modalCadastroEvento" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document" wire:ignore.self>
        <div class="modal-content" wire:ignore.self>
            <div class="modal-header" wire:ignore.self>
                <h5 class="modal-title" id="modalTitleId">Cadastro de Evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" wire:ignore.self>
                <form wire:submit.prevent='salvar' class="row">
                    <h4 class="card-title mb-3">Informações Gerais</h4>
                    <div class="mb-3 col-6">
                        <label class="form-label">Titulo</label>
                        <input type="text" class="form-control" maxlength="255" required wire:model.defer="evento.titulo">
                    </div>
                    <div class="mb-3 col-6">
                        <label class="form-label">Tema</label>
                        <input type="text" class="form-control" maxlength="255" required wire:model.defer="evento.tema">
                    </div>
                    <div class="mb-3 col-4">
                        <label class="form-label">Local</label>
                        <input type="text" class="form-control" maxlength="255" required wire:model.defer="evento.local">
                    </div>
                    <div class="mb-3 col-2">
                        <label for="" class="form-label">Utiliza Palestras</label>
                        <select class="form-select" name="" id="" wire:model="evento.utiliza_palestras">
                            <option value="1">Sim</option>
                            <option value="0">Não</option>
                        </select>
                    </div>
                    <div class="mb-3 col-2 @if($evento && $evento->utiliza_palestras != 0) d-none @endif">
                        <label for="" class="form-label">Data do Evento</label>
                        <input type="date" class="form-control" min="{{ date("Y-m-d") }}" wire:model="evento.data">
                    </div>
                    <div class="mb-3 col-2 @if($evento && $evento->utiliza_palestras != 0) d-none @endif">
                        <label for="" class="form-label">Início do Evento</label>
                        <input type="time" class="form-control" wire:model="evento.horario">
                    </div>
                    <div class="mb-3 col-2 @if($evento && $evento->utiliza_palestras != 0) d-none @endif">
                        <label for="" class="form-label">Fim do Evento</label>
                        <input type="time" class="form-control" wire:model="evento.horario_fim">
                    </div>
                    <div class="mb-4 col-12" wire:ignore>
                        <label for="descricao" class="form-label">Conteúdo</label>
                        <textarea id="conteudo"></textarea>
                    </div>
                    <hr>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary" role="button">Salvar</button>
                        <a name="" id="" class="btn btn-secondary" data-bs-dismiss="modal" role="button">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Optional: Place to the bottom of scripts -->
<script>
    const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)

</script>

@push("styles")
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
@endpush


@push("scripts")
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    window.addEventListener("abreModalCadastroEvento", (event) => {
        $("#modalCadastroEvento").modal("show");
    })

    window.addEventListener("fechaModalCadastroEvento", (event) => {
        $("#modalCadastroEvento").modal("hide");
    })

    $("#modalCadastroEvento").bind('hidden.bs.modal', function(event) {
        Livewire.emit("resetaModalCadastroEvento");
    });

    window.addEventListener('carregaTexto', event => {
        $('#conteudo').summernote("code", @this.evento.conteudo);
    });

    $('#conteudo').summernote({
        height: 400,
        callbacks: {
            onChange: function(contents, $editable) {
                @this.set('evento.conteudo', contents);
            },
        }
    });
</script>

@endpush