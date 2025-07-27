<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-coklat-polisi leading-tight">{{ __('Tambah Section Baru') }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-sm shadow-lg sm:rounded-lg p-8">
                <form action="{{ route('admin.homepage-sections.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @include('admin.homepage-sections._form')
                    <div class="flex items-center justify-end mt-8 border-t pt-6">
                        <a href="{{ route('admin.homepage-sections.index') }}" class="text-sm text-gray-600 hover:text-gray-900 me-4">Batal</a>
                        <x-primary-button>Simpan</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
