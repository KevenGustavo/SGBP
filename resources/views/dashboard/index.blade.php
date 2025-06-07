<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Painel de Controle
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6 flex items-center">
                    <div class="bg-green-500 p-4 rounded-full text-white mr-4 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Total de Bens</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $bemCount ?? 0 }}</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6 flex items-center">
                    <div class="bg-blue-500 p-4 rounded-full text-white mr-4 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="h-8 w-8">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 20c0-2.21 3.58-4 8-4s8 1.79 8 4" />
                        </svg>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600">Total de Usuários</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $userCount ?? 0 }}</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6 flex items-center">
                    <div class="bg-yellow-500 p-4 rounded-full text-white mr-4 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Bens em Manutenção</p>
                        <p class="text-3xl font-bold text-yellow-600">{{ $bensManutencaoCount ?? 0 }}</p>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6 flex items-center">
                    <div class="bg-purple-500 p-4 rounded-full text-white mr-4 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Transferências (30 dias)</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $transferenciasMesCount ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg text-gray-800 mb-4">Distribuição por Estado</h3>
                        <ul class="space-y-4">
                            @forelse ($bensPorEstado as $status)
                                <li class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        @php
                                            $cor = match ($status->estado) {
                                                'Em Funcionamento' => 'bg-green-500',
                                                'Em Manutenção' => 'bg-yellow-500',
                                                'Com Defeito' => 'bg-red-500',
                                                'Ocioso' => 'bg-gray-500',
                                                default => 'bg-gray-300',
                                            };
                                        @endphp
                                        <span class="h-2 w-2 rounded-full {{ $cor }} mr-3"></span>
                                        <span class="text-gray-700">{{ $status->estado ?? 'N/A' }}</span>
                                    </div>
                                    <span
                                        class="font-bold text-gray-900 bg-gray-200 px-3 py-1 text-sm rounded-full">{{ $status->total }}</span>
                                </li>
                            @empty
                                <li class="text-gray-500">Não há dados sobre o estado dos bens.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg text-gray-800 mb-4">Top 5 Responsáveis por Bens</h3>
                        <ul class="space-y-4">
                            @forelse ($topResponsaveis as $item)
                                <li class="flex justify-between items-center">
                                    <span
                                        class="text-gray-700 truncate">{{ $item->user->name ?? 'Responsável Excluído' }}</span>
                                    <span
                                        class="font-bold text-gray-900 bg-gray-200 px-3 py-1 text-sm rounded-full">{{ $item->total }}</span>
                                </li>
                            @empty
                                <li class="text-gray-500">Não há dados sobre responsáveis.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg text-gray-800 mb-4">Últimas Transferências</h3>
                        <ul class="divide-y divide-gray-200">
                            @forelse ($ultimasTransferencias as $historico)
                                <li class="py-3">
                                    <div class="flex justify-between items-start text-sm mb-1">
                                        <p class="font-medium text-gray-900 truncate">
                                            Bem: <a href="{{ route('bens.show', $historico->bem_id) }}"
                                                class="text-indigo-600 hover:underline">{{ $historico->bem->patrimonio ?? 'N/A' }}</a>
                                        </p>
                                        <span
                                            class="text-xs text-gray-500 flex-shrink-0 ml-2">{{ $historico->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-sm text-gray-600">
                                        De: <span
                                            class="font-semibold">{{ $historico->responsavelAnterior->name ?? 'N/A' }}</span>
                                        → Para: <span
                                            class="font-semibold">{{ $historico->responsavelAtual->name ?? 'Responsável Excluído' }}</span>
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">Registrado por:
                                        {{ $historico->registrador->name ?? 'Sistema' }}</p>
                                </li>
                            @empty
                                <li class="py-3 text-gray-500">Nenhuma transferência recente.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="font-semibold text-lg text-gray-800 mb-4">Bens Adicionados Recentemente</h3>
                        <ul class="divide-y divide-gray-200">
                            @forelse ($bensRecentes as $bem)
                                <li class="py-3 flex justify-between items-center">
                                    <div class="min-w-0">
                                        <p class="font-medium text-gray-900 truncate">
                                            <a href="{{ route('bens.show', $bem) }}"
                                                class="text-indigo-600 hover:underline">{{ $bem->nome }} (Pat:
                                                {{ $bem->patrimonio ?? 'N/A' }})</a>
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">Responsável:
                                            {{ $bem->user->name ?? 'N/A' }}</p>
                                    </div>
                                    <span
                                        class="text-xs text-gray-400 flex-shrink-0 ml-4">{{ $bem->created_at->diffForHumans() }}</span>
                                </li>
                            @empty
                                <li class="py-3 text-gray-500">Nenhum bem adicionado recentemente.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
