<div class="modal fade" id="modalCadastroPalestra" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document" wire:ignore.self>
        <div class="modal-content" wire:ignore.self>
            <div class="modal-header" wire:ignore.self>
                <h5 class="modal-title" id="modalTitleId">Cadastro de Palestra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" wire:ignore.self>
                <form wire:submit.prevent='salvar' class="row">
                    <h4 class="card-title mb-3">Informações Gerais</h4>
                    <div class="mb-3 col-12">
                        <label class="form-label">Titulo</label>
                        <input type="text" class="form-control" maxlength="255" required wire:model.defer="palestra.titulo" required>
                    </div>
                    <div class="mb-3 col-3">
                        <label class="form-label">Data</label>
                        <input type="date" class="form-control" required wire:model.defer="palestra.data" required>
                    </div>
                    <div class="mb-3 col-3">
                        <label class="form-label">Horário</label>
                        <input type="time" class="form-control" required wire:model.defer="palestra.horario" required>
                    </div>
                    <div class="mb-3 col-6">
                        <label class="form-label">Palestrante</label>
                        <input type="text" class="form-control" maxlength="255" required wire:model.defer="palestra.palestrante" required>
                    </div>
                    <div class="mb-4 col-12" wire:ignore>
                        <label for="descricao" class="form-label">Conteúdo</label>
                        <textarea id="conteudo" required></textarea>
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
    window.addEventListener("abreModalCadastroPalestra", (event) => {
        $("#modalCadastroPalestra").modal("show");
    })

    window.addEventListener("fechaModalCadastroPalestra", (event) => {
        $("#modalCadastroPalestra").modal("hide");
    })

    $("#modalCadastroPalestra").bind('hidden.bs.modal', function(event) {
        Livewire.emit("resetaModalCadastroPalestra");
    });

    window.addEventListener('carregaTexto', event => {
        $('#conteudo').summernote("code", @this.palestra.conteudo);
    });

    $('#conteudo').summernote({
        height: 400,
        callbacks: {
            onChange: function(contents, $editable) {
                @this.set('palestra.conteudo', contents);
            },
        }
    });
</script>

@endpush