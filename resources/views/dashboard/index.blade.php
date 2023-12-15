<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                        @foreach ($posts as $post)
                            @php /** @var \App\Models\Post $post */ @endphp

                            <div class="rounded overflow-hidden shadow-lg xl:last:hidden">
                                <div class="px-6 py-4">
                                    <div class="font-bold text-xl mb-2">{{ $post->title }}</div>
                                    <p class="text-gray-700 text-base">{{ $post->getTextAsParagraphs(1)[0] }}</p>
                                </div>
                                @if($post->tags->count())
                                    <div class="px-6 py-4">
                                        <x-tags :tags="$post->tags"></x-tags>
                                    </div>
                                @endif
                                <div class="px-6 py-4">
                                    <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Weiterlesen</a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
