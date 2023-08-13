@extends('components.layouts.user', ['title' => __('display.financial.income')])

@section('content')
    <x-layouts.user-transaction>
        <div class="flex flex-col gap-2 mb-4">
            <div class="flex justify-between items-center">
                <h1>{{ __('display.financial.income') }}</h1>
                {{-- <a href="{{ route('financial.create-income') }}" class="clickable primary h-fit w-fit text-sm">
                    {{ __('display.action.add') }}
                </a> --}}
            </div>

            @if (Session::has('success'))
                <x-alert type="success" message="{{ Session::get('success') }}"></x-alert>
            @endif

            @if (Session::has('error'))
                <x-alert type="error" message="{{ Session::get('error') }}"></x-alert>
            @endif
        </div>

        <div class="card">
            <table class="table-fixed w-full">
                <thead>
                    <tr class="border-b-2 border-item-400">
                        <th class="py-4 text-left pl-2 w-16">No.</th>
                        <th class="py-4 text-left pl-2">{{ __('display.field-column.name') }}</th>
                        <th class="py-4 text-left pl-2">{{ __('display.field-column.value') }}</th>
                        <th class="py-4 text-left pl-2">{{ __('display.field-column.tax') }}</th>
                        <th class="py-4 text-left pl-2">{{ __('display.field-column.admin') }}</th>
                        <th class="py-4 text-left pl-2">{{ __('display.field-column.subtotal') }}</th>
                        <th class="py-4 text-left pl-2">{{ __('display.field-column.billing') }}</th>
                        <th class="py-4 text-left pl-2">{{ __('display.field-column.status') }}</th>
                        <th class="py-4 text-left pl-2"></th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($budgetList as $index => $record)
                        <tr class="even:bg-item-200">
                            <td class="pl-4">{{ $index + 1 }}</td>
                            <td>{{ $record->name }}</td>
                            <td>{{ $record->value }}</td>
                            <td>{{ $record->tax }}</td>
                            <td>{{ $record->admin }}</td>
                            <td>{{ $record->subtotal }}</td>
                            <td>{{ $record->billing }}</td>
                            <td>{{ $record->finalized_at ? __('display.status.finalized') : __('display.status.floating') }}
                            </td>
                            <td>
                                {{-- <div class="flex">
                                    <a href="{{ route('financial.update-income', ['id' => $record->id]) }}"
                                        class="clickable ghost w-fit">{{ __('display.action.edit') }}</a>
                                    <a href="{{ route('financial.delete-income', ['id' => $record->id]) }}"
                                        class="clickable ghost w-fit">{{ __('display.action.remove') }}</a>
                                </div> --}}
                            </td>
                        </tr>
                    @empty
                        <tr class="even:bg-item-200">
                            <td colspan="9" class="py-4 text-center">{{ __('display.data.no-record') }}</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-layouts.user-transaction>
@endsection
