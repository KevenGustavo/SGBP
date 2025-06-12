<x-guest-layout>
    {{-- Título principal, mais genérico --}}
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800">
            Defina sua Nova Senha
        </h2>
    </div>

    <div class="mb-6 p-4 bg-gray-100 border border-gray-200 rounded-lg text-center">
        <p class="text-sm text-gray-600">Você está definindo a senha para a conta:</p>
        <p class="font-semibold text-gray-900 break-all">{{ $request->email }}</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <x-text-input id="email" class="block mt-1 w-full" type="hidden" name="email" :value="old('email', $request->email)"
            readonly />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />


        <div>
            <x-input-label for="password" :value="__('Nova Senha')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autofocus
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Nova Senha')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button>
                {{ __('Salvar Nova Senha') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
