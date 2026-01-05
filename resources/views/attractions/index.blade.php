<!-- -----------------------------------------------------------------------------------------------
    Uses a Blade layout component (Top navigation bar, Global styles) 
    [use layout.guest.blade.php that will display navbar]
 ----------------------------------------------------------------------------------------------- -->
<x-guest-layout>

{{-- Hero Section --}}
<!-- ------------------------------------------------------------------------
    Display a image & title (hero section like the upper banner of website) 
------------------------------------------------------------------------- -->
<section class="relative h-[500px] bg-cover bg-center"
    style="background-image:url('https://cdn.pixabay.com/photo/2024/05/29/00/15/green-8794928_1280.jpg')">
    <!-- Dark Overlay - dark layer on top of image -->
    <div class="absolute inset-0 bg-black/40"></div>

    <div class="relative max-w-6xl mx-auto pt-40 px-6 text-white">
        <h1 class="text-4xl font-bold mb-4">
            Explore Popular Attractions
        </h1>

        <!-- =================================================================================================================================
            Search Form
        ======================================================================================================================================
        Method: GET → so the search query will appear in the URL.
        Action: {{ route('attractions.index') }} → sends the search request to the index route of attractions.
        ================================================================================================================================= -->
        <form method="GET" action="{{ route('attractions.index') }}" 
            class="bg-white rounded-lg p-4 flex gap-3 text-black">
            
            <!-- Search Input: 70% -->
            <!-- ------------------------------------------------------------- -->
            <!-- Input: text field for typing the destination/location.  -->
            <!-- value="{{ request('search') }}" keeps the previous search query in the field. -->
            <input type="text" name="search" 
                class="border p-3 rounded flex-[7]" 
                placeholder="Search attraction or location" 
                value="{{ request('search') }}">

            <!-- Search Button: 30% -->
            <!-- ------------------------------------------------------------- -->
            <!-- Button: submits the search form. -->
            <button type="submit" 
                    class="bg-blue-600 text-white rounded p-3 flex-[3]">
                Search
            </button>
        </form>
    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-10">
    <h2 class="text-2xl font-bold mb-6">Available Attractions</h2>

    <div class="grid md:grid-cols-3 gap-6">
        <!-- =================================================================================================================================
        Use Loop to display Attraction in card (White card)
        ======================================================================================================================================
        $attractions passed from the controller.
        Card Content:
        Image, Name, location, Adult/Child Prices, Number of available tickets, "View Details" link to route('attractions.show', $a) 
        ================================================================================================================================= -->
        @foreach ($attractions as $a)
        <div class="bg-white rounded shadow overflow-hidden">
            {{-- Image --}}
            @if($a->image)
            <img src="{{ $a->image }}" alt="{{ $a->name }}" class="w-full h-48 object-cover">
            @endif

            <div class="p-4">
                <h3 class="font-bold text-lg">{{ $a->name }}</h3>
                <p class="text-gray-600">{{ $a->location }}</p>

                {{-- Ticket Prices --}}
                <p class="text-blue-600 font-semibold mt-2">
                    Adult: RM {{ $a->adult_price }} | Child: RM {{ $a->child_price }}
                </p>

                {{-- Available Tickets --}}
                <p class="text-gray-800 mt-1">
                    Available Adult Tickets: <span class="font-semibold">{{ $a->available_adult_tickets }}</span><br>
                    Available Child Tickets: <span class="font-semibold">{{ $a->available_child_tickets }}</span>
                </p>

                <a href="{{ route('attractions.show', $a) }}"
                   class="text-blue-500 mt-3 inline-block">
                   View Details →
                </a>
            </div>
        </div>
        @endforeach
    </div>
</section>

</x-guest-layout>
