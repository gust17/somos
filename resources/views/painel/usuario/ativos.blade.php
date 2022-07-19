@extends('painel.padrao')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="" class="btn btn-warning btn-circle btn-lg"><i class="fa fa-plus"></i></a>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel ">
                    <div class="panel-heading">
                        <h3 class="panel-title">Usuarios Ativos</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped">
                                <thead>

                                    <tr>
                                        <th>Nome</th>
                                        <th>Patrocinador</th>
                                        <th>CPF</th>
                                        <th>Telefone</th>
                                        <th>Saldo</th>
                                        <th>Ações</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Patrocinador</th>
                                        <th>CPF</th>
                                        <th>Telefone</th>
                                        <th>Saldo</th>
                                        <th>Ações</th>
                                    </tr>
                                </tfoot>
                                <tbody>

                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                @if ($user->meindica)
                                                    {{ $user->meindica->name }}
                                                @else
                                                @endif
                                            </td>
                                            <td>{{ $user->cpf }}</td>
                                            <td>{{ $user->telefone }}</td>
                                            <td>R$ {{ number_format($user->sobra, 2, ',', '.') }}</td>
                                            <td><a href="{{ url('admin/user/edit', $user->id) }}"
                                                    class="btn btn-success btn-block">Editar</a>
                                                <a href="{{ url('admin/user/visualizar', $user->id) }}"
                                                    class="btn btn-primary btn-block">Visualizar</a>
                                                <a href="{{ url('admin/user/docs', $user->id) }}"
                                                    class="btn btn-default btn-block">Documentos</a>
                                                <a target="_blank" href="{{ url('admin/contrato', $user->id) }}"
                                                    class="btn btn-danger btn-block" href="">Contrato</a>


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

    </div>
@endsection
@section('js')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>

    <script>
        $('#myTable').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.11.4/i18n/pt_br.json'
            },
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "columns": [
                {
                    "searchable": true
                },
                {
                    "searchable": false
                },
                {
                    "searchable": true
                },
                {
                    "searchable": true
                },
                {
                    "searchable": false
                },
                {
                    "searchable": false
                },

            ]

        });
    </script>
@endsection
