<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ 'Editar Bem' }}
        </h2>
    </x-slot>

    <x-body-page>
        <form method="post" action="{{ route('bens.updateDetalhes',["bem"=>$bem->id]) }}" class="space-y-6 max-w-xl">
            @csrf
            @method('patch')
            <div>
                <x-input-label for="patrimonio" :value="__('Patrimonio')" />
                <x-text-input id="patrimonio" name="patrimonio" type="text" class="mt-1 block w-full" :value="old('patrimonio', $bem->patrimonio)"
                    required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('patrimonio')" />
            </div>

            <div>
                <x-input-label for="marca" :value="__('Marca')" />
                <x-text-input id="marca" name="marca" type="text" class="mt-1 block w-full" :value="old('marca', $bem->marca)"
                    required autofocus />
                <x-input-error class="mt-2" :messages="$errors->get('marca')" />
            </div>

            <div>
                <x-input-label for="tipoUso" :value="__('Tipo de Uso')" />
                <x-select-input id="tipoUso" name="tipoUso" required>
                    <option value="Professor" {{ old('tipoUso', $bem->tipoUso) == "Professor" ? 'selected' : '' }}>Professor</option>
                    <option value="Pesquisa" {{ old('tipoUso', $bem->tipoUso) == "Pesquisa" ? 'selected' : '' }}>Pesquisa</option>
                    <option value="Extensão" {{ old('tipoUso', $bem->tipoUso) == "Extensão" ? 'selected' : '' }}>Extensão</option>
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('tipoUso')" />
            </div>

            <div>
                <x-input-label for="estado" :value="__('Estado')" />
                <x-select-input id="estado" name="estado" required>
                    <option value="Em Funcionamento" {{ old('estado', $bem->estado) == "Em Funcionamento" ? 'selected' : '' }}>Em Funcionamento</option>
                    <option value="Com Defeito" {{ old('estado', $bem->estado) == "Com Defeito" ? 'selected' : '' }}>Com Defeito</option>
                    <option value="Ocioso" {{ old('estado', $bem->estado) == "Ocioso" ? 'selected' : '' }}>Ocioso</option>
                    <option value="Em Manutenção" {{ old('estado', $bem->estado) == "Em Manutenção" ? 'selected' : '' }}>Em Manutenção</option>
                </x-select-input>
                <x-input-error class="mt-2" :messages="$errors->get('estado')" />
            </div>

            <div>
                <x-input-label for="descricao" :value="__('Descrição')" />
                <textarea id="descricao" name="descricao" rows="12"
                    class=" block p-2.5 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 resize-none"
                    >{{ old('descricao', $bem->descricao) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('descricao')" />
            </div>


            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>
            </div>

        </form>
    </x-body-page>

</x-app-layout>
