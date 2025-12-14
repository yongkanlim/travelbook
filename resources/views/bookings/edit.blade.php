<x-app-layout>
<div class="bg-gray-50 min-h-screen pt-24 pb-16">
    <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-lg p-8">

        <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Booking</h1>

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('bookings.update', $booking->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium text-gray-700">Check-in</label>
                    <input type="date" name="travel_date" value="{{ $booking->travel_date }}" 
                           class="border w-full p-3 rounded-lg" required>
                </div>
                <div>
                    <label class="block font-medium text-gray-700">Check-out</label>
                    <input type="date" name="travel_end_date" value="{{ $booking->travel_end_date }}" 
                           class="border w-full p-3 rounded-lg" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-medium text-gray-700">Guests</label>
                    <input type="number" name="people" min="1" max="{{ $booking->destination->people * $booking->destination->available_rooms + $booking->room }}" 
                           value="{{ $booking->people }}" class="border w-full p-3 rounded-lg" required>
                </div>
                <div>
                    <label class="block font-medium text-gray-700">Rooms</label>
                    <input type="number" name="room" min="1" max="{{ $booking->destination->available_rooms + $booking->room }}" 
                           value="{{ $booking->room }}" class="border w-full p-3 rounded-lg" required>
                </div>
            </div>

            <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-xl font-semibold transition">
                Update Booking
            </button>
        </form>

    </div>
</div>
</x-app-layout>
