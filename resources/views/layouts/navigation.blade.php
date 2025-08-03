<nav x-data="{
    open: false,
    settingsOpen: false,
    notifOpen: false,
    scrolled: false,
    lastScroll: 0,
    hideNav: false
  }"
  @scroll.window="
    scrolled = window.scrollY > 10;
    let currentScroll = window.scrollY;
    hideNav = currentScroll > lastScroll && currentScroll > 100;
    lastScroll = currentScroll;
  "
  :class="{
    'bg-blue-900/90 backdrop-blur-md shadow-xl': scrolled || open,
    'translate-y-0': !hideNav,
    '-translate-y-full': hideNav
  }"
  class="fixed w-full z-50 border-b border-blue-800/30 transition-all duration-500 ease-in-out"
  style="background: linear-gradient(135deg, rgba(12, 35, 64, 0.98) 0%, rgba(8, 28, 54, 0.95) 100%);">

  <!-- Police Header Bar with Improved Colors -->
  <div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-20 items-center">

      <!-- Left side - Police Branding -->
      <div class="flex items-center space-x-4 group">
        <a href="{{ route('dashboard') }}" class="relative">
          @if(get_setting('logo_kiri'))
            <img src="{{ Storage::url(get_setting('logo_kiri')) }}"
                 class="h-12 w-auto transform transition-all duration-500 group-hover:scale-105"
                 alt="Police Logo">
          @endif
        </a>

        <div class="min-w-0 border-l border-yellow-500/30 pl-4">
          <h1 class="font-bold text-xl text-white hidden md:block leading-tight tracking-wider">
            <span class="bg-clip-text text-transparent bg-gradient-to-r from-yellow-400 to-yellow-200">
               {{ get_setting('app_name') }}
            </span>
          </h1>
          <p class="text-xs text-gray-300 hidden md:block font-mono tracking-wider">
            {{ get_setting('app_tagline') }}
          </p>
        </div>
      </div>

      <!-- Main Navigation - Improved Color Scheme -->
      <div class="hidden lg:flex items-center space-x-1">
        @auth
          @if(Auth::user()->role == 'superadmin')
            <!-- Superadmin Menu -->
            <x-nav-link :href="route('admin.dashboard')"
                       :active="request()->routeIs('admin.dashboard*')"
                       class="police-nav-btn">
              <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none">
                <path d="M3 12L5 10M5 10L12 3L19 10M5 10V20C5 20.5523 5.44772 21 6 21H9M19 10L21 12M19 10V20C19 20.5523 18.5523 21 18 21H15M9 21C9.55228 21 10 20.5523 10 20V16C10 15.4477 10.4477 15 11 15H13C13.5523 15 14 15.4477 14 16V20C14 20.5523 14.4477 21 15 21M9 21H15"
                      stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="relative z-10">Dashboard</span>
            </x-nav-link>

            <x-nav-link :href="route('admin.users.index')"
                       :active="request()->routeIs('admin.users.*')"
                       class="police-nav-btn">
              <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none">
                <path d="M12 4.35418C12.7329 3.52375 13.8053 3 15 3C17.2091 3 19 4.79086 19 7C19 9.20914 17.2091 11 15 11C13.8053 11 12.7329 10.4762 12 9.64582M15 21H3V20C3 16.6863 5.68629 14 9 14C12.3137 14 15 16.6863 15 20V21ZM15 21H21V20C21 16.6863 18.3137 14 15 14C13.9071 14 12.8825 14.2922 12 14.8027M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7Z"
                      stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="relative z-10">Manajemen User</span>
            </x-nav-link>

            <!-- Settings Menu -->
            <div class="relative" x-data="{ settingsOpen: false }">
              <button @click="settingsOpen = !settingsOpen"
                      class="police-nav-btn px-4 py-2 rounded-lg transition-all duration-300 flex items-center"
                      :class="{ 'bg-blue-800/50 border border-blue-600/30': settingsOpen || request()->routeIs('admin.settings*') || request()->routeIs('admin.sliders.*') || request()->routeIs('admin.related-links.*') || request()->routeIs('admin.police-stations.*') || request()->routeIs('admin.homepage-sections.*') || request()->routeIs('admin.reply-templates.*') }">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none">
                  <path d="M10.3246 4.31731C10.751 2.5609 13.245 2.5609 13.6714 4.31731C13.9508 5.45193 15.2507 5.99038 16.2478 5.38285C17.7913 4.44239 19.5576 6.2087 18.6172 7.75218C18.0096 8.74925 18.5481 10.0492 19.6827 10.3286C21.4391 10.755 21.4391 13.249 19.6827 13.6754C18.5481 13.9548 18.0096 15.2548 18.6172 16.2518C19.5576 17.7953 17.7913 19.5616 16.2478 18.6212C15.2507 18.0136 13.9508 18.5521 13.6714 19.6867C13.245 21.4431 10.751 21.4431 10.3246 19.6867C10.0452 18.5521 8.74526 18.0136 7.74819 18.6212C6.2047 19.5616 4.43839 17.7953 5.37885 16.2518C5.98638 15.2548 5.44793 13.9548 4.31331 13.6754C2.5569 13.249 2.5569 10.755 4.31331 10.3286C5.44793 10.0492 5.98638 8.74925 5.37885 7.75218C4.43839 6.2087 6.2047 4.44239 7.74819 5.38285C8.74526 5.99038 10.0452 5.45193 10.3246 4.31731Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="relative z-10">Pengaturan</span>
                <svg class="ml-1 w-4 h-4 transition-transform duration-300"
                     :class="{ 'transform rotate-180': settingsOpen }"
                     viewBox="0 0 24 24" fill="none">
                  <path d="M19 9L12 16L5 9"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </button>

              <!-- Dropdown -->
              <div x-show="settingsOpen"
                   @click.away="settingsOpen = false"
                   x-transition:enter="transition ease-out duration-300"
                   x-transition:enter-start="opacity-0 scale-95"
                   x-transition:enter-end="opacity-100 scale-100"
                   x-transition:leave="transition ease-in duration-200"
                   x-transition:leave-start="opacity-100 scale-100"
                   x-transition:leave-end="opacity-0 scale-95"
                   class="origin-top-right absolute right-0 mt-2 w-64 rounded-lg shadow-xl z-50 border border-blue-800/50 bg-blue-900/95 backdrop-blur-lg">
                <div class="py-1 space-y-1">
                  <x-dropdown-link :href="route('admin.settings')"
                                  :active="request()->routeIs('admin.settings')"
                                  class="police-dropdown-item">
                    <svg class="w-5 h-5 mr-2 text-blue-300" viewBox="0 0 24 24" fill="none">
                      <path d="M11 5H6C4.89543 5 4 5.89543 4 7V18C4 19.1046 4.89543 20 6 20H17C18.1046 20 19 19.1046 19 18V13M17.5858 3.58579C18.3668 2.80474 19.6332 2.80474 20.4142 3.58579C21.1953 4.36683 21.1953 5.63316 20.4142 6.41421L13.8284 13H11V10.1716L17.5858 3.58579Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Pengaturan Website
                  </x-dropdown-link>

                  <x-dropdown-link :href="route('admin.sliders.index')"
                                  :active="request()->routeIs('admin.sliders.*')"
                                  class="police-dropdown-item">
                    <svg class="w-5 h-5 mr-2 text-blue-300" viewBox="0 0 24 24" fill="none">
                      <path d="M4 5C4 4.44772 4.44772 4 5 4H19C19.5523 4 20 4.44772 20 5V8C20 8.55228 19.5523 9 19 9H5C4.44772 9 4 8.55228 4 8V5Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M4 13C4 12.4477 4.44772 12 5 12H11C11.5523 12 12 12.4477 12 13V19C12 19.5523 11.5523 20 11 20H5C4.44772 20 4 19.5523 4 19V13Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M16 13C16 12.4477 16.4477 12 17 12H19C19.5523 12 20 12.4477 20 13V19C20 19.5523 19.5523 20 19 20H17C16.4477 20 16 19.5523 16 19V13Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Manajemen Slider
                  </x-dropdown-link>

                  <x-dropdown-link :href="route('admin.related-links.index')"
                                  :active="request()->routeIs('admin.related-links.*')"
                                  class="police-dropdown-item">
                    <svg class="w-5 h-5 mr-2 text-blue-300" viewBox="0 0 24 24" fill="none">
                      <path d="M13.8284 14.8284C12.2663 16.3905 9.73367 16.3905 8.17157 14.8284L3.17157 9.82843C1.60948 8.26633 1.60948 5.73367 3.17157 4.17157C4.73367 2.60948 7.26633 2.60948 8.82843 4.17157L13.8284 9.17157C14.3905 9.73367 14.3905 10.7678 13.8284 11.3299C13.2663 11.892 12.2322 11.892 11.6701 11.3299L6.67009 6.32992C6.08903 5.74886 5.15826 5.74886 4.5772 6.32992C3.99613 6.91098 3.99613 7.84175 4.5772 8.42281L9.5772 13.4228C10.3393 14.1849 11.6607 14.1849 12.4228 13.4228L17.4228 8.42281C18.0039 7.84175 18.0039 6.91098 17.4228 6.32992C16.8417 5.74886 15.911 5.74886 15.3299 6.32992L10.3299 11.3299C9.76777 11.892 8.73367 11.892 8.17157 11.3299C7.60948 10.7678 7.60948 9.73367 8.17157 9.17157L13.1716 4.17157C14.7337 2.60948 17.2663 2.60948 18.8284 4.17157C20.3905 5.73367 20.3905 8.26633 18.8284 9.82843L13.8284 14.8284Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Link Terkait
                  </x-dropdown-link>

                  <x-dropdown-link :href="route('admin.police-stations.index')"
                                  :active="request()->routeIs('admin.police-stations.*')"
                                  class="police-dropdown-item">
                    <svg class="w-5 h-5 mr-2 text-blue-300" viewBox="0 0 24 24" fill="none">
                      <path d="M17.6569 16.6569L13.4142 20.8995C12.6332 21.6805 11.3668 21.6805 10.5858 20.8995L6.34315 16.6569C3.78135 14.0951 3.78135 9.91342 6.34315 7.35162C8.90495 4.78981 13.0866 4.78981 15.6484 7.35162C18.2102 9.91342 18.2102 14.0951 15.6484 16.6569L15.6484 16.6569Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M15 11C15 12.6569 13.6569 14 12 14C10.3431 14 9 12.6569 9 11C9 9.34315 10.3431 8 12 8C13.6569 8 15 9.34315 15 11Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Manajemen Polsek
                  </x-dropdown-link>

                  <x-dropdown-link :href="route('admin.homepage-sections.index')"
                                  :active="request()->routeIs('admin.homepage-sections.*')"
                                  class="police-dropdown-item">
                    <svg class="w-5 h-5 mr-2 text-blue-300" viewBox="0 0 24 24" fill="none">
                      <path d="M3 12L5 10M5 10L12 3L19 10M5 10V20C5 20.5523 5.44772 21 6 21H9M19 10L21 12M19 10V20C19 20.5523 18.5523 21 18 21H15M9 21C9.55228 21 10 20.5523 10 20V16C10 15.4477 10.4477 15 11 15H13C13.5523 15 14 15.4477 14 16V20C14 20.5523 14.4477 21 15 21M9 21H15"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Pengaturan Homepage
                  </x-dropdown-link>

                  <x-dropdown-link :href="route('admin.reply-templates.index')"
                                  :active="request()->routeIs('admin.reply-templates.*')"
                                  class="police-dropdown-item">
                    <svg class="w-5 h-5 mr-2 text-blue-300" viewBox="0 0 24 24" fill="none">
                      <path d="M8 10H8.01M12 10H12.01M16 10H16.01M9 16H7C5.89543 16 5 15.1046 5 14V6C5 4.89543 5.89543 4 7 4H17C18.1046 4 19 4.89543 19 6V14C19 15.1046 18.1046 16 17 16H13L9 20V16Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Template Balasan
                  </x-dropdown-link>
                </div>
              </div>
            </div>

          @elseif(Auth::user()->role == 'polres')
            <!-- Polres Menu with Added Pengajuan Features -->
            <x-nav-link :href="route('admin.dashboard')"
                       :active="request()->routeIs('admin.dashboard*')"
                       class="police-nav-btn">
              <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none">
                <path d="M3 12L5 10M5 10L12 3L19 10M5 10V20C5 20.5523 5.44772 21 6 21H9M19 10L21 12M19 10V20C19 20.5523 18.5523 21 18 21H15M9 21C9.55228 21 10 20.5523 10 20V16C10 15.4477 10.4477 15 11 15H13C13.5523 15 14 15.4477 14 16V20C14 20.5523 14.4477 21 15 21M9 21H15"
                      stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="relative z-10">Dashboard</span>
            </x-nav-link>

            <x-nav-link :href="route('admin.users.index')"
                       :active="request()->routeIs('admin.users.*')"
                       class="police-nav-btn">
              <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none">
                <path d="M12 4.35418C12.7329 3.52375 13.8053 3 15 3C17.2091 3 19 4.79086 19 7C19 9.20914 17.2091 11 15 11C13.8053 11 12.7329 10.4762 12 9.64582M15 21H3V20C3 16.6863 5.68629 14 9 14C12.3137 14 15 16.6863 15 20V21ZM15 21H21V20C21 16.6863 18.3137 14 15 14C13.9071 14 12.8825 14.2922 12 14.8027M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7Z"
                      stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="relative z-10">Manajemen User</span>
            </x-nav-link>

            <x-nav-link :href="route('admin.police-stations.index')"
                       :active="request()->routeIs('admin.police-stations.*')"
                       class="police-nav-btn">
              <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none">
                <path d="M17.6569 16.6569L13.4142 20.8995C12.6332 21.6805 11.3668 21.6805 10.5858 20.8995L6.34315 16.6569C3.78135 14.0951 3.78135 9.91342 6.34315 7.35162C8.90495 4.78981 13.0866 4.78981 15.6484 7.35162C18.2102 9.91342 18.2102 14.0951 15.6484 16.6569L15.6484 16.6569Z"
                      stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M15 11C15 12.6569 13.6569 14 12 14C10.3431 14 9 12.6569 9 11C9 9.34315 10.3431 8 12 8C13.6569 8 15 9.34315 15 11Z"
                      stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="relative z-10">Manajemen Polsek</span>
            </x-nav-link>

            <!-- Added Pengajuan Menu for Polres -->
            <x-nav-link :href="route('admin.dashboard')"
                       :active="request()->routeIs('admin.pengajuan.*')"
                       class="police-nav-btn">
              <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none">
                <path d="M9 5H7C5.89543 5 5 5.89543 5 7V19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19V7C19 5.89543 18.1046 5 17 5H15M9 5C9 6.10457 9.89543 7 11 7H13C14.1046 7 15 6.10457 15 5M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5M12 12H15M12 16H15M9 12H9.01M9 16H9.01"
                      stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="relative z-10">Manajemen Pengajuan</span>
            </x-nav-link>

          @elseif(Auth::user()->role == 'polsek')
            <!-- Polsek Menu -->
            <x-nav-link :href="route('polsek.beranda')"
                       :active="request()->routeIs('polsek.beranda')"
                       class="police-nav-btn">
              <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none">
                <path d="M3 12L5 10M5 10L12 3L19 10M5 10V20C5 20.5523 5.44772 21 6 21H9M19 10L21 12M19 10V20C19 20.5523 18.5523 21 18 21H15M9 21C9.55228 21 10 20.5523 10 20V16C10 15.4477 10.4477 15 11 15H13C13.5523 15 14 15.4477 14 16V20C14 20.5523 14.4477 21 15 21M9 21H15"
                      stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <span class="relative z-10">Beranda</span>
            </x-nav-link>

           <x-nav-link :href="route('polsek.pengajuan.create')"
           :active="request()->routeIs('polsek.pengajuan.create')"
           class="police-nav-btn">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none">
                    <path d="M9 5H7C5.89543 5 5 5.89543 5 7V19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19V7C19 5.89543 18.1046 5 17 5H15M9 5C9 6.10457 9.89543 7 11 7H13C14.1046 7 15 6.10457 15 5M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5M12 12H15M12 16H15M9 12H9.01M9 16H9.01"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="relative z-10">Ajukan Anggaran</span>
                </x-nav-link>


             <x-nav-link :href="route('polsek.pengajuan.riwayat')"
           :active="request()->routeIs('polsek.pengajuan.riwayat')"
           class="police-nav-btn">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none">
                <path d="M12 8V12L15 15M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <span class="relative z-10">Riwayat Pengajuan</span>
            </x-nav-link>
          @endif
        @endauth
      </div>

      <!-- Right side - Police Badge and Profile -->
      <div class="hidden lg:flex items-center space-x-6">
        <div class="shrink-0 relative group">
          @if(get_setting('logo_kanan'))
            <img src="{{ Storage::url(get_setting('logo_kanan')) }}"
                 class="h-12 w-auto transform transition-all duration-500 group-hover:scale-105"
                 alt="Police Badge">
          @endif
        </div>

        @auth
          @if(Auth::user()->role === 'polsek')
            <!-- Notification System -->
            <div x-data="{ notifOpen: false }" class="relative">
              <button @click="notifOpen = !notifOpen; if(notifOpen){ axios.post('{{ route('notifications.markAsRead') }}'); }"
                      class="relative text-gray-300 hover:text-white focus:outline-none transition-all duration-300 transform hover:scale-110">
                <div class="relative">
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none">
                    <path d="M10 5C10 3.89543 10.8954 3 12 3C13.1046 3 14 3.89543 14 5C16.2091 5 18 6.79086 18 9V13.1707C18 14.1167 18.4175 15.0113 19.1213 15.5858L20 16.4142V18H4V16.4142L4.87868 15.5858C5.58254 15.0113 6 14.1167 6 13.1707V9C6 6.79086 7.79086 5 10 5Z"
                          stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M9 18V19C9 20.6569 10.3431 22 12 22C13.6569 22 15 20.6569 15 19V18"
                          stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>

                  @if(auth()->user()->unreadNotifications->count())
                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center animate-pulse">
                      {{ auth()->user()->unreadNotifications->count() }}
                    </span>
                  @endif
                </div>
              </button>

              <!-- Notification Panel -->
              <div x-show="notifOpen"
                   @click.away="notifOpen = false"
                   x-transition:enter="transition ease-out duration-300"
                   x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                   x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                   x-transition:leave="transition ease-in duration-200"
                   x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                   x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                   class="origin-top-right absolute right-0 mt-2 w-80 bg-blue-900/95 backdrop-blur-lg rounded-lg shadow-xl z-50 border border-blue-800/50">
                <div class="px-4 py-3 border-b border-blue-800/50 flex justify-between items-center">
                  <h3 class="text-sm font-semibold text-white">Notifikasi</h3>
                  <button @click="notifOpen = false" class="text-gray-400 hover:text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                  </button>
                </div>
                <div class="max-h-80 overflow-y-auto">
                  @forelse(auth()->user()->notifications->take(10) as $notification)
                    @php
                      $unread = $notification->read_at === null;
                    @endphp
                    <a href="{{ route('polsek.pengajuan.riwayat') }}"
                       class="block px-4 py-3 text-sm text-gray-300 hover:bg-blue-800/50 transition-colors duration-200 border-b border-blue-800/50 {{ $unread ? 'bg-blue-800/30' : '' }}">
                      <div class="flex items-start">
                        <div class="flex-shrink-0 mt-0.5">
                          <div class="w-2 h-2 rounded-full {{ $unread ? 'bg-blue-400 animate-pulse' : 'bg-blue-600' }}"></div>
                        </div>
                        <div class="ml-3 flex-1">
                          <p class="text-white">{{ $notification->data['message'] }}</p>
                          <p class="text-xs text-gray-400 mt-1 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ $notification->created_at->diffForHumans() }}
                          </p>
                        </div>
                      </div>
                    </a>
                  @empty
                    <div class="px-4 py-4 text-center text-sm text-gray-400">
                      <svg class="mx-auto h-8 w-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                      </svg>
                      <p class="mt-2">Tidak ada notifikasi.</p>
                    </div>
                  @endforelse
                </div>
                <div class="px-4 py-2 border-t border-blue-800/50 text-center">
                  <a href="{{ route('polsek.pengajuan.riwayat') }}" class="text-xs text-blue-300 hover:text-blue-200 font-medium">
                    Lihat Semua Notifikasi
                  </a>
                </div>
              </div>
            </div>
          @endif

          <!-- Profile Dropdown -->
          <div class="relative ml-3" x-data="{ profileOpen: false }">
            <button @click="profileOpen = !profileOpen"
                    class="flex items-center text-sm rounded-full focus:outline-none transition-all duration-300 group">
              <div class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-300 bg-blue-800/30 hover:bg-blue-800/50 hover:text-white focus:outline-none transition-all duration-300">
                <span>{{ Auth::user()->name }}</span>
                <svg class="ml-1 -mr-0.5 h-4 w-4 transition-transform duration-300"
                     :class="{ 'transform rotate-180': profileOpen }"
                     viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
              </div>
            </button>

            <div x-show="profileOpen"
                 @click.away="profileOpen = false"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="origin-top-right absolute right-0 mt-2 w-56 rounded-lg shadow-xl z-50 bg-blue-900/95 backdrop-blur-lg border border-blue-800/50">
              <div class="py-1">
                <x-dropdown-link :href="route('profile.edit')"
                                class="police-dropdown-item group">
                  <svg class="w-5 h-5 mr-2 text-blue-300 group-hover:text-white" viewBox="0 0 24 24" fill="none">
                    <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                          stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                          stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  </svg>
                  {{ __('Profile') }}
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <x-dropdown-link :href="route('logout')"
                                 onclick="event.preventDefault(); this.closest('form').submit();"
                                 class="police-dropdown-item group">
                    <svg class="w-5 h-5 mr-2 text-blue-300 group-hover:text-white" viewBox="0 0 24 24" fill="none">
                      <path d="M17 16L21 12M21 12L17 8M21 12H7M13 16V17C13 18.6569 11.6569 20 10 20H6C4.34315 20 3 18.6569 3 17V7C3 5.34315 4.34315 4 6 4H10C11.6569 4 13 5.34315 13 7V8"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    {{ __('Log Out') }}
                  </x-dropdown-link>
                </form>
              </div>
            </div>
          </div>
        @endauth
      </div>

      <!-- Mobile menu button -->
      <div class="flex items-center lg:hidden">
        <button @click="open = !open"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-blue-800/30 focus:outline-none transition-all duration-300 transform hover:scale-110">
          <span class="sr-only">Open main menu</span>
          <svg class="block h-6 w-6" :class="{ 'hidden': open, 'block': !open }" viewBox="0 0 24 24" fill="none">
            <path d="M4 6H20M4 12H20M4 18H20"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          <svg class="hidden h-6 w-6" :class="{ 'block': open, 'hidden': !open }" viewBox="0 0 24 24" fill="none">
            <path d="M6 18L18 6M6 6L18 18"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </div>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div x-show="open"
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0 -translate-y-2"
       x-transition:enter-end="opacity-100 translate-y-0"
       x-transition:leave="transition ease-in duration-200"
       x-transition:leave-start="opacity-100 translate-y-0"
       x-transition:leave-end="opacity-0 -translate-y-2"
       @click.away="open = false"
       class="lg:hidden fixed inset-0 z-40 bg-blue-900/95 backdrop-blur-sm overflow-y-auto pt-20"
       style="display: none;">

    <!-- Mobile User Profile Card -->
    <div class="px-6 py-5 mb-6 bg-blue-800/30 rounded-lg mx-4 border border-blue-700/50 shadow-lg">
      <div class="flex items-center space-x-4">
        <div class="relative">
          <div class="h-14 w-14 rounded-full bg-blue-800/40 flex items-center justify-center border-2 border-blue-600/30">
            <svg class="h-8 w-8 text-blue-300" viewBox="0 0 24 24" fill="none">
              <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
        </div>

        <div>
          <div class="text-lg font-semibold text-white">{{ Auth::user()->name }}</div>
          <div class="text-sm text-gray-300">{{ Auth::user()->email }}</div>
          <div class="mt-1">
            @if(Auth::user()->role == 'superadmin')
              <span class="px-2 py-0.5 text-xs rounded-full bg-amber-600/30 text-amber-400 border border-amber-500/30">Super Admin</span>
            @elseif(Auth::user()->role == 'polres')
              <span class="px-2 py-0.5 text-xs rounded-full bg-blue-600/30 text-blue-400 border border-blue-500/30">Admin Polres</span>
            @else
              <span class="px-2 py-0.5 text-xs rounded-full bg-green-600/30 text-green-400 border border-green-500/30">Polsek</span>
            @endif
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile Navigation Links -->
    <div class="px-4 space-y-1">
      @auth
        @if(Auth::user()->role == 'superadmin')
          <!-- Superadmin Mobile Menu -->
          <x-responsive-nav-link :href="route('admin.dashboard')"
                               :active="request()->routeIs('admin.dashboard*')"
                               class="mobile-police-nav-item">
            <svg class="w-6 h-6 mr-3 text-blue-300" viewBox="0 0 24 24" fill="none">
              <path d="M3 12L5 10M5 10L12 3L19 10M5 10V20C5 20.5523 5.44772 21 6 21H9M19 10L21 12M19 10V20C19 20.5523 18.5523 21 18 21H15M9 21C9.55228 21 10 20.5523 10 20V16C10 15.4477 10.4477 15 11 15H13C13.5523 15 14 15.4477 14 16V20C14 20.5523 14.4477 21 15 21M9 21H15"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Dashboard
          </x-responsive-nav-link>

          <x-responsive-nav-link :href="route('admin.users.index')"
                               :active="request()->routeIs('admin.users.*')"
                               class="mobile-police-nav-item">
            <svg class="w-6 h-6 mr-3 text-blue-300" viewBox="0 0 24 24" fill="none">
              <path d="M12 4.35418C12.7329 3.52375 13.8053 3 15 3C17.2091 3 19 4.79086 19 7C19 9.20914 17.2091 11 15 11C13.8053 11 12.7329 10.4762 12 9.64582M15 21H3V20C3 16.6863 5.68629 14 9 14C12.3137 14 15 16.6863 15 20V21ZM15 21H21V20C21 16.6863 18.3137 14 15 14C13.9071 14 12.8825 14.2922 12 14.8027M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7Z"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Manajemen User
          </x-responsive-nav-link>

          <!-- Mobile Settings Accordion -->
          <div x-data="{ mobileSettingsOpen: false }" class="space-y-1">
            <button @click="mobileSettingsOpen = !mobileSettingsOpen"
                    class="mobile-police-nav-item w-full flex items-center justify-between">
              <div class="flex items-center">
                <svg class="w-6 h-6 mr-3 text-blue-300" viewBox="0 0 24 24" fill="none">
                  <path d="M10.3246 4.31731C10.751 2.5609 13.245 2.5609 13.6714 4.31731C13.9508 5.45193 15.2507 5.99038 16.2478 5.38285C17.7913 4.44239 19.5576 6.2087 18.6172 7.75218C18.0096 8.74925 18.5481 10.0492 19.6827 10.3286C21.4391 10.755 21.4391 13.249 19.6827 13.6754C18.5481 13.9548 18.0096 15.2548 18.6172 16.2518C19.5576 17.7953 17.7913 19.5616 16.2478 18.6212C15.2507 18.0136 13.9508 18.5521 13.6714 19.6867C13.245 21.4431 10.751 21.4431 10.3246 19.6867C10.0452 18.5521 8.74526 18.0136 7.74819 18.6212C6.2047 19.5616 4.43839 17.7953 5.37885 16.2518C5.98638 15.2548 5.44793 13.9548 4.31331 13.6754C2.5569 13.249 2.5569 10.755 4.31331 10.3286C5.44793 10.0492 5.98638 8.74925 5.37885 7.75218C4.43839 6.2087 6.2047 4.44239 7.74819 5.38285C8.74526 5.99038 10.0452 5.45193 10.3246 4.31731Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Pengaturan
              </div>
              <svg class="w-5 h-5 text-gray-400 transition-transform duration-300"
                   :class="{ 'transform rotate-180': mobileSettingsOpen }"
                   viewBox="0 0 24 24" fill="none">
                <path d="M19 9L12 16L5 9"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
            </button>

            <div x-show="mobileSettingsOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 max-h-0"
                 x-transition:enter-end="opacity-100 max-h-96"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 max-h-96"
                 x-transition:leave-end="opacity-0 max-h-0"
                 class="pl-14 space-y-1 overflow-hidden">
              <x-responsive-nav-link :href="route('admin.settings')"
                                   :active="request()->routeIs('admin.settings')"
                                   class="mobile-police-submenu-item">
                <svg class="w-4 h-4 mr-3 text-blue-300" viewBox="0 0 24 24" fill="none">
                  <path d="M11 5H6C4.89543 5 4 5.89543 4 7V18C4 19.1046 4.89543 20 6 20H17C18.1046 20 19 19.1046 19 18V13M17.5858 3.58579C18.3668 2.80474 19.6332 2.80474 20.4142 3.58579C21.1953 4.36683 21.1953 5.63316 20.4142 6.41421L13.8284 13H11V10.1716L17.5858 3.58579Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Pengaturan Website
              </x-responsive-nav-link>

              <x-responsive-nav-link :href="route('admin.sliders.index')"
                                   :active="request()->routeIs('admin.sliders.*')"
                                   class="mobile-police-submenu-item">
                <svg class="w-4 h-4 mr-3 text-blue-300" viewBox="0 0 24 24" fill="none">
                  <path d="M4 5C4 4.44772 4.44772 4 5 4H19C19.5523 4 20 4.44772 20 5V8C20 8.55228 19.5523 9 19 9H5C4.44772 9 4 8.55228 4 8V5Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M4 13C4 12.4477 4.44772 12 5 12H11C11.5523 12 12 12.4477 12 13V19C12 19.5523 11.5523 20 11 20H5C4.44772 20 4 19.5523 4 19V13Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M16 13C16 12.4477 16.4477 12 17 12H19C19.5523 12 20 12.4477 20 13V19C20 19.5523 19.5523 20 19 20H17C16.4477 20 16 19.5523 16 19V13Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Manajemen Slider
              </x-responsive-nav-link>

              <x-responsive-nav-link :href="route('admin.related-links.index')"
                                   :active="request()->routeIs('admin.related-links.*')"
                                   class="mobile-police-submenu-item">
                <svg class="w-4 h-4 mr-3 text-blue-300" viewBox="0 0 24 24" fill="none">
                  <path d="M13.8284 14.8284C12.2663 16.3905 9.73367 16.3905 8.17157 14.8284L3.17157 9.82843C1.60948 8.26633 1.60948 5.73367 3.17157 4.17157C4.73367 2.60948 7.26633 2.60948 8.82843 4.17157L13.8284 9.17157C14.3905 9.73367 14.3905 10.7678 13.8284 11.3299C13.2663 11.892 12.2322 11.892 11.6701 11.3299L6.67009 6.32992C6.08903 5.74886 5.15826 5.74886 4.5772 6.32992C3.99613 6.91098 3.99613 7.84175 4.5772 8.42281L9.5772 13.4228C10.3393 14.1849 11.6607 14.1849 12.4228 13.4228L17.4228 8.42281C18.0039 7.84175 18.0039 6.91098 17.4228 6.32992C16.8417 5.74886 15.911 5.74886 15.3299 6.32992L10.3299 11.3299C9.76777 11.892 8.73367 11.892 8.17157 11.3299C7.60948 10.7678 7.60948 9.73367 8.17157 9.17157L13.1716 4.17157C14.7337 2.60948 17.2663 2.60948 18.8284 4.17157C20.3905 5.73367 20.3905 8.26633 18.8284 9.82843L13.8284 14.8284Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Link Terkait
              </x-responsive-nav-link>

              <x-responsive-nav-link :href="route('admin.police-stations.index')"
                                   :active="request()->routeIs('admin.police-stations.*')"
                                   class="mobile-police-submenu-item">
                <svg class="w-4 h-4 mr-3 text-blue-300" viewBox="0 0 24 24" fill="none">
                  <path d="M17.6569 16.6569L13.4142 20.8995C12.6332 21.6805 11.3668 21.6805 10.5858 20.8995L6.34315 16.6569C3.78135 14.0951 3.78135 9.91342 6.34315 7.35162C8.90495 4.78981 13.0866 4.78981 15.6484 7.35162C18.2102 9.91342 18.2102 14.0951 15.6484 16.6569L15.6484 16.6569Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M15 11C15 12.6569 13.6569 14 12 14C10.3431 14 9 12.6569 9 11C9 9.34315 10.3431 8 12 8C13.6569 8 15 9.34315 15 11Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Manajemen Polsek
              </x-responsive-nav-link>

              <x-responsive-nav-link :href="route('admin.homepage-sections.index')"
                                   :active="request()->routeIs('admin.homepage-sections.*')"
                                   class="mobile-police-submenu-item">
                <svg class="w-4 h-4 mr-3 text-blue-300" viewBox="0 0 24 24" fill="none">
                  <path d="M3 12L5 10M5 10L12 3L19 10M5 10V20C5 20.5523 5.44772 21 6 21H9M19 10L21 12M19 10V20C19 20.5523 18.5523 21 18 21H15M9 21C9.55228 21 10 20.5523 10 20V16C10 15.4477 10.4477 15 11 15H13C13.5523 15 14 15.4477 14 16V20C14 20.5523 14.4477 21 15 21M9 21H15"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Pengaturan Homepage
              </x-responsive-nav-link>

              <x-responsive-nav-link :href="route('admin.reply-templates.index')"
                                   :active="request()->routeIs('admin.reply-templates.*')"
                                   class="mobile-police-submenu-item">
                <svg class="w-4 h-4 mr-3 text-blue-300" viewBox="0 0 24 24" fill="none">
                  <path d="M8 10H8.01M12 10H12.01M16 10H16.01M9 16H7C5.89543 16 5 15.1046 5 14V6C5 4.89543 5.89543 4 7 4H17C18.1046 4 19 4.89543 19 6V14C19 15.1046 18.1046 16 17 16H13L9 20V16Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Template Balasan
              </x-responsive-nav-link>
            </div>
          </div>

        @elseif(Auth::user()->role == 'polres')
          <!-- Polres Mobile Menu with Added Pengajuan Features -->
          <x-responsive-nav-link :href="route('admin.dashboard')"
                               :active="request()->routeIs('admin.dashboard*')"
                               class="mobile-police-nav-item">
            <svg class="w-6 h-6 mr-3 text-blue-300" viewBox="0 0 24 24" fill="none">
              <path d="M3 12L5 10M5 10L12 3L19 10M5 10V20C5 20.5523 5.44772 21 6 21H9M19 10L21 12M19 10V20C19 20.5523 18.5523 21 18 21H15M9 21C9.55228 21 10 20.5523 10 20V16C10 15.4477 10.4477 15 11 15H13C13.5523 15 14 15.4477 14 16V20C14 20.5523 14.4477 21 15 21M9 21H15"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Dashboard
          </x-responsive-nav-link>

          <x-responsive-nav-link :href="route('admin.users.index')"
                               :active="request()->routeIs('admin.users.*')"
                               class="mobile-police-nav-item">
            <svg class="w-6 h-6 mr-3 text-blue-300" viewBox="0 0 24 24" fill="none">
              <path d="M12 4.35418C12.7329 3.52375 13.8053 3 15 3C17.2091 3 19 4.79086 19 7C19 9.20914 17.2091 11 15 11C13.8053 11 12.7329 10.4762 12 9.64582M15 21H3V20C3 16.6863 5.68629 14 9 14C12.3137 14 15 16.6863 15 20V21ZM15 21H21V20C21 16.6863 18.3137 14 15 14C13.9071 14 12.8825 14.2922 12 14.8027M13 7C13 9.20914 11.2091 11 9 11C6.79086 11 5 9.20914 5 7C5 4.79086 6.79086 3 9 3C11.2091 3 13 4.79086 13 7Z"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Manajemen User
          </x-responsive-nav-link>

          <x-responsive-nav-link :href="route('admin.police-stations.index')"
                               :active="request()->routeIs('admin.police-stations.*')"
                               class="mobile-police-nav-item">
            <svg class="w-6 h-6 mr-3 text-blue-300" viewBox="0 0 24 24" fill="none">
              <path d="M17.6569 16.6569L13.4142 20.8995C12.6332 21.6805 11.3668 21.6805 10.5858 20.8995L6.34315 16.6569C3.78135 14.0951 3.78135 9.91342 6.34315 7.35162C8.90495 4.78981 13.0866 4.78981 15.6484 7.35162C18.2102 9.91342 18.2102 14.0951 15.6484 16.6569L15.6484 16.6569Z"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
              <path d="M15 11C15 12.6569 13.6569 14 12 14C10.3431 14 9 12.6569 9 11C9 9.34315 10.3431 8 12 8C13.6569 8 15 9.34315 15 11Z"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Manajemen Polsek
          </x-responsive-nav-link>

          <!-- Added Pengajuan Menu for Polres -->
          <x-responsive-nav-link :href="route('admin.dashboard')"
                               :active="request()->routeIs('admin.pengajuan.*')"
                               class="mobile-police-nav-item">
            <svg class="w-6 h-6 mr-3 text-blue-300" viewBox="0 0 24 24" fill="none">
              <path d="M9 5H7C5.89543 5 5 5.89543 5 7V19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19V7C19 5.89543 18.1046 5 17 5H15M9 5C9 6.10457 9.89543 7 11 7H13C14.1046 7 15 6.10457 15 5M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5M12 12H15M12 16H15M9 12H9.01M9 16H9.01"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Manajemen Pengajuan
          </x-responsive-nav-link>

        @elseif(Auth::user()->role == 'polsek')
          <!-- Polsek Mobile Menu -->
          <x-responsive-nav-link :href="route('polsek.beranda')"
                               :active="request()->routeIs('polsek.beranda')"
                               class="mobile-police-nav-item">
            <svg class="w-6 h-6 mr-3 text-blue-300" viewBox="0 0 24 24" fill="none">
              <path d="M3 12L5 10M5 10L12 3L19 10M5 10V20C5 20.5523 5.44772 21 6 21H9M19 10L21 12M19 10V20C19 20.5523 18.5523 21 18 21H15M9 21C9.55228 21 10 20.5523 10 20V16C10 15.4477 10.4477 15 11 15H13C13.5523 15 14 15.4477 14 16V20C14 20.5523 14.4477 21 15 21M9 21H15"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Beranda
          </x-responsive-nav-link>

        <x-responsive-nav-link :href="route('polsek.pengajuan.create')"
                     :active="request()->routeIs('polsek.pengajuan.create')"
                     class="mobile-police-nav-item">
        <svg class="w-6 h-6 mr-3 text-blue-300" viewBox="0 0 24 24" fill="none">
            <path d="M9 5H7C5.89543 5 5 5.89543 5 7V19C5 20.1046 5.89543 21 7 21H17C18.1046 21 19 20.1046 19 19V7C19 5.89543 18.1046 5 17 5H15M9 5C9 6.10457 9.89543 7 11 7H13C14.1046 7 15 6.10457 15 5M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5M12 12H15M12 16H15M9 12H9.01M9 16H9.01"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Ajukan Anggaran
        </x-responsive-nav-link>

         <x-responsive-nav-link :href="route('polsek.pengajuan.riwayat')"
                     :active="request()->routeIs('polsek.pengajuan.riwayat')"
                     class="mobile-police-nav-item">
        <svg class="w-6 h-6 mr-3 text-blue-300" viewBox="0 0 24 24" fill="none">
            <path d="M12 8V12L15 15M21 12C21 16.9706 16.9706 21 12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12Z"
                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Riwayat Pengajuan
        </x-responsive-nav-link>

          @if(auth()->user()->unreadNotifications->count())
            <x-responsive-nav-link :href="route('polsek.pengajuan.riwayat')"
                                 class="mobile-police-nav-item bg-blue-800/30 border border-blue-700/50">
              <div class="relative">
                <svg class="w-6 h-6 mr-3 text-blue-300" viewBox="0 0 24 24" fill="none">
                  <path d="M10 5C10 3.89543 10.8954 3 12 3C13.1046 3 14 3.89543 14 5C16.2091 5 18 6.79086 18 9V13.1707C18 14.1167 18.4175 15.0113 19.1213 15.5858L20 16.4142V18H4V16.4142L4.87868 15.5858C5.58254 15.0113 6 14.1167 6 13.1707V9C6 6.79086 7.79086 5 10 5Z"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                  <path d="M9 18V19C9 20.6569 10.3431 22 12 22C13.6569 22 15 20.6569 15 19V18"
                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span class="absolute -top-1 left-5 w-5 h-5 bg-red-500 text-white text-xs rounded-full flex items-center justify-center animate-pulse">
                  {{ auth()->user()->unreadNotifications->count() }}
                </span>
              </div>
              Notifikasi
            </x-responsive-nav-link>
          @endif
        @endif
      @endauth
    </div>

    <!-- Mobile Footer -->
    <div class="fixed bottom-0 left-0 right-0 bg-blue-900/90 backdrop-blur-sm border-t border-blue-800/50 px-6 py-3">
      <div class="flex justify-between items-center">
        <x-responsive-nav-link :href="route('profile.edit')"
                              class="flex items-center text-sm font-medium text-gray-300 hover:text-white transition-colors duration-300">
          <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none">
            <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                  stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z"
                  stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Profile
        </x-responsive-nav-link>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center text-sm font-medium text-gray-300 hover:text-white transition-colors duration-300">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" fill="none">
              <path d="M17 16L21 12M21 12L17 8M21 12H7M13 16V17C13 18.6569 11.6569 20 10 20H6C4.34315 20 3 18.6569 3 17V7C3 5.34315 4.34315 4 6 4H10C11.6569 4 13 5.34315 13 7V8"
                    stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            Logout
          </x-responsive-nav-link>
        </form>
      </div>
    </div>
  </div>
