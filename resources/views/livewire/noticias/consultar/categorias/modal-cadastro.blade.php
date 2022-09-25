<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <form action="" wire:submit.prevent='salvar'>
                <div class="mb-3">
                    <label for="" class="form-label">Nome</label>
                    <input type="text" class="form-control" maxlength="20" wire:model='nome'>
                </div>
                <button type="submit" class="btn btn-success">Salvar</button>
            </form>
        </div>
    </div>
</div>
