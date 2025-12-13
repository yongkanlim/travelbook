<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TravelBook</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">

<!-- TOP NAVBAR -->
<nav class="absolute top-0 left-0 w-full z-50">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4 text-white">

        <!-- LOGO -->
        <div class="text-2xl font-bold">
            TravelBook<span class="text-yellow-400">.com</span>
        </div>

        <!-- MENU -->
        <div class="hidden md:flex space-x-6">
            <a href="{{ route('destination') }}" class="hover:underline">Hotels & Homes</a>
            <a href="{{ route('bookings.index') }}" class="hover:underline">Your Booking</a>
        </div>

       <!-- AUTH BUTTONS -->
        <div class="flex items-center space-x-3">
            @auth
                <!-- DASHBOARD BUTTON -->
                <a href="{{ route('dashboard') }}"
                class="border border-white px-4 py-2 rounded hover:bg-white hover:text-black transition">
                    Dashboard
                </a>

                <!-- USER DROPDOWN (right of Dashboard) -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-2 px-4 py-2 border border-white rounded hover:bg-white hover:text-black transition">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
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
            @else
                <a href="{{ route('login') }}"
                class="border border-white px-4 py-2 rounded hover:bg-white hover:text-black transition">
                    Login
                </a>
                <a href="{{ route('register') }}"
                class="bg-white text-black px-4 py-2 rounded font-semibold">
                    Sign Up
                </a>
            @endauth
        </div>

    </div>
</nav>

<!-- PAGE CONTENT -->
{{ $slot }}

</body>
</html>
