<nav x-data="{ open: false }"
    class="bg-yellow-600 border-b border-yellow-700 shadow-md dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <svg class="h-9 w-auto text-white dark:text-gray-200" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg> </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    @if (Auth::user()->roles == 'Admin')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                            class="text-white hover:text-yellow-100 dark:text-gray-200 dark:hover:text-yellow-300">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')"
                            class="text-white hover:text-yellow-100 dark:text-gray-200 dark:hover:text-yellow-300">
                            {{ __('Pengguna') }}
                        </x-nav-link>
                    @elseif(Auth::user()->roles == 'Pekerja' || Auth::user()->roles == 'Perekrut')
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                            class="text-white hover:text-yellow-100 dark:text-gray-200 dark:hover:text-yellow-300">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    @endif

                    <x-nav-link :href="route('lowongan.index')" :active="request()->routeIs('lowongan.index')"
                        class="text-white hover:text-yellow-100 dark:text-gray-200 dark:hover:text-yellow-300">
                        {{ __('Lowongan') }}
                    </x-nav-link>
                    <x-nav-link :href="route('pendaftaran.index')" :active="request()->routeIs('pendaftaran.index')"
                        class="text-white hover:text-yellow-100 dark:text-gray-200 dark:hover:text-yellow-300">
                        {{ __('Pendaftaran') }}
                    </x-nav-link>

                    @if (in_array(Auth::user()->roles, ['Admin', 'Perekrut']))
                        <x-nav-link :href="route('manajemen.index')" :active="request()->routeIs('manajemen.index')"
                            class="text-white hover:text-yellow-100 dark:text-gray-200 dark:hover:text-yellow-300">
                            {{ __('Manajemen') }}
                        </x-nav-link>
                    @endif

                    <x-nav-link :href="route('penggajian.index')" :active="request()->routeIs('penggajian.index')"
                        class="text-white hover:text-yellow-100 dark:text-gray-200 dark:hover:text-yellow-300">
                        {{ __('Penggajian') }}
                    </x-nav-link>
                    <x-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.index')"
                        class="text-white hover:text-yellow-100 dark:text-gray-200 dark:hover:text-yellow-300">
                        {{ __('Laporan') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white hover:text-yellow-100 dark:text-gray-200 dark:hover:text-yellow-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')"
                            class="text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-700">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-yellow-100 hover:bg-yellow-700 dark:hover:bg-gray-700 focus:outline-none focus:bg-yellow-700 dark:focus:bg-gray-700 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden bg-yellow-600 dark:bg-gray-800">
        <div class="pt-2 pb-3 space-y-1">
            @if (Auth::user()->roles == 'Admin')
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                    class="text-white hover:bg-yellow-700 dark:hover:bg-gray-700">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')"
                    class="text-white hover:bg-yellow-700 dark:hover:bg-gray-700">
                    {{ __('Pengguna') }}
                </x-responsive-nav-link>
            @elseif(Auth::user()->roles == 'Pekerja' || Auth::user()->roles == 'Perekrut')
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                    class="text-white hover:bg-yellow-700 dark:hover:bg-gray-700">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('lowongan.index')" :active="request()->routeIs('lowongan.index')"
                class="text-white hover:bg-yellow-700 dark:hover:bg-gray-700">
                {{ __('Lowongan') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('pendaftaran.index')" :active="request()->routeIs('pendaftaran.index')"
                class="text-white hover:bg-yellow-700 dark:hover:bg-gray-700">
                {{ __('Pendaftaran') }}
            </x-responsive-nav-link>

            @if (in_array(Auth::user()->roles, ['Admin', 'Perekrut']))
                <x-responsive-nav-link :href="route('manajemen.index')" :active="request()->routeIs('manajemen.index')"
                    class="text-white hover:bg-yellow-700 dark:hover:bg-gray-700">
                    {{ __('Manajemen') }}
                </x-responsive-nav-link>
            @endif

            <x-responsive-nav-link :href="route('penggajian.index')" :active="request()->routeIs('penggajian.index')"
                class="text-white hover:bg-yellow-700 dark:hover:bg-gray-700">
                {{ __('Penggajian') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.index')"
                class="text-white hover:bg-yellow-700 dark:hover:bg-gray-700">
                {{ __('Laporan') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-yellow-400 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-white dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-yellow-100 dark:text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:bg-yellow-700 dark:hover:bg-gray-700">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();"
                        class="text-white hover:bg-yellow-700 dark:hover:bg-gray-700">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
