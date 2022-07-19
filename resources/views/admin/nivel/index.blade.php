@extends('painel.padrao')
@section('content')
    <br>
    <br>

    <div class="container">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Total por Nivel</h3>
            </div>
            <div class="panel-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Plano</th>
                            <th>QTD</th>
                            <th>Ação</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($metas as $plano)
                            <tr>
                                <td>{{ $plano->name }}</td>
                                <td>{{ $plano->users_count }}</td>
                                <td><a href="{{ url('admin/ver/nivel', $plano->id) }}"
                                        class="btn btn-primary">Visualizar</a>
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
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf'
            ]
        });
    </script>
@endsection
