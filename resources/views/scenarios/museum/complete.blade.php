@extends('layouts.game')

@section('content')

    <style>

        .complete-container {
            min-height: 100vh;
            background-image: url('{{ asset('images/seguridadScenario3.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .complete-overlay {
            position: absolute;
            inset: 0;
            background: rgba(20, 15, 10, 0.75);
        }

        .investigation-box {
            position: relative;
            z-index: 5;
            width: 850px;
            max-width: 90%;
            background: rgba(20, 15, 10, 0.96);
            color: #E3D3AC;
            border: 1px solid #E3D3AC;
            border-radius: 10px;
            padding: 40px;
            text-align: center;
        }

        .investigation-box h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .investigation-box h3 {
            font-size: 21px;
            margin-bottom: 30px;
        }

        .evidence-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 30px;
        }

        .evidence {
            width: 220px;
            padding: 20px;
            border: 1px solid #E3D3AC;
            border-radius: 8px;
            background: rgba(38, 23, 22, 0.8);
        }

        .evidence i {
            font-size: 30px;
            margin-bottom: 10px;
        }

        .evidence h4 {
            margin-bottom: 8px;
        }

        .evidence p {
            margin: 0;
            font-size: 15px;
        }

        .suspect-options {
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 400px;
            margin: 0 auto 20px;
        }

        .suspect-button {
            background: #261716;
            color: #E3D3AC;
            border: 1px solid #E3D3AC;
            padding: 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        .suspect-button:hover {
            background: #3B2A1D;
        }

        .error-message {
            display: none;
            color: #d88;
            margin-top: 15px;
        }

        .solution {
            display: none;
        }

        .solution h2 {
            font-size: 30px;
            margin-bottom: 25px;
        }

        .solution p {
            font-size: 17px;
            line-height: 1.7;
            margin-bottom: 15px;
        }

        .home-button-final {
            display: inline-block;
            margin-top: 20px;
            background: #261716;
            color: #E3D3AC;
            border: 1px solid #E3D3AC;
            padding: 12px 25px;
            border-radius: 6px;
            text-decoration: none;
        }

        .home-button-final:hover {
            background: #3B2A1D;
            color: #E3D3AC;
        }

    </style>

    <div class="complete-container">
        <div class="complete-overlay"></div>
        <div class="investigation-box">
            <div id="deduction">
                <h1>EXPEDIENTE DEL CASO</h1>
                <h3>EL ROBO DEL MUSEO</h3>
                <p>
                    Has reunido todas las pruebas.
                    Ahora debes relacionarlas para descubrir quién está detrás del robo.
                </p>
                <div class="evidence-container">
                    <div class="evidence">
                        <i class="fas fa-hand-sparkles"></i>
                        <h4>Fibra de guante</h4>
                        <p>
                            Coincide con la marca encontrada en el escritorio.
                        </p>
                    </div>
                    <div class="evidence">
                        <i class="fas fa-video"></i>
                        <h4>Cámara 4</h4>
                        <p>
                            El sospechoso aparece en el museo a las 22:47.
                        </p>
                    </div>
                    <div class="evidence">
                        <i class="fas fa-folder-open"></i>
                        <h4>Informe de seguridad</h4>
                        <p>
                            Una persona tenía acceso a la zona de exposición.
                        </p>
                    </div>
                </div>
                <h3>¿Quién es el responsable?</h3>
                <div class="suspect-options">
                    <button class="suspect-button" data-answer="wrong">Director del museo</button>
                    <button class="suspect-button" data-answer="correct">Responsable de seguridad</button>
                    <button class="suspect-button" data-answer="wrong">Conservador de arte</button>
                    <button class="suspect-button" data-answer="wrong">Visitante de la inauguración</button>
                </div>
                <p id="wrong-answer" class="error-message">
                    Las pruebas no apuntan a esta persona. Revisa las evidencias e inténtalo de nuevo.
                </p>
            </div>
            <div id="solution" class="solution">
                <h2>CASO RESUELTO</h2>
                <p>El responsable del robo era el encargado de seguridad del museo.</p>
                <p>
                    La fibra encontrada en el escritorio coincide con el tipo de
                    guante utilizado durante el robo.
                </p>
                <p>
                    Las cámaras sitúan al sospechoso dentro del museo a las
                    <strong>22:47</strong>, durante la noche del robo.
                </p>
                <p>
                    Finalmente, el informe de seguridad confirma que tenía acceso
                    a la zona de exposición donde se encontraba el diamante.
                </p>
                <p>
                    Todas las pruebas conducen a la misma persona.
                </p>
                <h3>CASO CERRADO</h3>
                <a href="{{ route('game.index') }}" class="home-button-final">VOLVER AL INICIO</a>
            </div>
        </div>
    </div>

@endsection

@section('postscripts')

    <script>

        $(document).ready(function() {

            $('.suspect-button').click(function() {
                let answer = $(this).data('answer');
                if (answer == 'correct') {
                    $('#deduction').fadeOut(500, function() {
                        $('#solution').fadeIn(500);
                    });
                } else {
                    $('#wrong-answer')
                        .stop(true, true)
                        .fadeIn(300);
                }
            });
        });

    </script>

@endsection