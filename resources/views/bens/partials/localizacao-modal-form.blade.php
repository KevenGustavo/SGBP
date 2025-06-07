    <div x-show="openLocalizacao" x-cloak style="display: none;" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4 z-50"
        @keydown.escape.window="openLocalizacao = false">

        <div @click.away="openLocalizacao = false" class="bg-white rounded-lg shadow-xl w-full max-w-lg"
            x-show="openLocalizacao" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">

            <form method="post" action="{{ route('bens.updateLocalizacao', $bem->id) }}" class="p-6">
                @csrf
                @method('patch')

                <div class="border-b pb-3 mb-6">
                    <h3 class="text-lg font-bold text-gray-900">
                        Transferir Localização do Bem
                    </h3>
                    <p class="text-sm text-gray-600 mt-1">
                        Patrimônio: <span class="font-semibold">{{ $bem->patrimonio }}</span>
                    </p>
                </div>

                <div class="space-y-6">
                    <div>
                        <x-input-label for="localizacao" value="Digite a Nova Localização" />
                        <x-text-input id="localizacao" name="localizacao" type="text" class="mt-1 block w-full"
                            :value="old('localizacao', $bem->localizacao)" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('localizacao')" />
                    </div>
                </div>

                <div class="flex items-center justify-end gap-4 mt-8">
                    <x-secondary-button type="button" @click.prevent="openLocalizacao = false">
                        Cancelar
                    </x-secondary-button>

                    <x-primary-button type="submit">
                        Transferir
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>
