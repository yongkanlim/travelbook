{{-- resources/views/dashboard.blade.php --}}

<!-- -----------------------------------------------------------------------------------------------
    Uses a Blade layout component (Top navigation bar, Global styles) 
    [use layout.app.blade.php that will include also layout.navigation.blade.php to display navbar] 
 ----------------------------------------------------------------------------------------------- -->
<x-app-layout>
    <x-slot name="header">
        {{-- You can leave this empty if using custom navbar --}}
    </x-slot>

    {{-- Hero Section --}}
    <!-- ------------------------------------------------------------------------
        Display a image & title (hero section like the upper banner of website) 
    ------------------------------------------------------------------------- -->
    <section class="relative h-[400px] bg-cover bg-center"
        style="background-image:url('https://wallpapers.com/images/hd/travel-background-613yzbmemikozd15.jpg')">
        <!-- Dark Overlay - dark layer on top of image -->
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative max-w-6xl mx-auto pt-32 px-6 text-white text-center">
            <!-- Auth::user() retrieves logged-in user, ->name displays the user's name -->
            <h1 class="text-4xl font-bold mb-4">Welcome Back, {{ Auth::user()->name }}!</h1>
            <p class="mb-6">Explore your dashboard and manage your bookings easily.</p>
            <a href="{{ route('destinations.index') }}"
               class="bg-blue-600 hover:bg-blue-700 transition rounded p-3 text-white font-semibold">
               View Destinations →
            </a>
        </div>
    </section>

    {{-- 3 Dashboard Cards with some padding & center content --}}
    <section class="max-w-7xl mx-auto px-6 py-10">
        <h2 class="text-2xl font-bold mb-6">Dashboard Overview</h2>
        <div class="grid md:grid-cols-3 gap-6">

            <div class="bg-white rounded shadow p-6">
                <h3 class="font-bold text-lg mb-2">Your Bookings</h3>
                <p class="text-gray-600 mb-4">Check your upcoming trips.</p>
                <a href="{{ route('bookings.index') }}" class="text-blue-600 hover:underline">View Bookings →</a>
            </div>

            <div class="bg-white rounded shadow p-6">
                <h3 class="font-bold text-lg mb-2">Destinations</h3>
                <p class="text-gray-600 mb-4">Explore all available destinations.</p>
                <a href="{{ route('destinations.index') }}" class="text-blue-600 hover:underline">Explore →</a>
            </div>

            <div class="bg-white rounded shadow p-6">
                <h3 class="font-bold text-lg mb-2">Profile Settings</h3>
                <p class="text-gray-600 mb-4">Update your personal information.</p>
                <a href="{{ route('profile.edit') }}" class="text-blue-600 hover:underline">Edit Profile →</a>
            </div>

        </div>
    </section>
</x-app-layout>
