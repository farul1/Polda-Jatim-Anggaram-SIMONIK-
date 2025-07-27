<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-coklat-polisi leading-tight">
            {{ __('Pengaturan Akun') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Profile Card -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">

                <!-- Header Card -->
                <div class="bg-coklat-polisi px-6 py-4">
                    <h3 class="text-lg font-bold text-white">{{ __('Informasi Akun') }}</h3>
                </div>

                <!-- Sections -->
                <div class="divide-y divide-gray-200">

                    <!-- Profile Information -->
                    <div class="p-6 md:p-8">
                        <div class="flex items-start gap-6">
                            <div class="hidden md:block">
                                <div class="w-20 h-20 rounded-full bg-gray-200 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                        </div>
                    </div>

                    <!-- Password Update -->
                    <div class="p-6 md:p-8 bg-gray-50">
                        <div class="max-w-2xl mx-auto">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Delete Account -->
                    <div class="p-6 md:p-8">
                        <div class="max-w-2xl mx-auto">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
