<div class="space-y-6">
    {{-- Title --}}
    <div>
        <x-input-label for="title" value="Judul Section" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
            :value="old('title', $section->title ?? '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('title')" />
    </div>

    {{-- Content --}}
    <div>
        <x-input-label for="content" value="Isi Konten" />
        <textarea id="content" name="content" rows="6"
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('content', $section->content ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('content')" />
    </div>

    {{-- Key --}}
    <div>
        <x-input-label for="key" value="Key Section" />
        <x-text-input id="key" name="key" type="text" class="mt-1 block w-full"
            :value="old('key', $section->key ?? '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('key')" />
    </div>

    {{-- Image --}}
    <div class="mt-4">
        <x-input-label for="image" value="Gambar Section (opsional)" />
        <input id="image" name="image" type="file"
            class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
            file:rounded-md file:border-0 file:text-sm file:font-semibold
            file:bg-coklat-polisi file:text-white hover:file:bg-black" />
        <x-input-error class="mt-2" :messages="$errors->get('image')" />
    </div>

    {{-- Show old image when editing --}}
    @if(isset($section) && $section->image)
        <div class="mt-4">
            <p class="text-sm text-gray-600 mb-1">Gambar saat ini:</p>
            <img src="{{ asset('storage/' . $section->image) }}" alt="Current image" class="rounded-md w-48 shadow">
        </div>
    @endif
</div>
