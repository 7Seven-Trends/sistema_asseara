<div class="modal fade" id="modalCadastroServicos" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
    role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document" wire:ignore.self>
        <div class="modal-content" wire:ignore.self>
            <div class="modal-header" wire:ignore.self>
                <h5 class="modal-title" id="modalTitleId">Cadastro de Serviços</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" wire:ignore.self>
                <form wire:submit.prevent='salvar' class="row">
                    <h4 class="card-title mb-3">Informações Gerais</h4>

                    <div class="mb-3 col-12">
                        <label class="form-label">Nome do Serviço:</label>
                        <input type="text" class="form-control" maxlength="60" required
                            wire:model.defer="servico.nome">
                    </div>

                    <div class="mb-3 col-12">
                        <label class="form-label">Conteúdo:</label>
                        <textarea class="form-control" rows="10" required wire:model.defer="servico.conteudo"></textarea>
                    </div>

                    <hr>
                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary" role="button">Salvar</button>
                        <a name="" id="" class="btn btn-secondary" data-bs-dismiss="modal"
                            role="button">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Optional: Place to the bottom of scripts -->
<script>
    const myModal = new bootstrap.Modal(document.getElementById('modalCadastroServicos'), options)
</script>

@push('scripts')
    <script>
        window.addEventListener("abreModalCadastroServicos", (event) => {
            $("#modalCadastroServicos").modal("show");
        })

        window.addEventListener("fechaModalCadastroServicos", (event) => {
            $("#modalCadastroServicos").modal("hide");
        })


        $("#modalCadastroServicos").bind('hidden.bs.modal', function(event) {
            Livewire.emit("resetaModalCadastroServicos");
        });
    </script>
@endpush
