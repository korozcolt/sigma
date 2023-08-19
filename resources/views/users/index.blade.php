<x-app-layout>
    <x-slot name="header">
        {{ __('Users') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs m-4">
        @if (Auth::user()->hasRole(['super_admin', 'admin']))
            {{-- make a button with onClick event --}}
            <a href="{{ route('users.create') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg">
                Crear Usuario
            </a>
        @endif


        <div class="mt-4 overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Role</th>
                            <th class="px-4 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($users as $user)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->email }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->role }}
                                </td>
                                <td>
                                    <x-modal-delete-confirmation :route="route('users.destroy', $user)" :id="$user->id">
                                        <x-slot name="trigger">
                                            <button type="button"
                                                class="text-red-500 hover:text-red-700 focus:outline-none">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </x-slot>
                                    </x-modal-delete-confirmation>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                {{ $users->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
