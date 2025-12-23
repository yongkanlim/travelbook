<x-app-layout>
    <div class="max-w-7xl mx-auto p-6">
        
        <div class="flex justify-between items-center mb-6 pt-20">
            <h1 class="text-3xl font-bold">Manage Destinations</h1>
            <a href="{{ route('admin.destinations.create') }}"
               class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                + Add Destination
            </a>
        </div>

         {{-- Search form --}}
        <form method="GET" action="{{ route('admin.destinations.index') }}" class="mb-6 flex gap-3">
            <input type="text" name="search" placeholder="Search destination or location"
                class="border p-3 rounded flex-[7]" value="{{ request('search') }}">
            <button type="submit" class="bg-blue-600 text-white rounded p-3 flex-[3]">Search</button>
        </form>

        {{-- Destinations Grid --}}
        <div class="grid md:grid-cols-3 gap-6">
            @foreach ($destinations as $d)
            <div class="bg-white rounded shadow relative">
                <div class="p-4">
                    <h3 class="font-bold text-lg">{{ $d->name }}</h3>
                    <p class="text-gray-600">{{ $d->location }}</p>
                    <p class="text-blue-600 font-semibold mt-2">
                        RM {{ $d->price }} / night
                    </p>
                    <p class="text-gray-800 mt-1">
                        Available Rooms: <span class="font-semibold">{{ $d->available_rooms }}</span>
                    </p>

                    {{-- Action buttons --}}
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('admin.destinations.edit', $d) }}"
                           class="px-3 py-2 bg-yellow-400 text-white rounded hover:bg-yellow-500">
                           Edit
                        </a>

                        <form method="POST" action="{{ route('admin.destinations.destroy', $d) }}"
                              onsubmit="return confirm('Are you sure you want to delete this destination?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
