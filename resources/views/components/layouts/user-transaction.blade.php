<div class="grid grid-cols-6 gap-4">
    <div class="w-full flex flex-col">
        <a href="{{ route('financial.incomes') }}"
            class="clickable ghost @if (Route::is('financial.incomes')) active @endif">
            {{ __('display.financial.income') }}
        </a>
        <a href="#" class="clickable ghost @if (Route::is('main.dashboard')) active @endif">
            {{ __('display.financial.loans') }}
        </a>
        <a href="#" class="clickable ghost @if (Route::is('main.dashboard')) active @endif">
            {{ __('display.financial.billings') }}
        </a>
        <a href="#" class="clickable ghost @if (Route::is('main.dashboard')) active @endif">
            {{ __('display.financial.payment') }}
        </a>
    </div>

    <div class="col-span-5">
        {{ $slot }}
    </div>
</div>
