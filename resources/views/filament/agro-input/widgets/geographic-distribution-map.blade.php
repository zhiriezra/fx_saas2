<x-filament-widgets::widget>
    <x-filament::section>
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-bold">{{ $this->getHeading() }}</h3>
            </div>

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                <div class="p-4 bg-white rounded-lg shadow">
                    <div class="space-y-4">
                        @foreach($this->getData()['states'] as $index => $state)
                            <div class="flex items-center justify-between">
                                <span class="font-medium">{{ $state }}</span>
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm text-gray-500">
                                        ₦{{ number_format($this->getData()['sales'][$index], 2) }}
                                    </span>
                                    <span class="text-sm text-gray-500">
                                        {{ $this->getData()['orders'][$index] }} orders
                                    </span>
                                </div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5">
                                <div class="bg-primary-600 h-2.5 rounded-full" style="width: {{ ($this->getData()['sales'][$index] / max($this->getData()['sales'])) * 100 }}%"></div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="p-4 bg-white rounded-lg shadow">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="font-medium">Total Sales</span>
                            <span class="font-bold">₦{{ number_format(array_sum($this->getData()['sales']), 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-medium">Total Orders</span>
                            <span class="font-bold">{{ array_sum($this->getData()['orders']) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-medium">States Covered</span>
                            <span class="font-bold">{{ count($this->getData()['states']) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget> 