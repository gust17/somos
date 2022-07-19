@extends('painel.padrao')

@section('content')
    <br>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-success">
                    <div class="box-header">
                        <h5 class="box-title">Total de Comissões</h5>

                    </div>


                    <div class="box-body text-center">
                        <h1>R${{ number_format(Auth::user()->sobra, 2, ',', '.') }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-danger">
                    <div class="box-header">
                        <h5 class="box-title">Total de Saques</h5>

                    </div>


                    <div class="box-body text-center">
                        <h1>R${{ number_format(Auth::user()->total_saque, 2, ',', '.') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="box box-success">
                    <div class="box-header">


                    </div>


                    <div class="box-body text-center">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>DESCRIÇÃO</th>
                                        <th>VALOR</th>
                                        <th>TIPO</th>
                                        <th>DATA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(Auth::user()->movimentos as $movimento)
                                        <tr>
                                            <td>{{ $movimento->id }}</td>
                                            <td>{{ $movimento->descricao }}</td>
                                            <td>{{ number_format($movimento->valor, 2, ',', '.') }}</td>
                                            <td>{{ $movimento->status_formated }}</td>
                                            <td>{{ $movimento->created_at->format('d-m-y') }}</td>
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
