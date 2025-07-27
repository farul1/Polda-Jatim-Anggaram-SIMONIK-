<div class="space-y-6">
    <div>
        <x-input-label for="name" value="Nama Kantor (Contoh: Polrestabes Surabaya)" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $station->name ?? '')" required />
    </div>
    <div>
        <x-input-label for="address" value="Alamat Lengkap" />
        <textarea id="address" name="address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('address', $station->address ?? '') }}</textarea>
    </div>
    <div>
        <x-input-label for="city" value="Kota/Kabupaten" />
        <x-text-input id="city" name="city" type="text" class="mt-1 block w-full" :value="old('city', $station->city ?? '')" required />
    </div>
    <div>
        <x-input-label for="phone_number" value="Nomor Telepon (Opsional)" />
        <x-text-input id="phone_number" name="phone_number" type="text" class="mt-1 block w-full" :value="old('phone_number', $station->phone_number ?? '')" />
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <x-input-label for="latitude" value="Latitude" />
            <x-text-input id="latitude" name="latitude" type="text" class="mt-1 block w-full" :value="old('latitude', $station->latitude ?? '')" required placeholder="-7.257472" />
        </div>
        <div>
            <x-input-label for="longitude" value="Longitude" />
            <x-text-input id="longitude" name="longitude" type="text" class="mt-1 block w-full" :value="old('longitude', $station->longitude ?? '')" required placeholder="112.752113" />
        </div>
    </div>
    <p class="text-xs text-gray-500">Tips: Buka Google Maps, klik kanan di lokasi, angka pertama adalah Latitude, angka kedua adalah Longitude.</p>
</div>