</nav>

<style>
  /* Police Navigation Button - Redesigned */
  .police-nav-btn {
    @apply relative px-4 py-2.5 rounded-md transition-all duration-300 flex items-center;
    background: linear-gradient(135deg, rgba(12, 35, 64, 0.9) 0%, rgba(8, 28, 54, 0.9) 100%);
    border: 1px solid rgba(74, 108, 154, 0.3);
    color: #e2e8f0;
    font-weight: 500;
    text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
    box-shadow:
      0 2px 4px rgba(0, 0, 0, 0.1),
      inset 0 1px 0 rgba(255, 255, 255, 0.05);
  }

  .police-nav-btn:hover, .police-nav-btn:focus {
    background: linear-gradient(135deg, rgba(16, 42, 77, 0.9) 0%, rgba(10, 34, 64, 0.9) 100%);
    border-color: rgba(96, 165, 250, 0.4);
    color: #ffffff;
    transform: translateY(-1px);
    box-shadow:
      0 4px 6px rgba(0, 0, 0, 0.15),
      inset 0 1px 0 rgba(255, 255, 255, 0.1);
  }

  .police-nav-btn:active {
    transform: translateY(0);
  }

  .police-nav-btn svg {
    @apply transition-colors duration-300;
    color: #93c5fd;
  }

  .police-nav-btn:hover svg {
    color: #bfdbfe;
  }

  /* Active state */
  .police-nav-btn[aria-current="page"],
  .police-nav-btn.active {
    background: linear-gradient(135deg, rgba(30, 64, 175, 0.9) 0%, rgba(29, 78, 216, 0.9) 100%);
    border-color: rgba(147, 197, 253, 0.5);
    color: white;
  }

  /* Police Dropdown Item - Redesigned */
  .police-dropdown-item {
    @apply flex items-center px-4 py-2.5 text-sm transition-colors duration-200;
    color: #e2e8f0;
    border-left: 3px solid transparent;
  }

  .police-dropdown-item:hover {
    background: rgba(30, 58, 96, 0.4);
    color: white;
    border-left-color: #3b82f6;
  }

  .police-dropdown-item svg {
    color: #93c5fd;
  }

  .police-dropdown-item:hover svg {
    color: #bfdbfe;
  }

  /* Mobile Police Navigation Item - Redesigned */
  .mobile-police-nav-item {
    @apply flex items-center px-4 py-3 text-base font-medium rounded-lg transition-all duration-300;
    background: rgba(12, 35, 64, 0.7);
    border: 1px solid rgba(74, 108, 154, 0.2);
    color: #e2e8f0;
    margin-bottom: 0.5rem;
  }

  .mobile-police-nav-item:hover {
    background: rgba(16, 42, 77, 0.8);
    border-color: rgba(96, 165, 250, 0.3);
    color: white;
  }

  .mobile-police-nav-item svg {
    color: #93c5fd;
  }

  /* Mobile Police Submenu Item - Redesigned */
  .mobile-police-submenu-item {
    @apply flex items-center px-4 py-2.5 text-sm font-medium rounded-lg transition-all duration-300;
    color: #cbd5e1;
    margin-bottom: 0.25rem;
  }

  .mobile-police-submenu-item:hover {
    background: rgba(30, 58, 96, 0.3);
    color: white;
  }

  .mobile-police-submenu-item svg {
    color: #93c5fd;
  }

  /* Notification badge */
  .notification-badge {
    @apply absolute -top-1 -right-1 w-5 h-5 text-xs rounded-full flex items-center justify-center;
    background: #ef4444;
    color: white;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    animation: pulse 1.5s infinite;
  }

  @keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
  }

  .police-nav-btn {
  margin: 0 0.25rem;
}

.dropdown-transition {
  transition: opacity 0.2s ease, transform 0.2s ease;
}

.police-nav-btn[aria-current="page"] {
  position: relative;
}

.police-nav-btn[aria-current="page"]::after {
  content: '';
  position: absolute;
  bottom: -1px;
  left: 0;
  right: 0;
  height: 2px;
  background: #3b82f6;
  border-radius: 0 0 2px 2px;
}
</style>
