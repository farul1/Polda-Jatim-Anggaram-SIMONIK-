<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-coklat-polisi leading-tight tracking-tight">
            🆕 Tambah Slide Baru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-md border border-gray-200 shadow-xl rounded-2xl overflow-hidden">
                <div class="p-6 sm:p-10 text-gray-800 space-y-8">

                    {{-- Judul Section --}}
                    <div class="mb-2">
                        <h3 class="text-xl font-semibold tracking-wide text-coklat-polisi">📋 Form Tambah Slide</h3>
                        <p class="text-sm text-gray-500 mt-1">Lengkapi informasi di bawah untuk menambahkan slider baru.</p>
                    </div>

                    {{-- Form --}}
                    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @include('admin.sliders._form')

                        {{-- Tombol Aksi --}}
                        <div class="flex items-center justify-end gap-4 pt-6 mt-6 border-t border-gray-200">
                            <a href="{{ route('admin.sliders.index') }}"
                                class="inline-flex items-center text-sm font-medium text-gray-600 hover:text-gray-800 hover:underline transition">
                                ← Batal
                            </a>

                            <button type="submit"
                                class="inline-flex items-center gap-2 px-5 py-2.5 bg-coklat-polisi text-white font-semibold text-sm rounded-lg shadow hover:bg-black transition">
                                💾 Simpan Slide
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
