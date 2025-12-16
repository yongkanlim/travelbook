{{-- resources/views/destinations/index.blade.php --}}
<x-guest-layout>

<section class="relative h-[500px] bg-cover bg-center"
    style="background-image:url('https://wallpapers.com/images/hd/travel-background-613yzbmemikozd15.jpg')">
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative max-w-6xl mx-auto pt-40 px-6 text-white">
        <h1 class="text-4xl font-bold mb-4">
            Find Your Next Stay
        </h1>

        <form method="GET" action="{{ route('destinations.index') }}" 
            class="bg-white rounded-lg p-4 flex gap-3 text-black">
            
            <!-- Search Input: 70% -->
            <input type="text" name="search" 
                class="border p-3 rounded flex-[7]" 
                placeholder="Search destination or location" 
                value="{{ request('search') }}">

            <!-- Search Button: 30% -->
            <button type="submit" 
                    class="bg-blue-600 text-white rounded p-3 flex-[3]">
                Search
            </button>
        </form>

    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-10">
    <h2 class="text-2xl font-bold mb-6">Available Destinations</h2>

    <div class="grid md:grid-cols-3 gap-6">
        @foreach ($destinations as $d)
        <div class="bg-white rounded shadow">
            <div class="p-4">
                <h3 class="font-bold text-lg">{{ $d->name }}</h3>
                <p class="text-gray-600">{{ $d->location }}</p>
                <p class="text-blue-600 font-semibold mt-2">
                    RM {{ $d->price }} / night
                </p>
                <p class="text-gray-800 mt-1">
                    Available Rooms: <span class="font-semibold">{{ $d->available_rooms }}</span>
                </p>
                <a href="{{ route('destinations.show', $d) }}"
                   class="text-blue-500 mt-3 inline-block">
                   View Details →
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>

</x-guest-layout>
