@use('Wbasenl\MwguerraFileManager\Enums\FileManagerIcon')
<x-filament-panels::page>
    @push('styles')
    <style>
        .fi-modal-close-overlay {
            width: 100vw !important;
        }
        html:has(.fi-modal-open) body {
            width: 100vw;
        }
    </style>
    @endpush

    <div class="flex flex-col h-[calc(100vh-12rem)] border border-gray-300 rounded-xl dark:border-none" x-data="{
        draggedItemId: null,
        isDragging: false,
    }">
        {{-- Header with Breadcrumbs and Controls --}}
        <div class="flex items-center justify-between border-b border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-6 py-4 rounded-t-xl">
            {{-- Breadcrumbs --}}
            @include('filemanager::filament.pages.partials.filemanager.breadcrumbs')

            {{-- Controls --}}
            @include('filemanager::filament.pages.partials.filemanager.controls')
        </div>

        {{-- Main Content Area --}}
        <div class="flex flex-1 overflow-hidden">
            {{-- Sidebar --}}
            @if($this->shouldShowPageSidebar())
                @include('filemanager::filament.pages.partials.filemanager.sidebar')
            @endif
            {{-- Content Area --}}
            @include('filemanager::filament.pages.partials.filemanager.content-area')
        </div>
    </div>

    {{-- Create Folder Modal --}}
    @include('filemanager::filament.pages.partials.filemanager.create-folder-modal')

    {{-- Move Item Modal --}}
    @include('filemanager::filament.pages.partials.filemanager.move-item-modal')

    {{-- Create Subfolder Modal --}}
    @include('filemanager::filament.pages.partials.filemanager.create-subfolder-modal')

    {{-- Upload Files Modal --}}
    @include('filemanager::filament.pages.partials.filemanager.upload-modal')

    {{-- Preview Modal --}}
    @include('filemanager::filament.pages.partials.filemanager.preview-modal')

    {{-- Edit Modal --}}
    @include('filemanager::filament.pages.partials.filemanager.edit-modal')
</x-filament-panels::page>
