@props(['type', 'heading'])

<div>
    <div @class([
        'px-4 py-3 rounded relative',
        'bg-green-100 border-green-400 text-green-700'      => 'success' === $type,
        'bg-blue-100 border-blue-400 text-blue-700'         => 'info' === $type,
        'bg-yellow-100 border-yellow-400 text-yellow-700'   => 'notice' === $type,
        'bg-red-100 border-red-400 text-red-700'            => 'error' === $type,
    ]) role="alert">
        <strong class="font-bold">{{ $heading ?? __(ucfirst($type)) }}</strong>
        <span class="block sm:inline">{!! $slot !!}</span>
    </div>

</div>
