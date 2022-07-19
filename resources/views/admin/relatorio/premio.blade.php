@extends('painel.padrao')

@section('content')
    <br>
    <br>
    <div class="container">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Prêmios</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Nivel</th>
                            <th>Data</th>


                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($premios as $premio)
                            <tr>
                                <td>{{ $premio->user->name }}</td>
                                <td>{{ $premio->user->cpf }}</td>

                                <td>{{$premio->meta->name}}</td>
                                <td>{{$premio->created_at->format('d/m/Y')}}</td>

                            </tr>

                        @empty
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
