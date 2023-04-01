<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SIGMA APP</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            width: 100%;
            height: 100vh;
            background-image: url('https://images.pexels.com/photos/14730593/pexels-photo-14730593.jpeg');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .container h1 {
            font-size: 60px;
            color: #fff;
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 50px;
        }

        .container h1 a {
            color: #fff;
            text-decoration: none;
        }

        .container a {
            text-decoration: none;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 20px;
            color: #fff;
            background-color: #2196F3;
            border: none;
            border-radius: 5px;
            margin: 20px;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .btn:hover {
            background-color: #0D47A1;
        }

        .btn:active {
            transform: scale(0.95);
        }

        .btn-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .btn-container a:first-child {
            margin-right: 20px;
        }

        .btn-container a:last-child {
            margin-left: 20px;
        }
    </style>

</head>

<body>
    <div class="container">
        <h1><a href="/login">SIGMA APP</a></h1>
        <div class="btn-container">
            <a href="/login" class="btn">Iniciar Sesion</a>
            <a href="/votation" class="btn">Ir a Votación</a>
        </div>
    </div>
</body>

</html>
