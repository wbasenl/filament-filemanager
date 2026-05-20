@use('Wbasenl\MwguerraFileManager\Enums\FileManagerIcon')
<div class="flex items-center gap-2">
    @if(!$this->isReadOnly())
        {{-- New Folder Button --}}
        <x-filament::button
            x-on:click="$dispatch('open-modal', { id: 'create-folder-modal' })"
            size="lg"
            color="gray"
            icon="heroicon-o-folder-plus"
        >
            {{ __('Nieuwe Folder')  }}
        </x-filament::button>

        {{-- Upload Button --}}
        <x-filament::button
            x-on:click="$dispatch('open-modal', { id: 'upload-files-modal' })"
            size="lg"
            color="gray"
            icon="heroicon-o-arrow-up-tray"
        >
            {{ __('Upload')  }}
        </x-filament::button>
    @endif

    @if(count($selectedItems) > 0)
        {{-- Clear Selection Button --}}
        <x-filament::button
            wire:click="clearSelection"
            size="lg"
            color="gray"
            icon="heroicon-o-x-mark"
            title="{{ __('Wis de selectie') }}"
        >
            {{ __('Resetten') }} ({{ count($selectedItems) }})
        </x-filament::button>
    @endif

    {{-- Refresh Button --}}
    <x-filament::button
        wire:click="refresh"
        size="lg"
        color="gray"
        icon="heroicon-o-arrow-path"
        title="{{ __('Herladen') }}"
    />

    {{-- View Mode Toggle --}}
    <div class="flex items-center gap-1 rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-100 dark:bg-gray-800 p-1">
        <button
            wire:click="setViewMode('grid')"
            class="p-2 rounded {{ $viewMode === 'grid' ? 'bg-white dark:bg-gray-700 shadow-sm' : '' }}"
            title="{{ __('Grid weergave') }}"
        >
            {!! FileManagerIcon::Squares2x2->render('w-4 h-4') !!}
        </button>
        <button
            wire:click="setViewMode('list')"
            class="p-2 rounded {{ $viewMode === 'list' ? 'bg-white dark:bg-gray-700 shadow-sm' : '' }}"
            title="{{ __('Lijst weergave') }}"
        >
            {!! FileManagerIcon::ListBullet->render('w-4 h-4') !!}
        </button>
    </div>
</div>
