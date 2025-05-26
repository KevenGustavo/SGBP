<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Detalhes sobre o Bem' }}
        </h2>
        @can('update', App\Models\Bem::class)
            <x-primary-link-button href="{{ route('bens.edit', ['bem' => $bem['id']]) }}">Editar Bem</x-primary-link-button>
        @endcan
    </x-slot>

    <x-body-page>
        <div class="flex justify-between" x-data="{ openResponsavel: false, openLocalizacao: false }">

            <dl class="max-w-md text-gray-900 divide-y divide-gray-300">
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-600 md:text-lg ">Patrimonio</dt>
                    <dd class="text-lg font-semibold">{{ $bem->patrimonio }}</dd>
                </div>
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-600 md:text-lg ">Estado</dt>
                    <dd class="text-lg font-semibold">{{ $bem->estado }}</dd>
                </div>
                <div class="flex flex-col pb-3">
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
                <div class="flex flex-col pb-3">
                    <dt class="mb-1 text-gray-600 md:text-lg ">Descrição</dt>
                    <dd class="text-lg font-semibold">{{ $bem->descricao }}</dd>
                </div>
            </dl>

            @can('update', App\Models\Bem::class)
                <div class="flex flex-col gap-2">
                    <x-primary-button @click="openResponsavel = true">Transferir Responsabilidade</x-primary-button>

                    <x-primary-button @click="openLocalizacao = true">Transferir Localização</x-primary-button>
                </div>

                <div x-show="openResponsavel" x-cloak x-transition:enter="modal-transition modal-enter"
                    x-transition:leave="modal-transition modal-leave-to"
                    class="fixed inset-0 bg-gray-400/80 flex items-center justify-center p-4 z-50"
                    @keydown.escape.window="openResponsavel = false">

                    <div @click.away="openResponsavel = false" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-sm"
                        x-show="openResponsavel" x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

                        <div class="flex justify-between items-center border-b pb-3 mb-4">
                            <h3 class="text-xl font-semibold text-gray-900">Mudar Responsável pelo Bem</h3>
                        </div>

                        <form method="post" action="{{ route('bens.updateResponsavel', ['bem' => $bem->id]) }}"
                            class="space-y-6 max-w-xl">
                            @csrf
                            @method('patch')
                            <div class="mb-6">
                                <x-input-label for="responsavel" value="Novo Responsável" />
                                <x-select-input id="responsavel" name="responsavel" required>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('responsavel_id', $bem->responsavel_id) == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}</option>
                                    @endforeach
                                </x-select-input>
                                <x-input-error class="mt-2" :messages="$errors->get('responsavel')" />
                            </div>

                            <div class="flex items-center justify-end gap-2">
                                <x-secondary-button @click="openResponsavel = false">
                                    Cancelar
                                </x-secondary-button>

                                <x-primary-button>
                                    Transferir
                                </x-primary-button>
                            </div>
                        </form>

                    </div>
                </div>



                <div x-show="openLocalizacao" x-cloak x-transition:enter="modal-transition modal-enter"
                    x-transition:leave="modal-transition modal-leave-to"
                    class="fixed inset-0 bg-gray-400/80 flex items-center justify-center p-4 z-50"
                    @keydown.escape.window="openLocalizacao = false">

                    <div @click.away="openLocalizacao = false" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-sm"
                        x-show="openLocalizacao" x-transition:enter="transition ease-out duration-300 transform"
                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-200 transform"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

                        <div class="flex justify-between items-center border-b pb-3 mb-4">
                            <h3 class="text-xl font-semibold text-gray-900">Mudar Localização do Bem</h3>
                        </div>

                        <form method="post" action="{{ route('bens.updateLocalizacao', ['bem' => $bem->id]) }}"
                            class="space-y-6 max-w-xl">
                            @csrf
                            @method('patch')
                            <div class="mb-6">
                                <x-input-label for="localizacao" value="Nova Localização" />
                                <x-text-input id="localizacao" name="localizacao" type="text" class="mt-1 block w-full"
                                    required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('localizacao')" />
                            </div>

                            <div class="flex items-center justify-end gap-2">
                                <x-secondary-button @click="openLocalizacao = false">
                                    Cancelar
                                </x-secondary-button>

                                <x-primary-button>
                                    Transferir
                                </x-primary-button>
                            </div>
                        </form>

                    </div>
                </div>
            @endcan

        </div>

    </x-body-page>

</x-app-layout>
