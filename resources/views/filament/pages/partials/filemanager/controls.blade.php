@use('Wbasenl\MwguerraFileManager\Enums\FileManagerIcon')
<div class="flex items-center gap-2">
    @if(!$this->isReadOnly())
        {{-- New Folder Button --}}
        <x-filament::button
            x-on:click="$dispatch('open-modal', { id: 'create-folder-modal' })"
            size="sm"
            icon="heroicon-o-folder-plus"
        >
            New Folder
        </x-filament::button>

        {{-- Upload Button --}}
        <x-filament::button
            x-on:click="$dispatch('open-modal', { id: 'upload-files-modal' })"
            size="sm"
            icon="heroicon-o-arrow-up-tray"
        >
            Upload
        </x-filament::button>
    @endif

    @if(count($selectedItems) > 0)
        {{-- Clear Selection Button --}}
        <x-filament::button
            wire:click="clearSelection"
            size="sm"
            color="gray"
            icon="heroicon-o-x-mark"
            title="Clear selection"
        >
            Clear ({{ count($selectedItems) }})
        </x-filament::button>
    @endif

    {{-- Refresh Button --}}
    <x-filament::button
        wire:click="refresh"
        size="sm"
        color="gray"
        icon="heroicon-o-arrow-path"
        title="Refresh"
    />

    {{-- View Mode Toggle --}}
    <div class="flex items-center gap-1 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 p-1">
        <button
            wire:click="setViewMode('grid')"
            class="p-1.5 rounded {{ $viewMode === 'grid' ? 'bg-white dark:bg-gray-700 shadow-sm' : '' }}"
            title="Grid view"
        >
            {!! FileManagerIcon::Squares2x2->render('w-4 h-4') !!}
        </button>
        <button
            wire:click="setViewMode('list')"
            class="p-1.5 rounded {{ $viewMode === 'list' ? 'bg-white dark:bg-gray-700 shadow-sm' : '' }}"
            title="List view"
        >
            {!! FileManagerIcon::ListBullet->render('w-4 h-4') !!}
        </button>
    </div>
</div>
