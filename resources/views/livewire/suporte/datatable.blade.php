<div class="row">
    <div class="col-12">
        <div class="card px-3 p-3">
            <table class="table" style="width: 100%; vertical-align: middle;">
                <thead>
                    <tr>
                        <th style="width: 20%">Nome</th>
                        <th style="width: 15%">Telefone</th>
                        <th style="width: 15%">E-mail</th>
                        <th style="width: 15%">Cidade</th>
                        <th style="width: 10%">Mensagem</th>
                        <th style="width: 10%">Data</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($mensagens as $mensagem)
                        <tr @if(!$mensagem->visualizada) style="background-color: rgba(255,0,0,0.1)" @else style="background-color: rgba(0,255,0,0.1)" @endif>
                            <td class="">
                                {{ $mensagem->nome }}
                            </td>
                            <td class="">
                                {{ $mensagem->telefone }}
                            </td>
                            <td class="">
                                {{ $mensagem->email }}
                            </td>
                            <td class="">
                                {{ $mensagem->cidade }}
                            </td>
                            <td class="">
                                <i class="fas fa-eye fa-lg cpointer" onclick="Livewire.emit('carregaModalMensagemSuporte', {{ $mensagem->id }})"></i>
                            </td>
                            <td class="">
                                {{ date('d/m/Y H:i:s', strtotime($mensagem->created_at)) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row row-paginacao">
                {!! $mensagens->links() !!}
            </div>
        </div>
    </div> <!-- end col -->
</div>
