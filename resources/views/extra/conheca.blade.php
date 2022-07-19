@extends('painel.padrao')
@section('content')
    <br>
    <div class="container">
        <div class="panel  ">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $extra->name }}</h3>
            </div>
        </div>
        <div class="panel  ">
            <div class="panel-body">
                {!! $extra->descricao !!}
            </div>
            <div class="panel-footer">
                @if (isset($existe))
                <button class="btn btn-success btn-flat btn-block">
                    Você ja sinalizou</button>
                @else
                    <a href="{{ url('interesse', $extra->id) }}" class="btn btn-success btn-flat btn-block">Tenho
                        Interesse</a>
                @endif



            </div>
        </div>

    </div>
@endsection
