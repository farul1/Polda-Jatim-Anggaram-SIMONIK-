<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-coklat-polisi leading-tight">
            {{ __('Edit User: ') . $user->name }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/90 backdrop-blur-sm border border-gray-200 shadow-xl rounded-2xl overflow-hidden">
                <div class="p-6 sm:p-8 space-y-6">

                    <div class="mb-6">
                        <h3 class="text-xl font-semibold text-gray-800">📝 Formulir Edit User</h3>
                        <p class="text-sm text-gray-500">Perbarui data user di bawah ini.</p>
                    </div>

                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        @include('admin.users._form', ['user' => $user])

                        <div class="flex justify-end space-x-3">
                            <a href="{{ route('admin.users.index') }}"
                               class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium text-sm px-5 py-2.5 rounded-lg transition">
                                ↩️ Batal
                            </a>
                            <button type="submit"
                                class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm px-5 py-2.5 rounded-lg shadow transition">
                                💾 Simpan Perubahan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
