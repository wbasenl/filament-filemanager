@use('Wbasenl\MwguerraFileManager\Enums\FileManagerIcon')
<main class="flex-1 overflow-y-auto bg-white dark:bg-gray-900 p-6">
    @if($this->items->isEmpty())
        {{-- Empty State --}}
        <div class="flex flex-col items-center justify-center h-full">
            {!! FileManagerIcon::FolderOpen->render('w-16 h-16 text-gray-400 dark:text-gray-500 mb-4') !!}
            <p class="text-lg text-gray-600 dark:text-gray-400">{{ __('This folder is empty') }}</p>
            <p class="text-sm text-gray-500 dark:text-gray-500">{{ __('Create a new folder or upload files to get started') }}</p>
        </div>
    @else
        {{-- Bulk Selection Management (only for non-read-only mode) --}}
        @if(!$this->isReadOnly())
            <div class="flex items-center justify-between rounded-lg border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 px-4 py-2.5 mb-4">
                <div class="flex items-center gap-3">
                    {{-- Select All / Deselect All --}}
                    @if($this->allSelected())
                        <button
                            wire:click="clearSelection"
                            class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors"
                        >
                            {!! FileManagerIcon::XMark->render('w-4 h-4') !!}
                            <span>{{ __('Deselect All') }}</span>
                        </button>
                    @else
                        <button
                            wire:click="selectAll"
                            class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors"
                        >
                            {!! FileManagerIcon::CheckCircle->render('w-4 h-4') !!}
                            <span>{{ __('Select All') }}</span>
                        </button>
                    @endif

                    {{-- Action with selected items --}}
                    @if(count($selectedItems) > 0)
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ count($selectedItems) }} {{ __('selected') }}
                        </span>

                        <div class="h-4 w-px bg-gray-300 dark:bg-gray-600"></div>

                        {{-- Move Selected --}}
                        <button
                            wire:click="openMoveDialogForSelected"
                            class="flex items-center gap-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-primary-600 dark:hover:text-primary-400 transition-colors"
                        >
                            {!! FileManagerIcon::ArrowRightCircle->render('w-4 h-4') !!}
                            <span>{{ __('Move') }}</span>
                        </button>
                    @endif
                </div>
                {{-- Delete Action, rightside --}}
                <div class="flex items-center gap-3">
                    @if(count($selectedItems) > 0)
                        {{-- Delete Selected --}}
                        <button
                            wire:click="deleteSelected"
                            wire:confirm="Are you sure you want to delete {{ count($selectedItems) }} item(s)?"
                            class="flex items-center gap-2 text-sm font-medium text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition-colors"
                        >
                            {!! FileManagerIcon::Trash->render('w-4 h-4') !!}
                            <span>{{ __('Delete') }}</span>
                        </button>
                    @endif
                </div>
            </div>
        @endif

        {{-- File Area Grid or List  --}}
        {{-- Collection $this->items --}}
        {{-- Adapter\DatabaseItem or Adapter\StorageItem $items --}}
        @if($viewMode === 'grid')
            {{-- Grid View --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4">
                @foreach($this->items as $item)
                    @include('filemanager::filament.pages.partials.file-card', ['item' => $item, 'isReadOnly' => $this->isReadOnly()])
                @endforeach
            </div>
        @else
            {{-- List View --}}
            <div class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($this->items as $item)
                    @include('filemanager::filament.pages.partials.file-list-item', ['item' => $item, 'isReadOnly' => $this->isReadOnly()])
                @endforeach
            </div>
        @endif
    @endif
</main>
