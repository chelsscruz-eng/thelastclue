<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>The Last Clue</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <style>
        .game-title{
            color:#2E1F13;
            font-size:60px;
            font-weight:bold;
        }

        .title-line{
            width:180px;
            border:2px solid #100f0e;
            opacity:1;
            margin:25px 0;
        }

        .game-text{
            color:#3B2A1D;
            font-size:22px;
            line-height:1.8;
            margin-bottom:25px;
        }
        
        .exception{
            color: #F5E5C9;
            font-size:22px;
            line-height:1.8;
            margin-bottom:25px;
        }
        .exception-title{
            color: #F5E5C9;
            font-size:60px;
            font-weight:bold;
        }

        .case-card{
            background:#FFFFFF;
            border:2px solid #151515;
            border-radius:15px;
            padding:22px;
            height:240px;
            display:flex;
            flex-direction:column;
            justify-content:space-between;  
            transition:.3s;
        }

        .case-card h3{
            color:#2E1F13;
            margin-bottom:15px;
        }

        .case-card p{
            color:#3B2A1D;
            font-size:15px;
        }

        .play-button{
            background:#473623;
            color:#F4EBD0;
            border:none;
            padding:10px 30px;
        }

        .play-button:hover{
            background:#4E311A;
            color:#F4EBD0;
        }
        
        .back-button {
            position:absolute;
            top:30px;
            left:30px;
            width:60px;
            height:60px;
            border:2px solid #E3D3AC;
            border-radius:50%;
            display:flex;
            align-items:center;
            justify-content:center;
            color:#E3D3AC;
            font-size:32px;
            text-decoration:none;
        }

        .home-button {
            position:fixed;
            bottom:30px;
            right:30px;
            color:#E3D3AC;
            font-size:35px;
            text-decoration:none;
            z-index:1000;
        }

        </style>
</head>
<body>

    @yield('content')
    @yield('postscripts')
</body>
</html>