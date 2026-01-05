<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TravelBook</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
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
            <a href="{{ route('attractions.index') }}" class="hover:underline">Attractions</a>
            <a href="{{ route('attractionbooking.index') }}" class="hover:underline">Your Ticket</a>
            <a href="{{ route('api.docs') }}" class="hover:underline">API</a>
            <!-- Named route -->
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
                        <!-- Go to profile -->
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Call Tailwind Modal to Switch Role (Flowbite) -->
                        <x-dropdown-link href="#" 
                                    data-modal-target="switch-role-modal" 
                                    data-modal-toggle="switch-role-modal">
                        {{ __('Switch Role') }}
                        </x-dropdown-link>

                        <!-- Logout Link -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>

<!-- Switch Role Modal (Tailwind) -->
<div id="switch-role-modal" tabindex="-1" aria-hidden="true" 
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow-lg p-6 border border-gray-200">
            <!-- Modal header -->
            <div class="flex items-center justify-between border-b border-gray-200 pb-4">
                <h2 class="text-lg font-semibold text-gray-800">Switch Role</h2>
                <button type="button" 
                        class="text-gray-500 bg-transparent hover:bg-gray-100 hover:text-gray-700 rounded text-sm w-9 h-9 flex justify-center items-center"
                        data-modal-hide="switch-role-modal">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="py-4 space-y-4">
                <p class="text-sm text-gray-600">
                    <!-- --------------------------------------------------------------------------------
                        Current role: user / admin (Display)
                    -------------------------------------------------------------------------------------
                    Auth::user() retrieves the currently authenticated user
                    ->role accesses the role column in the users table 
                    --------------------------------------------------------------------------------- -->
                    Current role: <span class="font-medium">{{ Auth::user()->role }}</span>
                </p>

                <!-- -------------------------------------------------------------------------------------------
                    Form will call route 'switch.role' 
                ------------------------------------------------------------------------------------------------
                method="POST" → sends data securely
                route('switch.role') → calls a named route ([UserController::class, 'switchRole'] in web.php)
                [UserController::class, 'switchRole'] will call switchRole() in UserController.php
                -------------------------------------------------------------------------------------------- -->
                <form method="POST" action="{{ route('switch.role') }}" class="space-y-4">
                    <!-- ------------------------------------------------------------
                        @csrf
                    -----------------------------------------------------------------
                    Adds a hidden CSRF token
                    Protects against Cross-Site Request Forgery attacks
                    Laravel requires this for all POST, PUT, PATCH, DELETE forms 
                    ------------------------------------------------------------- -->
                    @csrf
                    <!-- type="password" hides input text
                    name="code" allows backend to read $request->code -->
                    <input type="password" name="code" placeholder="Enter verification code"
                           class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-yellow-400 text-gray-900 placeholder-gray-400">
                    <button type="submit" 
                            class="w-full bg-yellow-400 text-white px-3 py-2 rounded hover:bg-yellow-500">
                        Confirm & Switch
                    </button>
                </form>

                <!-- Error Message (red text invalid) shown when Verification code is incorrect / User is not authorized -->
                @if(session('error'))
                    <p class="text-red-500 text-sm mt-2">{{ session('error') }}</p>
                @endif
                <!-- Success Message (green text success) shown when Role switching is successful -->
                @if(session('success'))
                    <p class="text-green-500 text-sm mt-2">{{ session('success') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>

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
