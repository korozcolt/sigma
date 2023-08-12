<x-app-layout>
    <div class="py-4">
        <h1 class="text-2xl font-bold mb-4">Crear Usuario</h1>

        <form method="post" action="{{ route('users.store') }}">
            @csrf
            <div class="mt-4">
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input type="text" id="name" name="name" class="block w-full"
                              value="{{ old('name') }}" required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mt-4">
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input type="email" id="email" name="email" class="block w-full"
                                  value="{{ old('email') }}" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input type="password" id="password" name="password" class="block w-full"
                              value="{{ old('password') }}" required autofocus />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <label for="role">Rol</label>
                <select class="" id="role" name="role" required autofocus>
                    <option value="admin" selected>Admin</option>
                    <option value="digitizer" selected>Digitador</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>


            <div class="text-right mt-4 flex">
                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-l w-1/2"
                        onclick="window.location='{{ route('users.index') }}'">Cancelar</button>
                <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded-r w-1/2">Guardar</button>
            </div>
        </form>
    </div>
</x-app-layout>
