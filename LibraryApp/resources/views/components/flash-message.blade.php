@props(['message'])

@if ($message)
    <div {{ $attributes->merge(['class' => 'fixed bottom-4 right-4 px-4 py-2 bg-blue-500 rounded text-white flash-message opacity-0']) }}>
        {{ $message }}
    </div>
@endif
