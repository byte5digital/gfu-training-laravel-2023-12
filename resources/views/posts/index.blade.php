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
                    <x-post :$post/>
                @endforeach
            </x-box-filled>


            <div class="py-6">
                {{ $posts->links() }}
            </div>

        </div>

    </div>
</x-app-layout>
