<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-coklat-polisi leading-tight tracking-tight">
            ➕ Tambah Link Terkait Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-md border border-gray-200 shadow-xl rounded-2xl overflow-hidden">
                <div class="p-6 sm:p-10 text-gray-800 space-y-8">

                    {{-- Deskripsi Header --}}
                    <div>
                        <h3 class="text-lg font-semibold text-coklat-polisi">📌 Formulir Link Terkait</h3>
                        <p class="text-sm text-gray-500 mt-1">Silakan isi detail link yang ingin ditambahkan.</p>
                    </div>

                    {{-- Form --}}
                    <form action="{{ route('admin.related-links.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @include('admin.related-links._form')

                        {{-- Tombol Aksi --}}
                        <div class="flex justify-end border-t pt-6 mt-6">
                            <a href="{{ route('admin.related-links.index') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-900 mr-4 transition">
                                ← Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-coklat-polisi hover:bg-black text-white text-sm font-semibold rounded-lg shadow transition">
                                💾 Simpan Link
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
