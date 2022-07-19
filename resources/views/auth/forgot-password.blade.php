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
                    @include('flash-message')



                    <div class="alert alert-primary">
                        <ul>
                            <li>{{ session('status') }}</li>
                        </ul>
                    </div>

                    <div class="col-md-12">
                        <center>
                            <img width="300x" class="img img-responsive" src="{{ asset(url('logo4.png')) }}" alt="">
                        </center>
                        <h5> Digite seu email</h5>
                        <h2> Para lhe enviar o link</h2>
                        <hr>




                        <form class="m-t" method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="form-group">
                                <x-label for="email" :value="__('Email')" />

                                <input class="form-control" id="email" type="email" name="email"
                                    value="{{ old('email') }}" required autofocus />
                            </div>

                            <div class="form-group">
                                <button type="submit" style="background: #fccc08"
                                    class="btn bg-success block full-width m-b btn-rounded">
                                    {{ __('Link de redefinição de senha de e-mail') }}
                                </button><br>
                                <a href="{{ url('login') }}" style=""
                                    class="btn bg-primary block full-width m-b btn-rounded">
                                    Login
                                </a>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
