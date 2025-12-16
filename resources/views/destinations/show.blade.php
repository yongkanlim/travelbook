<x-app-layout>

<div class="pt-24 bg-gray-50 min-h-screen">

    <div class="max-w-7xl mx-auto px-6 py-8 grid lg:grid-cols-2 gap-12">

        <!-- LEFT: Booking Details -->
        <div class="bg-white p-8 rounded-2xl shadow-lg space-y-6">
            
            <h1 class="text-4xl font-bold text-gray-800">{{ $destination->name }}</h1>
            <p class="text-gray-600 mt-2">{{ $destination->description }}</p>

            <p class="text-blue-600 text-2xl font-bold mt-3">
                RM {{ $destination->price }} <span class="text-gray-500 text-base font-normal">/ night</span>
            </p>

            <p class="text-gray-800 mt-1">
                Available Rooms: <span class="font-semibold">{{ $destination->available_rooms }}</span>
            </p>

            <p class="text-gray-700 mt-2">
                1 room can accommodate {{ $destination->people }} {{ $destination->people > 1 ? 'people' : 'person' }}
            </p>

            <!-- Booking Form -->
            <form method="POST" action="{{ route('bookings.store') }}" class="mt-6 space-y-4">
                @csrf
                <input type="hidden" name="destination_id" value="{{ $destination->id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="travel_date" class="block font-medium text-gray-700">Start Date</label>
                        <input type="date" id="travel_date" name="travel_date" class="border w-full p-2 rounded-lg focus:ring-2 focus:ring-blue-400" required>
                    </div>

                    <div>
                        <label for="travel_end_date" class="block font-medium text-gray-700">End Date</label>
                        <input type="date" id="travel_end_date" name="travel_end_date" class="border w-full p-2 rounded-lg focus:ring-2 focus:ring-blue-400" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="peopleInput" class="block font-medium text-gray-700">Guests</label>
                        <input type="number" id="peopleInput" name="people" class="border w-full p-2 rounded-lg" placeholder="Guests" min="1" max="{{ $destination->people }}" required>
                    </div>

                    <div>
                        <label for="roomInput" class="block font-medium text-gray-700">Rooms</label>
                        <input type="number" id="roomInput" name="room" class="border w-full p-2 rounded-lg" 
                            placeholder="Number of rooms" min="1" max="{{ $destination->available_rooms }}" value="1" required>

                    </div>
                </div>

                <!-- Total Price -->
                <div class="bg-gray-100 p-4 rounded-lg shadow-inner text-center">
                    <span class="block text-gray-600 font-medium">Total Price</span>
                    <span id="totalPrice" class="text-2xl font-bold text-green-600">RM 0</span>
                </div>

                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition duration-200">
                    Book Now
                </button>
            </form>
        </div>

        <!-- RIGHT: Map -->
        <div class="relative h-full rounded-2xl overflow-hidden shadow-lg">
            <div id="map" class="w-full h-full"></div>
        </div>

    </div>
</div>

{{-- Leaflet Map --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    let lat = parseFloat("{{ $destination->latitude }}") || 3.1390;
    let lng = parseFloat("{{ $destination->longitude }}") || 101.6869;

    let map = L.map('map').setView([lat, lng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    L.marker([lat, lng]).addTo(map)
        .bindPopup("{{ $destination->name }}")
        .openPopup();
</script>
<style>
    /* Ensure map stays behind navbar */
    #map {
        position: relative; /* or keep as is */
        z-index: 0; /* Map container below navbar */
    }

    /* Leaflet tiles & controls */
    .leaflet-pane, 
    .leaflet-tile, 
    .leaflet-marker-pane, 
    .leaflet-shadow-pane, 
    .leaflet-overlay-pane, 
    .leaflet-popup-pane {
        z-index: 0 !important;
    }

    /* Optional: make popups appear above map but below navbar */
    .leaflet-popup {
        z-index: 10 !important;
    }
</style>


<script>
    // DYNAMIC MAX GUESTS
    const peopleInput = document.getElementById('peopleInput');
    const roomInput = document.getElementById('roomInput');
    const maxPerRoom = parseInt("{{ $destination->people }}");

    roomInput.addEventListener('input', () => {
        const roomCount = parseInt(roomInput.value) || 1;
        const maxPeople = maxPerRoom * roomCount;
        peopleInput.max = maxPeople;
        peopleInput.placeholder = `Guests (max ${maxPeople})`;
        if (parseInt(peopleInput.value) > maxPeople) {
            peopleInput.value = maxPeople;
        }
        calculateTotal();
    });

    // TOTAL PRICE
    const pricePerNight = parseFloat("{{ $destination->price }}");
    const travelDateInput = document.getElementById('travel_date');
    const travelEndDateInput = document.getElementById('travel_end_date');
    const totalPriceEl = document.getElementById('totalPrice');

    function calculateTotal() {
        const startDate = new Date(travelDateInput.value);
        const endDate = new Date(travelEndDateInput.value);
        const roomCount = parseInt(roomInput.value) || 1;

        if (startDate && endDate && endDate >= startDate) {
            const timeDiff = endDate - startDate;
            const nights = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
            const total = pricePerNight * nights * roomCount;
            totalPriceEl.textContent = `RM ${total.toFixed(2)}`;
        } else {
            totalPriceEl.textContent = `RM 0`;
        }
    }

    travelDateInput.addEventListener('change', calculateTotal);
    travelEndDateInput.addEventListener('change', calculateTotal);
    roomInput.addEventListener('input', calculateTotal);
</script>

</x-app-layout>
