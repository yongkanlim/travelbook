<x-app-layout>
    <div id="attraction-background"
         class="min-h-screen relative bg-cover bg-center transition-all duration-1000">

        <div class="max-w-7xl mx-auto px-6 pt-28 pb-16">
            <!-- Transparent Card Wrapper -->
            <div
                class="bg-white/70 backdrop-blur-lg rounded-3xl shadow-xl border border-white/30 p-8">

                <!-- Title -->
                <h1 class="text-2xl sm:text-3xl font-extrabold text-gray-800 mb-6 text-center">
                    Recommended Attractions
                </h1>

                <!-- Table -->
                <div class="bg-white/80 rounded-2xl overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100/70">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                    Location
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                    Description
                                </th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                                    Rating
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200/60">
                            @forelse($attractions as $attraction)
                                <tr class="hover:bg-gray-100/60 transition">
                                    <td class="px-6 py-4 font-medium text-gray-800">
                                        {{ $attraction->name }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $attraction->location ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">
                                        {{ $attraction->description ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-emerald-600">
                                        {{ $attraction->rating ?? 0 }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4"
                                        class="px-6 py-8 text-center text-gray-500">
                                        No recommended attractions found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @vite('resources/js/attraction-background.js')
</x-app-layout>
