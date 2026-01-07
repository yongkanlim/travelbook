<x-app-layout>
    <div class="max-w-3xl mx-auto p-6 pt-32">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Attraction</h1>

        <!-- enctype is short for “encoding type”
        multipart/form-data tells the browser to split the form into multiple “parts”:
        Each text input is sent as text part.
        Each file input is sent as binary part.
        Here need have this because have the image file (edit) -->
        <form method="POST" action="{{ route('admin.attractions.update', $attraction) }}" 
              enctype="multipart/form-data" 
              class="bg-white p-6 rounded-lg shadow-md space-y-6">
            @csrf
            @method('PUT')

            {{-- Name --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Name</label>
                <!-- old('field') retrieves the previous value of a form input from the last request.
                old('name') returns what the user typed for name so they don’t have to type it again. -->
                <input type="text" name="name" value="{{ old('name', $attraction->name) }}"
                       class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                @error('name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Description</label>
                <textarea name="description" rows="4"
                          class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">{{ old('description', $attraction->description) }}</textarea>
                @error('description')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Location --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Location</label>
                <input type="text" name="location" value="{{ old('location', $attraction->location) }}"
                       class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                @error('location')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Prices --}}
            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-gray-700 font-medium mb-1">Adult Price (RM)</label>
                    <input type="number" name="adult_price" value="{{ old('adult_price', $attraction->adult_price) }}"
                           class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                    @error('adult_price')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="flex-1">
                    <label class="block text-gray-700 font-medium mb-1">Child Price (RM)</label>
                    <input type="number" name="child_price" value="{{ old('child_price', $attraction->child_price) }}"
                           class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                    @error('child_price')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Available Tickets --}}
            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-gray-700 font-medium mb-1">Available Adult Tickets</label>
                    <input type="number" name="available_adult_tickets" value="{{ old('available_adult_tickets', $attraction->available_adult_tickets) }}"
                           class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                    @error('available_adult_tickets')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="flex-1">
                    <label class="block text-gray-700 font-medium mb-1">Available Child Tickets</label>
                    <input type="number" name="available_child_tickets" value="{{ old('available_child_tickets', $attraction->available_child_tickets) }}"
                           class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                    @error('available_child_tickets')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Latitude & Longitude --}}
            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-gray-700 font-medium mb-1">Latitude</label>
                    <input type="text" name="latitude" id="latitude" value="{{ old('latitude', $attraction->latitude) }}"
                           class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                    @error('latitude')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="flex-1">
                    <label class="block text-gray-700 font-medium mb-1">Longitude</label>
                    <input type="text" name="longitude" id="longitude" value="{{ old('longitude', $attraction->longitude) }}"
                           class="w-full border px-4 py-2 rounded-lg focus:ring-2 focus:ring-yellow-400 focus:outline-none">
                    @error('longitude')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Map Picker --}}
            <div class="mt-4">
                <label class="block font-medium mb-1">Select Location on Map</label>
                <div class="w-full h-64 rounded border overflow-hidden mt-2 relative">
                    <div id="map" class="w-full h-full"></div>
                </div>
                <p class="text-gray-500 text-sm mt-1">Click on map to update latitude & longitude</p>
            </div>

            {{-- Image Upload --}}
            <div>
                <label class="block text-gray-700 font-medium mb-1">Attraction Image</label>
                <label for="imageInput" class="flex items-center justify-center w-full px-4 py-2 bg-yellow-50 border border-gray-300 rounded-lg cursor-pointer hover:bg-yellow-100 hover:shadow-sm transition-all text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12v6m0 0l-3-3m3 3l3-3M12 6v6" />
                    </svg>
                    <span class="text-gray-700 font-medium">Choose Image</span>
                </label>
                
                <input type="file" name="image" accept="image/*" id="imageInput" class="hidden">

                {{-- Preview --}}
                <div class="mt-4 flex justify-center">
                    <div class="w-full max-w-md h-80 border rounded-lg overflow-hidden shadow-sm bg-gray-50 flex items-center justify-center">
                        <img id="imagePreview" src="{{ $attraction->image }}" 
                             alt="Image Preview" class="w-full h-full object-cover transition-opacity duration-300 {{ $attraction->image ? '' : 'hidden' }}">
                        <span id="previewPlaceholder" class="text-gray-400 text-sm {{ $attraction->image ? 'hidden' : '' }}">No image selected</span>
                    </div>
                </div>
                @error('image')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Submit --}}
            <button type="submit" class="w-full bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition">
                Update Attraction
            </button>
        </form>
    </div>

    {{-- Leaflet Map --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');

        const map = L.map('map').setView([latInput.value || 3.1390, lngInput.value || 101.6869], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const marker = L.marker([latInput.value || 3.1390, lngInput.value || 101.6869], { draggable: true }).addTo(map);

        marker.on('dragend', function(e){
            const pos = marker.getLatLng();
            latInput.value = pos.lat.toFixed(6);
            lngInput.value = pos.lng.toFixed(6);
        });

        map.on('click', function(e){
            marker.setLatLng(e.latlng);
            latInput.value = e.latlng.lat.toFixed(6);
            lngInput.value = e.latlng.lng.toFixed(6);
        });

        setTimeout(() => map.invalidateSize(), 300);
        window.addEventListener('resize', () => map.invalidateSize());
    </script>

            {{-- Map Styles --}}
            <style>
                #map {
                    z-index: 0;
                }

                .leaflet-pane, 
                .leaflet-tile, 
                .leaflet-marker-pane, 
                .leaflet-shadow-pane, 
                .leaflet-overlay-pane, 
                .leaflet-popup-pane {
                    z-index: 0 !important;
                }

                .leaflet-popup {
                    z-index: 10 !important;
                }
            </style>
            
    {{-- Image Preview Script --}}
    <script>
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');
        const previewPlaceholder = document.getElementById('previewPlaceholder');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('hidden');
                    previewPlaceholder.classList.add('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                imagePreview.src = "{{ $attraction->image }}";
                imagePreview.classList.toggle('hidden', !imagePreview.src);
                previewPlaceholder.classList.toggle('hidden', !!imagePreview.src);
            }
        });
    </script>
</x-app-layout>
