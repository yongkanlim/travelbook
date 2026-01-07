                <!-- @forelse is better than @foreach because it handles empty data
                 ===================================================================
                forelse ($bookings as $booking)
                    <div class="card">
                        {{ $booking->name }}
                    </div>

                empty
                    <div class="col-span-3 text-center text-gray-500 py-10">
                        No bookings found.
                    </div>

                endforelse -->

                <!-- Why do we need @php here?
                ==================================================================
                Blade cannot do this directly:
                {{ 
                ($booking->adult_tickets * $booking->attraction->adult_price) +
                ($booking->child_tickets * $booking->attraction->child_price)
                }}

                This becomes long and unreadable
                Cannot store the result in a variable
                Cannot reuse the value later -->

                <!-- Eloquent relationships (Connect tables like join but no need write SQL join)
                    ==============================================================================================
                    $booking->attraction
                    Means a / each booking belongs to an attraction
                    To use this:
                    1. Table attractions - id, name   | attraction_bookings - id, attraction_id (need FK here)
                    2. Go to attractionbooking model, define attraction() function (booking belongsTo attraction)
                    -->