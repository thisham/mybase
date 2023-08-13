@extends('components.layouts.user', ['title' => $title])

@section('content')
    <x-layouts.user-transaction>
        <div class="flex flex-col gap-2 mb-4">
            <div class="flex justify-between items-center">
                <h1>{{ $title }}</h1>
            </div>

            @if (Session::has('error'))
                <x-alert type="error" message="{{ Session::get('error') }}"></x-alert>
            @endif
        </div>

        <div class="card" x-data="state">
            <form action="{{ $action }}" method="post">
                @csrf

                <div class="field-group">
                    <label for="name">{{ __('display.field-column.name') }}</label>
                    <input type="text" name="name" id="name" value="{{ old('name') ?? ($record->name ?? '') }}"
                        required />
                    @error('name')
                        <small class="text-danger-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>


                <div class="flex items-center gap-4">
                    <div class="field-group flex-1">
                        <label for="value">{{ __('display.field-column.value') }}</label>
                        <input type="number" min="0" step="any" name="value" id="value" x-model="value"
                            @change="handleValueChange" required />
                        @error('value')
                            <small class="text-danger-500 text-sm">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="field-group flex-1">
                        <label for="tax">{{ __('display.field-column.tax') }}</label>
                        <input type="number" step="any" name="tax" id="tax" x-model="tax"
                            @change="handleValueChange" />
                    </div>

                    <div class="field-group flex-1">
                        <label for="admin">{{ __('display.field-column.admin') }}</label>
                        <input type="number" step="any" name="admin" id="admin" x-model="admin"
                            @change="handleValueChange" />
                    </div>
                </div>

                <div class="field-group flex-1">
                    <label for="subtotal">{{ __('display.field-column.subtotal') }}</label>
                    <input type="number" name="subtotal" id="subtotal" x-model="subtotal" disabled />
                </div>

                <div class="field-group flex-1">
                    <label for="billing">{{ __('display.field-column.billing') }}</label>
                    <input type="number" name="billing" id="billing" x-model="billing" disabled />
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="clickable primary w-fit">
                        {{ __('display.action.submit') }}
                    </button>
                </div>
            </form>
        </div>
    </x-layouts.user-transaction>
@endsection

@pushOnce('scripts')
    <script type="text/javascript" defer>
        const state = {
            value: {{ old('value') ?? ($record->value ?? 0) }},
            admin: {{ $record->admin ?? 0 }},
            tax: {{ $record->tax ?? 0 }},
            subtotal: {{ $record->subtotal ?? 0 }},
            billing: {{ $record->billing ?? 0 }},

            init() {
                if (this.value > 0) {
                    this.handleValueChange();
                }
            },
            countSubtotal(value) {
                return Number(this.value) + Number(this.admin) + Number(this.tax);
            },
            handleValueChange() {
                this.subtotal = this.countSubtotal(Number(this.value));
                this.billing = Math.ceil(Number(this.subtotal) / 10) * 10;
            }
        }
    </script>
@endPushOnce
