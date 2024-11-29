<div class="row">
    <div class="col-9">
        <div class="card">
            <table class="table" style="width: 100%; vertical-align: middle;">
                <thead>
                    <tr>
                        <th class="" style="width: 5%">Publicada</th>
                        <th class="" style="width: 15%">Thumb</th>
                        <th class="" style="width: 15%">Banner</th>
                        <th class="" style="width: 55%">Título, categoria e Autor</th>
                        <th class="" style="width: 15%">Publicação</th>
                        <th class="text-center" style="width: 10%"></th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($noticias as $noticia)
                        <tr>
                            <td style="padding-right: 12px;font-size: 25px; color: #d9a863; text-align: center;">
                                @if ($noticia->publicada)
                                    <i class='bx bxs-badge-check' {{--  data-bs-placement="top" title="Já foi publicada!" --}}></i>
                                @else
                                    <i class='bx bxs-badge text-danger' {{--  data-bs-placement="top" title="Ainda não publicada" --}}></i>
                                @endif
                            </td>
                            <td class="text-center cell-image-blur">
                                <img src="{{ ($noticia->preview) ? $noticia->preview : asset('images/thumb-padrao.png') }}" width="150" height="60"
                                    style="object-fit: cover; border-radius: 4px">
                                <label for="input_preview_thumb_{{ $noticia->id }}">
                                    <i class="fas fa-edit text-white cpointer" style="font-size: 14px; position: absolute; top: calc(50% - 7px); left: calc(50% - 7px);"></i>
                                </label>
                                <input id="input_preview_thumb_{{ $noticia->id }}" style="display: none;" type="file" wire:model="thumbs.{{ $noticia->id }}" accept="image/*">
                            </td>
                            <td class="text-center cell-image-blur">
                                <img src="{{ ($noticia->banner) ? $noticia->banner : asset('images/thumb-padrao.png') }}" width="150" height="60"
                                    style="object-fit: cover; border-radius: 4px">
                                <label for="input_preview_banner_{{ $noticia->id }}">
                                    <i class="fas fa-edit text-white cpointer" style="font-size: 14px; position: absolute; top: calc(50% - 7px); left: calc(50% - 7px);"></i>
                                </label>
                                <input id="input_preview_banner_{{ $noticia->id }}" style="display: none;" type="file" wire:model="banners.{{ $noticia->id }}" accept="image/*">
                            </td>
                            <td class="">
                                <h5 class="text-primary"><a
                                        onclick="editar({{ $noticia->id }})">{{ $noticia->titulo }}</a></h5>
                                <p class="mb-1">
                                    <i class='bx bxs-purchase-tag'></i>
                                    {{ $noticia->categoria->nome }}
                                </p>
                                <p>
                                    <i class='bx bxs-user'></i>
                                    {{ $noticia->autor }}
                                </p>
                            </td>
                            <td>
                                {{ date('d/m/Y', strtotime($noticia->publicacao)) }}
                            </td>


                            <td class="text-center" style="vertical-align: middle;">
                                <div class="dropdown mt-4 mt-sm-0">
                                    <a href="#" class="dropdown-toggle" style="font-size: 14px; color: #d9a863"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-bars" {{--  data-bs-placement="top" title="Opções" --}}></i>
                                    </a>
                                    <div class="dropdown-menu" style="margin: 0px;">

                                        {{-- <a class="dropdown-item py-2 c-pointer"
                                            style="display: flex; align-content: center; justify-content: flex-start; gap: 5px"
                                             target="_blank" .>
                                            <i class="fas fa-eye pe-1"></i>
                                            Visualizar</a> --}}


                                        @if ($noticia->publicada)
                                            <a class="dropdown-item py-2" role="button" style="color: red;"
                                                wire:click='publicar({{ $noticia->id }})'>
                                                <i class="fas fa-lock-open pe-1"></i> Não
                                                Publicar</a>
                                        @else
                                            <a class="dropdown-item py-2" role="button" style="color: green;"
                                                wire:click='publicar({{ $noticia->id }})'>
                                                <i class="fas fa-lock pe-1"></i>
                                                Publicar</a>
                                        @endif

                                        <a class="dropdown-item py-2" role="button"
                                            onclick="Livewire.emit('abreModalEdicao', {{ $noticia->id }})">
                                            <i class="bx bx-edit-alt pe-1"></i>
                                            Editar</a>


                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item cpointer"
                                            wire:click='excluirNoticia({{ $noticia->id }})'>
                                            <i data-bs-dismiss="modal" aria-label="Close" class="fas fa-times pe-1"></i>
                                            Excluir
                                        </a>


                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row row-paginacao">
                {!! $noticias->links() !!}
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

                    <div class="mb-3">
                        <label for="titulo">Título da Notícia</label>
                        <input id="titulo" name="titulo" type="text" class="form-control" wire:model='filtro_titulo'>
                    </div>

                    <div class="mb-3">
                        <label for="titulo">Categoria</label>
                        <select name="cursos" class="form-control" id="cursos" wire:model='filtro_categoria'>
                            <option value="-1">Selecione uma categoria</option>
                            @foreach (\App\Models\Categoria::all() as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="titulo">Autor</label>
                        <input id="titulo" name="titulo" type="text" class="form-control" wire:model='filtro_autor'>
                    </div>

                    <div class="mb-3">

                        <div class="row">
                            <div class="col-6">
                                <label for="">Início</label>
                                <input type="date" class="form-control" wire:model="filtro_publicacao_inicio">
                            </div>
                            <div class="col-6">
                                <label for="">Fim</label>
                                <input type="date" class="form-control" wire:model="filtro_publicacao_fim">
                            </div>
                        </div>
                    </div>
                </form>

                <div class="button-row">

                    <div class="row">
                        <div class="col">
                            <button id="btn-filtrar" type="button" class="btn  btn-success waves-effect waves-light"
                                style="width: 100%;" wire:click="setFiltros">
                                <i class="bx bx-check-double font-size-16  align-middle me-2"></i> Filtrar
                            </button>

                        </div>

                        <div class="col">
                            <button id="btn-limpar" type="button" class="btn btn-danger  waves-effect waves-light"
                                style="width: 100%;" wire:click="limpaFiltros">
                                <i class="bx bx-block font-size-16 align-middle me-2 "></i> Limpar
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>





        <div class="col-sm-12 col-md-6 mb-3  bg-thirdy" style=" border-radius: 5px; width: 100%;">
            <a class="btn"
                style="line-height: 29px;padding-left: 21px; color: white; height: 100%; cursor: default; "
                href="">Categorias</a>
            <a class="btn" style=" color: white; height: 90%; float: right;"
                onclick="Livewire.emit('abreModalCadastroCategoria')">
                <i class="bx bx-plus h2 text-white p-0" aria-hidden="true"></i> </a>
        </div>
        <div class="card filter-body">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 px-0">
                        <table class="niv-table reduced" style="width: 100%;">
                            <tbody>

                                @foreach (\App\Models\Categoria::all() as $categoria)
                                    <tr>
                                        <td>
                                            <p class="m-0">{{ $categoria->nome }}</p>
                                        </td>

                                        <td class="text-center vertical-center">
                                            <i  data-bs-placement="top" title="Editar"
                                                class="c-pointer bx bx-edit h4 m-0"
                                                onclick="Livewire.emit('abreModalEdicaoCategoria', {{ $categoria->id }})"></i>
                                            <i  data-bs-placement="top" title="Remover"
                                                class="c-pointer fas fa-times h4 m-0 ms-3" style="color: red;"
                                                wire:click="excluirCategoria({{ $categoria->id }})"></i>
                                        </td>
                                    </tr>
                                @endforeach


                                <tr class="add">
                                    <td colspan="5" class="text-center p-0">
                                        <a onclick="Livewire.emit('abreModalCadastroCategoria')">
                                            <!-- Generator: Adobe Illustrator 19.0.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
                                            <svg version="1.1" id="Capa_1" height="24" width="24"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                viewBox="0 0 490 490" style="enable-background:new 0 0 490 490;"
                                                xml:space="preserve">
                                                <g>
                                                    <path fill="#d9a863"
                                                        d="M227.8,174.1v53.7h-53.7c-9.5,0-17.2,7.7-17.2,17.2s7.7,17.2,17.2,17.2h53.7v53.7c0,9.5,7.7,17.2,17.2,17.2
                                                                                                                                                                                                                                                                            s17.1-7.7,17.1-17.2v-53.7h53.7c9.5,0,17.2-7.7,17.2-17.2s-7.7-17.2-17.2-17.2h-53.7v-53.7c0-9.5-7.7-17.2-17.1-17.2
                                                                                                                                                                                                                                                                            S227.8,164.6,227.8,174.1z" />
                                                    <path fill="#d9a863"
                                                        d="M71.7,71.7C25.5,118,0,179.5,0,245s25.5,127,71.8,173.3C118,464.5,179.6,490,245,490s127-25.5,173.3-71.8
                                                                                                                                                                                                                                                                            C464.5,372,490,310.4,490,245s-25.5-127-71.8-173.3C372,25.5,310.5,0,245,0C179.6,0,118,25.5,71.7,71.7z M455.7,245
                                                                                                                                                                                                                                                                            c0,56.3-21.9,109.2-61.7,149s-92.7,61.7-149,61.7S135.8,433.8,96,394s-61.7-92.7-61.7-149S56.2,135.8,96,96s92.7-61.7,149-61.7
                                                                                                                                                                                                                                                                            S354.2,56.2,394,96S455.7,188.7,455.7,245z" />
                                                </g>
                                            </svg>
                                        </a>

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
