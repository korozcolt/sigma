<aside class="z-20 hidden w-64 overflow-y-auto bg-white md:block flex-shrink-0">
    <div class="py-4 text-gray-500">
        <a class="ml-6 text-lg font-bold text-gray-800" href="{{ route('dashboard') }}">
            <img src="{{ asset('images/logo-sigma.png') }}" alt="SIGMA" width="60%">
        </a>

        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    <x-slot name="icon">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </x-slot>
                    {{ __('Dashboard') }}
                </x-nav-link>
            </li>

            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('coordinators.index') }}" :active="request()->routeIs('coordinators.index')" :role="auth()
                    ->user()
                    ->isAdmin() ||
                    auth()
                        ->user()
                        ->hasRole('coordinator')">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                            <path
                                d="M674.865 664.575q-36.605 0-62.042-25.438-25.438-25.437-25.438-62.042 0-36.605 25.438-62.139 25.437-25.534 62.042-25.534 36.605 0 62.139 25.534 25.534 25.534 25.534 62.139 0 36.605-25.534 62.042-25.534 25.438-62.139 25.438ZM488.501 857.806V813.73q0-20.616 10.647-37.723 10.647-17.108 30.083-24.623 34.397-14.115 71.006-21.423 36.609-7.308 74.724-7.308 37.337 0 73.976 7.308 36.64 7.308 71.755 21.423 18.735 7.462 29.483 24.596 10.747 17.134 10.747 37.75v44.076H488.501Zm-97.002-293.307q-56.441 0-96.2-39.759-39.76-39.759-39.76-96.201 0-56.442 39.76-96.201 39.759-39.759 96.2-39.759 56.442 0 96.201 39.759 39.76 39.759 39.76 96.201 0 56.442-39.76 96.201-39.759 39.759-96.201 39.759Zm0-135.96ZM98.77 857.806v-84.348q0-28.588 15.219-52.822 15.218-24.233 41.781-36.597 55.335-27.736 114.775-42.387 59.439-14.651 120.812-14.651 28.88 0 57.472 3.711 28.592 3.712 57.092 9.789-11.654 11.845-23.801 24.185-12.147 12.339-23.544 23.929-16.538-3.039-33.538-4.346-17-1.308-33.565-1.308-54.814 0-108.221 12.942-53.406 12.943-101.868 37.943-11.846 6.153-19.25 16.299-7.404 10.145-7.404 23.677v28.024h242.423v55.96H98.77Zm298.383-55.96Zm-5.654-293.307q33 0 56.5-23.5t23.5-56.5q0-33-23.5-56.5t-56.5-23.5q-33 0-56.5 23.5t-23.5 56.5q0 33 23.5 56.5t56.5 23.5Z" />
                        </svg>
                    </x-slot>
                    {{ __('Coordinadores') }}
                </x-nav-link>
            </li>

            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('leaders.index') }}" :active="request()->routeIs('leaders.index')" :role="auth()
                    ->user()
                    ->isAdmin() ||
                    auth()
                        ->user()
                        ->hasRole(['coordinator', 'leader'])">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                            <path
                                d="M83.733 857.806v-84.075q0-30.17 15.316-53.396 15.317-23.226 41.684-36.34 55.999-27.263 112.441-42.129 56.442-14.865 123.596-14.865t123.346 14.865q56.192 14.866 112.453 42.133 26.315 13.194 41.623 36.393 15.307 23.2 15.307 53.339v84.075H83.733Zm664.651 0v-88.191q0-38.884-19.229-73.204-19.229-34.319-53.654-58.756 38.115 6.192 72.487 18.075 34.373 11.882 66.126 28.617 29.692 15.615 46.019 37.561 16.326 21.946 16.326 47.707v88.191H748.384ZM376.77 564.499q-56.225 0-95.689-39.463-39.463-39.464-39.463-95.689 0-56.226 39.463-95.689 39.464-39.464 95.689-39.464 56.225 0 95.689 39.464 39.463 39.463 39.463 95.689 0 56.225-39.463 95.689-39.464 39.463-95.689 39.463Zm330.842-135.581q0 55.78-39.463 95.431-39.464 39.65-95.689 39.65-5.654 0-15.01-1.382-9.357-1.382-15.412-3.041 23.372-27.33 35.821-60.717 12.448-33.387 12.448-69.81 0-36.289-12.807-69.61-12.808-33.322-35.462-61.13 7.5-2.769 15.307-3.442 7.808-.673 15.115-.673 56.225 0 95.689 39.575 39.463 39.575 39.463 95.149ZM139.693 801.846h473.846V773.78q0-12.778-6.269-22.606-6.269-9.828-20.193-17.328-49.099-25.154-100.301-38.02-51.201-12.865-109.921-12.865-58.889 0-110.256 12.865-51.367 12.866-100.444 38.02-14.116 7.5-20.289 17.364-6.173 9.865-6.173 22.521v28.115Zm237.015-293.307q32.754 0 56.004-23.188t23.25-55.942q0-32.755-23.188-56.005t-55.942-23.25q-32.754 0-56.004 23.188t-23.25 55.943q0 32.754 23.188 56.004t55.942 23.25Zm.062 293.307Zm0-372.499Z" />
                        </svg>
                    </x-slot>
                    {{ __('Lideres') }}
                </x-nav-link>
            </li>

            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('voters.index') }}" :active="request()->routeIs('voters.index')" :role="auth()
                    ->user()
                    ->isAdmin() ||
                    auth()
                        ->user()
                        ->hasRole(['coordinator', 'leader'])">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                            <path
                                d="M480 977.844 370.885 869.537H215.539q-28.437 0-48.353-19.916-19.915-19.915-19.915-48.262V272.256q0-28.346 19.915-48.262 19.916-19.916 48.262-19.916h529.104q28.346 0 48.262 19.916 19.915 19.916 19.915 48.262v529.103q0 28.347-19.915 48.262-19.916 19.916-48.353 19.916H589.115L480 977.844ZM203.231 776.885q53.457-52.249 124.24-82.317 70.782-30.067 152.501-30.067 81.72 0 152.522 30.067 70.802 30.068 124.275 82.317V272.347q0-4.616-3.846-8.462-3.847-3.847-8.462-3.847H215.539q-4.615 0-8.462 3.847-3.846 3.846-3.846 8.462v504.538Zm276.88-194.5q52.735 0 89.696-37.073 36.962-37.072 36.962-89.807t-37.073-89.696q-37.072-36.961-89.807-36.961t-89.696 37.072q-36.962 37.072-36.962 89.807t37.073 89.696q37.072 36.962 89.807 36.962Zm-.17-55.961q-29.207 0-49.978-20.829-20.771-20.83-20.771-50.038 0-29.207 20.829-49.978 20.83-20.771 50.038-20.771 29.207 0 49.978 20.83 20.771 20.829 20.771 50.037 0 29.207-20.829 49.978-20.83 20.771-50.038 20.771ZM480 899.192l86.423-85.615h136.694v-8.573q-47.385-42.697-104.4-63.62Q541.701 720.461 480 720.461q-61 0-117.77 20.731-56.77 20.731-105.347 63.043v9.342h136.694L480 899.192Zm0-380.73Z" />
                        </svg>
                    </x-slot>
                    {{ __('Votantes') }}
                </x-nav-link>
            </li>

            <li class="relative px-6 py-3">
                <x-nav-link href="{{ route('guides.index') }}" :active="request()->routeIs('guides.index')" :role="auth()
                    ->user()
                    ->isAdmin() ||
                    auth()
                        ->user()
                        ->hasRole(['coordinator', 'leader'])">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M260.032-719.913q-33.967 0-57.793-23.794-23.826-23.795-23.826-57.761 0-33.967 23.794-57.793 23.795-23.826 57.761-23.826 33.967 0 57.793 23.794 23.826 23.795 23.826 57.761 0 33.967-23.794 57.793-23.795 23.826-57.761 23.826ZM189-85.37v-271.043h-75v-235.5q0-35.537 25.231-60.769 25.231-25.231 60.769-25.231h119.761q36.261 0 61.13 23.913 24.87 23.913 24.87 58.739v77.652q-64.891 35.044-101.37 97.522Q267.913-357.609 267.913-283q0 48.935 15.939 92.38 15.94 43.445 44.235 75.968v29.282H189Zm352.5.957q-82.489 0-140.538-58.049Q342.913-200.511 342.913-283q0-67.391 41.989-121.772 41.989-54.38 107.511-69.25v87.218q-30.435 13.587-48.88 41.945Q425.087-316.5 425.087-283q0 49.005 33.704 82.709t82.709 33.704q47.63 0 81.315-33.598 33.685-33.598 35.381-81.228h82.652q-1.957 83-59.913 140-57.957 57-139.435 57Zm305.805-86.065-98.747-148.435H529.913v-322.174h82.174v240h181.326l123.109 185.783-69.217 44.826Z"/></svg>
                    </x-slot>
                    {{ __('Guias') }}
                </x-nav-link>
            </li>

            <li class="relative px-6 py-3">
                <button
                    class="inline-flex items-center justify-between w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    @click="toggleMultiLevelMenu" aria-haspopup="true">
                    <span class="inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960" width="24">
                            <path
                                d="m392.232 947.922-15.231-119.423q-7.385-1.846-25.231-11.692-17.847-9.847-40.847-24.655l-109.922 46.077-88.268-153.536 95.999-72.462q-1.577-8.59-2.058-17.103-.48-8.512-.48-18.743 0-7.731.73-16.943.731-9.212 2.116-21.289l-96.307-71.846 88.268-151.959 110.845 46.5q13.654-11.27 30.232-20.866 16.577-9.596 34.539-16.173l15.615-120.538H567.96l15.231 119.807q18.616 6.846 33.443 15.827 14.827 8.981 29.673 21.943l112.885-46.5 88.268 151.959-99.961 74.657q1.961 9.651 2.25 17.42.288 7.77.288 17.52 0 9.365-.385 17.526-.384 8.161-2.461 18.724l98.384 72.539-88.268 153.536-111-47.269q-13.731 11.539-28.539 20.347-14.807 8.807-34.577 16.807L567.96 947.922H392.232Zm86.445-255.962q48.169 0 81.995-33.867 33.827-33.867 33.827-82.134 0-48.266-33.856-82.093-33.855-33.826-82.105-33.826-48.614 0-82.287 33.867-33.673 33.867-33.673 82.134 0 48.266 33.673 82.093 33.673 33.826 82.426 33.826Zm-.139-55.96q-25 0-42.5-17.5t-17.5-42.5q0-25 17.5-42.5t42.5-17.5q24.808 0 42.404 17.5 17.596 17.5 17.596 42.5t-17.596 42.5Q503.346 636 478.538 636Zm1.154-60.5Zm-39.445 316.462h77.598l14.933-107.654q29.722-8 53.857-22.077 24.134-14.077 47.173-37.231l99.884 42.577 38.885-67.098L685 635q4.5-15.539 6.404-29.994 1.904-14.456 1.904-29.102 0-15.212-1.654-28.789Q690 533.539 685 517.769l88.346-66.961-38.077-67.193-102.154 43.193q-18.153-19.846-46.192-36.308t-54.615-23l-12.572-108.269h-79.121l-12.73 107.59q-31.616 7.717-55.52 21.179-23.903 13.461-48.557 37.808l-98.885-42.193-39.077 67.193 86.077 63.884q-5 15.039-7 30.046t-2 31.116q0 15.031 1.75 29.531 1.75 14.5 6.365 30.423l-85.192 64.577 39.069 67.192 98.2-42q23.885 23.885 48.847 38 24.961 14.115 55.452 21.615l12.833 106.77Z" />
                        </svg>
                        <span class="ml-4">Configuracion</span>
                    </span>
                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <template x-if="isMultiLevelMenuOpen">
                    <ul x-transition:enter="transition-all ease-in-out duration-300"
                        x-transition:enter-start="opacity-25 max-h-0" x-transition:enter-end="opacity-100 max-h-xl"
                        x-transition:leave="transition-all ease-in-out duration-300"
                        x-transition:leave-start="opacity-100 max-h-xl" x-transition:leave-end="opacity-0 max-h-0"
                        class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                        aria-label="submenu">
                        <li
                            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <x-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')" :role="auth()
                                ->user()
                                ->isAdmin()">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960"
                                        width="24">
                                        <path
                                            d="M567.692 543.692h264.616V359.077H567.692v184.615ZM700 498.308l-98.462-68.462v-35.385L700 462.923l98.462-68.462v35.385L700 498.308ZM104.615 880.616q-27.615 0-46.115-18.5Q40 843.616 40 816V336q0-27.616 18.5-46.116t46.115-18.5h750.77q27.615 0 46.115 18.5Q920 308.384 920 336v480q0 27.616-18.5 46.116t-46.115 18.5h-750.77Zm486.77-40.001h264q9.23 0 16.923-7.692Q880 825.231 880 816V336q0-9.231-7.692-16.923-7.693-7.692-16.923-7.692h-750.77q-9.23 0-16.923 7.692Q80 326.769 80 336v480q0 9.231 7.692 16.923 7.693 7.692 16.923 7.692h24q42-54.23 102.154-87.115Q290.923 720.615 360 720.615T489.231 753.5q60.154 32.885 102.154 87.115ZM360 665.231q41.539 0 70.769-29.231Q460 606.769 460 565.231q0-41.539-29.231-70.77Q401.539 465.23 360 465.23t-70.769 29.231Q260 523.692 260 565.231q0 41.538 29.231 70.769 29.23 29.231 70.769 29.231ZM182 840.615h356q-34.769-38-80.885-59-46.115-21-97.115-21-51 0-97 21t-81 59ZM360 625.23q-24.692 0-42.346-17.653Q300 589.923 300 565.231q0-24.693 17.654-42.346 17.654-17.654 42.346-17.654 24.692 0 42.346 17.654Q420 540.538 420 565.231q0 24.692-17.654 42.346Q384.692 625.23 360 625.23ZM480 576Z" />
                                    </svg>
                                </x-slot>
                                {{ __('Users') }}
                            </x-nav-link>
                        </li>
                        <li
                            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <x-nav-link href="{{ route('places.index') }}" :active="request()->routeIs('places.index')" :role="auth()
                                ->user()
                                ->isAdmin()">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960"
                                        width="24">
                                        <path
                                            d="M480 906.154q125.077-108.923 192.538-218.116Q740 578.846 740 504q0-118.231-75.269-193.115Q589.461 236 480 236t-184.731 74.885Q220 385.769 220 504q0 74.846 67.462 184.038Q354.923 797.231 480 906.154Zm0 54.461Q328.231 825.923 254.115 710.731 180 595.539 180 504q0-140.769 90.731-224.385Q361.461 196 480 196t209.269 83.615Q780 363.231 780 504q0 91.539-74.115 206.731Q631.769 825.923 480 960.615ZM378.461 602.154h67.693v-94.616h67.692v94.616h67.693V439.846L480 372.154l-101.539 67.692v162.308ZM480 504Z" />
                                    </svg>
                                </x-slot>
                                {{ __('Lugar de Votacion') }}
                            </x-nav-link>
                        </li>
                        <li
                            class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200">
                            <x-nav-link href="{{ route('sms.index') }}" :active="request()->routeIs('sms.index')" :role="auth()
                                ->user()
                                ->isAdmin()">
                                <x-slot name="icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 96 960 960"
                                        width="24">
                                        <path
                                            d="M320 526.769q12.385 0 21.577-9.192 9.192-9.192 9.192-21.577 0-12.385-9.192-21.577-9.192-9.192-21.577-9.192-12.385 0-21.577 9.192-9.192 9.192-9.192 21.577 0 12.385 9.192 21.577 9.192 9.192 21.577 9.192Zm160 0q12.385 0 21.577-9.192 9.192-9.192 9.192-21.577 0-12.385-9.192-21.577-9.192-9.192-21.577-9.192-12.385 0-21.577 9.192-9.192 9.192-9.192 21.577 0 12.385 9.192 21.577 9.192 9.192 21.577 9.192Zm160 0q12.385 0 21.577-9.192 9.192-9.192 9.192-21.577 0-12.385-9.192-21.577-9.192-9.192-21.577-9.192-12.385 0-21.577 9.192-9.192 9.192-9.192 21.577 0 12.385 9.192 21.577 9.192 9.192 21.577 9.192ZM120 899.077V280.615Q120 253 138.5 234.5 157 216 184.615 216h590.77Q803 216 821.5 234.5 840 253 840 280.615v430.77Q840 739 821.5 757.5 803 776 775.385 776H243.077L120 899.077Zm40-96.846L226.231 736h549.154q10.769 0 17.692-6.923T800 711.385v-430.77q0-10.769-6.923-17.692T775.385 256h-590.77q-10.769 0-17.692 6.923T160 280.615v521.616Zm0-521.616V256v546.231-521.616Z" />
                                    </svg>
                                </x-slot>
                                {{ __('SMS') }}
                            </x-nav-link>
                        </li>
                    </ul>
                </template>
            </li>

        </ul>
    </div>
</aside>
