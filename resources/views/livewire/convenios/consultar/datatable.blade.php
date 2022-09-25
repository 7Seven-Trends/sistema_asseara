<div class="row">
    <div class="col-9">
        <div class="card">
            <table class="table" style="width: 100%; vertical-align: middle;">
                <thead>
                    <tr>
                        <th class="" style="width: 15%"><i class="bx bxs-image text-white"></i></th>
                        <th class="" style="width: 40%">Nome</th>
                        <th class="" style="width: 15%">Link</th>
                        <th class="text-center" style="width: 10%"></th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($convenios as $convenio)
                        <tr>
                            <td class="text-center cell-imagem-blur" style="position: relative;">
                                <img src="{{ ($convenio->imagem) ? $convenio->imagem : asset('images/sem-foto.jpg') }}" width="80" height="80"
                                style="object-fit: cover; border-radius: 50%">                                
                                <label for="input_preview_{{ $convenio->id }}">
                                    <i class="fas fa-edit text-white cpointer" style="font-size: 14px; position: absolute; top: calc(50% - 7px); left: calc(50% - 7px);"></i>
                                </label>
                                <input id="input_preview_{{ $convenio->id }}" style="display: none;" type="file" wire:model="arquivos.{{ $convenio->id }}" accept="image/*">
                            </td>
                            <td class="">
                                <h5 class="text-primary"><a>{{ $convenio->nome }}</a></h5>
                            </td>
                            <td>
                                {{ $convenio->link }}
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                                <div class="dropdown mt-4 mt-sm-0">
                                    <a href="#" class="dropdown-toggle" style="font-size: 14px; color: #d9a863"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-bars" {{--  data-bs-placement="top" title="Opções" --}}></i>
                                    </a>
                                    <div class="dropdown-menu" style="margin: 0px;">
                                        <a class="dropdown-item py-2" role="button" onclick="Livewire.emit('carregaModalEdicaoConvenio', {{ $convenio->id }})">
                                            <i class="bx bx-edit-alt pe-1"></i>
                                            Editar</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row row-paginacao">
                {!! $convenios->links() !!}
            </div>
        </div>
    </div> <!-- end col -->
    <div class="col-3">
        <div class="col-sm-12 col-md-6 mb-3  bg-primary" style=" border-radius: 5px; width: 100%;">
            <a class="btn"
                style="line-height: 29px;padding-left: 21px; color: white; height: 100%; cursor: default; "
                href="">Filtros</a>
        </div>
        <div class="card  filter-body">
            <div class="card-body">

                <form id="form-filtro" method="POST">
                    @csrf

                </form>

            </div>
        </div>
    
    </div>
</div>
