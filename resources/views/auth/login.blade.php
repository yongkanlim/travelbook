<x-guest-layout>

<!-- Background -->
<div class="min-h-screen flex items-center justify-center bg-cover bg-center"
     style="background-image:url('https://wallpapers.com/images/hd/travel-background-613yzbmemikozd15.jpg')">

    <div class="absolute inset-0 bg-black/50"></div>

    <!-- Card -->
    <div class="relative w-full max-w-md bg-white rounded-xl shadow-xl p-8">

        <!-- Title -->
        <h2 class="text-2xl font-bold text-center mb-6">
            Sign in to TravelBook<span class="text-blue-600">.com</span>
        </h2>

        <!-- ORIGINAL CODE (UNCHANGED) -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full"
                    type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                    type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" class="rounded border-gray-300">
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>

                <a href="{{ route('password.request') }}"
                   class="text-sm text-blue-600 hover:underline">
                   Forgot password?
                </a>
            </div>

            <x-primary-button class="w-full justify-center mt-6">
                Log in
            </x-primary-button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            New to Trip.com?
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">
                Create an account
            </a>
        </p>

    </div>
</div>

</x-guest-layout>
