<div x-data
     class="hidden"
     x-on:file-selected.window="
        const input = document.getElementById('selected_file');
        if (input) {
            const wireKey = input.getAttribute('wire:model');
            $wire.set(wireKey, $event.detail.item);
            $dispatch('close-modal', { id: 'fi-w2CV1vhztjFFNvbjHg4d-action-0' });
            $refs.submitBtn.click();
        }
    "
    >
    <button type="submit" class="display-none" x-ref="submitBtn"></button>
</div>

