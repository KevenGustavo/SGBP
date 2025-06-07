<x-app-layout>
    <x-slot name="header">
        {{-- HEADER: Padrão de layout responsivo com título e botão de voltar --}}
        <div class="flex w-full flex-col items-start sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-4 sm:mb-0">
                Cadastrar Novo Usuário
            </h2>
        </div>
    </x-slot>

    <x-body-page>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 sm:p-8 text-gray-900">
            {{-- Container com largura máxima para melhor visualização em telas grandes --}}
            <div class="max-w-4xl mx-auto">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    {{-- Grid responsivo para os campos do formulário --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Campo Nome --}}
                        <div>
                            <x-input-label for="name" :value="__('Nome Completo')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Campo Email --}}
                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2 mt-4">
                            <label for="is_admin_toggle" class="block text-sm font-medium text-gray-900">Nivel de Permissão</label>
                            <p class="text-xs text-gray-500 mb-2">Ative para conceder permissões administrativas a este usuário.</p>

                            <div x-data="{ isAdmin: {{ old('is_admin') ? 'true' : 'false' }} }" class="flex items-center p-4 border bg-gray-50 rounded-lg">
                                <button type="button" id="is_admin_toggle" @click="isAdmin = !isAdmin"
                                    :class="isAdmin ? 'bg-indigo-600' : 'bg-gray-300'" role="switch" :aria-checked="isAdmin.toString()"
                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                                    <span aria-hidden="true" :class="isAdmin ? 'translate-x-5' : 'translate-x-0'"
                                        class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out">
                                    </span>
                                </button>

                                <input type="checkbox" name="isAdmin" class="hidden" x-model="isAdmin" value="1">

                                <span class="ms-4 text-sm">
                                    <span class="font-medium text-gray-900" x-text="isAdmin ? 'Administrador' : 'Usuário Comum'"></span>
                                </span>
                            </div>
                            <x-input-error :messages="$errors->get('is_admin')" class="mt-2" />
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-8 pt-6 border-t">
                        <x-primary-button>
                            Cadastrar Usuário
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </x-body-page>

</x-app-layout>
