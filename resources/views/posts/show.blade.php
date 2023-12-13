@php
    use App\Models\Post;
    /**
     * @var Post $post
     */
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="mb-4 text-3xl font-extrabold leading-none tracking-tight text-gray-900 md:text-4xl lg:text-5xl dark:text-white">{{ $post->title }}</h2>
                    @foreach($post->getTextAsParagraphs() as $paragraph)
                        <p class="mb-2">{{ $paragraph }}</p>
                    @endforeach

                    <div class="mt-4">
                        <x-tags :tags="$post->tags"/>
                    </div>
                </div>


            </div>
        </div>
    </div>

</x-app-layout>
