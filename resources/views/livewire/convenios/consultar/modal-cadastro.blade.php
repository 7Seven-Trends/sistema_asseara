<div class="modal fade" id="modalCadastroConvenio" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document" wire:ignore.self>
        <div class="modal-content" wire:ignore.self>
            <div class="modal-header" wire:ignore.self>
                <h5 class="modal-title" id="modalTitleId">Cadastro de Convênio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" wire:ignore.self>
                <form wire:submit.prevent='salvar' class="row">
                    <div class="mb-3 col-12">
                        <label class="form-label">Nome</label>
                        <input type="text" class="form-control" maxlength="60" required wire:model.defer="convenio.nome">
                    </div>
                    <div class="mb-3 col-12">
                        <label class="form-label">Link</label>
                        <input type="text" class="form-control" maxlength="255" required wire:model.defer="convenio.link">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Imagem</label>
                        <input type="file" class="form-control" wire:model='arquivo' accept="image/*">
                    </div>
                    <hr>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary" role="button" wire:loading.attr="disabled">Salvar</button>
                        <a name="" id="" class="btn btn-secondary" data-bs-dismiss="modal" role="button">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push("scripts")

<script>
    window.addEventListener("abreModalCadastroConvenio", (event) => {
        $("#modalCadastroConvenio").modal("show");
    })

    window.addEventListener("fechaModalCadastroConvenio", (event) => {
        $("#modalCadastroConvenio").modal("hide");
    })

    $("#modalCadastroConvenio").bind('hidden.bs.modal', function(event) {
        Livewire.emit("resetaModalCadastroConvenio");
    });
</script>

@endpush