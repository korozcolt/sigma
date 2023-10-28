@extends('votations.layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-bold mb-4 text-white">Votaciones</h1>

        <form id="search-form" class="mb-4">
            @csrf
            <div class="mb-4">
                <label for="cedula" class="block text-sm font-medium text-white">Busqueda por Cedula</label>
                <input type="text" id="cedula" name="cedula" class="mt-1 p-2 w-full rounded border border-gray-300" placeholder="Ingrese Cedula">
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Buscar</button>
            <button type="button" id="clear-button" class="bg-gray-300 hover:bg-gray-400 text-gray-700 font-bold py-2 px-4 rounded">Borrar</button>
        </form>

        <div id="search-results" class="text-white"></div>
        <button type="button" id="update-button" class="hidden bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Registrar Votante</button>
        <div id="loader" class="hidden bg-white opacity-75 w-full h-full fixed block top-0 left-0">
            <div class="text text-indigo-500 opacity-100 top-1/2 my-0 mx-auto block relative w-0 h-0" style="top: 45%">
                Cargando...
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#search-form').on('submit', function (e) {
                e.preventDefault();
                const cedula = $('#cedula').val();

                // Show the loader while waiting for the response
                $('#loader').removeClass('hidden');

                $.ajax({
                    type: 'GET',
                    url: `{{ route('votations.show', ['cedula' => ':cedula']) }}`.replace(':cedula', cedula),
                    success: function (data) {
                        displaySearchResults(data);

                        // Hide the loader when the response is received
                        $('#loader').addClass('hidden');

                        // Show the "Registrar Votante" button when search results are available
                        $('#update-button').removeClass('hidden');
                    },
                    error: function () {
                        $('#search-results').html('<p>No results found.</p>');

                        // Hide the loader when there's an error
                        $('#loader').addClass('hidden');

                        // Hide the "Registrar Votante" button when there are no results
                        $('#update-button').addClass('hidden');
                    }
                });
            });

            $('#clear-button').on('click', function () {
                $('#cedula').val(''); // Clear the input
                $('#search-results').html(''); // Clear the search results
                $('#update-button').addClass('hidden'); // Hide the "Registrar Votante" button
            });

            $('#update-button').on('click', function () {
                const cedula = $('#cedula').val();
                const currentURL = window.location.href;

                const parts = currentURL.split('/');
                const password = parts[parts.length - 1];
                const csrfToken = '{{ csrf_token() }}';

                // Show the loader while waiting for the response
                $('#loader').removeClass('hidden');
                $.ajax({
                    type: 'PUT',
                    url: `{{ route('votations.update') }}`,
                    data: {
                        _token: csrfToken,
                        cedula: cedula,
                    },
                    success: function (data) {
                        $('#loader').addClass('hidden');
                        $('#cedula').val('');
                        $('#search-results').html('');
                        $('#update-button').addClass('hidden');
                        if (data.option === 'OPINION') {
                            Swal.fire(
                                'Excelente!',
                                'Su voto de opinión ha sido registrado con éxito.',
                                'success'
                            );
                        } else if (data.option === 'YES') {
                            Swal.fire(
                                'Excelente!',
                                'Su voto ha sido registrado con éxito.',
                                'success'
                            )
                        }
                    },
                    error: function () {
                        // Handle error response here
                        Swal.fire(
                            'Error!',
                            'No se pudo registrar el votante.',
                            'error'
                        )

                        // Hide the loader when there's an error
                        $('#loader').addClass('hidden');
                    }
                });
            });

            function displaySearchResults(data) {
                if (data) {
                    const resultsHtml = `
                            <h2 class="text-xl font-bold mb-2">Resultados de busqueda</h2>
                            <p><span class="font-bold">Cedula:</span> ${data.cedula}</p>
                            <p><span class="font-bold">Nombre Puesto:</span> ${data.nombre_puesto}</p>
                            <p><span class="font-bold">Mesa:</span> ${data.mesa}</p>
                            <p><span class="font-bold">Municipio:</span> ${data.municipio}</p>
                        `;
                    $('#search-results').html(resultsHtml);
                } else {
                    $('#search-results').html('<p>No results found.</p>');
                }
            }
        });
    </script>
@endsection
