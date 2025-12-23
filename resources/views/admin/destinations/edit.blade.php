<x-app-layout>
    <div class="max-w-3xl mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6 pt-20">Edit Destination</h1>

        {{-- Success / error messages --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Edit Form --}}
        <form method="POST" action="{{ route('admin.destinations.update', $destination) }}" class="bg-white rounded shadow p-6 space-y-4">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div>
                <label for="name" class="block font-medium mb-1">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $destination->name) }}"
                    class="w-full border p-3 rounded focus:ring focus:border-yellow-400">
            </div>

            {{-- Description --}}
            <div>
                <label for="description" class="block font-medium mb-1">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full border p-3 rounded focus:ring focus:border-yellow-400">{{ old('description', $destination->description) }}</textarea>
            </div>

            {{-- Location --}}
            <div>
                <label for="location" class="block font-medium mb-1">Location</label>
                <input type="text" name="location" id="location" value="{{ old('location', $destination->location) }}"
                    class="w-full border p-3 rounded focus:ring focus:border-yellow-400">
            </div>

            {{-- Price --}}
            <div>
                <label for="price" class="block font-medium mb-1">Price (RM / night)</label>
                <input type="number" name="price" id="price" value="{{ old('price', $destination->price) }}"
                    class="w-full border p-3 rounded focus:ring focus:border-yellow-400" step="0.01" min="0">
            </div>

            {{-- Available Rooms --}}
            <div>
                <label for="available_rooms" class="block font-medium mb-1">Available Rooms</label>
                <input type="number" name="available_rooms" id="available_rooms" value="{{ old('available_rooms', $destination->available_rooms) }}"
                    class="w-full border p-3 rounded focus:ring focus:border-yellow-400" min="0">
            </div>

            {{-- People per room --}}
            <div>
                <label for="people" class="block font-medium mb-1">People per Room</label>
                <input type="number" name="people" id="people" value="{{ old('people', $destination->people ?? 4) }}"
                    class="w-full border p-3 rounded focus:ring focus:border-yellow-400" min="1" max="10">
            </div>

            {{-- Latitude --}}
            <div>
                <label for="latitude" class="block font-medium mb-1">Latitude</label>
                <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $destination->latitude) }}"
                    class="w-full border p-3 rounded focus:ring focus:border-yellow-400">
            </div>

            {{-- Longitude --}}
            <div>
                <label for="longitude" class="block font-medium mb-1">Longitude</label>
                <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $destination->longitude) }}"
                    class="w-full border p-3 rounded focus:ring focus:border-yellow-400">
            </div>

            {{-- Map Picker --}}
            <div class="mt-4">
                <label class="block font-medium mb-1">Select Location on Map</label>
                <div id="map" class="w-full h-64 rounded border"></div>
                <p class="text-gray-500 text-sm mt-1">Click on map to update latitude & longitude</p>
            </div>

            {{-- Submit --}}
            <div class="mt-4">
                <button type="submit" class="bg-yellow-400 text-white px-4 py-2 rounded hover:bg-yellow-500">
                    Update Destination
                </button>
                <a href="{{ route('admin.destinations.index') }}" class="ml-2 text-gray-600 hover:underline">Cancel</a>
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
