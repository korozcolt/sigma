<x-app-layout>
    <div class="py-4">
        <h1 class="text-2xl font-bold mb-4">Editar Votante</h1>

        <form method="post" action="{{ route('voters.update', $voter) }}">
            @csrf
            @method('PUT')
            <div class="mt-4">
                <div class="mt-4">
                    <x-input-label for="dni" :value="__('Cedula')" />
                    <x-text-input type="text" id="dni" name="dni"
                        class="block w-full bg-gray-100 text-gray-400 cursor-not-allowed" value="{{ $voter->dni }}"
                        disabled />
                    <x-input-error :messages="$errors->get('dni')" class="mt-2" />
                </div>
            </div>
            <div class="mt-4">
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input type="text" id="first_name" name="first_name" class="block w-full"
                    value="{{ old('first_name', $voter->first_name) }}" required autofocus />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input type="text" id="last_name" name="last_name" class="block w-full"
                    value="{{ old('last_name', $voter->last_name) }}" required autofocus />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="phone" :value="__('Phone')" />
                <x-text-input type="text" id="phone" name="phone" class="block w-full"
                    value="{{ old('phone', $voter->phone) }}" required autofocus />
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="address" :value="__('Address')" />
                <x-text-input type="text" id="address" name="address" class="block w-full"
                    value="{{ old('address', $voter->address) }}" required autofocus />
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="place" :value="__('Place')" />
                <x-select-input-place :options="$places" id="place_id" name="place_id"
                    value="{{ old('place_id', $voter->place_id) }}" required autofocus />
                <x-input-error :messages="$errors->get('place')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="entity_parent" :value="__('Parent')" />
                <select name="entity_parent" id="entity_parent"
                    value="{{ old('entity_parent', $voter->entity_parent) }}"
                    class="form-select mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600 w-full select2">
                    <option value="amigo">Amigo(a)</option>
                    <option value="padre">Padre</option>
                    <option value="madre">Madre</option>
                    <option value="hermano">Hermano(a)</option>
                    <option value="tio">Tio(a)</option>
                    <option value="abuelo">Abuelo(a)</option>
                    <option value="esposo">Esposo(a)</option>
                    <option value="novio">Novio(a)</option>
                    <option value="hijo">Hijo(a)</option>
                    <option value="primo">Primo(a)</option>
                    <option value="sobrino">Sobrino(a)</option>
                    <option value="nieto">Nieto(a)</option>
                    <option value="cunado">Cuñado(a)</option>
                    <option value="suegro">Suegro(a)</option>
                    <option value="yerno">Yerno</option>
                    <option value="nuera">Nuera</option>
                </select>
                <x-input-error :messages="$errors->get('entity_parent')" class="mt-2" />
            </div>

            <div class="text-right mt-4 flex">
                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-l w-1/2"
                    onclick="window.location='{{ route('voters.index') }}'">Cancelar</button>
                <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-r w-1/2">Actualizar</button>
            </div>
        </form>
    </div>
</x-app-layout>
