@if ($attributes['type'] === 'success')
    <div class="py-2 px-4 bg-success-200 border border-success-500">
        {{ $attributes['message'] }}
    </div>
@else
    <div class="py-2 px-4 bg-danger-200 border border-danger-500">
        {{ $attributes['message'] }}
    </div>
@endif
