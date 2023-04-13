<div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in-out duration-150"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"></div>
<aside class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white md:hidden" x-show="isSideMenuOpen"
    x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.outside="closeSideMenu"
    @keydown.escape="closeSideMenu">
    <div class="py-4 text-gray-500 dark:text-gray-400">
        <a class="ml-6 text-lg font-bold text-gray-800" href="{{ route('dashboard') }}">
            SIGMA APP
        </a>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" :role="auth()
                    ->user()
                    ->isAdmin()">
                    <x-slot name="icon">
                        <svg class="w-5 h-5" aria-hidden="true" fill="none" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path
                                d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                            </path>
                        </svg>
                    </x-slot>
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </li>

            <li class="relative px-6 py-3">
                <x-responsive-nav-link href="{{ route('places.index') }}" :active="request()->routeIs('places')" :role="auth()
                    ->user()
                    ->isAdmin()">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="24px" height="32px" viewBox="0 0 24 32" version="1.1">
                            <g id="surface1">
                                <path style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,0%,0%);fill-opacity:1;"
                                    d="M 13.480469 31.199219 C 16.6875 27.1875 24 17.460938 24 12 C 24 5.375 18.625 0 12 0 C 5.375 0 0 5.375 0 12 C 0 17.460938 7.3125 27.1875 10.519531 31.199219 C 11.289062 32.15625 12.710938 32.15625 13.480469 31.199219 Z M 12 8 C 14.210938 8 16 9.789062 16 12 C 16 14.210938 14.210938 16 12 16 C 9.789062 16 8 14.210938 8 12 C 8 9.789062 9.789062 8 12 8 Z M 12 8 " />
                            </g>
                        </svg>
                    </x-slot>
                    {{ __('Lugar de votacion') }}
                </x-responsive-nav-link>
            </li>

            <li class="relative px-6 py-3">
                <x-responsive-nav-link href="{{ route('coordinators.index') }}" :active="request()->routeIs('coordinators')" :role="auth()
                    ->user()
                    ->isAdmin() ||
                    auth()
                        ->user()
                        ->hasRole(['leader', 'coordinator'])">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="24px" height="19px" viewBox="0 0 23 19" version="1.1">
                            <g id="surface1">
                                <path style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,0%,0%);fill-opacity:1;"
                                    d="M 5.175781 0 C 6.761719 0 8.050781 1.328125 8.050781 2.96875 C 8.050781 4.609375 6.761719 5.9375 5.175781 5.9375 C 3.585938 5.9375 2.300781 4.609375 2.300781 2.96875 C 2.300781 1.328125 3.585938 0 5.175781 0 Z M 18.398438 0 C 19.988281 0 21.273438 1.328125 21.273438 2.96875 C 21.273438 4.609375 19.988281 5.9375 18.398438 5.9375 C 16.8125 5.9375 15.523438 4.609375 15.523438 2.96875 C 15.523438 1.328125 16.8125 0 18.398438 0 Z M 0 11.085938 C 0 8.898438 1.71875 7.125 3.835938 7.125 L 5.367188 7.125 C 5.941406 7.125 6.484375 7.253906 6.972656 7.484375 C 6.925781 7.753906 6.902344 8.03125 6.902344 8.3125 C 6.902344 9.730469 7.507812 11.003906 8.460938 11.875 C 8.453125 11.875 8.445312 11.875 8.433594 11.875 L 0.765625 11.875 C 0.34375 11.875 0 11.519531 0 11.085938 Z M 14.566406 11.875 C 14.558594 11.875 14.550781 11.875 14.539062 11.875 C 15.496094 11.003906 16.097656 9.730469 16.097656 8.3125 C 16.097656 8.03125 16.070312 7.757812 16.027344 7.484375 C 16.515625 7.25 17.058594 7.125 17.632812 7.125 L 19.164062 7.125 C 21.28125 7.125 23 8.898438 23 11.085938 C 23 11.523438 22.65625 11.875 22.234375 11.875 Z M 8.050781 8.3125 C 8.050781 6.34375 9.59375 4.75 11.5 4.75 C 13.40625 4.75 14.949219 6.34375 14.949219 8.3125 C 14.949219 10.28125 13.40625 11.875 11.5 11.875 C 9.59375 11.875 8.050781 10.28125 8.050781 8.3125 Z M 4.601562 18.007812 C 4.601562 15.277344 6.746094 13.0625 9.390625 13.0625 L 13.609375 13.0625 C 16.253906 13.0625 18.398438 15.277344 18.398438 18.007812 C 18.398438 18.554688 17.972656 19 17.441406 19 L 5.558594 19 C 5.03125 19 4.601562 18.558594 4.601562 18.007812 Z M 4.601562 18.007812 " />
                            </g>
                        </svg>
                    </x-slot>
                    {{ __('Coordinadores') }}
                </x-responsive-nav-link>
            </li>

            <li class="relative px-6 py-3">
                <x-responsive-nav-link href="{{ route('leaders.index') }}" :active="request()->routeIs('leaders')" :role="auth()
                    ->user()
                    ->isAdmin() ||
                    auth()
                        ->user()
                        ->hasRole(['leader', 'coordinator'])">
                    <x-slot name="icon">
                        <svg width="24" height="32" viewBox="0 0 24 32" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="4" width="16" height="24" fill="#E5E7EB" />
                            <circle cx="12" cy="10" r="4" fill="#4B5563" />
                            <path
                                d="M12 26C15.31 26 18 23.31 18 20C18 16.69 15.31 14 12 14C8.69 14 6 16.69 6 20C6 23.31 8.69 26 12 26Z"
                                fill="#FBBF24" />
                        </svg>
                    </x-slot>
                    {{ __('Lideres') }}
                </x-responsive-nav-link>
            </li>

            <li class="relative px-6 py-3">
                <x-responsive-nav-link href="{{ route('voters.index') }}" :active="request()->routeIs('voters.index')" :role="auth()
                    ->user()
                    ->isAdmin() ||
                    auth()
                        ->user()
                        ->hasRole('coordinator') ||
                    auth()
                        ->user()
                        ->hasRole('leader')">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="32px" height="32px" viewBox="0 0 32 32" version="1.1">
                            <g id="surface1">
                                <path style=" stroke:none;fill-rule:nonzero;fill:rgb(0%,0%,0%);fill-opacity:1;"
                                    d="M 23 11.800781 C 22.71875 10.398438 21.601562 9.28125 20.160156 8.960938 C 19.800781 7.28125 18.320312 6.039062 16.558594 6.039062 L 9.679688 6.039062 C 7.640625 6.039062 6 7.679688 6 9.71875 L 6 16.601562 C 6 18.359375 7.238281 19.839844 8.921875 20.199219 C 9.199219 21.601562 10.320312 22.71875 11.761719 23.039062 C 12.121094 24.71875 13.601562 25.960938 15.359375 25.960938 L 22.238281 25.960938 C 24.28125 25.960938 25.921875 24.320312 25.921875 22.28125 L 25.921875 15.398438 C 25.921875 13.640625 24.679688 12.160156 23 11.800781 Z M 24.238281 15.398438 L 24.238281 22.28125 C 24.238281 22.359375 24.238281 22.441406 24.238281 22.519531 C 23.761719 21.398438 22.921875 20.441406 21.839844 19.800781 C 22.078125 19.320312 22.199219 18.800781 22.199219 18.238281 C 22.199219 16.359375 20.679688 14.839844 18.800781 14.839844 C 16.921875 14.839844 15.398438 16.359375 15.398438 18.238281 C 15.398438 18.800781 15.519531 19.320312 15.761719 19.800781 C 14.679688 20.441406 13.878906 21.398438 13.359375 22.519531 C 13.359375 22.441406 13.359375 22.359375 13.359375 22.28125 L 13.359375 15.398438 C 13.359375 14.28125 14.238281 13.398438 15.359375 13.398438 L 22.238281 13.398438 C 23.359375 13.398438 24.238281 14.28125 24.238281 15.398438 Z M 17.039062 18.28125 C 17.039062 17.320312 17.800781 16.558594 18.761719 16.558594 C 19.71875 16.558594 20.480469 17.320312 20.480469 18.28125 C 20.480469 19.238281 19.71875 20 18.761719 20 C 17.839844 20 17.039062 19.238281 17.039062 18.28125 Z M 7.679688 16.601562 L 7.679688 9.71875 C 7.679688 8.601562 8.558594 7.71875 9.679688 7.71875 L 16.558594 7.71875 C 17.359375 7.71875 18.039062 8.199219 18.359375 8.878906 L 12.519531 8.878906 C 10.480469 8.878906 8.839844 10.519531 8.839844 12.558594 L 8.839844 18.441406 C 8.160156 18.121094 7.679688 17.398438 7.679688 16.601562 Z M 10.519531 19.441406 L 10.519531 12.558594 C 10.519531 11.441406 11.398438 10.558594 12.519531 10.558594 L 19.398438 10.558594 C 20.199219 10.558594 20.878906 11.039062 21.199219 11.71875 L 15.359375 11.71875 C 13.320312 11.71875 11.679688 13.359375 11.679688 15.398438 L 11.679688 21.28125 C 11 20.960938 10.519531 20.238281 10.519531 19.441406 Z M 15.359375 24.28125 C 15.078125 24.28125 14.839844 24.238281 14.601562 24.121094 C 14.601562 24.078125 14.640625 24.039062 14.640625 24 C 14.921875 22.761719 15.761719 21.679688 16.921875 21.078125 C 17.480469 21.441406 18.121094 21.640625 18.800781 21.640625 C 19.480469 21.640625 20.160156 21.441406 20.679688 21.078125 C 21.839844 21.679688 22.679688 22.71875 22.960938 24 C 22.960938 24.039062 23 24.078125 23 24.121094 C 22.761719 24.199219 22.519531 24.28125 22.238281 24.28125 Z M 15.359375 24.28125 " />
                            </g>
                        </svg>
                    </x-slot>
                    {{ __('Votantes') }}
                </x-responsive-nav-link>
            </li>

            <li class="relative px-6 py-3">
                <x-responsive-nav-link href="{{ route('sms.index') }}" :active="request()->routeIs('sms.index')" :role="auth()
                    ->user()
                    ->isAdmin()">
                    <x-slot name="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            id="sms">
                            <path fill="none" d="M0 0h24v24H0V0z"></path>
                            <path
                                d="M20 2H4c-1.1 0-2 .9-2 2v18l4-4h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zM9 11H7V9h2v2zm4 0h-2V9h2v2zm4 0h-2V9h2v2z">
                            </path>
                        </svg>
                    </x-slot>
                    {{ __('SMS') }}
                </x-responsive-nav-link>
            </li>

            <li class="relative px-6 py-3">
                <x-responsive-nav-link href="{{ route('users.index') }}" :active="request()->routeIs('users.index')" :role="auth()
                    ->user()
                    ->isAdmin()">
                    <x-slot name="icon">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                    </x-slot>
                    {{ __('Users') }}
                </x-responsive-nav-link>
            </li>

        </ul>
    </div>
</aside>
