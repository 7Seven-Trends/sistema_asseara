<div class="row">
    <div class="col-9">
        <div class="card">
            <table class="table" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="" style="width: 5%">Publicada</th>
                        <th class="" style="width: 15%"><i class="bx bxs-image text-white"></i></th>
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
                            <td class="text-center">
                                <img src="{{ $noticia->preview }}" width="150" height="60"
                                    style="object-fit: cover; border-radius: 4px">
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

                                        <a class="dropdown-item py-2 c-pointer"
                                            style="display: flex; align-content: center; justify-content: flex-start; gap: 5px"
                                            {{-- href="{{route('site.turma', ['turma' => $turma])}}" --}} target="_blank" .>
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                <path fill="000000"
                                                    d="M160 256C160 185.3 217.3 128 288 128C358.7 128 416 185.3 416 256C416 326.7 358.7 384 288 384C217.3 384 160 326.7 160 256zM288 336C332.2 336 368 300.2 368 256C368 211.8 332.2 176 288 176C287.3 176 286.7 176 285.1 176C287.3 181.1 288 186.5 288 192C288 227.3 259.3 256 224 256C218.5 256 213.1 255.3 208 253.1C208 254.7 208 255.3 208 255.1C208 300.2 243.8 336 288 336L288 336zM95.42 112.6C142.5 68.84 207.2 32 288 32C368.8 32 433.5 68.84 480.6 112.6C527.4 156 558.7 207.1 573.5 243.7C576.8 251.6 576.8 260.4 573.5 268.3C558.7 304 527.4 355.1 480.6 399.4C433.5 443.2 368.8 480 288 480C207.2 480 142.5 443.2 95.42 399.4C48.62 355.1 17.34 304 2.461 268.3C-.8205 260.4-.8205 251.6 2.461 243.7C17.34 207.1 48.62 156 95.42 112.6V112.6zM288 80C222.8 80 169.2 109.6 128.1 147.7C89.6 183.5 63.02 225.1 49.44 256C63.02 286 89.6 328.5 128.1 364.3C169.2 402.4 222.8 432 288 432C353.2 432 406.8 402.4 447.9 364.3C486.4 328.5 512.1 286 526.6 256C512.1 225.1 486.4 183.5 447.9 147.7C406.8 109.6 353.2 80 288 80V80z" />
                                            </svg>
                                            Visualizar</a>


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
                                            <?xml version="1.0" encoding="iso-8859-1"?>
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
