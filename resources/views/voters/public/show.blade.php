<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Scripts -->
    <script src="{{ asset('js/init-alpine.js') }}"></script>
    <title>Listado</title>
</head>
<body>
<div class="container mx-auto">
    <div class="m-4"><h1>Listado de Votantes - Cantidad: {{ $voters->count() }}</h1></div>

    <table class="w-full table-auto">
        <thead>
        <tr class="bg-gray-800 text-white">
            <th class="py-2 px-4">Nombre Completo</th>
            <th class="py-2 px-4">DNI</th>
            <th class="py-2 px-4">Teléfono</th>
            <th class="py-2 px-4">Lider</th>
            <th class="py-2 px-4">Lugar de votación</th>
            <th class="py-2 px-4">Estado</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($voters as $voter)
            <tr class="border-b">
                <td class="py-2 px-4 text-center">{{ $voter->full_name }}</td>
                <td class="py-2 px-4 text-center">{{ $voter->dni }}</td>
                <td class="py-2 px-4 text-center">{{ $voter->phone }}</td>
                <td class="py-2 px-4 text-center">{{ $voter->leader->full_name }}</td>
                <td class="py-2 px-4 text-center">{{ $voter->puesto }} - {{ $voter->mesa }}
                </td>

                <td class="py-2 px-4 text-center">
                                <span @class([
                                    'rounded-md px-2 py-1 text-white',
                                    'bg-orange-600' => $voter->status->pendiente(),
                                    'bg-green-600' => $voter->status->revisado(),
                                ])>{{ $voter->status->getLabelText() }}</span>
                </td>
            </tr>
        @empty
            <tr>
                <td class="py-2 px-4" colspan="6">No hay Votantes registrados</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
@yield('scripts')
</body>
</html>
