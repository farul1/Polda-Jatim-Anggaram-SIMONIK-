<div class="space-y-6">
    <div>
        <x-input-label for="name" value="Nama Link" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $link->name ?? '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>
    <div>
        <x-input-label for="url" value="URL (Alamat Website)" />
        <x-text-input id="url" name="url" type="text" class="mt-1 block w-full" :value="old('url', $link->url ?? '')" required placeholder="https://..." />
        <x-input-error class="mt-2" :messages="$errors->get('url')" />
    </div>
    <div>
        <x-input-label for="order" value="Urutan Tampil" />
        <x-text-input id="order" name="order" type="number" class="mt-1 block w-full" :value="old('order', $link->order ?? 0)" required />
        <x-input-error class="mt-2" :messages="$errors->get('order')" />
    </div>
    <div>
        <x-input-label for="logo" value="Logo Link" />
        <input id="logo" name="logo" type="file" class="mt-1 block w-full border p-2 rounded">
        <x-input-error class="mt-2" :messages="$errors->get('logo')" />
    </div>
    @if(isset($link) && $link->logo_path)
    <div class="mt-2"><p class="text-sm text-gray-500">Logo saat ini:</p><img src="{{ Storage::url($link->logo_path) }}" alt="Pratinjau" class="mt-2 h-16 w-auto rounded"></div>
    @endif
</div>
