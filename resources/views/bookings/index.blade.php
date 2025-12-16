<x-app-layout>
    <!-- Hero Section -->
    <section class="relative h-[300px] md:h-[400px] bg-cover bg-center"
        style="background-image:url('https://www.discoverasr.com/content/dam/tal/media/images/properties/france/paris/citadines-les-halles-paris/offers/Offers_2880x860.jpg.transform/ascott-highres/image.jpg')">
        <div class="absolute inset-0 bg-black/40"></div>

        <div class="relative max-w-6xl mx-auto pt-24 md:pt-32 px-6 text-white text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-3">Your Hotel Booking</h1>
            <p class="text-lg md:text-xl mb-6">View and manage your booking</p>
            <a href="{{ route('destinations.index') }}"
               class="bg-blue-600 hover:bg-blue-700 transition rounded-lg py-3 px-6 font-semibold inline-block">
               Explore Destinations →
            </a>
        </div>
    </section>

    <!-- Bookings Cards Section -->
    <section class="bg-gray-50 min-h-screen pt-16 pb-16">
        <div class="max-w-7xl mx-auto px-6">

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse ($bookings as $booking)
                    <div class="bg-white rounded-3xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300">
                        
                        {{-- Destination Info --}}
                        <div class="p-6 border-b">
                            <h2 class="text-2xl font-bold text-gray-800">{{ $booking->destination->name }}</h2>
                            <p class="text-sm text-gray-500 mt-1">{{ $booking->destination->location ?? 'Beautiful destination' }}</p>
                        </div>

                        {{-- Booking Details --}}
                        <div class="p-6 space-y-4 text-gray-700">

                            {{-- Check-in --}}
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span><strong>Check-in:</strong> {{ \Carbon\Carbon::parse($booking->travel_date)->format('d M, Y') }}</span>
                            </div>

                            {{-- Check-out --}}
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span><strong>Check-out:</strong> {{ \Carbon\Carbon::parse($booking->travel_end_date)->format('d M, Y') }}</span>
                            </div>

                            {{-- Nights --}}
                            @php
                                $nights = \Carbon\Carbon::parse($booking->travel_date)->diffInDays(\Carbon\Carbon::parse($booking->travel_end_date));
                            @endphp
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                                </svg>
                                <span><strong>Nights:</strong> {{ $nights }}</span>
                            </div>

                            {{-- Guests --}}
                            <div class="flex items-center gap-3">
                                <!-- Users icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-yellow-600">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                                </svg>
                                <span><strong>Guests:</strong> {{ $booking->people }}</span>
                            </div>

                            {{-- Rooms --}}
                            <div class="flex items-center gap-3">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9l9-7 9 7v11a2 2 0 01-2 2h-4a2 2 0 01-2-2v-4H9v4a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
                                </svg>
                                <span><strong>Rooms:</strong> {{ $booking->room }}</span>
                            </div>

                            {{-- Price per night --}}
                            <div class="flex items-center gap-3 pt-4 border-t">
                                <!-- Banknotes icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-emerald-600">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                                </svg>
                                <span class="text-lg font-semibold text-gray-900">
                                    RM {{ $booking->destination->price }} <span class="text-sm font-normal">/ night</span>
                                </span>
                            </div>

                            {{-- Total Price --}}
                            @php
                                $total = $booking->destination->price * $nights * $booking->room;
                            @endphp
                            <div class="flex items-center gap-3 pt-2">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-4 0-6 2-6 6 0 3.333 2 6 6 6s6-2.667 6-6c0-4-2-6-6-6z"/>
                                </svg>
                                <span class="text-lg font-bold text-green-600">
                                    Total: RM {{ number_format($total, 2) }}
                                </span>
                            </div>

                        </div>

                        {{-- Action --}}
                       <div class="p-6 flex flex-col gap-3">
                            <!-- <a href="{{ route('destinations.show', $booking->destination->id) }}"
                            class="block w-full text-center bg-blue-600 text-white py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
                            View Destination
                            </a> -->

                            <a href="{{ route('bookings.edit', $booking->id) }}"
                            class="block w-full text-center bg-yellow-500 text-white py-3 rounded-xl font-semibold hover:bg-yellow-600 transition">
                            Edit Booking
                            </a>

                            <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-500 text-white py-3 rounded-xl font-semibold hover:bg-red-600 transition">
                                    Delete Booking
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    {{-- No Bookings Yet Section --}}
                    <div class="col-span-full text-center text-gray-500 flex flex-col items-center justify-center py-20">
                        <img src="https://cdn-icons-png.freepik.com/512/3585/3585017.png" alt="No Bookings" class="w-48 h-48 mb-6">
                        <p class="text-2xl font-semibold mb-3">You have no bookings yet</p>
                        <p class="text-gray-400 mb-6">Start exploring destinations and plan your next adventure!</p>
                        <a href="{{ route('destinations.index') }}"
                           class="inline-block bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
                            Explore Destinations
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </section>
</x-app-layout>
