<div class="grid grid-cols-6 gap-4">
    <div class="w-full flex flex-col">
        <a href="{{ route('financial.incomes') }}"
            class="clickable ghost @if (Route::is('financial.incomes') || Route::is('financial.create-income') || Route::is('financial.update-income')) active @endif">
            {{ __('display.financial.income') }}
        </a>
        <a href="{{ route('financial.loans') }}" class="clickable ghost @if (Route::is('financial.loans') || Route::is('financial.create-loan') || Route::is('financial.update-loan')) active @endif">
            {{ __('display.financial.loans') }}
        </a>
        <a href="{{ route('financial.budgets') }}"
            class="clickable ghost @if (Route::is('financial.budgets') || Route::is('financial.create-budget') || Route::is('financial.update-budget')) active @endif">
            {{ __('display.financial.budgets') }}
        </a>
        <a href="#" class="clickable ghost @if (Route::is('main.dashboard')) active @endif">
            {{ __('display.financial.invoices') }}
        </a>
        <a href="#" class="clickable ghost @if (Route::is('main.dashboard')) active @endif">
            {{ __('display.financial.payments') }}
        </a>
    </div>

    <div class="col-span-5">
        {{ $slot }}
    </div>
</div>
