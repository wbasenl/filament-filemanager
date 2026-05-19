@use('Wbasenl\MwguerraFileManager\Enums\FileManagerIcon')
<x-filament::modal id="move-item-modal" width="md">
    <x-slot name="heading">
        @if(count($itemsToMove) > 0)
            Move {{ count($itemsToMove) }} Item(s)
        @else
            Move to Folder
        @endif
    </x-slot>

    <x-slot name="description">
        Select a destination folder
    </x-slot>

    <div class="max-h-96 overflow-y-auto rounded-md border border-gray-200 dark:border-gray-700 p-2">
        {{-- Root option --}}
        <button
            wire:click="setMoveTarget(null)"
            class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm transition-colors hover:bg-gray-100 dark:hover:bg-gray-800 {{ $moveTargetPath === null ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : '' }}"
        >
            {!! FileManagerIcon::Folder->render('w-4 h-4') !!}
            <span>Root</span>
        </button>

        {{-- Folder options --}}
        @foreach($this->allFolders as $folder)
            @php
                $folderId = $folder->getIdentifier();
                $itemBeingMoved = $this->itemToMove;
                $isCurrentFolder = $itemBeingMoved && $itemBeingMoved->getParentPath() === $folder->getPath();
                $isSameItem = $itemToMoveId === $folderId;
                $isBulkMove = count($itemsToMove) > 0;
                $isDisabled = $isBulkMove ? in_array($folderId, $itemsToMove) : ($isCurrentFolder || $isSameItem);
            @endphp
            <button
                x-on:click="$wire.setMoveTarget({{ json_encode($folderId) }})"
                @if($isDisabled) disabled @endif
                class="flex w-full items-center gap-2 rounded-md px-3 py-2 text-sm transition-colors
                    {{ $moveTargetPath === $folderId ? 'bg-primary-50 dark:bg-primary-900/20 text-primary-600' : 'hover:bg-gray-100 dark:hover:bg-gray-800' }}
                    {{ $isDisabled ? 'opacity-50 cursor-not-allowed' : '' }}"
                style="padding-left: {{ $folder->getDepth() * 16 + 12 }}px"
            >
                {!! FileManagerIcon::Folder->render('w-4 h-4') !!}
                <span>{{ $folder->getName() }}</span>
            </button>
        @endforeach
    </div>

    <x-slot name="footerActions">
        <x-filament::button
            x-on:click="$dispatch('close-modal', { id: 'move-item-modal' })"
            color="gray"
        >
            Cancel
        </x-filament::button>
        @if(count($itemsToMove) > 0)
            <x-filament::button
                wire:click="moveSelected"
            >
                Move {{ count($itemsToMove) }} Item(s)
            </x-filament::button>
        @else
            <x-filament::button
                wire:click="moveItem"
            >
                Move Here
            </x-filament::button>
        @endif
    </x-slot>
</x-filament::modal>
