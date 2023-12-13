@php use App\Models\Post; @endphp
@php /** @var Post $post */ @endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            @if (isset($post))
                {{ __('Edit post ":post"', ['post' => $post]) }}
            @else
                {{ __('Create new post') }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-box-filled>

                @php $action = isset($post) ? route('posts.update', ['post' => $post]) : route('posts.store') @endphp
                <form method="POST" action="{{ $action }}">
                    @csrf
                    @if (isset($post))
                        @method('PUT')
                    @else
                        <input type="hidden" name="user_id" value="{{ auth()->user()->getKey() }}"/>
                    @endif

                    <x-input-error :messages="$errors->get('user_id')" class="mt-2"/>

                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Title')"/>
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                      :value="old('title', $post->title ?? '')" required autofocus
                                      autocomplete="title"/>
                        <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                    </div>

                    <!-- Text -->
                    <div>
                        <x-input-label for="text" :value="__('Text')"/>
                        <x-textarea id="text" class="block mt-1 w-full" type="text" name="text"
                                    required autocomplete="text">{{ old('text', $post->text ?? '') }}</x-textarea>
                        <x-input-error :messages="$errors->get('text')" class="mt-2"/>
                    </div>

                    <!-- Tags -->
                    <div>
                        <x-input-label for="tags" :value="__('Tags')"/>
                        <x-text-input id="tags" class="block mt-1 w-full" type="text" name="tags"
                                      :value="old('tags', $post->tags->count() ? $post->tags->implode('name', ', ') : '')"
                                      required/>
                        <x-input-error :messages="$errors->get('tags')" class="mt-2"/>
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            @if (isset($post))
                                {{ __('Update') }}
                            @else
                                {{ __('Save') }}
                            @endif
                        </x-primary-button>
                    </div>
                </form>

            </x-box-filled>
        </div>
    </div>
</x-app-layout>
