@extends("templates.main")

@section('titulo', 'Dashboard')

@section('conteudo')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Total Associados</h5>
                    <h2>{{ $totalAssociados ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Total Leads</h5>
                    <h2>{{ $totalLeads ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Total Usuários</h5>
                    <h2>{{ $totalUsuarios ?? 0 }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5>Visitas (7 dias)</h5>
                    <h2>{{ array_sum($visitasPorDia ?? []) }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Associados (últimos 6 meses)</h4>
                    <div style="height:250px; max-height:350px;">
                        <canvas id="associadosChart" style="width:100%; height:100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Leads (últimos 6 meses)</h4>
                    <div style="height:250px; max-height:350px;">
                        <canvas id="leadsChart" style="width:100%; height:100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Usuários</h4>
                    <div style="height:220px; max-height:300px; width:220px; margin:0 auto;">
                        <canvas id="usuariosChart" style="width:100%; height:100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function () {
            const months = {!! json_encode($months ?? []) !!}.map(m => {
                const parts = m.split('-');
                return parts[1] + '/' + parts[0].slice(2);
            });

            // Associados - linha
            const ctxAssoc = document.getElementById('associadosChart');
            if (ctxAssoc) {
                new Chart(ctxAssoc.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Associados',
                            data: {!! json_encode($associadosData ?? []) !!},
                            backgroundColor: 'rgba(75,192,192,0.2)',
                            borderColor: 'rgba(75,192,192,1)',
                            tension: 0.3,
                            fill: true
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: true }
                });
            }

            // Leads - barras
            const ctxLeads = document.getElementById('leadsChart');
            if (ctxLeads) {
                new Chart(ctxLeads.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: [{
                            label: 'Leads',
                            data: {!! json_encode($leadsData ?? []) !!},
                            backgroundColor: 'rgba(54,162,235,0.6)',
                            borderColor: 'rgba(54,162,235,1)',
                            borderWidth: 1
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: true }
                });
            }

            // Usuários - pizza
            const ctxUsers = document.getElementById('usuariosChart');
            if (ctxUsers) {
                new Chart(ctxUsers.getContext('2d'), {
                    type: 'pie',
                    data: {
                        labels: ['Ativos', 'Inativos'],
                        datasets: [{
                            data: [{!! json_encode($ativos ?? 0) !!}, {!! json_encode($inativos ?? 0) !!}],
                            backgroundColor: ['#28a745', '#dc3545']
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: true }
                });
            }
        })();
    </script>
@endsection