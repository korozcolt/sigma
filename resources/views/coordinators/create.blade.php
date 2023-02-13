<x-app-layout>
    <div class="py-4">
        <h1 class="text-2xl font-bold mb-4">Crear Coordinador</h1>

        <form>
            <div class="mb-4">
                <label class="block font-bold mb-2" for="dni">DNI</label>
                <input class="w-full border border-gray-400 p-2" type="text" id="dni" name="dni">
            </div>

            <div class="flex mb-4">
                <div class="w-1/2 pr-4">
                    <label class="block font-bold mb-2" for="first_name">Nombre</label>
                    <input class="w-full border border-gray-400 p-2" type="text" id="first_name" name="first_name">
                </div>

                <div class="w-1/2 pl-4">
                    <label class="block font-bold mb-2" for="last_name">Apellido</label>
                    <input class="w-full border border-gray-400 p-2" type="text" id="last_name" name="last_name">
                </div>
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2" for="phone">Teléfono</label>
                <input class="w-full border border-gray-400 p-2" type="text" id="phone" name="phone">
            </div>

            <div class="mb-4">
                <label class="block font-bold mb-2" for="place_id">Lugar</label>
                <select class="w-full border border-gray-400 p-2" id="place_id" name="place_id">
                    @foreach ($places as $place)
                        <option value="{{ $place->id }}">{{ $place->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="text-right">
                <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">Guardar</button>
            </div>
        </form>
    </div>
</x-app-layout>
