<div class="row">
    <div class="col-12">
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" class="form-control" wire:model.debounce.300ms="search" placeholder="Buscar associado">
            </div>
        </div>
        
        <div class="card">

            
            
            <table class="table" style="width: 100%; vertical-align: middle;">
                <thead>
                    <tr>
                        <th class="" style="width: 15%"><i class="bx bxs-image text-white"></i></th>
                        <th class="" style="width: 20%">Nome, Email, Telefone</th>
                        <th class="" style="width: 10%">CPF</th>
                        <th class="" style="width: 10%">Modalidade</th>
                        <th class="" style="width: 10%">Situação</th>
                        <th class="" style="width: 15%">Contrato</th>
                        <th class="text-center" style="width: 10%"></th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($associados as $associado)
                        <tr>
                            <td class="text-center">
                                <img src="{{ $associado->foto ? $associado->foto : asset('images/sem-foto.jpg') }}"
                                    width="80" height="80" style="object-fit: cover; border-radius: 50%">
                            </td>
                            <td class="">
                                <h5 class="text-primary"><a>{{ $associado->nome }}</a></h5>
                                <p class="mb-1">
                                    {{ $associado->email }}
                                </p>
                                <p class="mb-1">
                                    {{ $associado->telefone }}
                                </p>
                            </td>
                            <td>
                                {{ $associado->cpf }}
                            </td>
                            <td>
                                {{ $associado->modalidade ? config('associados.modalidades')[$associado->modalidade] : 'Sem modalidade' }}
                            </td>
                            <td>
                                <select class="form-control"
                                    onchange="Livewire.emit('atualizaValorAssociado', {{ $associado->id }}, 'situacao', this.value)">
                                    @foreach (config('associados.situacoes') as $key => $value)
                                        <option value="{{ $key }}"
                                            @if ($key == $associado->situacao) selected @endif>{{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <div class="w-100 d-flex align-items-center justify-content-start">
                                    <div>
                                        @if ($associado->contrato_ativo)
                                            De <b>{{ date('d/m/Y', strtotime($associado->contrato_ativo->inicio)) }}</b>
                                            até <b>{{ date('d/m/Y', strtotime($associado->contrato_ativo->fim)) }}</b>
                                        @else
                                            Sem Contrato Ativo
                                        @endif
                                    </div>
                                    <div>
                                        <a name="" id="" class="btn btn-primary btn-sm ms-3"
                                            role="button"
                                            @if (!$associado->contrato_ativo) onclick="Livewire.emit('carregaModalCadastroContrato', {{ $associado->id }})" @else onclick="Livewire.emit('carregaModalEdicaoContrato', {{ $associado->contrato_ativo->id }})" @endif><i
                                                class="fas fa-edit fa-md"></i></a>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center" style="vertical-align: middle;">
                                <div class="dropdown mt-4 mt-sm-0">
                                    <a href="#" class="dropdown-toggle" style="font-size: 14px; color: #d9a863"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-bars" {{--  data-bs-placement="top" title="Opções" --}}></i>
                                    </a>
                                    <div class="dropdown-menu" style="margin: 0px;">
                                        <a class="dropdown-item py-2" role="button"
                                            onclick="Livewire.emit('carregaModalEdicaoAssociado', {{ $associado->id }})">
                                            <i class="bx bx-edit-alt pe-1"></i>
                                            Editar</a>
                                        <a class="dropdown-item py-2 text-danger" role="button"
                                            wire:click="excluir({{ $associado->id }})">
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
                {!! $associados->links() !!}
            </div>
        </div>
    </div> <!-- end col -->
</div>
