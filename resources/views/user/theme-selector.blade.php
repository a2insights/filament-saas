<div x-data="{ 
    state: $wire.$entangle('{{ $getStatePath() }}'),
    showAll: false 
}" class="w-full">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <!-- Padrão -->
        <div @click="state = 'default'"
            :class="state === 'default' ? 'ring-2 ring-primary-500 border-primary-500 bg-primary-50 dark:bg-primary-500/10' : 'border-gray-200 dark:border-gray-700'"
            class="relative cursor-pointer rounded-xl border-2 p-3 transition-all hover:shadow-md">
            <div
                class="aspect-video w-full rounded-lg bg-gray-100 dark:bg-gray-800 overflow-hidden border border-gray-200 dark:border-gray-700">
                <img src="/images/themes/default.png" alt="Tema Padrão" class="h-full w-full object-cover">
            </div>
            <div class="mt-3 flex items-center justify-between">
                <span class="text-sm font-semibold text-gray-900 dark:text-white">Tema Padrão</span>
                <div x-show="state === 'default'" class="rounded-full bg-primary-500 p-1">
                    <x-heroicon-m-check class="h-3 w-3 text-white" />
                </div>
            </div>
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Interface limpa e profissional com design moderno.
            </p>
        </div>

        <!-- Neobrutalismo -->
        <div @click="state = 'neobrutalism'"
            :class="state === 'neobrutalism' ? 'ring-2 ring-primary-500 border-primary-500 bg-primary-50 dark:bg-primary-500/10' : 'border-gray-200 dark:border-gray-700'"
            class="relative cursor-pointer rounded-xl border-2 p-3 transition-all hover:shadow-md">
            <div
                class="aspect-video w-full rounded-lg bg-gray-100 dark:bg-gray-800 overflow-hidden border border-gray-200 dark:border-gray-700">
                <img src="/images/themes/neobrutalism.png" alt="Tema Neobrutalismo" class="h-full w-full object-cover">
            </div>
            <div class="mt-3 flex items-center justify-between">
                <span class="text-sm font-semibold text-gray-900 dark:text-white">Neobrutalismo</span>
                <div x-show="state === 'neobrutalism'" class="rounded-full bg-primary-500 p-1">
                    <x-heroicon-m-check class="h-3 w-3 text-white" />
                </div>
            </div>
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Estilo ousado com bordas grossas e sombras
                marcantes.</p>
        </div>

        <!-- Brisk -->
        <div @click="state = 'brisk'"
            :class="state === 'brisk' ? 'ring-2 ring-primary-500 border-primary-500 bg-primary-50 dark:bg-primary-500/10' : 'border-gray-200 dark:border-gray-700'"
            class="relative cursor-pointer rounded-xl border-2 p-3 transition-all hover:shadow-md">
            <div
                class="aspect-video w-full rounded-lg bg-gray-100 dark:bg-gray-800 overflow-hidden border border-gray-200 dark:border-gray-700">
                <img src="/images/themes/brisk.png" alt="Tema Brisk" class="h-full w-full object-cover"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div
                    class="h-full w-full hidden items-center justify-center bg-gradient-to-br from-sky-50 to-indigo-100 dark:from-sky-900/30 dark:to-indigo-900/30">
                    <div class="text-center">
                        <div class="text-2xl font-black text-sky-600 dark:text-sky-400"
                            style="font-family: 'Kumbh Sans', sans-serif;">Brisk</div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Simples & Amigável</div>
                    </div>
                </div>
            </div>
            <div class="mt-3 flex items-center justify-between">
                <span class="text-sm font-semibold text-gray-900 dark:text-white">Brisk</span>
                <div x-show="state === 'brisk'" class="rounded-full bg-primary-500 p-1">
                    <x-heroicon-m-check class="h-3 w-3 text-white" />
                </div>
            </div>
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Design simples e amigável com tipografia Kumbh
                Sans.</p>
        </div>

    </div>

    <div x-show="showAll" x-collapse x-cloak>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
            <!-- Aberdeen -->
            <div @click="state = 'aberdeen'"
                :class="state === 'aberdeen' ? 'ring-2 ring-primary-500 border-primary-500 bg-primary-50 dark:bg-primary-500/10' : 'border-gray-200 dark:border-gray-700'"
                class="relative cursor-pointer rounded-xl border-2 p-3 transition-all hover:shadow-md">
                <div
                    class="aspect-video w-full rounded-lg bg-[#0f1115] overflow-hidden border border-gray-800 flex flex-col">
                    <div class="h-1/4 w-full bg-[#1a1d23] border-b border-gray-800 flex items-center px-2 gap-1">
                        <div class="h-1.5 w-1.5 rounded-full bg-red-500"></div>
                        <div class="h-1.5 w-1.5 rounded-full bg-yellow-500"></div>
                        <div class="h-1.5 w-1.5 rounded-full bg-green-500"></div>
                    </div>
                    <div class="flex-1 p-2">
                        <div class="h-2 w-1/2 bg-amber-500 rounded-sm mb-1 opacity-50"></div>
                        <div class="h-1 w-full bg-gray-700 rounded-sm mb-1 opacity-30"></div>
                        <div class="h-1 w-full bg-gray-700 rounded-sm opacity-30"></div>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-900 dark:text-white">Aberdeen</span>
                    <div x-show="state === 'aberdeen'" class="rounded-full bg-primary-500 p-1">
                        <x-heroicon-m-check class="h-3 w-3 text-white" />
                    </div>
                </div>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Estilo premium com cantos de 4px e sombras
                    refinadas.</p>
            </div>

            <!-- Inverness -->
            <div @click="state = 'inverness'"
                :class="state === 'inverness' ? 'ring-2 ring-primary-500 border-primary-500 bg-primary-50 dark:bg-primary-500/10' : 'border-gray-200 dark:border-gray-700'"
                class="relative cursor-pointer rounded-xl border-2 p-3 transition-all hover:shadow-md">
                <div
                    class="aspect-video w-full rounded-lg bg-[#0f1115] overflow-hidden border border-gray-800 flex flex-col">
                    <div class="h-1/4 w-full bg-[#1a1d23] border-b border-gray-800 flex items-center px-2 gap-1">
                        <div class="h-1.5 w-1.5 rounded-full bg-red-500"></div>
                        <div class="h-1.5 w-1.5 rounded-full bg-yellow-500"></div>
                        <div class="h-1.5 w-1.5 rounded-full bg-green-500"></div>
                    </div>
                    <div class="flex-1 p-2">
                        <div class="h-2 w-1/2 bg-red-600 rounded-sm mb-1 opacity-50"></div>
                        <div class="h-1 w-full bg-gray-700 rounded-sm mb-1 opacity-30"></div>
                        <div class="h-1 w-full bg-gray-700 rounded-sm opacity-30"></div>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-900 dark:text-white">Inverness</span>
                    <div x-show="state === 'inverness'" class="rounded-full bg-primary-500 p-1">
                        <x-heroicon-m-check class="h-3 w-3 text-white" />
                    </div>
                </div>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Estilo moderno com acentos em vermelho Laravel
                    e design compacto.</p>
            </div>

            <!-- Edinburgh -->
            <div @click="state = 'edinburgh'"
                :class="state === 'edinburgh' ? 'ring-2 ring-primary-500 border-primary-500 bg-primary-50 dark:bg-primary-500/10' : 'border-gray-200 dark:border-gray-700'"
                class="relative cursor-pointer rounded-xl border-2 p-3 transition-all hover:shadow-md">
                <div
                    class="aspect-video w-full rounded-lg bg-[#1c1917] overflow-hidden border border-[#44403c] flex flex-col">
                    <div
                        class="h-1/4 w-full bg-[#292524] border-b border-[#44403c] flex items-center px-2 justify-between">
                        <div class="flex gap-1">
                            <div class="h-1.5 w-1.5 rounded-full bg-red-500/50"></div>
                            <div class="h-1.5 w-1.5 rounded-full bg-yellow-500/50"></div>
                            <div class="h-1.5 w-1.5 rounded-full bg-green-500/50"></div>
                        </div>
                        <div class="h-2 w-8 bg-[#a8a29e] rounded-full opacity-20"></div>
                    </div>
                    <div class="flex-1 p-2">
                        <div class="h-2 w-1/3 bg-[#d97706] rounded-sm mb-1 opacity-60"></div>
                        <div class="h-1 w-full bg-[#44403c] rounded-sm mb-1"></div>
                        <div class="h-1 w-full bg-[#44403c] rounded-sm mb-1"></div>
                        <div class="h-3 w-10 bg-[#d97706] rounded-sm mt-2 opacity-40"></div>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-900 dark:text-white">Edinburgh</span>
                    <div x-show="state === 'edinburgh'" class="rounded-full bg-primary-500 p-1">
                        <x-heroicon-m-check class="h-3 w-3 text-white" />
                    </div>
                </div>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tema majestoso com tons de pedra real e
                    detalhes em latão.</p>
            </div>

            <!-- Awin -->
            {{-- <div @click="state = 'awin'"
                :class="state === 'awin' ? 'ring-2 ring-primary-500 border-primary-500 bg-primary-50 dark:bg-primary-500/10' : 'border-gray-200 dark:border-gray-700'"
                class="relative cursor-pointer rounded-xl border-2 p-3 transition-all hover:shadow-md">
                <div
                    class="aspect-video w-full rounded-lg bg-[#f8fafc] dark:bg-[#0f172a] overflow-hidden border border-gray-200 dark:border-gray-800 flex flex-col">
                    <div
                        class="h-1/5 w-full bg-white dark:bg-[#1e293b] border-b border-gray-100 dark:border-gray-800 flex items-center px-2 justify-between">
                        <div class="h-1.5 w-8 bg-blue-500 rounded-full"></div>
                        <div class="h-3 w-3 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                    </div>
                    <div class="flex-1 p-2 flex gap-2">
                        <div
                            class="w-1/4 h-full bg-white dark:bg-[#1e293b] rounded-sm border border-gray-100 dark:border-gray-800">
                        </div>
                        <div class="flex-1 space-y-2">
                            <div class="grid grid-cols-2 gap-2">
                                <div
                                    class="h-8 bg-white dark:bg-[#1e293b] rounded-md border border-gray-100 dark:border-gray-800">
                                </div>
                                <div
                                    class="h-8 bg-white dark:bg-[#1e293b] rounded-md border border-gray-100 dark:border-gray-800">
                                </div>
                            </div>
                            <div
                                class="h-12 bg-white dark:bg-[#1e293b] rounded-md border border-gray-100 dark:border-gray-800">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 flex items-center justify-between">
                    <span class="text-sm font-semibold text-gray-900 dark:text-white">Awin</span>
                    <div x-show="state === 'awin'" class="rounded-full bg-primary-500 p-1">
                        <x-heroicon-m-check class="h-3 w-3 text-white" />
                    </div>
                </div>
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Tema moderno e responsivo com interface polida
                    e profissional.</p>
            </div> --}}
        </div>
    </div>

    <div class="mt-8 flex justify-center">
        <button type="button" @click="showAll = !showAll"
            class="group relative flex items-center gap-3 px-8 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-800 rounded-2xl shadow-sm hover:shadow-xl hover:border-primary-500 dark:hover:border-primary-400 transition-all duration-500 overflow-hidden">
            <div
                class="absolute inset-0 bg-gradient-to-r from-primary-50 to-transparent dark:from-primary-900/10 dark:to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
            </div>

            <span
                class="relative text-sm font-bold tracking-tight text-gray-700 dark:text-gray-300 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors duration-300"
                x-text="showAll ? 'Ver menos' : 'Explorar mais temas'"></span>

            <div
                class="relative flex items-center justify-center w-6 h-6 rounded-xl bg-gray-50 dark:bg-gray-800 group-hover:bg-primary-100 dark:group-hover:bg-primary-900/40 transition-all duration-500">
                <x-heroicon-m-chevron-down
                    class="h-4 w-4 text-gray-500 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-transform duration-700 ease-in-out"
                    ::class="showAll ? 'rotate-180' : ''" />
            </div>
        </button>
    </div>
</div>