<ul role="list" class="-mb-8">
    @forelse ($bem->historicos as $historico)
    <li>
        <div class="relative pb-10">
            @if (!$loop->last)
                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
            @endif

            <div class="relative flex space-x-3 sm:space-x-4 items-start">
                <div>
                    <span class="h-8 w-8 rounded-full bg-indigo-500 flex items-center justify-center ring-8 ring-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 text-white">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                        </svg>
                    </span>
                </div>
                <div class="min-w-0 flex-1 bg-gray-50 p-3 sm:p-4 rounded-md border border-gray-100 shadow-sm">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-2">
                        <p class="text-base sm:text-lg font-semibold text-gray-900">
                            {{ $historico->tipo ?? 'Registro de Histórico' }}
                        </p>
                        <time datetime="{{ $historico->created_at->toIso8601String() }}" class="text-xs sm:text-sm text-gray-500 whitespace-nowrap mt-1 sm:mt-0">
                            {{ $historico->created_at->format('d/m/Y H:i') }}
                        </time>
                    </div>

                    <div class="space-y-4 text-sm text-gray-700 border-t border-gray-200 pt-3">

                        <div class="grid grid-cols-[auto_1fr] gap-x-3">
                            <span class="font-medium text-gray-600 flex-shrink-0">Localização:</span>
                            <div class="flex flex-col sm:flex-row items-start sm:items-center sm:space-x-2">
                                @if ($historico->localizacao_anterior)
                                    <span class="bg-white border px-2 py-0.5 rounded-full text-gray-600 shadow-sm">
                                        {{ $historico->localizacao_anterior }}
                                    </span>
                                    {{-- Seta para baixo (visível apenas em telas pequenas) --}}
                                    <svg class="h-4 w-4 text-indigo-500 my-1 sm:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" /></svg>
                                    {{-- Seta para a direita (visível apenas de 'sm' para cima) --}}
                                    <svg class="h-5 w-5 text-indigo-500 hidden sm:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" /></svg>
                                @endif
                                <span class="bg-indigo-100 border border-indigo-200 px-2 py-0.5 rounded-full text-indigo-800 font-bold shadow-sm">
                                    {{ $historico->localizacao_atual }}
                                </span>
                            </div>
                        </div>

                        {{-- BLOCO DE RESPONSÁVEL --}}
                        <div class="grid grid-cols-[auto_1fr] gap-x-3">
                            <span class="font-medium text-gray-600 flex-shrink-0">Responsável:</span>
                            <div class="flex flex-col sm:flex-row items-start sm:items-center sm:space-x-2">
                                @if ($historico->responsavelAnterior)
                                    <span class="bg-white border px-2 py-0.5 rounded-full text-gray-600 shadow-sm">
                                        {{ $historico->responsavelAnterior->name }}
                                    </span>
                                    <svg class="h-4 w-4 text-indigo-500 my-1 sm:hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" /></svg>
                                    <svg class="h-5 w-5 text-indigo-500 hidden sm:block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25 21 12m0 0-3.75 3.75M21 12H3" /></svg>
                                @endif
                                @if ($historico->responsavelAtual)
                                    <span class="bg-indigo-100 border border-indigo-200 px-2 py-0.5 rounded-full text-indigo-800 font-bold shadow-sm">
                                        {{ $historico->responsavelAtual->name }}
                                    </span>
                                @else
                                    <span class="bg-gray-100 border border-gray-300 px-2 py-0.5 rounded-full text-gray-500 italic shadow-sm">
                                        Usuário Excluído
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <p class="text-sm text-gray-500 text-left sm:text-right mt-3 pt-2 border-t border-gray-200">
                        Registrado por: <span class="font-semibold">{{ $historico->registrador->name ?? 'Sistema' }}</span>
                    </p>
                </div>
            </div>
        </div>
    </li>
    @empty
    <li>
        <div class="relative pb-4">
            <div class="relative flex items-center space-x-3">
                 <div>
                   <span class="h-8 w-8 rounded-full bg-gray-400 flex items-center justify-center ring-8 ring-white">
                       <svg class="h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                         <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                       </svg>
                   </span>
               </div>
                <p class="text-gray-600">Nenhum histórico encontrado para este bem.</p>
            </div>
       </div>
    </li>
    @endforelse
</ul>
