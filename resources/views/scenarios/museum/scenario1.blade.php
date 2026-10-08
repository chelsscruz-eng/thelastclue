@extends('layouts.game')

@section('content')

<style>

    .scenario-container {
        min-height: 100vh;
        background-image: url('{{ asset('images/museoScenario1.jpeg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
    }

    .clues-counter {
        position: absolute;
        top: 25px;
        right: 30px;
        background: rgba(20, 20, 20, 0.8);
        color: white;
        padding: 12px 25px;
        border-radius: 10px;
        font-size: 18px;
    }

    .object {
        position: absolute;
        cursor: pointer;
    }

    .search-text {
        display: none;
        position: absolute;
        left: 35px;
        top: 0;
        background: rgba(20, 20, 20, 0.9);
        color: white;
        padding: 5px 12px;
        border-radius: 8px;
        white-space: nowrap;
        z-index: 10;
    }
    .bust {
        left: 16%;
        top: 45%;
        width: 5%;
        height: 25%;
    }

    .statue {
        left: 32%;
        top: 35%;
        width: 5%;
        height: 45%;
    }

    .letter {
        left: 61%;
        top: 65%;
        width: 7%;
        height: 6%;
    }
    .clue-message {
        display: none;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 400px;
        background: rgba(20, 15, 10, 0.95);
        color: #E3D3AC;
        padding: 25px;
        border: 1px solid #E3D3AC;
        border-radius: 10px;
        text-align: center;
        z-index: 20;
    }

    .clue-message h4 {
        margin-bottom: 15px;
        font-size: 24px;
    }

    .clue-message p {
        margin: 0;
        font-size: 17px;
        line-height: 1.6;
    }
    .clue-image {
        width: 150px;
        height: 120px;
        object-fit: cover;
        border: 3px solid #E3D3AC;
        margin-bottom: 15px;
    }
    .letter-image {
        cursor: pointer;
    }

    .letter-zoom {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.9);
        align-items: center;
        justify-content: center;
        z-index: 50;
    }

    .letter-zoom img {
        max-width: 80%;
        max-height: 80%;
        border: 3px solid #E3D3AC;
        border-radius: 5px;
    }
    .letter-preview {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .zoom-icon {
        position: absolute; 
        right: 10px;
        bottom: 10px;
        color: white;
        background: rgba(20, 20, 20, 0.8);
        padding: 8px;
        border-radius: 50%;
        font-size: 18px;
    }

   .next-button {
        position: absolute;
        bottom: 100px;
        right: 30px;
        background: #261716;
        color: #E3D3AC;
        border: 1px solid #E3D3AC;
        padding: 12px 20px;
        border-radius: 8px;
        font-size: 17px;
        cursor: pointer;
    }

    .inventory-notification {
        display: none;
        position: fixed;
        bottom: 95px;
        left: 25px;
        background: rgba(20, 15, 10, 0.95);
        color: #E3D3AC;
        border: 1px solid #E3D3AC;
        padding: 12px 18px;
        border-radius: 8px;
        z-index: 150;
        font-size: 16px;
    }
</style>

<div class="scenario-container">
    @include('game.partials.inventory')
    <div class="inventory-notification" id="inventory-notification">
        Pista añadida al inventario
    </div>
    <a href="{{ route('game.scenarios', $case->id) }}" class="back-button">
        ←
    </a>

    <a href="{{ route('game.index') }}" class="home-button">
        <i class="fas fa-home"></i>
    </a>

    <div class="clues-counter">
        Pistas encontradas: <span id="clues-count">0</span>/3
    </div>

    <div class="object bust">
        <span class="search-text">Buscar</span>
    </div>
    <div id="clue-bust" class="clue-message">
        <h4>¡ Pista encontrada !</h4>
        <p>
            El busto parece haber sido movido recientemente.
            En la base encuentras restos de polvo y una pequeña huella de guante. 
            Alguien estuvo aquí después de la inauguración....
        </p>
    </div>

    <div class="object statue">
        <span class="search-text">Buscar</span>
    </div>
    <div id="clue-statue" class="clue-message">
        <h4>¡ Pista encontrada !</h4>
        <img src="{{ asset('images/fibra-guante.png') }}" class="clue-image">
        <p>
            Entre la base de la estatua encuentras una pequeña fibra de tela oscura.
            Al observarla de cerca, parece proceder de un guante.
            Alguien estuvo buscando algo aquí.
        </p>

    </div>

    <div class="object letter">
        <span class="search-text">buscar</span>
    </div>
       <div id="clue-letter" class="clue-message">
        <h4>¡ Pista encontrada !</h4>
        <div class="letter-preview">
            <img src="{{ asset('images/carta.png') }}" class="clue-image letter-image">
            <i class="fas fa-hand-pointer zoom-icon"></i>
        </div>
        <p>
            Detrás de la estatua encuentras una carta cuidadosamente escondida. 
            No parece haber sido olvidada: alguien la colocó allí para que fuera encontrada.
        </p>

    </div>
    <div class="letter-zoom" id="letter-zoom">
        <img src="{{ asset('images/carta.png') }}">
    </div>
    <form id="next-scenario" action="{{ route('game.scenario.complete', [$case->id, $scenario->id]) }}" method="POST" style="display:none;">
        @csrf
        <button type="submit" class="next-button">Siguiente escenario →</button>
    </form>
</div>

@endsection

@section('postscripts')

        <script>

        $(document).ready(function() {

            function showInventoryNotification() {
                $('#inventory-notification')
                    .stop(true, true)
                    .fadeIn(300);

                setTimeout(function() {
                    $('#inventory-notification').fadeOut(300);
                }, 2500);
            }

            let cluesFound = 0;
            let foundBust = false;
            let foundStatue = false;
            let foundLetter = false;

            $('.object').mouseenter(function() {
                $(this).find('.search-text').show();
            });

            $('.object').mouseleave(function() {
                $(this).find('.search-text').hide();
            });

            // BUSTO
            $('.bust').click(function() {

                $('.clue-message').stop(true, true).fadeOut(300);

                $('#clue-bust').fadeIn(500);

                if (!foundBust) {
                    foundBust = true;
                    cluesFound++;

                    $('#clues-count').text(cluesFound);
                }

                setTimeout(function() {
                    $('#clue-bust').fadeOut(500);
                }, 4000);
            });

            // ESTATUA
            $('.statue').click(function() {

                $('.clue-message').stop(true, true).fadeOut(300);

                $('#clue-statue').fadeIn(500);

                if (!foundStatue) {
                    foundStatue = true;
                    cluesFound++;

                    $('#clues-count').text(cluesFound);

                    $.post("{{ route('game.inventory.add') }}", {
                        _token: "{{ csrf_token() }}",
                        item: 'fiber',
                        case_id: "{{ $case->id }}"
                    });

                    $('.inventory-items').find('.empty-inventory').remove();

                    $('.inventory-items').append(
                        '<div class="inventory-item" id="inventory-fiber">' +
                            '<i class="fas fa-hand-sparkles"></i>' +
                            '<span>Fibra de guante</span>' +
                        '</div>'
                    );

                    showInventoryNotification();
                }

                setTimeout(function() {
                    $('#clue-statue').fadeOut(500);
                }, 4000);
            });

            // CARTA
            $('.letter').click(function() {

                $('.clue-message').stop(true, true).fadeOut(300);

                $('#clue-letter').fadeIn(500);

                if (!foundLetter) {
                    foundLetter = true;
                    cluesFound++;

                    $('#clues-count').text(cluesFound);

                    $.post("{{ route('game.inventory.add') }}", {
                        _token: "{{ csrf_token() }}",
                        item: 'letter',
                        case_id: "{{ $case->id }}"
                    });

                    $('.inventory-items').find('.empty-inventory').remove();

                    $('.inventory-items').append(
                        '<div class="inventory-item" id="inventory-letter">' +
                            '<i class="fas fa-envelope"></i>' +
                            '<span>Carta</span>' +
                        '</div>'
                    );

                    showInventoryNotification();
                }

                if (cluesFound == 3) {
                    $('#next-scenario').fadeIn(500);
                }

                setTimeout(function() {
                    $('#clue-letter').fadeOut(500);
                }, 6000);
            });

            // AMPLIAR CARTA
            $('.letter-image').click(function() {
                $('#letter-zoom').css('display', 'flex').hide().fadeIn(300);
            });

            // CERRAR CARTA
            $('#letter-zoom').click(function() {
                $(this).fadeOut(300);
            });

        });

    </script>

@endsection