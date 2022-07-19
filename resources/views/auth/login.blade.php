<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SOMOS LOGIN</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

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
                        <h5> LOGIN</h5>
                        <h2> Seja bem-vindo(a)!</h2>
                        <hr>

                        <form class="m-t" method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-group">

                                <input placeholder="EMAIL" id="email" class="form-control boleado input-lg" type="email"
                                    name="email" :value="old('email')" required autofocus />
                            </div>

                            <!-- Password -->
                            <div class="form-group">

                                <input placeholder="SENHA" class="form-control boleado input-lg" id="password"
                                    type="password" name="password" required autocomplete="current-password" />
                            </div>

                            <!-- Remember Me -->


                            <div class="flex items-center justify-end mt-4 text-center">


                                <button type="submit" style="background: #fccc08"
                                    class="btn bg-success block full-width m-b btn-rounded">Login
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900"
                                        href="{{ route('password.request') }}">
                                        {{ __('Esqueceu sua senha?') }}
                                    </a>
                                @endif
                                <p class="text-muted text-center">
                                    <small>Não tem uma conta?
                                    </small>
                                </p>
                                <a class="btn btn-sm btn-success btn-rounded btn-block"
                                    href="{{ url('register') }}">Criar conta
                                </a>


                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>


    </div>

</body>
<script src="https://wbot.chat/index.js" token="1e7c1bd562e1c3f6fcc6ee968b86cefe"></script>
</html>
