<div x-show="openLocalizacao" x-cloak x-transition:enter="modal-transition modal-enter"
    x-transition:leave="modal-transition modal-leave-to"
    class="fixed inset-0 bg-gray-400/80 flex items-center justify-center p-4 z-50"
    @keydown.escape.window="openLocalizacao = false">

    <div @click.away="openLocalizacao = false" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-sm"
        x-show="openLocalizacao" x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">

        <div class="flex justify-between items-center border-b pb-3 mb-4">
            <h3 class="text-xl font-semibold text-gray-900">Mudar Localização do Bem</h3>
        </div>

        <form method="post" action="{{ route('bens.updateLocalizacao', ['bem' => $bem->id]) }}"
            class="space-y-6 max-w-xl">
            @csrf
            @method('patch')
            <div class="mb-6">
                <x-input-label for="localizacao" value="Nova Localização" />
                <x-text-input id="localizacao" name="localizacao" type="text" class="mt-1 block w-full" required
                    autofocus />
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
