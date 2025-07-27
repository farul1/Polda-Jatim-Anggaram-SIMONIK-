<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-coklat-polisi leading-tight">{{ __('Edit Link Terkait') }}</h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/80 backdrop-blur-sm shadow-lg sm:rounded-lg p-8">
                <form action="{{ route('admin.related-links.update', $link->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('admin.related-links._form')
                     <div class="flex items-center justify-end mt-8 border-t pt-6">
                        <a href="{{ route('admin.related-links.index') }}" class="text-sm text-gray-600 hover:text-gray-900 me-4">Batal</a>
                        <x-primary-button>Perbarui</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
