@php
    $defaultMode = filament()->getDefaultThemeMode()->value;
@endphp

<div
    x-data="{ theme: null }"
    x-init="
        $watch('theme', () => {
            $dispatch('theme-changed', theme)
        })
        theme = localStorage.getItem('theme') || @js($defaultMode)
    "
    class="flex flex-col gap-2"
>
    {{-- Title --}}
    <div>
        <p class="text-sm font-semibold text-gray-900 dark:text-white">Modo de Cor</p>
        <p class="text-xs text-gray-500 dark:text-gray-400">Alterne entre claro, escuro ou seguir o sistema.</p>
    </div>

    <div class="fi-theme-switcher">
    {{-- Light --}}
    <button
        type="button"
        aria-label="{{ __('filament-panels::layout.actions.theme_switcher.light.label') }}"
        x-on:click="theme = 'light'"
        x-bind:class="{ 'fi-active': theme === 'light' }"
        x-tooltip="{
            content: @js(__('filament-panels::layout.actions.theme_switcher.light.label')),
            theme: $store.theme,
        }"
        class="fi-theme-switcher-btn"
    >
        {{ \Filament\Support\generate_icon_html(\Filament\Support\Icons\Heroicon::Sun, alias: \Filament\View\PanelsIconAlias::THEME_SWITCHER_LIGHT_BUTTON) }}
    </button>

    {{-- Dark --}}
    <button
        type="button"
        aria-label="{{ __('filament-panels::layout.actions.theme_switcher.dark.label') }}"
        x-on:click="theme = 'dark'"
        x-bind:class="{ 'fi-active': theme === 'dark' }"
        x-tooltip="{
            content: @js(__('filament-panels::layout.actions.theme_switcher.dark.label')),
            theme: $store.theme,
        }"
        class="fi-theme-switcher-btn"
    >
        {{ \Filament\Support\generate_icon_html(\Filament\Support\Icons\Heroicon::Moon, alias: \Filament\View\PanelsIconAlias::THEME_SWITCHER_DARK_BUTTON) }}
    </button>

    {{-- System --}}
    <button
        type="button"
        aria-label="{{ __('filament-panels::layout.actions.theme_switcher.system.label') }}"
        x-on:click="theme = 'system'"
        x-bind:class="{ 'fi-active': theme === 'system' }"
        x-tooltip="{
            content: @js(__('filament-panels::layout.actions.theme_switcher.system.label')),
            theme: $store.theme,
        }"
        class="fi-theme-switcher-btn"
    >
        {{ \Filament\Support\generate_icon_html(\Filament\Support\Icons\Heroicon::ComputerDesktop, alias: \Filament\View\PanelsIconAlias::THEME_SWITCHER_SYSTEM_BUTTON) }}
    </button>
    </div>

    {{-- Dynamic description --}}
    <p class="w-full mt-2 text-xs text-gray-500 dark:text-gray-400 flex items-center gap-1.5">
        <template x-if="theme === 'light'">
            <span>☀️ <strong class="text-gray-700 dark:text-gray-300">Modo Claro</strong> — interface com fundo branco e cores vivas.</span>
        </template>
        <template x-if="theme === 'dark'">
            <span>🌙 <strong class="text-gray-700 dark:text-gray-300">Modo Escuro</strong> — interface com fundo escuro, ideal para ambientes com pouca luz.</span>
        </template>
        <template x-if="theme === 'system'">
            <span>🖥️ <strong class="text-gray-700 dark:text-gray-300">Seguir o Sistema</strong> — alterna automaticamente conforme a preferência do seu sistema operacional.</span>
        </template>
    </p>
</div>

