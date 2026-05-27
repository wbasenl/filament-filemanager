<?php

namespace Wbasenl\MwguerraFileManager\Schemas\Components;

/**
 * Embeddable File Manager component for use in Filament schemas/forms.
 *
 * This component embeds the database-mode file manager into any Filament form or page.
 * Extends Filament's built-in Livewire component for proper component isolation.
 */
class FileSelectorEmbed extends FileManagerEmbed
{
    public bool $isSelector = true;
}
