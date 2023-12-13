<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile from :user', ['user' => $user]) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-box-filled>
                @foreach($user->posts as $post)
                    <x-post :$post/>
                @endforeach
            </x-box-filled>
        </div>
    </div>
</x-app-layout>
