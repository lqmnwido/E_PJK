<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>E-PJK | Sistem Pengurusan Jenazah & Khairat Kematian</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --umpsa-green: #006838;
            --umpsa-yellow: #FFD200;
            --umpsa-navy: #1C2245;
        }

        body {
            font-family: 'Figtree', sans-serif;
        }

        .bg-umpsa-green { background-color: var(--umpsa-green); }
        .text-umpsa-green { color: var(--umpsa-green); }
        .bg-umpsa-navy { background-color: var(--umpsa-navy); }
        .text-umpsa-navy { color: var(--umpsa-navy); }
        
        .btn-umpsa {
            background-color: var(--umpsa-green);
            color: white;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-umpsa:hover {
            background-color: #004d2a;
            color: white;
            transform: translateY(-2px);
        }
        .carousel-item {
            height: 350px;
        }
        .carousel-item img {
            object-fit: cover;
            height: 100%;
            filter: brightness(0.45);
        }
        .carousel-caption {
            bottom: 25%;
            left: 5%;
            right: 5%;
            text-align: center; /* Centered text */
        }
        .nav-link-custom {
            color: #374151 !important; /* gray-700 */
            text-decoration: none !important;
            font-weight: 600;
            font-size: 0.875rem;
            transition: color 0.2s;
        }
        .nav-link-custom:hover {
            color: var(--umpsa-green) !important;
        }
        .brand-text, .brand-text:hover, .brand-text:focus, .brand-text:active {
            color: var(--umpsa-navy) !important;
            text-decoration: none !important;
        }
    </style>
</head>

<body class="antialiased bg-gray-50">
    @include('header')

    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="flex-shrink-0 flex items-center brand-text">
                        <img src="/images/logo3.png" alt="UMPSA Logo" class="h-12 w-auto">
                        <span class="ml-3 text-lg font-bold">E-PJK</span>
                    </a>
                </div>
                <div class="flex items-center space-x-6">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="nav-link-custom">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="nav-link-custom">Log Masuk</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn-umpsa px-4 py-2 rounded-lg text-sm font-semibold no-underline">Daftar Sekarang</a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Carousel -->
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/Image1.jpg') }}" class="d-block w-100" alt="UMPSA Campus">
                <div class="carousel-caption">
                    <h1 class="text-4xl font-bold mb-3 text-white">E-PJK UMPSA</h1>
                    <p class="text-lg mb-4 text-gray-200">Sistem Pengurusan Jenazah & Khairat Kematian Digital untuk kemudahan warga universiti.</p>
                    <a href="#search-section" class="btn-umpsa px-6 py-2.5 rounded-xl text-md inline-block no-underline">Cari Lokasi Jenazah</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/Image2.jpg') }}" class="d-block w-100" alt="Cemetery Mapping">
                <div class="carousel-caption">
                    <h1 class="text-4xl font-bold mb-3 text-white">Pemetaan Digital</h1>
                    <p class="text-lg mb-4 text-gray-200">Cari dan navigasi lokasi lot kubur dengan tepat melalui integrasi Google Maps.</p>
                    <a href="#search-section" class="btn-umpsa px-6 py-2.5 rounded-xl text-md inline-block no-underline">Lihat Peta</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/Image3.jpg') }}" class="d-block w-100" alt="Community Service">
                <div class="carousel-caption">
                    <h1 class="text-4xl font-bold mb-3 text-white">Urusan Lebih Sistematik</h1>
                    <p class="text-lg mb-4 text-gray-200">Pendaftaran Khairat Kematian dan rekod pengurusan jenazah dalam satu platform.</p>
                    <a href="{{ route('register') }}" class="btn-umpsa px-6 py-2.5 rounded-xl text-md inline-block no-underline">Daftar Khairat</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="py-10 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-extrabold text-umpsa-navy sm:text-3xl">Perkhidmatan Kami</h2>
                <div class="mt-2 h-1 w-16 bg-umpsa-yellow mx-auto"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Feature 1 -->
                <div class="p-6 bg-gray-50 rounded-2xl hover:shadow-md transition-all border border-gray-100 text-center">
                    <div class="w-12 h-12 bg-umpsa-green rounded-xl flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Khairat Kematian</h3>
                    <p class="text-sm text-gray-600">Pendaftaran dan pengurusan keahlian khairat kematian yang mudah dan telus bagi semua warga.</p>
                </div>
                <!-- Feature 2 -->
                <div class="p-6 bg-gray-50 rounded-2xl hover:shadow-md transition-all border border-gray-100 text-center">
                    <div class="w-12 h-12 bg-umpsa-green rounded-xl flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Pengurusan Jenazah</h3>
                    <p class="text-sm text-gray-600">Rekod pengurusan jenazah yang tersusun bagi memastikan setiap urusan berjalan lancar.</p>
                </div>
                <!-- Feature 3 -->
                <div class="p-6 bg-gray-50 rounded-2xl hover:shadow-md transition-all border border-gray-100 text-center">
                    <div class="w-12 h-12 bg-umpsa-green rounded-xl flex items-center justify-center mb-4 mx-auto">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Peta Digital</h3>
                    <p class="text-sm text-gray-600">Integrasi peta digital bagi memudahkan pencarian lokasi tanah perkuburan dan lot jenazah.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div id="search-section" class="py-10 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col lg:flex-row border border-gray-100">
                <!-- Map Area -->
                <div class="lg:w-2/3 h-80 lg:h-auto min-h-[350px]">
                    <div id="map" class="h-full w-full"></div>
                </div>

                <!-- Form Area -->
                <div class="lg:w-1/3 p-6 lg:p-8 border-l border-gray-100">
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-umpsa-navy">Carian Jenazah</h2>
                        <p class="text-sm text-gray-500">Sila masukkan nombor Kad Pengenalan.</p>
                    </div>

                    <form action="{{ route('location-search') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="ic" class="block text-xs font-semibold text-gray-700 mb-1 uppercase tracking-wider">No. Kad Pengenalan</label>
                            <input type="text" id="ic" name="ic"
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-umpsa-green focus:border-transparent transition-all text-sm"
                                placeholder="Cth: 900101061234" 
                                @if(isset($jenazah) && $jenazah) value="{{ $jenazah->jenazahIC }}" @endif required>
                        </div>

                        @if (isset($jenazah) && $jenazah)
                            @php
                                $location = $locations->where('locationID', $jenazah->locationID)->first();
                            @endphp
                            
                            <div class="space-y-3 pt-3 border-t border-gray-100">
                                <div class="bg-gray-50 p-3 rounded-xl border border-gray-100">
                                    <span class="block text-[10px] text-gray-400 uppercase font-bold tracking-tight">Nama Jenazah</span>
                                    <span class="text-sm font-bold text-gray-900">{{ $jenazah->jenazahName }}</span>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-xl border border-gray-100">
                                    <span class="block text-[10px] text-gray-400 uppercase font-bold tracking-tight">Tanah Perkuburan</span>
                                    <span class="text-sm font-bold text-gray-900">{{ $location->cemetery ?? 'Tidak Berkenaan' }}</span>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-xl border border-gray-100">
                                    <span class="block text-[10px] text-gray-400 uppercase font-bold tracking-tight">ID Lot Kubur</span>
                                    <span class="text-sm font-bold text-gray-900">{{ $jenazah->graveLot ?? 'N/A' }}</span>
                                </div>
                            </div>

                            @if (isset($location) && $location)
                                <input type="hidden" id="lat" value="{{ $location->latitude }}" />
                                <input type="hidden" id="lng" value="{{ $location->longitude }}" />
                            @endif
                        @else
                            <input type="hidden" id="lat" value="3.90591429604234" />
                            <input type="hidden" id="lng" value="103.35853618383408" />
                        @endif

                        <button type="submit" class="btn-umpsa w-full py-3 rounded-xl font-bold text-sm shadow-md shadow-green-100">
                            Cari Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-umpsa-navy text-white pt-12 pb-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-10">
                <div class="col-span-1 md:col-span-2">
                    <img src="/images/logo3.png" alt="UMPSA Logo" class="h-10 w-auto mb-4 brightness-0 invert">
                    <p class="text-gray-400 text-sm max-w-sm">E-PJK adalah inisiatif UMPSA untuk mendigitalkan pengurusan jenazah dan khairat kematian bagi kemudahan komuniti universiti.</p>
                </div>
                <div>
                    <h4 class="text-md font-bold mb-4">Pautan Pantas</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-umpsa-yellow transition-colors no-underline">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-umpsa-yellow transition-colors no-underline">Dasar Privasi</a></li>
                        <li><a href="#" class="hover:text-umpsa-yellow transition-colors no-underline">Terma & Syarat</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-md font-bold mb-4">Hubungi Kami</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            (+60) 11-1062 3736
                        </li>
                        <li class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            info@umpsa.edu.my
                        </li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-6 flex flex-col md:row justify-between items-center">
                <p class="text-gray-500 text-xs">© 2024 Universiti Malaysia Pahang Al-Sultan Abdullah. Hak Cipta Terpelihara.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeSUIzJDIEuQqvUcmQapj1_k7BxCzYkAw&callback=initMap" async defer></script>

    <script>
        function initMap() {
            var latInput = document.getElementById('lat');
            var lngInput = document.getElementById('lng');
            if (!latInput || !lngInput) return;

            var lat = parseFloat(latInput.value);
            var lng = parseFloat(lngInput.value);
            
            var location = { lat: lat, lng: lng };
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 17,
                center: location,
                disableDefaultUI: true,
                zoomControl: true,
                styles: [
                    {
                        "featureType": "poi.business",
                        "stylers": [{ "visibility": "off" }]
                    }
                ]
            });

            var marker = new google.maps.Marker({
                position: location,
                map: map,
                title: 'Lokasi Jenazah'
            });

            @if(isset($jenazah) && $jenazah)
                var infowindow = new google.maps.InfoWindow({
                    content: '<div class="p-2" style="font-family:Figtree"><strong>' + "{{ $jenazah->jenazahName }}" + '</strong><br>Lot: ' + "{{ $jenazah->graveLot }}" + '</div>'
                });
                infowindow.open(map, marker);
            @endif
        }
    </script>
</body>
</html>
