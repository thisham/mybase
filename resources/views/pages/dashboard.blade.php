<x-layouts.user title="{{ __('display.navigation.dashboard') }}">
    <div class="grid grid-cols-4 gap-4">
        <div class="col-span-3">
            <div>
                <div class="card flex gap-8">
                    <img src="{{ asset('/storage/default.jpg') }}"
                        class="w-28 h-28 aspect-square object-cover object-center" alt="Profile Picture" />
                    <div class="w-full flex justify-between items-center">
                        <div class="h-full py-2 flex flex-col justify-between">
                            <span class="text-item-700 text-lg">{{ __('display.dashboard.greetings') }}</span>
                            <div class="flex flex-col gap-2">
                                <span class="text-4xl font-medium">{{ Auth::user()->name }}</span>
                                <span class="text-sm font-medium">{{ Auth::user()->email }}</span>
                            </div>
                        </div>

                        <button
                            class="clickable primary w-fit text-sm">{{ __('display.dashboard.edit-profile') }}</button>
                    </div>
                </div>

                {{-- Statistic --}}
                <div class="bg-ground-50 border-t border-item-300 divide-x divide-item-300 grid grid-cols-4">
                    {{-- Current Balance --}}
                    <div class="flex flex-col gap-1 items-end py-2 px-8">
                        <span class="text-item-700 text-sm">{{ __('display.statistic.current-balance') }}</span>
                        <span class="text-item-900 text-2xl">{{ $currentBalance }}</span>
                    </div>

                    {{-- Current Billing --}}
                    <div class="flex flex-col gap-1 items-end py-2 px-8">
                        <span class="text-item-700 text-sm">{{ __('display.statistic.current-billing') }}</span>
                        <span class="text-item-900 text-2xl">{{ $currentBilling }}</span>
                    </div>

                    {{-- Loans Total --}}
                    <div class="flex flex-col gap-1 items-end py-2 px-8">
                        <span class="text-item-700 text-sm">{{ __('display.statistic.loans') }}</span>
                        <span class="text-item-900 text-2xl">{{ $currentLoans }}</span>
                    </div>

                    {{-- Predicted Billing --}}
                    <div class="flex flex-col gap-1 items-end py-2 px-8">
                        <span class="text-item-700 text-sm">{{ __('display.statistic.predicted') }}</span>
                        <span class="text-item-900 text-2xl">{{ $billingPrediction }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col items-start gap-4">
            <div class="card flex flex-col gap-4">
                <span class="text-lg font-semibold">Announcement</span>

                <div class="flex flex-col divide-y divide-item-300">
                    <div class="py-4">
                        <a href="#" class="text-base font-semibold">Inkomensdiscontovoet stijgt tot 66,66%</a>
                        <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, sed inventore
                            ratione fugit obcaecati esse nesciunt quo, quod laudantium reiciendis pariatur, beatae
                            recusandae consectetur itaque quia aspernatur dolorum porro eligendi.</p>
                    </div>

                    <div class="py-4">
                        <a href="#" class="text-base font-semibold">Inkomensdiscontovoet stijgt tot 66,66%</a>
                        <p class="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae, sed inventore
                            ratione fugit obcaecati esse nesciunt quo, quod laudantium reiciendis pariatur, beatae
                            recusandae consectetur itaque quia aspernatur dolorum porro eligendi.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.user>
