<ul role="list" class="-mb-8">
    @foreach ($bem->historicos as $historico)
        <li>
            <div class="relative pb-10">
                <div class="relative flex space-x-4 items-start">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-indigo-600">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1 bg-gray-50 p-4 rounded-md border border-gray-100 shadow-sm">
                        <div class="flex justify-between items-center mb-3">
                            <p class="text-lg font-semibold text-gray-900">
                                {{ $historico->tipo }}
                            </p>
                            <time datetime="2025-05-15T10:30:00" class="text-sm text-gray-500 whitespace-nowrap">
                                {{ $historico->created_at->format('d/m/Y à\s H:i') }}
                            </time>
                        </div>
                        <div class="space-y-3 text-sm text-gray-700">
                            <div class="flex items-center space-x-2">
                                <span class="font-medium text-gray-600 w-24 flex-shrink-0">Localização:</span>
                                @if ($historico->localizacao_anterior)
                                    <span class="bg-white border px-3 py-1 rounded-full text-gray-600 shadow-sm">
                                        {{ $historico->localizacao_anterior }}
                                    </span>
                                    <svg class="h-6 w-6 text-indigo-500 flex-shrink-0"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                    </svg>
                                @endif

                                <span
                                    class="bg-indigo-100 border border-indigo-200 px-3 py-1 rounded-full text-indigo-800 font-bold shadow-sm">
                                    {{ $historico->localizacao_atual }}
                                </span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="font-medium text-gray-600 w-24 flex-shrink-0">Responsável:</span>
                                @if ($historico->responsavelAnterior)
                                    <span class="bg-white border px-3 py-1 rounded-full text-gray-600 shadow-sm">
                                        {{ $historico->responsavelAnterior->name }}
                                    </span>
                                    <svg class="h-6 w-6 text-indigo-500 flex-shrink-0"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" />
                                    </svg>
                                @endif

                                @if ($historico->responsavelAtual)
                                    <span
                                        class="bg-indigo-100 border border-indigo-200 px-3 py-1 rounded-full text-indigo-800 font-bold shadow-sm">
                                        {{ $historico->responsavelAtual->name }}
                                    </span>
                                @else
                                    <span
                                        class="bg-gray-100 border border-gray-300 px-3 py-1 rounded-full text-gray-500 italic shadow-sm">
                                        Usuário Excluído
                                    </span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-500 text-right">Registrado por:
                                <span class="font-bold">
                                    {{ $historico->registrador->name }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    @endforeach
</ul>
