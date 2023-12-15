<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Token') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Use one of this token to access the API.') }}
        </p>
    </header>

    <div class="mt-6 space-y-6">
        @if (0 === $user->tokens->count())
            <x-alert type="notice" heading="Attention!">{{ __('No token available!') }}</x-alert>
        @else
            <div class="grid gap-4 grid-cols-3">
                <div>{{ __('notice') }}</div>
                <div>{{ __('expires') }}</div>
                <div></div>
                @foreach($user->tokens as $token)
                    <div>{{ $token->name }}</div>
                    <div>{{ $token->expires_at }}</div>
                    <div class="text-right">
                        <x-button href="{{ route('profile.token.refresh', ['token' => $token]) }}" class="mr-2">refresh</x-button>
                        <x-button href="{{ route('profile.token.destroy', ['token' => $token]) }}" class="bg-red-600 hover:bg-red-800">delete</x-button>
                    </div>
                @endforeach
            </div>
        @endif
        <div class="mt-4">
            <x-button href="{{ route('profile.token.create') }}">{{ __('create new Token') }}</x-button>
        </div>
    </div>

</section>
