<x-guest-layout>

<div class="min-h-screen flex items-center justify-center bg-cover bg-center"
     style="background-image:url('https://wallpapers.com/images/hd/travel-background-613yzbmemikozd15.jpg')">

    <div class="absolute inset-0 bg-black/50"></div>

    <div class="relative w-full max-w-md bg-white rounded-xl shadow-xl p-8">

        <h2 class="text-2xl font-bold text-center mb-6">
            Create your TravelBook<span class="text-blue-600">.com</span> account
        </h2>

        <!-- ORIGINAL CODE (UNCHANGED) -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full"
                    type="text" name="name" :value="old('name')" required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full"
                    type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                    type="password" name="password" required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                    type="password" name="password_confirmation" required />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <x-primary-button class="w-full justify-center mt-6">
                Register
            </x-primary-button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">
                Log in
            </a>
        </p>

    </div>
</div>

</x-guest-layout>
