<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">Status Penyimpanan</x-slot>

        <div class="space-y-6">
            {{-- Storage Progress --}}
            <div>
                <div class="flex justify-between items-center mb-2">
                    <span class="text-sm font-semibold text-gray-700 dark:text-gray-200">Penyimpanan Digital</span>
                    <span class="text-sm font-bold text-primary-600">78%</span>
                </div>
                <div class="w-full h-2.5 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                    <div
                        class="h-full bg-primary-600 rounded-full transition-all duration-1000"
                        style="width: 78%"
                        x-data="{}"
                        x-init="setTimeout(() => $el.style.width = '78%', 300)"
                    ></div>
                </div>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5">15.6 GB dari 20 GB digunakan</p>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                <h5 class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Pengingat Penting</h5>

                <div class="space-y-3">
                    {{-- Alert: SPJ Tahunan --}}
                    <div class="flex gap-3 items-start p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl">
                        <x-heroicon-o-bell-alert class="w-5 h-5 text-red-600 dark:text-red-400 flex-shrink-0 mt-0.5" />
                        <div>
                            <p class="text-sm font-semibold text-red-800 dark:text-red-300">Laporan SPJ Tahunan</p>
                            <p class="text-xs text-red-600 dark:text-red-400 opacity-80 mt-0.5">Jatuh tempo dlm 2 hari</p>
                        </div>
                    </div>

                    {{-- Alert: Dapodik --}}
                    <div class="flex gap-3 items-start p-3 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-xl">
                        <x-heroicon-o-arrow-path class="w-5 h-5 text-amber-600 dark:text-amber-400 flex-shrink-0 mt-0.5" />
                        <div>
                            <p class="text-sm font-semibold text-amber-800 dark:text-amber-300">Sinkronisasi Dapodik</p>
                            <p class="text-xs text-amber-600 dark:text-amber-400 opacity-80 mt-0.5">Terakhir: 3 jam yang lalu</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Version Info --}}
            <div class="border-t border-gray-200 dark:border-gray-700 pt-4">
                <div class="flex items-center gap-2 mb-1">
                    <x-heroicon-o-information-circle class="w-4 h-4 text-primary-500" />
                    <span class="text-xs font-semibold text-gray-600 dark:text-gray-400">Versi Sistem</span>
                </div>
                <p class="text-xs text-gray-400 dark:text-gray-500 leading-relaxed">
                    Build 2.4.0-stable<br/>
                    © 2024 SMAN 4 Surabaya
                </p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
