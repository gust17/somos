@extends('painel.padrao')

@section('content')


    <div class="container">
        <br>
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('plano.create') }}" class="btn btn-warning btn-circle btn-lg"><i
                        class="fa fa-plus"></i></a>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-8">
                <div class="box ">
                    <div class="box-header">
                        <h3 class="box-title">Planos</h3>
                    </div>
                    <div class="box-body">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Valor</th>
                                <th>Ações</th>

                            </tr>
                            </thead>
                            <tbody>

                            @forelse ($planos as $plano)
                                <tr>
                                    <td>{{ $plano->name }}</td>
                                    <td>R$ {{number_format($plano->valor,2,',','.')}}</td>
                                    <td><a href="{{ route('plano.edit', $plano) }}" class="btn btn-success"><i
                                                class="fa fa-pencil"></i></a>
                                        <a href="{{ route('plano.show', $plano) }}" class="btn btn-primary"><i
                                                class="fa fa-eye"></i></a>

                                    </td>

                                </tr>
                            @empty
                                <p>Vazio</p>
                            @endforelse


                            </tbody>
                        </table>


                    </div>
                </div>
            </div>


        </div>

    </div>

@endsection
