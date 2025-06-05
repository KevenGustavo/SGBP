<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ 'Usuários Cadastrados' }}
        </h2>
        @can('create', App\Models\Bem::class)
            <x-primary-link-button :href="route('users.create')">Cadastrar Novo Usuário</x-primary-link-button>
        @endcan
    </x-slot>

    <x-body-page>
        <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg p-6 text-gray-900">
            <div class="container mx-auto px-4 py-8" x-data="">

                <form method="GET" action="{{ route('users') }}" class="bg-gray-50 border shadow-md rounded-lg p-6 mb-8">

                    <div class="mb-6">
                        <x-input-label for="search_query" :value="__('Pesquisar usuário')" />
                        <x-text-input id="search_query" name="search_query" type="text" class="mt-1 block w-full"
                            value="{{ request('search_query') }}" placeholder="Nome ou Email" />
                    </div>

                    <div class="mt-6 flex items-center justify-end space-x-3">
                        <a href="{{ route('users') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">
                            Limpar Filtro
                        </a>
                        <button type="submit"
                            class="cursor-pointer inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                            Pesquisar
                        </button>
                    </div>

                </form>

                <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-300 text-left text-gray-700 text-xs uppercase">
                            <tr>
                                <th scope="col" class="px-6 py-3 tracking-wider">
                                    Nome</th>
                                <th scope="col" class="px-6 py-3 tracking-wider">
                                    Email</th>
                                <th scope="col" class="px-6 py-3 tracking-wider">
                                    Excluir</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200 text-gray-500">
                            @forelse ($users as $user)
                                <tr class="hover:bg-gray-50 cursor-pointer">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $user->name }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm ">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div x-data="{
                                            showModal: false,
                                            formId: 'deleteUserForm-{{ $user->id }}',
                                            userName: '{{ addslashes($user->name) }}'
                                        }">
                                            <button type="button" @click="showModal = true"
                                                class="bg-red-600 hover:bg-red-700 text-white font-semibold py-1 px-3 rounded-md shadow-sm text-xs transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-75"
                                                title="Excluir Usuário">
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4 w-4 inline-block -ml-0.5 mr-1" viewBox="0 0 20 20"
                                                    fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                Excluir
                                            </button>
                                            <form method="POST" action="{{ route('users.delete', $user) }}"
                                                :id="formId" class="hidden">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            @include('users.partials.delete-modal-form')
                                        </div>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        Nenhum usuário encontrado.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-8">
                    {{ $users->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </x-body-page>
</x-app-layout>
