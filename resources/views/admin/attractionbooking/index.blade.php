<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 pt-24">
        <h1 class="text-3xl font-bold mb-6">Manage Attraction Tickets</h1>

        {{-- Search --}}
        <form method="GET" action="{{ route('admin.attractionbooking.index') }}" class="mb-6 flex gap-3">
            <input type="text" name="search"
                   placeholder="Search by user or attraction"
                   value="{{ request('search') }}"
                   class="border p-3 rounded flex-1">
            <button class="bg-blue-600 text-white px-5 rounded hover:bg-blue-700">
                Search
            </button>
        </form>

        {{-- Table --}}
        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold">User</th>
                        <th class="px-6 py-3 text-left font-semibold">Attraction</th>
                        <th class="px-6 py-3 text-left font-semibold">Visit Date</th>
                        <th class="px-6 py-3 text-left font-semibold">Adult</th>
                        <th class="px-6 py-3 text-left font-semibold">Child</th>
                        <th class="px-6 py-3 text-left font-semibold">Total (RM)</th>
                        <th class="px-6 py-3 text-left font-semibold">Actions</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($bookings as $booking)
                        @php
                            $total =
                                ($booking->adult_tickets * $booking->attraction->adult_price) +
                                ($booking->child_tickets * $booking->attraction->child_price);
                        @endphp

                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $booking->user->name }}</td>
                            <td class="px-6 py-4">{{ $booking->attraction->name }}</td>
                            <td class="px-6 py-4">{{ $booking->visit_date }}</td>
                            <td class="px-6 py-4">{{ $booking->adult_tickets }}</td>
                            <td class="px-6 py-4">{{ $booking->child_tickets }}</td>
                            <td class="px-6 py-4 font-semibold text-emerald-600">
                                RM {{ number_format($total, 2) }}
                            </td>
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('admin.attractionbooking.edit', $booking) }}"
                                   class="px-3 py-2 bg-yellow-400 text-white rounded hover:bg-yellow-500">
                                    Edit
                                </a>

                                <form method="POST"
                                      action="{{ route('admin.attractionbooking.destroy', $booking) }}"
                                      onsubmit="return confirm('Delete this ticket?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-6 text-center text-gray-500">
                                No attraction tickets found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
