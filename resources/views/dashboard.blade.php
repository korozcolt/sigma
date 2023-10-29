<x-app-layout>
    <x-slot name="header">
        {{ __('Dashboard') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        {{-- cards with the count of coordinators, leaders and voter and a table with placer per voter information --}}
        <div>
            {{-- INFORMATION CARDS --}}
            <div class="grid grid-cols-12 gap-6 mt-5">
                <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                    href="#">
                    <div class="p-5">
                        <div class="flex justify-between">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                            </svg>
                            <div
                                class="bg-green-500 rounded-full h-6 px-2 flex justify-items-center text-white font-semibold text-sm">
                                <span class="flex items-center">0%</span>
                            </div>
                        </div>
                        <div class="ml-2 w-full flex-1">
                            <div>
                                <div id="votations_opinion" class="mt-3 text-3xl font-bold leading-8">{{ $votationsOpinion }}</div>

                                <div class="mt-1 text-base text-gray-600">Opinion</div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                    href="#">
                    <div class="p-5">
                        <div class="flex justify-between">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-yellow-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <div
                                class="bg-red-500 rounded-full h-6 px-2 flex justify-items-center text-white font-semibold text-sm">
                                <span class="flex items-center">0%</span>
                            </div>
                        </div>
                        <div class="ml-2 w-full flex-1">
                            <div>
                                <div id="votations_yes" class="mt-3 text-3xl font-bold leading-8">{{ $votationsYes }}</div>

                                <div class="mt-1 text-base text-gray-600">Regulares</div>
                            </div>
                        </div>
                    </div>
                </a>
                <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                    href="#">
                    <div class="p-5">
                        <div class="flex justify-between">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-pink-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                            </svg>
                            <div
                                class="bg-yellow-500 rounded-full h-6 px-2 flex justify-items-center text-white font-semibold text-sm">
                                <span class="flex items-center">0%</span>
                            </div>
                        </div>
                        <div class="ml-2 w-full flex-1">
                            <div>
                                <div id="votation_total" class="mt-3 text-3xl font-bold leading-8">{{ $votationsYes+$votationsOpinion }}</div>

                                <div class="mt-1 text-base text-gray-600">Totales</div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{-- INFORMATION TABLE --}}
            <div class="col-span-12 mt-5">
                <div class="grid gap-2 grid-cols-1 lg:grid-cols-1">
                    <div class="bg-white p-4 shadow-lg rounded-lg">
                        <h1 class="font-bold text-base">Votantes por puesto de votacion</h1>
                        <div class="mt-4">
                            <div class="flex flex-col">
                                <div class="my-2 overflow-x-auto">
                                    <div class="py-2 align-middle inline-block min-w-full">
                                        <div
                                            class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg bg-white">
                                            <table class="min-w-full divide-y divide-gray-200" id="data_table_real_time">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                            <div class="flex cursor-pointer">
                                                                <span class="mr-2">Lugar de Votación</span>
                                                            </div>
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                            <div class="flex cursor-pointer">
                                                                <span class="mr-2">Total Opinión</span>
                                                            </div>
                                                        </th>
                                                        <th
                                                            class="px-6 py-3 bg-gray-50 text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                                            <div class="flex cursor-pointer">
                                                                <span class="mr-2">Total Regular</span>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-gray-200">
                                                    @forelse ($votationCounts as $votation)
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                                <p>{{ $votation->nombre_puesto }}</p>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                                <p>{{ $votation->TOTAL_OPINION }}</p>
                                                            </td>
                                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                                <p>{{ $votation->TOTAL_YES }}</p>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5">
                                                                <p>No hay datos</p>
                                                            </td>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Función para recargar la página cada 10 segundos
        function autoReloadPage() {
            location.reload();
        }

        // Establecer un intervalo para llamar a la función cada 10 segundos (10000 milisegundos)
        setInterval(autoReloadPage, 10000);
    </script>
</x-app-layout>
