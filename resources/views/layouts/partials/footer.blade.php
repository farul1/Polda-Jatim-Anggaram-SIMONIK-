 <footer class="bg-gray-900 text-white pt-16 pb-8 relative overflow-hidden">
            <!-- Animated background elements -->
            <div class="absolute inset-0 overflow-hidden">
                <div class="footer-grid-pattern"></div>
            </div>

            <div class="max-w-7xl mx-auto px-6 relative">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                    <!-- About Column -->
                    <div class="md:col-span-2">
                        <div class="flex items-center space-x-3 mb-4">
                            @if(get_setting('logo_kiri'))
                                <img src="{{ Storage::url(get_setting('logo_kiri')) }}" class="h-12 w-auto" alt="Logo">
                            @endif
                            @if(get_setting('logo_kanan'))
                                <img src="{{ Storage::url(get_setting('logo_kanan')) }}" class="h-12 w-auto" alt="Logo">
                            @endif
                        </div>
                         <h2 class="text-xl font-bold mb-2">{{ get_setting('app_name') ?? 'Sistem Anggaran' }}</h2>
                        <p class="text-gray-400 text-sm mb-4">{{ get_setting('app_tagline') }}</p>
                        <p class="text-gray-400 text-sm">Sistem informasi terpusat untuk mendukung efisiensi dan transparansi dalam pengelolaan anggaran di lingkungan Polda Jawa Timur.</p>
                    </div>

                    <!-- Contact Column -->
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-gray-400 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span class="text-gray-400 text-sm">{{ get_setting('footer_address') }}</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span class="text-gray-400 text-sm">{{ get_setting('contact_phone') }}</span>
                            </li>
                            <li class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span class="text-gray-400 text-sm">{{ get_setting('contact_email') }}</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Links Column -->
                    <div>
                        <h4 class="text-lg font-semibold mb-4">Tautan</h4>
                        <ul class="space-y-3">
                            <li><a href="#link-terkait" class="text-gray-400 hover:text-white text-sm transition-colors">Link Terkait</a></li>
                            <li><a href="{{ route('locator.index') }}" class="text-gray-400 hover:text-white text-sm transition-colors">Peta Situs</a></li>
                            <!-- Sosial Media -->
                            <div class="mt-6">
                                <h4 class="text-lg font-semibold mb-2">Ikuti Kami</h4>
                                <div class="flex space-x-4">
                                @if(get_setting('social_facebook_url'))
                                <a href="{{ get_setting('social_facebook_url') }}" target="_blank" class="text-gray-300 hover:text-white transition-colors duration-200" aria-label="Facebook">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"/>
                                    </svg>
                                </a>
                                @endif

                                @if(get_setting('social_instagram_url'))
                                <a href="{{ get_setting('social_instagram_url') }}" target="_blank" class="text-gray-300 hover:text-white transition-colors duration-200" aria-label="Instagram">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.012-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.08 2.52c.636-.247 1.363-.416 2.427-.465C9.53 2.013 9.884 2 12.315 2zm-1.002 6.363a4.152 4.152 0 100 8.304 4.152 4.152 0 000-8.304zm-2.034 4.152a2.118 2.118 0 114.236 0 2.118 2.118 0 01-4.236 0zM16.845 5.482a1.247 1.247 0 11-2.494 0 1.247 1.247 0 012.494 0z" clip-rule="evenodd"/>
                                    </svg>
                                </a>
                                @endif

                                @if(get_setting('social_whatsapp_url'))
                                <a href="{{ get_setting('social_whatsapp_url') }}" target="_blank" class="text-gray-300 hover:text-white transition-colors duration-200" aria-label="WhatsApp">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zM12.04 20.12c-1.48 0-2.93-.4-4.2-1.15l-.3-.18-3.12.82.83-3.04-.2-.31c-.82-1.31-1.26-2.83-1.26-4.38 0-4.54 3.7-8.24 8.24-8.24 2.2 0 4.27.86 5.82 2.42s2.42 3.62 2.42 5.82c0 4.55-3.7 8.24-8.24 8.24zm3.57-6.07c-.18-.09-1.05-.52-1.21-.58-.17-.06-.29-.09-.42.09-.12.18-.46.58-.56.69-.1.12-.2.13-.37.04-.17-.09-1.02-.38-1.94-1.2-1.2-1.07-1.42-1.58-.42-1.58.42-.32.69-.52.83-.69.09-.12.12-.2.18-.34.06-.12.03-.23-.01-.32-.04-.09-.42-1.02-.58-1.4-.16-.38-.32-.32-.44-.32h-.4c-.12 0-.3.04-.46.23-.16.18-.6.58-.6 1.42 0 .83.61 1.65.7 1.77.09.12 1.21 1.86 2.93 2.58.4.17.67.22.92.28.37.09.68.08.93-.04.29-.13.88-.36 1-.71.12-.35.12-.65.09-.71-.04-.06-.15-.09-.32-.18z"/>
                                    </svg>
                                </a>
                                @endif

                                @if(get_setting('social_youtube_url'))
                                <a href="{{ get_setting('social_youtube_url') }}" target="_blank" class="text-gray-300 hover:text-white transition-colors duration-200" aria-label="YouTube">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                    </svg>
                                </a>
                                @endif
                                </div>
                        </ul>
                    </div>
                </div>


                <!-- Copyright -->
                <div class="border-t border-gray-800 pt-8 text-center">
                    <p class="text-gray-400 text-sm">© {{ date('Y') }} {{ get_setting('app_name') ?? 'SIMONIK' }} Kepolisian Republik Indonesia. All Rights Reserved.</p>
                </div>
            </div>
        </footer>


