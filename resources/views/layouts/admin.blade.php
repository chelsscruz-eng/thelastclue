<!DOCTYPE html>
<html lang="ca">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Last Clue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body{
            margin:0;
            background:#ECE7DF;
        }
        .side-menu{
            position:fixed;
            width:250px;
            height:100vh;
            background:#3B2A1D;
            color:#F4EBD0;
        }
        .title{
            text-align:center;
            padding:20px 0;
            margin:0;
            border-bottom:2px solid #A67C52;
            font-size:38px;
        }
        .option-menu{
            display:block;
            color:#F4EBD0;
            text-decoration:none;
            padding:18px 25px;
            margin-top:5px;
        }
        .option-menu:hover{
            background:#6B4423;
        }
        .content{
            margin-left:250px;
            padding:30px;
        }
        /* ---------- tablas ---------- */
        .table-admin thead{
            background:#3B2A1D;
            color:#F4EBD0;
        }
        .table-admin tbody{
            background:white;
        }
        .table-admin tbody tr:hover{
            background:#F7F1E8;
        }
        /* ---------- titulo ---------- */
        .titulo-pagina{
            color:#3B2A1D;
            font-weight:bold;
            text-align:center;
            margin-bottom:10px;
        }
        .subtitulo-pagina{
            color:#7A5A3A;
            font-size:16px;
            text-align:center;
            margin-bottom:25px;
        }
        /* ---------- card ---------- */
        .card-admin{
            border:2px solid #A67C52;
            border-radius:10px;
        }
        .card-body{
            background:#FFFDF8;
        }
        .boton-admin{
            background:#6B4423;
            border-color:#6B4423;
            color:white;
        }
        .modal-block{
            max-width: 500px;
            margin: 40px auto;
        }
    </style>
    @yield('head')
</head>
<body>
    <div class="side-menu">
        <h2 class="title">The Last Clue</h2>
        <a class="option-menu" href="/">🏠 Inicio</a>
        <a class="option-menu" href="{{ route('cases.index') }}">📁 Casos</a>
        <a class="option-menu" href="{{ route('scenarios.index') }}">🗺 Escenarios</a>
        <a class="option-menu" href="{{ route('characters.index') }}">👤 Personajes</a>
        <a class="option-menu" href="{{ route('clues.index') }}">🔍 Pistas</a>
        <a class="option-menu" href="{{ route('dialogues.index') }}">💬 Dialogos</a>
    </div>
    <div class="content">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>
    @yield('postscripts')

</body>

</html>