<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Cadastrar Novo Usuário
        </h2>
    </x-slot>

    <x-body-page>
        <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg p-6 text-gray-900">
            <form method="POST" action="{{ route('users.store') }}" class="space-y-6 max-w-xl">
                @csrf

                <div>
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="block mt-4 border bg-gray-50 p-2 rounded-lg">
                    <label for="is_admin_toggle" class="text-sm font-bold text-gray-900">Este usuário é um
                        Administrador? </label>
                    <p class="text-xs text-gray-500 mb-2">Administradores têm permissão para cadastrar e excluir outros
                        usuários, gerenciar bens, e gerar relatórios.
                    </p>

                    <div x-data="{ isAdmin: {{ old('is_admin') ? 'true' : 'false' }} }" class="flex items-center">
                        <button type="button" id="is_admin_toggle" @click="isAdmin = !isAdmin"
                            :class="isAdmin ? 'bg-indigo-600' : 'bg-gray-400'" role="switch"
                            :aria-checked="isAdmin.toString()"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">

                            <span aria-hidden="true" :class="isAdmin ? 'translate-x-5' : 'translate-x-0'"
                                class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out">
                            </span>
                        </button>

                        <input type="checkbox" name="isAdmin" class="hidden" x-model="isAdmin" value="1">

                        <span class="ms-3 text-sm">
                            <span class="font-medium text-gray-900"
                                x-text="isAdmin ? 'Sim, é Administrador' : 'Não, é um Usuário Comum'"></span>
                        </span>
                        <x-input-error :messages="$errors->get('is_admin')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center mt-4">
                    <x-primary-button>
                        Cadastrar
                    </x-primary-button>
                </div>
            </form>
        </div>
    </x-body-page>

</x-app-layout>
