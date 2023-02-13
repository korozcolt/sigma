<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="flex justify-between">
            <h1 class="text-2xl font-bold">Listado de Lugares</h1>
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg" id="showCreateFormButton">Crear Lugar</button>
        </div>
        <div class="mt-4" id="createForm" style="display: none;">
            <form action="{{ route('places.store') }}" method="post">
                @csrf
                <div class="flex">
                    <input type="text" name="place" class="border border-gray-400 px-4 py-2 mr-4 rounded-lg"
                        placeholder="Nombre del Lugar">
                    <input type="number" name="table" class="border border-gray-400 px-4 py-2 mr-4 rounded-lg"
                        placeholder="Cantidad de Mesas">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Guardar</button>
                </div>
            </form>
        </div>
        <table class="mt-8 w-full text-left table-collapse">
            <thead>
                <tr class="text-sm font-medium uppercase text-gray-700">
                    <th class="px-4 py-2">Nombre del Lugar</th>
                    <th class="px-4 py-2">Cantidad de Mesas</th>
                    <th class="px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($places as $place)
                    <tr class="text-sm border-t border-gray-400">
                        <td class="px-4 py-2">{{ $place->place }}</td>
                        <td class="px-4 py-2">{{ $place->table }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('places.edit', $place) }}" class="text-blue-500 hover:underline"><i
                                    class="fas fa-pencil-alt"></i></a>
                            <form action="{{ route('places.destroy', $place) }}" method="post" class="inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="text-red-500 hover:underline"><i
                                        class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="text-sm border-t border-gray-400">
                        <td colspan="3" class="px-4 py-2">No hay lugares registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $places->links() }}
</x-app-layout>

<script>
    const showCreateFormButton = document.getElementById("showCreateFormButton");
    const createForm = document.getElementById("createForm");

    showCreateFormButton.addEventListener("click", function() {
        if (createForm.style.display === "none") {
            createForm.style.display = "block";
        } else {
            createForm.style.display = "none";
        }
    });
</script>
