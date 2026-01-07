<x-app-layout>
<div class="bg-gray-50 min-h-screen pt-24 pb-16">
    <div class="max-w-3xl mx-auto bg-white rounded-3xl shadow-lg p-8">

        <!-- Title -->
        <h1 class="text-3xl font-bold text-gray-800 mb-6">
            Edit Attraction Booking
        </h1>

        <!-- Error -->
        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('attractionbooking.update', $attractionBooking->id) }}"
              method="POST"
              class="space-y-6">

            @csrf
            <!-- HTML forms only support GET & POST, Laravel uses PUT for update operations -->
            @method('PUT')

            <!-- Attraction Info (Read-only) -->
            <div class="bg-gray-100 rounded-xl p-4">
                <h2 class="text-xl font-semibold text-gray-800">
                    {{ $attractionBooking->attraction->name }}
                </h2>
                <p class="text-sm text-gray-600">
                    {{ $attractionBooking->attraction->location }}
                </p>
            </div>

            <!-- Visit Date -->
            <div>
                <label class="block font-medium text-gray-700 mb-1">
                    Visit Date
                </label>
                <input type="date"
                       name="visit_date"
                       value="{{ \Carbon\Carbon::parse($attractionBooking->visit_date)->format('Y-m-d') }}"
                       class="border w-full p-3 rounded-lg"
                       required>
            </div>

            <!-- Tickets -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <!-- Adult Tickets -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">
                        Adult Tickets
                    </label>
                    <input type="number"
                           name="adult_tickets"
                           min="0"
                           max="{{ $attractionBooking->attraction->available_adult_tickets + $attractionBooking->adult_tickets }}"
                           value="{{ $attractionBooking->adult_tickets }}"
                           class="border w-full p-3 rounded-lg"
                           required>
                </div>

                <!-- Child Tickets -->
                <div>
                    <label class="block font-medium text-gray-700 mb-1">
                        Child Tickets
                    </label>
                    <input type="number"
                           name="child_tickets"
                           min="0"
                           max="{{ $attractionBooking->attraction->available_child_tickets + $attractionBooking->child_tickets }}"
                           value="{{ $attractionBooking->child_tickets }}"
                           class="border w-full p-3 rounded-lg"
                           required>
                </div>

            </div>

            <!-- Price Info -->
            <div class="bg-blue-50 rounded-xl p-4 text-sm text-gray-700">
                <p>Adult Price: <strong>RM {{ number_format($attractionBooking->attraction->adult_price, 2) }}</strong></p>
                <p>Child Price: <strong>RM {{ number_format($attractionBooking->attraction->child_price, 2) }}</strong></p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit"
                        class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white py-3 rounded-xl font-semibold transition">
                    Update Booking
                </button>

                <a href="{{ route('attractionbooking.index') }}"
                   class="flex-1 text-center bg-gray-200 hover:bg-gray-300 text-gray-800 py-3 rounded-xl font-semibold transition">
                    Cancel
                </a>
            </div>

        </form>

    </div>
</div>
</x-app-layout>
