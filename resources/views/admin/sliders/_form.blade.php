<div class="space-y-6">

    {{-- Judul Slide --}}
    <div>
        <x-input-label for="title" :value="__('📝 Judul (Opsional)')" />
        <x-text-input id="title" name="title" type="text"
            class="mt-2 block w-full rounded-lg shadow-sm border-gray-300 focus:border-coklat-polisi focus:ring-coklat-polisi"
            :value="old('title', $slider->title ?? '')" placeholder="Contoh: Selamat Datang di Website Kami" />
        <x-input-error class="mt-1 text-sm text-red-600" :messages="$errors->get('title')" />
    </div>

    {{-- Sub Judul --}}
    <div>
        <x-input-label for="subtitle" :value="__('🗒️ Sub-judul (Opsional)')" />
        <textarea id="subtitle" name="subtitle"
            class="mt-2 block w-full rounded-lg shadow-sm border-gray-300 focus:border-coklat-polisi focus:ring-coklat-polisi text-sm"
            rows="3" placeholder="Contoh: Kami hadir memberikan pelayanan terbaik untuk masyarakat.">{{ old('subtitle', $slider->subtitle ?? '') }}</textarea>
        <x-input-error class="mt-1 text-sm text-red-600" :messages="$errors->get('subtitle')" />
    </div>

    {{-- Urutan Tampil --}}
    <div>
        <x-input-label for="order" :value="__('🔢 Urutan Tampil')" />
        <x-text-input id="order" name="order" type="number" min="0"
            class="mt-2 block w-32 rounded-lg shadow-sm border-gray-300 focus:border-coklat-polisi focus:ring-coklat-polisi"
            :value="old('order', $slider->order ?? 0)" required />
        <x-input-error class="mt-1 text-sm text-red-600" :messages="$errors->get('order')" />
    </div>

    {{-- Upload Gambar --}}
    <div>
        <x-input-label for="image" :value="__('🖼️ Gambar Slide (Rasio 16:9)')" />
        <input id="image" name="image" type="file"
            class="mt-2 block w-full text-sm border border-gray-300 rounded-lg shadow-sm file:bg-coklat-polisi file:text-white file:px-4 file:py-2 file:border-0 file:rounded file:cursor-pointer file:shadow-sm hover:file:bg-black transition" />
        <x-input-error class="mt-1 text-sm text-red-600" :messages="$errors->get('image')" />
    </div>

    {{-- Preview Gambar Lama --}}
    @if(isset($slider) && $slider->image_path)
        <div class="mt-4">
            <p class="text-sm text-gray-600 mb-2 font-medium">🖼️ Gambar Saat Ini:</p>
            <div class="w-full max-w-md rounded-lg border border-gray-200 shadow overflow-hidden">
                <img src="{{ Storage::url($slider->image_path) }}" alt="Pratinjau Slide"
                    class="w-full h-auto object-cover">
            </div>
        </div>
    @endif

</div>
