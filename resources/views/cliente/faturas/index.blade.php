@extends('painel.padrao')
@section('content')
    <br>
    <br>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="box ">
                    <div class="box-header">
                        <h5 class="box-title">PAGAMENTO UNICO</h5>
                    </div>
                    <div class="box-body">
                        @php
                            $saldo = Auth::user()->creditos->sum('valor');
                            $controle = 12;
                            $sobra = 0;
                        @endphp
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>

                                        <th>Plano</th>
                                        <th>Mês</th>
                                        <th>Valor</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if (count(Auth::user()->creditos) > 0)
                                        @if (Auth::user()->abertas()->sum('valor') > 0)
                                            @if (number_format(
    Auth::user()->abertas()->sum('valor'),
    2,
    ',',
    '.',
) != number_format(Auth::user()->creditos->last()->valor, 2, ',', '.'))
                                                <tr>
                                                    <td>{{ Auth::user()->assinaturas->last()->plano->name }}</td>
                                                    <td>PAGAMENTO UNICO</td>
                                                    <td>R$ {{ Auth::user()->abertas()->sum('valor') }}</td>
                                                    <td> PENDENTE</td>
                                                    <td>
                                                        <button onclick="newTab('{{ url('pagamento/unico') }}')"
                                                            class="btn btn-danger">PAGAR PLANO</button>
                                                    </td>
                                                </tr>
                                            @else
                                            @endif
                                        @endif
                                    @endif
                                    @forelse (Auth::user()->creditos as $credito)
                                        <tr>
                                            <td>{{ $credito->plano->name }}</td>
                                            <td>PAGAMENTO UNICO</td>
                                            <td> R${{ number_format($credito->valor, 2, ',', '.') }}</td>


                                            <td>{{ $credito->status_formated }}</td>

                                            <td>

                                                @if ($credito->status == 0)
                                                    <button
                                                        onclick="newTab('{{ url('cliente/pagarcredito', $credito->id) }}')"
                                                        class="btn btn-danger btn-block">PAGAR PLANO</button>
                                                @else
                                                    <button onclick="newTab('{{ url('#') }}')"
                                                        class="btn btn-primary btn-block">PAGA</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty

                                        @if (count(Auth::user()->assinaturas))
                                            <tr>
                                                <td>{{ Auth::user()->assinaturas->last()->plano->name }}</td>
                                                <td>PAGAMENTO UNICO</td>
                                                <td>R$ {{ Auth::user()->abertas()->sum('valor') }}</td>
                                                <td> PENDENTE</td>
                                                <td>
                                                    <button onclick="newTab('{{ url('pagamento/unico') }}')"
                                                        class="btn btn-danger">PAGAR PLANO</button>
                                                </td>
                                            </tr>
                                        @else
                                        @endif
                                    @endforelse




                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box ">
                    <div class="box-header">
                        <h5 class="box-title">Faturas</h5>

                    </div>



                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Plano</th>
                                        <th>Mês</th>
                                        <th>Valor</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse (Auth::user()->assinaturas as $assinatura)
                                        <tr>
                                            <td>{{ $assinatura->id }}</td>
                                            <td>{{ $assinatura->plano->name }}</td>
                                            <td>{{ Carbon\Carbon::create($assinatura->fim)->locale('pt_BR')->isoFormat('D-MMMM-Y') }}
                                            </td>
                                            <td>


                                                R${{ number_format($assinatura->valor, 2, ',', '.') }}

                                            </td>
                                            <td>{{ $assinatura->status_formated }}</td>
                                            <td>

                                                @if ($assinatura->status)
                                                    @if ($assinatura->valor == 0)
                                                        <a target="" href=""
                                                            class="btn btn-primary btn-block">CORTESIA</a>
                                                    @else
                                                        <a target="_blank" href="{{ url('gerarreecibo/00709376') }}"
                                                            class="btn btn-primary">GERAR RECIBO</a>
                                                    @endif
                                                @else
                                                    <a target="_blank"
                                                        href="{{ url('cliente/pagarplano', $assinatura->id) }}"
                                                        class="btn btn-danger btn-block">PAGAR PLANO</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()


@section('js')
    <script>
        function newTab(url) {
            window.open(url, '_blank');
            setTimeout(reload, 5000);
        }


        function reload() {
            document.location.reload();
        }
    </script>
@endsection
