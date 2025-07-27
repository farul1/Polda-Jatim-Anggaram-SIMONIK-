<section>
    <!-- Header Section -->
    <header class="mb-6">
        <h2 class="text-xl font-bold text-coklat-polisi">
            {{ __('Informasi Profil') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            {{ __('Perbarui informasi profil dan alamat email akun Anda.') }}
        </p>
    </header>

    <!-- Verification Email Form -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <!-- Main Profile Update Form -->
    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <!-- Nama dan Email -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
                <x-input-label for="name" :value="__('Nama Polsek')" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                    :value="old('name', $user->name)" required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full"
                    :value="old('email', $user->email)" required />
                <x-input-error class="mt-2" :messages="$errors->get('email')" />
            </div>
        </div>

        <!-- Alamat -->
        <div>
            <x-input-label for="alamat_polsek" :value="__('Alamat Polsek')" />
            <textarea id="alamat_polsek" name="alamat_polsek" rows="3"
                class="mt-1 block w-full border-gray-300 focus:border-coklat-polisi focus:ring-coklat-polisi rounded-md shadow-sm transition">{{ old('alamat_polsek', $user->alamat_polsek) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('alamat_polsek')" />
        </div>

        <!-- Kota (Khusus SuperAdmin) -->
        @if(auth()->user()->isSuperAdmin() || auth()->user()->isUser())
            <div class="mt-4">
                <x-input-label for="kota" :value="__('Kota / Wilayah')" />
                <select name="kota" id="kota" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    @foreach(config('daerah.kota') as $kota)
                        <option value="{{ $kota }}" @if(old('kota', $user->kota) == $kota) selected @endif>{{ $kota }}</option>
                    @endforeach
                </select>
                <x-input-error class="mt-2" :messages="$errors->get('kota')" />
            </div>
        @endif

        <!-- Submit Button + Status -->
        <div class="flex items-center gap-4 pt-2">
            <button type="submit"
                class="px-6 py-2 bg-coklat-polisi text-white font-medium rounded-md hover:bg-black transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-coklat-polisi">
                {{ __('Simpan Perubahan') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600">
                    <svg class="h-5 w-5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ __('Perubahan disimpan.') }}
                </p>
            @endif
        </div>
    </form>
</section>
