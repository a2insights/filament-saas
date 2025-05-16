<div @class([
    'flex items-center justify-center min-h-screen bg-gray-100 text-gray-900 filament-breezy-auth-component filament-login-page',
    'dark:bg-gray-950 dark:text-gray-100' => config('filament.dark_mode'),
])>
    <div class="w-full max-w-4xl p-4 sm:p-6 md:p-8">
        <div class="flex flex-col items-center space-y-6">
            <div class="w-full overflow-hidden bg-white shadow-lg rounded-2xl dark:bg-gray-900">
                <div class="p-6 prose max-w-none dark:prose-invert">
                    {!! $termsOfService !!}
                </div>
            </div>
        </div>
    </div>
</div>
