<x-app-layout>
    <x-slot name="header">
        <div class="flex w-full flex-col items-start sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight mb-4 sm:mb-0">
                Bens Registrados
            </h2>

            @can('create', App\Models\Bem::class)
                <div class="flex items-center space-x-2">
                    <x-primary-link-button :href="route('bens.create')">
                        Registrar Bem
                    </x-primary-link-button>

                    <x-primary-link-button :href="route('relatorios.bensGeral')" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        Gerar Relatório
                    </x-primary-link-button>
                </div>
            @endcan

        </div>
    </x-slot>

    <x-body-page>
        <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg p-4 sm:p-6 text-gray-900">
            <div class="container mx-auto">

                <form method="GET" action="{{ route('bens') }}"
                    class="bg-gray-50 border shadow-md rounded-lg p-4 sm:p-6 mb-8">
                    <div class="mb-6">
                        <x-input-label for="search_query" :value="__('Pesquisar por Patrimônio ou Marca')" />
                        <x-text-input id="search_query" name="search_query" type="text" class="mt-1 block w-full"
                            value="{{ request('search_query') }}" placeholder="Digite aqui..." />
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                        <div>
                            <x-input-label for="tipo_uso" :value="__('Tipo de Uso')" />
                            <x-select-input id="tipo_uso" name="tipo_uso" class="mt-1 block w-full">
                                @foreach ($tiposUso as $key => $value)
                                    <option value="{{ $key }}" @selected(request('tipo_uso') == $key)>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </x-select-input>
                        </div>
                        <div>
                            <x-input-label for="estado" :value="__('Estado')" />
                            <x-select-input id="estado" name="estado" class="mt-1 block w-full">
                                @foreach ($estados as $key => $value)
                                    <option value="{{ $key }}" @selected(request('estado') == $key)>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </x-select-input>
                        </div>
                        <div>
                            <x-input-label for="responsavel_id" :value="__('Responsável')" />
                            <x-select-input id="responsavel_id" name="responsavel_id" class="mt-1 block w-full">
                                <option value="">Todos</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" @selected(request('responsavel_id') == $user->id)>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </x-select-input>
                        </div>
                    </div>

                    <div class="mt-6 flex items-center justify-end space-x-4">
                        <a href="{{ route('bens') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">
                            Limpar Filtros
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
                                    <th scope="col" class="px-6 py-3 tracking-wider">Patrimônio</th>
                                    <th scope="col" class="px-6 py-3 tracking-wider">Marca</th>
                                    <th scope="col" class="px-6 py-3 tracking-wider">Tipo de Uso</th>
                                    <th scope="col" class="px-6 py-3 tracking-wider">Estado</th>
                                    <th scope="col" class="px-6 py-3 tracking-wider">Responsável</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 text-gray-600">
                                @forelse ($bens as $bem)
                                    <tr class="hover:bg-gray-50 cursor-pointer" x-data
                                        @click="window.location.href = '{{ route('bens.show', $bem->id) }}'">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $bem->patrimonio }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $bem->marca }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $bem->tipoUso }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $bem->estado }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $bem->user->name ?? 'N/A' }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Nenhum
                                            bem encontrado.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="md:hidden space-y-4">
                    @forelse ($bens as $bem)
                        <div class="bg-white p-4 rounded-lg shadow-md border cursor-pointer" x-data
                            @click="window.location.href = '{{ route('bens.show', $bem->id) }}'">
                            <div class="flex justify-between items-start">
                                <div class="font-bold text-lg text-indigo-700">{{ $bem->patrimonio }}</div>
                                <div class="text-sm text-gray-600">{{ $bem->marca }}</div>
                            </div>
                            <div class="mt-3 border-t pt-3 space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Tipo de Uso:</span>
                                    <span class="font-semibold text-gray-800">{{ $bem->tipoUso }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Estado:</span>
                                    <span class="font-semibold text-gray-800">{{ $bem->estado }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Responsável:</span>
                                    {{-- renomeie para 'responsavel' para corresponder ao nome do método de relacionamento --}}
                                    <span class="font-semibold text-gray-800">{{ $bem->user->name ?? 'N/A' }}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white p-4 rounded-lg shadow-md text-center text-gray-500">
                            Nenhum bem encontrado.
                        </div>
                    @endforelse
                </div>

                <div class="mt-8">
                    {{ $bens->appends(request()->query())->links() }}
                </div>

            </div>
        </div>
    </x-body-page>
</x-app-layout>
