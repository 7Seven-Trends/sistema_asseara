<div class="row">
    <div class="col-12">
        <div class="card px-3 p-3">
            <table class="table" style="width: 100%; vertical-align: middle;">
                <thead>
                    <tr>
                        <th style="width: 20%">Nome</th>
                        <th style="width: 15%">E-mail</th>
                        <th style="width: 10%">Data</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($newsletters as $newsletter)
                        <tr>
                            <td class="">
                                {{ $newsletter->nome }}
                            </td>
                            <td class="">
                                {{ $newsletter->email }}
                            </td>
                            <td class="">
                                {{ date('d/m/Y H:i:s', strtotime($newsletter->created_at)) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row row-paginacao">
                {!! $newsletters->links() !!}
            </div>
        </div>
    </div> <!-- end col -->
</div>
