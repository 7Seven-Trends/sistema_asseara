<table>
    <thead>
        <tr>
            <td colspan="2"><b>Relação de Associados</b></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>SEQ.</td>
            <td>NOME</td>
            <td>TITULO</td>
            <td>CPF</td>
            <td>RNP</td>
        </tr>
        @foreach($associados as $associado)
            <tr>
                <td>{{ $associado->id }}</td>
                <td>{{ $associado->nome }}</td>
                <td>@if($associado->titulo_profissional) {{ config("associados.titulis")[$associado->titulo_profissional] }} @endif</td>
                <td>{{ $associado->cpf }}</td>
                <td>{{ $associado->registro_profissional }}</td>
            </tr>
        @endforeach
    </tbody>
</table>