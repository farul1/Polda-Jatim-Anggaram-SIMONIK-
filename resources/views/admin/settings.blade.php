<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-[#4a3b2e] leading-tight">
            {{ __('Pengaturan Website') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-sm border border-gray-200 shadow-xl rounded-2xl overflow-hidden">
                <div class="p-6 sm:p-10 text-[#4a3b2e] space-y-12 animate-fade-in">

                    {{-- Flash Message --}}
                    @if(session('success'))
                        <div class="flex items-center gap-2 p-4 bg-green-100 border-l-4 border-green-600 text-green-800 rounded-md shadow-sm">
                            ✅ <span class="font-medium">{{ session('success') }}</span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="space-y-12">
                        @csrf

                        {{-- SECTION 1: UMUM --}}
                        <section class="space-y-6">
                            <h3 class="text-xl font-semibold border-b border-gray-300 pb-2 flex items-center gap-2">⚙️ <span>Pengaturan Umum</span></h3>
                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="app_name" value="Nama Website" />
                                    <x-text-input id="app_name" class="mt-1 w-full" type="text" name="app_name" :value="get_setting('app_name') ?? old('app_name')" />
                                </div>

                                <div>
                                    <x-input-label for="app_tagline" value="Tagline Website" />
                                    <x-text-input id="app_tagline" class="mt-1 w-full" type="text" name="app_tagline" :value="get_setting('app_tagline')" />
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    {{-- Logo Kiri --}}
                                    <div>
                                        <x-input-label for="logo_kiri" value="Logo Kiri" />
                                        <input type="file" name="logo_kiri" id="logo_kiri" class="mt-1 w-full file:border file:rounded-md file:px-3 file:py-2" />
                                        @if(get_setting('logo_kiri'))
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . get_setting('logo_kiri')) }}" class="h-16" alt="Logo Kiri">
                                                <label class="flex items-center mt-2 space-x-2">
                                                    <input type="checkbox" name="remove_logo_kiri" value="1" class="text-red-500">
                                                    <span class="text-sm text-red-600">Hapus logo kiri saat ini</span>
                                                </label>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Logo Kanan --}}
                                    <div>
                                        <x-input-label for="logo_kanan" value="Logo Kanan" />
                                        <input type="file" name="logo_kanan" id="logo_kanan" class="mt-1 w-full file:border file:rounded-md file:px-3 file:py-2" />
                                        @if(get_setting('logo_kanan'))
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . get_setting('logo_kanan')) }}" class="h-16" alt="Logo Kanan">
                                                <label class="flex items-center mt-2 space-x-2">
                                                    <input type="checkbox" name="remove_logo_kanan" value="1" class="text-red-500">
                                                    <span class="text-sm text-red-600">Hapus logo kanan saat ini</span>
                                                </label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </section>

                        {{-- SECTION: VIDEO WELCOME --}}
                        <section class="space-y-6">
                            <h3 class="text-xl font-semibold border-b border-gray-300 pb-2 flex items-center gap-2">🎥 <span>Video Welcome Page</span></h3>
                            <div class="space-y-4">

                                <div>
                                    <x-input-label for="welcome_video_type" value="Tipe Video" />
                                    <select id="welcome_video_type" name="welcome_video_type" class="mt-1 w-full border-gray-300 rounded-md shadow-sm">
                                        <option value="upload" @if(get_setting('welcome_video_type') == 'upload') selected @endif>Upload Video</option>
                                        <option value="embed" @if(get_setting('welcome_video_type') == 'embed') selected @endif>Embed URL</option>
                                    </select>
                                </div>

                                {{-- Upload Video --}}
                                <div id="video_upload_section" @if(get_setting('welcome_video_type') != 'upload') style="display: none;" @endif>
                                    <x-input-label for="welcome_video_file" value="Upload Video (MP4)" />
                                    <input type="file" name="welcome_video_file" id="welcome_video_file" class="mt-1 w-full file:border file:rounded-md file:px-3 file:py-2" accept="video/mp4" />
                                    @if(get_setting('welcome_video_path'))
                                        <div class="mt-2">
                                            <video controls class="mt-1 max-w-full h-auto max-h-48">
                                                <source src="{{ asset('storage/' . get_setting('welcome_video_path')) }}" type="video/mp4">
                                                Browser Anda tidak mendukung tag video.
                                            </video>
                                            <label class="flex items-center mt-2 space-x-2">
                                                <input type="checkbox" name="remove_welcome_video" value="1" class="text-red-500">
                                                <span class="text-sm text-red-600">Hapus video saat ini</span>
                                            </label>
                                        </div>
                                    @endif
                                </div>

                                {{-- Embed Video --}}
                                <div id="video_embed_section" @if(get_setting('welcome_video_type') != 'embed') style="display: none;" @endif>
                                    <x-input-label for="welcome_video_embed" value="URL Embed (YouTube, Vimeo, etc)" />
                                    <x-text-input id="welcome_video_embed" class="mt-1 w-full" type="text" name="welcome_video_embed" :value="get_setting('welcome_video_embed')" />
                                    @if(get_setting('welcome_video_embed'))
                                        <div class="mt-2">
                                            <div class="aspect-w-16 aspect-h-9">
                                                <iframe class="w-full h-48" src="{{ get_setting('welcome_video_embed') }}" frameborder="0" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                {{-- Judul & Deskripsi --}}
                                <div>
                                    <x-input-label for="welcome_video_title" value="Judul Video" />
                                    <x-text-input id="welcome_video_title" class="mt-1 w-full" type="text" name="welcome_video_title" :value="get_setting('welcome_video_title')" />
                                </div>

                                <div>
                                    <x-input-label for="welcome_video_description" value="Deskripsi Video" />
                                    <textarea id="welcome_video_description" name="welcome_video_description" rows="2" class="w-full border-gray-300 rounded-md shadow-sm">{{ get_setting('welcome_video_description') }}</textarea>
                                </div>
                            </div>
                        </section>

                        {{-- SECTION: AKSESORIS SUDUT HALAMAN --}}
