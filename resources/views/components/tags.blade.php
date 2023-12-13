@if($tags->count())
    <div class="mb-4">
        @foreach($tags as $tag)
            <x-tag :$tag/>
        @endforeach
    </div>
@endif
