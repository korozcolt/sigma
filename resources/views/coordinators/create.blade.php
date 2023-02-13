<x-app-layout>
    <div class="py-4">
        <h1 class="text-2xl font-bold mb-4">Crear Coordinador</h1>

        <form method="post" action="{{ route('coordinators.store') }}">
            @csrf
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="first_name">
                    First Name
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white {{ $errors->has('first_name') ? 'border-red-500' : '' }}"
                    id="first_name" name="first_name" type="text" value="{{ old('first_name') }}">
                @error('first_name')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="last_name">
                    Last Name
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white {{ $errors->has('last_name') ? 'border-red-500' : '' }}"
                    id="last_name" name="last_name" type="text" value="{{ old('last_name') }}">
                @error('last_name')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-2" for="phone">Teléfono</label>
                <input
                    class="ppearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white {{ $errors->has('phone') ? 'border-red-500' : '' }}"
                    type="text" id="phone" name="phone">
                @error('phone')
                    <p class="text-red-500 text-xs italic mt-4">
                        {{ $message }}
                    </p>
                @enderror
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
