@php /** @var Post $post */ @endphp
<div class="mb-6">
    <h2 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white">{{ $post->title }}</h2>

    <p class="mb-2">{{ $post->getTextAsParagraphs()->first() }}</p>

    <div class="text-slate-500 mb-4">
        {{ __('created at :date o\'clock', ['date' => $post->created_at->format('d.m.Y H:i:s')]) }}
        {!! __('from <a href=":link">:user</a>', ['user' => $post->user, 'link' => $post->user->profileLink]) !!}
    </div>

    <x-tags :tags="$post->tags"/>

    <div class="mt-2 inline-flex" role="group">
        <x-button href="{{ $post->readMoreLink }}">{{ __('read more') }}</x-button>
        @auth()
            <x-button href="{{ $post->editLink }}" class="ml-2">{{ __('edit') }}</x-button>
            <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
                @csrf
                @method('DELETE')
                <x-primary-button class="bg-red-600 hover:bg-red-800 ml-2 p-5">{{ __('Delete Post') }}</x-primary-button>
            </form>
        @endauth
    </div>

</div>
