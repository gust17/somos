@extends('painel.padrao')

@section('content')

<br>
<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">CAIXA DA EMPRESA</h3>
        </div>

        <div class="panel-body">
            <table id="myTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOME</th>
                        <th>EMAIL</th>
                        <th>PATROCINADOR</th>
                        <th>TELEFONE</th>



                    </tr>
                </thead>
                <tbody>
                    @forelse ($interesses as $caixa)
                        <tr>
                            <td>{{ $caixa->id }}</td>
                            <td>{{ $caixa->user->name }}</td>
                            <td>{{ $caixa->user->email }}</td>
                            <td>{{ $caixa->user->meindica }}</td>
                            <td>{{ $caixa->user->telefone }}</td>
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
            ],
            "ordering": false
        });
    </script>

@endsection

