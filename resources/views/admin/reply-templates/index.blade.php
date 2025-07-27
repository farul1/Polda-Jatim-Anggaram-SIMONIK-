<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-coklat-polisi leading-tight">
            📩 Manajemen Template Balasan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 backdrop-blur-sm overflow-hidden shadow-lg sm:rounded-lg p-6 space-y-6">

                {{-- Tombol Tambah --}}
                <div class="flex justify-end">
                    <a href="{{ route('admin.reply-templates.create') }}"
                        class="inline-flex items-center bg-coklat-polisi hover:bg-black text-white text-sm font-semibold px-5 py-2.5 rounded-lg shadow transition">
                        ➕ Tambah Template Baru
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
                    <table class="min-w-full divide-y divide-gray-300 text-sm">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left font-bold text-coklat-polisi uppercase tracking-wide">📝 Pesan Template</th>
                                <th class="px-6 py-3 text-left font-bold text-coklat-polisi uppercase tracking-wide">⚙️ Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($templates as $template)
                                <tr class="even:bg-gray-50 hover:bg-yellow-50 transition">
                                    <td class="px-6 py-4 text-gray-800">{{ $template->message }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-2">
                                            {{-- Edit --}}
                                            <a href="{{ route('admin.reply-templates.edit', $template->id) }}"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-blue-100 text-blue-800 text-xs font-semibold rounded-md hover:bg-blue-200 transition">
                                                ✏️ Edit
                                            </a>

                                            {{-- Hapus --}}
                                            <form action="{{ route('admin.reply-templates.destroy', $template->id) }}"
                                                method="POST" onsubmit="return confirm('Yakin hapus?');">
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
                                    <td colspan="2" class="px-6 py-6 text-center text-gray-500 italic">
                                        Belum ada template.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
