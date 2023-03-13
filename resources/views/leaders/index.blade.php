<x-app-layout>
    <x-slot name="header">
        {{ __('Líderes') }} - {{ $leaders->count() }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="flex items-center justify-between mb-3">
            <h1 class="text-gray-700 text-2xl">Listado de Líderes</h1>
            @if (Auth::user()->hasRole(['super_admin', 'admin', 'coordinator']))
                <a href="{{ route('leaders.create') }}"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                    Crear Líder
                </a>
            @endif
        </div>

        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="py-2 px-4">Nombre Completo</th>
                    <th class="py-2 px-4">DNI</th>
                    <th class="py-2 px-4">Teléfono</th>
                    <th class="py-2 px-4">Coordinador</th>
                    <th class="py-2 px-4">Lugar de votación</th>
                    @if (auth()->user()->isAdmin())
                        <th class="py-2 px-4">Estado</th>
                    @endif
                    <th class="py-2 px-4"><i class="fa-solid fa-gear"></i></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($leaders as $leader)
                    <tr class="border-b">
                        <td class="py-2 px-4 text-center">{{ $leader->full_name }}</td>
                        <td class="py-2 px-4 text-center">{{ $leader->dni }}</td>
                        <td class="py-2 px-4 text-center">{{ $leader->phone }}</td>
                        <td class="py-2 px-4 text-center">{{ $leader->coordinator->full_name }}</td>
                        <td class="py-2 px-4 text-center">{{ $leader->place->place }} - Mesa:
                            {{ $leader->place->table }}
                        </td>
                        @if (auth()->user()->isAdmin())
                            <td class="py-2 px-4 text-center">
                                <span @class([
                                    'rounded-md px-2 py-1 text-white',
                                    'bg-orange-600' => $leader->status->pendiente(),
                                    'bg-green-600' => $leader->status->revisado(),
                                ])>{{ $leader->status->getLabelText() }}</span>
                            </td>
                        @endif
                        @if (auth()->user()->isAdmin() ||
                                auth()->user()->hasRole('coordinator'))
                            <td class="py-2 px-4 flex items-center text-center">
                                <a href="{{ route('leaders.edit', $leader) }}"
                                    class="text-blue-500 hover:text-blue-700 mr-4">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <x-modal-delete-confirmation :route="route('leaders.destroy', $leader)" :id="$leader->id">
                                    <x-slot name="trigger">
                                        <button type="button"
                                            class="text-red-500 hover:text-red-700 focus:outline-none">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </x-slot>
                                </x-modal-delete-confirmation>
                                <x-modal-reviewer-confirmation :route="route('leaders.status', $leader)" :id="$leader->id">
                                    <x-slot name="trigger">
                                        <button type="button"
                                            class="text-orange-500 hover:text-orange-700 focus:outline-none mr-2">
                                            <i class="fas fa-exchange-alt"></i>
                                        </button>
                                    </x-slot>
                                </x-modal-reviewer-confirmation>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td class="py-2 px-4" colspan="6">No hay líderes registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $leaders->links() }}
    </div>

</x-app-layout>
