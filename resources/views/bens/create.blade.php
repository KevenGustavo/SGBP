<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            Registrar Novo Bem
        </h2>
    </x-slot>

    <x-body-page>
        <div class="bg-white overflow-hidden shadow-xs sm:rounded-lg p-6 text-gray-900">
            <form method="post" action="{{ route('bens.store') }}" class="space-y-6 max-w-xl">
                @csrf
                @method('post')
                <div>
                    <x-input-label for="patrimonio" :value="__('Patrimonio')" />
                    <x-text-input id="patrimonio" name="patrimonio" type="text" class="mt-1 block w-full"
                        :value="old('patrimonio')" required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('patrimonio')" />
                </div>

                <div>
                    <x-input-label for="marca" :value="__('Marca')" />
                    <x-text-input id="marca" name="marca" type="text" class="mt-1 block w-full"
                        :value="old('marca')" required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('marca')" />
                </div>

                <div>
                    <x-input-label for="localizacao" :value="__('Localização')" />
                    <x-text-input id="localizacao" name="localizacao" type="text" class="mt-1 block w-full"
                        :value="old('localizacao')" required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('localizacao')" />
                </div>

                <div>
                    <x-input-label for="responsavel" :value="__('Responsavel')" />
                    <x-select-input id="responsavel" name="responsavel" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @selected(old('responsavel_id') == $user->id)>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </x-select-input>
                    <x-input-error class="mt-2" :messages="$errors->get('responsavel')" />
                </div>

                <div>
                    <x-input-label for="tipoUso" :value="__('Tipo de Uso')" />
                    <x-select-input id="tipoUso" name="tipoUso" required>
                        <option value="Professor" @selected(old('tipoUso') == 'Professor')>Professor</option>
                        <option value="Pesquisa" @selected(old('tipoUso') == 'Pesquisa')>Pesquisa</option>
                        <option value="Extensão" @selected(old('tipoUso') == 'Extensão')>Extensão</option>
                    </x-select-input>
                    <x-input-error class="mt-2" :messages="$errors->get('tipoUso')" />
                </div>

                <div>
                    <x-input-label for="estado" :value="__('Estado')" />
                    <x-select-input id="estado" name="estado" required>
                        <option value="Em Funcionamento" @selected(old('estado') == 'Em Funcionamento')>Em Funcionamento</option>
                        <option value="Com Defeito" @selected(old('estado') == 'Com Defeito')>Com Defeito</option>
                        <option value="Ocioso" @selected(old('estado') == 'Ocioso')>Ocioso</option>
                        <option value="Em Manutenção" @selected(old('estado') == 'Em Manutenção')>Em Manutenção</option>
                    </x-select-input>
                    <x-input-error class="mt-2" :messages="$errors->get('estado')" />
                </div>

                <div>
                    <x-input-label for="descricao" :value="__('Descrição')" />
                    <textarea id="descricao" name="descricao" rows="12"
                        class=" block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 resize-none">{{ old('descricao') }}</textarea>
                    <x-input-error class="mt-2" :messages="$errors->get('descricao')" />
                </div>


                <div class="flex items-center mt-4">
                    <x-primary-button>
                        Salvar
                    </x-primary-button>
                </div>

            </form>
        </div>
    </x-body-page>

</x-app-layout>
