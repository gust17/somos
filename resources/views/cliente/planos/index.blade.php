@extends('painel.padrao')
@section('css')
    <style>
        .boleado {
            border-radius: 25px;
        }

        .borda {
            border: 5px solid;
            border-color: #ffb100;
            background-color: transparent;
            border-radius: 25px;


        }

        .fundo {
            color: white;
            background-color: transparent;
        }

        h1 {
            font-size: 35px;
        }

    </style>
@endsection

@section('content')

    <div class="row">
        <div class="container">
            <div class="row row-flex">
                @forelse ($planos as $plano)
                    <div style="margin-top:30px" class="col- col-md-3">
                        <div id="selecionado{{ $plano->id }}" class="panel borda">
                            <div class="panel-body outro">
                                <h2 style="color: #ffb100" class="panel-title text-center">{{ $plano->name }}</h2>
                                <h6 style="color: white" class="descricao">

                                    @forelse ($plano->vantagems as $vantagem)
                                        <li style="font-size: 19px"> +{{ $vantagem->name }} </li>
                                    @empty
                                    @endforelse

                                </h6>

                            </div>
                            <div class="panel-footer text-center fundo">

                                <h4><s> de R$
                                        @if ($plano->id == 3)
                                            499,00
                                        @else
                                            {{ number_format($plano->valor * 2, 2, ',', '.') }}
                                        @endif

                                    </s></h4>
                                <h3> Por apenas </h3>
                                <h2> R${{ number_format($plano->valor, 2, ',', '.') }}/mês</h2>
                                <div class="d-grid gap-2">
                                    @if (count(Auth::user()->assinaturas) > 0 && Auth::user()->mes_ativo == 1)
                                        @if (Auth::user()->assinaturas()->first()->plano_id == $plano->id)
                                            <a class="btn btn-lg btn-success boleado btn-block" href="#">Seu Plano Atual</a>
                                        @else
                                            @if (Auth::user()->assinaturas()->first()->plano->valor < $plano->valor)
                                                <a class="btn btn-lg btn-success boleado btn-block"
                                                    href="{{ url('upgrade', $plano->id) }}">Upgrade Agora</a>
                                            @endif
                                        @endif
                                    @else
                                        <a style="background-color: #ffb100"
                                            class="btn btn-lg btn-success boleado btn-block"
                                            href="{{ url('assinatura', $plano->id) }}">Assine Agora</a>
                                    @endif


                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                @endforelse


            </div>
            <div class="row row-flex">
                @forelse ($extras as $plano)
                    <div style="margin-top:30px" class="col- col-md-3">
                        <div id="selecionado{{ $plano->id }}" class="panel borda">
                            <div class="panel-body outro">
                                <h2 style="color: #ffb100" class="panel-title text-center">{{ $plano->name }}</h2>
                                <h6 style="color: white" class="descricao">

                                    {!!$plano->descricao !!}
                                </h6>

                            </div>
                            <div class="panel-footer text-center fundo">

                                <h4><s> de R$
                                        @if ($plano->id == 3)
                                            499,00
                                        @else
                                            {{ number_format($plano->valor * 2, 2, ',', '.') }}
                                        @endif

                                    </s></h4>
                                <h3> Por apenas </h3>
                                <h2> R${{ number_format($plano->valor, 2, ',', '.') }}/mês</h2>
                                <div class="d-grid gap-2">

                                    <a style="background-color: #ffb100" class="btn btn-lg btn-success boleado btn-block"
                                        href="{{ url('conheca', $plano->id) }}">Conheça</a>



                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>

                @empty
                @endforelse


            </div>
        </div>
    </div>



@endsection


@section('js')
    <script>
        $(document).ready(function() {
            var heights = $(".intas").map(function() {
                    return $(this).height();
                }).get(),

                maxHeight = Math.max.apply(null, heights);

            $(".intas").height(maxHeight);
        });
    </script>
@endsection
