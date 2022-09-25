<div class="modal fade" id="modalCadastroAssociado" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document" wire:ignore.self>
        <div class="modal-content" wire:ignore.self>
            <div class="modal-header" wire:ignore.self>
                <h5 class="modal-title" id="modalTitleId">Cadastro de Associado</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" wire:ignore.self>
                <form wire:submit.prevent='salvar' class="row">
                    <h4 class="card-title mb-3">Informações Gerais</h4>
                    <div class="mb-3 col-6">
                        <label class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" maxlength="60" required wire:model.defer="associado.nome">
                    </div>
                    <div class="mb-3 col-3">
                      <label for="" class="form-label">Modalidade de Associado</label>
                        <select class="form-control" name="" id="" required wire:model.defer="associado.modalidade">
                            <option value="">Selecionar...</option>
                            @foreach(config("associados.modalidades") as $key => $modalidade)
                                <option value="{{ $key }}">{{ $modalidade }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-3">
                        <label class="form-label">CPF</label>
                        <input type="text" class="form-control cpf" maxlength="14" required wire:model.defer="associado.cpf">
                    </div>
                    <div class="mb-3 col-3">
                        <label class="form-label">Aniversário</label>
                        <input type="date" class="form-control" required wire:model.defer="associado.nascimento">
                    </div>
                    <div class="mb-3 col-3">
                        <label class="form-label">Telefone</label>
                        <input type="text" class="form-control telefone" maxlength="16" required wire:model.defer="associado.telefone">
                    </div>
                    <div class="mb-3 col-3">
                        <label class="form-label">Número do Registro Profissional</label>
                        <input type="text" class="form-control" maxlength="20" required wire:model.defer="associado.registro_profissional">
                    </div>
                    <div class="mb-3 col-3">
                        <label for="" class="form-label">Conselho Profissional</label>
                        <select class="form-control" name="" id="" required wire:model.defer="associado.conselho_profissional">
                              <option value="">Selecionar...</option>
                              @foreach(config("associados.conselhos") as $key => $conselho)
                                  <option value="{{ $key }}">{{ $conselho }}</option>
                              @endforeach
                        </select>
                    </div>
                    <div class="mb-3 col-3">
                        <label class="form-label">Título Profissional</label>
                        <input type="text" class="form-control" maxlength="60" required wire:model.defer="associado.titulo_profissional">
                    </div>
                    <div class="mb-3 col-6">
                        <label class="form-label">Outras Atribuições</label>
                        <input type="text" class="form-control" maxlength="100" required wire:model.defer="associado.atribuicoes">
                    </div>
                    <div class="mb-3 col-3">
                        <label class="form-label">E-mail</label>
                        <input type="text" class="form-control" maxlength="50" required wire:model.defer="associado.email">
                    </div>
                    <hr>
                    <h4 class="card-title mb-3">Informações de Atendimento</h4>
                    <div class="mb-3 col-6">
                        <label class="form-label">Endereço de Atendimento</label>
                        <input type="text" class="form-control" maxlength="100" required wire:model.defer="associado.endereco_atendimento">
                    </div>
                    <div class="mb-3 col-3">
                        <label class="form-label">Cidade</label>
                        <input type="text" class="form-control" maxlength="50" required wire:model.defer="associado.cidade_atendimento">
                    </div>
                    <div class="mb-3 col-1">
                        <label class="form-label">UF</label>
                        <input type="text" class="form-control" maxlength="2" required wire:model.defer="associado.uf_atendimento">
                    </div>
                    <div class="mb-3 col-2">
                        <label class="form-label">CEP</label>
                        <input type="text" class="form-control cep" maxlength="9" required wire:model.defer="associado.cep_atendimento">
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

@push("scripts")

<script>
    window.addEventListener("abreModalCadastroAssociado", (event) => {
        $("#modalCadastroAssociado").modal("show");
    })

    window.addEventListener("fechaModalCadastroAssociado", (event) => {
        $("#modalCadastroAssociado").modal("hide");
    })

    $("#modalCadastroAssociado").bind('hidden.bs.modal', function(event) {
        Livewire.emit("resetaModalCadastroAssociado");
    });
</script>

@endpush