<x-filament::dropdown placement="bottom-end" teleport>
    <x-slot name="trigger" @class([
        'ml-4' => __('filament::layout.direction') === 'ltr',
        'mr-4' => __('filament::layout.direction') === 'rtl',
    ])>
        <button type="button" @class([
            'flex h-10 items-center justify-center gap-3 rounded-lg px-3 py-2 transition',
            'hover:bg-gray-500/5 focus:bg-gray-500/5 dark:text-gray-300 dark:hover:bg-gray-700',
        ])>
            <x-heroicon-m-globe-americas class="w-5 h-5" />
            @unless (config('filament-maintenance.tiny_toggle'))
                <span>
                    {{ \Illuminate\Support\Str::of(app()->getLocale())->length() > 2
                        ? \Illuminate\Support\Str::of(app()->getLocale())->substr(0, 2)->upper()
                        : \Illuminate\Support\Str::of(app()->getLocale())->upper() }}
                </span>
                @endif
            </button>
        </x-slot>
        <x-filament::dropdown.list class="">
            @foreach ($locales as $key => $locale)
                @if (!app()->isLocale($locale))
                    <x-filament::dropdown.list.item wire:click="changeLocale('{{ $locale }}')" tag="button"
                        class="flex">
                        <span
                            class="w-6 h-6 items-center justify-center mr-4 flex-shrink-0 rtl:ml-4 @if (!app()->isLocale($locale)) group-hover:bg-white group-hover:text-primary-600 group-hover:border group-hover:border-primary-500/10 group-focus:text-white @endif bg-primary-500/10 text-primary-600 font-semibold rounded-full p-1 text-xs">
                            {{ \Illuminate\Support\Str::of($locale)->snake()->upper()->explode('_')->map(function ($string) use ($locale) {
                                    return \Illuminate\Support\Str::of($locale)->wordCount() > 1
                                        ? \Illuminate\Support\Str::substr($string, 0, 1)
                                        : \Illuminate\Support\Str::substr($string, 0, 2);
                                })->take(2)->implode('') }}
                        </span>
                        <span class="hover:bg-transparent ml-2 ">
                            {{ \Illuminate\Support\Str::title(\Symfony\Component\Intl\Locales::getName($locale)) }}
                        </span>
                    </x-filament::dropdown.list.item>
                @endif
            @endforeach
        </x-filament::dropdown.list>
    </x-filament::dropdown>
