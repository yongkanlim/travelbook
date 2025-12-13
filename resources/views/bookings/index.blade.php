<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6">Your Bookings</h1>
        @forelse ($bookings as $booking)
            <div class="bg-white p-4 rounded shadow mb-4">
                <p><strong>Destination:</strong> {{ $booking->destination->name }}</p>
                <p><strong>Date:</strong> {{ $booking->travel_date }}</p>
            </div>
        @empty
            <p>No bookings found.</p>
        @endforelse
    </div>
</x-app-layout>
