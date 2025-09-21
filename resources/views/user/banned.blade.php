 <div class="flex flex-col items-center min-h-screen fi-simple-layout">
     <div class="flex items-center justify-center flex-grow w-full fi-simple-main-ctn">
         <main
             class="w-full px-6 py-12 my-16 bg-white shadow-sm fi-simple-main ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10 sm:max-w-lg sm:rounded-xl sm:px-12">
             <div class="flex flex-row justify-center">
                 <img class="w-56 h-56 rounded-full"
                     src="{{ \Filament\Facades\Filament::getUserAvatarUrl(\Filament\Facades\Filament::auth()->user()) }}"
                     alt="avatar">
             </div>

             <div class="flex flex-row justify-center">
                 <div class="mt-2 font-medium dark:text-white">
                     <div>{{ \Filament\Facades\Filament::auth()->user()?->name ?? '' }}</div>
                 </div>
             </div>

             <div class="mt-5 text-center">
                 <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                     Account Suspended
                 </h1>
                 <p class="text-base leading-7 text-gray-600 ">
                     Your account has been suspended @unless ($ban->expired_at)
                         indefinitely
                     @else
                         until {{ $ban->expired_at->format('Y-m-d H:i:s') }}
                     @endunless
                 </p>

                 @if ($ban->comment)
                     <p class="text-center">
                         Reason: {{ $ban->comment }}
                     </p>
                 @endif
             </div>
                 {{-- TODO: Upgrade banned package --}}

             {{-- <x-filament-panels::form wire:submit="logout">
                 {{ $this->form }}

                 <x-filament-panels::form.actions :actions="$this->getFormActions()" :full-width="$this->hasFullWidthFormActions()" />
             </x-filament-panels::form> --}}
         </main>
     </div>
 </div>
