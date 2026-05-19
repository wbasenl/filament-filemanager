@use('Wbasenl\MwguerraFileManager\Enums\FileManagerIcon')
<nav class="flex items-center space-x-2 text-sm">
    @foreach($this->breadcrumbs as $index => $crumb)
        @if($index > 0)
            {!! FileManagerIcon::ChevronRight->render('w-4 h-4 text-gray-400') !!}
        @endif
        @if($index === count($this->breadcrumbs) - 1)
            <span class="font-medium text-gray-900 dark:text-white">{{ $crumb['name'] }}</span>
        @else
            @php
                $crumbId = $crumb['id'];
            @endphp
            <button
                x-on:click="$wire.navigateTo({{ json_encode($crumbId) }})"
                class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 transition-colors"
            >
                {{ $crumb['name'] }}
            </button>
        @endif
    @endforeach
</nav>
