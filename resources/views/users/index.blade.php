<x-app-layout>
    <x-slot name="header">
        <div class="flex w-full flex-col items-start sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-4 sm:mb-0">
                Usuários Cadastrados
            </h2>
            @can('create', App\Models\User::class)
                <x-primary-link-button :href="route('users.create')">Cadastrar Novo Usuário</x-primary-link-button>
            @endcan
        </div>
    </x-slot>

    <x-body-page>
        <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg p-4 sm:p-6 text-gray-900">
            <div class="container mx-auto">

                <form method="GET" action="{{ route('users') }}" class="bg-gray-50 border shadow-md rounded-lg p-4 sm:p-6 mb-8">
                    <div>
                        <x-input-label for="search_query" :value="__('Pesquisar por Nome ou Email')" />
                        <x-text-input id="search_query" name="search_query" type="text" class="mt-1 block w-full"
                            value="{{ request('search_query') }}" placeholder="Digite aqui..." />
                    </div>
                    <div class="mt-6 flex items-center justify-end space-x-4">
                        <a href="{{ route('users') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">
                            Limpar Filtro
                        </a>
                        <x-primary-button type="submit">
                            Pesquisar
                        </x-primary-button>
                    </div>
                </form>

                <div class="hidden md:block">
                    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-200 text-left text-gray-700 text-xs uppercase">
                                <tr>
                                    <th scope="col" class="px-6 py-3 tracking-wider">Nome</th>
                                    <th scope="col" class="px-6 py-3 tracking-wider">Email</th>
                                    <th scope="col" class="px-6 py-3 tracking-wider text-right">Ação</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-gray-600">
                                @forelse ($users as $user)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-right">
                                            @if(Auth::id() !== $user->id)
                                                @include('users.partials.delete-button-with-modal')
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-sm text-gray-500">Nenhum usuário encontrado.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="md:hidden space-y-4">
                    @forelse ($users as $user)
                        <div class="bg-white p-4 rounded-lg shadow-md border">
                            <div>
                                <h3 class="font-bold text-lg text-indigo-700">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-600 truncate">{{ $user->email }}</p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-end">
                                @if(Auth::id() !== $user->id)
                                    @include('users.partials.delete-button-with-modal')
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-4 rounded-lg shadow-md text-center text-gray-500">
                            Nenhum usuário encontrado.
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $users->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </x-body-page>

</x-app-layout>
