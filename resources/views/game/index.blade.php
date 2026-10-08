@extends('layouts.game')

@section('content')

    <style>

        .case-card {
            position: relative;
            overflow: hidden;
        }

        .case-completed {
            position: relative;
            overflow: hidden;
        }

        .completed-stamp {
            position: absolute;
            top: 15px;
            right: -45px;
            background: #3B2A1D;
            color: #E3D3AC;
            padding: 6px 45px;
            font-size: 12px;
            font-weight: bold;
            transform: rotate(8deg);
            text-align: center;
            border: 1px solid #E3D3AC;
            letter-spacing: 1px;

        }

        .completed-text {
            color: #d8d2ce;
            font-size: 14px;
            margin-bottom: 15px;
        }

    </style>

    <div style="background-image: linear-gradient(
                    rgba(236,231,223,0.85),
                    rgba(236,231,223,0.85)),url('/images/fondo.jpg'); 
                    background-size:cover;
                    background-position:center;
                    min-height:100vh;">
        <div class="container-fluid">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-5 offset-lg-1 pe-5">
                    <h1 class="game-title">The Last Clue</h1>
                    <hr class="title-line">
                    <p class="game-text">
                        Un crimen ha sido cometido y todas las personas parecen ocultar algo.
                    </p>
                    <p class="game-text">
                        Recorre los escenarios, habla con los personajes y encuentra las pistas necesarias para descubrir al culpable.
                    </p>
                    <p class="game-text">
                        Cada decisión puede acercarte a la verdad... o alejarte de ella.
                    </p>
                </div>
                <div class="col-lg-5">
                    <div class="row">
                        @foreach($cases as $case)
                            @php
                                $lastScenario = $case->scenarios()->orderBy('id', 'desc')->first();
                                $completed = $lastScenario && session('completed_scenarios.' . $lastScenario->id);
                            @endphp
                            <div class="col-md-6 mb-4">
                                <div class="case-card {{ $completed ? 'case-completed' : '' }}">
                                    @if($completed)
                                        <div class="completed-stamp">
                                            CASO<br>CERRADO
                                        </div>
                                    @endif
                                    <h3>{{ $case->title }}</h3>
                                    <p>
                                        {{ strlen($case->description) > 80 ? substr($case->description,0,80).'...' : $case->description }}
                                    </p>
                                    @if($completed)
                                        <div class="completed-text">
                                            <i class="fas fa-check-circle"></i>Investigación completada
                                        </div>
                                        <a href="{{ route('game.play',$case->id) }}" class="btn play-button">Ver expediente</a>
                                    @else
                                        <a href="{{ route('game.play',$case->id) }}" class="btn play-button">Investigar</a>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection