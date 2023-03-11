<x-app-layout>
    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="flex justify-between mb-3">
            <h1 class="text-2xl font-bold">Listado de Lugares</h1>
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg" id="showCreateFormButton">Crear Lugar</button>
        </div>
        <div class="mt-4 mb-4" id="createForm" style="display: none;">
            <form action="{{ route('sms.store') }}" method="post">
                @csrf
                <div class="flex">
                    <select name="option_send" id="option_send"
                        class="border border-gray-400 px-4 py-2 mr-4 rounded-lg">
                        <option value="1">Coordinadores</option>
                        <option value="2">Lideres</option>
                        <option value="3">Votantes</option>
                        <option value="0">Todos</option>
                    </select>
                    <div class="mt-4">
                        <x-input-label for="first_name" :value="__('First Name')" />
                        <x-text-input type="text" id="message" name="message" class="block w-full"
                            value="{{ old('message') }}" required autofocus <button type="submit" />
                    </div>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">Guardar</button>
                </div>
            </form>
        </div>
    </div>

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
