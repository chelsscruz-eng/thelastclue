@extends('layouts.game')

@section('content')
    @include('game.partials.inventory')
    <div style="
        min-height:100vh;
        display:flex;
        align-items:center;
        background-image:url('{{ asset('images/museo.jpg') }}');
        background-size:cover;
        background-position:center;">
        <a href="{{ route('game.play', $case->id)  }}" class="back-button">
            ←
        </a>
        <a href="{{ route('game.index') }}" class="home-button">
            <i class="fas fa-home"></i>
        </a>
        <div class="container text-center">
            <h1 class="exception-title">{{ $case->title }}</h1>
            <p class="exception">
                ¿Dónde quieres comenzar a investigar?
            </p>
            <div class="row justify-content-center">
                @foreach($scenarios as $scenario)
                    <div class="col-md-4 mb-4">

                        @if(session('completed_scenarios.' . $scenario->id))
                            <button class="play-button scenario-completed" disabled>
                                ✓ {{ $scenario->name }}
                                <h6>RESUELTO</h6>
                            </button>

                        @elseif($loop->first || session('completed_scenarios.' . $scenarios[$loop->index - 1]->id))
                            <form action="{{ route('game.scenario', [$case->id, $scenario->id]) }}" method="GET">
                                <button type="submit" class="play-button">
                                    {{ $scenario->name }}
                                    <h6>🔍 COMENZAR AQUÍ</h6>
                                </button>
                            </form>

                        @else
                            <button class="play-button" disabled>
                                🔒 {{ $scenario->name }}
                                <h6>BLOQUEADO</h6>
                            </button>
                        @endif

                    </div>
                @endforeach
            </div>
        </div>
    </div>

@endsection