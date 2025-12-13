{{-- resources/views/destinations/index.blade.php --}}
<x-guest-layout>

<section class="relative h-[500px] bg-cover bg-center"
    style="background-image:url('https://wallpapers.com/images/hd/travel-background-613yzbmemikozd15.jpg')">
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative max-w-6xl mx-auto pt-40 px-6 text-white">
        <h1 class="text-4xl font-bold mb-4">
            Find Your Perfect Travel Destination
        </h1>

        <form class="bg-white rounded-lg p-4 grid md:grid-cols-5 gap-3 text-black">
            <input class="border p-3 rounded" placeholder="Destination">
            <input type="date" class="border p-3 rounded">
            <input type="date" class="border p-3 rounded">
            <select class="border p-3 rounded">
                <option>1 room, 2 adults</option>
            </select>
            <button class="bg-blue-600 text-white rounded p-3">
                Check Availability
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
