@use('Wbasenl\MwguerraFileManager\Enums\FileManagerIcon')
<aside class="w-64 border-r border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 p-4 overflow-y-auto">
    <h2 class="px-2 text-lg font-semibold text-gray-900 dark:text-white mb-4">{{ $this->getSidebarHeading() }}</h2>

    {{-- Root Folder --}}
    <nav class="space-y-1">
        <div
            x-data="{ showActions: false }"
            @mouseenter="showActions = true"
            @mouseleave="showActions = false"
            class="flex w-full items-center gap-1 rounded-md px-2 py-1.5 text-sm transition-colors hover:bg-gray-200 dark:hover:bg-gray-700 {{ $currentPath === null ? 'font-medium' : '' }}"
        >
            {{-- Folder icon and name (clickable to navigate) --}}
            <button
                wire:click="navigateTo(null)"
                class="flex items-center gap-2 flex-1 min-w-0 text-left"
            >
                {!! FileManagerIcon::Folder->render('w-4 h-4 text-primary-500 shrink-0') !!}
                <span class="truncate text-gray-700 dark:text-gray-300">{{ $this->getSidebarRootLabel() }}</span>
            </button>

            {{-- Right side container for badge/actions (fixed width to prevent layout shift) --}}
            @php $rootFileCount = $this->rootFileCount; @endphp
            <div class="relative shrink-0 flex items-center justify-end" style="min-width: 72px;">
                {{-- File count badge (shown when not hovered) --}}
                @if($rootFileCount > 0)
                    <span
                        class="absolute right-0 text-xs font-medium font-mono text-primary-600 dark:text-primary-400 transition-opacity duration-100"
                        :class="showActions ? 'opacity-0 pointer-events-none' : 'opacity-100'"
                    >
                        {{ $rootFileCount }}
                    </span>
                @endif

                @if(!$this->isReadOnly())
                    {{-- Hover actions (shown when hovered) --}}
                    <div
                        class="flex items-center gap-0.5 transition-opacity duration-100"
                        :class="showActions ? 'opacity-100' : 'opacity-0 pointer-events-none'"
                    >
                        {{-- Add folder in root --}}
                        <button
                            x-on:click.stop="$dispatch('open-modal', { id: 'create-folder-modal' })"
                            class="p-1 rounded hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300"
                            title="Add folder"
                        >
                            {!! FileManagerIcon::FolderPlus->render('w-3.5 h-3.5') !!}
                        </button>
                    </div>
                @endif
            </div>
        </div>

        {{-- Folder Tree (children of Root, indented) --}}
        @include('filemanager::filament.pages.partials.folder-tree', [
            'folders' => $this->folderTree,
            'level' => 1,
            'currentPath' => $currentPath,
            'isReadOnly' => $this->isReadOnly()
        ])
    </nav>
</aside>
