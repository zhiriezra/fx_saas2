<x-filament-panels::page>
    @php
        $visitations = $this->getVisitations();
        $team = auth()->user()->teams->first();
    @endphp

    @if($visitations->count() > 0)
        <div x-data="{ activeTab: 'visit-1' }" class="w-full">
            {{-- Tabs Navigation --}}
            <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
                <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                    @foreach($visitations as $index => $visitation)
                        <button
                            @click="activeTab = 'visit-{{ $index + 1 }}'"
                            :class="activeTab === 'visit-{{ $index + 1 }}' 
                                ? 'border-primary-500 text-primary-600 dark:text-primary-400' 
                                : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300'"
                            class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors"
                        >
                            {{ $visitation->report_title ?: 'Visit ' . ($index + 1) }}
                        </button>
                    @endforeach
                </nav>
            </div>

            {{-- Tab Content --}}
            <div class="w-full" style="height: calc(100vh - 200px);">
                @foreach($visitations as $index => $visitation)
                    <div 
                        x-show="activeTab === 'visit-{{ $index + 1 }}'"
                        x-cloak
                        class="w-full h-full"
                    >
                        <iframe
                            title="{{ $visitation->report_title }}"
                            class="w-full h-full border-none"
                            src="{{ $visitation->report_url }}"
                            frameborder="0"
                            allowFullScreen="true">
                        </iframe>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <p>No visitations found</p>
    @endif
</x-filament-panels::page>
