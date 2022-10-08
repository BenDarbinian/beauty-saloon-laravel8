@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-green-600 bg-[#1f2937] rounded py-3 px-5']) }}>
        {{ $status }}
    </div>
@endif
