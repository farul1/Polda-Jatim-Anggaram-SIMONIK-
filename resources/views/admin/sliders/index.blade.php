<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-coklat-polisi leading-tight">
            {{ __('🖼️ Manajemen Slider') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-sm border border-gray-200 shadow-xl rounded-2xl overflow-hidden">
                <div class="p-6 sm:p-8 space-y-6 text-gray-800">

                    {{-- Tombol Tambah --}}
                    <div class="flex justify-end">
                        <a href="{{ route('admin.sliders.create') }}"
                            class="inline-flex items-center bg-coklat-polisi hover:bg-black text-white font-semibold text-sm px-5 py-2.5 rounded-lg shadow transition">
                            ➕ Tambah Slide
                        </a>
                    </div>

                    {{-- Flash Message --}}
                    @if(session('success'))
                        <div class="p-4 bg-green-100 text-green-800 rounded-lg font-medium shadow-sm">
                            ✅ {{ session('success') }}
                        </div>
                    @endif

                    {{-- Tabel Slider --}}
                    <div class="overflow-x-auto border rounded-lg shadow-sm">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wide">#️⃣ Urutan</th>
                                    <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wide">🖼️ Gambar</th>
                                    <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wide">📝 Judul</th>
                                    <th class="px-6 py-4 text-left font-bold text-gray-700 uppercase tracking-wide">⚙️ Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse($sliders as $slider)
                                    <tr class="hover:bg-yellow-50 transition">
                                        <td class="px-6 py-4">{{ $slider->order }}</td>
                                        <td class="px-6 py-4">
                                            <div class="w-40 h-20 overflow-hidden rounded-lg border">
                                                <img src="{{ Storage::url($slider->image_path) }}"
                                                    alt="{{ $slider->title }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 font-medium text-gray-900">
                                            {{ $slider->title ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4 flex gap-2 items-center">
                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('admin.sliders.edit', $slider->id) }}"
                                                class="inline-flex items-center px-3 py-1.5 bg-blue-100 text-blue-700 hover:bg-blue-200 text-sm font-medium rounded-md transition shadow-sm">
                                                <span class="mr-1">✏️</span> Edit
                                            </a>

                                            {{-- Tombol Hapus --}}
                                            <form action="{{ route('admin.sliders.destroy', $slider->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus slide ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-100 text-red-700 hover:bg-red-200 text-sm font-medium rounded-md transition shadow-sm">
                                                    <span class="mr-1">🗑️</span> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-6 text-center text-gray-500 italic">
                                            Belum ada slide yang ditambahkan.
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
