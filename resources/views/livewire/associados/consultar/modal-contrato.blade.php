<div class="modal fade" id="modalContrato" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document" wire:ignore.self>
        <div class="modal-content" wire:ignore.self>
            <div class="modal-header" wire:ignore.self>
                <h5 class="modal-title" id="modalTitleId">Contrato com Associado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" wire:ignore.self>
                <form wire:submit.prevent='salvar' class="row">
                    <div class="mb-3">
                        <label for="" class="form-label">Início</label>
                        <input type="date" class="form-control" wire:model="contrato.inicio">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Fim</label>
                        <input type="date" class="form-control" wire:model="contrato.fim">
                    </div>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary" role="button">Salvar</button>
                        @if($op == 'edição')
                            <button type="button" class="btn btn-danger mx-2" wire:click="cancelar" role="button">Cancelar Contrato</button>
                        @endif
                        <a name="" id="" class="btn btn-secondary" data-bs-dismiss="modal" role="button">Voltar</a>
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

@push("scripts")

<script>
    window.addEventListener("abreModalContrato", (event) => {
        $("#modalContrato").modal("show");
    })

    window.addEventListener("fechaModalContrato", (event) => {
        $("#modalContrato").modal("hide");
    })

    $("#modalContrato").bind('hidden.bs.modal', function(event) {
        Livewire.emit("resetaModalContrato");
    });
</script>

@endpush