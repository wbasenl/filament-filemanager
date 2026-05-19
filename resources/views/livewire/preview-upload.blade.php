<div>
    {{-- Huidige afbeelding tonen --}}
    <img
        x-ref="previewImage"
        x-show="loaded && !error"
        x-cloak
        src="{{ $url }}"
        alt="{{ $item?->getName() ?? 'Image preview' }}"
        class="max-w-full max-h-[65vh] object-contain rounded"
        x-on:load="loaded = true; loading = false"
        x-on:error="error = true; loading = false"
    />

    <form wire:submit="save">
        {{ $this->form }}

        <x-filament::button type="submit">
            Opslaan
        </x-filament::button>
    </form>

    {{-- VERPLICHT: renders de modal zelf --}}
    <x-filament-actions::modals />
</div>
