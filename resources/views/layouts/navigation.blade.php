<nav class="bg-white shadow-md fixed w-full z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">
        
        <!-- LOGO -->
        <div class="text-2xl font-bold text-gray-800">
            TravelBook<span class="text-yellow-400">.com</span>
        </div>

        <!-- NAV LINKS -->
        <div class="hidden md:flex space-x-6">
            <a href="{{ route('dashboard') }}" 
               class="hover:underline {{ request()->routeIs('dashboard') ? 'font-semibold text-gray-900' : 'text-gray-600' }}">
                Dashboard
            </a>
            <a href="{{ route('destination') }}" 
               class="hover:underline {{ request()->routeIs('destination') ? 'font-semibold text-gray-900' : 'text-gray-600' }}">
                Hotels & Homes
            </a>
            <a href="{{ route('bookings.index') }}" class="hover:underline text-gray-600">Your Booking</a>
            <a href="{{ route('attractions.index') }}" class="hover:underline text-gray-600">Attractions</a>
        </div>

        <!-- AUTH DROPDOWN -->
        <div class="hidden md:flex items-center space-x-4">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="flex items-center space-x-2 px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition">
                        <span>{{ Auth::user()->name }}</span>
                        <svg class="h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>

        <!-- MOBILE MENU BUTTON -->
        <div class="md:hidden flex items-center">
            <button @click="open = !open" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- MOBILE MENU -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden bg-white border-t border-gray-200">
        <div class="px-4 py-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block px-2 py-2 text-gray-700 hover:bg-gray-100 rounded">Dashboard</a>
            <a href="{{ route('destination') }}" class="block px-2 py-2 text-gray-700 hover:bg-gray-100 rounded">Hotels & Homes</a>
            <a href="#" class="block px-2 py-2 text-gray-700 hover:bg-gray-100 rounded">Your Booking</a>

            <div class="border-t border-gray-200 mt-2 pt-2">
                <div class="text-gray-800 font-medium">{{ Auth::user()->name }}</div>
                <div class="text-gray-500 text-sm">{{ Auth::user()->email }}</div>

                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>