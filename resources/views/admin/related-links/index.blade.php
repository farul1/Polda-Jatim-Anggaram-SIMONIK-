<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-coklat-polisi leading-tight">
            🔗 Manajemen Link Terkait
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-sm border border-gray-200 shadow-xl rounded-2xl overflow-hidden">
                <div class="p-6 sm:p-8 space-y-6 text-gray-800">

                    {{-- Tombol Tambah --}}
                    <div class="flex justify-end">
                        <a href="{{ route('admin.related-links.create') }}"
                            class="inline-flex items-center bg-coklat-polisi hover:bg-black text-white text-sm font-semibold px-5 py-2.5 rounded-lg shadow transition">
                            ➕ Tambah Link Baru
                        </a>
                    </div>

                    {{-- Flash Message --}}
                    @if(session('success'))
                        <div class="p-4 bg-green-100 text-green-800 rounded-lg font-medium shadow-sm">
                            ✅ {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tabel --}}
                    <div class="overflow-x-auto border rounded-lg shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wide">#️⃣ Urutan</th>
                                    <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wide">🖼️ Logo</th>
                                    <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wide">🏷️ Nama</th>
                                    <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wide">🔗 URL</th>
                                    <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wide">⚙️ Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse($links as $link)
                                    <tr class="hover:bg-yellow-50 transition">
                                        <td class="px-6 py-4">{{ $link->order }}</td>
                                        <td class="px-6 py-4">
                                            <img src="{{ Storage::url($link->logo_path) }}" alt="{{ $link->name }}"
                                                class="h-10 w-10 object-contain rounded shadow border">
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900">{{ $link->name }}</td>
                                        <td class="px-6 py-4">
                                            <a href="{{ $link->url }}" target="_blank"
                                                class="text-blue-600 hover:text-blue-800 hover:underline break-all">
                                                🌐 {{ $link->url }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-wrap gap-2">
                                                {{-- Tombol Edit --}}
                                                <a href="{{ route('admin.related-links.edit', $link->id) }}"
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-100 text-blue-800 text-xs font-semibold rounded-md hover:bg-blue-200 transition">
                                                    ✏️ Edit
                                                </a>

                                                {{-- Tombol Hapus --}}
                                                <form action="{{ route('admin.related-links.destroy', $link->id) }}"
                                                    method="POST" onsubmit="return confirm('Yakin ingin menghapus link ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="inline-flex items-center gap-1 px-3 py-1.5 bg-red-100 text-red-800 text-xs font-semibold rounded-md hover:bg-red-200 transition">
                                                        🗑️ Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-6 text-center text-gray-500 italic">
                                            Belum ada link terkait.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
