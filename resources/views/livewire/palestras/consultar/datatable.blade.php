<div class="row">
    <div class="col-12">
        <div class="card">
            <table class="table table-bordered" style="width: 100%; vertical-align: middle;">
                <thead>
                    <tr>
                        <th class="" style="width: 15%"><i class="bx bxs-image text-black mr-2"></i>Thumbnail</th>
                        <th class="" style="width: 15%"><i class="bx bxs-image text-black mr-2"></i>Banner</th>
                        <th class="" style="width: 40%">Titulo, Palestrante, Data</th>
                        <th class="text-center" style="width: 10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($palestras as $palestra)
                        <tr>
                            <td class="text-center cell-imagem-blur" style="position: relative;">
                                <img src="{{ ($palestra->thumbnail) ? $palestra->thumbnail : asset('images/sem-foto.jpg') }}" width="80" height="80"
                                style="object-fit: cover;">                                
                                <label for="input_preview_{{ $palestra->id }}">
                                    <i class="fas fa-edit text-white cpointer" style="font-size: 14px; position: absolute; top: calc(50% - 7px); left: calc(50% - 7px);"></i>
                                </label>
                                <input id="input_preview_{{ $palestra->id }}" style="display: none;" type="file" wire:model="thumbnails.{{ $evento->id }}" accept="image/*">
                            </td>
                            <td class="text-center cell-imagem-blur" style="position: relative;">
                                <img src="{{ ($palestra->banner) ? $palestra->banner : asset('images/sem-foto.jpg') }}" width="130" height="80"
                                style="object-fit: cover;">                                
                                <label for="input_banner_{{ $palestra->id }}">
                                    <i class="fas fa-edit text-white cpointer" style="font-size: 14px; position: absolute; top: calc(50% - 7px); left: calc(50% - 7px);"></i>
                                </label>
                                <input id="input_banner_{{ $palestra->id }}" style="display: none;" type="file" wire:model="banners.{{ $palestra->id }}" accept="image/*">
                            </td>
                            <td class="">
                                <h5 class="text-primary"><a>{{ $palestra->titulo }}</a></h5>
                                <p class="mb-1">
                                    {{ $palestra->palestrante }}
                                </p>
                                <p class="mb-1">
                                    {{ date("d/m/Y", strtotime($palestra->data)) }} às {{ date("H:i", strtotime($palestra->horario)) }}
                                </p>
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                                <div class="dropdown mt-4 mt-sm-0">
                                    <a href="#" class="dropdown-toggle" style="font-size: 14px; color: #d9a863"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                    <div class="dropdown-menu" style="margin: 0px;">
                                        <a class="dropdown-item py-2" role="button" onclick="Livewire.emit('carregaModalEdicaoPalestra', {{ $palestra->id }})">
                                            <i class="bx bx-edit-alt pe-1"></i>
                                            Editar</a>
                                        <a class="dropdown-item py-2 text-danger" role="button" wire:click="excluir({{ $palestra->id }})">
                                            <i class="bx bx-trash-alt pe-1"></i>
                                            Excluir</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row row-paginacao">
                {!! $palestras->links() !!}
            </div>
        </div>
    </div> <!-- end col -->
    {{-- <div class="col-3">
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
    
    </div> --}}
</div>
