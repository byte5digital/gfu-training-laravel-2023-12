@php use App\Models\Post; @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @auth
                <div class="text-right mb-6">
                    <x-button href="{{ route('posts.create') }}">{{ __('create new post') }}</x-button>
                </div>
            @endauth

            <x-box-filled>
                @foreach($posts as $post)
                    @php /** @var Post $post */ @endphp
                    <div class="mb-6">
                        <h2 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white">{{ $post->title }}</h2>

                        <p class="mb-2">{{ $post->getTextAsParagraphs()->first() }}</p>

                        <div
                            class="text-slate-500 mb-4">{{ __('created at :date o\'clock', ['date' => $post->created_at->format('d.m.Y H:i:s')]) }}</div>

                        <x-button href="{{ $post->readMoreLink }}">{{ __('read more') }}</x-button>
                        @auth()
                            <x-button href="{{ $post->editLink }}" class="ml-2">{{ __('edit') }}</x-button>
                        @endauth

                    </div>
                @endforeach
            </x-box-filled>


            <div class="py-6">
                {{ $posts->links() }}
            </div>

        </div>

    </div>
</x-app-layout>
