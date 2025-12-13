<x-app-layout>

<!-- ADD TOP PADDING -->
<div class="pt-24">
    <div class="max-w-6xl mx-auto px-6 py-8 grid md:grid-cols-2 gap-8">

        <!-- LEFT CONTENT -->
        <div>
            
            <h1 class="text-3xl font-bold">{{ $destination->name }}</h1>
            <p class="text-gray-600 mt-2">{{ $destination->description }}</p>

            <p class="text-blue-600 text-xl font-semibold mt-3">
                RM {{ $destination->price }} / night
            </p>

            <!-- Max people per room -->
            <p class="text-gray-700 mt-2">
                1 room can accommodate {{ $destination->people }} 
                {{ $destination->people > 1 ? 'people' : 'person' }}
            </p>

            <form method="POST" action="{{ route('bookings.store') }}" class="mt-6 space-y-4">
                @csrf

                <input type="hidden" name="destination_id" value="{{ $destination->id }}">

                <!-- Travel Start Date -->
                <div>
                    <label for="travel_date" class="block font-medium text-gray-700">Travel Start Date</label>
                    <input
                        type="date"
                        id="travel_date"
                        name="travel_date"
                        class="border w-full p-2 rounded"
                        required
                    >
                </div>

                <!-- Travel End Date -->
                <div>
                    <label for="travel_end_date" class="block font-medium text-gray-700">Travel End Date</label>
                    <input
                        type="date"
                        id="travel_end_date"
                        name="travel_end_date"
                        class="border w-full p-2 rounded"
                        required
                    >
                </div>

                <!-- Number of Guests -->
                <div>
                    <label for="peopleInput" class="block font-medium text-gray-700">Number of Guests</label>
                    <input
                        type="number"
                        id="peopleInput"
                        name="people"
                        class="border w-full p-2 rounded"
                        placeholder="Guests"
                        min="1"
                        max="{{ $destination->people }}"
                        required
                    >
                </div>

                <!-- Number of Rooms -->
                <div>
                    <label for="roomInput" class="block font-medium text-gray-700">Number of Rooms</label>
                    <input
                        type="number"
                        id="roomInput"
                        name="room"
                        class="border w-full p-2 rounded"
                        placeholder="Number of rooms"
                        min="1"
                        value="1"
                        required
                    >
                </div>

                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">
                    Book Now
                </button>
            </form>
        </div>

        <!-- MAP -->
        <div>
            <div id="map" class="w-full h-96 rounded shadow"></div>
        </div>

    </div>
</div>

<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY"></script>
<script>
    function initMap() {
        const pos = {
            lat: parseFloat("{{ $destination->latitude }}"),
            lng: parseFloat("{{ $destination->longitude }}")
        };

        const map = new google.maps.Map(document.getElementById('map'), {
            zoom: 12,
            center: pos
        });

        new google.maps.Marker({
            position: pos,
            map: map
        });
    }

    initMap();

    // ====== Dynamic max guests based on rooms ======
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
    });
</script>

</x-app-layout>
