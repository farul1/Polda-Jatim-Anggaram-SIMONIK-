<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-coklat-polisi leading-tight">
            @if(auth()->user()->isSuperAdmin())
                📊 Dashboard Admin (Semua Wilayah)
            @elseif(auth()->user()->isAdmin())
                📊 Dashboard Wilayah: {{ auth()->user()->kota }}
            @else
                📊 Dashboard Admin
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md sm:rounded-lg p-6">
                @if(session('success'))
                    <div class="mb-4 p-3 rounded-lg bg-green-100 text-green-700">{{ session('success') }}</div>
                @endif

                {{-- Filter Super Admin --}}
                @if(auth()->user()->isSuperAdmin())
                <div class="mb-6 bg-gray-50 p-4 rounded-lg border">
                    <form method="GET" action="{{ route('admin.dashboard') }}">
                        <div class="flex items-center space-x-4">
                            <div class="flex-grow">
                                <label for="kota" class="text-sm font-medium text-gray-700">Filter Berdasarkan Wilayah Polres:</label>
                                <select name="kota" id="kota" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                    <option value="">-- Tampilkan Semua Wilayah --</option>
                                    @foreach($daftarKota as $kota)
                                        <option value="{{ $kota }}" @if(request('kota') == $kota) selected @endif>{{ $kota }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="pt-6">
                                <button type="submit" class="px-5 py-2 bg-coklat-polisi text-white font-semibold rounded-md hover:bg-black">Filter</button>
                                <a href="{{ route('admin.dashboard') }}" class="ms-2 text-sm text-gray-600">Reset</a>
                            </div>
                        </div>
                    </form>
                </div>
                @endif

                {{-- Enhanced Chart Section --}}
                @if($chartLabels->count() > 0 && $chartData->count() > 0)
                <div class="mb-8">
                    <div class="bg-white border rounded-lg p-6 shadow-sm">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">📈 Visualisasi Sisa Pagu Polsek</h3>
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <span class="w-2 h-2 mr-1 rounded-full bg-blue-500"></span>
                                    Sisa Pagu
                                </span>
                                @if(auth()->user()->isSuperAdmin() && request('kota'))
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    Wilayah: {{ request('kota') }}
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="relative h-96">
                            <canvas id="paguChart"></canvas>
                        </div>
                        <div class="mt-4 text-xs text-gray-500 text-center">
                            Data diperbarui: {{ now()->format('d M Y H:i') }}
                        </div>
                    </div>
                </div>
                @endif

                {{-- Tabel Pengajuan --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-blue-50">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold text-blue-700 uppercase tracking-wider">👮‍♂️ Polsek</th>
                                <th class="px-6 py-3 text-left font-semibold text-blue-700 uppercase tracking-wider">📅 Tanggal</th>
                                <th class="px-6 py-3 text-left font-semibold text-blue-700 uppercase tracking-wider">💰 Jumlah</th>
                                <th class="px-6 py-3 text-left font-semibold text-blue-700 uppercase tracking-wider">📌 Status</th>
                                <th class="px-6 py-3 text-left font-semibold text-blue-700 uppercase tracking-wider">⚙️ Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse($pengajuans as $pengajuan)
                                @php
                                    $statusColor = match($pengajuan->status) {
                                        'Diproses' => 'bg-yellow-100 text-yellow-800',
                                        'Selesai'  => 'bg-green-100 text-green-800',
                                        default    => 'bg-red-100 text-red-800',
                                    };
                                    $statusEmoji = match($pengajuan->status) {
                                        'Diproses' => '⏳',
                                        'Selesai'  => '✅',
                                        default    => '❌',
                                    };
                                @endphp
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $pengajuan->user->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ \Carbon\Carbon::parse($pengajuan->created_at)->format('d M Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">Rp {{ number_format($pengajuan->jumlah_diajukan, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor }}">
                                            {{ $statusEmoji }} {{ $pengajuan->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <a href="{{ route('admin.pengajuan.show', $pengajuan->id) }}"
                                           class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-100 text-blue-700 rounded-md shadow-sm hover:bg-blue-600 transition-all duration-200">
                                            🔍 Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-400">
                                        🚫 Belum ada data pengajuan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('paguChart').getContext('2d');

            // Gradient for chart bars
            const gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(59, 130, 246, 0.8)');
            gradient.addColorStop(1, 'rgba(59, 130, 246, 0.2)');

            const paguChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chartLabels) !!},
                    datasets: [{
                        label: 'Sisa Pagu',
                        data: {!! json_encode($chartData) !!},
                        backgroundColor: gradient,
                        borderColor: 'rgba(59, 130, 246, 1)',
                        borderWidth: 1,
                        borderRadius: 6,
                        hoverBackgroundColor: 'rgba(29, 78, 216, 0.8)',
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Sisa Pagu: Rp ' + context.raw.toLocaleString('id-ID');
                                }
                            },
                            padding: 10,
                            backgroundColor: 'rgba(0, 0, 0, 0.7)',
                            titleFont: {
                                size: 14,
                                weight: 'bold'
                            },
                            bodyFont: {
                                size: 12
                            }
                        },
                        datalabels: {
                            display: false // Disable if you don't want values on bars
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0, 0, 0, 0.05)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                },
                                font: {
                                    weight: 'bold'
                                }
                            },
                            title: {
                                display: true,
                                text: 'Jumlah Pagu',
                                font: {
                                    weight: 'bold',
                                    size: 12
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                font: {
                                    weight: 'bold'
                                }
                            },
                            title: {
                                display: true,
                                text: 'Nama Polsek',
                                font: {
                                    weight: 'bold',
                                    size: 12
                                }
                            }
                        }
                    },
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    }
                }
            });
        });
    </script>
    @endpush
</x-app-layout>
