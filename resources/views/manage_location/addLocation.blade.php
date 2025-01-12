<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<x-app-layout>
    <br />
    <div class="container">
        <div class="text-center mb-4">
            <h1 class="text-4xl font-bold">MANAGE JENAZAH</h1>
        </div>

        <div class="container mx-auto px-4 bg-gray-200 rounded-3xl py-5 shadow-lg">
            <form action="{{ route('location-submit') }}" method="POST">
                @csrf
                <h3 class="text-lg font-bold mb-4">JENAZAH DETAILS</h3>
                <input type="hidden" name="jenID" value="{{ $jenazah->jenazahID }}">
                <!-- Flex row for input and label side by side -->
                <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                    <label for="no_kad_pengenalan" class="font-semibold text-left w-40">No. Kad Pengenalan</label>
                    <x-input id="no_kad_pengenalan" class="form-control w-96" type="text" name="noIC"
                        placeholder="No. Kad Pengenalan" value="{{ $jenazah->jenazahIC }}" required autofocus readonly/>
                </div>

                <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                    <label for="nama" class="font-semibold text-left w-40">Name</label>
                    <x-input id="nama" class="form-control w-96" type="text" name="name" placeholder="Nama"
                        value="{{ $jenazah->jenazahName }}" required readonly/>
                </div>

                <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                    <label for="no_telefon" class="font-semibold text-left w-40">Tarikh Lahir</label>
                    <x-input id="no_telefon" class="form-control w-96" type="date" name="phone"
                        placeholder="No. Telefon" value="{{ $jenazah->jenazahDOB }}" required readonly/>
                </div>

                <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                    <label for="tarikh_lahir" class="font-semibold text-left w-40">Tarikh Meninggal</label>
                    <x-input id="tarikh_lahir" class="form-control w-96" type="date" name="DOB"
                        value="{{ $jenazah->deathDate }}" required readonly/>
                </div>

                <div class="mb-3">
                    <label for="Lot ID" class="font-semibold text-left w-40">LOT ID:</label>
                    <x-input type="text" class="form-control w-96" id="lotID" name="lotID"
                        placeholder="Lot ID" />
                </div>
                <div class="mb-3">
                    <label for="map" class="font-semibold text-left w-40">Map:</label>
                    <x-input type="text" class="form-control w-96" id="searchmap" name="searchmap"
                        placeholder="Search for a location" />
                    <div id="map-canvas" style="width: 100%; height: 400px;">
                    </div>
                </div>

                <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                    <label for="lat" class="font-semibold text-left w-40">Latitude:</label>
                    <x-input type="text" class="form-control w-96" name="lat" id="lat" />
                </div>

                <div class="mb-4 flex items-center justify-center gap-4 ml-8">
                    <label for="lng" class="font-semibold text-left w-40">Longtitude:</label>
                    <x-input type="text" class="form-control w-96" name="lng" id="lng" />
                </div>

                <div class="flex items-center justify-center mt-5">
                    <x-button class="btn btn-primary w-48">
                        {{ __('SUBMIT') }}
                    </x-button>
                </div>
            </form>
        </div>
        </br>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="module" src="https://unpkg.com/@googlemaps/extended-component-library@0.6"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeSUIzJDIEuQqvUcmQapj1_k7BxCzYkAw&libraries=places&callback=initMap"
        async defer></script>
    <script>
        function initMap() {
            var map = new google.maps.Map(document.getElementById('map-canvas'), {
                center: {
                    lat: 3.90591429604234,
                    lng: 103.35853618383408
                },
                zoom: 19
            });

            var marker = new google.maps.Marker({
                position: {
                    lat: 3.90591429604234,
                    lng: 103.35853618383408
                },
                map: map,
                draggable: true
            });

            var searchBox = new google.maps.places.SearchBox(document.getElementById('searchmap'));

            google.maps.event.addListener(searchBox, 'places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length === 0) {
                    console.log("No places found"); // Debugging output
                    return;
                }

                console.log("Places found:", places); // Debugging output

                var bounds = new google.maps.LatLngBounds();
                var i, place;

                for (i = 0;
                    (place = places[i]); i++) {
                    bounds.extend(place.geometry.location);
                    marker.setPosition(place.geometry.location);
                }

                map.fitBounds(bounds);
                map.setZoom(19);
            });


            google.maps.event.addListener(marker, 'position_changed', function() {
                var lat = marker.getPosition().lat();
                var lng = marker.getPosition().lng();
                console.log("Lat: " + lat + ", Lng: " + lng); // Debugging output
                $('#lat').val(lat);
                $('#lng').val(lng);
            });

        }
    </script>
</x-app-layout>
