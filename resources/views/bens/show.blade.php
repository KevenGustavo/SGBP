<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ 'Bem: ' . $bem->patrimonio }}
        </h2>
    </x-slot>

    <x-body-page>
        <div class="flex justify-between bg-white overflow-hidden shadow-xs sm:rounded-lg p-6 text-gray-900"
            x-data="{ openResponsavel: false, openLocalizacao: false }">

            <dl class="max-3xl text-gray-900 divide-y divide-gray-300">
                <h3 class="text-2xl font-semibold text-gray-800 mb-2 border-b pb-1">Informações sobre o Bem</h3>

                <div class="flex flex-col pb-1">
                    <dt class="mb-1 text-gray-600 md:text-lg ">Patrimonio</dt>
                    <dd class="text-lg font-semibold">{{ $bem->patrimonio }}</dd>
                </div>
                <div class="flex flex-col pb-1">
                    <dt class="mb-1 text-gray-600 md:text-lg ">Estado</dt>
                    <dd class="text-lg font-semibold">{{ $bem->estado }}</dd>
                </div>
                <div class="flex flex-col pb-1">
                    <dt class="mb-1 text-gray-600 md:text-lg ">Tipo de Uso</dt>
                    <dd class="text-lg font-semibold">{{ $bem->tipoUso }}</dd>
                </div>
                <div class="flex flex-col pb-1">
                    <dt class="mb-1 text-gray-600 md:text-lg ">Responsável</dt>
                    <dd class="text-lg font-semibold flex justify-between">
                        <p>{{ $bem->user->name }}</p>
                    </dd>
                </div>
                <div class="flex flex-col pb-1">
                    <dt class="mb-1 text-gray-600 md:text-lg ">Localização</dt>
                    <dd class="text-lg font-semibold flex justify-between">
                        <p>{{ $bem->localizacao }}</p>
                    </dd>
                </div>
                <div class="flex flex-col pb-2">
                    <dt class="mb-1 text-gray-600 md:text-lg ">Descrição</dt>
                    <dd class="text-lg font-semibold">{{ $bem->descricao }}</dd>
                </div>
            </dl>

            @can('update', App\Models\Bem::class)
                <div class="flex flex-col gap-2">
                    <x-primary-link-button href="{{ route('bens.edit', ['bem' => $bem['id']]) }}">Editar
                        Bem</x-primary-link-button>

                    <x-primary-button @click="openResponsavel = true">Transferir Responsabilidade</x-primary-button>

                    <x-primary-button @click="openLocalizacao = true">Transferir Localização</x-primary-button>
                </div>

                @include('bens.partials.responsavel-modal-form')

                @include('bens.partials.localizacao-modal-form')
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

</x-app-layout>
