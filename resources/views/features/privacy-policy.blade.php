<div @class([
    'flex items-center justify-center min-h-screen bg-gray-100 text-gray-900 filament-breezy-auth-component filament-login-page',
    'dark:bg-gray-900 dark:text-white' => config('filament.dark_mode'),
])>
    <div class="pt-4 dark:bg-gray-900">
        <div class="flex flex-col items-center min-h-screen pt-6 sm:pt-0">
            <div class="flex justify-center w-full py-4">
                <a href="/">
                    <x-filament::brand />
                </a>
            </div>

            <div class="w-full p-6 mt-6 overflow-hidden prose bg-white shadow-md sm:max-w-2xl dark:bg-gray-800 sm:rounded-lg dark:prose-invert">
                {!! $privacyPolicy !!}
            </div>

            <x-filament::footer />
        </div>
    </div>
</div>

