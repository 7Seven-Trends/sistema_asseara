<table>
    {{-- <thead>
        <tr>
            <td colspan="2"><b>Relação de Associados</b></td>
        </tr>
    </thead> --}}
    <tbody>
        {{-- <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr> --}}
        <tr>
            {{-- <td>FOTO</td> --}}
            <td>SEQ.</td>
            <td>NOME</td>
            <td>INSCRITO DESDE</td>
            <td>MODALIDADE</td>
            <td>TITULO</td>
            <td>CPF</td>
            <td>RNP</td>
            <td>NASCIMENTO</td>
            <td>EMAIL</td>
            <td>TELEFONE</td>
            <td>CONSELHO</td>
            <td>ENDERECO</td>
            <td>CIDADE</td>
            <td>UF</td>
            <td>CEP</td>
            <td>PAIS</td>
            <td>SITUACAO</td>
        </tr>
        @foreach ($associados as $associado)
            <tr>
                {{-- <td><img src="{{ $associado->foto }}" alt=""></td> --}}
                <td>{{ $associado->id }}</td>
                <td>{{ $associado->nome }}</td>
                <td>
                    {{ date('d-m-Y G:i:s', strtotime($associado->created_at)) }}
                </td>
                <td>
                    @if ($associado->modalidade !== null)
                        {{ config('associados.modalidades')[$associado->modalidade] }}
                    @endif
                </td>
                <td>
                    @if ($associado->titulo_profissional !== null)
                        {{ config('associados.titulis')[$associado->titulo_profissional] }}
                    @endif
                </td>
                <td>{{ $associado->cpf }}</td>
                <td>{{ $associado->registro_profissional }}</td>
                <td>
                    @if ($associado->nascimento)
                        {{ date('d-m-Y', strtotime($associado->nascimento)) }}
                    @endif
                </td>
                <td>{{ $associado->email }}</td>
                <td>{{ $associado->telefone }}</td>
                <td>{{ config('associados.conselhos')[$associado->conselho_profissional] }}</td>
                <td>{{ $associado->endereco_atendimento }}</td>
                <td>{{ $associado->cidade_atendimento }}</td>
                <td>{{ $associado->uf_atendimento }}</td>
                <td>{{ $associado->cep_atendimento }}</td>
                <td>{{ $associado->pais_atendimento }}</td>
                <td>{{ config('associados.situacoes')[$associado->situacao] }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
