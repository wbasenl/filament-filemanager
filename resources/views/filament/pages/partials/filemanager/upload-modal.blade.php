@use('Wbasenl\MwguerraFileManager\Enums\FileManagerIcon')
<x-filament::modal id="upload-files-modal" width="lg">
    <x-slot name="heading">
        Upload Files
    </x-slot>

    <x-slot name="description">
        @php
            $maxSizeMB = round(config('filemanager.upload.max_file_size', 102400) / 1024, 0);
        @endphp
        @if($this->supportsMultipleUploads())
            Select one or more files to upload (max {{ $maxSizeMB }}MB per file)
        @else
            Select a file to upload (max {{ $maxSizeMB }}MB)
        @endif
    </x-slot>

    <div class="space-y-4">
        <div
            x-data="{ isDragging: false }"
            x-on:dragover.prevent="isDragging = true"
            x-on:dragleave.prevent="isDragging = false"
            x-on:drop.prevent="isDragging = false; $refs.fileInput.files = $event.dataTransfer.files; $refs.fileInput.dispatchEvent(new Event('change'))"
            class="relative border-2 border-dashed rounded-lg p-8 text-center transition-colors"
            :class="isDragging ? 'border-primary-500 bg-primary-50 dark:bg-primary-900/20' : 'border-gray-300 dark:border-gray-600'"
        >
            <input
                type="file"
                x-ref="fileInput"
                @if($this->supportsMultipleUploads())
                    wire:model.live="uploadedFiles"
                    multiple
                @else
                    wire:model.live="uploadedFile"
                @endif
                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
            />
            <div class="space-y-2" wire:loading.remove wire:target="uploadedFiles, uploadedFile">
                {!! FileManagerIcon::CloudArrowUp->render('w-12 h-12 mx-auto text-gray-400') !!}
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    <span class="font-medium text-primary-600 dark:text-primary-400">Click to upload</span>
                    or drag and drop
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-500">
                    @if($this->supportsMultipleUploads())
                        Any file type supported
                    @else
                        Upload one file at a time (S3 temp storage limitation)
                    @endif
                </p>
            </div>
            <div class="space-y-2" wire:loading wire:target="uploadedFiles, uploadedFile">
                <div class="w-12 h-12 mx-auto border-4 border-primary-500 border-t-transparent rounded-full animate-spin"></div>
                <p class="text-sm font-medium text-primary-600 dark:text-primary-400">
                    Processing files...
                </p>
                <p class="text-xs text-gray-500 dark:text-gray-500">
                    Please wait while files are being prepared
                </p>
            </div>
        </div>

        {{-- Selected files preview --}}
        @if(count($uploadedFiles) > 0)
            <div class="space-y-2">
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300">
                    {{ count($uploadedFiles) }} file(s) ready to upload:
                </p>
                <ul class="text-sm text-gray-600 dark:text-gray-400 space-y-1 max-h-32 overflow-y-auto">
                    @foreach($uploadedFiles as $file)
                        <li class="flex items-center gap-2">
                            {!! FileManagerIcon::CheckCircle->render('w-4 h-4 shrink-0 text-success-500') !!}
                            <span class="truncate">{{ $file->getClientOriginalName() }}</span>
                            <span class="text-xs text-gray-400">({{ number_format($file->getSize() / 1024, 1) }} KB)</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <x-slot name="footerActions">
        <x-filament::button
            x-on:click="$dispatch('close-modal', { id: 'upload-files-modal' })"
            wire:click="clearUploadedFiles"
            color="gray"
        >
            Cancel
        </x-filament::button>
        <x-filament::button
            wire:click="uploadFiles"
            wire:loading.attr="disabled"
            wire:target="uploadedFiles, uploadFiles"
            :disabled="count($uploadedFiles) === 0"
        >
            <span wire:loading.remove wire:target="uploadedFiles, uploadFiles">
                @if(count($uploadedFiles) > 0)
                    Upload {{ count($uploadedFiles) }} File(s)
                @else
                    Select Files First
                @endif
            </span>
            <span wire:loading wire:target="uploadedFiles">Processing...</span>
            <span wire:loading wire:target="uploadFiles">Uploading...</span>
        </x-filament::button>
    </x-slot>
</x-filament::modal>
