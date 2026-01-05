<x-app-layout>
    <div class="max-w-3xl mx-auto p-10 pt-24 pb-16">
        {{-- Card Wrapper --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

            {{-- Header --}}
            <div class="bg-gray-50 px-7 py-3 border-b border-gray-200 text-center">
                <h1 class="text-2xl font-bold text-gray-800">Edit Attraction Ticket</h1>
            </div>

            {{-- Body --}}
            <div class="p-6 space-y-6">

                {{-- Messages --}}
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
                <form method="POST"
                      action="{{ route('admin.attractionbooking.update', $booking) }}"
                      class="space-y-6">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="attraction_id" value="{{ $booking->attraction_id }}">

                    {{-- User & Attraction (readonly) --}}
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">User</label>
                            <input type="text"
                                   value="{{ $booking->user->name }}"
                                   readonly
                                   class="w-full border p-3 rounded-lg bg-gray-100 cursor-not-allowed">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Attraction</label>
                            <input type="text"
                                   value="{{ $booking->attraction->name }}"
                                   readonly
                                   class="w-full border p-3 rounded-lg bg-gray-100 cursor-not-allowed">
                        </div>
                    </div>

                    {{-- Visit Date --}}
                    <div>
                        <label class="block text-gray-700 font-medium mb-1">Visit Date</label>
                        <input type="date"
                               name="visit_date"
                               value="{{ $booking->visit_date }}"
                               class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-yellow-400">
                    </div>

                    {{-- Tickets --}}
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Adult Tickets</label>
                            <input type="number"
                                   name="adult_tickets"
                                   min="0"
                                   value="{{ $booking->adult_tickets }}"
                                   class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-yellow-400">
                        </div>

                        <div>
                            <label class="block text-gray-700 font-medium mb-1">Child Tickets</label>
                            <input type="number"
                                   name="child_tickets"
                                   min="0"
                                   value="{{ $booking->child_tickets }}"
                                   class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-yellow-400">
                        </div>
                    </div>

                    {{-- Buttons --}}
                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('admin.attractionbooking.index') }}"
                           class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 font-semibold">
                            Back
                        </a>

                        <button type="submit"
                                class="px-6 py-3 bg-yellow-400 text-white rounded-lg hover:bg-yellow-500 font-semibold">
                            Update Ticket
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
