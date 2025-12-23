<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 pt-24">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Add New Destination</h1>

        <form method="POST" action="{{ route('admin.destinations.store') }}" class="bg-white p-6 rounded-lg shadow-md space-y-6">
            @csrf

            {{-- Name --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                       class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Description</label>
                <textarea name="description" rows="4"
                    class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">{{ old('description') }}</textarea>
                @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Location --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Location</label>
                <input type="text" name="location" value="{{ old('location') }}"
                       class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                @error('location')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Price --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Price per Night (RM)</label>
                <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0"
                       class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                @error('price')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- People per Room --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">People per Room</label>
                <input type="number" name="people" value="{{ old('people', 4) }}" min="1" max="10"
                    class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                @error('people')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Available Rooms --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Available Rooms</label>
                <input type="number" name="available_rooms" value="{{ old('available_rooms') }}" min="0"
                       class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                @error('available_rooms')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Latitude --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Latitude</label>
                <input type="text" name="latitude" id="latitude" value="{{ old('latitude') }}"
                       class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                @error('latitude')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Longitude --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Longitude</label>
                <input type="text" name="longitude" id="longitude" value="{{ old('longitude') }}"
                       class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                @error('longitude')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Map Picker --}}
            <div class="mt-4">
                <label class="block font-medium mb-1">Select Location on Map</label>
                <div id="map" class="w-full h-64 rounded border"></div>
                <p class="text-gray-500 text-sm mt-1">Click on map to update latitude & longitude</p>
            </div>

            {{-- Submit --}}
            <div class="mt-4">
                <button type="submit" class="w-full bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition">
                    Create Destination
                </button>
            </div>
        </form>
    </div>

    {{-- Map API Script --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        let latInput = document.getElementById('latitude');
        let lngInput = document.getElementById('longitude');
        let map = L.map('map').setView([latInput.value || 3.1390, lngInput.value || 101.6869], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let marker = L.marker([latInput.value || 3.1390, lngInput.value || 101.6869], {draggable:true}).addTo(map);

        marker.on('dragend', function(e){
            let pos = marker.getLatLng();
            latInput.value = pos.lat.toFixed(6);
            lngInput.value = pos.lng.toFixed(6);
        });

        map.on('click', function(e){
            marker.setLatLng(e.latlng);
            latInput.value = e.latlng.lat.toFixed(6);
            lngInput.value = e.latlng.lng.toFixed(6);
        });
    </script>
</x-app-layout>