<section class="space-y-6">
    <h3 class="text-xl font-semibold border-b border-gray-300 pb-2 flex items-center gap-2">🇮🇩 <span>Aksesoris Kemerdekaan</span></h3>
    <p class="text-sm text-gray-500">Upload gambar untuk ditampilkan di keempat sudut halaman Welcome.</p>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach (['kiri_atas', 'kanan_atas', 'kiri_bawah', 'kanan_bawah'] as $posisi)
            @php
                $label = [
                    'kiri_atas' => 'Kiri Atas',
                    'kanan_atas' => 'Kanan Atas',
                    'kiri_bawah' => 'Kiri Bawah',
                    'kanan_bawah' => 'Kanan Bawah',
                ][$posisi];
                $settingKey = 'aksesoris_' . $posisi;
            @endphp

            <div>
                <x-input-label for="{{ $settingKey }}" :value="'Aksesoris ' . $label" />
                <input type="file" name="{{ $settingKey }}" id="{{ $settingKey }}"
                       class="mt-1 w-full file:border file:rounded-md file:px-3 file:py-2"
                       accept="image/*" />

                @if(get_setting($settingKey))
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . get_setting($settingKey)) }}" class="h-20 border rounded" alt="Aksesoris {{ $label }}">
                        <label class="flex items-center mt-2 space-x-2">
                            <input type="checkbox" name="remove_{{ $settingKey }}" value="1" class="text-red-500">
                            <span class="text-sm text-red-600">Hapus gambar ini</span>
                        </label>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</section>


                        {{-- SECTION: FOOTER --}}
                        <section class="space-y-6">
                            <h3 class="text-xl font-semibold border-b border-gray-300 pb-2 flex items-center gap-2">📌 <span>Footer</span></h3>
                            <div class="space-y-4">
                                <div>
                                    <x-input-label for="footer_description" value="Deskripsi Singkat" />
                                    <textarea id="footer_description" name="footer_description" rows="3" class="w-full border-gray-300 rounded-md shadow-sm">{{ get_setting('footer_description') }}</textarea>
                                </div>
                                <div>
                                    <x-input-label for="footer_address" value="Alamat Lengkap" />
                                    <textarea id="footer_address" name="footer_address" rows="3" class="w-full border-gray-300 rounded-md shadow-sm">{{ get_setting('footer_address') }}</textarea>
                                </div>
                            </div>
                        </section>

                        {{-- SECTION: KONTAK --}}
                        <section class="space-y-6">
                            <h3 class="text-xl font-semibold border-b border-gray-300 pb-2 flex items-center gap-2">📞 <span>Kontak</span></h3>
                            <div class="space-y-4">
                                <x-input-label for="contact_phone" value="Telepon" />
                                <x-text-input id="contact_phone" class="mt-1 w-full" type="text" name="contact_phone" :value="get_setting('contact_phone')" />

                                <x-input-label for="contact_email" value="Email" />
                                <x-text-input id="contact_email" class="mt-1 w-full" type="email" name="contact_email" :value="get_setting('contact_email')" />

                                <x-input-label for="map_embed_code" value="Kode Embed Google Maps" />
                                <textarea id="map_embed_code" name="map_embed_code" rows="4" class="w-full font-mono text-sm border-gray-300 rounded-md shadow-sm">{{ get_setting('map_embed_code') }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Contoh dari Google Maps: Share → Embed → Copy HTML</p>
                            </div>
                        </section>

                        {{-- SECTION: SOSIAL MEDIA --}}
                        <section class="space-y-6">
                            <h3 class="text-xl font-semibold border-b border-gray-300 pb-2 flex items-center gap-2">🌐 <span>Media Sosial</span></h3>
                            <div class="space-y-4">
                                <x-input-label for="social_facebook_url" value="Facebook" />
                                <x-text-input id="social_facebook_url" class="mt-1 w-full" type="text" name="social_facebook_url" :value="get_setting('social_facebook_url')" />

                                <x-input-label for="social_instagram_url" value="Instagram" />
                                <x-text-input id="social_instagram_url" class="mt-1 w-full" type="text" name="social_instagram_url" :value="get_setting('social_instagram_url')" />

                                <x-input-label for="social_whatsapp_url" value="WhatsApp (https://wa.me/62xxx)" />
                                <x-text-input id="social_whatsapp_url" class="mt-1 w-full" type="text" name="social_whatsapp_url" :value="get_setting('social_whatsapp_url')" />
                            </div>
                        </section>

                        {{-- TOMBOL SIMPAN --}}
                        <div class="flex justify-end pt-6 border-t border-gray-300">
                            <button type="submit" class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-medium px-6 py-3 rounded-xl shadow-md transition-all duration-200">
                                💾 <span>Simpan Semua Pengaturan</span>
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.getElementById('welcome_video_type').addEventListener('change', function () {
                const type = this.value;
                document.getElementById('video_upload_section').style.display = (type === 'upload') ? 'block' : 'none';
                document.getElementById('video_embed_section').style.display = (type === 'embed') ? 'block' : 'none';
            });
        </script>
    @endpush
</x-app-layout>
