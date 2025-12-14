<x-app-layout>

<div class="pt-24 bg-gray-50 min-h-screen">

    <div class="max-w-7xl mx-auto px-6 py-10 grid lg:grid-cols-2 gap-12">

        <!-- LEFT: Attraction Details & Booking -->
        <div class="bg-white p-8 rounded-3xl shadow-xl space-y-6">

            <h1 class="text-4xl font-extrabold text-gray-800">
                {{ $attraction->name }}
            </h1>

            <p class="text-gray-600 leading-relaxed">
                {{ $attraction->description }}
            </p>

            <div class="flex items-center gap-2 text-gray-700">
                Location: <span>{{ $attraction->location }}</span>
            </div>

            <!-- Prices -->
            <div class="bg-blue-50 p-4 rounded-xl">
                <p class="text-blue-700 text-xl font-bold">
                    Adult: RM {{ $attraction->adult_price }}
                </p>
                <p class="text-blue-700 text-xl font-bold">
                    Child: RM {{ $attraction->child_price }}
                </p>
            </div>

            <!-- Availability -->
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-100 p-4 rounded-xl text-center">
                    <p class="text-gray-500 text-sm">Adult Tickets</p>
                    <p class="text-2xl font-bold text-gray-800">
                        {{ $attraction->available_adult_tickets }}
                    </p>
                </div>
                <div class="bg-gray-100 p-4 rounded-xl text-center">
                    <p class="text-gray-500 text-sm">Child Tickets</p>
                    <p class="text-2xl font-bold text-gray-800">
                        {{ $attraction->available_child_tickets }}
                    </p>
                </div>
            </div>

            <!-- Booking Form -->
            <form method="POST" action="{{ route('attraction.book') }}" class="mt-6 space-y-5">
                @csrf
                <input type="hidden" name="attraction_id" value="{{ $attraction->id }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">
                            Adult Tickets
                        </label>
                        <input type="number" id="adultTickets" name="adult_tickets"
                            class="border w-full p-3 rounded-xl focus:ring-2 focus:ring-blue-400"
                            min="0"
                            max="{{ $attraction->available_adult_tickets }}"
                            value="0">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-1">
                            Child Tickets
                        </label>
                        <input type="number" id="childTickets" name="child_tickets"
                            class="border w-full p-3 rounded-xl focus:ring-2 focus:ring-blue-400"
                            min="0"
                            max="{{ $attraction->available_child_tickets }}"
                            value="0">
                    </div>
                </div>

                <!-- Total -->
                <div class="bg-gray-100 p-5 rounded-xl text-center shadow-inner">
                    <p class="text-gray-600 font-medium">Total Price</p>
                    <p id="totalPrice" class="text-3xl font-extrabold text-green-600">
                        RM 0
                    </p>
                </div>

                <button
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-4 rounded-xl font-semibold text-lg transition">
                    Book Tickets
                </button>
            </form>

        </div>

        <!-- RIGHT: Image + Map -->
        <div class="space-y-6">

            <!-- Image Card -->
            @if($attraction->image)
            <div class="relative rounded-3xl overflow-hidden shadow-xl h-[320px]">

                <img
                    src="{{ $attraction->image }}"
                    alt="{{ $attraction->name }}"
                    class="w-full h-full object-cover">

                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>

                <!-- Text Overlay -->
                <div class="absolute bottom-0 p-6 text-white">
                    <h2 class="text-2xl font-bold">
                        {{ $attraction->name }}
                    </h2>
                    <p class="text-sm opacity-90">
                        {{ $attraction->location }}
                    </p>
                </div>

            </div>
            @endif

            <!-- Map Card -->
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden h-[400px]">
                <div id="map" class="w-full h-full"></div>
            </div>

        </div>

    </div>
</div>

<!-- MAP SCRIPT -->
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY"></script>
<script>
    function initMap() {
        const pos = {
            lat: Number("{{ $attraction->latitude }}"),
            lng: Number("{{ $attraction->longitude }}")
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

    const adultPrice = Number("{{ $attraction->adult_price }}");
    const childPrice = Number("{{ $attraction->child_price }}");
    const maxAdult = Number("{{ $attraction->available_adult_tickets }}");
    const maxChild = Number("{{ $attraction->available_child_tickets }}");

    const adultInput = document.getElementById('adultTickets');
    const childInput = document.getElementById('childTickets');
    const totalPriceEl = document.getElementById('totalPrice');

    function calculateTotal() {
        let adultCount = parseInt(adultInput.value) || 0;
        let childCount = parseInt(childInput.value) || 0;

        if (adultCount > maxAdult) adultCount = adultInput.value = maxAdult;
        if (childCount > maxChild) childCount = childInput.value = maxChild;

        totalPriceEl.textContent =
            `RM ${(adultCount * adultPrice + childCount * childPrice).toFixed(2)}`;
    }

    adultInput.addEventListener('input', calculateTotal);
    childInput.addEventListener('input', calculateTotal);
</script>

</x-app-layout>
