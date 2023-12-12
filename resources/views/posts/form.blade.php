<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create new post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-box-filled>

                <form method="POST" action="{{ route('posts.store') }}">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->user()->getKey() }}"/>

                    <!-- Title -->
                    <div>
                        <x-input-label for="title" :value="__('Title')"/>
                        <x-text-input id="title" class="block mt-1 w-full" type="text" name="title"
                                      :value="old('title')" required autofocus autocomplete="title"/>
                        <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                    </div>

                    <!-- Text -->
                    <div>
                        <x-input-label for="text" :value="__('Text')"/>
                        <x-textarea id="text" class="block mt-1 w-full" type="text" name="text"
                                    required autocomplete="text">{{ old('text') }}</x-textarea>
                        <x-input-error :messages="$errors->get('text')" class="mt-2"/>
                    </div>

                    <!-- Submit -->
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ms-4">
                            {{ __('Save') }}
                        </x-primary-button>
                    </div>
                </form>

            </x-box-filled>
        </div>
    </div>
</x-app-layout>
