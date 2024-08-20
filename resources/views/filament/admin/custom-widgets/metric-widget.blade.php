@php
    use Filament\Support\Enums\IconPosition;
    use Filament\Support\Facades\FilamentView;

    // $chartColor = $getChartColor() ?? 'gray';
    $descriptionColor = $this->getDescriptionColor() ?? 'gray';
    $descriptionIcon = $this->getDescriptionIcon();
    $descriptionIconPosition = $this->getDescriptionIconPosition();
    $tag = 'div';
    // $dataChecksum = $this->generateDataChecksum();

    $descriptionIconClasses = \Illuminate\Support\Arr::toCssClasses([
        'fi-wi-stats-overview-stat-description-icon h-5 w-5',
        match ($descriptionColor) {
            'gray' => 'text-gray-400 dark:text-gray-500',
            default => 'text-custom-500',
        },
    ]);

    $descriptionIconStyles = \Illuminate\Support\Arr::toCssStyles([
        \Filament\Support\get_color_css_variables(
            $descriptionColor,
            shades: [500],
            alias: 'widgets::stats-overview-widget.stat.description.icon',
        ) => $descriptionColor !== 'gray',
    ]);
@endphp

<{!! $tag !!}
    {{ $this->getExtraAttributeBag()->class([
        'fi-wi-stats-overview-stat relative rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10',
    ]) }}>
    <div class="grid gap-y-2">
        <div class="flex items-center justify-between gap-x-2">
            @if ($icon = $this->getIcon())
                <x-filament::icon :icon="$icon"
                    class="fi-wi-stats-overview-stat-icon h-5 w-5 text-gray-400 dark:text-gray-500" />
            @endif

            <span class="fi-wi-stats-overview-stat-label text-sm font-medium text-gray-500 dark:text-gray-400">
                {{ $this->getLabel() }}
            </span>

            @if ($filters = $this->getFilters())
                <x-filament::input.wrapper>
                    <x-filament::input.select wire:model.live='filters'>
                        @foreach ($filters as $value => $label)
                            <option value="{{ $value }}">
                                {{ $label }}
                            </option>
                        @endforeach
                    </x-filament::input.select>
                </x-filament::input.wrapper>
            @endif
        </div>

        <div class="fi-wi-stats-overview-stat-value text-3xl font-semibold tracking-tight text-gray-950 dark:text-white">
            {{ $this->getValue() }}
        </div>

        @if ($description = $this->getDescription())
            <div class="flex items-center gap-x-1">
                @if ($descriptionIcon && in_array($descriptionIconPosition, [IconPosition::Before, 'before']))
                    <x-filament::icon :icon="$descriptionIcon" :class="$descriptionIconClasses" :style="$descriptionIconStyles" />
                @endif

                <span @class([
                    'fi-wi-stats-overview-stat-description text-sm',
                    match ($descriptionColor) {
                        'gray' => 'text-gray-500 dark:text-gray-400',
                        default => 'fi-color-custom text-custom-600 dark:text-custom-400',
                    },
                    is_string($descriptionColor) ? "fi-color-{$descriptionColor}" : null,
                ]) @style([
                    \Filament\Support\get_color_css_variables($descriptionColor, shades: [400, 600], alias: 'widgets::stats-overview-widget.stat.description') => $descriptionColor !== 'gray',
                ])>
                    {{ $description }}
                </span>

                @if ($descriptionIcon && in_array($descriptionIconPosition, [IconPosition::After, 'after']))
                    <x-filament::icon :icon="$descriptionIcon" :class="$descriptionIconClasses" :style="$descriptionIconStyles" />
                @endif
            </div>
        @endif
    </div>

    {{-- @if ($chart = $getChart())
        <div x-data="{ statsOverviewStatChart: function() {} }">
            <div @if (FilamentView::hasSpaMode()) ax-load="visible"
                @else
                    ax-load @endif
                ax-load-src="{{ \Filament\Support\Facades\FilamentAsset::getAlpineComponentSrc('stats-overview/stat/chart', 'filament/widgets') }}"
                x-data="statsOverviewStatChart({
                    dataChecksum: @js($dataChecksum),
                    labels: @js(array_keys($chart)),
                    values: @js(array_values($chart)),
                })" @class([
                    'fi-wi-stats-overview-stat-chart absolute inset-x-0 bottom-0 overflow-hidden rounded-b-xl',
                    match ($chartColor) {
                        'gray' => null,
                        default => 'fi-color-custom',
                    },
                    is_string($chartColor) ? "fi-color-{$chartColor}" : null,
                ]) @style([
                    \Filament\Support\get_color_css_variables($chartColor, shades: [50, 400, 500], alias: 'widgets::stats-overview-widget.stat.chart') => $chartColor !== 'gray',
                ])>
                <canvas x-ref="canvas" class="h-6"></canvas>

                <span x-ref="backgroundColorElement" @class([
                    match ($chartColor) {
                        'gray' => 'text-gray-100 dark:text-gray-800',
                        default => 'text-custom-50 dark:text-custom-400/10',
                    },
                ])></span>

                <span x-ref="borderColorElement" @class([
                    match ($chartColor) {
                        'gray' => 'text-gray-400',
                        default => 'text-custom-500 dark:text-custom-400',
                    },
                ])></span>
            </div>
        </div>
    @endif --}}
    </{!! $tag !!}>
