<x-layouts.user
    title="{{ __($feature === 'create' ? 'display.financial.create-income' : 'display.financial.update-income') }}">
    <x-layouts.user-transaction>
        <div class="flex flex-col gap-2 mb-4">
            <div class="flex justify-between items-center">
                <h1>
                    {{ __($feature === 'create' ? 'display.financial.create-income' : 'display.financial.update-income') }}
                </h1>
            </div>

            @if (Session::has('error'))
                <x-alert type="error" message="{{ Session::get('error') }}"></x-alert>
            @endif
        </div>

        <div class="card" x-data="state">
            <form action="{{ route('financial.create-income') }}" method="post">
                @csrf

                <div class="field-group">
                    <label for="source">{{ __('display.field-column.source') }}</label>
                    <input type="text" name="source" id="source" />
                    @error('source')
                        <small class="text-danger-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <div class="field-group">
                    <label for="value">{{ __('display.field-column.value') }}</label>
                    <input type="number" min="0" name="value" id="value" x-model="value"
                        @change="handleValueChange" />
                    @error('value')
                        <small class="text-danger-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex items-center gap-4">
                    <div class="field-group w-48">
                        <label for="rates">{{ __('display.field-column.rates') }}</label>
                        <div class="relative w-full">
                            <input type="number" name="rates" id="rates" class="!w-full" x-model="rates"
                                disabled />
                            <span class="w-8 h-full absolute top-0 right-0 flex items-center justify-center">%</span>
                        </div>
                    </div>

                    <div class="field-group flex-1">
                        <label for="reduction">{{ __('display.field-column.reduction') }}</label>
                        <input type="number" name="reduction" id="reduction" x-model="reduction" disabled />
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="clickable primary w-fit">
                        {{ __('display.action.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </x-layouts.user-transaction>

    <script type="text/javascript" defer>
        const state = {
            reduction: 0,
            rates: "{{ $regulation }}",
            value: 0,

            handleValueChange() {
                this.reduction = Math.ceil((Number(this.rates) / 100 * this.value) / 10) * 10;
            }
        }
    </script>
</x-layouts.user>
