<div class="row">
    <div class="col-12">
        <div class="card">
            <table class="table" style="width: 100%; vertical-align: middle;">
                <thead>
                    <tr>
                        <th class="" style="width: 15%"><i class="bx bxs-image text-black mr-2"></i> Icone</th>
                        {{-- <th class="" style="width: 15%"><i class="bx bxs-image text-black mr-2"></i> Banner</th> --}}
                        <th class="" style="width: 20%">Nome</th>
                        {{-- <th class="" style="width: 40%">Conteúdo</th> --}}
                        <th class="text-center" style="width: 10%"></th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($servicos as $servico)
                        <tr>
                            <td class="text-center cell-imagem-blur" style="position: relative;">
                                <img src="{{ $servico->icone ? $servico->icone : asset('images/sem-foto.jpg') }}"
                                    width="80" height="80" style="object-fit: cover;">
                                <label for="input_preview_{{ $servico->id }}">
                                    <i class="fas fa-edit text-white cpointer"
                                        style="font-size: 14px; position: absolute; top: calc(50% - 7px); left: calc(50% - 7px);"></i>
                                </label>
                                <input id="input_preview_{{ $servico->id }}" style="display: none;" type="file"
                                    wire:model="icons.{{ $servico->id }}" accept="image/*">
                            </td>
                            
                            {{-- <td class="text-center cell-imagem-blur" style="position: relative;">
                                <img src="{{ $servico->banner ? $servico->banner : asset('images/sem-foto.jpg') }}"
                                    width="130" height="80" style="object-fit: cover;">
                                <label for="input_banner_{{ $servico->id }}">
                                    <i class="fas fa-edit text-white cpointer"
                                        style="font-size: 14px; position: absolute; top: calc(50% - 7px); left: calc(50% - 7px);"></i>
                                </label>
                                <input id="input_banner_{{ $servico->id }}" style="display: none;" type="file"
                                    wire:model="banners.{{ $servico->id }}" accept="image/*">
                            </td> --}}


                            <td class="">
                                <h5 class="text-primary"><a>{{ $servico->nome }}</a></h5>
                            </td>

                            {{-- <td class="">
                                <p>{{ $servico->conteudo }}</p>
                            </td> --}}


                            <td class="text-center" style="vertical-align: middle;">
                                <div class="dropdown mt-4 mt-sm-0">
                                    <a href="#" class="dropdown-toggle" style="font-size: 14px; color: #d9a863"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-bars" {{--  data-bs-placement="top" title="Opções" --}}></i>
                                    </a>
                                    <div class="dropdown-menu" style="margin: 0px;">
                                        <a class="dropdown-item py-2" role="button"
                                            onclick="Livewire.emit('carregaModalEdicaoServicos', {{ $servico->id }})">
                                            <i class="bx bx-edit-alt pe-1"></i>
                                            Editar</a>
                                        <a class="dropdown-item py-2 " role="button"
                                            wire:click="ativar({{ $servico->id }})">
                                            <i class="bx bx bx-toggle-left pe-1"></i>
                                            {{ $servico->ativo ? 'Inativar' : 'Ativar' }}
                                        </a>
                                        <a class="dropdown-item py-2 text-danger" role="button"
                                            wire:click="excluir({{ $servico->id }})">
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
                {!! $servicos->links() !!}
            </div>
        </div>
    </div> <!-- end col -->
</div>
