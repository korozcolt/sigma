<x-app-layout>
    <div class="py-4">
        <h1 class="text-2xl font-bold mb-4">Editar Lider</h1>

        <form method="post" action="{{ route('leaders.update', $leader) }}">
            @csrf
            @method('PUT')
            <div class="mt-4">
                <div class="mt-4">
                    <x-input-label for="dni" :value="__('Cedula')" />
                    <x-text-input type="text" id="dni" name="dni"
                        class="block w-full bg-gray-100 text-gray-400 cursor-not-allowed" value="{{ $leader->dni }}"
                        disabled />
                    <x-input-error :messages="$errors->get('dni')" class="mt-2" />
                </div>
            </div>
            <div class="mt-4">
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input type="text" id="first_name" name="first_name" class="block w-full"
                    value="{{ old('first_name', $leader->first_name) }}" required autofocus />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input type="text" id="last_name" name="last_name" class="block w-full"
                    value="{{ old('last_name', $leader->last_name) }}" required autofocus />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input type="text" id="phone" name="phone" class="block w-full"
                    value="{{ old('phone', $leader->phone) }}" required autofocus />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="place" :value="__('Place')" />
                <x-select-input-place :options="$places" id="place_id" name="place_id" :exists_id="$leader->place_id"
                    value="{{ old('place_id', $leader->place_id) }}" required autofocus />
                <x-input-error :messages="$errors->get('place')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="coordinator" :value="__('Coordinator')" />
                <x-select-input-entities :options="$coordinators" id="coordinator_id" name="coordinator_id" :exists_id="$leader->coordinator_id"
                    value="{{ old('coordinator_id', $leader->coordinator_id) }}" required autofocus />
                <x-input-error :messages="$errors->get('coordinator')" class="mt-2" />
            </div>

            <div class="text-right mt-4 flex">
                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-l w-1/2"
                    onclick="window.location='{{ route('leaders.index') }}'">Cancelar</button>
                <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-r w-1/2">Actualizar</button>
            </div>
        </form>
    </div>
</x-app-layout>
