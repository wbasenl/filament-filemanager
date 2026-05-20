<?php

namespace Wbasenl\MwguerraFileManager\Filament\Pages\Concerns;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Components\Utilities\Get;
use Illuminate\Support\Facades\Storage;

trait HasImageEditingActions
{
    protected function editItemAction(): Action
    {
        return Action::make('editItem')
            ->label(fn ($arguments) => $arguments['item']->isImage() ? __('Bewerken/vervangen') : __('Vervangen'))
            ->modalSubmitActionLabel(__('Opslaan'))
            ->schema([
                Hidden::make('name'),
                FileUpload::make('image')
                    ->id('image-edit')
                    ->hiddenLabel()
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatioOptions([
                        null,
                        '4:3',
                        '16:9',
                        '1:1'
                    ])
//                    ->circleCropper()
//                    ->imageAspectRatio('16:9')
//                    ->automaticallyCropImagesToAspectRatio()
//                    ->automaticallyResizeImagesMode('cover')
//                    ->imageEditorViewportWidth('1920')
//                    ->imageEditorViewportHeight('1080')
//                    ->imageEditorEmptyFillColor('#FFFFFF')
//                    ->imageAspectRatio('1:10000')
//                    ->automaticallyOpenImageEditorForAspectRatio(true)
//                    ->imageAspectRatio('16:9')
                    ->multiple(false)
                    ->disk('local')
                    ->directory(env('FILEMANAGER_UPLOAD_DIR', 'uploads'))
                    ->afterStateHydrated(function ($livewire, Get $get)  {
                         $livewire->dispatch('imageLoaded', ['name' => $get('name')]);
                    })
            ])
            ->fillForm(function (array $arguments): array {
                $item = $arguments['item'];
                return [
                    'name' => $item->name,
                    'image' => $item?->storage_path
                ];
            })
            ->extraModalFooterActions(fn (Action $action): array => [
                $action->makeModalAction('openEditor')
                    ->label(__("Edit"))
                    ->color('gray')
                    ->actionJs(<<<'JS'
                        document.querySelector('#image-edit .filepond--action-edit-item')?.click();
                    JS)
                    ->icon('heroicon-o-pencil'),
                $action->makeModalAction('replaceImage')
                    ->label(__("Vervang"))
                    ->color('gray')
                    ->actionJs(<<<'JS'
                        document.querySelector('#image-edit .filepond--action-remove-item')?.click();
                    JS)
                    ->icon('heroicon-o-x-mark'),
            ])
            ->action(fn (array $data, array $arguments) => $this->handleEditDialog($data, $arguments));
    }

    public function openEditDialog(string $itemId)
    {
        if (($item = $this->getAdapter()->getItem($itemId)) === null) {
            return;
        }

        $this->mountAction('editItem', ['item' => $item->getModel() ]);
    }

    private function handleEditDialog(array $data, array $arguments)
    {
        $item = $arguments['item'];
        if ($item === null) return;

        $folder = env('FILEMANAGER_UPLOAD_DIR', 'uploads');

        // Rename path
        if (strpos($data['image'], $item->website_id) === false) {
            $image = str_replace($folder . "/", $folder . "/" . $item->website_id . "/", $data['image']);
        }
        // Vervangen
        if (basename($item->storage_path) !== basename($data['image'])) {
            Storage::disk('local')->delete($item->storage_path);
            Storage::disk('local')->move($data['image'], $item->storage_path);
        }
        // Opslaan
        $item->update(['storage_path' =>  $item->storage_path]);
        // Thumbnail update
        $this->getAdapter()->createThumbnail($item->first());
    }
}
