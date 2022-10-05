<div class="modal fade" id="modalMensagemSuporte" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document" wire:ignore.self>
        <div class="modal-content" wire:ignore.self>
            <div class="modal-header" wire:ignore.self>
                <h5 class="modal-title" id="modalTitleId">Mensagem</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" wire:ignore.self>
                @if($mensagem) {!! $mensagem->mensagem !!} @endif
            </div>
        </div>
    </div>
</div>

@push("scripts")

<script>
    window.addEventListener("abreModalMensagemSuporte", (event) => {
        $("#modalMensagemSuporte").modal("show");
    })

    window.addEventListener("fechaModalMensagemSuporte", (event) => {
        $("#modalMensagemSuporte").modal("hide");
    })

    $("#modalMensagemSuporte").bind('hidden.bs.modal', function(event) {
        Livewire.emit("resetaModalMensagemSuporte");
    });
</script>

@endpush