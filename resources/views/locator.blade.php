<x-guest-layout>
    {{-- Menambahkan library CSS & JS untuk peta interaktif --}}
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    @endpush

    {{-- Latar belakang halaman --}}
    <div class="py-12" style="background-image: url('{{ asset(get_setting('background_image')) ?? '' }}'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white/80 backdrop-blur-sm shadow-xl sm:rounded-lg">
                <div class="p-6 md:p-8">
                    <div class="mb-6 pb-6 border-b border-gray-300">
                        <h1 class="text-3xl font-extrabold text-coklat-polisi text-center">Pencarian Kantor Polisi Wilayah Surabaya</h1>
                        <form method="GET" action="{{ route('locator.index') }}" class="mt-4 flex max-w-xl mx-auto">
                            <input type="text" name="q" placeholder="Ketikkan nama kantor atau kota..."
                                   class="w-full p-3 border border-gray-300 rounded-l-md shadow-sm focus:ring-kuning-polisi focus:border-kuning-polisi"
                                   value="{{ request('q') }}">
                            <button type="submit" class="px-6 py-3 bg-coklat-polisi text-white font-bold rounded-r-md hover:bg-black transition">
                                Cari
                            </button>
                        </form>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-1 h-[60vh] overflow-y-auto space-y-1 bg-white/50 rounded-lg shadow-inner">
                             <div class="p-4 border-b bg-gray-100 sticky top-0">
                                <h3 class="font-bold text-lg">Hasil Pencarian ({{ $stations->count() }})</h3>
                            </div>
                            @forelse($stations as $station)
                                <div class="p-4 border-b hover:bg-kuning-polisi/30 cursor-pointer" onclick="map.flyTo([{{ $station->latitude }}, {{ $station->longitude }}], 16);">
                                    <h3 class="font-bold text-coklat-polisi">{{ $station->name }}</h3>
                                    <p class="text-sm text-gray-600 mt-1">{{ $station->address }}</p>
                                    @if($station->phone_number)
                                        <p class="text-sm text-gray-600 mt-1">Telp: {{ $station->phone_number }}</p>
                                    @endif
                                </div>
                            @empty
                                <p class="text-gray-500 p-4">Lokasi tidak ditemukan.</p>
                            @endforelse
                        </div>

                        <div id="map" class="lg:col-span-2 h-[60vh] rounded-lg shadow-lg z-0"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Inisialisasi Peta
            var map = L.map('map').setView([-7.5, 112.0], 8);

            // Ganti Tile Layer agar terlihat seperti Google Maps
            L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
                maxZoom: 20,
                subdomains:['mt0','mt1','mt2','mt3'],
                attribution: 'Map data &copy; Google'
            }).addTo(map);

            const stations = @json($stations);
            const markers = [];

            stations.forEach(station => {
                const marker = L.marker([station.latitude, station.longitude]).addTo(map)
                    .bindPopup(`<b>${station.name}</b><br>${station.address}`);
                markers.push(marker);
            });

            if (stations.length === 1) {
                map.setView([stations[0].latitude, stations[0].longitude], 16);
            } else if (markers.length > 0) {
                var group = new L.featureGroup(markers);
                map.fitBounds(group.getBounds().pad(0.3));
            }
        });
    </script>
    @endpush
</x-guest-layout>
