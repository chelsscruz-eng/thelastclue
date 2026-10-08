@extends('layouts.game')

@section('content')

    <style>

        .scenario-container {
            min-height: 100vh;
            background-image: url('{{ asset('images/seguridadScenario3.png') }}');
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

        /* ESCRITORIO */

        .desk {
            left: 20%;
            top: 60%;
            width: 43%;
            height: 42%;
        }

        /* MONITORES */

        .monitors {
            left: 52%;
            top: 42%;
            width: 28%;
            height: 28%;
        }

        /* ARCHIVADORES */

        .filing-cabinet {
            left: 78%;
            top: 35%;
            width: 17%;
            height: 45%;
        }

        .clue-message {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 430px;
            background: rgba(20, 15, 10, 0.96);
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

        .clue-button {
            margin-top: 20px;
            background: #261716;
            color: #E3D3AC;
            border: 1px solid #E3D3AC;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
        }

        .camera-options {
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .camera-button {
            background: #261716;
            color: #E3D3AC;
            border: 1px solid #E3D3AC;
            padding: 10px 15px;
            border-radius: 6px;
            cursor: pointer;
        }

        .camera-button:hover,
        .clue-button:hover {
            background: #3B2A1D;
        }

        .code-input {
            width: 100px;
            height: 45px;
            text-align: center;
            font-size: 20px;
            background: #261716;
            color: #E3D3AC;
            border: 1px solid #E3D3AC;
            border-radius: 5px;
            margin-top: 15px;
        }

        .error-message {
            display: none;
            color: #d88;
            margin-top: 12px !important;
        }

        .success-message {
            display: none;
            color: #E3D3AC;
            margin-top: 15px !important;
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

    </style>

    <div class="scenario-container">
        @include('game.partials.inventory')
        <a href="{{ route('game.scenarios', $case->id) }}" class="back-button">←</a>
        <a href="{{ route('game.index') }}" class="home-button"><i class="fas fa-home"></i></a>
        <div class="clues-counter">Pistas encontradas:<span id="clues-count">0</span>/3</div>

        <!-- ESCRITORIO -->
        <div class="object desk"><span class="search-text">Buscar</span></div>
        <div id="clue-desk" class="clue-message">
            <h4>Una marca sospechosa</h4>
            <p>
                Encuentras una marca de guante sobre el escritorio.
                Parece haber sido dejada recientemente.
            </p>
            <p style="margin-top: 15px;">
                Tienes una fibra de guante en tu inventario.
                ¿Quieres comparar ambas pruebas?
            </p>
            <button id="compare-fiber" class="clue-button">COMPARAR PRUEBAS</button>
            <p id="fiber-success" class="success-message">
                Coinciden. La misma clase de guante estuvo en ambos lugares.
            </p>
        </div>

        <!-- MONITORES -->
        <div class="object monitors"><span class="search-text">Buscar</span></div>
        <div id="clue-monitors" class="clue-message">
            <h4>Las cámaras de seguridad</h4>
            <p>
                Las grabaciones muestran varias zonas del museo.
                Debes localizar la cámara que registró al sospechoso.
            </p>
            <div class="camera-options">
                <button class="camera-button" data-camera="1">Cámara 1</button>
                <button class="camera-button" data-camera="2">Cámara 2</button>
                <button class="camera-button" data-camera="3">Cámara 3</button>
                <button class="camera-button" data-camera="4">Cámara 4</button>
                <button class="camera-button" data-camera="5">Cámara 5</button>
                <button class="camera-button" data-camera="6">Cámara 6</button>
            </div>
            <p id="camera-error" class="error-message">
                Esta cámara no muestra nada relacionado con el robo.
            </p>
            <p id="camera-success" class="success-message">
                Has encontrado la grabación. El sospechoso de la fotografia aparece
                cerca de la sala del diamante a las <strong>22:47</strong>.
                Esa parece ser la única información relevante de la grabación.
            </p>
        </div>

        <!-- ARCHIVADOR -->
        <div class="object filing-cabinet"><span class="search-text">Buscar</span></div>
        <div id="clue-filing" class="clue-message">
            <h4>Archivador de seguridad</h4>
            <p>
                Uno de los cajones está cerrado.
                Parece necesitar un código de cuatro cifras.
            </p>
            <input type="text" id="security-code" class="code-input" maxlength="4" placeholder="----"
            >
            <br>
            <button id="open-file" class="clue-button">ABRIR</button>
            <p id="file-error" class="error-message">Código incorrecto.</p>
            <p id="file-success" class="success-message">
                El informe confirma que el responsable de seguridad
                tenía acceso a la zona de la exposición durante el robo.
                Además, era una de las pocas personas que podía
                acceder al museo durante el cierre.
                Ahora las pruebas empiezan a encajar.
            </p>
        </div>

        <!-- FINAL -->
        <form id="next-scenario" action="{{ route('game.scenario.complete', [$case->id, $scenario->id]) }}" method="POST" style="display:none;">
            @csrf
            <button type="submit" class="next-button">REVISAR LAS PRUEBAS →</button>
        </form>
    </div>

@endsection

@section('postscripts')

    <script>

        $(document).ready(function() {

            let cluesFound = 0;
            let foundDesk = false;
            let foundMonitors = false;
            let foundFiling = false;

            $('.object').mouseenter(function() {
                $(this).find('.search-text').show();
            });

            $('.object').mouseleave(function() {
                $(this).find('.search-text').hide();
            });

            function checkComplete() {
                if (cluesFound == 3) {
                    $('#next-scenario').fadeIn(500);
                }
            }

            // ESCRITORIO
            $('.desk').click(function() {

                $('.clue-message').stop(true, true).fadeOut(300);

                $('#clue-desk').stop(true, true).fadeIn(500);
            });

            // COMPARAR FIBRA
            $('#compare-fiber').click(function() {
                if (!foundDesk) {
                    foundDesk = true;
                    cluesFound++;

                    $('#clues-count').text(cluesFound);
                }

                $('#compare-fiber').hide();
                $('#fiber-success').fadeIn(300);

                checkComplete();

                setTimeout(function() {
                    $('#clue-desk').fadeOut(500);
                }, 4000);
            });

            // MONITORES
            $('.monitors').click(function() {

                $('.clue-message').stop(true, true).fadeOut(300);
                $('#clue-monitors').stop(true, true).fadeIn(500);

                if (foundMonitors) {
                    setTimeout(function() {
                        $('#clue-monitors').stop(true, true).fadeOut(500);
                    }, 6000);
                }
            });

            // CAMARAS
            $('.camera-button').click(function() {
                let camera = $(this).data('camera');

                if (camera == 4) {

                    if (!foundMonitors) {
                        foundMonitors = true;
                        cluesFound++;

                        $('#clues-count').text(cluesFound);
                    }

                    $('#camera-error').hide();
                    $('#camera-success').fadeIn(300);
                    $('.camera-button').hide();

                    checkComplete();

                    setTimeout(function() {
                        $('#clue-monitors').fadeOut(500);
                    }, 6000);
                } else {
                    $('#camera-error')
                        .stop(true, true)
                        .fadeIn(300);
                }
            });

            // ARCHIVADOR
            $('.filing-cabinet').click(function() {

                $('.clue-message').stop(true, true).fadeOut(300);
                $('#clue-filing').stop(true, true).fadeIn(500);
            });

            // ABRIR ARCHIVADOR
            $('#open-file').click(function() {
                let code = $('#security-code').val();

                if (code == '2247') {

                    if (!foundFiling) {
                        foundFiling = true;
                        cluesFound++;

                        $('#clues-count').text(cluesFound);
                    }

                    $('#file-error').hide();
                    $('#file-success').fadeIn(300);
                    $('#open-file').hide();
                    $('#security-code').hide();

                    checkComplete();

                    setTimeout(function() {
                        $('#clue-filing').fadeOut(500);
                    }, 5000);
                } else {
                    $('#file-error').fadeIn(300);
                }
            });
        });

    </script>
@endsection