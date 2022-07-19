@extends('painel.padrao')

@section('content')
    <br><br>

    <div class="container">
        <div class="box collapsed-box">
            <div class="box-header">
                <h3 class="box-title"> Minha Conta</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">

                <div class="form-group">
                    <label for="">Nome:</label>
                    <label for="">{{ Auth::user()->name }}</label>
                </div>
                <div class="form-group">
                    <label for="">CPF/CNPJ:</label>
                    <label for="">{{ Auth::user()->cpf }}</label>
                </div>
                <div class="form-group">
                    <label for="">Email:</label>
                    <label for="">{{ Auth::user()->email }}</label>
                </div>
                <div class="form-group">
                    <label for="">Telefone:</label>
                    <label for="">{{ Auth::user()->telefone }}</label>
                </div>


            </div>
        </div>

        @if (!Auth::user()->endereco)
            <div class="box collapsed-box">
                <div class="box-header">
                    <h3 class="box-title"> Endereço</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">

                    <form action="{{ url('endereco') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label for="cep" class="col-sm-2 control-label">CEP</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="cep" id="cep" placeholder="cep">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="endereco" class="col-sm-2 control-label">Endereço</label>

                            <div class="col-sm-10">
                                <input type="text" name="endereco" class="form-control" id="endereco">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="endereco" class="col-sm-2 control-label">Bairro</label>

                            <div class="col-sm-10">
                                <input type="text" name="bairro" class="form-control" id="bairro">
                            </div>
                        </div>

                        <input type="hidden" name="cliente_id" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="endereco" class="col-sm-2 control-label">Cidade</label>

                            <div class="col-sm-10">
                                <input type="text" name="cidade" class="form-control" id="cidade">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="uf" class="col-sm-2 control-label">UF</label>

                            <div class="col-sm-10">
                                <input type="text" name="uf" class="form-control" id="uf">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="n" class="col-sm-2 control-label">N</label>

                            <div class="col-sm-10">
                                <input type="text" name="n" class="form-control" id="n">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="complemento" class="col-sm-2 control-label">Complemento</label>

                            <div class="col-sm-10">
                                <input type="text" name="complemento" class="form-control" id="complemento">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-12">
                                <button class="btn btn-primary btn-block">Cadastrar</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        @else
            <div class="box collapsed-box">
                <div class="box-header">
                    <h3 class="box-title"> Endereço</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <div class="box-body">

                    <form action="{{ url('alterendereco') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <label for="cep" class="col-sm-2 control-label">CEP</label>

                            <div class="col-sm-10">
                                <input type="text" value="{{ Auth::user()->endereco->cep }}" class="form-control"
                                    name="cep" id="cep" placeholder="cep">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="endereco" class="col-sm-2 control-label">Endereço</label>

                            <div class="col-sm-10">
                                <input type="text" value="{{ Auth::user()->endereco->endereco }}" name="endereco"
                                    class="form-control" id="endereco">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="endereco" class="col-sm-2 control-label">Bairro</label>

                            <div class="col-sm-10">
                                <input type="text" name="bairro" value="{{ Auth::user()->endereco->bairro->name }}"
                                    class="form-control" id="bairro">
                            </div>
                        </div>

                        <input type="hidden" name="cliente_id" value="{{ Auth::user()->id }}">
                        <div class="form-group">
                            <label for="endereco" class="col-sm-2 control-label">Cidade</label>

                            <div class="col-sm-10">
                                <input type="text" name="cidade" value="{{ Auth::user()->endereco->cidade->name }}"
                                    class="form-control" id="cidade">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="uf" class="col-sm-2 control-label">UF</label>

                            <div class="col-sm-10">
                                <input type="text" name="uf" value="{{ Auth::user()->endereco->estado->name }}"
                                    class="form-control" id="uf">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="n" class="col-sm-2 control-label">N</label>

                            <div class="col-sm-10">
                                <input type="text" name="n" value="{{ Auth::user()->endereco->n }}"
                                    class="form-control" id="n">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="complemento" class="col-sm-2 control-label">Complemento</label>

                            <div class="col-sm-10">
                                <input type="text" name="complemento" value="{{ Auth::user()->endereco->complemento }}"
                                    class="form-control" id="complemento">
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-sm-12">
                                <button class="btn btn-primary btn-block">Cadastrar</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        @endif

        <div class="box collapsed-box">
            <div class="box-header">
                <h3 class="box-title"> Dados Bancarios</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">


                <form action="{{ url('cadconta') }}" method="post">
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
                <br>

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Banco</th>
                            <th>Codigo</th>
                            <th>Agencia</th>
                            <th>Conta</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse(Auth::user()->contas as $conta)
                            <tr>
                                <td>{{ $conta->name }}</td>
                                <td>{{ $conta->code }}</td>
                                <td>{{ $conta->agencia }}</td>
                                <td>{{ $conta->conta }}</td>

                            </tr>

                        @empty
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>


        <div class="box collapsed-box">
            <div class="box-header">
                <h3 class="box-title"> Documentos</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>DOCUMENTO</th>
                            <th>ARQUIVO</th>


                        </tr>
                    </thead>
                    <tbody>

                        @forelse ($docs as $doc)
                            <tr>
                                <td>{{ $doc->name }}</td>
                                <td>

                                    @if (count(Auth::user()->anexos->where('doc_id', $doc->id)) > 0)
                                        <label for="">Frente</label>
                                        <a target="_blank"
                                            href="{{ url('arquivos',Auth::user()->anexos->where('doc_id', $doc->id)->first()->frente) }}">Vizualizar</a>

                                        @if ($doc->verso == 0)
                                        @else
                                            @if ($doc->verso == 1)
                                                @if (Auth::user()->anexos->where('doc_id', $doc->id)->first()->verso)
                                                    <br>
                                                    <label for="">Verso</label>
                                                    <a target="_blank"
                                                        href="{{ url('arquivos',Auth::user()->anexos->where('doc_id', $doc->id)->first()->verso) }}">Vizualizar</a>
                                                @else
                                                    <form method="post" action="{{ url('api/file-upload/frente') }}"
                                                        enctype="multipart/form-data">
                                                        <div class="col-md-6">
                                                            <label for="Frente">Verso</label>
                                                            <input type="file" name="file" id="file" />
                                                            <input type="hidden" name="possui" value="1">
                                                            <input type="hidden" name="doc_id" value="{{ $doc->id }}">
                                                        </div>
                                                        <input type="hidden" name="cliente_id"
                                                            value="{{ Auth::user()->id }}">
                                                        <div class="col-md-4">
                                                            <input type="submit" name="upload" value="Upload"
                                                                class="btn btn-success" />
                                                        </div>
                                                        <div class="col-md-12">
                                                            <small id="file-help" class="form-text text-muted"
                                                                tabindex="0">
                                                                <strong>Imagem da foto</strong> <br>
                                                                Tamanho máximo de cada anexo: 5MB.
                                                            </small>
                                                        </div>
                                                    </form>
                                                @endif
                                            @endif
                                        @endif

                                        <br>
                                        <label for="">Status:
                                            {{ Auth::user()->anexos->where('doc_id', $doc->id)->first()->status }}</label>
                                    @else
                                        <form method="post" action="{{ url('api/file-upload/frente') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">

                                                <div class="col-md-6">
                                                    <label for="Frente">Frente</label>
                                                    <input type="file" name="file" id="file" />
                                                    <input type="hidden" name="doc_id" value="{{ $doc->id }}">
                                                    <input type="hidden" name="possui" value="0">
                                                </div>
                                                <input type="hidden" name="cliente_id" value="{{ Auth::user()->id }}">
                                                <div class="col-md-4">
                                                    <input type="submit" name="upload" value="Upload"
                                                        class="btn btn-success" />
                                                </div>
                                                <div class="col-md-12">
                                                    <small id="file-help" class="form-text text-muted" tabindex="0">
                                                        <strong>Imagem da foto</strong> <br>
                                                        Tamanho máximo de cada anexo: 5MB.
                                                    </small>
                                                </div>
                                        </form>
                                        @if ($doc->verso == 1)
                                            <form method="post" action="{{ url('api/file-upload/frente') }}"
                                                enctype="multipart/form-data">
                                                <div class="col-md-6">
                                                    <label for="Frente">Verso</label>
                                                    <input type="file" name="file" id="file" />
                                                    <input type="hidden" name="possui" value="1">
                                                    <input type="hidden" name="doc_id" value="{{ $doc->id }}">
                                                </div>
                                                <input type="hidden" name="cliente_id" value="{{ Auth::user()->id }}">
                                                <div class="col-md-4">
                                                    <input type="submit" name="upload" value="Upload"
                                                        class="btn btn-success" />
                                                </div>
                                                <div class="col-md-12">
                                                    <small id="file-help" class="form-text text-muted" tabindex="0">
                                                        <strong>Imagem da foto</strong> <br>
                                                        Tamanho máximo de cada anexo: 5MB.
                                                    </small>
                                                </div>
                                            </form>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @empty
                        @endforelse

                    </tbody>
                </table>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" aria-valuenow="" aria-valuemin="0" aria-valuemax="100"
                        style="width: 0%">
                        0%
                    </div>
                </div>


                <br />
                <div id="success"></div>


            </div>
        </div>

    </div>
@endsection



@section('js')
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <script>
        $(document).ready(function() {

            $('form').ajaxForm({
                beforeSend: function() {
                    $('#success').empty();
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    $('.progress-bar').text(percentComplete + '%');
                    $('.progress-bar').css('width', percentComplete + '%');
                },
                success: function(data) {
                    if (data.errors) {
                        $('.progress-bar').text('0%');
                        $('.progress-bar').css('width', '0%');
                        $('#success').html('<span class="text-danger"><b>' + data.errors +
                            '</b></span>');
                    }
                    if (data.success) {
                        $('.progress-bar').text('Uploaded');
                        $('.progress-bar').css('width', '100%');
                        $('#success').html('<span class="text-success"><b>' + data.success +
                            '</b></span><br /><br />');
                        $('#success').append(data.image);

                        location.reload();
                    }
                }
            });

        });
    </script>
@endsection
