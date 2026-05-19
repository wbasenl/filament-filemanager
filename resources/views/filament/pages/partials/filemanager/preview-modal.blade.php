<x-filament::modal id="preview-modal" width="5xl" :close-by-clicking-away="true">
    @if($this->previewItem)
        @php
            $previewItem = $this->previewItem;
            $fileType = $this->previewFileType;
            $previewUrl = $this->getPreviewUrl();
            $textContent = $this->getTextContent();
            $viewerComponent = $fileType?->viewerComponent();
        @endphp

        <x-slot name="heading">
            <div class="flex items-center gap-3">
                @if($fileType)
                    <x-dynamic-component
                        :component="$fileType->icon()"
                        class="w-6 h-6 {{ $fileType->iconColor() }}"
                    />
                @else
                    {!! FileManagerIcon::Document->render('w-6 h-6 text-gray-400') !!}
                @endif
                <span class="truncate">{{ $previewItem->getName() }}</span>
            </div>
        </x-slot>

        <x-slot name="description">
            <div class="flex items-center gap-4 text-sm text-gray-500">
                <span>{{ $previewItem->getPath() }}</span>
                @if($fileType)
                    <span
                        class="px-2 py-0.5 rounded bg-gray-100 dark:bg-gray-700 text-xs">{{ $fileType->label() }}</span>
                @endif
                @if($previewItem->getSize())
                    <span>{{ $previewItem->getFormattedSize() }}</span>
                @endif
                @if($previewItem->getDuration())
                    <span>{{ $previewItem->getFormattedDuration() }}</span>
                @endif
            </div>
        </x-slot>

        <div class="max-h-[70vh] overflow-auto">
            @if($viewerComponent && $previewUrl)
                {{-- Use dynamic viewer component from FileType --}}
                @if($fileType->identifier() === 'text' && $textContent !== null)
                    @include($viewerComponent, ['content' => $textContent, 'url' => $previewUrl, 'item' => $previewItem])
                @else
                    @include($viewerComponent, ['url' => $previewUrl, 'item' => $previewItem, 'fileType' => $fileType])
                @endif
            @elseif($fileType && !$fileType->canPreview())
                {{-- No Preview Available - use fallback --}}
                @include('filemanager::components.viewers.fallback', [
                    'url' => $previewUrl,
                    'item' => $previewItem,
                    'fileType' => $fileType
                ])
            @else
                {{-- Fallback for unknown types --}}
                @include('filemanager::components.viewers.fallback', [
                    'url' => $previewUrl,
                    'item' => $previewItem,
                    'fileType' => $fileType
                ])
            @endif
        </div>

        <x-slot name="footerActions">
            <div class="flex w-full justify-between">
                <div class="flex gap-2">
                    @if($previewUrl)
                        <x-filament::button
                            tag="a"
                            href="{{ $previewUrl }}"
                            target="_blank"
                            color="gray"
                            icon="heroicon-o-arrow-down-tray"
                        >
                            {{ __('Download')  }}
                        </x-filament::button>
                    @endif
                    @if(!$this->isReadOnly())
                        <x-filament::button
                            x-on:click="$wire.openMoveDialog({{ json_encode($previewItem->getIdentifier()) }})"
                            color="gray"
                            icon="heroicon-o-arrow-right-circle"
                        >
                            {{ __('Move') }}
                        </x-filament::button>
                        @if($previewItem->isImage())
                            <x-filament::button
                                x-on:click="$dispatch('close-modal', { id: 'preview-modal' });$wire.openEditDialog({{ json_encode($previewItem->getIdentifier()) }})"
                                color="gray"
                                icon="heroicon-o-photo"
                            >
                                {{ __('Edit') }}
                            </x-filament::button>
                        @endif
                        <x-filament::button
                            x-on:click="$dispatch('close-modal', { id: 'preview-modal' });$wire.openRenameDialog({{ json_encode($previewItem->getIdentifier()) }})"
                            color="gray"
                            icon="heroicon-o-pencil"
                        >
                            {{ __('Rename')  }}
                        </x-filament::button>
                    @endif
                </div>
                <x-filament::button
                    x-on:click="$dispatch('close-modal', { id: 'preview-modal' })"
                >
                    Close
                </x-filament::button>
            </div>
        </x-slot>
    @endif
</x-filament::modal>
