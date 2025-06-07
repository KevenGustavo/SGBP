<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ 'Bem: ' . $bem->patrimonio }}
        </h2>
    </x-slot>

    <div x-data="{ openResponsavel: false, openLocalizacao: false, openDelete: false }">
        <x-body-page>
            <div
                class="flex flex-col lg:flex-row lg:space-x-8 bg-white overflow-hidden shadow-xs sm:rounded-lg p-4 sm:p-6 text-gray-900">
                {{-- Coluna de Informações do Bem --}}
                <div class="w-full lg:w-3/4">
                    <dl class="text-gray-900 divide-y divide-gray-200">
                        <h3 class="text-2xl font-semibold text-gray-800 mb-4 border-b pb-2">Informações sobre o Bem</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 py-4">
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-600">Patrimônio</dt>
                                <dd class="mt-1 text-lg font-semibold">{{ $bem->patrimonio }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-600">Marca</dt>
                                <dd class="mt-1 text-lg font-semibold">{{ $bem->marca }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-600">Estado</dt>
                                <dd class="mt-1 text-lg font-semibold">{{ $bem->estado }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-600">Tipo de Uso</dt>
                                <dd class="mt-1 text-lg font-semibold">{{ $bem->tipoUso }}</dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-600">Responsável</dt>
                                <dd class="mt-1 text-lg font-semibold">{{ $bem->user->name ?? 'N/A' }}</p>
                                </dd>
                            </div>
                            <div class="sm:col-span-1">
                                <dt class="text-sm font-medium text-gray-600">Localização</dt>
                                <dd class="mt-1 text-lg font-semibold">{{ $bem->localizacao }}</p>
                                </dd>
                            </div>
                            <div class="sm:col-span-2">
                                <dt class="text-sm font-medium text-gray-600">Descrição</dt>
                                <dd
                                    class="mt-1 text-base font-normal text-gray-700 bg-gray-50 p-3 rounded-md border max-h-80 overflow-y-auto">
                                    {!! nl2br(e($bem->descricao)) !!}
                                </dd>
                            </div>
                        </div>
                    </dl>
                </div>
                {{-- Coluna de Ações --}}
                @can('update', App\Models\Bem::class)
                    <div
                        class="w-full lg:w-1/4 mt-8 lg:mt-0 border-t lg:border-t-0 lg:border-l pt-6 lg:pt-0 lg:pl-6 border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Ações</h3>
                        <div class="flex flex-col space-y-3">
                            <x-primary-link-button href="{{ route('bens.edit', $bem->id) }}">
                                Editar Bem
                            </x-primary-link-button>
                            <x-secondary-button @click="openResponsavel = true">Transferir Responsabilidade</x-secondary-button>
                            <x-secondary-button @click="openLocalizacao = true">Transferir Localização</x-secondary-button>
                            <x-danger-button @click="openDelete = true">Excluir Bem</x-danger-button>
                        </div>
                    </div>
                @endcan
            </div>
            <div class="max-w-7xl mx-auto">
                <div class="bg-white shadow-lg rounded-lg p-6 mt-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-6 border-b pb-3">Histórico de Movimentações</h3>
                    <div class="flow-root">
                        @include('bens.partials.historico-list')
                    </div>
                </div>
            </div>

        </x-body-page>

        @can('update', App\Models\Bem::class)
            @include('bens.partials.delete-modal-form')

            @include('bens.partials.responsavel-modal-form')

            @include('bens.partials.localizacao-modal-form')
        @endcan
    </div>
</x-app-layout>
