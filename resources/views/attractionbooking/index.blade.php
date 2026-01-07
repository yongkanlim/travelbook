<x-app-layout>
    <!-- Hero Section -->
    <section class="relative h-[300px] md:h-[400px] bg-cover bg-center"
        style="background-image:url('https://img.freepik.com/premium-photo/neutral-green-suitcase-two-straw-hats-stylish-luggage-bag-pink-background_887552-19610.jpg')">
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative max-w-6xl mx-auto pt-24 md:pt-32 px-6 text-white text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-3">Your Attraction Bookings</h1>
            <p class="text-lg md:text-xl mb-6">View and manage your attraction visits</p>
            <a href="{{ route('attractions.index') }}"
               class="bg-blue-600 hover:bg-blue-700 transition rounded-lg py-3 px-6 font-semibold inline-block">
               Explore Attractions →
            </a>
        </div>
    </section>

    <!-- Bookings Section -->
    <section class="bg-gray-50 min-h-screen pt-16 pb-16">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">

                @forelse ($attractionBookings as $booking)

                @php
                    $total =
                        ($booking->adult_tickets * $booking->attraction->adult_price) +
                        ($booking->child_tickets * $booking->attraction->child_price);
                @endphp

                <div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition">
                    
                    <!-- Attraction Info -->
                    <div class="p-6 border-b">
                        <h2 class="text-2xl font-bold text-gray-800">
                            {{ $booking->attraction->name }}
                        </h2>
                        <p class="text-sm text-gray-500 mt-1">
                            {{ $booking->attraction->location }}
                        </p>
                    </div>

                    <!-- Booking Details -->
                    <div class="p-6 space-y-4 text-gray-700">

                        <!-- Visit Date -->
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>
                                <!-- Formats date nicely (e.g. 12 Jan, 2026), Uses Carbon (Laravel’s date library) -->
                                <strong>Visit Date:</strong>
                                {{ \Carbon\Carbon::parse($booking->visit_date)->format('d M, Y') }}
                            </span>
                        </div>

                        <!-- Adult Tickets -->
                        <div class="flex items-center gap-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6a3 3 0 110 6 3 3 0 010-6zM6 18a6 6 0 0112 0" />
                            </svg>
                            <span>
                                <strong>Adult Tickets:</strong> {{ $booking->adult_tickets }}
                            </span>
                        </div>

                      <!-- Child Tickets -->
                    <div class="flex items-center gap-3">
                        <svg class="w-6 h-6 text-orange-500" fill="none" stroke="currentColor" stroke-width="1.5"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9a2.5 2.5 0 110 5 2.5 2.5 0 010-5zM6 20c0-3.5 5-4 6-4s6 .5 6 4H6z" />
                        </svg>
                        <span>
                            <strong>Child Tickets:</strong> {{ $booking->child_tickets }}
                        </span>
                    </div>

                        <!-- Prices -->
                        <div class="pt-4 border-t space-y-2">
                            <p class="text-sm">
                                Adult: RM {{ number_format($booking->attraction->adult_price, 2) }}
                            </p>
                            <p class="text-sm">
                                Child: RM {{ number_format($booking->attraction->child_price, 2) }}
                            </p>
                        </div>

                        <!-- Total -->
                        <div class="flex items-center gap-3 pt-2">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8c-4 0-6 2-6 6s2 6 6 6 6-2 6-6-2-6-6-6z" />
                            </svg>
                            <span class="text-lg font-bold text-emerald-600">
                                Total: RM {{ number_format($total, 2) }}
                            </span>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="p-6 flex flex-col gap-3">
                        <!-- Passes $booking->id so the controller knows which booking to edit -->
                        <a href="{{ route('attractionbooking.edit', $booking->id) }}"
                            class="w-full text-center bg-yellow-500 text-white py-3 rounded-xl font-semibold hover:bg-yellow-600 transition">
                                Edit Booking
                            </a>

                        <!-- In HTML, only forms can send POST requests, cannot do DELETE with <a> directly -->
                            <!-- onsubmit shows a browser confirmation dialog -->
                        <form action="{{ route('attractionbooking.destroy', $booking->id) }}"
                              method="POST"
                              onsubmit="return confirm('Delete this booking?');">
                              <!-- Laravel requires CSRF token for all POST, PUT, DELETE forms -->
                            @csrf
                            <!-- HTML forms only support GET and POST, Laravel uses @method('DELETE') to fake a DELETE request -->
                            @method('DELETE')
                            <button
                                class="w-full bg-red-500 text-white py-3 rounded-xl font-semibold hover:bg-red-600 transition">
                                Delete Booking
                            </button>
                        </form>
                    </div>

                </div>

                @empty
                <!-- Empty State -->
                <div class="col-span-full text-center text-gray-500 py-20">
                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png"
                         class="w-40 mx-auto mb-6">
                    <p class="text-2xl font-semibold mb-3">No attraction bookings yet</p>
                    <p class="text-gray-400 mb-6">Start exploring destinations and plan your next adventure!</p>
                    <a href="{{ route('attractions.index') }}"
                       class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
                        Explore Attractions
                    </a>
                </div>
                @endforelse
            </div>

        </div>
    </section>
</x-app-layout>
