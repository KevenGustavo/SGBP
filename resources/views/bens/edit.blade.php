<x-app-layout>
    <x-slot name="header">
        <div class="flex w-full flex-col items-start sm:flex-row sm:items-center sm:justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                Editar Bem: <span class="text-indigo-700">{{ $bem->patrimonio }}</span>
            </h2>
        </div>
    </x-slot>

    <x-body-page>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 sm:p-8 text-gray-900">
            <div class="max-w-4xl mx-auto">
                <form method="post" action="{{ route('bens.updateDetalhes', $bem->id) }}">
                    @csrf
                    @method('patch')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div class="space-y-6">
                            <div>
                                <x-input-label for="patrimonio" :value="__('Patrimônio')" />
                                <x-text-input id="patrimonio" name="patrimonio" type="text" class="mt-1 block w-full" :value="old('patrimonio', $bem->patrimonio)" required autofocus />
                                <x-input-error class="mt-2" :messages="$errors->get('patrimonio')" />
                            </div>

                            <div>
                                <x-input-label for="marca" :value="__('Marca')" />
                                <x-text-input id="marca" name="marca" type="text" class="mt-1 block w-full" :value="old('marca', $bem->marca)" required />
                                <x-input-error class="mt-2" :messages="$errors->get('marca')" />
                            </div>

                        </div>

                        <div class="space-y-6">
                            <div>
                                <x-input-label for="tipoUso" :value="__('Tipo de Uso')" />
                                <x-select-input id="tipoUso" name="tipoUso" class="mt-1 block w-full" required>
                                    @foreach ($tiposUso as $key => $value)
                                        <option value="{{ $value }}" @selected(old('tipoUso', $bem->tipoUso) == $value)>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </x-select-input>
                                <x-input-error class="mt-2" :messages="$errors->get('tipoUso')" />
                            </div>

                            <div>
                                <x-input-label for="estado" :value="__('Estado')" />
                                <x-select-input id="estado" name="estado" class="mt-1 block w-full" required>
                                    @foreach ($estados as $key => $value)
                                        <option value="{{ $value }}" @selected(old('estado', $bem->estado) == $value)>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </x-select-input>
                                <x-input-error class="mt-2" :messages="$errors->get('estado')" />
                            </div>
                        </div>

                        <div class="md:col-span-2">
                            <x-input-label for="descricao" :value="__('Descrição')" />
                            <textarea id="descricao" name="descricao" rows="8" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-indigo-500 focus:border-indigo-500">{{ old('descricao', $bem->descricao) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('descricao')" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-8 pt-6 border-t">
                        <x-primary-button>
                            Salvar Alterações
                        </x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </x-body-page>
</x-app-layout>
