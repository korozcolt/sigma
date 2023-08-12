<x-app-layout>
    <div class="py-4">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Importar Lista de Coordinadores</h1>
            <a href="{{ route('coordinators.example') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Descarga CSV Ejemplo
            </a>
        </div>
        <form id="import-form" class="flex items-center" method="post" action="{{ route('coordinators.import') }}">
            @csrf
            <input type="file" id="csv_file" name="csv_file" class="border border-gray-300 rounded p-1"
                accept=".csv" />
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 ml-4">Import
                CSV</button>
        </form>

        <table id="invalid-rows-table" class="w-full mt-4 border-collapse table-auto">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">Invalid Row</th>
                    <th class="border px-4 py-2">Errors</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($invalidRows as $invalidRow)
                    {{ $invalidRow }}
                @empty
                    <p>No hay filas invalidas</p>
                @endforelse
            </tbody>
        </table>
    </div>
    {{-- <script>
        document.querySelector('#import-form').addEventListener('submit', function(event) {
            event.preventDefault();
            importCSV();
        });

        function importCSV() {
            var formData = new FormData();
            formData.append('csv_file', document.querySelector('#csv_file').files[0]);
            console.log(formData);

            fetch('/coordinators/file/import', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // handle the response here
                    updateInvalidRowsTable(data.invalidRows);
                })
                .catch(error => {
                    // handle errors here
                    console.error(error);
                });
        }

        function updateInvalidRowsTable(invalidRows) {
            var tableBody = document.querySelector('#invalid-rows-table tbody');
            tableBody.innerHTML = '';

            if (invalidRows.length === 0) {
                alert('All rows imported successfully!');
            } else {
                invalidRows.forEach(function(row) {
                    var rowElement = document.createElement('tr');
                    rowElement.innerHTML = '<td>' + row.slice(0, -1).join(', ') + '</td><td>' + row[row.length -
                        1] + '</td>';
                    tableBody.appendChild(rowElement);
                });
            }
        }
    </script> --}}
</x-app-layout>
