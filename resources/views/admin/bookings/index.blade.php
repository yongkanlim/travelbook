<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 pt-30">
        <h1 class="text-3xl font-bold mb-6 pt-20">All Bookings</h1>

        {{-- Search Form --}}
        <form method="GET" action="{{ route('admin.bookings.index') }}" class="mb-6 flex gap-3">
            <input type="text" name="search" placeholder="Search by user or destination"
                class="border p-3 rounded flex-[7]" value="{{ request('search') }}">
            <button type="submit" class="bg-blue-600 text-white rounded p-3 flex-[3] hover:bg-blue-700">
                Search
            </button>
        </form>

        {{-- Bookings Card --}}
        <div class="bg-white rounded-2xl shadow-md overflow-x-auto">
            <table class="min-w-full w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-gray-700 font-semibold">User</th>
                        <th class="px-6 py-3 text-left text-gray-700 font-semibold">Destination</th>
                        <th class="px-6 py-3 text-left text-gray-700 font-semibold">Dates</th>
                        <th class="px-6 py-3 text-left text-gray-700 font-semibold">Guests</th>
                        <th class="px-6 py-3 text-left text-gray-700 font-semibold">Rooms</th>
                        <th class="px-6 py-3 text-left text-gray-700 font-semibold">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">{{ $booking->user->name }}</td>
                        <td class="px-6 py-4">{{ $booking->destination->name }}</td>
                        <td class="px-6 py-4">
                            {{ $booking->travel_date }} → {{ $booking->travel_end_date }}
                        </td>
                        <td class="px-6 py-4">{{ $booking->people }}</td>
                        <td class="px-6 py-4">{{ $booking->room }}</td>
                        <td class="px-6 py-4 flex gap-2">
                            <a href="{{ route('admin.bookings.edit', $booking) }}"
                               class="px-3 py-2 bg-yellow-400 text-white rounded hover:bg-yellow-500 font-semibold">
                                Edit
                            </a>

                            <form action="{{ route('admin.bookings.destroy', $booking) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this booking?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600 font-semibold">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No bookings found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
