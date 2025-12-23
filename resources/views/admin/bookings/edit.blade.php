<x-app-layout>
    <div class="max-w-3xl mx-auto p-10 pt-24 pb-16">
        {{-- Card Wrapper --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            {{-- Card Header --}}
            <div class="bg-gray-50 px-7 py-3 border-b border-gray-200 text-center">
                <h1 class="text-2xl font-bold text-gray-800">Edit Booking</h1>
            </div>

            {{-- Card Body --}}
            <div class="p-6 space-y-6">
                {{-- Success/Error Messages --}}
                @if(session('success'))
                    <div class="p-4 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="p-4 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc pl-5 space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form --}}
                <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="space-y-6 -mt-7">
                    @csrf
                    @method('PUT')

                    {{-- User & Destination (readonly) --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">User</label>
                            <input type="text" value="{{ $booking->user->name }}" readonly
                                class="w-full border border-gray-300 p-3 rounded-lg bg-gray-100 cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Destination</label>
                            <input type="text" value="{{ $booking->destination->name }}" readonly
                                class="w-full border border-gray-300 p-3 rounded-lg bg-gray-100 cursor-not-allowed focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        </div>
                    </div>

                    {{-- Travel Dates --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Start Date</label>
                            <input type="date" name="travel_date" value="{{ $booking->travel_date }}"
                                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">End Date</label>
                            <input type="date" name="travel_end_date" value="{{ $booking->travel_end_date }}"
                                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        </div>
                    </div>

                    {{-- People & Rooms --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Guests</label>
                            <input type="number" name="people" value="{{ $booking->people }}" min="1"
                                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Rooms</label>
                            <input type="number" name="room" value="{{ $booking->room }}" min="1"
                                class="w-full border border-gray-300 p-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-400">
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex flex-col md:flex-row justify-end gap-3 mt-4">
                        <a href="{{ route('admin.bookings.index') }}"
                           class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-semibold text-center">
                            Back
                        </a>

                        <button type="submit"
                            class="px-6 py-3 bg-yellow-400 text-white rounded-lg hover:bg-yellow-500 font-semibold">
                            Update Booking
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
