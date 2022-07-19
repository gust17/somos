@extends('painel.padrao')

@section('content')
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Adicionar Conta</h4>
                </div>
                <div class="modal-body">
                    <form action="{{ url('admin/cadconta') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="">Selecione um Banco</label>
                            <select class="form-control js-example-basic-single" name="banco_id" id="cmbPais">
                                <option value=""></option>
                            </select>
                        </div>
                        <input type="hidden" name="name">
                        <div class="form-group">
                            <label for="">Cod Banco</label>
                            <input type="text" id="code" name="code" class="form-control">
                        </div>
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label for="">Agencia com digito</label>
                            <input type="text" id="agencia" name="agencia" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Conta com digito</label>
                            <input type="text" id="conta" name="conta" class="form-control">
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success btn-block">Cadastrar</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <br>
            <div class="col-md-12">
                <a href="{{ url('admin/users') }}" class="btn btn-warning btn-circle btn-lg"><i
                        class="fa fa-angle-left"></i></a>

            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-lg-8">
                <div class="panel ">
                    <div class="panel-heading">

                        <h3 class="panel-title">Editar Usuario</h3>
                    </div>
                    <div class="panel-body">

                        <form class="form-horizontal" action="{{ url('admin/user/edit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="col-sm-2" for="">Nome</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2" for="">EMail</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="email" name="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <div class="form-group">
                                <label class="col-sm-2" for="">CPF</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="cpf" value="{{ $user->cpf }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2" for="">Telefone</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="text" name="telefone"
                                        value="{{ $user->telefone }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2" for="">Data de Nascimento</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="date" name="nascimento"
                                        value="{{ $user->nascimento }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2" for="">Setor</label>
                                <div class="col-sm-10">
                                    <select name="tipo" id="" class="form-control">
                                        <option value=""></option>
                                        <option @if ($user->tipo == 0)
                                            selected
                                            @endif value="0">Cliente</option>
                                        <option @if ($user->tipo == 1)
                                            selected
                                            @endif value="1">Administrador</option>
                                        <option @if ($user->tipo == 2)
                                            selected
                                            @endif value="2">Financeiro</option>
                                        <option @if ($user->tipo == 3)
                                            selected
                                            @endif value="3">Suporte</option>



                                    </select>
                                </div>
                            </div>
                            @if ($user->endereco)
                                <div class="form-group">
                                    <label for="cep" class="col-sm-2">CEP</label>

                                    <div class="col-sm-10">
                                        <input type="text" value="{{ $user->endereco->cep }}" class="form-control"
                                            name="cep" id="cep" placeholder="cep">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="endereco" class="col-sm-2">Endereço</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="{{ $user->endereco->endereco }}" name="endereco"
                                            class="form-control" id="endereco">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="endereco" class="col-sm-2">Bairro</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="bairro" value="{{ $user->endereco->bairro->name }}"
                                            class="form-control" id="bairro">
                                    </div>
                                </div>

                                <input type="hidden" name="cliente_id" value="{{ $user->id }}">
                                <div class="form-group">
                                    <label for="endereco" class="col-sm-2">Cidade</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="cidade" value="{{ $user->endereco->cidade->name }}"
                                            class="form-control" id="cidade">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="uf" class="col-sm-2">UF</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="uf" value="{{ $user->endereco->estado->name }}"
                                            class="form-control" id="uf">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="n" class="col-sm-2">N</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="n" value="{{ $user->endereco->n }}"
                                            class="form-control" id="n">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="complemento" class="col-sm-2">Complemento</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="complemento" value="{{ $user->endereco->complemento }}"
                                            class="form-control" id="complemento">
                                    </div>
                                </div>
                            @else


                                @csrf
                                <div class="form-group">
                                    <label for="cep" class="col-sm-2">CEP</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="cep" id="cep" placeholder="cep">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="endereco" class="col-sm-2">Endereço</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="endereco" class="form-control" id="endereco">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="endereco" class="col-sm-2">Bairro</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="bairro" class="form-control" id="bairro">
                                    </div>
                                </div>

                                <input type="hidden" name="cliente_id" value="{{ $user->id }}">
                                <div class="form-group">
                                    <label for="endereco" class="col-sm-2">Cidade</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="cidade" class="form-control" id="cidade">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="uf" class="col-sm-2">UF</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="uf" class="form-control" id="uf">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="n" class="col-sm-2">N</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="n" class="form-control" id="n">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="complemento" class="col-sm-2">Complemento</label>

                                    <div class="col-sm-10">
                                        <input type="text" name="complemento" class="form-control" id="complemento">
                                    </div>
                                </div>



                            @endif


                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button class="btn btn-success btn-block">Salvar</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>


        </div>


    </div>
@endsection
@section('js')
    <script>
        $("#cep").change(function() {

            var valor = document.getElementById('cep').value;

            // alert(valor);
            $.ajax({
                type: 'GET',
                url: 'https://viacep.com.br/ws/' + valor + '/json/',

                success: function(data) {
                    var names = data.bairro
                    $('input[name="endereco"]').val(data.logradouro);
                    $('input[name="bairro"]').val(data.bairro);
                    $('input[name="cidade"]').val(data.localidade);
                    $('input[name="uf"]').val(data.uf);
                    //alert(names);
                    // $('#cand').html(data);
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

            $('.js-example-basic-single').select2();
            $.ajax({
                type: 'GET',
                url: 'https://brasilapi.com.br/api/banks/v1',

                success: function(dados) {

                    if (dados.length > 0) {
                        var option = '<option>Selecione seu banco</option>';
                        $.each(dados, function(i, obj) {
                            option += '<option value="' + obj.code + '">' + obj.name +
                                '</option>';
                        })
                        $('#mensagem').html('<span class="mensagem">Total de paises encontrados.: ' +
                            dados.length + '</span>');
                        $('#cmbPais').html(option).show();
                    } else {
                        Reset();
                        $('#mensagem').html(
                            '<span class="mensagem">Não foram encontrados paises!</span>');
                    }
                }
            });
            $("#cmbPais").change(function() {

                var valor = document.getElementById('cmbPais').value;

                //  alert(valor);
                // alert(valor);
                $.ajax({
                    type: 'GET',
                    url: 'https://brasilapi.com.br/api/banks/v1/' + valor,

                    success: function(data) {
                        // alert(data.code);
                        $('input[name="code"]').val(data.code);
                        $('input[name="name"]').val(data.name);
                    }
                });
            });

            $("#cep").change(function() {

                var valor = document.getElementById('cep').value;

                // alert(valor);
                $.ajax({
                    type: 'GET',
                    url: 'https://viacep.com.br/ws/' + valor + '/json/',

                    success: function(data) {
                        var names = data.bairro
                        $('input[name="endereco"]').val(data.logradouro);
                        $('input[name="bairro"]').val(data.bairro);
                        $('input[name="cidade"]').val(data.localidade);
                        $('input[name="uf"]').val(data.uf);
                        //alert(names);
                        // $('#cand').html(data);
                    }
                });
            });
        });
    </script>
@endsection
