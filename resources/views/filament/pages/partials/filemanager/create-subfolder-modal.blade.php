<x-filament::modal id="create-subfolder-modal" width="md">
    <x-slot name="heading">
        Create Subfolder
    </x-slot>

    <x-slot name="description">
        @if($this->subfolderParent)
            Create a new folder inside "{{ $this->subfolderParent->getName() }}"
        @else
            Enter a name for your new subfolder
        @endif
    </x-slot>

    <div class="space-y-4">
        <x-filament::input.wrapper>
            <x-filament::input
                type="text"
                wire:model.live="subfolderName"
                placeholder="New Folder"
                wire:keydown.enter="createSubfolder"
                autofocus
            />
        </x-filament::input.wrapper>
    </div>

    <x-slot name="footerActions">
        <x-filament::button
            x-on:click="$dispatch('close-modal', { id: 'create-subfolder-modal' })"
            color="gray"
        >
            Cancel
        </x-filament::button>
        <x-filament::button
            wire:click="createSubfolder"
        >
            Create Subfolder
        </x-filament::button>
    </x-slot>
</x-filament::modal>

{{-- Rename Item Modal --}}
<x-filament::modal id="rename-item-modal" width="md">
    <x-slot name="heading">
        Rename Item
    </x-slot>

    <x-slot name="description">
        @if($this->itemToRename)
            Rename "{{ $this->itemToRename->getName() }}"
        @else
            Enter a new name for this item
        @endif
    </x-slot>

    <div class="space-y-4 ">
        <x-filament::input.wrapper>
            <x-filament::input
                type="text"
                wire:model.live="renameItemName"
                placeholder="New name"
                wire:keydown.enter="renameItem"
                autofocus
            />
        </x-filament::input.wrapper>
    </div>

    <x-slot name="footerActions">
        <x-filament::button
            x-on:click="$dispatch('close-modal', { id: 'rename-item-modal' })"
            color="gray"
        >
            Cancel
        </x-filament::button>
        <x-filament::button
            wire:click="renameItem"
        >
            Rename
        </x-filament::button>
    </x-slot>
</x-filament::modal>
