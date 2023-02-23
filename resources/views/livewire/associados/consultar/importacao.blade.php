<div class="row">
    <div class="col-12">
        <form id="form-cadastro" wire:submit.prevent='importar' method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <div class="mb-3">
                        <label for="titulo">Arquivo .XLSX</label>
                        <input type="file" name="arquivo" id="arquivo" class="form-control"
                            wire:model.defer="arquivo"
                            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet required">
                    </div>
                </div>
            </div>

            <span class="text-warning"><i class="fa fa-exclamation-triangle pe-2" aria-hidden="true"></i>
                Atenção, o arquivo deve estar seguindo os padrões de importação.</span>

            <div class="d-flex flex-wrap gap-2 mt-3 justify-content-end"
                style="position: static; bottom: 15px; right: 15px; z-index: 10">
                <button type="submit" class="btn btn-success"><i class="fas fa-file fa-lg mx-2"></i>
                    Importar</button>
            </div>
        </form>
    </div>
</div>
