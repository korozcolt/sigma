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
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="py-2 px-4">Puesto de Votacion</th>
                    <th class="py-2 px-4">Mesa</th>
                    <th class="py-2 px-4"><i class="fa-solid fa-gear"></i></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($places as $place)
                    <tr class="border-b">
                        <td class="py-2 px-4 text-center">{{ $place->place }}</td>
                        <td class="py-2 px-4  text-center">{{ $place->table }}</td>
                        <td class="py-2 px-4 flex items-center text-center">
                            <a href="{{ route('places.edit', $place) }}" class="text-blue-500 hover:text-blue-700 mr-4">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <x-modal-delete-confirmation :route="route('places.destroy', $place)" :id="$place->id">
                                <x-slot name="trigger">
                                    <button type="button" class="text-red-500 hover:text-red-700 focus:outline-none">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </x-slot>
                            </x-modal-delete-confirmation>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="py-2 px-4" colspan="4">No hay Puestos de Votacion registrados</td>
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
