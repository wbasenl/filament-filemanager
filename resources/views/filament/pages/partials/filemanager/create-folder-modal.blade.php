<x-filament::modal id="create-folder-modal" width="md">
    <x-slot name="heading">
        Create New Folder
    </x-slot>

    <x-slot name="description">
        Enter a name for your new folder
    </x-slot>

    <div class="space-y-4">
        <x-filament::input.wrapper>
            <x-filament::input
                type="text"
                wire:model.live="newFolderName"
                placeholder="My Videos"
                wire:keydown.enter="createFolder"
                autofocus
            />
        </x-filament::input.wrapper>
    </div>

    <x-slot name="footerActions">
        <x-filament::button
            x-on:click="$dispatch('close-modal', { id: 'create-folder-modal' })"
            color="gray"
        >
            Cancel
        </x-filament::button>
        <x-filament::button
            wire:click="createFolder"
        >
            Create Folder
        </x-filament::button>
    </x-slot>
</x-filament::modal>
