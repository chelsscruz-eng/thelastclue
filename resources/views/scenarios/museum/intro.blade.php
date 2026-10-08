@extends('layouts.game')

@section('content')

    <div style="min-height:100vh;
                display:flex;
                align-items:center;
                background-image:url('{{ asset('images/museo.jpg') }}');
                background-size:cover;
                background-position:center;"
    >
    <a href="{{ route('game.index') }}" class="back-button">
        ←
    </a>
    <a href="{{ route('game.index') }}" class="home-button">
        <i class="fas fa-home"></i>
    </a>

    <div class="container" style="min-height:80vh; display:flex; align-items:center;">
        <div class="row w-100 align-items-center">
            <div class="col-md-6 text-center">
                <h1 class="exception-title">{{ $case->title }}</h1>

                <hr class="exception-title mx-auto">
            </div>
            <div class="col-md-6 text-center">
                <p class="exception">
                    {{ $case->description }}
                </p>
                <p class="exception">
                    Tendrás que investigar los diferentes lugares,
                    encontrar pistas y descubrir quién es el responsable.
                </p>
                <a href="{{ route('game.scenarios', $case->id) }}" class="play-button">
                    Empezar
                </a>
            </div>
        </div>
    </div>

@endsection