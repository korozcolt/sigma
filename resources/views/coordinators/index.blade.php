<x-app-layout>
    <x-slot name="header">
        {{ __('Coordinadores') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="flex items-center justify-between mb-3">
            <h1 class="text-gray-700 text-2xl">Listado de Coordinadores</h1>
            @if (Auth::user()->hasRole(['super_admin', 'admin', 'coordinator']))
                <a href="{{ route('coordinators.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                    Crear Coordinador
                </a>
            @endif
        </div>

        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="py-2 px-4">Nombre Completo</th>
                    <th class="py-2 px-4">DNI</th>
                    <th class="py-2 px-4">Teléfono</th>
                    <th class="py-2 px-4">Lugar de votacion</th>
                    <th class="py-2 px-4"><i class="fa-solid fa-gear"></i></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($coordinators as $coordinator)
                    <tr class="border-b">
                        <td class="py-2 px-4 text-center">{{ $coordinator->full_name }}</td>
                        <td class="py-2 px-4  text-center">{{ $coordinator->dni }}</td>
                        <td class="py-2 px-4 text-center">{{ $coordinator->phone }}</td>
                        <td class="py-2 px-4 text-center">{{ $coordinator->place->place }} - Mesa:
                            {{ $coordinator->place->table }}
                        </td>
                        @if (Auth::user()->hasRole(['super_admin', 'admin', 'coordinator']))
                            <td class="py-2 px-4 flex items-center text-center">
                                <a href="{{ route('coordinators.edit', $coordinator) }}"
                                    class="text-blue-500 hover:text-blue-700 mr-4">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <x-modal-delete-confirmation :route="route('coordinators.destroy', $coordinator)" :id="$coordinator->id">
                                    <x-slot name="trigger">
                                        <button type="button"
                                            class="text-red-500 hover:text-red-700 focus:outline-none">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </x-slot>
                                </x-modal-delete-confirmation>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td class="py-2 px-4" colspan="4">No hay coordinadores registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $coordinators->links() }}
    </div>
</x-app-layout>
