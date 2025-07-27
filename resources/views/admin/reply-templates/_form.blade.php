<div class="space-y-6">
    <div>
        <x-input-label for="message" value="Isi Pesan Template" />
        <textarea id="message" name="message" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('message', $template->message ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('message')" />
    </div>
</div>