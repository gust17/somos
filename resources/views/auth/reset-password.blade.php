<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SOMOS LOGIN</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<style>
    .boleado {
        border-radius: 25px;
    }

</style>

<body style="background-image: url('{{ url('bg.png') }}');height: 100%;
background-position: center;
background-repeat: no-repeat;
background-size: cover;">

    <div class="loginColumns animated fadeInDown">

        <div class="panel rounded">
            <div class="panel-body">
                <div class="row">

                    <div class="col-md-12">
                        <center>
                            <img width="300x" class="img img-responsive" src="{{ asset(url('logo4.png')) }}" alt="">
                        </center>
                        <h5> Resetar sua senha</h5>
                        <h2> Seja bem-vindo(a)!</h2>
                        <hr>
                        <form class="m-t" method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <!-- Password Reset Token -->
                            <input type="hidden" name="token" value="{{ $request->route('token') }}">

                            <!-- Email Address -->
                            <div class="form-group">
                                <label for="email">{{ __('Email') }}</label>

                                <input class="form-control" id="email" type="email" name="email"
                                    value="{{ old('email', $request->email) }}" required autofocus />
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password">{{ __('Senha') }}</label>

                                <input class="form-control" id="password" type="password" name="password" required />
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group">
                                <x-label for="password_confirmation" :value="__('Confirmar Senha')" />

                                <input class="form-control" id="password_confirmation" type="password"
                                    name="password_confirmation" required />
                            </div>

                            <div class="form-group">
                                <button type="submit" style="background: #fccc08"
                                class="btn bg-success block full-width m-b btn-rounded">Resetar Senha
                            </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
