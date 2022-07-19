@extends('painel.padrao')

@section('css')
    <link rel="stylesheet" href="{{ asset('js/popupyoutube/grt-youtube-popup.css') }}">
    <style>
        .video-list-thumbs {}

        .video-list-thumbs>li {
            margin-bottom: 12px;
        }

        .video-list-thumbs>li:last-child {}

        .video-list-thumbs>li>a {
            display: block;
            position: relative;
            background-color: #111;
            color: #fff;
            padding: 8px;
            border-radius: 3px transition:all 500ms ease-in-out;
            border-radius: 4px
        }

        .video-list-thumbs>li>a:hover {
            box-shadow: 0 2px 5px rgba(0, 0, 0, .3);
            text-decoration: none
        }

        .video-list-thumbs h2 {
            bottom: 0;
            font-size: 14px;
            height: 33px;
            margin: 8px 0 0;
        }

        .video-list-thumbs .glyphicon-play-circle {
            font-size: 40px;
            opacity: 0.6;
            position: absolute;
            right: 39%;
            top: 31%;
            text-shadow: 0 1px 3px rgba(0, 0, 0, .5);
            transition: all 500ms ease-in-out;
        }

        .video-list-thumbs>li>a:hover .glyphicon-play-circle {
            color: #fff;
            opacity: 1;
            text-shadow: 0 1px 3px rgba(0, 0, 0, .8);
        }

        .video-list-thumbs .duration {
            background-color: rgba(0, 0, 0, 0.4);
            border-radius: 2px;
            color: #fff;
            font-size: 11px;
            font-weight: bold;
            left: 12px;
            line-height: 13px;
            padding: 2px 3px 1px;
            position: absolute;
            top: 12px;
            transition: all 500ms ease;
        }

        .video-list-thumbs>li>a:hover .duration {
            background-color: #000;
        }

        @media (min-width:320px) and (max-width: 480px) {
            .video-list-thumbs .glyphicon-play-circle {
                font-size: 35px;
                right: 36%;
                top: 27%;
            }

            .video-list-thumbs h2 {
                bottom: 0;
                font-size: 12px;
                height: 22px;
                margin: 8px 0 0;
            }
        }

    </style>
@endsection

@section('content')
    <br>
    <br>
    <div class="container">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Treinamentos</h3>
            </div>
            <div class="panel-body">



                <ul class="list-unstyled video-list-thumbs row">

                    @forelse ($treinamentos as $treinamento)
                        <li class="col-lg-2 col-sm-4 col-xs-12">
                            <a href="#" class="youtube-link" youtubeid="{{ $treinamento->video }}"
                                title="Somos Telemedicina.">
                                <img src="http://i.ytimg.com/vi/{{ $treinamento->video }}/mqdefault.jpg" alt="Barca"
                                    class="img-responsive" height="130px" />
                                <center>
                                    <h2><span class="youtube-link" youtubeid="{{ $treinamento->video }}">Somos
                                            Telemedicina.</span></h2>
                                </center>
                                <span class="glyphicon glyphicon-play-circle"></span>


                            </a>

                            <br>

                        </li>
                    @empty
                    @endforelse






                </ul>
            </div>
        </div>





    </div>
@endsection
@section('js')
    <script src="{{ asset('js/popupyoutube/grt-youtube-popup.js') }}"></script>

    <script>
        $(".youtube-link").grtyoutube();
    </script>
@endsection
