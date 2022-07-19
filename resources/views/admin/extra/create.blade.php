@extends('painel.padrao')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{url('admin/extras')}}" class="btn btn-warning btn-circle btn-lg"><i class="fa fa-angle-left"></i></a>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-8">
                <div class="panel ">
                    <div class="panel-heading">Cadastrar Extra</div>
                    <div class="panel-body">

                        <form action="{{url('admin/extras/create')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nome</label>
                                <input type="text" name="name" class="form-control">
                            </div>


                            <div class="form-group">
                                <label for="">Descrição</label>
                                <textarea class="form-control" name="descricao" id="editor1" cols="30"
                                    rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success">Cadastrar</button>
                            </div>


                        </form>

                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('bower_components/ckeditor/ckeditor.js') }}"></script>

    <script>
        $(function() {
            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1')
            //bootstrap WYSIHTML5 - text editor

        })
    </script>
@endsection
