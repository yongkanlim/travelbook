<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">

        {{-- Page Header --}}
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-bold mb-2">Your Bookings</h1>
            <p class="text-gray-600">Manage and view all your upcoming and past trips</p>
        </div>

        {{-- Bookings Grid --}}
        <div class="grid md:grid-cols-3 gap-6">
            @forelse ($bookings as $booking)
                <div class="bg-white rounded shadow p-6 hover:shadow-lg transition">
                    <h2 class="font-bold text-xl mb-2">{{ $booking->destination->name }}</h2>
                    <p class="text-gray-600 mb-1"><strong>Travel Start:</strong> {{ \Carbon\Carbon::parse($booking->travel_date)->format('d M, Y') }}</p>
                    <p class="text-gray-600 mb-1"><strong>Travel End:</strong> {{ \Carbon\Carbon::parse($booking->travel_end_date)->format('d M, Y') }}</p>
                    <p class="text-gray-600 mb-1"><strong>Guests:</strong> {{ $booking->people }}</p>
                    <p class="text-gray-600 mb-1"><strong>Rooms:</strong> {{ $booking->room }}</p>
                    <p class="text-gray-600 mb-1"><strong>Price per Night:</strong> RM {{ $booking->destination->price }}</p>
                    <p class="text-gray-600 mb-4"><strong>Total Nights:</strong> {{ \Carbon\Carbon::parse($booking->travel_date)->diffInDays(\Carbon\Carbon::parse($booking->travel_end_date)) }}</p>

                    <a href="{{ route('destinations.show', $booking->destination->id) }}" 
                       class="text-blue-600 hover:underline font-semibold">View Destination →</a>
                </div>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    <p>No bookings found.</p>
                    <a href="{{ route('destinations.index') }}" class="text-blue-600 hover:underline mt-2 inline-block">Explore Destinations →</a>
                </div>
            @endforelse
        </div>
    </div>
</x-app-layout>
