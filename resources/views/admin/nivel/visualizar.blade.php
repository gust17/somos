@extends('painel.padrao')

@section('content')
    <br>
    <br>
    <div class="container">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Usuarios por Nivel {{ $meta->name }}</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>CPF</th>
                            <th>Data</th>
                            <th>Ações</th>


                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($usuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->name }}</td>
                                <td>{{ $usuario->cpf }}</td>
                                <td>{{$usuario->updated_at->format('d/m/Y')}}</td>

                                <td>
                                    @if ($usuario->getStatusPremioAttribute($meta->id) == 0)
                                        <a href="{{ url('admin/entrega/premio/user/' . $usuario->id . '/meta/' . $meta->id) }}"
                                            class="btn btn-warning">Enviar Prêmio</a>
                                    @else
                                        <button class="btn btn-primary">Prêmio Entregue</button>
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
@endsection
