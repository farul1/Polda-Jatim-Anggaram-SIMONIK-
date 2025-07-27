@php
    $isSuperAdmin = auth()->user()->isSuperAdmin();
    $isAdmin = auth()->user()->isAdmin();
@endphp

<div class="space-y-6">
    {{-- Nama --}}
    <div>
        <x-input-label for="name" :value="__('Nama Lengkap')" />
        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
            :value="old('name', $user->name ?? '')" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    {{-- Email --}}
    <div class="mt-4">
        <x-input-label for="email" :value="__('Alamat Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
            :value="old('email', $user->email ?? '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>

    {{-- Role (Superadmin Only) --}}
    @if($isSuperAdmin)
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role Pengguna')" />
            <select name="role" id="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                <option value="polsek" @selected(old('role', $user->role ?? '') == 'polsek')>Polsek</option>
                <option value="polres" @selected(old('role', $user->role ?? '') == 'polres')>Polres (Admin)</option>
                <option value="superadmin" @selected(old('role', $user->role ?? '') == 'superadmin')>Super Admin</option>
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('role')" />
        </div>
    @endif

    {{-- Kota (Superadmin & Polres Admin) --}}
    @if($isSuperAdmin || $isAdmin)
        <div class="mt-4">
            <x-input-label for="kota" value="Kota/Kabupaten" />
            <select name="kota" id="kota" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                <option value="">-- Pilih Wilayah --</option>
                @foreach($daftarKota as $kota)
                    <option value="{{ $kota }}"
                        @selected(old('kota', $user->kota ?? auth()->user()->kota) == $kota)>{{ $kota }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('kota')" />
        </div>
    @endif

    {{-- Alamat Polsek --}}
    <div class="mt-4">
        <x-input-label for="alamat_polsek" :value="__('Alamat Polsek (Opsional jika admin)')" />
        <textarea name="alamat_polsek" id="alamat_polsek"
            class="block mt-1 w-full border-gray-300 rounded-md shadow-sm min-h-[100px] resize-none">{{ old('alamat_polsek', $user->alamat_polsek ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('alamat_polsek')" />
    </div>

    {{-- Total Pagu Anggaran --}}
    <div class="mt-4">
        <x-input-label for="pagu_total_formatted" :value="__('Set Total Pagu Anggaran (Rp)')" />
        <div class="relative">
            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
            <x-text-input id="pagu_total_formatted"
                type="text"
                class="mt-1 block w-full pl-10"
                placeholder="0"
                oninput="formatRupiah(this, 'pagu_total')" />
            <input type="hidden" name="pagu_total" id="pagu_total"
                value="{{ old('pagu_total', $user->pagu_total ?? 0) }}">
        </div>
        <small class="text-gray-500">Masukkan nilai tanpa titik/koma. Contoh: 10000000</small>
        <x-input-error class="mt-2" :messages="$errors->get('pagu_total')" />
    </div>

    {{-- Sisa Pagu Anggaran --}}
    @if(isset($user))
        <div class="mt-4 p-4 bg-blue-50 rounded-lg">
            <div class="flex justify-between items-center">
                <span class="font-medium text-gray-700">Sisa Pagu Saat Ini:</span>
                <span class="font-bold">Rp {{ number_format($user->pagu_total - $user->pengajuans()->where('status', 'Selesai')->sum('jumlah_diajukan'), 0, ',', '.') }}</span>
            </div>
            <div class="mt-2 text-sm text-gray-600">
                Catatan: Mengubah Total Pagu tidak akan mempengaruhi Sisa Pagu yang sudah digunakan.
            </div>
        </div>
    @endif

    {{-- Password --}}
    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
            autocomplete="new-password" />
        @if(isset($user))
            <small class="text-gray-500">Kosongkan jika tidak ingin mengubah password.</small>
        @endif
        <x-input-error class="mt-2" :messages="$errors->get('password')" />
    </div>

    {{-- Konfirmasi Password --}}
    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
        <x-text-input id="password_confirmation" name="password_confirmation" type="password"
            class="mt-1 w-full" autocomplete="new-password" />
        <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
    </div>
</div>

@push('scripts')
<script>
    function formatRupiah(input, fieldName) {
        let value = input.value.replace(/\D/g, '');
        if (value === '') value = '0';
        let formattedValue = new Intl.NumberFormat('id-ID').format(value);
        input.value = formattedValue;
        document.getElementById(fieldName).value = value;
    }

    document.addEventListener('DOMContentLoaded', function () {
        const initialValue = parseInt("{{ old('pagu_total', $user->pagu_total ?? 0) }}");
        if (initialValue > 0) {
            const input = document.getElementById('pagu_total_formatted');
            input.value = new Intl.NumberFormat('id-ID').format(initialValue);
        }
    });
</script>
@endpush
