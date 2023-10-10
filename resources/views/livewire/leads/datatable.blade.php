<div class="row">
    <div class="col-12">
        <div class="card px-3 p-3">
            <table class="table" style="width: 100%; vertical-align: middle;">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Mensagem</th>
                        <th>Data</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($leads as $lead)
                        <tr>
                            <td class="">{{ $lead->nome }}</td>
                            <td class="">{{ $lead->telefone }}</td>
                            <td class="">{{ $lead->email }}</td>
                            <td class="">{{ $lead->message }}</td>
                            <td class="">{{ date('d/m/Y H:i:s', strtotime($lead->created_at)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row row-paginacao">
                {!! $leads->links() !!}
            </div>
        </div>
    </div> <!-- end col -->
</div>
