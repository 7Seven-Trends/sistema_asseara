<div class="row">
    <div class="col-9">
        <div class="card">
            <table class="table" style="width: 100%; vertical-align: middle;">
                <thead>
                    <tr>
                        <th class="" style="width: 15%"><i class="bx bxs-image text-black mr-2"></i>Thumbnail</th>
                        <th class="" style="width: 15%"><i class="bx bxs-image text-black mr-2"></i>Banner</th>
                        <th class="" style="width: 40%">Titulo, Tema, Data</th>
                        <th class="" style="width: 15%">Palestrante</th>
                        <th class="text-center" style="width: 10%"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventos as $evento)
                        <tr>
                            <td class="text-center cell-imagem-blur" style="position: relative;">
                                <img src="{{ ($evento->thumbnail) ? $evento->thumbnail : asset('images/sem-foto.jpg') }}" width="80" height="80"
                                style="object-fit: cover;">                                
                                <label for="input_preview_{{ $evento->id }}">
                                    <i class="fas fa-edit text-white cpointer" style="font-size: 14px; position: absolute; top: calc(50% - 7px); left: calc(50% - 7px);"></i>
                                </label>
                                <input id="input_preview_{{ $evento->id }}" style="display: none;" type="file" wire:model="thumbnails.{{ $evento->id }}" accept="image/*">
                            </td>
                            <td class="text-center cell-imagem-blur" style="position: relative;">
                                <img src="{{ ($evento->banner) ? $evento->banner : asset('images/sem-foto.jpg') }}" width="130" height="80"
                                style="object-fit: cover;">                                
                                <label for="input_banner_{{ $evento->id }}">
                                    <i class="fas fa-edit text-white cpointer" style="font-size: 14px; position: absolute; top: calc(50% - 7px); left: calc(50% - 7px);"></i>
                                </label>
                                <input id="input_banner_{{ $evento->id }}" style="display: none;" type="file" wire:model="banners.{{ $evento->id }}" accept="image/*">
                            </td>
                            <td class="">
                                <h5 class="text-primary"><a>{{ $evento->titulo }}</a></h5>
                                <p class="mb-1">
                                    {{ $evento->tema }}
                                </p>
                                <p class="mb-1">
                                    {{ date("d/m/Y", strtotime($evento->data)) }} às {{ date("H:i", strtotime($evento->horario)) }}
                                </p>
                            </td>
                            <td>
                                {{ $evento->palestrante }}
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                                <div class="dropdown mt-4 mt-sm-0">
                                    <a href="#" class="dropdown-toggle" style="font-size: 14px; color: #d9a863"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                    <div class="dropdown-menu" style="margin: 0px;">
                                        <a class="dropdown-item py-2" role="button" onclick="Livewire.emit('carregaModalEdicaoEvento', {{ $evento->id }})">
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
                {!! $eventos->links() !!}
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
