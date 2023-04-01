<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #f2f2f2;
        }

        .logo {
            width: 100px;
            height: 50px;
            background-color: #ccc;
            margin-right: 10px;
        }

        .title {
            font-size: 24px;
            margin-top: 20px;
            margin-bottom: 10px;
            text-align: center;
        }

        .subtitle {
            font-size: 18px;
            text-align: center;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        .table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="logo"><img src="{{ asset('images/logo-sigma.png') }}" alt="LOGO SIGMA"></div>
        <div class="date">Fecha actual: <?php echo date('d/m/Y'); ?></div>
    </header>
    <h1 class="title">Título largo</h1>
    <h2 class="subtitle">Subtítulo corto</h2>
    <div class="info">
        <p>Información 1: 0</p>
        <p>Información 2: 0</p>
        <p>Información 3: 0</p>
        <p>Información 4: 0</p>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Columna 1</th>
                <th>Columna 2</th>
                <th>Columna 3</th>
                <th>Columna 4</th>
            </tr>
        </thead>
        <tbody>
            <?php for ($i=1; $i<=10; $i++) { ?>
            <tr>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>
