@extends('painel.padrao')

@section('content')
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ url('admin/saque') }}" class="btn btn-warning btn-circle btn-lg"><i
                        class="fa fa-angle-left"></i> Voltar</a>

            </div>
        </div>

    </div>

    <br>
    <div class="container">


        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">VISUALIZAR SAQUE</h3>
            </div>
        </div>

        <div class="panel">
            <div class="panel-heading">
                <h3>Dados Para Pagamento</h3>
            </div>
            <div class="panel-body">
                <table id="myTable" class="table table-striped">

                    <tbody>
                    <tr>
                        <td>NOME</td>
                        <td>{{$saque->user->name}}</td>

                    </tr>
                    <tr>
                        <td>CPF</td>
                        <td>{{$saque->user->cpf}}</td>

                    </tr>
                    @forelse($saque->user->contas as $conta)
                        <tr>
                            <td>Banco</td>
                            <td>{{$conta->name}}</td>
                        </tr>
                        <tr>
                            <td>Cod. Banco</td>
                            <td>{{$conta->code}}</td>

                        </tr>

                        <tr>
                            <td>Agencia</td>
                            <td>{{$conta->agencia}}</td>

                        </tr>
                        <tr>
                            <td>Conta</td>
                            <td>{{$conta->conta}}</td>
                        </tr>

                    @empty



                    @endforelse
                    <tr>
                        <td>Valor Solicitado</td>
                        <td>R$ {{number_format($saque->valor,2,',','.')}}</td>
                    </tr>


                    </tbody>
                </table>
                <a href="{{url('pagar/saque',$saque->id)}}" class="btn btn-success btn-rounded btn-block">Pagar</a>
            </div>
        </div>
    </div>
@endsection
