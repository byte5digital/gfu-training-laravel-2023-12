@if($tags->count())
    <div class="mb-4">
        @foreach($tags as $tag)
            <x-tag>{{ $tag->name }}</x-tag>
        @endforeach
    </div>
@endif
