@extends('layouts.game')

@section('content')

    <style>
        .scenario-container {
            min-height: 100vh;
            background-image: url('{{ asset('images/habitacionScenario2.png') }}');
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

        .desk {
            left: 40%;
            top: 60%;
            width: 25%;
            height: 25%;
        }

        .bookshelf {
            left: 20%;
            top: 20%;
            width: 18%;
            height: 55%;
        }

        .window {
            left: 64%;
            top: 65%;
            width: 15%;
            height: 45%;
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

        .code-lock {
            margin-top: 20px;
        }

        .code-inputs {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            margin-bottom: 15px;
        }

        .code-inputs input {
            width: 55px;
            height: 45px;
            text-align: center;
            font-size: 20px;
            background: #261716;
            color: #E3D3AC;
            border: 1px solid #E3D3AC;
            border-radius: 5px;
        }

        .code-inputs span {
            font-size: 20px;
            color: #E3D3AC;
        }

        #open-drawer {
            background: #261716;
            color: #E3D3AC;
            border: 1px solid #E3D3AC;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
        }

        #code-error {
            color: #d88;
            margin-top: 12px;
        }

        .clue-image {
            width: 250px;
            max-height: 180px;
            object-fit: cover;
            border: 2px solid #E3D3AC;
            margin-bottom: 15px;
        }
        .drawer-image {
            width: 180px;
            height: 130px;
            object-fit: cover;
            border: 3px solid #E3D3AC;
            margin-bottom: 15px;
            cursor: pointer;
        }

        .drawer-preview {
            position: relative;
            display: inline-block;
        }

        .drawer-zoom-icon {
            position: absolute;
            right: 10px;
            bottom: 10px;
            color: white;
            background: rgba(20, 20, 20, 0.8);
            padding: 8px;
            border-radius: 50%;
            font-size: 18px;
        }

        .drawer-zoom {
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

        .drawer-zoom img {
            max-width: 80%;
            max-height: 80%;
            border: 3px solid #E3D3AC;
            border-radius: 5px;
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
        <a href="{{ route('game.scenarios', $case->id) }}" class="back-button">←</a>
        <a href="{{ route('game.index') }}" class="home-button"><i class="fas fa-home"></i></a>
        <div class="clues-counter">
            Pistas encontradas: <span id="clues-count">0</span>/3
        </div>
        <div class="object desk"><span class="search-text">Buscar</span></div>
        <!-- ESCRITORIO -->
        <div class="object desk"><span class="search-text">Buscar</span></div>
        <div id="clue-desk" class="clue-message">
            <h4>¡ Pista encontrada !</h4>
            <p>
                En uno de los cajones del escritorio encuentras una pequeña
                cerradura numérica. Parece que alguien la utilizó recientemente.
                La cerradura requiere un código de tres partes.
            </p>
            <div class="code-lock">
                <div class="code-inputs">
                    <input type="text" id="code1" maxlength="2"><span>-</span>
                    <input type="text" id="code2" maxlength="2"><span>-</span>
                    <input type="text" id="code3" maxlength="2">
                </div>
                <button id="open-drawer">ABRIR</button>
                <p id="code-error" style="display:none;">Código incorrecto.</p>
            </div>
        </div>
        <!-- PISTA DEL CAJÓN -->
        <div id="drawer-clue" class="clue-message">
            <h4>¡ Pista encontrada !</h4>
            <div class="drawer-preview">
                <img src="{{ asset('images/foto-sospechoso.png') }}" class="drawer-image">
                <i class="fas fa-hand-pointer drawer-zoom-icon"></i>
            </div>
            <p>
                Dentro del cajón encuentras una fotografía relacionada con el
                robo del museo. Al observarla con atención, reconoces al
                sospechoso cerca del lugar de los hechos.
            </p>
        </div>
        <div class="drawer-zoom" id="drawer-zoom">
            <img src="{{ asset('images/foto-sospechoso.png') }}">
        </div>
        <div class="object bookshelf"><span class="search-text">Buscar</span></div>
        <div id="clue-bookshelf" class="clue-message">
            <h4>¡ Pista encontrada !</h4>
            <p>
                Entre los libros encuentras un espacio vacío.
                Parece que alguien ha movido un libro recientemente.
                No parece relacionado directamente con el robo,
                pero alguien estuvo buscando algo en esta habitación.
            </p>
        </div>
        <div class="object window"><span class="search-text">Buscar</span></div>
        <div id="clue-window" class="clue-message">
            <h4>¡ Pista encontrada !</h4>
            <p>
                Cerca de la ventana encuentras una marca en el suelo.
                Parece que alguien estuvo allí observando el exterior
                poco antes de abandonar la habitación.
            </p>
        </div>
        <form id="next-scenario"action="{{ route('game.scenario.complete', [$case->id, $scenario->id]) }}" method="POST" style="display:none;">
            @csrf
            <button type="submit" class="next-button">Siguiente escenario →</button>
        </form>
    </div>

@endsection


@section('postscripts')

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
            let foundDesk = false;
            let foundBookshelf = false;
            let foundWindow = false;

            $('.object').mouseenter(function() {
                $(this).find('.search-text').show();
            });

            $('.object').mouseleave(function() {
                $(this).find('.search-text').hide();
            });

            // ESCRITORIO
            $('.desk').click(function() {

                $('.clue-message').stop(true, true).fadeOut(300);

                if (foundDesk) {
                    $('#drawer-clue').fadeIn(500);
                } else {
                    $('#clue-desk').fadeIn(500);
                }
            });

            // ABRIR CAJÓN
            $('#open-drawer').click(function() {

                let code1 = $('#code1').val();
                let code2 = $('#code2').val();
                let code3 = $('#code3').val();

                if (code1 == '24' && code2 == '17' && code3 == '09')
                {
                    $('#code-error').hide();
                    $('#clue-desk').fadeOut(500);
                    $('#drawer-clue').fadeIn(500);

                    if (!foundDesk) {
                        foundDesk = true;
                        cluesFound++;

                        $('#clues-count').text(cluesFound);

                        $.post("{{ route('game.inventory.add') }}", {
                            _token: "{{ csrf_token() }}",
                            item: 'photograph',
                            case_id: "{{ $case->id }}"
                        });

                        $('.inventory-items').find('.empty-inventory').remove();

                        $('.inventory-items').append(
                            '<div class="inventory-item" id="inventory-photograph">' +
                                '<i class="fas fa-image"></i>' +
                                '<span>Fotografía del sospechoso</span>' +
                            '</div>'
                        );

                        showInventoryNotification();
                    }

                    if (cluesFound == 3) {
                        $('#next-scenario').fadeIn(500);
                    }

                    setTimeout(function() {
                        $('#drawer-clue').fadeOut(500);
                    }, 6000);

                } else {
                    $('#code-error').fadeIn(300);
                }
            });

            // AMPLIAR FOTOGRAFÍA
            $('.drawer-image').click(function() {
                $('#drawer-zoom').css('display', 'flex').hide().fadeIn(300);
            });

            // CERRAR FOTOGRAFÍA
            $('#drawer-zoom').click(function() {
                $(this).fadeOut(300);
            });

            // ESTANTERÍA
            $('.bookshelf').click(function() {

                $('.clue-message').stop(true, true).fadeOut(300);

                $('#clue-bookshelf').fadeIn(500);

                if (!foundBookshelf) {
                    foundBookshelf = true;
                    cluesFound++;

                    $('#clues-count').text(cluesFound);
                }

                if (cluesFound == 3) {
                    $('#next-scenario').fadeIn(500);
                }

                setTimeout(function() {
                    $('#clue-bookshelf').fadeOut(500);
                }, 4000);
            });

            // VENTANA
            $('.window').click(function() {

                $('.clue-message').stop(true, true).fadeOut(300);

                $('#clue-window').fadeIn(500);

                if (!foundWindow) {
                    foundWindow = true;
                    cluesFound++;

                    $('#clues-count').text(cluesFound);
                }

                if (cluesFound == 3) {
                    $('#next-scenario').fadeIn(500);
                }

                setTimeout(function() {
                    $('#clue-window').fadeOut(500);
                }, 4000);
            });

        });

    </script>

@endsection