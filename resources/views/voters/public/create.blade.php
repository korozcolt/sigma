<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SIGMA') }}</title>

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Scripts -->
    <script src="{{ asset('js/init-alpine.js') }}"></script>
</head>

<body class="bg-gray-200">
    <!-- Container -->
    <div class="container max-w-full mx-auto md:py-24 px-6">
        <div class="max-w-sm mx-auto px-6">
            <div class="relative flex flex-wrap">
                <div class="w-full relative">
                    <div class="md:mt-6">
                        <div class="text-center font-semibold text-black">
                            Registrate como votante apadrinado por
                        </div>
                        <div class="text-center font-base text-black">
                            {{ $leader->full_name }}
                        </div>
                        <form class="mt-8" method="post" action="{{ route('voters.save_voter') }}">
                            @csrf
                            <div class="mx-auto max-w-lg ">
                                <div class="py-1">
                                    <span class="px-1 text-sm text-gray-600">{{ __('Dni') }}</span>
                                    <input placeholder="Cedula" type="number" name="dni"
                                        class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                    <x-input-error :messages="$errors->get('dni')" class="mt-2" />
                                </div>
                                <div class="py-1">
                                    <span class="px-1 text-sm text-gray-600">{{ __('Nombre') }}</span>
                                    <input placeholder="Nombre" type="text" name="first_name"
                                        class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                                </div>
                                <div class="py-1">
                                    <span class="px-1 text-sm text-gray-600">{{ __('Apellido') }}</span>
                                    <input placeholder="Apellido" type="text" name="last_name"
                                        class="text-md block px-3 py-2 rounded-lg w-full
                bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white focus:border-gray-600 focus:outline-none">
                                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                                </div>
                                <div class="py-1">
                                    <span class="px-1 text-sm text-gray-600">{{ __('Phone') }}</span>
                                    <input placeholder="Telefono" type="tel" name="phone"
                                        class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white
                                        focus:border-gray-600 focus:outline-none">
                                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                </div>
                                <div class="py-1">
                                    <span class="px-1 text-sm text-gray-600">{{ __('Address') }}</span>
                                    <input placeholder="Direccion" type="text" name="address"
                                        class="text-md block px-3 py-2 rounded-lg w-full bg-white border-2 border-gray-300 placeholder-gray-600 shadow-md focus:placeholder-gray-500 focus:bg-white
                                        focus:border-gray-600 focus:outline-none">
                                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="place" :value="__('Place')" />
                                    <x-select-input-place :options="$places" id="place_id" name="place_id"
                                        value="{{ old('place_id') }}" required autofocus />
                                    <x-input-error :messages="$errors->get('place')" class="mt-2" />
                                </div>

                                <div class="mt-4">
                                    <x-input-label for="entity_parent" :value="__('Parent')" />
                                    <x-select-input-parents :options="$entityParents" id="entity_parent" name="entity_parent"
                                        value="{{ old('entity_parent') }}" required autofocus />
                                    <x-input-error :messages="$errors->get('entity_parent')" class="mt-2" />
                                </div>
                                <button
                                    class="mt-3 text-lg font-semibold
            bg-gray-800 w-full text-white rounded-lg
            px-6 py-3 block shadow-xl hover:text-white hover:bg-black">
                                    Registrarte
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    @include('sweetalert::alert')
    @yield('scripts')
</body>

</html>
